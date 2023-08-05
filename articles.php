<!DOCTYPE html>
<html lang="en">
<head>
<?php
setlocale(LC_TIME, 'ru_RU', 'russian');

require_once 'db/db1.php';
$sql = 'SELECT * from articles WHERE `id` =:id';
$query = $pdo->prepare($sql);
$id = $_GET['id'];
$query->execute(['id' => $id]);
$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = $article->title;
require 'blocks/head.php';
?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<main class="container mt-5">
  <div class="row">
      <div class="col-md-8 mb-5">
          <div class="jumbotron mb-5">
            <h1><?=$article->title?></h1>
            <p>Дата: <u><?=date("D, j F Y, G:i:s", $article->date)?></u></p>
            <p>Автор: <mark><?=$article->author?></mark></p>
            <p>
                <?=$article->intro?>
                <br><br>
                <?=$article->text?>
            </p>
          </div>

          <h4>Добавить комментарий</h4>
          <form method="post" action="articles.php?id=<?=$article->id?>">
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username" class="form-control">
 
            <label for="mess">Текст комментария</label>
            <textarea name="mess" id="mess" class="form-control"></textarea>

            <button type="submit" id="addComment" class="btn btn-success mt-3 mb-5">Добавить комментарий</button>
          </form>

          <?php
            if ($_POST['username'] != '' && $_POST['mess'] != ''){
              $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
              $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

              $sql = 'INSERT INTO solutions(username, code, solution_id) VALUES (?,?,?)';
              $query = $pdo->prepare($sql);
              $query->execute([$username, $mess, $_GET['id']]);
            }

            $sql = 'SELECT * FROM solutions WHERE `article_id` = :id ORDER BY `id` DESC';
            $query = $pdo->prepare($sql);
            $query->execute(['id' => $_GET['id']]);
            //echo "qweqweqweqwe";
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($comments as $comment) {
              echo "<div class='alert alert-info'>
                <h4 class='mb-3'>$comment->username</h4>
                <p>$comment->mess</p>
              </div>";
            }
          ?>


          
      </div>
      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>