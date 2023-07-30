<?php
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
    $text = trim($_POST['text']);

    $error = '';
    if(strlen($title) <= 3){
        $error = 'Введите название';
    } else if(strlen($intro) <= 3){
        $error = 'Введите интро';
    } else if(strlen($text) <= 3){
        $error = 'Введите текст';
    } 

    if (strlen($error) != 0) {
        echo $error;
        exit();
    }

    // echo $pass;
    require_once '../db/db1.php';
    $sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES (?,?,?,?,?)';
    $query = $pdo->prepare($sql);
    $query->execute([$title, $intro, $text, time(), $_COOKIE['log']]);

    echo 'Готово';
?>