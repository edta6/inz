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
	<script src="jquery/timer.js"></script>
	<script src="jquery/table.js"></script>
	<script src="jquery/pupils.js"></script>
	<script src="jquery/wyborczasu.js"></script>
	<script src="jquery/wickedpicker.js"></script>
</head>
<body onload="odliczanie();">

<div class="header">

	<div class="header_container"><p id="zegar"></p></div>
	
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
		<button class="myButton" onclick="document.getElementById('raptemp').style.display='block'">Dodaj standardowy wpis</button>
</div>

<div class="container_full_table">
	<div id="c_users_head">
		<table id="users_head">
			<tr>
				<th class="raptemp_col1">Lp</th>
				<th class="raptemp_col2">Godzina</th>
				<th class="raptemp_col3">Wpis</th>
				<th class="raptemp_col2">
					<div class="tooltip">Status*
						<span class="tooltiptext">Kolumna, w której można modyfikować wychowanków, jeżeli będzie nieaktywny pojawi się data odejścia.</span>
					</div>
				</th>
			</tr>
		</table>
	</div>
	<div class="table_users_scroll">
		<?php
			include "query/select/wynikraptemp.php";
		?>
	</div>
</div>

<div id="raptemp" class="modal">
	<form id="regForm" class="animate" action="query/add/add_help_raport.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('raptemp')" class="close" title="Zamknij Okno">&times;</span>
			<h2>Dodaj standardowy wpis do Raportu</h2>
		</div>
		<div>
			<div class="box_input_time">
				<p>Zdefiniuj czas:</p>
				<input id="timepicker3" type="text" name="timepicker3" class="timepicker">
			</div>
			<div class="box_input_sel">
				<p>Wpis:</p>
				<textarea name="message" rows="10" maxlength="270" placeholder="Maksymalnie 2000 znaków"></textarea>
			</div>
			<div id="DosBox" class="box_input box_margin"> 
				<p><input type="radio" name="active" id="dOne" value="active" onchange="dos_val()">Aktywny</p>
				<p><input type="radio" name="active" id="dTwo" value="inactive" onchange="dos_val()">Nieaktywny</p>
			</div>
			<div class="box_input">
				<p><input class="myButton" type="reset" value="Reset"></p>
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>

</body>
</html>