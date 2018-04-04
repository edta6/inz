<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	
	$query = "SELECT first_name, last_name FROM USERS where active=0 ORDER BY last_name";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	
	echo "<option value=\"wybierz\">Wybierz</option>";
	
	while ($row = $result->fetch_assoc()) 
		{
		
		$temp = $row["last_name"] . " " . $row["first_name"];
		
		echo "<option value=\"$temp\">$temp</option>";
		
		}
	
	$conn->close();
?>
