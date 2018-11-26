<?php
    require_once 'controllers/ctrUser.php';
    include 'header.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['email']) && $_POST['email'] != ''){
            $ctrUser = new ctrUser();
            $res = $ctrUser->buscaEmail($_POST['email']);
            if($res){
                $name = $res['fname'];
                $sobrenome = $res['lname'];
                $email = $res['email'];
                $street = $res['street'];
                $city = $res['city'];
                $state = $res['state'];
                $zip = $res['zip'];

?>
  	<!-- apresentação de qualquer livro, se clicar numa categoria, aparece os daquela categori, portanto é bom colocar um arquivo showBooks.php -->
  	<br><br><br><br><br><br>
  	<div class="container #e0e0e0 grey lighten-2">
  		<div class="row center">
  			<div class="col s12 m12 l12">
  				<h3>Sua conta</h3>
  				<p>Comprar online é rápido e fácil</p>
  			</div>
  		</div>
  		<div class="row">
		    <form action="checkout3.php" method="post" class="col s10 m10 l10 push-l1">
		      	<div class="row">
			        <div class="input-field col s4">
			          	<input id="first_name" name="name" type="text" class="validate" value="<?php echo $name; ?>">
			          	<label for="first_name">Nome</label>
			        </div>
			        <div class="input-field col s4">
			          	<input id="last_name" name="sobrenome" type="text" class="validate" value="<?php echo $sobrenome; ?>">
			          	<label for="last_name">Sobrenome</label>
			        </div>
			        <div class="input-field col s4">
			          	<input id="email" type="email" name="email" class="validate" value="<?php echo $email; ?>">
			          	<label for="email">Email</label>
			        </div>
		      	</div>
		      	<div class="row">
			        <div class="input-field col s4">
			          <input id="end" type="text" name="street" class="validate" value="<?php echo $street; ?>">
			          <label for="end">Endereço</label>
		        	</div>
			        <div class="input-field col s4">
			        	<input id="cidade" type="text" name="city" class="validate" value="<?php echo $city; ?>">
			          	<label for="cidade">Cidade</label>
			        </div>
			        <div class="input-field col s2">
			          	<input id="estado" type="text" name="state" class="validate" value="<?php echo $state; ?>">
			          	<label for="estado">Estado</label>
			        </div>
			        <div class="input-field col s2">
			          	<input id="cep" type="number" name="zip" class="validate" value="<?php echo $zip; ?>">
			          	<label for="cep">CEP</label>
			        </div>
		      	</div>
                <input id="acao" name="acao" type="text" value="1" hidden>
		      	<div class="row">
			      	<button class="btn waves-effect waves-light" type="submit" name="action">Faça seu pedido!
					   <i class="material-icons right">send</i>
					</button>
					<button class="btn waves-effect waves-light" type="submit" name="action">Ver histórico de pedido
					   <i class="material-icons right">access_time</i>
					</button>
				</div>
		    </form>
		 </div>
    </div>
<br><br><br><br><br>

	<?php
            }
            else{

    ?>
                <br><br><br><br><br><br>
                <div class="container #e0e0e0 grey lighten-2">
                    <div class="row center">
                        <div class="col s12 m12 l12">
                            <h3>Sua conta</h3>
                            <p>Comprar online é rápido e fácil</p>
                        </div>
                    </div>
                    <div class="row">
                        <form action="checkout3.php" method="post" class="col s10 m10 l10 push-l1">
                            <div class="row">
                                <div class="input-field col s4">
                                    <input id="first_name" name="name" type="text" class="validate">
                                    <label for="first_name">Nome</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="last_name" name="sobrenome" type="text" class="validate">
                                    <label for="last_name">Sobrenome</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="email" type="email" name="email" class="validate" value="<?php echo $_POST['email']; ?>">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input id="end" type="text" name="street" class="validate">
                                    <label for="end">Endereço</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="cidade" type="text" name="city" class="validate">
                                    <label for="cidade">Cidade</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="estado" type="text" name="state" class="validate">
                                    <label for="estado">Estado</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="cep" type="number" name="zip" class="validate">
                                    <label for="cep">CEP</label>
                                </div>
                            </div>
                            <input id="acao" name="acao" type="text" value="0" hidden>
                            <div class="row">
                                <button class="btn waves-effect waves-light" type="submit">Cadastrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br><br><br><br>

<?php
            }
        }
    }

    include 'footer.php';
?>
