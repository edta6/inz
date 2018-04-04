<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
		$id_raport_head = $_POST['id_raport_head'];	
		
		$query = "SELECT date_hour, wpis FROM RAPORT where id_raport_head=$id_raport_head";
		$result = $conn->query($query);
		if(!$result) echo "ok";
		
		while ($row = $result->fetch_assoc()) {
			
			$temp = $row['date_hour'];
			$mess = $row['wpis'];
			
			echo "<tr>
						<th class=\"wpis_arch_col1\">$temp</th>
						<th class=\"wpis_arch_col2\">$mess</th>
						</tr>";
		}

	$result->free_result();
	$conn->close();
	
?>
