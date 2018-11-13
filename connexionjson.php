 <?php
session_start();

$_SESSION["pseudo"] = "test";

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
//print_r($response);

$pseudo = $response['pseudo'];
$pass1  = $response['pass1'];
$pass   = hash('sha512', $pass1);

$dsn      = 'pgsql:dbname=devoirs;host=127.0.0.1';
$user     = 'postgres';
$password = 'your-pass';

try {
    $dbh = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$result = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE pseudo=:pseudo AND password=:passwd');
$result->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$result->bindValue(':passwd', $pass, PDO::PARAM_STR);
$result->execute();
$resultat           = $result->fetch();
$nombre_de_resultat = ($resultat[0]);

if ($nombre_de_resultat == 1) {
    $authentification   = true;
    $_SESSION["pseudo"] = $pseudo;
    echo ('t\'es co bb <3');
} else {
    $authentification = false;
    echo ('Mauvaise combinaison pseudo/mot de passe');
}
pg_close($dbconn);


?> 