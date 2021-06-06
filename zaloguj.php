<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	require "config.php";
	unset($_SESSION['succes']);
	$conection = new mysqli($host, 'root' , '' , 'questionnaries');
	
	if ($conection->connect_errno!=0)
	{
		echo "result: ".$conection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	
		if ($result = @$conection->query(
		sprintf("SELECT * FROM users WHERE users_login='%s' AND users_password='%s';",
		mysqli_real_escape_string($conection,$login),
		mysqli_real_escape_string($conection,$password))))
		{
			$ilu_userow = $result->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				$wiersz = $result->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['users_name'];
				$_SESSION['email'] = $wiersz['users_email'];
				
				unset($_SESSION['blad']);
				$result->free_result();
				header('Location: zalogowany.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$conection->close();
	}
	
?>