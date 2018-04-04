<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT id_raport_head FROM RAPORT_HEAD where end_raport=0";
	$result = $conn->query($query);
	if(!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	$row = $result->fetch_assoc();
	
	if($row != '') {
		
		$id_raport_head = $row['id_raport_head'];	
		
		$result->free_result();
		
		$query = "SELECT id_raport_data, date_hour, wpis, deleted FROM RAPORT where id_raport_head=$id_raport_head Order by deleted, date_hour";
		$result = $conn->query($query);
		if(!$result);
		
		while ($row = $result->fetch_assoc()) {
			
			$temp = $row['date_hour'];
			$mess = $row['wpis'];
			$id_wpis = $row['id_raport_data'];
			
			if($row['deleted']==1){
				$del="Przywróć";
			}
			else {
				$del="Usuń";
			}
			
			echo "<tr id=\"$id_wpis\">
						<th class=\"wpis_col1\">$temp</th>
						<th class=\"wpis_col2\">$mess</th>
						<th class=\"wpis_col3\">
						<form action=\"query/update/update_wpis.php\" method=\"post\">
						<input type=\"hidden\" name=\"update\" value=\"yes\">
						<input type=\"hidden\" name=\"id_wpis\" value=\"" . $id_wpis . "\">
						<input id=\"".$del."\" class=\"wpis_user_input tab_user_input\" type=\"submit\" name=\"del\" value=\"".$del."\">
						</form>
						</th>
						</tr>";
		}
	}
	else {
	
	}
	
	$result->free_result();
	$conn->close();
	
?>
