<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<button type="button" id="but" class="btn btn-danger">button</button>
<button type="button" id="but2" class="btn btn-danger">button</button>

<div id="div1">
okey.
</div>

	
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.


 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>


<script type="text/javascript">

var winnie = $.noConflict();

	winnie("#but").click(function(){

		jQuery("#div1").css("background-color", "yellow");

	});


	jQuery("#but2").click(function(){

		jQuery("#div1").css("background-color", "blue");

	});
</script>




</body>
</html>