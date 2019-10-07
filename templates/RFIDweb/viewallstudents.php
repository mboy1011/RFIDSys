<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();

	if(!isset($_SESSION['loginUserStatus'])){
		header('location: index.php');
	}
 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Student login system</title>


		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">


			 <!--pagination-->
	    <link rel="stylesheet" href="bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->

	    <script type="text/javascript">
	    	setInterval(function (){
			$('#studentCounts').load('studentCounts.php').fadeIn("slow");
			}, 1000); // refresh every 10000 milliseconds
	    </script>

	</head>



	<body onload="viewStudents()">

		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="viewallstudents.php"></a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="viewallstudents.php">View All Students
								<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="new.php"> 
								New
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="scanRFID.php"> 
								LogIn
								<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="reports.php"> 
								Reports
								<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
							</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li id="studentCounts"></li>
						<li><a href="logout.php">Logout
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</a>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>


		<div class="container" id="info"></div>
		<br />
		<div id="displayAllStudents"></div>

 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

 			 <!--pagination-->
	    <script src="bootstrap/js/jquery.dataTables2.js"></script>
    <script>
		//script for pagination
		// $(document).ready(function(){
		//     $('#myTable').dataTable();
		// });

		//if buttonSearch is click
		$('#buttonSearch').click(function(){
			alert("under construction pa");
		});

		//display view all students
		function viewStudents(){
		$.ajax({
			type: "GET",
			url: "getAllStudents.php"
		}).done(function(data){
			$('#displayAllStudents').html(data);
		});
	}

		function deletePhoto(sphoto){//yes nakuha jud tnx lord. funtion to delte photo kay d mo gana sa ajax kung direct
			//delete ang photo while nag query. idk nganu .huhuh
			var photo= "photo="+sphoto;
			
			$.ajax({
            	type: "POST",	
            	url: "deletePhoto.php",
            	data: photo,                        
            	success: function(response) {
            	}
            	// do something
            }).done(function( data ){

            });
		}//end function deletePhoto

	   function deletedata(sid,sphoto){
		var id = sid;
		// alert(sphoto);
		deletePhoto(sphoto);
	    var datas="photo="+sphoto;
	    // alert(datas);
		$.ajax({
		   type: "POST",
		   url: "deleteStudent.php?id="+id,
		   data: datas
		}).done(function( data ) {
			var x = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Succes!</strong> Deleted Successfully...</div> ';
		  $('#info').html(x);
		  viewStudents();
		  hideAlert();
		  // updateData();
		});
    }//end deleteData function

 //    //focus input box if ge click na button change ID
    function focusChangeID(id){
	 // $('newRFID'+id).focus();
    	// alert(id);
    	$('#newRFID'+id).focus();
    }//end focus change ID

 //    //rfid
	// var typingTimer;                //timer identifier
	// var doneTypingInterval = 500;  //time in ms, .5 second for example
	// var $input = $('#myInput');

	// //on keyup, start the countdown
	// $input.on('keyup', function () {
	//   clearTimeout(typingTimer);
	//   typingTimer = setTimeout(changeRFID, doneTypingInterval);
	// });

	// //on keydown, clear the countdown 
	// $input.on('keydown', function () {
	//   clearTimeout(typingTimer);
	// });

	//user is "finished typing," do something
	function changeRFID(id) {
	  // alert("id: "+id);
	  var newRFID = $('#newRFID'+id).val();
	  // alert(newRFID);
	  var datas = "newRFID="+newRFID+"&id="+id;
	  // alert(datas);
	  if(!newRFID){
	  	var x = '<div class="alert alert-danger">'+
						  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
						  '<strong>Warning!</strong> Please Scan the New ID.'+
						'</div>';
				$('#info').html(x);
				hideAlert();
	  }else{
		  $.ajax({
		  	type: "POST",
		  	url: "changeRFID.php",
		  	data: datas
		  }).done(function(data){
		  	$('#info').html(data);
		  	viewStudents();
		  	hideAlert();
		  });
	  }
	}//end changeRFID func
    //rfid


	//update student data
    function updatedata(sid){
	
		var id = sid;
	 	var studID = $('#studID'+id).val();
	  	var fN = $('#fN'+id).val();
	  	var mN = $('#mN'+id).val();
	  	var lN = $('#lN'+id).val();
	  	var nEx = $('#nEx'+id).val();
	  	var address = $('#address'+id).val();
	  	var course = $('#course'+id).val();
	  	var year = $('#year'+id).val();
		var section = $('#section'+id).val();
		
		var datas="studID="+studID+"&fN="+fN+"&mN="+mN+
			"&lN="+lN+"&nEx="+nEx+"&address="+address+
			"&course="+course+"&year="+year+"&section="+section;
	     
	     // alert(datas); 
		$.ajax({
		   type: "POST",
		   url: "updateStudents.php?id="+id,
		   data: datas
		}).done(function( data ) {
		  $('#info').html(data);
		  viewStudents();
		  hideAlert();
		});
    }//end update student data



 //    $("#info").fadeTo(5000, 500).slideUp(500, function(){
	//     // $("#msg").alert('close');
	// });
	
		//hide alert message after several seconds 
		function hideAlert(){
			$("#info").fadeTo(3000, 500).slideUp(500, function(){
			});
		}

    </script>

	</body>
</html>