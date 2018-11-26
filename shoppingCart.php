<?php
include_once("../includes/utilitiesGeneral.php");
include_once("../includes/connection.php");
$link = fConnectToDatabase();

//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
   $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
$addISBN = CleanISBN($_GET['addISBN']);
if (strlen($addISBN) > 0) {
   if (isset($addISBN, $bookArray)) {
      // Increment by +1
      $bookArray[$addISBN] += 1;
   } else {
      // Add new item to cart
      $bookArray[$addISBN] = 1;
   }
}
// Remove items from cart
$deleteISBN = CleanISBN($_GET['deleteISBN']);
if (strlen($deleteISBN) > 0) {
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
//***************************************************
//You do not need to modify any code above this point
//***************************************************
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Basic Shopping Cart -- GeekBooks.com</title>
      <link rel="stylesheet" href="/sandvig/mis314/assignments/bookstore/styleSheet.css" type="text/css">
   </head>
   <body>

      <?php
      include_once("../includes/header.php");
      ?>

      <div class="pageContainer">
         <div class="leftColumn">
            <?php include "../includes/menu.php" ?>
         </div>
         <div class="content">
            <p class="centeredText">        
               <?php
               echo $totalbooks . " item";
               if ($totalbooks != 1)
                  echo 's';
               echo ' in your cart'
               ?> 
            </p>
           
               <?php
               //To do:
               // 1. Build sql statement containing ISBNs. Use foreach loop.
               // 2. Execute sql and display book titles, prices, qty, etc.
               if (count($bookArray)) {
                  echo "<table id='cart'><tr><th>ISBN</th><th>Qty</th><th>Add/Remove</th></tr>";
                  foreach ($bookArray as $isbn => $qty) {
                     echo "
                     <tr>
                        <td>
                           <a class='booktitle' href='ProductPage.php?isbn=$isbn'>$isbn</a> </td>
                        <td>$qty</td>
                        <td>
                           <a href='?addISBN=$isbn'>Add</a><br>
                           <a href='?deleteISBN=$isbn'>Remove</a>
                        </td>
                     </tr>";
                  }
               }
               ?>
            </table>
            <p class="centeredText"><a href="views/index.php">Basic Cart Home</a></p>
         </div>
      </div>