<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


/* If you installed PHPMailer without Composer do this instead: */

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendVerificationMail($userEmail, $token)
    
{

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->setFrom('verify@playpen.nicojbrits.co.za', 'My Diary Verification');

   /* Add a recipient. */
   $mail->addAddress($userEmail);

   /* Set the subject. */
   $mail->Subject = 'Please Verify your E-Mail Address';

   /* Set the mail message body. */
    $mail->isHTML(TRUE); // Set an HTML Message
    $mail->Body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
        <a href="https://playpen.nicojbrits.co.za/diary/verifyMail.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /* SMTP server address. */
   $mail->Host = 'smtp.stackmail.com';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = 'verify@playpen.nicojbrits.co.za';
   
   /* SMTP authentication password. */
   $mail->Password = 'Ko8959865';
   
   /* Set the SMTP port. */
   $mail->Port = 587;

   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}

}

/*
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.stackmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'verify@playpen.nicojbrits.co.za';                     // SMTP username
    $mail->Password   = 'Ko8959865';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('verify@playpen.nicojbrits.co.za', 'My Diary Verification');
    
    $mail->addAddress('britsnj@gmail.com', 'Nico Brits');     
    
    // Content
    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Please Verify Your Account';
    $mail->Body    = '<p>You have recently registers on the My Secret Diary website using this e-mail address.</p>To confirm your address please click the link below or copy and paste into your browser</p><br><p>https://playpen.nicojbrits.co.za/diary/verifyMail.php?token=</p>';
    
    $mail->AltBody = 'You have recently registers on the My Secret Diary website using this e-mail address. To confirm your address please copy and paste the following link in you browser:  https://playpen.nicojbrits.co.za/diary/verifyMail.php?token=';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

*/
?>
