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
    require "helpers/orders.php";
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
                <a class="btn btn-dark" href="/account_help.php">Update Password</a>
              </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-11 bg-light m-3 p-3 rd-normal">
        <h4 class="text-center">Useful Resources</h4>
        <hr/>
      </div>
      
    </div>
    <div class="col-12 col-md-9 col-lg-9">
      <h1 class="text-center">Past Orders</h1>
      <table class="col-12 m-2 text-center">
        <thead>
          <td>Order id</td>
          <td>Created At</td>
          <td>Items in Order</td>
          <td>Total Price</td>
          <td>View</td>
        </thead>
        <tbody>
        <?php foreach($user->get_all_orders() as $order):?>
          <tr class="border-bottom">
            <td><?= $order["id"]?></td>
            <td><?= $order["created_at"]?></td>
            <td><?php echo item_count($order["id"])["total_items"] ?></td>
            <td><?=order_total($order["id"]) ?></td>
            <td>
              <dialog id="<?= $order["id"] ?>" class="col-11 col-md-6 col-lg-6 rd-normal">
                <h5>Order Id: <?= $order["id"] ?></h5>
                <p><?= $order["created_at"] ?></p>
                <hr/>
                <p>Items in Order:</p>
                <?php foreach(expand_order($order["id"]) as $items) :?>
                  <h3><?= $items["product_name"] ?></h3>
                <?php endforeach ?>
                <button autofocus onclick="close_dialog(<?= $order['id'] ?>)" class="btn btn-primary">Close</button>
              </dialog>
              <button class="btn btn-primary" onclick="open_dialog(<?= $order['id'] ?>)"><i class="fa-solid fa-eye"></i></button>
            </td>
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
      </div>
      
    </div>
  </div>

  <script>
    function open_dialog(id){
      const dialog = document.getElementById(id);
      dialog.showModal();
    }

    function close_dialog(id){
      const dialog = document.getElementById(id);
      dialog.close();
    }
  </script>
</body>

</html>
