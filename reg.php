<!DOCTYPE html>
<html lang="en">
<head>
<?php
$website_title = 'Главная';
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
          <h4>Регистрация</h4>
          <form>
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username" class="form-control">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">

            <label for="login">Логин</label>
            <input type="text" name="login" id="login" class="form-control">

            <label for="pass">Ваш пароль</label>
            <input type="password" name="pass" id="pass" class="form-control">

            <div class="alert alert-danger mt-2" id="errorBlock"></div>
            <button type="button" id="registerButton" class="btn btn-success mt-3">Зарегистрироваться</button>
          </form>
      </div>

      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$('#registerButton').click(function() {
  var name = $('#username').val();
  var email = $('#email').val();
  var login = $('#login').val();
  var pass = $('#pass').val();

  $.ajax({
    url: 'ajax/reg.php',
    type: 'POST',
    cache: false,
    data: {'username': name, 'email': email, 'login': login, 'pass': pass},
    dataType: 'html',
    success: function(data) {
      if (data == 'Готово') {
        $('#errorBlock').hide();
        $('#registerButton').text('Вы зарегистрированы');
      }
      else {
        $('#errorBlock').show();
        $('#errorBlock').text(data);

        $('#registerButton').text('Зарегистрироваться');
      }
    }
  })
})

</script>
</body>
</html>