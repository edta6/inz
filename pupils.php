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
	<div class="button_table_child">
		<button class="myButton" onclick="reset('id02')">Dodaj wychowanka</button>
	</div>
</div>

<div class="container_full_table">
	<div id="c_users_head">
		<table id="users_head">
			<tr>
				<th class="pupils_h_col1">Lp</th>
				<th class="pupils_h_col2">Nazwisko i imię</th>
				<th class="pupils_h_col2">Wychowawca</th>
				<th class="pupils_h_col3">Data dodania</th>
				<th class="pupils_h_col3">
					<div class="tooltip">Status*
						<span class="tooltiptext">Kolumna, w której można modyfikować wychowanków, jeżeli będzie nieaktywny pojawi się data odejścia.</span>
					</div>
				</th>
				<th class="pupils_h_col3">Data odejścia</th>
			</tr>
		</table>
	</div>
	<div class="table_users_scroll">
		<?php
			include "query/select/wynikpupils.php";
		?>
	</div>
		
</div>

<div id="id02" class="modal">
	<form id="regForm" class="animate" action="query/add/add_pupil.php" method="post" onsubmit="return validate()">
		<div class="imgcontainer">
			<span onclick="zamknij('id02')" class="close" title="Zamknij Okno">&times;</span>
			<h2>Dodaj Wychowanka</h2>
		</div>
		<div>
			<div class="box_input">
				<p><input name="imie" placeholder="Imię" maxlength="28" onkeyup="validate_two()" onchange="nam_val()"></p>
				<p><input name="nazwisko" placeholder="Nazwisko" maxlength="57" onkeyup="validate_two()" onchange="nazw_val()"></p>
			</div>
			<div class="errorbox">
				<p id="Fname" class="error">Pole wymagane - tylko litery (Max. 28z)</p>
				<p id="Lname" class="error">Pole wymagane - tylko litery i (-) (Max. 57z)</p>
			</div>
			<div id="cont_sel" class="box_input_sel">
				<p>Wychowawca:</p>
				<div class="users_sel"><select name="users">
					<?php
						include_once "query/select/select_user.php"; 
					?>
				</select></div>
			</div>
			<div id="DosBox" class="box_input box_margin"> 
				<p>Dostęp:</p>
				<p><input type="radio" name="active" id="dOne" value="active" onchange="dos_val()">Aktywny</p>
				<p><input type="radio" name="active" id="dTwo" value="inactive" onchange="dos_val()">Nieaktywny</p>
			</div>
			<div class="errorbox">
				<p id="Dos" class="error">Musisz określić dostęp.</p>
			</div>
			<div class="box_input">  
				<p><input class="myButton" type="submit" name="confirm" value="Potwierdź"></p>
			</div>  
		</div>
	</form> 
</div>

</body>
</html>