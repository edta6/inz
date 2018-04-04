<?php

// 	require_once '../../include/login.php';
	require_once 'include/login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$conn -> query("SET NAMES 'utf8'");
	
	$query1="SELECT count(*) as ile FROM RETEXI where deleted is null";
	$result = $conn->query($query1);

	$row = $result->fetch_assoc();

	$i = $row['ile'];
	
	$result->free_result();

// 	$query = "SELECT r.id_retexi, r.date_exi, r.date_ret, r.comments, 
// 									 p.first_name as pup_f_n, p.last_name as pup_l_n,
// 									 t.target_name, ter.nazwa,
// 									 u1.first_name as us_exi_f_n, u1.last_name as us_exi_l_n,
// 									 u2.first_name as us_ret_f_n, u2.last_name as us_ret_l_n
// 						FROM RETEXI r
// 						JOIN PUPILS p ON r.id_pupil=p.id_pupil
// 						JOIN TARGET t ON r.id_target=t.id_target
// 						JOIN teryt_simc ter on r.id_place=ter.sym
// 						JOIN USERS u1 on r.id_user_exi=u1.id_user
// 						JOIN USERS u2 on r.id_user_ret=u2.id_user
// 					 ";
	
	$query = "SELECT r.id_retexi, r.date_exi, r.date_ret, r.comments, 
									 p.first_name as pup_f_n, p.last_name as pup_l_n,
									 t.target_name, ter.nazwa
						FROM RETEXI r
						JOIN PUPILS p ON r.id_pupil=p.id_pupil
						JOIN TARGET t ON r.id_target=t.id_target
						JOIN teryt_simc ter on r.id_place=ter.sym 
						ORDER BY r.id_retexi DESC
					 ";
	
	$result = $conn->query($query);
	if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
	
	echo "<table id=\"users_body\">";
		
	while ($row = $result->fetch_assoc()) {
		
		if($row['date_ret']=="NULL") {
			$date = "";
			$time = "";
		}
		else {
			$date = substr($row['date_ret'],0,10);
			$time = substr($row['date_ret'],-8,-3);
		}
		
		if(empty($row['comments'])){
			$comments = "Brak uwag.";
		}
		else {
			$comments = $row['comments'];
		}
		
		echo	"<tr id=\"retexi\">
				<th class=\"kol1\">$i</th>
				<th class=\"kol2\">". $row['pup_l_n'] ." ". $row['pup_f_n'] .
				"</th><th class=\"kol3\">". $row['target_name'] .
				"</th><th class=\"kol4\">" . substr($row['date_exi'],0,10) .
				"</th><th class=\"kol5\">" . substr($row['date_exi'],-8,-3) .
				"</th><th class=\"kol6\">" . $row['nazwa'] .
				"</th><th class=\"kol4\">$date</th>
				<th class=\"kol5\">$time</th>
				<th class=\"kol7\">
					<div id=\"dialog\" class=\"tooltipL\">info
						<span class=\"tooltiptextL\">$comments</span>
					</div>
				</th></tr>";
				
		$i--;
	}
	
	echo "</table>";
	
  $result->free_result();
	
	$conn->close();
	
?>
