<?php 

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$user = $_ENV['db_user'];
$password = $_ENV['db_password'];
$db = $_ENV['db_name'];
$host = $_ENV['db_host'];

$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);
?>