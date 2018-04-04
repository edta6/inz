<?php

	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query = "SELECT w.nazwa as wojewodztwo, p.nazwa FROM PLACE p INNER JOIN teryt_terc w on w.wojewodztwo=p.wojewodztwo and w.powiat like '' order by w.nazwa";
		
	$result = $conn->query($query);
	
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	$i=1;
	$flag=0;
	$woj_old="NULL";
		
	while ($row = $result->fetch_assoc()) 
		{
			$woj = $row["wojewodztwo"];
			
			if((strcmp($woj_old,$woj)!=0) && $woj_old!="NULL") {
				$flag=0;
				echo "</p>";
			}
			
			if($flag==0) {
				printf ("<p class=\"woj\">%s. %s</p>",$i,$row["wojewodztwo"]);
				$temp = "<p class=\"miejsc\">";
				$woj_old=$woj;
				$flag=1;
				$i++;
			}
			else
			{
				$temp=", ";
			}
			
			echo $temp . $row["nazwa"];
			
			$woj_old=$woj;
		}
	
	$result->free_result();
	$conn->close();
?>
