<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	
	if ($conn->connect_error) die($conn->connect_error);
	
	$akt = "Aktywny";
	$nkt = "Nieaktywny";
	
		if(isset($_POST['active']) && isset($_POST['id'])) {
			
			$act = $_POST['active'];
			$id = $_POST['id'];
			
			if( strcmp($akt, $act) == 0){
				$temp = 1;
			}
			else  {
				$temp = 0;
			}
			
			$query = "UPDATE TARGET SET active='$temp' where id_target='$id'";
			$result = $conn->query($query);
			if (!$result) echo "Instrukcja UPDATE nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		}

	$conn->close();

	header('Location: ../../target.php');
?>