<?php
	
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
// ---------------------------------------------	
//Sprawdzenie poprawności danych	
	
	$idwoj = $_POST['idwoj'];
	$sym = $_POST['sym'];
	$nazwa = $_POST['nazwa'];
	
// --------------------------------------------
	
	$query_3 = "DELETE FROM PLACE where sym='$sym' and wojewodztwo='$idwoj' LIMIT 1";
		
	$conn -> query($query_3);
		
	$conn->close();
	
	header('Location: ../../miejscowosci.php');
	
?>
