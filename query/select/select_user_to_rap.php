<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	
	$query = "SELECT id_user, first_name, last_name FROM USERS where active=0 ORDER BY last_name";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	$i=1;
	
	while ($row = $result->fetch_assoc()) 
		{
		
		$name= "wychowawca" . $i;
		$time_start = "start" . $i;
		$time_end = "end" . $i;
		
		$id = $row["id_user"];
		$temp = $row["last_name"] . " " . $row["first_name"];
		
		echo
		"<div class=\"box_rap_one_user\">
					<div class=\"box_input_rap_wew\">
						<input class=\"box_check\" type=\"checkbox\" name=\"$name\" value=\"$id\">
						<p>$temp</p>
					</div>
					<input type=\"text\" name=\"$time_start\" class=\"timepicker box_time\" onclick=\"time_raport_start()\">
					<input type=\"text\" name=\"$time_end\"class=\"timepicker box_time\" onclick=\"time_raport_start()\">
				</div>";
		
		$i++;
					
		}
	
	$conn->close();
?>
