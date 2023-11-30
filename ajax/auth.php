<?php
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($login) <= 3){
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

    require_once '../db/db1.php';
    $sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `pass` = :pass';
    $query = $pdo->prepare($sql);
    $query->execute(['login' => $login,'pass' => $pass]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (empty($user)){
        echo 'Пользователя с такими логином и паролем нет в базе';
    }
    else {
        setcookie('log', $user->id, time() + 3600 * 24 * 30, "/");
        //setcookie('user_id', $user->id, time() + 3600 * 24 * 30, "/");
        echo 'готово';
    }
?>