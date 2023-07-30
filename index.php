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
          <?php
            require_once 'db/db1.php';
            $sql = 'SELECT * from articles ORDER BY `date` DESC';
            $query = $pdo->query($sql);
            while($row = $query->fetch(PDO::FETCH_OBJ)) {
              echo "<h2 >$row->title</h2>
              <p>$row->intro</p>
              <p>Автор: <mark>$row->author</mark></p>
              <a href='articles.php?id=$row->id'>
                <button class='btn btn-warning mb-5' href='qwe.php'>Читать целиком</button>
              </a>";
              
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