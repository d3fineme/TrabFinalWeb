<?php
	include 'header.php';
	require_once '../controllers/ctrBook.php';
	$ctrBook = new ctrBook();
	$res = $ctrBook->livros();
	$isbn = [];
	foreach ($res as $r){
	    $isbn[]=(string)$r['ISBN'];
    }
	$alet1 = rand(0,5);
    $alet2 = rand(6,11);
    $alet3 = rand(12,17);
    $b1 = $ctrBook->retornaLivro($isbn[$alet1]);
    $b2 = $ctrBook->retornaLivro($isbn[$alet2]);
    $b3 = $ctrBook->retornaLivro($isbn[$alet3]);

?>

	<div class="parallax-container">
    	<div class="parallax"><img src="../img/banner.jpg"></div>
  	</div>
  	<!-- apresentação de qualquer livro, se clicar numa categoria, aparece os daquela categori, portanto é bom colocar um arquivo showBooks.php -->
  	<div class="container">  		
		<div class="row">
	      	<div class="col s12 m12 l12">
	      		<div class="row">
	      			<br>
	      			<div class="col s1 m1 l1">
	      				<a class="booktitle" href="productPage.php?isbn=<?php echo $b1['ISBN']; ?>">
                            <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$b1['ISBN'];?>.01.THUMBZZZ.jpg">
                        </a>
                    </div>
                    <div class="col s11 m11 l11">
                        <p><strong><a href="productPage.php?isbn=<?php echo $b1['ISBN']; ?>"><i><?php echo $b1['title'];?></i></a></strong>
                           <?php echo substr($b1['description'],0,250); ?>
	      				<a href="productPage.php?isbn=<?php echo $b1['ISBN']; ?>">mais...</a> </p>
	      			</div>
	      			
	      		</div>

	      		<div class="row">
	      			<br>
                    <div class="col s1 m1 l1">
                        <a class="booktitle" href="productPage.php?isbn=<?php echo $b2['ISBN']; ?>">
                            <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$b2['ISBN'];?>.01.THUMBZZZ.jpg">
                        </a>
                    </div>
                    <div class="col s11 m11 l11">
                        <p><strong><a href="productPage.php?isbn=<?php echo $b2['ISBN']; ?>"><i><?php echo $b2['title'];?></i></a></strong>
                            <?php echo substr($b2['description'],0,250); ?>
                            <a href="productPage.php?isbn=<?php echo $b2['ISBN']; ?>">mais...</a> </p>
                    </div>
	      			
	      		</div>

	      		<div class="row">
	      			<br>
                    <div class="col s1 m1 l1">
                        <a class="booktitle" href="productPage.php?isbn=<?php echo $b3['ISBN']; ?>">
                            <img src="https://baldochi.unifei.edu.br/COM222/trabfinal/imagens/<?=$b3['ISBN'];?>.01.THUMBZZZ.jpg">
                        </a>
                    </div>
                    <div class="col s11 m11 l11">
                        <p><strong><a href="productPage.php?isbn=<?php echo $b3['ISBN']; ?>"><i><?php echo $b3['title'];?></i></a></strong>
                            <?php echo substr($b3['description'],0,250); ?>
                            <a href="productPage.php?isbn=<?php echo $b3['ISBN']; ?>">mais...</a> </p>
                    </div>
	      		</div>
	      	</div>
	    </div>
    </div>
	<div class="parallax-container">
	    <div class="parallax"><img src="../img/banner.jpg"></div>
	</div>

    

	<?php
include 'footer.php'
?>