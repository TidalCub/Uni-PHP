<?php 

  function get_params(){
    return [];
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "database/connect.php";
    $order_num = $basket->basket_id;
    if($basket->update_status()){
      header("Location: /order_complete.php?order_num=".$order_num) ;
      return;
    }
    echo"Error :(";
  }
?>