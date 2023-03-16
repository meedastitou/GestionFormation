<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';

//  Plusieurs destinataires
$to  = 'mdastitou@gmail.com'; // notez la virgule


if (isset($_REQUEST['submit'])) {
    // $to = 'yourmailid@gmail.com';
    $subject = "Beautiful HTML Email using PHP by Discussdesk";
    // Get HTML contents from file
    $htmlContent = file_get_contents("index.html");

    // Set content-type for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: discussdesk<discussdesk@gmail.com>' . "\r\n";
    $headers .= 'Cc: discussdesk@gmail.com ' . "\r\n";


    $mail = new PHPMailer(true);
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'astitoumd@gmail.com';
    $mail->Password = 'psastfwwwpryytvn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('astitoumd@gmail.com');
    $mail->addAddress('mdastitou@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'test subject';
    $mail->Body = $htmlContent;
    $mail->send();
}

?>

<form method="post">
    <table border="1" align="center">
        <tr>
            <td>Enter Your Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Send Email"> </td>
        </tr>
        <table>
</form>