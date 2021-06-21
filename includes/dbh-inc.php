<?php
//connecting to the database
/*$dbServername = 'dbservername';
$dbName = 'signup';
$dbUsername = 'dbUsername';
$dbPassword = 'myPassword';
*/

$pdo = new PDO("mysql: host=localhot; dbname=signup", "test", "myPassword");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>