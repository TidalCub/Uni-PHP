<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Manager</title>
  <?php require_once("views/shared/_head.php") ?>
</head>
<body>
  <?php require_once("views/shared/_header.php") ?>

  <?php 
    require_once("database/connect.php");
    require_once("forms/_new-item.php");
    require_once("forms/_new-category.php"); 
  ?>
</body>
</html>