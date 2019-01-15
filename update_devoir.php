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
    $toSend = json_encode('Connection failed: ' . $e->getMessage());
}
//Envoi des données à a BDD
try {
	if ($response['toChange'] == 'matiere'){
		$request = $dbh->prepare("UPDATE devoirs.public.devoir SET matiere = :update WHERE id=:id");
	} else if ($response['toChange'] == 'date'){
    	$request = $dbh->prepare("UPDATE devoirs.public.devoir SET date = :update WHERE id=:id");
	} else if ($response['toChange'] == 'contenu'){
		$request = $dbh->prepare("UPDATE devoirs.public.devoir SET contenu = :update WHERE id=:id");
	}
    //$request->bindValue(':toChange', $response['toChange'], PDO::PARAM_STR);
    $request->bindValue(':update', $response['update'], PDO::PARAM_STR);
    $request->bindValue('id', $response['id'], PDO::PARAM_INT);
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $toSend = json_encode($result);
    
}
catch (PDOException $e) {
    $toSend = json_encode('Failed: ' . $e->getMessage());
}

print $toSend;
?>