<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT p.id_pupil, p.first_name, p.last_name FROM PUPILS p LEFT JOIN help_retexi_out h on p.id_pupil=h.id_pupil where p.active=0 and h.id_retexi is NULL";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	echo "<option style=\"display: none;\" value=\"wybierz\">Wybierz</option>";
	
	while ($row = $result->fetch_assoc()) 
		{
		
		$id = $row["id_pupil"];
		$temp = $row["last_name"] . " " . $row["first_name"];
		
		echo "<option value=\"$id\">$temp</option>";
		
		}
	
	$result->free_result();
	
	$conn->close();
?>
