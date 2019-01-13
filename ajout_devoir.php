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
    $result = $dbh->prepare("INSERT INTO devoirs.public.devoir (matiere, classe, date, contenu) VALUES ('" . $response['subjects'] . "', '" . $response['classe'] . "', '" . $response['date'] . "', '" . $response['contents'] . "')");
    $result->execute();  
}
catch (PDOException $e) {
    $toSend = 'Failed: ' . $e->getMessage();
}
finally {
    $toSend = 'C\'est ok';
}

print '[{"Message" : "' . $toSend . '"}]';

?>