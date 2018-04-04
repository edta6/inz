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
	
	$query_3 = "INSERT INTO PLACE (wojewodztwo, sym, nazwa) VALUES (?,?,?)";
		
	$stmt = $conn->prepare($query_3);
		
	$stmt->bind_param('sss', $idwoj, $sym, $nazwa);
		
	$result = $stmt->execute();

	$stmt->close();
		
	$conn->close();
	
	header('Location: ../../miejscowosci.php');
	
?>
