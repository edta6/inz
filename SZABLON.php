<?php

	session_start();
	
	$_SESSION['block']=0;
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Elektroniczna Dokumentacja</title>
	<link rel="stylesheet" href="css/table.css">
	<link rel="stylesheet" href="css/adduser.css">
	<link rel="stylesheet" href="css/wickedpicker.css">
	<!--<script src="https://code.jquery.com/jquery-3.0.0.js"></script>-->
	<script type="text/javascript" src="jquery-1.12.4.js"></script>
	<script type="text/javascript" src="jquery/pupils.js"></script>
	<script type="text/javascript" src="jquery/timer.js"></script>
	<script type="text/javascript" src="jquery/table.js"></script>
	<script type="text/javascript" src="jquery/wickedpicker.js"></script>
	<!--<script src="https://code.jquery.com/jquery-3.0.0.js"></script>-->
</head>
<body onload="odliczanie();">

<div class="header">

	<div class="header_container"><p id="zegar"></p></div>
	
		<div class="header_container">
		<p id="user_name">
			<?php
				echo $_SESSION['last_name'] . " " . $_SESSION['first_name'];
			?>
		</p>
	</div>
	
	<div class="btn_exit">
		<form action="include/logout.php" method="post">
			<button type="submit" class="myButton">Wyloguj</button>
		</form> 
	</div>
</div>

<?php
	include "include/menu.php";
?>

<script>
$(document).ready(function(){
var options = {
	twentyFour: true, //Display 24 hour format, defaults to false
	upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
	downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
	close: 'wickedpicker__close', //The close class selector to use, for custom CSS
	hoverState: 'hover-state', //The hover state class to use, for custom CSS
	title: 'Czas', //The Wickedpicker's title,
	minutesInterval: 1, //Change interval for minutes, defaults to 1
	beforeShow: null, //A function to be called before the Wickedpicker is shown
	show: null, //A function to be called when the Wickedpicker is shown
	clearable: false, //Make the picker's input clearable (has clickable "x")
}; 
$('.timepicker').wickedpicker(options);
});

</script>
			<div class="box_input">
				<input type="text" name="timepicker" class="timepicker">
			</div>

</body>
</html>