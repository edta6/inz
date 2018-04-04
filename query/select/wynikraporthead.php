<?php

// 	require_once '../../include/login.php';
	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");

	$query = "SELECT id_raport_head, date_rap, time_start, time_end, stan, exit_ok, exit_bad 
						FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	$row = $result->fetch_assoc();

	if($row != '') {

		$_POST['dis'] = "disabled";
		$_POST['eddis'] = "";
		$_POST['date_rap'] = $row['date_rap'];
		$_POST['time_start'] = substr($row['time_start'],0,5);
		$_POST['time_end'] = substr($row['time_end'],0,5);
		$_POST['stan'] = $row['stan'];
		$_POST['exit_ok'] = $row['exit_ok'] - $row['exit_bad'];
		$_POST['exit_bad'] = $row['exit_bad'];
		$_POST['obecni'] = $row['stan'] - $row['exit_ok'];
		$_POST['id_raport_head'] = $row['id_raport_head'];
		
		$result->free_result();
		
// Zapytanie odnośnie wychowawców na dyżurze
// ----------------------------------	
		$query_wych = "SELECT u.first_name, u.last_name, h.hour_work FROM USERS u join help_user_raport h 
									 on u.id_user=h.id_user where h.id_raport_head=" . $_POST['id_raport_head'];
		$result = $conn->query($query_wych);
		if (!$result);
   	
		$temp = "";
		
		while ($row = $result->fetch_assoc()) {
			
			$temp = $temp . $row['last_name'] . " " . $row['first_name'] . " " . $row['hour_work'] . ", ";
			
		}
		
		$_POST['wychowawcy'] = substr($temp,0,-2);
		
//Zapytanie odnośnie uciekinierów
//--------------------------------------------------------	
		$query_wych = "SELECT u.first_name, u.last_name FROM PUPILS u join help_pupil_raport h on 
									 u.id_pupil=h.id_pupil where h.id_raport_head=".$_POST['id_raport_head'].
									 " and h.end_escape=0";
		$result = $conn->query($query_wych);
		if (!$result);
		
		$temp1 = "";
		
		while ($row = $result->fetch_assoc()) {
			
			$temp1 = $temp1 . $row['last_name'] . " " . $row['first_name'] . ", ";
			
		}
		
		$_POST['exit_bad_name'] = substr($temp1,0,-2);
		
	}
	else {
		
		$_POST['dis'] = "";
		$_POST['eddis'] = "disabled";
		$_POST['date_rap'] = "";
		$_POST['time_start'] = "";
		$_POST['time_end'] = "";
		$_POST['stan'] = "";
		$_POST['exit_ok'] = "";
		$_POST['exit_bad'] = "";
		$_POST['obecni'] = "";
		$_POST['id_raport_head'] = "";
		
	}
	
	$conn->close();

?>