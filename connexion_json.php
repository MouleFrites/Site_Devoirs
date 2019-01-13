<?php
//Récuperation du formulaire en json
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

//Connection à la BDD
$dsn      = 'pgsql:dbname=devoirs;host=127.0.0.1';
$user     = 'postgres';
$password = 'your-pass';
try {
    $dbh = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    $toSend = 'Connection failed: ' . $e->getMessage();
}
//Envoi des données à la BDD
try {
	$password = hash('sha512', $response['pass1']);
	
    $request = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE pseudo=:pseudo AND password=:passwd');
    $request->bindValue(':pseudo', $response['pseudo'], PDO::PARAM_STR);
    $request->bindValue(':passwd', $password, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch();
} 
catch (PDOException $e) {
    $toSend = 'Connection failed: ' . $e->getMessage();
}

if ($result[0] == 1) {
    $_SESSION["pseudo"] = $pseudo;
    $toSend = ('Vous ètes connecter');
} else {
    $toSend = ('Mauvaise combinaison pseudo/mot de passe');
}

print '[{"Message" : "' . $toSend . '"}]'; 
?>