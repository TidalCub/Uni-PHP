<?php
/*
This script handles the operations related to the user's basket. 
It checks if a user is logged in and if certain GET parameters are set. 
If the user is logged in and the 'option' parameter is set to 'add', it adds the product specified by the 'value' parameter to the user's basket. 
If the 'option' parameter is set to 'remove', it removes the specified product from the user's basket. 
If a user is not logged in and tries to add or remove a product, they are redirected to the login page.
*/
?>

<?php require "user/basket_obj.php";

    if(isset($_SESSION["user"])){
      $basket = new basket;
      if (isset($_GET['option']) && isset($_GET['value'])) {
        if($_GET['option'] == 'add'){
          $product_id = $_GET["value"];
          $location = $_SERVER["PHP_SELF"];
          $basket->add($product_id);    
          header("location: $location");
        }elseif($_GET['option'] == 'remove'){
          $product_id = $_GET["value"];
          $location = $_SERVER["PHP_SELF"];
          $basket->remove($product_id);    
          header("location: $location");
        }
      }
      /*Check if the user is not loged in and the page is trying to add or remove an item from the basket, the option is checked 
      first to prevent the user being redirected to the login page when they are trying to view the menu */
    } else if(isset($_GET['option']) && !isset($_SESSION["user"])){
      header("Location: /login.php?redirect=menu.php&requier_signin=true", 300);
    }
?>