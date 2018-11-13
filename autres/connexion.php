<?php
	session_start();
	
	$_SESSION["pseudo"] = "test";
	
	if (isset($_POST['pseudo'])) {
		$pseudo = $_POST['pseudo'];
		$pass1 = $_POST['pass1'];
		$pass = hash('sha512', $pass1);
		
		$bdd = pg_connect("host=localhost dbname=devoirs user=postgres password=your-pass")
    		or die('Connexion impossible : ' . pg_last_error());
		
		$query("SELECT COUNT(ID) FROM devoirs.public.user WHERE pseudo='".$pseudo."' AND password='".$pass."'");
		$resultat = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
		$nombre_de_resultat = pg_fetch_array($resultat)[0];
		
		if ($nombre_de_resultat == 1) {
			$authentification = true;
			$_SESSION["pseudo"] = $pseudo;
		}else{
			$authentification = false;
			echo ('Oh ptn tes pas dans la BDD');
		}
	pg_close($dbconn);
	}
	

?>

<html>
<head>
</head>
<body>
	<form name="form" action="./connexion.php" method="post">
		<input id="pseudo" type="text" placeholder="Pseudo"><br>
		<input id="pass1" type="password" placeholder="Mot de passe"><br>
		<button type="submit" value="Validez">test</button>
	</form>
</body>
</html>