<?php
		
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
//Odpowiada za stworzenie nowego id dla użytkownika 

// SELECT IFNULL(max(id_user),0) AS id FROM USERS WHERE id_user<10190000;

	$query = "SELECT IFNULL(max(id_user),0) AS id FROM USERS";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	$row = $result->fetch_assoc();
	
	$id = GenId($row["id"],1000);



//---------------------------------------------	

//Sprawdzenie poprawności danych

	$validationFlag = true;
	
	$pattern1 = "([^A-Za-z]+)";
	$pattern2 = "([^A-Za-z0-9]+)";
	$replacement_blank = "";
	
	if(isset($_POST['imie'])) {
	
		$name = ucfirst(strtolower($_POST['imie']));
		$name = preg_replace($pattern1, $replacement_blank, $name);
		
		if ((strlen($name)<3) || (strlen($name)>28))
		{
 			$validationFlag=false;
		}
	}
	else {
			$validationFlag=false;
	}
	
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
	
	if(isset($_POST['nick'])) {
		
		$nick = strtolower($_POST['nick']);
		$nick = preg_replace($pattern2, $replacement_blank, $nick);
	}
	else {
		$validationFlag=false;
	}
	
	if(isset($_POST['pass']) && isset($_POST['pass_re'])) {
	
		$haslo1 = $_POST['pass'];
		$haslo2 = $_POST['pass_re'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20)) {
			$validationFlag=false;
		}
		
		if ($haslo1!=$haslo2) {
			$validationFlag=false;
		}
		
			$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
	}
	else {
		$validationFlag=false;
	}
		
	if(isset($_POST['role'])){
		
		$role = $_POST['role'];
		
		if(preg_match("/^zwykly/", $role)) {
			$rolenum=0;
		}
		else if(preg_match("/^admin/", $role)) {
			$rolenum=1;
		}
		else {
			$validationFlag=false;
		}
	}
	else {
		$validationFlag=false;
	}
	
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

// --------------------------------------------
	
	$query2 = "INSERT INTO USERS (id_user, first_name, last_name, nick, pass, role, active) VALUES (?,?,?,?,?,?,?)";
		
	$stmt = $conn->prepare($query2);
		
	$stmt->bind_param('issssii', $id, $name, $nazwisko, $nick, $haslo_hash, $rolenum, $activenum);
		
	$result = $stmt->execute();

	$stmt->close();
		
	$conn->close();
	
	header('Location: ../../users.php');
	
?>
