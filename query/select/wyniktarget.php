<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");

	$query = "SELECT id_target, target_name, active FROM TARGET";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";

	echo "<table id=\"users_body\">";

	while ($row = $result->fetch_assoc()) {

		if($row["active"]==1){
				$active="Nieaktywny";
			}
		else {
				$active="Aktywny";
			}

			echo
			 "<tr><th class=\"pupils_h_col1\">" .  $row["id_target"] .
			 "</th><th class=\"pupils_h_col2\">" . $row["target_name"] .
			 "</th><th class=\"pupils_h_col3\">
 			 <form action=\"query/update/update_target.php\" method=\"post\">
 			 <input type=\"hidden\" name=\"update\" value=\"yes\">
 			 <input type=\"hidden\" name=\"id\" value=\"" . $row["id_target"] . "\">
 			 <input id=\"".$active."\" class=\"tab_user_input\" type=\"submit\" name=\"active\" value=\"".$active."\">
 			 </form>
 			 </th></tr>";
		}

	echo "</table>";

	$result->free_result();

	$conn->close();

?>