<?php
require_once '../controllers/ctrUser.php';
require_once '../controllers/ctrOrder.php';
require_once '../controllers/ctrBook.php';


//cookie
$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
    $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
//$addISBN = CleanISBN($_GET['addISBN']);
@$addISBN = $_GET['addISBN'];
if (!empty($addISBN)) {
    if (isset($addISBN, $bookArray)) {
        // Increment by +1
        @$bookArray[$addISBN] += 1;
    } else {
        // Add new item to cart
        $bookArray[$addISBN] = 1;
    }
}
// Remove items from cart
//$deleteISBN = CleanISBN($_GET['deleteISBN']);
@$deleteISBN = $_GET['deleteISBN'];
if (!empty($deleteISBN)) {
    if (isset($bookArray[$deleteISBN])) {
        // Deincrement by 1
        $bookArray[$deleteISBN] -= 1;
        // remove ISBN from array if qty==0
        if ($bookArray[$deleteISBN] == 0) {
            unset($bookArray[$deleteISBN]);
        }
    }
}



if (isset($bookArray)) {
    // Write cookie
    setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

    //Count total books in cart
    $totalbooks = 0;
    foreach ($bookArray as $isbn => $qty) {
        $totalbooks += $qty;
    }
    setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}


$ctrBook = new ctrBook();
$valor = 0;
$frete = 0;
foreach ($bookArray as $isbn => $qtd) {
    $res = $ctrBook->retornaLivro($isbn);
    $valor += ($res['price']*$qtd)*0.8;
}
$frete = (($totalbooks-1)*5)+10;


$valorfinal = $valor + $frete;
setcookie("myCart2", '', time() - 3600);
include '../views/header.php';

$ctrUser = new ctrUser();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['acao'] == 1) {
        if($_POST['email'] != $_POST['atualizacao']){
            $ctrUser->atualizaUser($_POST['email'], $_POST['name'], $_POST['sobrenome'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['atualizacao']);
        }else{
            $ctrUser->atualizaUser($_POST['email'], $_POST['name'], $_POST['sobrenome'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['email']);
        }
        $res = $ctrUser->buscaEmail($_POST['email']);
        ?>
        <!-- apresentação de qualquer livro, se clicar numa categoria, aparece os daquela categori, portanto é bom colocar um arquivo showBooks.php -->
        <br><br><br><br><br><br><br><br>
        <div class="container #e0e0e0 grey lighten-2">
        <div class="row center">
        <div class="col s10 m10 l10 push-l1">
        <?php
        //To do:
        // 1. Build sql statement containing ISBNs. Use foreach loop.
        // 2. Execute sql and display book titles, prices, qty, etc.
        if (count($bookArray)) {
            $ctrOrder = new ctrOrder();
            $pedido = $ctrOrder->pedido($res['custID'], date('y/m/d') );?>
            <h4><strong>Número do Pedido: </strong><?php echo $pedido; ?></h4>
            <p><strong>Dados de entrega:</strong> <?php echo $res['fname']; echo ' '; echo $res['lname']; echo "<br>"; $res['street']; echo " - "; echo $res['city'];
                echo " - "; echo $res['state']; echo " - "; echo $res['zip']?></p>
            <br>
            <table id='cart'>
                <tr>
                    <th>Título</th>
                    <th> Quantidade </th>
                    <th> Preço Unitário</th>
                    <th> Preço Total</th>
                </tr>
                <?php
                foreach ($bookArray as $isbn => $qty) {

                    ?>
                    <tr>
                        <td>
                            <a class='booktitle' href='ProductPage.php?isbn=<?=$isbn?>'><?php $book = $ctrBook->retornaLivro($isbn);
                                echo $book['title'];?></a> </td>
                        <td><?=$qty?></td>
                        <td>
                            <?php
                            $pc = $ctrBook->retornaLivro($isbn);
                            echo $pc['price'];
                            ?>
                        </td>
                        <td>
                            <?php echo $pc['price']*$qty?>
                        </td>
                    </tr>

                    <?php
                    $ctrOrder = new ctrOrder();
                    $ctrOrder->itensPedido($pedido,$isbn,$qty, $pc['price']);
                }
                ?>
            </table>
            <p><strong>Sub-total: </strong>R$<?php echo number_format($valor,2); ?></p>
            <p><strong>Frete: </strong>R$<?php echo $frete; ?></p>
            <p><strong>Valor final: </strong><?php echo number_format($valorfinal,2); ?></p>
            </div>
            </div>
            <?php
            $headers = "From: TechBook <felipe.unifei.sin@gmail.com> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8 \r\n";
            $emaildecompra1 = "<html><body><h4><strong>Número do Pedido: </strong>".$pedido."</h4>
                        <p><strong>Dados de entrega:</strong> ".$res['fname'].' '.$res['lname']."<br>" .$res['street']." - ".$res['city']." - ".$res['state']." - ".$res['zip']."</p>
                        <br>
                        <table id='cart'>
                            <tr>
                                <th>Título</th>
                                <th> Quantidade </th>
                                <th> Preço Unitário</th>
                                <th> Preço Total</th>
                            </tr>";
            foreach ($bookArray as $isbn => $qty) {
                $book = $ctrBook->retornaLivro($isbn);
                $pc = $ctrBook->retornaLivro($isbn);
                $emaildecompra2 = "<tr>
                                <td>".$book['title']." </td>
                                <td>".$qty."</td>
                                <td>".$pc['price']."
                                </td>
                                <td>".$pc['price']*$qty."
                                </td>
                            </tr>";
            }
            $emaildecompra3 = "</table>
            <p><strong>Sub-total: </strong>R$".number_format($valor,2)."</p>
            <p><strong>Frete: </strong>R$".$frete."</p>
            <p><strong>Valor final: </strong>".number_format($valorfinal,2)."</p></body></html>";
            ?>
            <?php
            mail($res['email'], 'Comprovante de compra realizada na TechBook' ,$emaildecompra1.$emaildecompra2.$emaildecompra3, $headers);
        } else{
            ?>
            <br>
            <div class="container #e0e0e0 grey lighten-2">
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <h3><p>Seu carrinho está vazio, <a href="index.php">Vamos comprar?</a></p></h3>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
            </div>
            <?php
        }

        ?>
        </div>
        </div>
        <div class="row">
            <div class="col s4 m4 l4 push-l2">
                <a href="orderHistory.php?id=<?php echo $res['custID'] ?>" class="btn waves-effect waves-light">Ver histórico de pedido
                    <i class="material-icons right">access_time</i>
                </a>
            </div>
        </div>
        </div>
        <br><br><br><br><br><br><br><br>

        <?php
    }else{
        $name = $_POST['name'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $ctrUser = new ctrUser();
        $res = $ctrUser->cadastrar($email, $name, $sobrenome, $street, $city, $state, $zip);
        if ($res) {
            ?>
            <br><br>
            <div class="container #e0e0e0 grey lighten-2">
            <div class="row center">
                <div class="col s10 m10 l10 push-l1">
                    <?php
                    if (count($bookArray)) {
                    $ctrOrder = new ctrOrder();
                    $pedido = $ctrOrder->pedido($res['custID'], date('y/m/d')); ?>
                    <h4><strong>Número do Pedido: </strong><?php echo $pedido; ?></h4>
                    <p><strong>Dados de entrega:</strong> <?php echo $res['fname'];
                        echo ' ';
                        echo $res['lname'];
                        echo "<br>";
                        $res['street'];
                        echo " - ";
                        echo $res['city'];
                        echo " - ";
                        echo $res['state'];
                        echo " - ";
                        echo $res['zip'] ?></p>
                    <br>
                    <table id='cart'>
                        <tr>
                            <th>Título</th>
                            <th> Quantidade</th>
                            <th> Preço Unitário</th>
                            <th> Preço Total</th>
                        </tr>
                        <?php
                        foreach ($bookArray as $isbn => $qty) {

                            ?>
                            <tr>
                                <td>
                                    <a class='booktitle'
                                       href='ProductPage.php?isbn=<?= $isbn ?>'><?php $book = $ctrBook->retornaLivro($isbn);
                                        echo $book['title']; ?></a></td>
                                <td><?= $qty ?></td>
                                <td>
                                    <?php
                                    $pc = $ctrBook->retornaLivro($isbn);
                                    echo $pc['price'];
                                    ?>
                                </td>
                                <td>
                                    <?php echo $pc['price'] * $qty ?>
                                </td>
                            </tr>

                            <?php
                            $ctrOrder = new ctrOrder();
                            $ctrOrder->itensPedido($pedido, $isbn, $qty, $pc['price']);
                        }
                        ?>
                    </table>
                    <p><strong>Sub-total: </strong>R$<?php echo number_format($valor, 2); ?></p>
                    <p><strong>Frete: </strong>R$<?php echo $frete; ?></p>
                    <p><strong>Valor final: </strong><?php echo number_format($valorfinal, 2); ?></p>
                </div>
            </div>
            <?php
            $headers = "From: TechBook <felipe.unifei.sin@gmail.com> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8     \r\n";
            $emaildecompra1 = "<html><body><h4><strong>Número do Pedido: </strong>".$pedido."</h4>
                        <p><strong>Dados de entrega:</strong> ".$res['fname'].' '.$res['lname']."<br>" .$res['street']." - ".$res['city']." - ".$res['state']." - ".$res['zip']."</p>
                        <br>
                        <table id='cart'>
                            <tr>
                                <th>Título</th>
                                <th> Quantidade </th>
                                <th> Preço Unitário</th>
                                <th> Preço Total</th>
                            </tr>";
            foreach ($bookArray as $isbn => $qty) {
                $book = $ctrBook->retornaLivro($isbn);
                $pc = $ctrBook->retornaLivro($isbn);
                $emaildecompra2 = "<tr>
                                <td>".$book['title']." </td>
                                <td>".$qty."</td>
                                <td>".$pc['price']."
                                </td>
                                <td>".$pc['price']*$qty."
                                </td>
                            </tr>";
            }
            $emaildecompra3 = "</table>
            <p><strong>Sub-total: </strong>R$".number_format($valor,2)."</p>
            <p><strong>Frete: </strong>R$".$frete."</p>
            <p><strong>Valor final: </strong>".number_format($valorfinal,2)."</p></body></html>";
            ?>
            <?php
                mail($res['email'], 'Comprovante de compra realizada na TechBook' ,$emaildecompra1.$emaildecompra2.$emaildecompra3, $headers);
            } else {
                ?>
                <br>
                <div class="container #e0e0e0 grey lighten-2">
                    <div class="row center">
                        <div class="col s12 m12 l12">
                            <p>Seu cadastro foi realizado com sucesso!!</p>
                            <p>Seu carrinho está vazio, <a href="index.php">Vamos comprar?</a></p>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <?php
            } ?>
            <div class="row">
                <div class="col s4 m4 l4 push-l2">
                    <a href="orderHistory.php?id=<?php echo $res['custID'] ?>" class="btn waves-effect waves-light">Ver histórico
                        <i class="material-icons right">access_time</i>
                    </a>
                </div>
            </div>
            <?php
        }
    }
}

include '../views/footer.php';
?>