<?php
// Include PHPMailer autoloader
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $services = $_POST['services'];
        $message = $_POST['message'];

        // Compose the email body
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Services: $services\n";
        $email_body .= "Message:\n$message";

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'support@windowwashingexpert.com';                     //SMTP username
        $mail->Password   = 'aoqfdojdtgdikqnt';                               //SMTP password
        $mail->SMTPSecure =  'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587; // Check your SMTP port

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('raozahid489@gmail.com', 'Recipient Name');

        //Content
        $mail->isHTML(false);
        $mail->Subject = 'snrtrainings.com Customer Supports';
        $mail->Body = $email_body;

        $mail->send();

        session_start();
        $_SESSION['message_sent'] = 'contact_us';
        header("Location: index.php");
    }
} catch (Exception $e) {
    echo "<p>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
}
?>
