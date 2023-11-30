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
      </div>
      <?php require 'blocks/aside.php'; ?>
  </div>
</main>
    
<?php require 'blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>