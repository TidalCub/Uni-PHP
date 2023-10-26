<?php 
  
  class basket{
    public $basket_id;
    public $user_id;

    public function user(){
      return $this->user_id;
    }

    public function __construct(){
      require "database/connect.php";
      if(!isset($_SESSION["user"])){
        header("Location: /login");
      };
      $this->user_id = $_SESSION["user"];

      if(!isset($_SESSION["basket"])){
        $stmt = $conn->prepare("INSERT INTO orders(user_id, stat) VALUES (?,?);");
        $status = "pending";
        $stmt->bind_param("is", $this->user_id, $status );
        if($stmt->execute()){
          $_SESSION["basket"] = $conn->insert_id;
        } 
      }
      $this->basket_id = $_SESSION["basket"];


    }

    function add($product_id){
      require "database/connect.php";
      $stmt = $conn->prepare("INSERT INTO order_items(order_id, product_id) VALUES (?,?)");
      $stmt->bind_param("ii", $this->basket_id, $product_id );
      if ($stmt->execute()) {
        return 200;
      } else {
        return 500;
      }
    }   
  }
?>
