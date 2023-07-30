<!DOCTYPE html>
<html lang="en">
<head>
<?php
$website_title = 'Обратная связь';
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
      <h4>Обратная связь</h4>
          <form>
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username" class="form-control">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">

            <label for="mess">Текст сообщения</label>
            <textarea name="mess" id="mess" class="form-control"></textarea>

            <div class="alert alert-danger mt-2" id="errorBlock"></div>
            <button type="button" id="email_send" class="btn btn-success mt-3">Отправить письмо</button>
          </form>
      </div>
      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$('#email_send').click(function() {
  var name = $('#username').val();
  var email = $('#email').val();
  var mess = $('#mess').val();

  $.ajax({
    url: 'ajax/email.php',
    type: 'POST',
    cache: false,
    data: {'username': name, 'email': email, 'mess': mess},
    dataType: 'html',
    success: function(data) {
      if (data == 'Готово') {
        $('#errorBlock').hide();
        $('#username').val("");
        $('#email').val("");
        $('#mess').val("");
        //$('#email_send').text('Сооб');
      }
      else {
        $('#errorBlock').show();
        $('#errorBlock').text(data);

        $('#email_send').text('Отправить письмо');
      }
    }
  })
})
</script>

</body>
</html>