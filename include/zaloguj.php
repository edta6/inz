<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: ../index.php');
		exit();
	}

	require_once "login.php";

	$polaczenie = @new mysqli($hn, $un, $pw, $db);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM USERS WHERE nick='%s' AND active=0",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['pass']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id_user'] = $wiersz['id_user'];
					$_SESSION['first_name'] = $wiersz['first_name'];
					$_SESSION['last_name'] = $wiersz['last_name'];
					$_SESSION['role'] = $wiersz['role'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: ../main_page.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: ../index.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>