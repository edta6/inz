<?php
		
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
// Zapytanie zwraca liczbę aktywnych użytkowników.
// -----------------------------------
	$query = "SELECT count(*) AS num_users FROM USERS where active=0";
	$result = $conn->query($query);
	if (!$result);
	
	$row = $result->fetch_assoc();
	
	$num_users = $row["num_users"] + 1;
	
	$result->free_result();

// Tworzenie id dla raportu. 
// -------------------------------------------------------------
	$date_rap = $_POST['date'];
	$time_start = $_POST['star_rap'];
	$time_end = $_POST['end_rap'];
	
	$pattern1 = "([^1-9]+)";
	$replacement_blank = "";
	
	$temp2 = $date_rap . $time_start . $time_end;
	
	$id_head2 = preg_replace($pattern1, $replacement_blank, $temp2);

	$id_head = (int)$id_head2; 
	
// Pobieranie danych ilu jest wychowawców.
// ------------------------------------------	
	$z=1;
	
	for($i=1;$i < $num_users; $i++) {
		if(isset($_POST['wychowawca'.$i])){
			$id_user[$z] = $_POST['wychowawca'.$i];
			$user_work_time[$z] = "(" . substr($_POST['start'.$i],0,5) . "-" . substr($_POST['end2'.$i],0,5) . ")";
			$z++;
		}
	}
	
//	Dodanie rekordu do tabeli RAPORT_HEAD - Zapytania pomocnicze.
// -----------------------------------------------	
	
	$query1 = "SELECT count(*) AS stan FROM PUPILS where active=0";
	$result = $conn->query($query1);
	if (!$result);
	
	$row = $result->fetch_assoc();
	
	$stan = $row["stan"];
	
	$result->free_result();
		
	$query2 = "SELECT count(*) AS pup_exit FROM help_retexi_out";
	$result = $conn->query($query2);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query2<br>" . $conn->error . "<br><br>";
	
	$row = $result->fetch_assoc();
	
	$exit = $row["pup_exit"];
	
	$result->free_result();	
	
	$query3 = "SELECT count(*) AS pup_exit_bad FROM help_pupil_raport where end_escape=0";
	$result = $conn->query($query3);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query2<br>" . $conn->error . "<br><br>";
	
	$row = $result->fetch_assoc();
	
	$exit_bad = $row["pup_exit_bad"];
	
	$result->free_result();	
		
// wykonanie Insert into 
// ----------------------------------------	
	
	$a = 0;	
	$b=$z-1;
	
	$query4 = "INSERT INTO RAPORT_HEAD (id_raport_head, stan, exit_ok, exit_bad, many_users, end_raport, date_rap, time_start, time_end) VALUES (?,?,?,?,?,?,?,?,?)";
	
	$stmt = $conn->prepare($query4);
		
	$stmt->bind_param('iiiiiisss', $id_head, $stan, $exit, $exit_bad, $b, $a, $date_rap, $time_start, $time_end);
		
	$result = $stmt->execute();

	$stmt->close();
		
	for($b=1;$b<$z;$b++) {
	
		$query_temp = "INSERT INTO help_user_raport (id_raport_head, id_user, hour_work) values (?,?,?)";
		
		$stmt = $conn->prepare($query_temp);
		
		$stmt->bind_param('iis', $id_head, $id_user[$b], $user_work_time[$b]);
		
		$result = $stmt->execute();

		$stmt->close();
		
	}
		
	$conn->close();
		
header('Location: ../../raport.php');
	
?>