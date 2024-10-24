<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bjavilac@ut.edu.co';                     //SMTP username
    $mail->Password   = 'igoyjarmddxicnws';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bjavilac@ut.edu.co', 'CODEPE');
    $mail->addAddress('bricont1605@gmail.com', 'CODEPE');     //Add a recipient

    //Content
    $mail->isHTML(true);         
                            //Set email format to HTML
    $mail->Subject = 'Bienvenido al canal';
    $mail->Body    = 'hola';
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo "<script type='text/javascript'>
    alert('Mensaje enviado correctamente');
    window.location.href = 'index.php';
</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}