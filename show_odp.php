<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if (isset($_POST['wyslij']))
	{
		$kod=$_POST['kod'];
		$ankiety_id=$_POST['Questionnaire_name'];
		$polaczenie = new mysqli('localhost', 'root' , '' , 'questionnaries');
		$kod=md5($kod);

		$con=mysqli_connect("localhost","root","","questionnaries") or die(mysqli_error());
		$z3=("select answ,hash_answ from answers where id_questionnaire='".$ankiety_id."';");
		$result3 = mysqli_query($con,$z3);

		while($r3=mysqli_fetch_array($result3)){
			$test1 = $r3['answ'];
			$kod1=$kod.(md5($test1));
			if( $kod1==$r3['hash_answ'])
				$kod2=$kod1;
		}
		if (@$kod2==''){
			$_SESSION['blad2'] = '<span style="color:red">Podałeś zły kod lub ktoś edytował Twoje odpowiedzi zglos sie do administratora! </span>';
				header('Location: show_odp.php');
			}
		$z=("select answ,hash_answ from answers where id_questionnaire='".$ankiety_id."' and hash_answ='".@$kod2."';");

		
		$z1=("select questions_contents from questions where questionnaire_id='".$ankiety_id."';");		
		$result = mysqli_query($con,$z);
		$result1 = mysqli_query($con,$z1);
		$ile_znalezionych =$result1->num_rows;

		while($r=mysqli_fetch_array($result)){
		$i=1;
		$j=0;
		mysqli_data_seek($result1, 0);
		$_SESSION['answ'] = $r['answ'];
		$_SESSION['hash_answ'] = $r['hash_answ'];
		$answ=$_SESSION['answ'];
		$true=$kod.(md5($_SESSION['answ']));
		if ($true==$_SESSION['hash_answ'])


			$answ_rozdzielone = explode("_", $answ);
			count($answ_rozdzielone);
			@$_SESSION['answers1'].="Twoje odpowiedzi to:";
			@$_SESSION['answers1'].="</br>";
			while($j<$ile_znalezionych){
			$wiersz=$result1->fetch_assoc();
			@$_SESSION['answers1'].=$wiersz['questions_contents'];
			//echo $wiersz['pytania_tresc'];
			@$_SESSION['answers1'].="</br>";
			//echo "</br>";
			@$_SESSION['answers1'].=@$answ_rozdzielone[$i]."<br/>";
			//echo @$answ_rozdzielone[$i]."<br/>";
			@$_SESSION['answers1'].="</br>";
			//echo "</br>";
		$i++;
		$j++;
	}
	//}

	}
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
<div id="glowna">
<?php
	if(isset($_SESSION['blad2']))	echo $_SESSION['blad2'];
	echo @$_SESSION['answers1'];
	unset($_SESSION['answers1']);
?>

</div>


</body>
</html>