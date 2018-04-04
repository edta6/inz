<!--
Funkcja, która ma za zadanie zmienić status
użytkownika systemu jak i rolę jaki w tym systemie ma pełnić.
-->
<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	
	if ($conn->connect_error) die($conn->connect_error);
	
	$adm = "Administrator";
	$zkw = "Zwykły";
	$akt = "Aktywny";
	$nkt = "Nieaktywny";
	
	if(isset($_POST['rok']) && isset($_POST['lp'])) {
	
		$rok = $_POST['rok'];
		$lp = $_POST['lp'];
	
		$id=GenReturnId($rok, $lp, 1000);

		// Dopisać walidator ID jak nie przejdzie to wyrzucić błąd oraz zrobić zapytanie czy takie id jest?

		if(isset($_POST['role'])) {
			
			$role = $_POST['role'];
			
			if( strcmp($adm, $role) == 0){
				$temp = 0;
			}
			else if ( strcmp($zkw, $role) == 0) {
				$temp = 1;
			}
			else {
// Tutaj błąd jeżeli nie będzie pozytywnych wyników wcześniejszych warunków
			}
	
			$query = "UPDATE USERS SET role='$temp' where id_user='$id'";
			$result = $conn->query($query);
			if (!$result) echo "Instrukcja UPDATE nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		}
		
		if(isset($_POST['active'])) {
			
			$act = $_POST['active'];
			
			if( strcmp($akt, $act) == 0){
				$temp = 1;
			}
			else if ( strcmp($nkt, $act) == 0) {
				$temp = 0;
			}
			else {
// Tutaj błąd jeżeli nie będzie pozytywnych wyników wcześniejszych warunków
			}
	
			$query = "UPDATE USERS SET active='$temp' where id_user='$id'";
			$result = $conn->query($query);
			if (!$result) echo "Instrukcja UPDATE nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		}
		
	}
	
	$conn->close();
	
	header('Location: ../../users.php');
?>