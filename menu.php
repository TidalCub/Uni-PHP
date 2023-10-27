<!DOCTYPE html>
<html>
<head>
  <title>My Website</title>
  <?php include 'views/shared/_head.php'; ?>
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
</head>
<body>
<?php include 'views/shared/_header.php'; ?>
<div class="d-flex flex-row">
  <div class="order-sum w-25 fixed sticky-top d-none d-lg-block">
    <h1 class="w-100 text-center p-3 neutral-text">Order Summary</h1>
      <?php 
        $results = $basket->get_basket();
        foreach ($results as $basket_items){
          echo "
          <hr/>
            <div class='d-flex justify-content-between basket-item'>
              <div class='p-2 pt-1 pb-1'>
                <h4>". $basket_items["product_name"] ."</h4>
                  £"  . $basket_items["price"] .     
             "</div>
             <div class='d-flex flex-direction-rows'>
              <h2 class=' basket-qty d-flex align-items-center justify-content-center p-3'>x". $basket_items["item_count"] ."</h2>
              <div class='remove-basket-item d-flex align-items-center justify-content-center'>
                <div class='plus-minus'>
                  <i class='fa-solid fa-plus-minus' style='color: #D8D8D8;' class='m-1'></i>
                </div>
                <div class='minus'>
                  <a href='" . $_SERVER['PHP_SELF']."?option=add&value=" . $basket_items["product_id"] . "'>
                    <i class='fa-solid fa-plus' style='color: #D8D8D8;' class='m-1'></i>
                  </a>
                  <a href='".$_SERVER['PHP_SELF']."?option=remove&value=".$basket_items["product_id"]."'>
                    <i class='fa-solid fa-minus' style='color: #D8D8D8;' class='m-1'></i> 
                  </a>
                  
                </div>
              </div>
            </div>
             
            </div>
            
          ";
        }
      ?>

    <div class="w-100 d-flex justify-content-center">
      <a class="link btn btn-primary"><span class="h1">Checkout</span></a>
    </div>
   
  </div>
  <div class="items">
    <?php
      require "database/query.php";
      $results = query_table("categories");
      while($row = $results->fetch_assoc()) {
        echo "<h1>".$row["name"] . "</h1>";
        $items = get_child($row["id"]);
        echo "<div class='cat'>";
        while($item = $items->fetch_assoc()){
          echo "
          <div class='item col-lg-8 col-sm-11 col-11'><img src='uploads/".$item["image_path"]."' height='150px' width='auto''>
          <div class='flex-grow-1 pt-3 pr-4'>
            <h3>" . $item["name"] . "</h1>
            <p>". $item["description"]."</p>
            <a href='/view/".$item["id"]."'class='link btn btn-primary  '>View</a>
            <a href='".$_SERVER['PHP_SELF']."?option=add&value=".$item["id"]."'class='link btn btn-primary'>Add to basket (£".$item["price"].")</a>
          </div>
          </div>";
        }
        echo "</div>";
      }
    ?>
  </div>
</div>

  <?php include 'views/shared/_footer.php'; ?>
</body>
</html>

<?php

  ?>