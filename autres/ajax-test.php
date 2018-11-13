<?php

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array

$lName = $response[0];
$age = $response[1];

echo '
<div align="center">
<h5> Received data: </h5>
<table border="1" style="border-collapse: collapse;">
 <tr> <th> First Name</th> <th> Age</th> </tr>
 <tr>
 <td> <center> '.$lName.'<center></td>
 <td> <center> '.$age.'</center></td>
 </tr>
 </table></div>
 ';
?>