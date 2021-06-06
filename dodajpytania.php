<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if (isset($_POST['questions_contents']))
	{
		@$questions_contents= $_POST['questions_contents'];
		@$questionnaire_id = $_POST['questionnaire_id'];
		@$typequestions = $_POST['typequestions'];
		unset($_SESSION['powodzenie']);
			

		require_once "config.php";
		
			$polaczenie = new mysqli('localhost', 'root' , '' , 'questionnaries');
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				if ($polaczenie->query("INSERT INTO questions VALUES ('','$questions_contents','$questionnaire_id','$typequestions');")) 
				{
					$_SESSION['udanarejestracja']=true;
					#header('Location: witamy.php');
					echo"dodano nowe pytanie";
				}
				else
				{
					echo"nie dziala";
					#throw new Exception($polaczenie->error);
				}
					
			}
				
			
$polaczenie->close();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ankiety</title>
		<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
		<dt>Anonimowe ankiety</dt>
<?php
	unset($_SESSION['odpowiedzi1']);
	unset($_SESSION['blad2']);
	unset($_SESSION['wypelnione']);
	echo "<div id='menu'>";
	echo "<ul>";
	echo "<p>Witaj ".$_SESSION['user'].'!';
	echo "<div id='email'><b>E-mail</b>: ".$_SESSION['email']."</div></p>";
	echo "<li> <a href=ankieta.php>Wybor ankiety</a></li>";
	echo "<li> <a href=show_odp_con.php>Moje odpowiedzi</a></li>";
	if($_SESSION['user']=='Pichal')
	{ 	
	echo "<b>PANEL ADMINA</b>";
		echo "<li><a href=dodajankiete.php>Dodaj ankiete</a></li>";
		echo "<li><a href=dodajpytania.php>Dodaj pytanie do istniejacej ankiety</a></li>";
		echo "<li><a href=dodajodp.php>Dodaj odpowiedz do pytania</a></li>";
		echo "<li><a href=check_user.php>Sprawdź kto wypełnił</a></li>";
	

	}
		echo "<li> <a href=logout.php>Wyloguj mnie</a></li>";
	echo "</ul></div>";
?>
<div id='glowna'>
	<h1> Formularz dodawania pytań do ankiety</h1>
	<form method="post">
		<br />
	Do której ankiety chcesz dodać pytanie:</br>
	<?php

$con=mysqli_connect("localhost","root","","questionnaries") or die(mysqli_error());
$z=("select questionnaire_id,questionnaire_name from questionnaire;");
$result = mysqli_query($con,$z);
echo "<select name='questionnaire_id'>";
while($r=mysqli_fetch_row($result)){
	echo "<option value='".$r[0]."'>".$r[1]."</option>";
}
echo "</select>";

	?>
	<br />
	Pytanie: <br /> <input type="text" value="" name="questions_contents" /><br />
	Typ pytania: <br /> <select name='typequestions'>
		<option value="abcd">Pytanie zamknięte</option>
		<option value="text">TEXT</option>
		<option value="textarea">Pytanie otwarte</option>
		<option value="radio">Pytanie z 1 odpowiedzią</option>
		<option value="wiek">Wiek</option>
		<option value="skala">Skala</option>
		<br />

		<input type="submit" value="Dodaj pytanie" />	
	</form></div>


</body>
</html>