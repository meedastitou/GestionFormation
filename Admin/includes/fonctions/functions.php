<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

function countFormations()
{
    $count = getCount();

    return $count;
}

function validation($formationName, $formationCat, $objectif, $proposedBy, $numberHoures, $trainerName, $traininigSite, $nbParticepants, $dateStart, $dateFin, $responsible)
{
    // Validate The Form 
    $formErrors = array();

    if (empty($formationName)) {
        $formErrors[] = 'formation Name Cant Be  <strong> Empty</strong>';
    }
    if (empty($formationCat)) {
        $formErrors[] = 'formation Categorie Cant Be  <strong> Empty</strong>';
    }
    if (empty($proposedBy)) {
        $formErrors[] = 'proposed By Cant Be <strong> Empty</strong>';
    }
    if (empty($numberHoures) || $numberHoures < 0) {
        $formErrors[] = 'Number Houres Cant Be  <strong> Empty</strong> OR <strong>Less Then 1</strong>';
    }
    if (empty($trainerName)) {
        $formErrors[] = 'trainer Name Cant Be <strong> Empty</strong>';
    }
    if (empty($traininigSite)) {
        $formErrors[] = 'Formation Site Cant Be <strong> Empty</strong>';
    }
    if ($nbParticepants < 0) {
        $formErrors[] = 'number of participants  Cant Be <strong> Less Then 0</strong>';
    }
    if ($dateStart > $dateFin) {
        $formErrors[] = 'Date Fin Must Be <strong> Greater </strong> Than Date Start';
    }
    if (empty($responsible)) {
        $formErrors[] = 'Responsible OF The Formation Cant Be <strong> Empty</strong>';
    }
    if (empty($objectif)) {
        $formErrors[] = 'The purpose of this training Cant Be <strong> Empty</strong>';
    }
    return $formErrors;
}

function sendEmail($to)
{



    require '../../mail/src/Exception.php';
    require '../../mail/src/PHPMailer.php';
    require '../../mail/src/SMTP.php';

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
    $mail->Body = $htmlContent;
    $mail->send();
}
