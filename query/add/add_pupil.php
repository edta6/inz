<?php
	
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
// ---------------------------------------------	
//Sprawdzenie poprawności danych	
	
	$validationFlag = true;
	
	$pattern1 = "([^A-Za-z]+)";
	$replacement_blank = "";
// ---------------------------------------------		
	if(isset($_POST['imie'])) {
	
		$name = ucfirst(strtolower($_POST['imie']));
		$name = preg_replace($pattern1, $replacement_blank, $name);
		
		if ((strlen($name)<3) || (strlen($name)>28)) {
 			$validationFlag=false;
		}
	}
	else {
		$validationFlag=false;
	}
	
// ---------------------------------------------		
	if(isset($_POST['nazwisko'])) {
	
		if(strlen($_POST['nazwisko'])<29 && !preg_match("/\-/", $_POST['nazwisko'])) {
		
			$nazwisko = ucfirst(strtolower($_POST['nazwisko']));
			$nazwisko = preg_replace($pattern1, $replacement_blank, $nazwisko);
			
			if ((strlen($nazwisko)<3) || (strlen($nazwisko)>28))
			{
				$validationFlag=false;
			}
		}
		else {
			// Opracować validację dwuczłonowego nazwiska!
			$nazwisko = $_POST['nazwisko'];
			
		}
	}
	else {
			$validationFlag=false;
	}
	
// ---------------------------------------------		
	if(isset($_POST['users'])) {
		
		$full_name = $_POST['users'];
		
		$last_name = substr($full_name,0,strpos($full_name," "));
		
		$first_name = substr($full_name,strpos($full_name," ")+1,strlen($full_name));
		
	}
	
	$query_1="SELECT id_user FROM USERS WHERE first_name='$first_name' AND last_name='$last_name'";
	
	$result = $conn->query($query_1);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query_1<br>" . $conn->error . "<br><br>";
	
	$row = $result->fetch_assoc();

	$id_user = $row["id_user"];
	
	
// ---------------------------------------------	
	if(isset($_POST['active'])){
		
		$active = $_POST['active'];
		
		if(preg_match("/^active/", $active)) {
			$activenum=0;
		}
		else if(preg_match("/^inactive/", $active)) {
			$activenum=1;
		}
		else {
			$validationFlag=false;
		}
	}
	else {
		$validationFlag=false;
	}
 
// 	Generuje ID dla tabeli PUPILS;
	$query_2 = "SELECT IFNULL(max(id_pupil),0) AS id FROM PUPILS";
	$result = $conn->query($query_2);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query_2<br>" . $conn->error . "<br><br>";
	
	$row = $result->fetch_assoc();
	
	$id = GenId($row["id"],0);
	
// --------------------------------------------
	
	$query_3 = "INSERT INTO PUPILS (id_pupil, first_name, last_name, id_user, active, date_add) VALUES (?,?,?,?,?,?)";
		
	$stmta = $conn->prepare($query_3);
	
	$stmta->bind_param('issiis', $id, $name, $nazwisko, $id_user, $activenum, date("Y-m-d"));
	
	$result = $stmta->execute();

	$stmta->close();
		
	$conn->close();
	
	header('Location: ../../pupils.php');
	
?>
