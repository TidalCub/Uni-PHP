<?php 
  class user{
    public $user_id;

    private function find_user($email){
      require "database/connect.php";
      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        return $result;
      }
      return null;
    }

    public function login($email, $password){
      $user = $this->find_user($email);
      if(is_null($user)){
        return false;
      }
      while($row = $user->fetch_assoc()) {
        if (password_verify($password, $row['password'])){
          echo "you are now loged in";
          $_SESSION['user'] = $row["id"];
          return true;
        }else{
          return false;
        }
      };
    }

    public function get_user_details(){
      require "database/connect.php";
      $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
      $stmt->bind_param("i", $this->user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result; 
    }

    public function user_email_safe($email){
      list($username, $domain) = explode('@', $email);
      $shortUsername = substr($username, 0, 3);
      return $shortUsername . '...' . '@' . $domain;
    }

    public function total_orders(){
      return "....";
    }

    public function get_all_orders($limit){
      require "database/connect.php";
      $stmt = $conn->prepare(
        "SELECT orders.id, orders.user_id, orders.stat, orders.created_at
        FROM orders
        JOIN users ON orders.user_id = users.id
        WHERE users.id = ?
        AND orders.stat IN ('complete', 'paid')
        LIMIT ?;"
      );
      $stmt->bind_param("ii", $this->user_id, $limit);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }

    public function is_user(){
      return(isset($_SESSION["user"]));
    }

    public function __construct(){
      if(isset($_SESSION["user"]) && !isset($this->user_id)){
        $this->user_id = $_SESSION["user"];
      } else {
        return false;
      }
    }
  }
?>