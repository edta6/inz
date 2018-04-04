<?php

	if(isset($_POST['miejscowosc'])) {
	
		require_once 'include/login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$conn -> query("SET NAMES 'utf8'");
		
		// Zmienne dla zapytań
		$wojewodztwo = NULL;
		$powiat = NULL;
		$gmina = NULL;
		$rodz_gmi = NULL;
		$nazwa = NULL;
		$sym = NULL;
		
		echo "<table id=\"users_body\">";
		
		$temp = $_POST['miejscowosc'];
	
		$query = "SELECT t.nazwa as wojewodztwo, c.nazwa as powiat, d.nazwa as gmina, d.nazdod as rodz_gmi, m.nazwa as miejscowosc, m.sym, e.nazwa as RM, m.wojewodztwo as idwoj FROM teryt_simc m 
					   INNER JOIN teryt_terc t on m.wojewodztwo=t.wojewodztwo and t.powiat like '' 
					   INNER JOIN teryt_terc c on m.wojewodztwo=c.wojewodztwo and m.powiat=c.powiat and c.gmina like ''
					   INNER JOIN teryt_terc d on m.wojewodztwo=d.wojewodztwo and m.powiat=d.powiat and m.gmina=d.gmina and m.rodz_gmi=d.rodz
					   JOIN teryt_rm e on m.RM=e.RM
					   where m.nazwa like '".$temp."'";
					   
		$result = $conn->query($query);
		if (!$result) echo "Instrukcja SELECT nie powiodła się: $query<br>" . $conn->error . "<br><br>";
		
		while ($row = $result->fetch_assoc()) 
			{
			
			$wojewodztwo = $row["wojewodztwo"];
			$powiat_gmina = $row["powiat"] ."<br>" . $row["gmina"];
			$nazwa = $row["miejscowosc"];
			$rodz_gmi = $row["RM"] . ", " .$row["rodz_gmi"];
			$sym = $row["sym"];
			$idwoj = $row["idwoj"];
			
			$query_help="SELECT count(*) as ile FROM PLACE where sym like '$sym'";
			$result_help = $conn->query($query_help);
			$row_help = $result_help->fetch_assoc();
			$place_temp = $row_help["ile"];
			
			if($place_temp==1) {
				$place_string = "<th class=\"place_h_col3\">
				<form action=\"query/delete/del_place.php\" method=\"post\">
				<input type=\"hidden\" name=\"idwoj\" value=\"".$idwoj."\">
				<input type=\"hidden\" name=\"sym\" value=\"".$sym."\">
				<input type=\"hidden\" name=\"nazwa\" value=\"".$nazwa."\">
				<input class=\"tab_miejsc_input_del\" type=\"submit\" name=\"active\" value=\"Usuń\">
				</form>
				</th>";
			}
			else {
				$place_string = "<th class=\"place_h_col3\">
				<form action=\"query/add/add_place.php\" method=\"post\">
				<input type=\"hidden\" name=\"idwoj\" value=\"".$idwoj."\">
				<input type=\"hidden\" name=\"sym\" value=\"".$sym."\">
				<input type=\"hidden\" name=\"nazwa\" value=\"".$nazwa."\">
				<input class=\"tab_miejsc_input\" type=\"submit\" name=\"active\" value=\"Dodaj\">
				</form>
				</th>";
			}
			
			echo "<tr>
				<th class=\"place_h_col1\">$wojewodztwo</th>
				<th class=\"place_h_col1\">$powiat_gmina</th>
				<th class=\"place_h_col1\">$nazwa</th>
				<th class=\"place_h_col2\">
					<div class=\"tooltipL\">info
						<span class=\"tooltiptextL\">$rodz_gmi</span>
					</div>
				</th>
 				$place_string
				<th class=\"place_h_col3\">
				<form action=\"\" method=\"post\">
				<input type=\"hidden\" name=\"sym_ul\" value=\"".$sym."\">
				<input class=\"tab_miejsc_input\" type=\"submit\" name=\"active\" value=\"Zobacz\">
				</form>
				</th>
				</tr>";

			}
			
			echo "</table>";
			
		$result->free_result();
		$conn->close();
	}
	else {
		echo "<p class=\"ter_nap\">Wpisz nazwę miejscowości i kliknij w przycisk Potwierdź aby zobaczyć wyniki</p>";
	}
	
?>
