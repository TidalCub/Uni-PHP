<?php 
  require "helpers/product.php";
  if(isset($_GET["product"])){
    $product_id = $_GET["product"];
    $product = get_item($product_id);
    $star_rating = get_rating($product_id);
  }else{
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])){
      $product_id = $_POST["product_id"];
      header("Location: /product.php?product=$product_id");
    }else{
      header("Location: ../menu.php");
    }
    
  }

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once "views/shared/_head.php"; ?>
  <title>Document</title>
</head>
<body>
<?php require_once "views/shared/_header.php"; ?>
<div class="d-flex flex-column">
  <div class="d-flex flex-row flex-wrap">
    <div class="col-12 col-md-6 col-lg-5">
      <img class="" width="100%" height="auto" src="uploads/<?= $product["image_path"]?>">
    </div>
    <div class="col-12 col-md-6 col-lg-7 p-2 d-flex flex-column align-items-start">
      <div class="align-items-start col-12">
        <h1 class="col-12 text-center"><?= $product["name"]; ?></h1>
        <div class="col-12 d-flex justify-content-center">
          <div>
           <?php include "views/shared/_star-rating.php" ?>  
          </div>
          
        </div>
        
        <hr/>
        <h4 class="text-center"><?= $product["description"] ?></h4>
        <hr/> 
      </div>
      <div class="col-12 d-flex justify-content-center align-self-end">
        
      </div>
    </div>
  </div>
  <div class="col-12 content-green p-3 align-self-stretch">
    <h1 class="text-center">Customer Reviews</h1>
    <div class="col-12">
      <?php if(isset($_SESSION["user"])) :?>
      <h3>Leave a review</h3>
      <?php include "forms/_review.php" ?>
      <hr/>
      <?php endif; ?>
      <h2>Past Reviews on this item</h2>
      <?php include "views/shared/_reviews.php" ?>
    </div>
  </div>
</div>
<?php require_once "views/shared/_footer.php" ?>
</body>
</html>
