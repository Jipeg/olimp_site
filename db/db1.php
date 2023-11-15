<?php 
$user = 'root';
$password = '';
$db = 'olimp_db';
$host = 'localhost';

$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);
?>