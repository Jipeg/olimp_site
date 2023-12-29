<?php

require __DIR__ . '/../vendor/autoload.php';
use ReallySimpleJWT\Token;

$action = $_POST['action'];
$res = array();
$res['error'] = '';
$res['success'] = 0;
$arr_cookie_options = array (
                'expires' => time() + 600, 
                'path' => '/reg.php', 
                //'domain' => '.example.com', // leading dot for compatibility or use subdomain
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'Strict' // None || Lax  || Strict
);

switch ($action) {
case 'register':
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

    $token = $_POST['token'];

    $secret = 'sec!ReT423*&';
    $token_valid = Token::validate($token, $secret);
    if ($token_valid != 1) {
        $res['error'] = 'Ошибка токена';
        exit();
    }
    $email = Token::getPayload($token)['user_id'];

    require_once '../db/db1.php';
    $sql = 'SELECT `id`, `pass` FROM `users` WHERE `email` = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (!empty($user)){ 
        $res['error'] = 'Пользователь с таким email уже зарегистрирован';
    }

    // Проверка ВСЕХ ошибок!
    if (strlen($res['error']) != 0) {
        break;
    }

    $hash = "qq;lj12qwe";
    $pass = md5($pass . $hash);

    // echo $pass;

    $sql = 'INSERT INTO users(name, email, login, pass) VALUES ("имя",?,"логин",?)';
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['email'], $pass]);
    $res['success'] = 1;
    break;

case 'getCode':

    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    if(strlen($email) <= 3){
        $res['error'] = 'Введите email';
        break;
    }

    require_once '../db/db1.php';
    $sql = 'SELECT `id`, `pass` FROM `users` WHERE `email` = :email';
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    if (!empty($user)){
        $res['error'] = 'Пользователь с таким email уже зарегистрирован';
        break;
    }

    if (strlen($res['error']) != 0) {
        break;
    }

    $userId = $email;
    $secret = 'sec!ReT423*&';
    $expiration = time() + 600;
    $issuer = 'localhost';

    $token = Token::create($userId, $secret, $expiration, $issuer);
    print($token);

    ///$res['token'] = $token;

    // $res['time'] = 1 hour

    // $to = $email;
    // $subject = "=?utf-8?B?".base64_encode("Новое сообщение с сайта golovactiki.ru")."?=";
    // $headers = "From: andronov.kolya@ya.ru\r\nReply-to: andronov.kolya@ya.ru\r\nContent-type: text/html; charset=utf-8\r\n";

    $mess = "Ваш код подтверждения: http://golova.loc/reg.php?token=" . $token;
    // mail($to, $subject, $mess, $headers);

    $res['success'] = 1;
    break;
case 'checkCode':
    $user_code = trim(filter_var($_POST['user_code'], FILTER_SANITIZE_NUMBER_INT));
    if (!array_key_exists('code', $_COOKIE) or($_COOKIE['code'] == '')) {
        $res['error'] = 'Внутренняя ошибка. Попробуйте снова';
    } else if ($user_code == $_COOKIE['code']) {
        $res['success'] = 1;
        setcookie('email', $email, $arr_cookie_options);
    } else {
        $res['error'] = 'Введен неправильный код из письма';
    }
} // end of switch

if ($res['success']) {
    http_response_code(200);
} else {
    http_response_code(400);
}

print json_encode($res);