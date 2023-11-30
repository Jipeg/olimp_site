<?php
$user_id = $_COOKIE['log'];
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING)) ?? '';
$family = trim(filter_var($_POST['family'], FILTER_SANITIZE_STRING));
$yandex = trim(filter_var($_POST['yandex'], FILTER_SANITIZE_EMAIL));
$class_num = trim(filter_var($_POST['class_num'], FILTER_SANITIZE_NUMBER_INT));
$age = trim(filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT));

$town = trim(filter_var($_POST['town'], FILTER_SANITIZE_STRING));
$region = trim(filter_var($_POST['region'], FILTER_SANITIZE_STRING));
$school = trim(filter_var($_POST['school'], FILTER_SANITIZE_STRING));
$dtu = trim(filter_var($_POST['dtu'], FILTER_SANITIZE_STRING));
$language = trim(filter_var($_POST['language'], FILTER_SANITIZE_STRING));
$teacher = trim(filter_var($_POST['teacher'], FILTER_SANITIZE_STRING));
$teacher_phone = trim(filter_var($_POST['teacher_phone'], FILTER_SANITIZE_STRING));
$teacher_email = trim(filter_var($_POST['teacher_email'], FILTER_SANITIZE_STRING));
$error = '';
if(!strlen($name)){
    $error = 'Введите имя';
} else if(!strlen($family)){
    $error = 'Введите family';
} else if(!strlen($yandex)){
    $error = 'Введите yandex';
}else if(!$class_num or $class_num>11){
    $error = 'Введите class_num';
} else if(!$age or $age > 18){
    $error = 'Введите age';
} else if(!strlen($town)){
    $error = 'Введите town';
} else if(!strlen($region)){
    $error = 'Введите region';
} else if(!strlen($dtu)){
    $error = 'Введите dtu';
} else if(!strlen($language)){
    $error = 'Введите language';
} else if(!strlen($teacher)){
    $error = 'Введите teacher';
} else if(!strlen($teacher_phone)){
    $error = 'Введите teacher_phone';
} else if(!strlen($teacher_email)){
    $error = 'Введите teacher_email';
}

if (strlen($error) != 0) {
    echo $error;
    exit();
}

require_once '../db/db1.php';
// check if data already existed

$sql = 'INSERT INTO `users_data` (`user_id`, `name`, `family`, `yandex`, `class`, `age`, `town`, `region`, `school`, `dtu`, `language`, `teacher`,    `teacher_phone`, `teacher_email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([
    $user_id,
    $name,
    $family,
    $yandex,
    $class_num,
    $age,
    $town,
    $region,
    $school,
    $dtu,
    $language,
    $teacher,
    $teacher_phone,
    $teacher_email
]);

echo 'готово';