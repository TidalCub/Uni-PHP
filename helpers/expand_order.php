<?php 
  
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

  function expand_order_last(){

  }

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
