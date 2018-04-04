<!--
Funkcja, która ma za zadanie zmienić status
użytkownika systemu jak i rolę jaki w tym systemie ma pełnić.
-->
<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	
	if ($conn->connect_error) die($conn->connect_error);
	
	$akt = "Aktywny";
	$nkt = "Nieaktywny";
	
	if(isset($_POST['rok']) && isset($_POST['lp'])) {
	
		$rok = $_POST['rok'];
		$lp = $_POST['lp'];
	
		$id=GenReturnId($rok, $lp, 0);
		
		if(isset($_POST['active'])) {
			
			$act = $_POST['active'];
			
			if( strcmp($akt, $act) == 0){
				$temp = 1;
				
				$temp_data="date_out='". date("Y-m-d"). "'";
			}
			else if ( strcmp($nkt, $act) == 0) {
				$temp = 0;
				$temp_data="date_out=NULL";
			}
			else {
// Tutaj błąd jeżeli nie będzie pozytywnych wyników wcześniejszych warunków
			}
	
	
			$query = "UPDATE PUPILS SET active='$temp', $temp_data where id_pupil='$id'";
			$result = $conn->query($query);
			if (!$result) echo "Instrukcja UPDATE nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		}
		
	}
	
	$conn->close();
	
	header('Location: ../../pupils.php');
?>