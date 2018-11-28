<?php
    include 'header.php';
    require_once '../controllers/ctrUser.php';
    require_once '../controllers/ctrBook.php';
    if(isset($_GET['id'])){
        $ctrUser = new ctrUser();
        $res = $ctrUser->historico($_GET['id']);
        ?>
        <br><br>
        <?php
        if($res){
            foreach ($res as $result){
                ?>

                <div class="container z-depth-3 #e0e0e0 grey lighten-2">
                    <div class="row">
                        <div class="col s12 m12 l12 push-l1">
                            <div class="row">
                                <br>
                                <div class="col s1 m1 l1">
                                    <a class="booktitle" href="productPage.php?isbn=<?=$result['ISBN']?>"><img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$result['ISBN']?>.01.THUMBZZZ.jpg"></a>
                                </div>
                                <div class="col s11 m11 l11">
                                    <p><strong>Nº do pedido:</strong> <?= $result['orderID'] ?> - <strong>Data:</strong> <?= $result['orderdate'] ?><strong> - Quantidade: </strong>
                                        <?= $result['qty']?></p>
                                    <h4><p><?= $result['title'] ?></p></h4>
                                    <h5><?php
                                        $ctrBook = new ctrBook();
                                        $autores = $ctrBook->autores($result['ISBN']);
                                        ?>
                                        <p>By:</p>
                                        <?php
                                        foreach ($autores as $autor){
                                            ?>
                                            <a href="SearchBrowse.php?search=<?php echo $autor['nameL']; ?>"><?php echo $autor['nameF'].' '.$autor['nameL'] ?>;</a>
                                            <?php
                                        }
                                        ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
     <?php
            }
        } else{
            ?>
            <br><br><br>
            <h3>Você ainda não tem pedidos, meu consagrado!</h3>
            <br><br><br><br><br><br><br><br><br><br>
            <?php
        }
    }

    include 'footer.php';
?>