<?php 
	if (isset($_POST['pseudo'])) {
		$pseudo = $_POST['pseudo'];
		$email = $_POST['email'];
		$classe = $_POST['classe'];
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$bdd = pg_connect("host=localhost dbname=devoirs user=postgres password=your-pass")
    		or die('Connexion impossible : ' . pg_last_error());
    		
		
		$query = "SELECT COUNT(ID) FROM devoirs.public.user WHERE pseudo='".$pseudo."'";
		$resultat = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
		$nombre_de_resultat = pg_fetch_array($resultat)[0];
		
		if ($nombre_de_resultat == 0) {
			$validation = true;
		}else{
			$validation = false;
			echo ('Ce pseudo est déjà utilisé');
		}
    	if ($validation == true){  
    		$query = "SELECT COUNT(ID) FROM devoirs.public.user WHERE mail='".$email."'";
			$resultat = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
			$nombre_de_resultat = pg_fetch_array($resultat)[0];
			
			if ($nombre_de_resultat2 == 0) {
				$validation = true;
			}else{
				$validation = false;
				echo ('Cet email est déjà utilisé');
			}
			if ($validation == true) {
				$pass1 = $_POST["pass1"];
				$pass2 = $_POST["pass2"];
					if ($pass1 == $pass2) {
					$validation2 = true;
				} else {
					echo ('Les mots de passes ne correspondes pas');
					$validation2 = false;
			}}
			if ($validation2 == true) {
				echo('Tout il est bon');
				$date = date("d/m/Y");
				$pass = hash('sha512', $pass1); 
				$query = "INSERT INTO devoirs.public.user(pseudo, mail, mdp, classe ) VALUES ('".$pseudo."', '".$email."', '".$pass."', '".$classe."')";
				$resultat = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    	
			}
    	}
    pg_close($dbconn);
	}
    
?>

<html>
<head>
	<meta charset="utf-8"/>
	<title>Test</title>
</head>
<body>
	<form name="form" action="./inscription.php" method="post">
		<input name="pseudo" type="text" placeholder="Pseudo"><br>
		<input name="email" type="text" placeholder="Email"><br>
		<input name="pass1" type="pass" placeholder="Mot de passe"><br>
		<input name="pass2" type="pass" placeholder="Retaper votre mot de passe"><br>
		<input name="classe" type="text" placeholder="classe"><br>
		<input type="submit" value="Validez">
	</form>
</body>
</html>