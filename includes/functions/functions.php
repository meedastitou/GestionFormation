<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Admin/mail/src/Exception.php';
require 'Admin/mail/src/PHPMailer.php';
require 'Admin/mail/src/SMTP.php';

function sendEmail($to, $code)
{
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
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = 'test subject';
    $mail->Body = $code;
    $mail->send();
}

function generateRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
/*
    ** Title Function v1.0  
    ** Title Function That Echo The Page Title In Case The Page 
    ** Has The Variable $pageTitle And Echo Defult Title For Othrt Pager
    */

function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo ' Default';
    }
}
function converDate($date)
{
    $arrayDate = explode('-', $date);
    $month = "";
    switch ($arrayDate[1]) {
        case '1':
            $month = "Janvier";
            break;
        case '2':
            $month = "Fevrier";
            break;
        case '3':
            $month = "Mars";
            break;
        case '4':
            $month = "Avril";
            break;
        case '5':
            $month = "Mai";
            break;
        case '6':
            $month = "Juin";
            break;
        case '7':
            $month = "Juillet";
            break;
        case '8':
            $month = "Aout";
            break;
        case '9':
            $month = "Septembre";
            break;
        case '10':
            $month = "Octobre";
            break;
        case '11':
            $month = "Novembre";
            break;
        case '12':
            $month = "Decembre";
            break;
    }
    return $arrayDate[2] . ' ' . $month . ' ' . $arrayDate[0];
}

/*
    ** Home Redirect Function v2.0
    ** This Function Accept Paramaters
    ** $theMsg = Echo The Message[Error | Success | Warning]
    ** $url = The Link You Want To Redirect To 
    ** $seconds - Seconds Befor Redirecting
    */

    function redirectHome($errorMsg, $url = null, $seconds = 3)
    {
    
        if ($url === null) {
            $url = 'index.php';
            $link = 'Homepage';
        } else {
    
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
    
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'Previous Page';
            } else {
                $url = 'index.php';
                $link = 'Homepage';
            }
        }
    
        echo  $errorMsg;
    
        echo "<div class ='alert alert-info'> You Will Be Redirected To $link After $seconds Seconds.</div>";
    
        header("refresh: $seconds ; url= $url ");
        exit();
    }
    