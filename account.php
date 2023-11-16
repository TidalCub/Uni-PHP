<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "views/shared/_head.php" ?>
</head>
<body>
  <?php 
    require "views/shared/_header.php";
    require_once "user/user_obj.php";  
    require "helpers/expand_order.php";
    $user = new user();
    ?>
  <div class="d-flex flex-wrap">
    <div class="border-end col-12 col-md-3 col-lg-3 d-flex justify-content-center flex-column">
      <div class="col-11 rd-normal bg-light m-3 p-3">
        <?php foreach($user->get_user_details() as $details) : ?>
          <h1 class="text-center">Hi <?= $details["first_name"]?></h1>
          <hr/>
          <div class="ps-2">
            <table>
              <tr>
                <td>Name: </td>
                <td><?= $details["first_name"] . " " . $details["last_name"]?></td>
              </tr>
              <tr>
                <td>Email: </td>
                <td><?= $user->user_email_safe($details["email"]) ?></td>
              </tr>
              <tr>
                <td>Joined: </td>
                <td><?= $details["created_at"] ?></td>
              </tr>
              <tr>
                <td>Total Orders: </td>
                <td><?= $user->total_orders()?></td>
              </tr>
            </table>
            <hr/>
              <div class="col-12 d-flex justify-content-center gap-3">
                <a href="user/logout.php" class="btn btn-dark">Logout</a>
                <a href="" class="btn btn-dark">Update Details</a>
              </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-11 bg-light m-3 p-3 rd-normal">
        <h4 class="text-center">Useful Resources</h4>
        <hr/>
      </div>
      
    </div>
    <div class="col-12 col-md-9 col-lg-9 ">
      <h1 class="text-center">Past Orders</h1>
      <div class="col-12 d-flex gap-2 flex-wrap flex-row p-2">
        <?php foreach($user->get_all_orders() as $order):?>
          <div class="col-12 col-md-3 col-lg-3 bg-light rd-normal p-2">
            <h3 class="text-center">Order: <?= $order["id"]?></h3>
            <p class="text-center">Ordered at: <?= $order["created_at"] ?></p>
            <hr/>
            <?php foreach(expand_order($order["id"]) as $items) :?>
              <p><?= $items["product_name"] ?></p>
            <?php endforeach ?>
            <hr/>
            <h6 class="text-end">Total: <?=order_total($order["id"]) ?></h6>
          </div>
        <?php endforeach ?>
      </div>
      
    </div>
  </div>
</body>

</html>
