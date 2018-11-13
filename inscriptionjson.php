 <?php
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
//print_r($response);

$pseudo = $response['pseudo'];
$email  = $response['email'];
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


$result = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE pseudo=:pseudo');
$result->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
$result->execute();
$resultat           = $result->fetch();
$nombre_de_resultat = ($resultat[0]);

if ($nombre_de_resultat == 0) {
    $validation = true;
} else {
    $validation = false;
    echo ('Ce pseudo est déjà utilisé');
}
if ($validation == true) {
    $result = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE mail=:mail');
    $result->bindValue(':mail', $email, PDO::PARAM_STR);
    $result->execute();
    $resultat = $result->fetch();
    $nombre_de_resultat = ($resultat[0]);
    if ($nombre_de_resultat2 == 0) {
        $validation = true;
    } else {
        $validation = false;
        echo ('Cet email est déjà utilisé');
    }
    if ($validation == true) {
        $pass1 = $response['pass1'];
        $pass2 = $response['pass2'];
        if ($pass1 == $pass2) {
            $validation2 = true;
        } else {
            echo ('Les mots de passes ne correspondes pas');
            $validation2 = false;
        }
    }
    if ($validation2 == true) {
        echo ('Tout il est bon');
        $date   = date("d/m/Y");
        $pass   = hash('sha512', $pass1);
        $result = $dbh->prepare("INSERT INTO devoirs.public.user(pseudo, mail, password, classe ) VALUES ('" . $pseudo . "', '" . $email . "', '" . $pass . "', '" . $classe . "')");
        $result->execute();
        
    }
}
?> 