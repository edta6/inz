<?php

	session_start();
	
	$_SESSION['block']=0;
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Elektroniczna Dokumentacja</title>
	<link rel="stylesheet" href="css/table.css">
	<link rel="stylesheet" href="css/adduser.css">
	<script type="text/javascript" src="jquery/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="jquery/pupils.js"></script>
	<script type="text/javascript" src="jquery/timer.js"></script>
	<script type="text/javascript" src="jquery/table.js"></script>
	<script type="text/javascript" src="jquery/users.js"></script>
</head>
<body onload="odliczanie();">

<div class="header">
	<div class="header_container">
		<p id="zegar"></p>
	</div>
	<div class="header_container">
		<p id="user_name">
			<?php
				echo $_SESSION['last_name'] . " " . $_SESSION['first_name'];
			?>
		</p>
	</div>
	<div class="btn_exit">
		<form action="include/logout.php" method="post">
			<button type="submit" class="myButton">Wyloguj</button>
		</form> 
	</div>
</div>

<?php
	include "include/menu.php";
?>

<div class="miejs_tab_button">
	<p>Tutaj można wyszukać miejscowości z przynależnością administracyjną i dodać do listy miejscowości w wypisach.</p>
	<a href="http://eteryt.stat.gov.pl/eTeryt/rejestr_teryt/ogolna_charakterystyka_systemow_rejestru/ogolna_charakterystyka_systemow_rejestru.aspx?contrast=default" target="_blank">OBJAŚNIENIA</a>
	<form id="searchMie" action="" method="post">
		<input id="test" class="miejs_inp" name="miejscowosc" placeholder="Miejscowość" maxlength="100">
		<input class="myButton" type="submit" name="confirm" value="Potwierdź">
	</form>
</div>

<div class="container_full_table">
	<div id="c_users_head">
		<table id="users_head">
			<tr>
				<th class="place_h_col1">Województwo</th>
				<th class="place_h_col1">Powiat/<br>Gmina</th>
				<th class="place_h_col1">Miejscowość</th>
				<th class="place_h_col2">
					<div class="tooltip">INFO*
						<span class="tooltiptext">Dodatkowe informacje o mijescowości.</span>
					</div>
				</th>
				<th class="place_h_col3">Dodaj<br>do wypisów</th>
				<th class="place_h_col3">Ulice</th>
			</tr>
		</table>
	</div>
	<div class="table_users_scroll">
		<?php
			include "query/select/select_teryt_simc.php";
		?>
	</div>
</div>

<div class="addTOplace">
	<p>Miejscowości dodane do wypisów (posortowane po województwach):</p>
		<?php
			include "query/select/select_addTOplace.php";
		?>
</div>

</body>
</html>