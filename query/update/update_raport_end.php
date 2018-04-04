<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if (!$result);
		
	$row = $result->fetch_assoc();
	
	$id_raport_head = $row["id_raport_head"];
	
	$result->free_result();

	$query1 = "UPDATE RAPORT_HEAD SET end_raport=1 where id_raport_head=$id_raport_head";
	$result = $conn->query($query1);
	
	$conn->close();
	
	header('Location: ../../raport.php');
?>