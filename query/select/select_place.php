<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT sym, nazwa FROM PLACE";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	echo "<option style=\"display: none;\" value=\"wybierz\">Wybierz</option>";
	
	while ($row = $result->fetch_assoc()) 
		{
		
		$id = $row["sym"];
		$temp = $row["nazwa"];
		
		echo "<option value=\"$id\">$temp</option>";
		
		}
	
	$conn->close();
?>
