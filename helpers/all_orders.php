<?php
/*
This is a helper function , `all_orders`, connects to the database and prepares a SQL statement to select all orders that have a status of 'paid'. 
It then executes the statement and fetches the result. 
The result, which is a list of all paid orders, is returned by the function.
*/
?>
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