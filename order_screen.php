<!DOCTYPE html>
<html lang="en">
<head>
  <?php require "views/shared/_head.php" ?>
  <title>Pending Orders</title>
</head>
<body class="default-font bg-secondary">
  <div class="col-12 d-flex gap-2 flex-wrap flex-row p-2">
    <?php
    require_once "helpers/all_orders.php";
    require "helpers/expand_order.php";
    foreach(all_orders() as $order):
    ?>
      <div class="bg-light align-self-start">
        <div class="col-12 bg-dark neutral-text ps-2 pe-2 d-flex flex-row justify-content-between system-font gap-5">
          <h4 class="pt-2"><?= $order["id"] ?></h4>
          <h5><?= $order["created_at"] ?></h5>
        </div>
        <div class="bg-light p-3">
          <?php foreach(expand_order($order["id"]) as $items) :?>
            <span class="h3"><?= $items["product_name"] ?></span><br>
          <?php endforeach ?>
        </div>
        <div class="col-12 bg-dark p-1">
          <button class="btn btn-light p-1" onclick="completeOrder(<?= $order['id'] ?>)">Complete</button>
        </div>
      </div>
    <?php endforeach ?>
  </div>

  <script>
function completeOrder(orderId) {
    // Make an HTTP request to the server with the order ID
    fetch("http://localhost:3000/api/orders.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=complete&order_id=${orderId}`,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse the response body as JSON
    })
    .then(data => {
        // Handle the response data if needed
        location.reload()
        console.log(data);
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}
</script>
</body>
</html>