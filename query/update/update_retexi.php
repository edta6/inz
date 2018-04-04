<?php

	session_start();

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$id_retexi = $_POST['pupils_back'];
	$id_user = $_SESSION['id_user'];
	
	if(isset($_POST['change_time2'])){
		$time = $_POST['timepicker2'];
		$datetime = date("Y-m-d") . " " . substr($time,0,2) .":". substr($time,5,2) .":00";
	}
	else {
		$datetime = date("Y-m-d H:i:s");
	}
	
	$uwagi = $_POST['message'];
	
	$query = "UPDATE RETEXI SET date_ret='$datetime', id_user_ret=$id_user where id_retexi='$id_retexi'";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja UPDATE nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	

// Procedura uaktualniania danych w raporcie
//--------------------------------------------------------------
	$query1 = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query1);
	
	$row = $result->fetch_assoc();

	$id_raport_head = $row['id_raport_head'];
	
	
	$result->free_result();
	
	$query2 = "SELECT count(*) as ile FROM help_retexi_out";
	$result = $conn->query($query2);
	
	$row = $result->fetch_assoc();

	$ile = $row['ile'];
	
	$result->free_result();

	$query3 = "UPDATE RAPORT_HEAD SET exit_ok=$ile where id_raport_head=$id_raport_head";
	$result = $conn->query($query3);
	
	$query4 = "SELECT count(*) as ile FROM help_pupil_raport where id_retexi=$id_retexi";
	$result = $conn->query($query4);

	$row = $result->fetch_assoc();

	$ile_bad = $row['ile'];
	
	$result->free_result();

	if($ile_bad == 1) {
	
		$query5 = "UPDATE help_pupil_raport set end_escape=1 where id_retexi=$id_retexi";
		$result = $conn->query($query5);

		$query6 = "SELECT count(*) as ile FROM help_pupil_raport where id_raport_head=$id_raport_head and end_escape=0";
		$result = $conn->query($query6);
		
		$row = $result->fetch_assoc();
		
		$ile_bad2 = $row['ile'];
		
		$result->free_result();

		$query8 = "UPDATE RAPORT_HEAD SET exit_bad=$ile_bad2 where id_raport_head=$id_raport_head";
		$result = $conn->query($query8);

	}


  $conn->close();
	
	header('Location: ../../main_page.php');
?>