<?php

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

$idDel = $response['id'];


$dsn      = 'pgsql:dbname=devoirs;host=127.0.0.1';
$user     = 'postgres';
$password = 'your-pass';

try {
    $dbh = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
try {
    $result = $dbh->prepare("DELETE FROM devoirs.public.devoir WHERE id =:iddel");
    $result->bindValue(':iddel', $idDel, PDO::PARAM_INT);
    $result->execute();
    
}
catch (PDOException $e) {
    echo 'Failed: ' . $e->getMessage();
}

?>