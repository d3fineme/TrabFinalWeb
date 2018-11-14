<?php
	include 'header.php';
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
		    <form class="col s10 m10 l10 push-l1">
		      	<div class="row">
			        <div class="input-field col s4">
			          	<input id="first_name" type="text" class="validate">
			          	<label for="first_name">Nome</label>
			        </div>
			        <div class="input-field col s4">
			          	<input id="last_name" type="text" class="validate">
			          	<label for="last_name">Sobrenome</label>
			        </div>
			        <div class="input-field col s4">
			          	<input id="email" type="email" class="validate">
			          	<label for="email">Email</label>
			        </div>
		      	</div>
		      	<div class="row">
			        <div class="input-field col s4">
			          <input id="end" type="text" class="validate">
			          <label for="end">Endereço</label>
		        	</div>
			        <div class="input-field col s4">
			        	<input id="cidade" type="text" class="validate">
			          	<label for="cidade">Cidade</label>
			        </div>
			        <div class="input-field col s2">
			          	<input id="estado" type="text" class="validate">
			          	<label for="estado">Estado</label>
			        </div>
			        <div class="input-field col s2">
			          	<input id="cep" type="number" class="validate">
			          	<label for="cep">CEP</label>
			        </div>
		      	</div>
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
		include 'footer.php';
	?>