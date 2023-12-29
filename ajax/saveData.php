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
$teacher_email = trim(filter_var($_POST['teacher_email'], FILTER_SANITIZE_EMAIL));
$error = '';
if(!strlen($name)){
    $error = 'Введите имя';
} else if(!strlen($family)){
    $error = 'Введите family';
} else if(!strlen($yandex) or !filter_var($yandex, FILTER_VALIDATE_EMAIL)){
    $error = 'Введите yandex почту';
} else if(!strpos($yandex, "@yandex.ru")){
    $error = 'Введите yandex почту в формате: ...@yandex.ru';
} else if(!$class_num or $class_num>11 or $class_num<1){
    $error = 'Введите номер класса числом';
} else if(!$age or $age > 18 or $age < 5){
    $error = 'Введите возраст числом. (К участию допускаются только участники от 5 до 18 лет)';
} else if(!strlen($town)){
    $error = 'Введите название вашего города';
} else if(!strlen($region)){
    $error = 'Введите название вашего региона';
} else if(!strlen($dtu)){
    $error = 'Введите название центра доп. образования';
} else if(!strlen($language)){
    $error = 'Введите язык программирования';
} else if(!strlen($teacher)){
    $error = 'Введите ФИО педагога';
} else if(!strlen($teacher_phone)){
    $error = 'Введите номер телефона педагога';
} else if(!strlen($teacher_email) or !filter_var($teacher_email, FILTER_VALIDATE_EMAIL)){
    $error = 'Введите email педагога';
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