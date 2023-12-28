<?php 
//This is the user object, it is used to get user details and check if a user is logged in
  class user{
    public $user_id;

    //This function is used to find a user
    public function find_user($email){
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

    //This function is used to login a user, it takes the users email and password and checks if they match a user in the database
    public function login($email, $password){
      $user = $this->find_user($email);
      if(is_null($user)){
        return false;
      }
      while($row = $user->fetch_assoc()) { //This checks all records, which should only be one, and checks if the password matches the hashed password
        if (password_verify($password, $row['password'])){
          echo "you are now logged in";
          $_SESSION['user'] = $row["id"];
          return true; //it returns true or false so the calling function can handle accordingly 
        }else{
          return false;
        }
      };
    }

    //This function is used to get a users details
    public function get_user_details(){
      require "database/connect.php";
      $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
      $stmt->bind_param("i", $this->user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result; 
    }

    //This function is used to display a obscured email address, it takes in an email and outputs a obscured version
    public function user_email_safe($email){
      list($username, $domain) = explode('@', $email);
      $shortUsername = substr($username, 0, 3);
      return $shortUsername . '...' . '@' . $domain;
    }

    //This function is used to get the total number of orders a user has
    public function total_orders(){
      return "....";
    }

    //This function is used to get all orders for a user
    public function get_all_orders(){
      require "database/connect.php";
      $stmt = $conn->prepare(
        "SELECT orders.id, orders.user_id, orders.stat, orders.created_at
        FROM orders
        JOIN users ON orders.user_id = users.id
        WHERE users.id = ?
        AND orders.stat IN ('completed', 'paid')
        ORDER BY created_at DESC"
      );
      $stmt->bind_param("i", $this->user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }

    //This function is used to check if a user is logged in
    public function is_user(){
      return(isset($_SESSION["user"]));
    }

    //This function is used when the user object is created, it checks if a user is logged in and sets the user_id variable
    public function __construct(){
      if(isset($_SESSION["user"]) && !isset($this->user_id)){
        $this->user_id = $_SESSION["user"];
      } else {
        return false;
      }
    }
  }
?>