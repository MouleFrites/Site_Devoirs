<?php


// Connexion, sélection de la base de données
$dbconn = pg_connect("host=localhost dbname=devoirs user=postgres password=your-pass")
    or die('Connexion impossible : ' . pg_last_error());

// Exécution de la requête SQL
$query = 'SELECT id FROM "user"';
$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

// affichage html
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Libère le résultat
pg_free_result($result);

// Ferme la connexion
pg_close($dbconn);


?>