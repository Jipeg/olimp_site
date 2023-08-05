<?php
    $id = $_POST['id'];
    if (!$id) {
        console.log('Id статьи не корректен!');
        echo 'Id статьи не корректен!';
        exit();
    }

    require_once '../db/db1.php';
    $sql = 'DELETE FROM articles WHERE `id` = :id';
    $query = $pdo->prepare($sql);
    if($query->execute(['id' => $id])) {
        echo 'Готово';
    }
    else {
        echo 'Не удалилось!';
    }
?>