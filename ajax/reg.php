<?php
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($username) <= 3){
        $error = 'Введите имя';
    } else if(strlen($email) <= 3){
        $error = 'Введите email';
    } else if(strlen($login) <= 3){
        $error = 'Введите логин';
    } else if(strlen($pass) <= 3){
        $error = 'Введите пароль';
    }

    if (strlen($error) != 0) {
        echo $error;
        exit();
    }

    $hash = "qq;lj12qwe";
    $pass = md5($pass . $hash);

    // echo $pass;
    require_once '../db/db1.php';
    $sql = 'INSERT INTO users(name, email, login, pass) VALUES (?,?,?,?)';
    $query = $pdo->prepare($sql);
    $query->execute([$username, $email, $login, $pass]);

    echo 'Готово';
?>