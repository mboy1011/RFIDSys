from flask import Flask, render_template,url_for,session,request,flash,jsonify,redirect
from flask_socketio import SocketIO, send, emit
import RPi.GPIO as GPIO
import sys
from mfrc522 import SimpleMFRC522
import netifaces as ni
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, scoped_session
import json,time,signal,werkzeug,os
from func_timeout import func_set_timeout,func_timeout
from werkzeug.utils import secure_filename

class InvalidUsage(Exception):
    status_code = 400

    def __init__(self, message, status_code=None, payload=None):
        Exception.__init__(self)
        self.message = message
        if status_code is not None:
            self.status_code = status_code
        self.payload = payload

    def to_dict(self):
        rv = dict(self.payload or ())
        rv['message'] = self.message
        return rv
        
class StatusDenied(werkzeug.exceptions.HTTPException):
    code = 507
    description = 'Not enough storage space.'
# Flask
async_mode = None
app = Flask(__name__,static_url_path='/static')
socketio = SocketIO(app,async_mode=async_mode)

# RFID
reader = SimpleMFRC522()

# Network Interface
ip = ni.ifaddresses('wlan0')[ni.AF_INET][0]['addr']

# SQLAlchemy DB Connection
engine = create_engine('mysql+mysqldb://root:password@localhost:3306/db_rfidsys')
db = scoped_session(sessionmaker(bind=engine))
# File Upload
UPLOAD_FOLDER = './static/assets/img/'
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}  
def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS
@app.route('/add_student',methods=['POST'])
def add_stud():
    lname = request.form['lname']
    fname = request.form['fname']
    rfid = request.form['rfid_no']
    if request.method == 'POST':
        result = db.execute(f"SELECT * FROM tbl_useraccounts WHERE rfid_no = {rfid}").fetchall()
        if result:
            data = {'data':'Already Registered!'}
            return render_template('register.html',data=data)
        else:
            # check if the post request has the file part
            if 'file' not in request.files:
                data = {'data':'No file part'}
                return render_template('register.html',data=data)
            file = request.files['file']
            # if user does not select file, browser also
            # submit a empty part without filename
            if file.filename == '':
                data = {'data':'No selected file'}
                return render_template('register.html',data=data)
            if file and allowed_file(file.filename):
                filename = secure_filename(file.filename)
                file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
                imgurl = '/static/assets/img/'+filename
                query = db.execute(f"INSERT INTO tbl_useraccounts (rfid_no,fname,lname,img) VALUES ('{rfid}','{fname}','{lname}','{imgurl}')")
                db.commit()
                data = {'data':'Successfully Registered!'}
                return render_template('register.html',data=data)

    else:
        return redirect('/register')
@app.route('/')
def index():
    return render_template('login.html',async_mode=socketio.async_mode)

@app.route('/register')
def register():
    return render_template("register.html")

@app.route('/check',methods=['POST'])
@func_set_timeout(3.0)
def check():
    ids = reader.read_id()
    query = db.execute(f"SELECT DATE_FORMAT(date_added,'%%M %%d %%Y %%l:%%i %%p') as date_added,img,lname,fname,u_id,rfid_no FROM tbl_useraccounts WHERE rfid_no = {ids}")
    data = query.fetchone()
    if data:
        json_data = json.dumps(dict(data))
        return f'''{json_data}'''
        GPIO.cleanup()
    else:
        return f'''{json.dumps({'data':'n/a'})}'''
        GPIO.cleanup()

@app.errorhandler(StatusDenied)
def handle_invalid_usage(error):
    # response = jsonify(error.to_dict())
    # response.status_code = error.status_code
    return redirect('/error_handler')

@app.route('/error_handler')
def error_handler():
    raise InvalidUsage('Time is up!',status_code=410)

@app.route("/check_no",methods=['POST'])
@func_set_timeout(3.0)
def check_no():
    ids = reader.read_id()
    GPIO.cleanup()
    return f'''{json.dumps({'data':ids})}'''

if __name__ == "__main__":
    app.config['SECRET_KEY']= 'p@ssw0rd'
    app.register_error_handler(StatusDenied, error_handler)
    app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
    # FLASK_APP = "main"
    socketio.run(app,debug=True,host=ip,port=3000)
    
