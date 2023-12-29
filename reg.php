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

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">

            <button type="button" id="getCodeButton" class="btn btn-success mt-3">Получить код</button><br>

            <?php
              if (isset($_GET['token'])): 
            ?>
            <input type="hidden" name="token" id="token" value="<?=htmlentities($_GET['token'])?>">
            <label for="pass">Ваш пароль</label>
            <input type="password" name="pass" id="pass" class="form-control">
            <button type="button" id="registerButton" class="btn btn-success mt-3">Зарегистрироваться</button>
            <?php
              endif; 
            ?>
            <div class="alert alert-danger mt-2" id="errorBlock"></div>
          </form>
      </div>

      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
 var email = '';

$('#registerButton').click(function() {
  var pass = $('#pass').val();
  var token = $('#token').val();
  $.ajax({
    url: 'ajax/reg.php',
    type: 'POST',
    cache: false,
    data: {
      action: 'register',
      token: token,
      pass: pass
    },
    dataType: 'html',
    success: function(res1) {
      const res = JSON.parse(res1);
      if (res['success']) {
        $('#errorBlock').hide();
        
        const btn = document.querySelector('#registerButton');
        btn.disabled = true;
        $('#registerButton').text('Вы зарегистрированы');
        btn.classList.remove("btn-success");
        btn.setAttribute('title', 'Вы зарегистрированы');
        //btn.classList.add("btn-success");
      }
    },
    error: function(res1) {
        const res = JSON.parse(res1);
        $('#errorBlock').show();
        $('#errorBlock').text(res['error']);
        $('#registerButton').text('Зарегистрироваться');
    }
  })
})

$('#getCodeButton').click(function() {
  email = $('#email').val();
  $.ajax({
    url: 'ajax/reg.php',
    type: 'POST',
    cache: false,
    data: {
      action: 'getCode',
      email: email
    },
    dataType: 'html',
    success: function(res1) {
      const res = JSON.parse(res1);
      if (res['success']) {
        $('#errorBlock').hide();
        $('#getCodeButton').text('Код отправлен');
        var btn = document.querySelector('#getCodeButton');
        btn.disabled = true;
        btn.classList.remove("btn-success");
        btn.setAttribute('title', 'getCodeButton');
        document.querySelector('#email').disabled = true;
        document.querySelector('#checkCodeButton').disabled = false;
        document.querySelector('#code').disabled = false;
        
      }
    },
    error: function(res1) {
        const res = JSON.parse(res1);
        email = '';
        $('#errorBlock').show();
        $('#errorBlock').text(res['error']);
        $('#getCodeButton').text('Подтвердить email');
      }
  })
})

</script>
</body>
</html>