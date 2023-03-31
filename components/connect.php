<?php

try {
$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

} catch (PDOException $e) {
    $conn = new PDO($db_name, $user_name, 'root');
    // print "Erreur !: " . $e->getMessage() . "<br/>";

}
session_start();
?>