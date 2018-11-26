<?php
require_once 'controllers/ctrUser.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['acao'] == 1) {
        echo "Usuário cadastrado bitch"

        ?>
        <!-- apresentação de qualquer livro, se clicar numa categoria, aparece os daquela categori, portanto é bom colocar um arquivo showBooks.php -->
        <br><br><br><br><br><br><br><br>
        <div class="container #e0e0e0 grey lighten-2">
            <div class="row center">
                <div class="col s12 m12 l12">
                    <h3>Info</h3>
                    <p>Aqui vai falar se seu carrinho ta vazio</p>
                </div>
            </div>
            <div class="row">

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
        if ($res){
            echo "Beleza, cadastrou";
        }
    }
}
include 'footer.php';
?>