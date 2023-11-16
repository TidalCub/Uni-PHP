
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once "views/shared/_head.php" ?>
  <title>Order Complete</title>
</head>
<body>
  <?php require_once "views/shared/_header.php";?>
  <div class="col-12 d-flex justify-content-center pt-5">
    <div class="col-11 col-md-6 col-lg-3 bg-light text-center p-3 rd-normal shadow">
      <img src="images/check.svg" class="check">
      <h3 class="pt-3" >Your Order Number is:</h3>
      <div class="display-3"><?=$_GET["order_num"]?></div>
      <hr/>
      <p>We will call out your order number once its ready</p>
      <hr/>
      <div>
        <a class="btn btn-dark">Back to Menu</a>
        <a class="btn btn-dark">Previous Orders</a>
      </div>
    </div>
  </div>
</body>
</html>