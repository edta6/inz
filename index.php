<?php

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: main_page.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl" >
<head>
  <meta charset="UTF-8">
  <title>Elektroniczna Dokumentacja</title>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<div class="login">
		<form action="include/zaloguj.php" method="post">
			<input type="text" name="login" placeholder="Nick" />
			<input type="password" name="haslo" placeholder="Password" />
			<input class="btn btn-primary btn-block btn-large" type="submit" value="Zaloguj się" />
		</form> 
		<div style="padding: 30px">
		<?php
			if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		?>
		</div>
	</div>

</body>
</html>
