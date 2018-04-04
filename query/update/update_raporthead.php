<?php

	require_once '../../include/login.php';
	require_once '../../include/function.php';
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if (!$result);
		
	$row = $result->fetch_assoc();
	
	$id_raport_head = $row["id_raport_head"];
	
	$result->free_result();

	$query = "DELETE FROM help_user_raport where id_raport_head=$id_raport_head";
	$result = $conn->query($query);

	$date = $_POST['date2'];
	$time_start = $_POST['star_rap2'];
	$time_end = $_POST['end_rap2'];
	
	$query = "SELECT count(*) AS num_users FROM USERS where active=0";
	$result = $conn->query($query);
	if (!$result);
		
	$row = $result->fetch_assoc();
	
	$num_users = $row["num_users"] + 1;
	
	$result->free_result();
	
	$z=1;
	
	for($i=1;$i < $num_users; $i++) {
		if(isset($_POST['wychowawca2'.$i])){
			$id_user[$z] = $_POST['wychowawca2'.$i];
			$user_work_time[$z] = "(" . substr($_POST['start2'.$i],0,5) . "-" . substr($_POST['end2'.$i],0,5) . ")";
			$z++;
		}
	}
 	
	$b=$z-1;
	
	for($b=1;$b<$z;$b++) {
			
		$query_temp = "INSERT INTO help_user_raport (id_raport_head, id_user, hour_work) values (?,?,?)";
		
		$stmt = $conn->prepare($query_temp);
		
		$stmt->bind_param('iis', $id_raport_head, $id_user[$b], $user_work_time[$b]);
		
		$result = $stmt->execute();

		$stmt->close();
		
	}
	
	$query1 = "UPDATE RAPORT_HEAD SET date_rap='$date', time_start='$time_start', time_end='$time_end' where id_raport_head=$id_raport_head";
	$result = $conn->query($query1);
	
// 	if ($conn->query($query1) === TRUE) {
//     echo "Record updated successfully";
// 	} else {
//     echo "Error updating record: " . $conn->error;
// 	}	
	
		
	$conn->close();
	
header('Location: ../../raport.php');
?>