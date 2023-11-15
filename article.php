<?php
if ($_COOKIE['log']=='') {
    header('Location: /reg.php');
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
            <textarea rows="8" name="text" id="text" class="form-control"></textarea>

            <div class="btn-group d-flex justify-content-end " role="group" aria-label="tools">
              <button type="button" id="mkBold" class="btn btn-outline-secondary"><img src="img/type-bold.svg" alt="Bold"></button>
              <button type="button" id="mkItalic" class="btn btn-outline-secondary"><img src="img/type-italic.svg" alt="Italic"></button>
              <button type="button" id="mkCenter" class="btn btn-outline-secondary"><img src="img/text-center.svg" alt="Center"></button>
              <button type="button" id="mkLink" class="btn btn-outline-secondary"><img src="img/link.svg" alt="Link"></button>
              <button type="button" id="mkClean" class="btn btn-outline-secondary"><img src="img/trash.svg" alt="Trash"></button>
            </div>

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
let prefixStr = "";
let sufixStr = "";
let selectedStr = "";

let elem = undefined;

$('#mkBold').click( function(event) {
  $('#text').val(prefixStr + '<b>' + selectedStr + '</b>' + sufixStr);
});

$('#mkItalic').click( () => {
  $('#text').val(prefixStr + '<i>' + selectedStr + '</i>' + sufixStr);
});

$('#mkCenter').click( () => {
  $('#text').val(prefixStr + '<div style="text-align:center">' + selectedStr + '</div>' + sufixStr);
});

$('#mkLink').click( () => {
  $('#text').val(prefixStr + '<a href="' + selectedStr + '">' + selectedStr + '</a>' + sufixStr);
});

$('#mkClean').click( () => {
  $('#text').val("");
});

$('#text').select(function(event) {
  elem = $('#text');
  console.log(elem);

  let start = elem.prop("selectionStart");
  let end = elem.prop("selectionEnd");
  console.log(start, end);
  
  prefixStr = elem.val().substring(0, start);
  sufixStr = elem.val().substring(end, elem.val().length);
  selectedStr = elem.val().substring(start, end);
  console.log(prefixStr + '*' + selectedStr + '*' + sufixStr);
});

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
});

</script>
</body>
</html>