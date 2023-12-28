<?php 
  require 'vendor/autoload.php';
  use \Firebase\JWT\JWT;

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
  $dotenv->load();

  class TokenGenerator {
    private $secrete;
    
    public function __construct(){
      $this->secrete = $_ENV["JWT_SECRETE"];
    }
    
    public function generateToken($user_id){
      $payload = [
        'iss' => "https://mmi.leon-skinner.dev",
        'iat' => time(),
        'exp' => time() + 3600, // Token expiration time (1 hour in this example)
        'user_id' => $user_id,
      ];
      $token = JWT::encode($payload, $this->secrete, 'HS256');
      return $token;
    }

    public function decodeToken(){

    }
  }
?>