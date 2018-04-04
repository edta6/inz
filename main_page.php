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
	<link rel="stylesheet" href="css/wickedpicker.css">
	<script src="jquery/jquery-1.12.4.js"></script>
	<script src="jquery/pupils.js"></script>
	<script src="jquery/timer.js"></script>
	<script src="jquery/table.js"></script>
	<script src="jquery/wyborczasu.js"></script>
	<script src="jquery/wickedpicker.js"></script>
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

<div class="button_table">
	<div class="button_table_child">
		<button class="myButton" onclick="document.getElementById('wypis').style.display='block'">Wypis</button>
		<button class="myButton" onclick="document.getElementById('odpisz').style.display='block'" >Powrót</button>
	</div>
	<div class="button_table_child">
		<select id="clmn_name" onchange="change_placeholder_search()">
			<option>Nazwisko i imię</option>
			<option>Wyjście</option>
			<option>Powrót</option>
		</select>
		<input id="kwd_search" class="search_table" onchange="hideIcon(this);" placeholder="Nazwisko i imię">
	</div>
</div>

<div class="container_full_table">
	<div class="c_users_head">
		<table id="users_head">
			<tr>
				<th rowspan="2" class="kol1">Lp.</th>
				<th rowspan="2" class="kol2">Nazwisko i imię</th>
				<th rowspan="2" class="kol3">Cel wyjśćia</th>
				<th colspan="2" class="kol45">Wyszedł</th>
				<th rowspan="2" class="kol6">Przewidywane miejsce<br>Tel. kontaktowy</th>
				<th colspan="2" class="kol45">Powrócił</th>
				<th rowspan="2" class="kol7">Uwagi</th>
			</tr>
			<tr>
				<th class="kol4">dnia</th>
				<th class="kol5">godz.</th>
				<th class="kol4">dnia</th>
				<th class="kol5">godz.</th>
			</tr>
		</table>
	</div>
	<div class="table_users_scroll">
		<?php
			include "query/select/wynikretexi.php";
		?>
	</div>
</div>

<div id="wypis" class="modal">
	<form id="regForm" class="animate" action="query/add/add_new_exit.php" method="post" onsubmit="return validate_wypis()">
		<div class="imgcontainer">
			<span onclick="zamknij('wypis')" class="close" title="Zamknij Okno">&times;</span>
			<h2>WYPISZ</h2>
		</div>
		<div>
			<div id="box_pup" class="box_input_sel">
				<p>Wybierz Uczestnika:</p>
				<div class="users_sel">
					<select id="pupils" name="pupils">
						<?php
							include_once "query/select/select_pupils.php";
						?>
					</select>
				</div>
			</div>
			<div id="box_tar" class="box_input_sel">
				<p>Cel Wyjścia:</p>
				<div class="users_sel">
					<select id="targets" name="targets">
						<?php
							include_once "query/select/select_target.php";
						?>
					</select>
				</div>
			</div>
			<div id="box_pla" class="box_input_sel">
				<p>Miejsce Pobytu:</p>
				<div class="users_sel">
					<select id="place" name="place">
						<?php
							include_once "query/select/select_place.php";
						?>
					</select>
				</div>
			</div>
			<div class="box_input_sel">
				<p>Uwagi:</p>
				<textarea name="message" rows="5" maxlength="270" placeholder="Maksymalnie 270 znaków"></textarea>
			</div>
			<div class="box_input_time">
				<p><input id="box_timeId" type="checkbox" name="change_time" onchange="show_timepicker('#box_timeId','#timeId')">Zmień czas.</p>
				<input id="timeId" type="text" name="timepicker" class="timepicker">
			</div>
			<div class="box_input">
				<p><input class="myButton" type="reset" value="Reset" onclick="hide_timepicker()"></p>
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>

<div id="odpisz" class="modal">
	<form id="regForm2" class="animate" action="query/update/update_retexi.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('odpisz')" class="close" title="Zamknij Okno">&times;</span>
			<h2>POWRÓT</h2>
		</div>
		<div>
			<div class="box_input_sel">
				<p>Wybierz Uczestnika:</p>
				<div class="users_sel">
					<select name="pupils_back">
						<?php
							include_once "query/select/select_pupils_back.php";
						?>
					</select>
				</div>
			</div>
			<div class="box_input_sel">
				<p>Uwagi:</p>
				<textarea name="message" rows="5" maxlength="270" placeholder="Maksymalnie 270 znaków"></textarea>
			</div>
			<div class="box_input_time">
				<p><input id="box_timeId2" type="checkbox" name="change_time2" onchange="show_timepicker('#box_timeId2','#timeId2')">Zmień czas.</p>
				<input id="timeId2" type="text" name="timepicker2" class="timepicker2">
			</div>
			<div class="box_input">
				<p><input class="myButton" type="reset" value="Reset" onclick="hide_timepicker()"></p>
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>

</body>
</html>