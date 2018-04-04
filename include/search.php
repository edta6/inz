<?php

	require_once '/login.php';
	
		echo "ok-2";
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	echo "ok-1";

	$term = $_GET['term'];
	$extraVar = $_GET['extraParams'];
	
	echo "ok";
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");

	echo "ok1"

// 	$query = "SELECT wpis FROM help_raport where wpis like '%".$searchTerm."%'" ;
	$query = "SELECT wpis FROM help_raport where wpis like '%a%'" ;
	$result = $conn->query($query);
	
	while ($row = $query->fetch_assoc()) {
		$data[] = $row['wpis'];
	}
    
	
	echo json_encode(array_unique($data));

	echo "ok2";
	
	$conn->close();
?>
