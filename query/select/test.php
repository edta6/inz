<?php

	session_start();
	
	$_SESSION['block'] = $_POST['block'];
	
	$_SESSION['kto'] = $_POST['kto'];
	
	$_SESSION['back_id'] = $_POST['back_id'];
	
	$_SESSION['actual_id'] = $_POST['actual_id'];
	
	$_SESSION['next_id'] = $_POST['next_id'];
	
	header('Location: ../../raportarchiwum.php');
	
?>
