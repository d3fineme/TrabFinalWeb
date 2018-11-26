<?php
    include 'header.php';
    require_once '../controllers/ctrBook.php';
    if (isset($_GET['CatId'])) {
        $ctrBook = new ctrBook();
        $res = $ctrBook->buscaLivroCategoria($_GET['CatId']);
        foreach ($res as $book){
            echo "<br>";
            echo $book['title'];
        }
    }
    echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
    include 'footer.php';
?>
