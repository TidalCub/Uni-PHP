<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
      require "views/shared/_head.php" ;
      include 'processess/basket.php';
    ?>
</head>
<body>
    <?php require "views/shared/_header.php" ?>

    <div>
      <div class="checkout-sum m-5">
        <?php require "views/shared/_basket.php"; ?>
      </div>

    </div>
</body>

</html>
