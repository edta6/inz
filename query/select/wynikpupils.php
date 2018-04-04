<?php
	
	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT p.id_pupil, p.first_name as pupil_first_name, p.last_name as pupil_last_name, p.active, p.date_add, p.date_out, u.first_name, u.last_name FROM PUPILS p join USERS u on p.id_user=u.id_user";
	
	$result = $conn->query($query);
			
	if (!$result) {
		
		echo '<span style="color:white">Instrukcja nie powiodła się!<br>'. $conn->error . '<br></span>';
		
	}
	else {
	
	echo "<table id=\"users_body\">";
	
	$flag_year=0;
	
	while ($row = $result->fetch_assoc()) 
		{
			
			if($row["active"]==1){
				$active="Nieaktywny";
			}
			else {
				$active="Aktywny";
			}
			
			$id = floor($row["id_pupil"]/10);
			
			$year = substr((string) $id,0,4);
			
			$lp = (int) substr((string) $id,5,7);
			
			if($year_old!=$year) $flag_year=0;
			
			if($flag_year==0) {
				$str_year="<tr><th class=\"row_year\" colspan=\"6\">Rok: $year</th></tr>";
				$year_old=$year;
				$flag_year=1;
			}
			else {
				$str_year="";
			}
			
			echo $str_year . "<tr><th class=\"pupils_h_col1\">" . $lp .
			 "</th><th class=\"pupils_h_col2\">" .$row["pupil_last_name"]. " " .$row["pupil_first_name"].
			 "</th><th classs=\"pupils_h_col2\">" .$row["last_name"]. " " .$row["first_name"].
			 "</th><th class=\"pupils_h_col3\">".$row["date_add"].
			 "</th><th class=\"pupils_h_col3\">
			 <form action=\"query/update/update_pupil.php\" method=\"post\">
			 <input type=\"hidden\" name=\"update\" value=\"yes\">
			 <input type=\"hidden\" name=\"rok\" value=\"".$year."\">
			 <input type=\"hidden\" name=\"lp\" value=\"".$lp."\">
			 <input id=\"".$active."\" class=\"tab_user_input\" type=\"submit\" name=\"active\" value=\"".$active."\">
			 </form>
			 </th><th class=\"pupils_h_col3\">".$row["date_out"].
			 "</th></tr>";
		
		$year_old=$year;
		}
	
	echo "</table>";
	}
	
	$result->free_result();
	$conn->close();
	
?>
