<?php 
  
  function query_table($table, $limit = NULL) {
    require "connect.php";

    if ($limit === NULL) {
      $sql = "SELECT * FROM $table";
    } else {
      $sql = "SELECT * FROM $table LIMIT $limit";
    }
    $result = $conn->query($sql);
    return $result;
  }
  function get_child($parent_id){
    require "connect.php";

    $sql = "SELECT * FROM products WHERE category_id = $parent_id AND available = 1";
    $result = $conn->query($sql);
    return $result;
  }

  function get_user($id){
    require "connect.php";

    $sql = "SELECT * FROM users WHERE id = $id";
    return $conn->query($sql);
  }
?>