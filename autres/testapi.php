<?php

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true);

echo '<p>'.$reponse.'</p>';

?>