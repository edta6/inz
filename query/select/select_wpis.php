<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if(!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	$row = $result->fetch_assoc();
	
	$id_raport_head = $row['id_raport_head'];	
		
	$result->free_result();

	$query = "SELECT id_raport_data, wpis FROM RAPORT where id_raport_head=$id_raport_head";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	echo "<option style=\"display: none;\" value=\"wybierz\">Wybierz</option>";
	
	$i=1;
	while ($row = $result->fetch_assoc()) 
		{
		
		$temp = substr($row['wpis'],0, 25);
		
		$id = $row["id_raport_data"];

		echo "<option value=\"$id\">$temp</option>";
		
		$i++;
		
		}
	
	$conn->close();
?>
