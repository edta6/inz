<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT * FROM help_raport";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		
	echo "<table id=\"users_body\">";

	while ($row = $result->fetch_assoc()) 
		{
		
			if($row["active"]==1){
				$active="Nieaktywny";
			}
			else {
				$active="Aktywny";
			}
			
			echo "<tr><th class=\"raptemp_col1\">" . $row["id_help_raport"] .
			 "</th><th class=\"raptemp_col2\">" . $row["date_hour"].
			 "</th><th class=\"raptemp_col3\">" .$row["wpis"]. 
			 "</th><th class=\"raptemp_col2\">
			 <form action=\"query/update/update_user.php\" method=\"post\">
			 <input type=\"hidden\" name=\"update\" value=\"yes\">
			 <input type=\"hidden\" name=\"lp\" value=\"". $row['id_help_raport'] ."\">
			 <input id=\"".$active."\" class=\"tab_user_input\" type=\"submit\" name=\"active\" value=\"".$active."\">
			 </form>
			 </th></tr>";
		
		}
	
	echo "</table>";
	
	$result->free_result();

	$conn->close();
	
?>
