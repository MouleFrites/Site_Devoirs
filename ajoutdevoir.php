 <?php

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

$matiere = $response['subjects'];
$classe  = $response['classe'];
$date    = $response['date'];
$devoir  = $response['contents'];


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
    $result = $dbh->prepare("INSERT INTO devoirs.public.devoir (matiere, classe, date, contenu) VALUES ('" . $matiere . "', '" . $classe . "', '" . $date . "', '" . $devoir . "')");
    $result->execute();
    
}
catch (PDOException $e) {
    echo 'Failed: ' . $e->getMessage();
}

?> 