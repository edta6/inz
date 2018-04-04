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

<div class="miejs_tab_button">
	<p>Tutaj wpisz cel wyjścia, aby dodać go do tabeli.</p>
	<form id="" class="" action="query/add/add_target.php" method="post">
		<input style="width: 100%; margin-bottom: 15px;" name="target" placeholder="Cel wyjścia maksymalnie 100 znaków" maxlength="100">
		<input class="myButton" type="submit" name="confirm" value="Potwierdź">
	</form>
</div>

<script>
$(document).ready(function(){
	var actualHeight = $("#users_body").width();
	$("#users_head").css('max-width',actualHeight+1+'px');
});
</script>


<div class="container_full_table">
	<div id="c_users_head">
		<table id="users_head">
			<tr>
				<th class="pupils_h_col1">Lp</th>
				<th class="pupils_h_col2">Cel wyjścia</th>
				<th class="pupils_h_col3">
					<div class="tooltip">Status*
						<span class="tooltiptext">Kolumna, w której można modyfikować cel wyjścia: Aktywny - jest na liście do wyboru w Książce Wyjść i Wypisów; Nieaktywny - brak go na liście.</span>
					</div>
				</th>
			</tr>
		</table>
	</div>
	<div class="table_users_scroll">
		<?php
			include "query/select/wyniktarget.php";
		?>
	</div>

</body>
</html>