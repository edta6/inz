<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if (!$result);
		
	$row = $result->fetch_assoc();
	
	$id_raport_head = $row["id_raport_head"];
	
	$result->free_result();
	
	$query = "SELECT id_user, first_name, last_name FROM USERS where active=0 ORDER BY last_name";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	$i=1;
	
	while ($row = $result->fetch_assoc()) 
		{
		
		$name= "wychowawca2" . $i;
		$time_start = "start2" . $i;
		$time_end = "end2" . $i;
		
		$id = $row["id_user"];
		$temp = $row["last_name"] . " " . $row["first_name"];
		
		$query2 = "SELECT hour_work FROM help_user_raport where id_user=$id and id_raport_head=$id_raport_head";
		$result2 = $conn->query($query2);
		if (!$result2) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

		$row2 = $result2->fetch_assoc();

		$hour_temp = $row2['hour_work'];
		
		$time_star_hour = substr($hour_temp,1,5);
		$time_end_hour = substr($hour_temp,7,-1);
		
		if($hour_temp != "") {
			echo
				"<div class=\"box_rap_one_user\">
					<div class=\"box_input_rap_wew\">
						<input class=\"box_check\" type=\"checkbox\" name=\"$name\" value=\"$id\" checked>
						<p>$temp</p>
					</div>
					<input type=\"text\" name=\"$time_start\" value=\"$time_star_hour\" class=\"timepicker box_time\" onclick=\"time_raport_start()\">
					<input type=\"text\" name=\"$time_end\" value=\"$time_end_hour\" class=\"timepicker box_time\" onclick=\"time_raport_start()\">
				</div>";
		}
		else {
		echo
		"<div class=\"box_rap_one_user\">
					<div class=\"box_input_rap_wew\">
						<input class=\"box_check\" type=\"checkbox\" name=\"$name\" value=\"$id\">
						<p>$temp</p>
					</div>
					<input type=\"text\" name=\"$time_start\" class=\"timepicker box_time\" onclick=\"time_raport_start()\">
					<input type=\"text\" name=\"$time_end\"class=\"timepicker box_time\" onclick=\"time_raport_start()\">
				</div>";
		}
		
		$i++;
					
		}
	
	$conn->close();
?>
