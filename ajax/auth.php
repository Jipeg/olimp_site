<?php
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($email) <= 3){
        $error = 'Введите корректный email';
    } else if(strlen($pass) <= 3){
        $error = 'Введите пароль';
    }

    if (strlen($error) != 0) {
        echo $error;
        exit();
    }

    $hash = "qq;lj12qwe";
    $pass = md5($pass . $hash);

    require_once '../db/db1.php';
    $sql = 'SELECT `id`, `pass` FROM `users` WHERE `email` = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (empty($user)){
        echo 'Пользователя с таким email нет в базе';
    } else if ($user->pass != $pass){
        echo 'Неверный пароль';
    } else {
        setcookie('log', $user->id, time() + 3600 * 24 * 30, "/");
        //setcookie('user_id', $user->id, time() + 3600 * 24 * 30, "/");
        echo 'готово';
    }
?>