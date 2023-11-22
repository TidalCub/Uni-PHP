<?php
//This script contains two helper functions related to order processing: `expand_order` and `order_total`.
?>
<?php 
  /*This function takes an order ID as an argument, connects to the database, and prepares a SQL statement to select all 
  items in the order. It then executes the statement and fetches the result. The result, which is a list of all items in the order, 
  is returned by the function. */
  function expand_order($order_id){
    require "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT order_items.id, order_items.order_id, order_items.product_id, products.name AS product_name, products.description AS product_description, products.price AS product_price
      FROM order_items
      JOIN products ON order_items.product_id = products.id
      WHERE order_items.order_id = ?;"
    );
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }

  /* This function takes an order ID as an argument, connects to the database, and prepares a SQL statement to calculate the total price 
  of all items in the order. It then executes the statement and fetches the result. The result, which is the total price of the order, 
  is returned by the function. */
  function order_total($order_id){
    require "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT SUM(products.price) AS total
      FROM order_items
      JOIN products ON order_items.product_id = products.id
      WHERE order_items.order_id = ?;"
    );
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalData = $result->fetch_assoc();
    $stmt->close();
    return $totalData["total"];
  }
?>
