<?php
$number = cal_days_in_month(CAL_GREGORIAN, 12, 2016); // 31
echo "There were {$number} days in August 2016";


?>

<html>
<body>

<h1>My first SVG</h1>

<svg width="100" height="100">
  <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
</svg>

<br />
<br />

<canvas id="myCanvas" width="200" height="100"></canvas>


<br />
<br />


<div class="jumbotron">
	<div class="container">
		<h1>Hello, world!</h1>
		<p>Contents ...</p>
		<p>
			<a class="btn btn-primary btn-lg">Learn more</a>
		</p>
	</div>
</div>



<script>
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#FF0000";
ctx.fillRect(0,0,150,75);
</script>

</body>
</html>