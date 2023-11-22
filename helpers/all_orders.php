<?php
  function all_orders(){
    require_once "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT orders.id, orders.user_id, orders.stat, orders.created_at
      FROM orders
      WHERE orders.stat IN ('paid');"
    );

    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }

  
?>