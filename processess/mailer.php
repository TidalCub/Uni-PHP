<?php
require($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    private $smtpServer;
    private $mail;

    public function __construct() {
        $this->smtpServer = $_ENV["EMAIL_SMTP"];  // Corrected property name

        // Initialize PHPMailer
        $this->mail = new PHPMailer(true);

        // Set SMTP configuration
        $this->mail->isSMTP();
        $this->mail->Host = $this->smtpServer;  // Corrected variable name
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "orders@mmi.leon-skinner.dev";
        $this->mail->Password = $_ENV["EMAIL_PASSWORD"];
        $this->mail->SMTPSecure = 'tls';
    }

    public function sendOrderEmail($subject, $body, $toEmail, $data) {
        try {
            // Recipients
            $this->mail->setFrom("orders@mmi.leon-skinner.dev");
            $this->mail->addAddress($toEmail);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            
            // Read the HTML content from the file
            $htmlContent = file_get_contents("emails/order_confirmation.html");

            // Replace placeholders with actual values
            foreach ($data as $key => $value) {
                $placeholder = '{' . strtoupper($key) . '}';
                $htmlContent = str_replace($placeholder, $value, $htmlContent);
            }

            $this->mail->Body = $htmlContent;

            // Send the email
            $this->mail->send();
            echo "Email sent successfully to $toEmail";
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
