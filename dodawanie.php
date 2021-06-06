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
		$polaczenie = new mysqli('localhost', 'root' , '' , 'questionnaries');
		$login=$_SESSION['user'];
		$odpowiedz='';

		$con=mysqli_connect("localhost","root","","questionnaries") or die(mysqli_error());
		$z=("select questionnaire_name from questionnaire where questionnaire_id=".$_SESSION['questionnaire_id'].";");
		$result = mysqli_query($con,$z);

		while($r=mysqli_fetch_array($result)){
			$_SESSION['questionnaire_name']=$r['questionnaire_name'];
		}

		foreach( (Array) $_POST as $field => $value){
   		//echo "<p>".$value." ".$field." ";
   		if ($value!='Prześlij' and $field!='kod'){
   		$odpowiedz=$odpowiedz.'_'.$value;}

		}	
		$hash=md5($odpowiedz);
		$kod=md5($kod);
		$hash=$kod.$hash;
		$polaczenie->query("INSERT INTO answers VALUES ('','".$odpowiedz."','".$hash."','".$_SESSION['questionnaire_id']."');");
		$polaczenie->query("INSERT INTO questionnaire_submited VALUES ('','".$login."','".$_SESSION['questionnaire_name']."','".$_SESSION['questionnaire_id']."');");
		unset($_SESSION['questionnaire_name']);
		unset($_SESSION['powodzenie']);
		$_SESSION['powodzenie'] = '<span style="color:red">Pomyślnie udzielono odpowiedzi!</span>';
		header('Location: zalogowany.php');

	}

?>