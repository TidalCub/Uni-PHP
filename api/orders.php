<?php
header("Content-Type: application/json");
function update_status($order_id){
    require "../database/connect.php";
    $stmt = $conn->prepare("UPDATE orders SET stat = 'completed' WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    if($stmt->execute()){
      return true;
    } else {
      return false;
    }
  }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        // Process the action and return a response
        $action = $_POST["action"];

        if ($action === "complete") {
            $order_id = $_POST["order_id"];
            update_status($order_id);
            http_response_code(200);
            echo json_encode(["message" => "Sucessfuly completed order"]);
            exit;
            
        } else {
            // Invalid action parameter
            http_response_code(400);
            echo json_encode(["error" => "Invalid 'action' parameter"]);
        }
    } else {
        // 'action' parameter is missing
        http_response_code(400);
        echo json_encode(["error" => "'action' parameter is missing"]);
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method"]);
}
?>

