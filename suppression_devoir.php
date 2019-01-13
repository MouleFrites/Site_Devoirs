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
    $request = $dbh->prepare("DELETE FROM devoirs.public.devoir WHERE id =:idToDelete");
    $request->bindValue(':idToDelete', $response['id'], PDO::PARAM_INT);
    $request->execute();
    
}
catch (PDOException $e) {
    $toSend = 'Failed: ' . $e->getMessage();
}

$toSend = 'C\'est supprimé';

print '[{"Message" : "' . $toSend . '"}]'; 

?>