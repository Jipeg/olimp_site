<aside class="col-md-4">
    <div class="p-3 mb-3 bg-warning rounded">
        <h4><b>Интересные факты</b></h4>
        <?php
            require_once 'db/db1.php';
            
            $sql = 'SELECT `text` from facts where `id` = ' . random_int(2, 11);
            $query = $pdo->query($sql);
            $row = $query->fetch(PDO::FETCH_OBJ);
            echo "<p>$row->text</p>\n";
        ?>
    </div>

    <div class="p-3 mb-3 ">
        <img class="img-thumbnail" src="/img/fact.jpg" alt="факт дня">
    </div>
    
</aside>