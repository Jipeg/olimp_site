<?php
$action = $_POST['action'];

switch ($action) {
case 'register':
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
    break;
case 'getCode':
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    $res = array();
    $res['error'] = '';
    $code = random_int(1000, 9999);//random_bytes(6);

    if(strlen($email) <= 3){
        $res['error'] = 'Введите email';
    }

    require_once '../db/db1.php';
    $sql = 'SELECT `id`, `pass` FROM `users` WHERE `email` = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (!empty($user)){ 
        $res['error'] = 'Пользователь с таким email уже зарегистрирован';
    }

    if (strlen($res['error']) != 0) {
        $res['success'] = 0;
        $res['code'] = '777';
        print json_encode($res);
        exit();
    }


    // $to = $email;
    // $subject = "=?utf-8?B?".base64_encode("Новое сообщение с сайта golovactiki.ru")."?=";
    // $headers = "From: andronov.kolya@ya.ru\r\nReply-to: andronov.kolya@ya.ru\r\nContent-type: text/html; charset=utf-8\r\n";

    // $mess = "Ваш код подтверждения: " . $code;
    // mail($to, $subject, $mess, $headers);

    $res['success'] = 1;
    $res['code'] = $code;
    print json_encode($res);
    exit();                                         
}