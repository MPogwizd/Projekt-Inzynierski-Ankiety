<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if (isset($_POST['dodaj']))
	{
		$questionnaire_id = $_POST['questionnaire_id'];
		//Zapamiętaj wprowadzone dane
		#$_SESSION['odp'] = $odp;
		$_SESSION['questionnaire_id'] = $questionnaire_id;
		echo $_SESSION['questionnaire_id'];
		header('Location: ankieta1.php');
		exit();
	}
	unset($_SESSION['powodzenie']);
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
	if(isset($_SESSION['powodzenie']))	echo $_SESSION['powodzenie'];
?>
<?php
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
?>	<div id='glowna'><form method="post">
		<br />
	Wybierz ankiete:</br>
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
	<br />
		<input type="submit" name="dodaj" value="Wybierz" />
	
	</form></div>

</body>
</html>