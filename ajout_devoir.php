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
//Envoi des données à la BDD
try {
    $request = $dbh->prepare("INSERT INTO devoir (matiere, classe, date, contenu) VALUES (:subjects, :classe, :date, :contents)");
    
    $params = [
    	'subjects' => $response['subjects'],
    	'classe' => $response['classe'],
    	'date' => $response['date'],
    	'contents' => $response['contents'],
    ];
    
    $request->execute($params);
}
catch (PDOException $e) {
    $toSend = 'Failed: ' . $e->getMessage();
}
	$toSend = 'C\'est ok';
print $toSend;

?>