<?php
	include '../views/header.php';
?>
  	<!-- apresentação de qualquer livro, se clicar numa categoria, aparece os daquela categori, portanto é bom colocar um arquivo showBooks.php -->
  	<br><br><br><br><br><br><br><br>
  	<div class="container #e0e0e0 grey lighten-2">
  		<div class="row center">
  			<div class="col s12 m12 l12">
  				<h3>Sua conta</h3>
  				<p>Comprar online é rápido e fácil</p>
  			</div>
  		</div>
  		<div class="row">
		    <form action="checkout2.php" method="post" class="col s10 m10 l10">
		      <div class="row">
		        <div class="input-field col s10 m10 l10 push-l2">
		          <input id="email" name="email" type="email" class="validate">
		          <label for="email">Email</label>
		          <span class="helper-text" data-error="wrong" data-success="right"></span>
		          <button class="btn waves-effect waves-light" type="submit">Verificar
				    <i class="material-icons right">send</i>
				  </button>
		        </div>
		      </div>
		    </form>
		  </div>
    </div>
<br><br><br><br><br><br><br><br>

	<?php
		include '../views/footer.php';
	?>