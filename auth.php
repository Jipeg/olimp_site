<!DOCTYPE html>
<html lang="en">
<head>
<?php
$website_title = 'Авторизация на сайте';
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
        <?php 
        if($_COOKIE['log'] == ''):
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
        else:
        ?>
        <h2><?=$_COOKIE['log']?></h2>
        <button class="btn btn-danger" id="exit_btn">Выйти</button>
        <?php 
        endif;
        ?>
      </div>

      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$('#loginButton').click(function() {
  var login = $('#login').val();
  var pass = $('#pass').val();

  $.ajax({
    url: 'ajax/auth.php',
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
</body>
</html>