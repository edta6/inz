<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$akt = "Usuń";
	$nkt = "Przywróć";

	$del = $_POST['del'];
	$id_wpis = $_POST['id_wpis'];
	
	if( strcmp($akt, $del) == 0){
				$temp = 1;
	}
	else {
				$temp = 0;
	}

	$query = "UPDATE RAPORT SET deleted=$temp where id_raport_data='$id_wpis'";
	$result = $conn->query($query);

/*	if ($conn->query($query) === TRUE) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . $conn->error;
	}	*/	

	$conn->close();
	
	header('Location: ../../raport.php');
?>