<?php
	
	session_start();
	
	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$pupil = $_POST['pupils'];
	$target = $_POST['targets'];
	$place = $_POST['place'];
	$id_user = $_SESSION['id_user'];
	
	if(isset($_POST['change_time'])){
		$time = $_POST['timepicker'];
		$datetime = date("Y-m-d") . " " . substr($time,0,2) .":". substr($time,5,2) .":00";
	}
	else {
		$datetime = date("Y-m-d H:i:s");
	}
	
	$uwagi = $_POST['message'];
	
// --------------------------------------------
	$query = "INSERT INTO RETEXI (id_pupil,id_target,id_place,id_user_exi,date_exi,comments) VALUES (?,?,?,?,?,?)";
			
	$stmt = $conn->prepare($query);

	$stmt->bind_param('iisiss', $pupil, $target, $place, $id_user, $datetime, $uwagi);

	$result = $stmt->execute();
	
	$stmt->close();

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
	
// 		if ($conn->query($query3) === TRUE) {
//     echo "Record updated successfully";
// 	} else {
//     echo "Error updating record: " . $conn->error;
// 	}	

	$query4 = "SELECT target_name FROM TARGET where id_target=$target";
	$result = $conn->query($query4);

	$row = $result->fetch_assoc();

	$target_name = $row['target_name'];
	
	$result->free_result();
	
	if($target_name == "ucieczka") {
	
		$query5 = "SELECT id_retexi FROM RETEXI where id_pupil=$pupil and date_ret is null";
		$result = $conn->query($query5);

		$row = $result->fetch_assoc();

		$id_retexi = $row['id_retexi'];
		
		$result->free_result();
		
		$query6 = "INSERT INTO help_pupil_raport (id_pupil, id_raport_head, id_retexi, end_escape) 
							VALUES ($pupil, $id_raport_head, $id_retexi, 0)";
		$result = $conn->query($query6);
		
		$query7 = "SELECT count(*) as ile FROM help_pupil_raport where id_raport_head=$id_raport_head and end_escape=0";
		$result = $conn->query($query7);
		
		$row = $result->fetch_assoc();
		
		$ile_bad = $row['ile'];
		
		$result->free_result();
		
		$query8 = "UPDATE RAPORT_HEAD SET exit_bad=$ile_bad where id_raport_head=$id_raport_head";
		$result = $conn->query($query8);

	}

	$conn->close();
	
	header('Location: ../../main_page.php');
	
?>