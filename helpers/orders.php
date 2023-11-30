<?php
/*
This is a helper function , `all_orders`, connects to the database and prepares a SQL statement to select all orders that have a status of 'paid'. 
It then executes the statement and fetches the result. 
The result, which is a list of all paid orders, is returned by the function.
*/
?>
<?php
  function all_orders(){
    require "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT orders.id, orders.user_id, orders.stat, orders.created_at
      FROM orders
      WHERE orders.stat IN ('paid');"
    );

    $stmt->execute();
    $result = $stmt->get_result();
    return $result;

  }

  function item_count($id){
    require "database/connect.php";
    $stmt = $conn->prepare(
      "SELECT COUNT(*) AS total_items
      FROM order_items
      WHERE order_id = ?;
      ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  
?>