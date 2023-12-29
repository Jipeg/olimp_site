<!DOCTYPE html>
<html lang="en">
<head>
<?php
if(!array_key_exists('log', $_COOKIE) or ($_COOKIE['log'] == '')) $website_title = 'Авторизация на сайте';
else $website_title = "Кабинет пользователя [{$_COOKIE['log']}]";
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
        <?php 
        if(!array_key_exists('log', $_COOKIE) or($_COOKIE['log'] == '')): // Авторизация
        ?>
          <h4>Авторизация</h4>
          <form>
            <label for="login">Логин</label>
            <input type="text" name="login" id="login" class="form-control">

            <label for="pass">Ваш пароль</label>
            <input type="password" name="pass" id="pass" class="form-control">

            <div class="alert alert-danger mt-2" id="errorBlock"></div>
            <button type="button" id="loginButton" class="btn btn-success mt-3">Войти</button>
          </form>
        <?php 
        else: // Кабинет пользователя
        ?>
        <?php
            require_once 'db/db1.php';
            $sql = "SELECT * from users_data WHERE `user_id` = ? order by `id` DESC limit 1" ;
            $query = $pdo->prepare($sql);
            $query->execute([$_COOKIE['log']]);
            $user_data = $query->fetch(PDO::FETCH_OBJ);    
        ?>
        <div class="card">
          <h2 class="card-header">
            Кабинет пользователя <?= $user_data->name ?? '"Имя не введено"'?> <button class="btn btn-danger float-end" id="exit_btn">Выйти</button>
          </h2>
          
          <?php 
            if($user_data->is_valid != null): // Дать ссылку
          ?>
          <div class="card-body">
            Ваша ссылка: <a href="https://www.yandex.ru">Yandex</a>
          </div>
          <?php 
            else:
          ?>
          <div class="card-body">
            Здесь будет ссылка на контест, если корректно заполните все поля
          </div>
          <?php 
            endif;
          ?>
        </div>
        <div class="card mt-3">
          <h2 class="card-header">Регистрация на олимпиаду</h2>
          <div class="card-body">
            Для участия в олимпиаде необходимо заполнить все, указанные ниже поля. После этого в течении нескольких дней будет проверена их корректность и будет опубликована ссылка на контест или уведомление о полях, которые необходимо исправить.   
          </div>
        </div>
        <div class="card mt-3">
          <h2 class="card-header">Ваши данные</h2>
          <div class="card-body">
            <form>
              <label for="name">Имя</label>
              <input type="text" name="name" id="name" class="form-control mb-4" value="<?= $user_data->name ?? '' ?>">

              <label for="family">Фамилия</label>
              <input type="text" name="family" id="family" class="form-control mb-4" value="<?= $user_data->family ?? '' ?>">

              <label for="yandex">Почта Yandex!</label>
              <input type="text" name="yandex" id="yandex" class="form-control mb-4" value="<?= $user_data->yandex ?? '' ?>">

              <label for="class_num">Номер класса</label>
              <input type="text" name="class_num" id="class_num" class="form-control mb-4" value="<?= $user_data->class ?? '' ?>">

              <label for="age">Полных лет</label>
              <input type="text" name="age" id="age" class="form-control mb-4" value="<?= $user_data->age ?? '' ?>">

              <label for="town">Город (поселок)</label>
              <input type="text" name="town" id="town" class="form-control mb-4" value="<?= $user_data->town ?? '' ?>">

              <label for="region">Район г.Санкт-Петербурга</label>
              <input type="text" name="region" id="region" class="form-control mb-4" value="<?= $user_data->region ?? '' ?>">

              <label for="school">Школа (полное название)</label>
              <input type="text" name="school" id="school" class="form-control mb-4" value="<?= $user_data->school ?? '' ?>">

              <label for="dtu">Образовательное учреждение дополнительного образования (полное название)</label>
              <input type="text" name="dtu" id="dtu" class="form-control mb-4" value="<?= $user_data->dtu ?? '' ?>">

              <label for="language">Язык программирования</label>
              <input type="text" name="language" id="language" class="form-control mb-4" value="<?= $user_data->language ?? '' ?>">

              <label for="teacher">ФИО педагога информатики и должность</label>
              <input type="text" name="teacher" id="teacher" class="form-control mb-4" value="<?= $user_data->teacher ?? '' ?>">

              <label for="teacher_phone">Контактный телефон педагога</label>
              <input type="text" name="teacher_phone" id="teacher_phone" class="form-control mb-4" value="<?= $user_data->teacher_phone ?? '' ?>">

              <label for="teacher_email">Адрес электронной почты педагога</label>
              <input type="text" name="teacher_email" id="teacher_email" class="form-control mb-4" value="<?= $user_data->teacher_email ?? '' ?>">

              <div class="alert alert-danger mt-2" id="errorBlock"></div>
              <button type="button" id="statusDataButton" class="btn btn-success mt-3" disabled>
                <?= empty($user_data) ? 'Данные НЕ отправлены' : 'Данные отправлены' ?>
              </button>
              <button type="button" id="saveDataButton" class="btn btn-success mt-3">Сохранить</button>
              <div class="alert alert-danger mt-2" id="errorBlock"></div>
            </form>  
          </div>
        </div>
        <?php 
        endif;
        ?>
      </div>

      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>

<!-- скрипт для сохранения данных -->
<script>
$('#saveDataButton').click(function() {
  var name = $('#name').val();
  var family = $('#family').val();
  var yandex = $('#yandex').val();
  var class_num = $('#class_num').val();
  var age = $('#age').val();
  var town = $('#town').val();
  var region = $('#region').val();
  var school = $('#school').val();
  var dtu = $('#dtu').val();
  var language = $('#language').val();
  var teacher = $('#teacher').val();
  var teacher_phone = $('#teacher_phone').val();
  var teacher_email = $('#teacher_email').val();

  $.ajax({
    url: '/ajax/saveData.php',
    type: 'POST',
    cache: false,
    data: {'name': name, 'family': family, 'yandex': yandex, 'class_num': class_num, 'age': age, 'town': town, 'region': region, 'school': school, 'dtu': dtu, 'language': language, 'teacher': teacher, 'teacher_phone': teacher_phone, 'teacher_email': teacher_email},
    dataType: 'html',
    success: function(data) {
      if (data == 'готово') {
        const btn = document.querySelector('#saveDataButton');
        btn.disabled = true;
        btn.classList.remove("btn-success");
        btn.setAttribute('title', 'Данные сохранены');
        $('#saveDataButton').text('Данные сохранены');
        $('#errorBlock').hide();
        document.location.reload(true);
      }
      else {
        $('#errorBlock').show();
        $('#errorBlock').text(data);
        $('#saveDataButton').text('Сохранить');
      }
    }
  })
})
</script>

 <!-- скрипт для выхода -->
<script>
$('#exit_btn').click(function() {
  $.ajax({
    url: 'ajax/exit.php',
    type: 'POST',
    cache: false,
    data: {},
    dataType: 'html',
    success: function(data) {
        document.location.reload(true);
    }
  })
})
</script>

<!-- скрипт для входа -->
<script>
  $('#loginButton').click(function(e) {
    var login = $('#login').val();
    var pass = $('#pass').val();

  $.ajax({
    url: '/ajax/auth.php',
    type: 'POST',
    cache: false,
    data: {'login': login, 'pass': pass},
    dataType: 'html',
    success: function(data) {
      if (data == 'готово') {
        $('#loginButton').text('готово');
        $('#errorBlock').hide();
        document.location.reload(true);
      }
      else {
        $('#errorBlock').show();
        $('#errorBlock').text(data);
        $('#loginButton').text('Войти');
      }
    }
  })
})
</script>
        
</body>
</html>