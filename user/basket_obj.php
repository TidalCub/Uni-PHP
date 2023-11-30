<?php 
// This is the basket object, it is used to create a basket for the user, add items to the basket, remove items from the basket, get the basket, 
//and get the total price of the basket.
  
  class basket{
    public $basket_id;
    public $user_id;
    
    //This function is used to create a basket for the user
    public function create_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare("INSERT INTO orders(user_id, stat) VALUES (?,?);");
      $status = "pending";
      $stmt->bind_param("is", $this->user_id, $status );
      if($stmt->execute()){
        $_SESSION["basket"] = $conn->insert_id;
      } 
    }

    //This function is used to find a users basket
    public function find_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare("SELECT id FROM orders WHERE user_id = ? AND stat = ?");
      $stat = "pending";
      $stmt->bind_param("is", $this->user_id, $stat);
      $stmt->execute();
      $stmt->bind_result($id);
      if ($stmt->fetch()) {
        $this->basket_id = $id;
      } else {
        $this->create_basket();
      }

    }

    //This function is used when the basket object is created to check if there is a user or not, if there is it sets the user_id variable and finds the basket
    public function __construct(){
      require "database/connect.php";
      if(!isset($_SESSION["user"])){
        //("Location: /login.php?redirect=menu.php&requier_signin=true", 300);
      };
      $this->user_id = $_SESSION["user"];
      $this->find_basket();

    }

    //This function is used to add an item to the basket
    function add($product_id){
      require "database/connect.php";
      $stmt = $conn->prepare("INSERT INTO order_items(order_id, product_id) VALUES (?,?)");
      $stmt->bind_param("ii", $this->basket_id, $product_id );
      if ($stmt->execute()) {
        return 200; //Status codes are used here instead of true and false as the function is used by a front end method
      } else {
        return 500;
      }
    }   

    //This function is used to remove an item from the basket
    function remove($product_id){
      require "database/connect.php";
      $stmt = $conn->prepare("DELETE FROM order_items WHERE order_id = ? AND product_id = ? LIMIT 1");
      $stmt->bind_param("ii", $this->basket_id, $product_id);
      if ($stmt->execute()) {
        return 200; //Status codes are used here instead of true and false as the function is used by a front end method
      } else {
        return 500;
      }
    }

    //This function is used to get the basket, this differs from find_basket as it gets the basket items and not just the basket id
    function get_basket(){
      require "database/connect.php";
      $stmt = $conn->prepare(
        "SELECT order_items.product_id, products.name AS product_name, products.price, COUNT(order_items.product_id) AS item_count 
        FROM order_items 
        INNER JOIN products 
        ON order_items.product_id = products.id 
        WHERE order_items.order_id = ?
        GROUP BY order_items.product_id");
      $stmt->bind_param("i", $this->basket_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $results = [];
      while ($row = $result->fetch_assoc()) {
          $results[] = $row;
      }
      return $results;
    }

    //This function is used to get the total price of the basket
    function get_total(){
      require "database/connect.php";
      $stmt = $conn->prepare(
        "SELECT SUM(products.price) AS order_total
        FROM order_items 
        INNER JOIN products 
        ON order_items.product_id = products.id 
        WHERE order_items.order_id = ?");
      $stmt->bind_param("i", $this->basket_id);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($order_total);
      $stmt->fetch();
      return $order_total;
    }

    //This function is used to update the status of the basket to paid, and is called once the user has paid for the order
    function update_status(){
      require "database/connect.php";
      $stmt = $conn->prepare("UPDATE orders SET stat = 'paid' WHERE id = ?");
      $stmt->bind_param("i", $this->basket_id);
      if($stmt->execute()){
        return true;
      } else {
        return false;
      }
    }
  }
?>
