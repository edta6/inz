<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT * FROM USERS";
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	
	echo "<table id=\"users_body\">";
	
	$flag_year=0;
	$year_old=0;
	
	while ($row = $result->fetch_assoc()) 
		{
		
			if($row["role"]==1){
				$role = "Administrator";
			}
			else {
				$role = "Zwykły";
			}
			
			if($row["active"]==1){
				$active="Nieaktywny";
			}
			else {
				$active="Aktywny";
			}
			
			$id = floor($row["id_user"]/10);
			
			$year = substr((string) $id,0,4) + 1000;
			
			$lp = (int) substr((string) $id,5,7);
			
			if($year_old!=$year) $flag_year=0;
			
			if($flag_year==0) {
				$str_year="<tr><th class=\"row_year\" colspan=\"5\">Rok: $year</th></tr>";
				$year_old=$year;
				$flag_year=1;
			}
			else {
				$str_year="";
			}
			
			echo $str_year . "<tr><th class=\"users_h_col1\">" . $lp .
			 "</th><th class=\"users_h_col2\">" .$row["last_name"]. " " .$row["first_name"].
			 "</th><th class=\"users_h_col3\">" .$row["nick"]. 
			 "</th><th class=\"users_h_col4\">
			 <form action=\"query/update/update_user.php\" method=\"post\">
			 <input type=\"hidden\" name=\"update\" value=\"yes\">
			 <input type=\"hidden\" name=\"rok\" value=\"".$year."\">
			 <input type=\"hidden\" name=\"lp\" value=\"".$lp."\">
			 <input class=\"tab_user_input\" type=\"submit\" name=\"role\" value=\"$role\">
			 </form>
			 </th><th class=\"users_h_col5\">
			 <form action=\"query/update/update_user.php\" method=\"post\">
			 <input type=\"hidden\" name=\"update\" value=\"yes\">
			 <input type=\"hidden\" name=\"rok\" value=\"".$year."\">
			 <input type=\"hidden\" name=\"lp\" value=\"".$lp."\">
			 <input id=\"".$active."\" class=\"tab_user_input\" type=\"submit\" name=\"active\" value=\"".$active."\">
			 </form>
			 </th></tr>";
		
		$year_old=$year;
		}
	
	echo "</table>";
	
	$result->free_result();
	$conn->close();
	
?>
