<?php
	
	session_start();
	
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	
	if(isset($_POST['timepicker3'])){
		$time = $_POST['timepicker3'];
		$datetime = substr($time,0,2) .":". substr($time,5,2);
	}
	
	$uwagi = $_POST['message'];
	
	if(isset($_POST['active'])){
		
		$active = $_POST['active'];
		
		if(preg_match("/^active/", $active)) {
			$activenum=0;
		}
		else {
			$activenum=1;
		}
	}
	
// --------------------------------------------
	$query = "INSERT INTO help_raport (date_hour,wpis,active) VALUES (?,?,?)";
	
	$stmt = $conn->prepare($query);

	$stmt->bind_param('ssi', $datetime, $uwagi, $activenum);

	$result = $stmt->execute();

	$stmt->close();

	$conn->close();
	
	header('Location: ../../raptemp.php');
	
?>