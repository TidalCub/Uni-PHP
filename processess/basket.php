<?php require "user/basket_obj.php";
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
    };
?>