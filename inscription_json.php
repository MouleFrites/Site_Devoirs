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
    echo 'Connection failed: ' . $e->getMessage();
}

//Vérification du pseudo
$request = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE pseudo=:pseudo');
$request->bindValue(':pseudo', $response['pseudo'], PDO::PARAM_STR);
$request->execute();
$result = $request->fetch();

if ($result[0] == 0) {
    //Vérification de l'email
    $request = $dbh->prepare('SELECT COUNT(*) FROM devoirs.public.user WHERE mail=:mail');
    $request->bindValue(':mail', $response['email'], PDO::PARAM_STR);
    $request->execute();
    $results = $request->fetch();
    if ($results[0] == 0) {
        //Vérification du password
        if ($response['pass1'] == $response['pass2']) {
            $date   = date("d/m/Y");
            $password = hash('sha512', $response['pass1']);
            //Envoi des données à la BDD
            try {
            $request = $dbh->prepare("INSERT INTO devoirs.public.user(pseudo, mail, password, classe ) VALUES ('" . $response['pseudo'] . "', '" . $response['email'] . "', '" . $password . "', '" . $response['classe'] . "')");
            $request->execute();
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            } finally {
                $toSend = 'C\'est ok';
            }
        } else {
            $toSend = 'Les mots de passes ne correspondes pas';
        }
    } else {

        $toSend = 'Cet email est déjà utilisé';
    }
} else {
    $toSend = 'Ce pseudo est déjà utilisé';
}

print '[{"Message" : "' . $toSend . '"}]';
?>