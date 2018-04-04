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
		<button class="myButton" onclick="reset('id01')">Dodaj użytkownika</button>
	</div>
</div>

<div class="container_full_table">
	<div id="c_users_head">
		<table id="users_head">
			<tr>
				<th class="users_h_col1">Lp</th>
				<th class="users_h_col2">Nazwisko i imię</th>
				<th class="users_h_col3">Nick</th>
				<th class="users_h_col4">
					<div class="tooltip">Rola*
						<span class="tooltiptext">Kolumna, w której można modyfikować UPRAWNIENIA.</span>
					</div>
				</th>
				<th class="users_h_col5">
					<div class="tooltip">Status*
						<span class="tooltiptext">Kolumna, w której można modyfikować DOSTĘP.</span>
					</div>
				</th>
			</tr>
		</table>
	</div>
	
	<div class="table_users_scroll">
		<?php
			include "query/select/wynikuser.php";
		?>
	</div>
</div>

<div id="id01" class="modal">
	<form id="regForm" class="animate" action="query/add/add_user.php" method="post" onsubmit="return validate()">
		<div class="imgcontainer">
			<span onclick="zamknij('id01')" class="close" title="Zamknij Okno">&times;</span>
			<h2>Dodaj użytkownika</h2>
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
			<div class="box_input">
				<p><input name="nick" placeholder="Nick" maxlength="20" onkeyup="validate_two()" onclick="prepernick()"></p>
			</div>
			<div class="errorbox">
				<p id="Uname" class="error">Pole wymagane - tylko litery oraz liczby</p>
			</div>
			<div class="box_input">  
				<p><input type="password" name="pass" placeholder="Hasło" maxlength="20" onkeyup="pas_val()"></p>
				<p><input type="password" name="pass_re" placeholder="Powtórz Hasło" maxlength="20" onkeyup="pas_val()"></p>
			</div>
			<div class="errorbox">
				<p id="pass_eror" class="error">Hasło musi mieć od 8 do 20 znaków!</p>
				<p id="pass_eror1" class="error">Hasła nie pasują!</p>
				<p id="pass_eror2" class="error">Hasła nie pasują! <br> Hasło musi mieć od 8 do 20 znaków!</p>
			</div>
			<div id="UprBox" class="box_input box_margin"> 
				<p>Uprawnienia:</p>
				<p><input type="radio" name="role" id="uOne" value="zwykly" onchange="upr_val()">Zwykły</p>
				<p><input type="radio" name="role" id="uTwo" value="admin" onchange="upr_val()">Administrator</p>
			</div>
			<div class="errorbox">
				<p id="Upr" class="error">Musisz nadać uprawnienia.</p>
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