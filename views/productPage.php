<?php
    include 'header.php';
    require_once '../controllers/ctrBook.php';
    if(isset($_GET['isbn'])) {
        $ctrBook = new ctrBook();
        $res = $ctrBook->retornaLivro($_GET['isbn']);
        $autores = $ctrBook->autores($_GET['isbn']);
        $preco = $res['price'];
        ?>
        <br>
        <div class="container z-depth-3 #e0e0e0 grey lighten-2">
            <div class="row">
                <div class="col s10 m10 l10 push-l1">
                    <br>
                    <a class="booktitle right z-depth-3" href="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?= $res['ISBN'] ?>.01.LZZZZZZZ.jpg">
                        <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?= $res['ISBN'] ?>.01.MZZZZZZZ.jpg">
                    </a>
                    <a class="btn waves-effect waves-light" href="shoppingCart.php?addISBN=<?= $res['ISBN']; ?>">Adicionar ao carrinho</a>
                    <h4><p><?php echo $res['title'];?></p></h4>
                    By:
                    <?php
                    foreach ($autores as $autor) {

                    ?>
                        <strong> <a href="SearchBrowse.php?search=<?php echo $autor['nameL']; ?>"><?php echo $autor['nameF'].' '.$autor['nameL'] ?>;</a></strong>
                    <?php
                        }
                    ?>
                    <p><strong>Preço:</strong> $<?php echo $preco;?></p>
                    <p><strong>Preço final:</strong> $<?php echo number_format(($preco*0.8),2);?></p>
                    <p><strong>Desconto:</strong> <?php echo ($preco*0.2) ?> (20%)</p>
                    <p><strong>ISBN:</strong> <?php echo $res['ISBN'];?> - <strong>Editora:</strong>
                        <?php echo $res['publisher'];?> -
                        <strong>Páginas:</strong> <?php echo $res['pages'];?> - <strong>Edição:</strong>
                        <?php echo $res['edition'];?></p>
                    <strong>Descrição:</strong><?php echo $res['description']; ?>

                </div>
            </div>
        </div>
        <?php
    }
    include 'footer.php';
?>
