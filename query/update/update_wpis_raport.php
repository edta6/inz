<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");

	$time_wpis = $_POST['raport_wpis_time2'];
	$mess_wpis = $_POST['raport_wpis_mess2'];
	$id_wpis = $_POST['sel_wpis'];
	
	$query = "UPDATE RAPORT SET wpis='$mess_wpis', date_hour='$time_wpis' where id_raport_data='$id_wpis'";
	$result = $conn->query($query);

/*	if ($conn->query($query) === TRUE) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . $conn->error;
	}	*/	

	$conn->close();
	
	header('Location: ../../raport.php');
?>