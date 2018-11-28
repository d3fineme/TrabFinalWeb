<?php
require_once 'C:/xampp/htdocs/TrabFinalWeb/controllers/conecta.php';
require_once 'C:/xampp/htdocs/TrabFinalWeb/controllers/ctrBook.php';
//$link = fConnectToDatabase();

//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

$cookieName = "myCart2";
//$bookArray=null;
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
if(isset($bookArray))
foreach ($bookArray as $isbn => $qtd) {
    $res = $ctrBook->retornaLivro($isbn);
    $valor += ($res['price']*$qtd)*0.8;
}
@$frete = (($totalbooks-1)*5)+10;


$valorfinal = $valor + $frete;
//***************************************************
//You do not need to modify any code above this point
//***************************************************
?>
<?php
 include 'C:/xampp/htdocs/TrabFinalWeb/views/header.php';
?>
<br>
           <div class="container z-depth-3 #e0e0e0 grey lighten-2">
               <div class="row">
                   <div class="col s10 m10 l10 push-l1">
               <?php
               //To do:
               // 1. Build sql statement containing ISBNs. Use foreach loop.
               // 2. Execute sql and display book titles, prices, qty, etc.
            if(!isset($bookArray)){
                $bookArray = null;
            }
               if (count($bookArray)) {
                  echo "<table id='cart'><tr><th>ISBN</th><th> Quantidade </th><th> Adiconar/Remover </th><th> Preço Unitário</th></tr>";
                  if($bookArray)
                  foreach ($bookArray as $isbn => $qty) {
                     ?>
                     <tr>
                        <td>
                           <a class='booktitle' href='ProductPage.php?isbn=<?=$isbn?>'><?=$isbn?></a> </td>
                        <td><?=$qty?></td>
                        <td>
                           <a href='?addISBN=<?=$isbn?>'>Add</a><br>
                           <a href='?deleteISBN=<?=$isbn?>'>Remove</a>
                        </td>
                        <td>
                            <?php
                                $pc = $ctrBook->retornaLivro($isbn);
                                echo $pc['price'];
                            ?>
                        </td>
                     </tr>

                  <?php }
                  ?>
                </table>
             <p class="right"><strong>Valor final: </strong><?php echo number_format($valorfinal,2); ?></p>
                   </div>
               </div>
                <div class="row">
                    <div class="col s4 m4 l7">
                        <a href="checkout1.php" class="right btn waves-effect waves-light">Finalizar compra</a>

                    </div>

                </div>
               <?php
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


               <br>
           </div>
<br><br>
   <?php
    include 'C:/xampp/htdocs/TrabFinalWeb/views/footer.php';
?>