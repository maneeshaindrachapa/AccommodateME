<?php
require 'PHPMailer/PHPMailerAutoload.php';

function sendMail($email, $bodyContent, $sender){
    $mail = new PHPMailer;
    $mail->STMPDebug=3;
    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'Milky';          // SMTP username
    $mail->Password = 'maneesha@123';            // SMTP password
    $mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect to

    $mail->setFrom('accmodateme@gmail.com', 'MiLKY');
    $mail->addReplyTo('accmodateme@gmail.com', 'MiLKY');
    $mail->addAddress($email);   // Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->isHTML(true);  // Set email format to HTML


    $mail->Subject = 'Email from MiLKY by ' . $sender;
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo "Successfully sent";
    }
}

?>


		