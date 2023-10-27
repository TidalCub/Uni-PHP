<?php 
  
  class basket{
    public $basket_id;
    public $user_id;

    public function create_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare("INSERT INTO orders(user_id, stat) VALUES (?,?);");
      $status = "pending";
      $stmt->bind_param("is", $this->user_id, $status );
      if($stmt->execute()){
        $_SESSION["basket"] = $conn->insert_id;
      } 
    }

    public function find_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare("SELECT id FROM orders WHERE user_id = ? AND stat = ?");
      $stat = "pending";
      $stmt->bind_param("is", $this->user_id, $stat);
      $stmt->execute();
      $stmt->bind_result($id);
      if ($stmt->fetch()) {
        $this->basket_id = $_SESSION["basket"];
      } else {
        $this->create_basket();
      }

    }

    public function __construct(){
      if(!isset($_SESSION["user"])){
        header("Location: /login");
      };
      $this->user_id = $_SESSION["user"];
      $this->find_basket();

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

    function get_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare("
      SELECT order_items.id, order_items.order_id, order_items.product_id, products.name AS product_name, products.price 
      FROM order_items 
      INNER JOIN products 
      ON order_items.product_id = products.id 
      WHERE order_items.order_id = ?");

      $stmt->bind_param("i", $this->basket_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $results = [];
      while ($row = $result->fetch_assoc()) {
          $results[] = $row;
      }
      return $results;
    }
  }
?>
