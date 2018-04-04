<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';

	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");

// ---------------------------------------------	
//Sprawdzenie poprawności danych	

	$target_name = $_POST['target'];
	$acitve = 1;

// --------------------------------------------

	$query = "INSERT INTO TARGET (target_name, active) VALUES (\"$target_name\", $acitve)";

	$conn->query($query);

// 	$stmt = $conn->prepare($query);

// 	$stmt->bind_param('ss', $target_name, $active);

// 	$result = $stmt->execute();

// 	$stmt->close();

	$conn->close();

 	header('Location: ../../target.php');

?>
