<?php

	include 'include/login.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$searchTerm = $_GET['term'];
	
	$query = "SELECT wpis FROM help_raport where wpis like '%".$searchTerm."%'" ;
	$result = $conn->query($query);
	
	while ($row = $result->fetch_assoc()) {
		$data[] = $row['wpis'];
	}
    
	echo json_encode(array_unique($data));
	
	$conn->close();
?>
