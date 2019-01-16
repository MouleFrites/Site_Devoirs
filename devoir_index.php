<?php
//Récuperation du formulaire en json
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

//Connection à la BDD
$dsn      = 'mysql:dbname=devoirs;host=127.0.0.1';
$user     = 'userdevoirs';
$password = 'cmd';

try {
    $dbh = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    $toSend = json_encode('Connection failed: ' . $e->getMessage());
}
//Envoi des données à a BDD
try {
    $request = $dbh->prepare("SELECT id, matiere, date, contenu FROM devoir WHERE classe=:classe");
    $request->execute(['classe' => $response['classe']]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $toSend = json_encode($result);
    
}
catch (PDOException $e) {
    $toSend = json_encode('Failed: ' . $e->getMessage());
}

print $toSend
?> 