 <?php

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);

$classe = $response['classe'];


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
    $result = $dbh->prepare("SELECT id, matiere, date, contenu FROM devoirs.public.devoir WHERE classe=:classe");
    $result->bindValue(':classe', $classe, PDO::PARAM_STR);
    $result->execute();
    $resultat = $result->fetchAll();
    $devoir1  = $resultat[0];
    $devoir2  = $resultat[1];
    
    echo '<table>';
    echo '<tr>';
    for ($j = 0; $j <= 3; $j++) {
        echo '<td>';
        echo $devoir1[$j];
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
    
    echo '<table>';
    echo '<tr>';
    for ($j = 0; $j <= 3; $j++) {
        echo '<td>';
        echo $devoir2[$j];
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
    
}
catch (PDOException $e) {
    echo 'Failed: ' . $e->getMessage();
}


?> 