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
    } else if(isset($_GET['option']) && !isset($_SESSION["user"])){
      header("Location: /login.php?redirect=menu.php&requier_signin=true", 300);
    }
?>