<?php 
/*
This action action handles the payment form submission. It updates the basket status to paid and redirects to the order complete page.
Due to the nature of this project, no payment is actually taken, and no verification is done, if a real payment system was to be implemented, 
this would be the place to do it.
*/

?>
<?php 
   require "processess/mailer.php";

   $emailsender = new EmailSender;

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    require_once "database/connect.php";
    $order_num = $basket->basket_id;
    $total = $basket->get_total();
    $data = [
      'NAME' => $name,
      'ID' => $order_num,
      'TOTAL' => $total
  ];
    if($basket->update_status()){
      header("Location: /order_complete.php?order_num=".$order_num) ;

      // Call the desired methods of the EmailSender object
      $emailsender->sendOrderEmail("Order Confirmed!", "Your Order has been confirmed", $email, $data);
      exit;
    }
    echo"Error :(";
  }
?>