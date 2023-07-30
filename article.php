<?php
if ($_COOKIE['log']=='') {
    header('Location: /olimp_site/reg.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
$website_title = 'Добавление статьи';
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
          <h4>Добавление статьи</h4>
          <form>
            <label for="title">Название статьи</label>
            <input type="text" name="title" id="title" class="form-control">

            <label for="intro">Интро статьи</label>
            <textarea name="intro" id="intro" class="form-control"></textarea>
 
            <label for="text">Текст статьи</label>
            <textarea name="text" id="text" class="form-control"></textarea>

            <div class="alert alert-danger mt-2" id="errorBlock"></div>
            <button type="button" id="addArticleButton" class="btn btn-success mt-3">Добавить</button>
          </form>
      </div>

      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$('#addArticleButton').click(function() {
  var title = $('#title').val();
  var intro = $('#intro').val();
  var text = $('#text').val();

  $.ajax({
    url: 'ajax/addArticle.php',
    type: 'POST',
    cache: false,
    data: {'title': title, 'intro': intro, 'text': text},
    dataType: 'html',
    success: function(data) {
      if (data == 'Готово') {
        $('#errorBlock').hide();
        $('#addArticleButton').text('Статья добавлена');
      }
      else {
        $('#errorBlock').show();
        $('#errorBlock').text(data);

        $('#addArticleButton').text('Добавить');
      }
    }
  })
})

</script>
</body>
</html>