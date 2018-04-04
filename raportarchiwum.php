<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
		
	if($_SESSION['block']==1) {
		include "query/select/wynikraportarchiwum_dwa.php";
	}
	else {
		include "query/select/wynikraportarchiwum.php";
	}
		
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Elektroniczna Dokumentacja</title>
	<link rel="stylesheet" href="css/table.css">
	<link rel="stylesheet" href="css/adduser.css">
	<link rel="stylesheet" href="css/glDatePicker.darkneon.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="css/jquery-ui.structure.min.css">
	<script src="jquery/jquery-1.12.4.js"></script>
	<script src="jquery/jquery-ui.min.js"></script>
	<script src="jquery/timer.js"></script>
	<script src="jquery/table.js"></script>
	<script src="jquery/pupils.js"></script>
	<script src="jquery/glDatePicker.js"></script>
	<script src="jquery/jquery.timepicker.min.js"></script>
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

<script>
$(document).ready(function() {
		
		if($('#nav_next').val()=="") $('#b_nav_next').hide();
		if($('#nav_back').val()=="") {
			$('#b_nav_back').hide();
			$('#next_arch').css("padding-left","82.5%");
		}
	});	
</script>	


<div class="button_nav_archiwum">
		<form id="back_arch" action="query/select/test.php" method="post">
			<input type="hidden" name="block" value="1">
			<input type="hidden" name="kto" value="0">
			<input type="hidden" name="actual_id" value="<?php echo $_POST['id_raport_head']; ?>" >
			<input id="nav_back" type="hidden" name="back_id" value="<?php echo $_POST['id_raport_head_back']; ?>" >
			<input id="b_nav_back" class="myButton" type="submit" value="Poprzedni">
		</form>
		<form id="next_arch" action="query/select/test.php" method="post">
			<input type="hidden" name="block" value="1">
			<input type="hidden" name="kto" value="1">
			<input type="hidden" name="actual_id" value="<?php echo $_POST['id_raport_head']; ?>" >
			<input id="nav_next" type="hidden" name="next_id" value="<?php echo $_POST['id_raport_head_next']; ?>" >
			<input id="b_nav_next" class="myButton" type="submit" value="Następny">
		</form>
</div>

<div id="box_all_raport">
	<div class="box_raport2" style="margin: auto;">
		<div id="box_raport">
			<table id="tab_raport">
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_1">
							RAPORT DYŻURNEGO WYCHOWAWCY Z PRZEBIEGU DYŻURU
						</div>
					</div>	
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_napis_7">
						<div class="tab_napis_1 tab_napis_2">
							W DNIU 
						</div>
						<div id="tab_date" class="tab_napis_1 tab_color tab_napis_2">
							<?php echo $_POST['date_rap']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_napis_7">
						<div class="tab_napis_1 tab_napis_2">
							OD GODZ 
						</div>
						<div id="hour_start" class="tab_napis_1 tab_color tab_napis_2">
							<?php echo $_POST['time_start']; ?>
						</div>
						<div class="tab_napis_1 tab_napis_2">
							DO GODZ 
						</div>
						<div id="hour_end" class="tab_napis_1 tab_color tab_napis_2">
							<?php echo $_POST['time_end']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_3">
							Wychowawca dyżurny (Imię i Nazwisko)
						</div>
						<div id="name_users" class="tab_napis_4">
							<?php echo $_POST['wychowawcy']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_5">
							Stan uczestników internatu zaewidencjonowanych (podać liczbę)
						</div>
						<div id="stan" class="tab_liczba">
							<?php echo $_POST['stan']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_5">
							Uczestnicy obecni w internacie (podać liczbę)
						</div>
						<div id="calcu_stan" class="tab_liczba">
							<?php echo $_POST['obecni']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_5">
							Nieobecni usprawiedliwieni (podać liczbę)
						</div>
						<div id="exit_ok" class="tab_liczba">
							<?php echo $_POST['exit_ok']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_5">
							Nieobecni nieusprawiedliwieni (podać liczbę)
						</div>
						<div id="exit_bad" class="tab_liczba">
							<?php echo $_POST['exit_bad']; ?>
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div class="tab_napis_5">
							Wymienić nazwiska nieobecnych nieusprawiedliwionych:
						</div>
					</div>
				</th>
			</tr>
			<tr>
				<th>
					<div class="tab_th">
						<div id="slaves" class="tab_napis_6">
							<?php echo $_POST['exit_bad_name']; ?>
						</div>
					</div>
				</th>
			</tr>
		</table>
		</div>
		<div id="box_wpis">
			<table id="tab_wpis">
				<tr class="tab_wpis_first_row">
					<th class="wpis_arch_col1">Data godzina</th>
					<th class="wpis_arch_col2">Treść spostrzeżenia, zaleceń, dyspozycji, uwagi porządkowe</th>
				</tr>
				<?php
					include "query/select/wynikraportarchiwumwpis.php";
				?>
			</table>
		</div>
	</div>
	
</div>
</body>
</html>