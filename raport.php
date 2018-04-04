<?php

	session_start();
	
	$_SESSION['block']=0;
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	include "query/select/wynikraporthead.php";
	
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

<div id="box_all_raport">
	<div class="box_raport2">
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
					<th class="wpis_col1">Data godzina</th>
					<th class="wpis_col2">Treść spostrzeżenia, zaleceń, dyspozycji, uwagi porządkowe</th>
					<th class="wpis_col3">Status</th>
				</tr>
				<?php
					include "query/select/wynikraport.php";
				?>
			</table>
		</div>
	</div>
	
	<div id="box_menu_raport">
		<ol><li>Raport</li></ol>
		<button id="menu_button1" class="myButton" onclick="document.getElementById('nowy').style.display='block'" <?php echo $_POST['dis']; ?> >Nowy</button>
		<button id="menu_button2" class="myButton" onclick="document.getElementById('edytuj').style.display='block'" <?php echo $_POST['eddis']; ?> >Edytuj</button>
		<button id="menu_button6" name="menu_button6" class="myButton" onclick="show_hide_raport()" <?php echo $_POST['eddis']; ?> >Ukryj</button>
		<ol><li>Wpis</li></ol>
		<button id="menu_button3" class="myButton" onclick="document.getElementById('nowywpis').style.display='block'" <?php echo $_POST['eddis']; ?> >Nowy</button>
		<button id="menu_button4" class="myButton" onclick="document.getElementById('edytujwpis').style.display='block'" <?php echo $_POST['eddis']; ?> >Edytuj</button>
		<ol><li>Zakończenie Raportu</li></ol>
		<form action="query/update/update_raport_end.php" method="post">
			<button id="menu_button5" class="myButton" type="submit" <?php echo $_POST['eddis']; ?> >Koniec</button>
		</form>	
	</div>
</div>

	<script>
	$(function() {
		
		for(var i=1;i<7;i++){
			if ($('#menu_button'+i).is(':disabled')) $('#menu_button'+i).css({"color":"grey", "background":"#333333"});
		}
		
	});
	</script>


<div id="nowy" class="modal">
	<form id="regForm2" class="animate" action="query/add/add_raport_head.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('nowy')" class="close" title="Zamknij Okno">&times;</span>
			<h2>NAGŁÓWEK RAPORTU</h2>
		</div>
		<div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Dzień:</p>
				<input type="text" autocomplete="off" id="example" name="date" onclick="calendar()">
			</div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Od godziny:</p>
				<input type="text" id="hour_start" class="timepicker box_time" name="star_rap" onclick="time_raport_start()">
				<p style="margin-top: 12px;">Do godziny:</p>
				<input type="text" id="hour_end" class="timepicker box_time" name="end_rap" onclick="time_raport_start()">
			</div>
			<div class="box_input_rap">
				<div class="box_input_rap_header">
					<p>Wychowawca</p>
					<p>Godziny pracy</p>
				</div>
				<?php
					include "query/select/select_user_to_rap.php";
				?>
			</div>
			<div class="box_input">
				<p><input class="myButton" type="reset" value="Reset" onclick="hide_timepicker()"></p>
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>

<div id="edytuj" class="modal">
	<form id="regForm2" class="animate" action="query/update/update_raporthead.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('edytuj')" class="close" title="Zamknij Okno">&times;</span>
			<h2>NAGŁÓWEK RAPORTU</h2>
		</div>
		<div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Dzień:</p>
				<input type="text" id="example2" name="date2" value="<?php echo $_POST['date_rap']; ?>" onclick="calendar2()">
			</div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Od godziny:</p>
				<input type="text" id="hour_start" class="timepicker box_time" value="<?php echo $_POST['time_start']; ?>" name="star_rap2" onclick="time_raport_start()">
				<p style="margin-top: 12px;">Do godziny:</p>
				<input type="text" id="hour_end" class="timepicker box_time" value="<?php echo $_POST['time_end']; ?>" name="end_rap2" onclick="time_raport_start()">
			</div>
			<div class="box_input_rap">
				<div class="box_input_rap_header">
					<p>Wychowawca</p>
					<p>Godziny pracy</p>
				</div>
				<?php
					include "query/select/select_user_to_rap_edit.php";
				?>
			</div>
			<div class="box_input">
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>

<script>
$(function() {
    $("#wpis").autocomplete({
        source: 'search.php',
				open: function() { 
					$('#wpis').autocomplete("widget").width(382) 
        }
    });
});
</script>

<div id="nowywpis" class="modal">
	<form id="regForm2" class="animate" action="query/add/add_raport.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('nowywpis')" class="close" title="Zamknij Okno">&times;</span>
			<h2>DODAJ WPIS</h2>
		</div>
		<div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Godzina:</p>
				<input type="text" id="wpis_time" class="timepicker box_time" name="raport_wpis_time" autocomplete="off">
			</div>
			<div class="box_input_sel">
				<p>Wpis:</p>
				<textarea id="wpis" name="raport_wpis_mess" rows="10" maxlength="2000" placeholder="Maksymalnie 2000 znaków"></textarea>
			</div>
			<div class="box_input">
				<p><input class="myButton" type="reset" value="Reset"></p>
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>
		</div>
	</form>
</div>


<script>
$(document.body).on('change',"#sel_wpis",function (e) {
 		
		var optVal= $("#sel_wpis option:selected").val();
		
		var temp1 = "#" + optVal + " > .wpis_col2";
		var temp2 = "#" + optVal + " > .wpis_col1";
		
		var bla = $(temp1).text();
		var bla1 = $(temp2).text();
		
		$('#wpis2').val(bla);
		$('#wpis_time2').val(bla1);
		
});
</script>


<div id="edytujwpis" class="modal">
	<form id="regForm2" class="animate" action="query/update/update_wpis_raport.php" method="post" onsubmit="">
		<div class="imgcontainer">
			<span onclick="zamknij('edytujwpis')" class="close" title="Zamknij Okno">&times;</span>
			<h2>EDYTUJ WPIS</h2>
		</div>
		<div>
				<div id="box_pup" class="box_input_sel">
				<p>Wybierz:</p>
				<div class="users_sel">
					<select id="sel_wpis" name="sel_wpis">
						<?php
							include_once "query/select/select_wpis.php";
						?>
					</select>
				</div>
			</div>
			<div class="box_input_rap_header">
				<p style="margin-top: 12px;">Godzina:</p>
				<input type="text" id="wpis_time2" class="timepicker box_time" name="raport_wpis_time2" autocomplete="off">
			</div>
			<div class="box_input_sel">
				<p>Wpis:</p>
				<textarea id="wpis2" name="raport_wpis_mess2" rows="10" maxlength="2000" placeholder="Maksymalnie 2000 znaków"></textarea>
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