<?php 

  function get_params(){
    return [];
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "database/connect.php";
    if($basket->update_status()){
      header("Location: /") ;
      return;
    }
    echo"Error :(";
  }
?>