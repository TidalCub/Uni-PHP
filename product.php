<?php 
  require_once "helpers/product.php";
  if(isset($_GET["product"])){
    $product_id = $_GET["product"];
    $product = get_item($product_id);
  }else{
    header("Location: ../menu.php");
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
  <div class="d-flex flex-row pt-5 pb-5 flex-wrap">
    <div class="col-12 col-md-6 col-lg-5 p-2">
      <img class="" width="100%" height="auto" src="uploads/<?= $product["image_path"]?>">
    </div>
    <div class="col-12 col-md-6 col-lg-7 p-2 d-flex flex-column align-items-start">
      <div class="align-items-start col-12">
        <h1 class="col-12 text-center"><?= $product["name"]; ?></h1>
        <hr/>
        <h4 class="text-center"><?= $product["description"] ?></h4>
        <hr/> 
      </div>
      <div class="col-12 d-flex justify-content-center align-self-end">
        <a class="btn btn-dark pt-3"><h3>Add to Basket | <?= $product["price"] ?></h3></a>
      </div>
    </div>
  </div>
  <div class="col-12 content-green p-3 align-self-stretch">
    <h1 class="text-center">Customer Reviews</h1>
    <div class="col-12">
      <h3>Leave a review</h3>
      <?php include "forms/_review.php" ?>
    </div>
  </div>
</div>
<?php require_once "views/shared/_footer.php" ?>
</body>
</html>