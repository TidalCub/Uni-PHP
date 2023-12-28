<?php 
  require 'vendor/autoload.php';
  use \Firebase\JWT\JWT;
  use Firebase\JWT\Key;

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
      $header = [
        'alg' => 'HS256',
        'typ' => 'JWT',
        'kid' => '23456',
    ];
      $token = JWT::encode($payload, $this->secrete, 'HS256',null, $header);
      return $token;
    }

    public function decodeToken($token){
      try {
        // Attempt to decode the token
        $decoded = JWT::decode($token, new Key($this->secrete, 'HS256'));

        // You can now access the decoded data, e.g., $decoded->user_id
    
        // Check if the token is still valid (not expired)
        if ($decoded->exp < time()) {
            echo 'Token has expired.';
            return ['status' =>410];
        } else {
            return [
              'status' => 200,
              'user_id' => $decoded->user_id,
            ];
        }
    } catch (\Firebase\JWT\ExpiredException $e) {
      return ['status' => 410];
    }
    }
  }
?>