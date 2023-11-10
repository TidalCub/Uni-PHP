<!DOCTYPE html>
<html>
<head>
  <title>My Website</title>
  <?php 
    include 'views/shared/_head.php'; 
    include 'processess/basket.php';
  ?>
  
</head>
<body>
<?php include 'views/shared/_header.php'; ?>
<div class="d-flex flex-row">
  <div class="order-sum w-25 fixed sticky-top d-none d-lg-block">
    <h1 class="w-100 text-center p-3 neutral-text">Order Summary</h1>
    <div class="basket">
      <?php require "views/shared/_basket.php"?>
    </div>

    <div class="w-100 d-flex justify-content-center">
      <a href="/checkout.php" class="link btn btn-thirdly"><span class="h1">Checkout</span></a>
    </div>
  </div>
  <div class="items">
    <?php
    require "database/query.php";
    $results = query_table("categories");

    foreach ($results as $row) : ?>
      <h1><?= $row["name"] ?></h1>
      <?php $itemsResult = get_child($row["id"]); ?>
      <div class='cat'>
        <?php while ($item = $itemsResult->fetch_assoc()): ?>
          <div class='item col-lg-8 col-sm-11 col-11'>
            <img src='uploads/<?= $item["image_path"] ?>' height='150px' width='auto'>
            <div class='flex-grow-1 pt-3 pr-4'>
              <h3><?= $item["name"] ?></h3>
              <p><?= $item["description"] ?></p>
              <a href='/view/<?= $item["id"] ?>' class='link btn btn-primary'>View</a>
              <a href='<?= $_SERVER['PHP_SELF'] ?>?option=add&value=<?= $item["id"] ?>' class='link btn btn-primary'>Add to basket (£<?= $item["price"] ?>)</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endforeach; ?>
</div>

</div>

  <?php include 'views/shared/_footer.php'; ?>
</body>
</html>

<?php

  ?>