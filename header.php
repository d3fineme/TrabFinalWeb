<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Livraria</title>
	<link rel="shortcut icon" href="img/icon.png" type="image/x-icon" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <style type="text/css">
    body{
    	background-image: url("img/livro.jpg");
    	background-size: 100%;
    }
    </style>
</head>
<body class="#fafafa grey lighten-5">
	<div class="navbar-fixed">
	    <nav class="z-depth-3 nav-extended #b0bec5 blue-grey lighten-3">
		    <div class="nav-wrapper container">
		      	<a href="index.php" class="brand-logo"><img src="img/logo.png"></a>
		      	<a href="#" data-activates="menu-mobile" class="button-collapse">
		      		<i class="material-icons">menu</i>
		      	</a>

		      	<ul id="nav-mobile" class="right hide-on-med-and-down">
			        <li><input type="text" placeholder="Search.." style="width: 200px;"><i class="material-icons right">search</i></li>
			        <li><a href="#"><i class="material-icons right">shopping_cart</i>Carrinho</a></li>
			        <li><a href="checkout1.php"><i class="material-icons right">person_outline</i>Usuário</a></li>
			        <li><a class="dropdown-button" data-activates="dropdown" href="#" data-beloworigin="true"><i class="material-icons right">arrow_drop_down</i>Categorias</a></li>
		      	</ul>

		    </div>
		</nav>
	</div>

	<!-- dropdown -->
	<ul class="dropdown-content" id="dropdown">
		<li><a href="">ASP.NET</a></li>
		<li><a href="">JavaScript</a></li>
		<li><a href="">MySQL</a></li>
		<li><a href="">PHP</a></li>
		<li><a href="">Regular Expressions</a></li>
		<li><a href="">SQL</a></li>
		<li><a href="">Web Usability</a></li>
	</ul>

	<!-- menu mobile -->
	<ul id="menu-mobile" class="side-nav">
        <li><input type="text" placeholder="Search.." style="width: 200px;"><i class="material-icons right">search</i></li>
        <li><a href="#"><i class="material-icons right">shopping_cart</i>Carrinho</a></li>
        <li><a href="checkout1.php"><i class="material-icons right">person_outline</i>Usuário</a></li>
        <li><a href="#" data-beloworigin="true"><i class="material-icons right">arrow_drop_down</i>Categorias</a></li>
        <li class="center"><a href="">ASP.NET</a></li>
		<li class="center"><a href="">JavaScript</a></li>
		<li class="center"><a href="">MySQL</a></li>
		<li class="center"><a href="">PHP</a></li>
		<li class="center"><a href="">Regular Expressions</a></li>
		<li class="center"><a href="">SQL</a></li>
		<li class="center"><a href="">Web Usability</a></li>
  	</ul>