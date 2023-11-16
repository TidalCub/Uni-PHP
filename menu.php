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
    <h1 class="w-100 text-center p-3">Order Summary</h1>
    <div class="basket">
      <?php require "views/shared/_basket.php"?>
    </div>

    <div class="w-100 d-flex justify-content-center">
      <a href="/checkout.php" class="link btn btn-primary"><span class="h1">Checkout</span></a>
    </div>
  </div>
  <div class="items">
    <?php
    require "database/query.php";
    $results = query_table("categories"); ?>
    <div class="col-12 d-flex overflow-hidden">
      <button class="btn btn-primary btn-sm scroll-left">&lt;</button>
      <div class="scroll-container d-flex overflow-hidden flex-nowrap w-100 btn-border">
        <!-- for loop to display the categories at the top for navigation -->
        
        <?php foreach ($results as $row) : ?>
            <a href="#<?=$row["id"]?>" class="btn btn-light btn-border-r flex-grow-1"><h2 class="pt-2"><?= $row["name"] ?></h2></a>
        <?php endforeach; ?>
      </div>
      <button class="btn btn-primary btn-sm scroll-right">&gt;</button>
    </div>
    <!-- for loop to display all the categories with the items -->
    <?php foreach ($results as $row) : ?>
      <h1 class="pt-3"><a id="<?= $row["id"] ?>"></a></q><?= $row["name"] ?></h1>
      <?php $itemsResult = get_child($row["id"]); ?>
      <div class='cat'>
        <!-- while loop to display all the items within the category -->
        <?php while ($item = $itemsResult->fetch_assoc()): ?>
          <div class='item col-lg-8 col-sm-11 col-11'>
            <img src='uploads/<?= $item["image_path"] ?>' height='150px' width='auto' class="col-2">
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const scrollContainer = document.querySelector('.scroll-container');
    const scrollLeftBtn = document.querySelector('.scroll-left');
    const scrollRightBtn = document.querySelector('.scroll-right');

    scrollLeftBtn.addEventListener('click', function () {
      scrollContainer.scrollBy({
        left: -300,
        behavior: 'smooth'
      });
      updateScrollButtonsVisibility();
    });

    scrollRightBtn.addEventListener('click', function () {
      scrollContainer.scrollBy({
        left: 300,
        behavior: 'smooth'
      });
      updateScrollButtonsVisibility();
    });

    function updateScrollButtonsVisibility() {
      // Check if there's content to scroll on the left
      scrollLeftBtn.style.display = scrollContainer.scrollLeft > 0 ? 'block' : 'none';

      // Check if there's content to scroll on the right
      scrollRightBtn.style.display =
        scrollContainer.scrollLeft < scrollContainer.scrollWidth - scrollContainer.clientWidth
          ? 'block'
          : 'none';
    }

    // Initial check for button visibility
    updateScrollButtonsVisibility();
  });
</script>
