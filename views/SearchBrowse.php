<?php
    include 'header.php';
    require_once '../controllers/ctrBook.php';
    if (isset($_GET['CatId'])) {
        $ctrBook = new ctrBook();
        $res = $ctrBook->buscaLivroCategoria($_GET['CatId']);
        ?>
        <br>
        <div class="container #e0e0e0 grey lighten-2">
            <div class="row">
                <div class="col s12 m12 l12">
        <?php
        foreach ($res as $book){
            ?>
            <div class="col s1 m1 l1">
                <br>
                <a class="booktitle" href="productPage.php?isbn=<?php echo $book['ISBN']; ?>">
                    <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$book['ISBN'];?>.01.THUMBZZZ.jpg">
                </a>
            </div>
            <div class="col s11 m11 l11">
                <p><strong><a href="productPage.php?isbn=<?php echo $book['ISBN']; ?>"><i><?php echo $book['title'];?></i></a></strong>
                    <?php
                    $autores = $ctrBook->autores($book['ISBN']);
                    ?>
                    | <strong>By:</strong>
                    <?php
                    foreach ($autores as $autor){
                        ?>
                        <a href="SearchBrowse.php?search=<?php echo $autor['nameL']; ?>"><?php echo $autor['nameF'].' '.$autor['nameL'] ?>;</a>
                        <?php
                    }
                    ?>
                    <?php echo substr($book['description'],0,250); ?>
                    <a href="productPage.php?isbn=<?php echo $book['ISBN']; ?>">mais...</a> </p>
            </div>
            <?php
        }
        ?>
                </div>
            </div>
        </div>
        <?php
    }

    if (isset($_GET['search'])) {
        $ctrBook = new ctrBook();
        $res = $ctrBook->search($_GET['search']);
        $isbna = [];
        ?>
        <br>
        <div class="container #e0e0e0 grey lighten-2">
            <div class="row">
                <div class="col s12 m12 l12">
        <?php
        foreach ($res as $book){
            if( !in_array($book['ISBN'], $isbna)){
                ?>
                <div class="col s1 m1 l1">
                    <br>
                    <a class="booktitle" href="productPage.php?isbn=<?php echo $book['ISBN']; ?>">
                        <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$book['ISBN'];?>.01.THUMBZZZ.jpg">
                    </a>
                </div>
                <div class="col s11 m11 l11">
                    <p><strong><a href="productPage.php?isbn=<?php echo $book['ISBN']; ?>"><i><?php echo $book['title'];?></i></a></strong>
                        <?php
                        $autores = $ctrBook->autores($book['ISBN']);
                        ?>
                        | <strong>By:</strong>
                        <?php
                        foreach ($autores as $autor){
                            ?>
                            <a href="SearchBrowse.php?search=<?php echo $autor['nameL']; ?>"><?php echo $autor['nameF'].' '.$autor['nameL']; ?>;</a>
                            <?php
                        }
                        ?>
                        <?php echo substr($book['description'],0,250); ?>
                        <a href="productPage.php?isbn=<?php echo $book['ISBN']; ?>">mais...</a> </p>
                </div>
                <?php
                $isbna[] = $book['ISBN'];
            }

        }
        ?>
                </div>
            </div>
        </div>
            <?php
}
?>

<?php
    include 'footer.php';
?>
