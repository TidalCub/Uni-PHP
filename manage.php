<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Manager</title>
  <?php require_once("views/shared/_head.php") ?>
</head>
<body class="default-font">
  <?php require_once("views/shared/_header.php") ?>
  <div class="col-12 d-flex flex-row justify-content-start gap-2">
    <div class="bg-light rd-normal p-3">
      <?php require_once("forms/_new-category.php"); ?>
    </div>
    <div class="bg-light rd-normal p-3">
      <?php require_once("forms/_new-item.php"); ?>
    </div>
  </div>
  <hr/>
  <?php require_once("views/shared/sys/_product_table.php") ?>
</body>
</html>