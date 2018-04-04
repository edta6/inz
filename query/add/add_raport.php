<?php
		
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	$row = $result->fetch_assoc();
	
	$id_raport_head = $row['id_raport_head'];	
	
	$result->free_result();
//---------------------------------------------------------------------------------
	
	$query = "SELECT IFNULL(max(lp_wpis),0) as lp_wpis FROM RAPORT where id_raport_head=$id_raport_head";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	$row = $result->fetch_assoc();
	
	$lp_wpis = $row['lp_wpis'];
	
	$result->free_result();

	$id_raport_data = $id_raport_head . "_" . ($lp_wpis+1); 
	$lp_wpis=$lp_wpis+1;

	$time_wpis = $_POST['raport_wpis_time'];
	
	$mess_wpis = $_POST['raport_wpis_mess'];
	
	$query = "INSERT INTO RAPORT (id_raport_data, id_raport_head, date_hour, wpis, accept, deleted, lp_wpis)
						VALUES ('$id_raport_data',$id_raport_head,'$time_wpis','$mess_wpis',0,0, $lp_wpis)";
	$result = $conn->query($query);
	
	$conn->close();
		
	header('Location: ../../raport.php');
	
?>