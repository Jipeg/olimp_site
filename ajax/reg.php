<?php
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($email) <= 3){
        $error = 'Введите email';
    } else if(strlen($pass) <= 3){
        $error = 'Введите пароль длиннее 3 символов';
    }
    require_once '../db/db1.php';
    $sql = 'SELECT `id`, `pass` FROM `users` WHERE `email` = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (!empty($user)){ 
        $error = 'Пользователь с таким email уже зарегистрирован';
    }

    // Проверка ВСЕХ ошибок!
    if (strlen($error) != 0) {
        echo $error;
        exit();
    }

    $hash = "qq;lj12qwe";
    $pass = md5($pass . $hash);

    // echo $pass;

    $sql = 'INSERT INTO users(name, email, login, pass) VALUES ("имя",?,"логин",?)';
    $query = $pdo->prepare($sql);
    $query->execute([$email, $pass]);

    echo 'Готово';
?>