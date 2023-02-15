<?php
require("../../functions/con_inc.php");
header('Content-type: application/x-www-form-urlencoded');
$emailadd = $_POST['gmail'];
//Include required PHPMailer files
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
// $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "";  //Your Email Account Address Goes Here
$mail->Password = "";  //Your Email Account App Password Goes Here
$mail->SetFrom("");    //Email From Email Address Goes Here
$mail->Subject = "Metroshoes: Verfication Code"; //Mail Subject Goes Here
$random = rand(1111,9999);
session_start();
$_SESSION['main_otp'] = $random;
$mail->Body = "Your 4 Digit Verification code for MetroShoes is:  " . $random;
$mail->AddAddress($emailadd); //Mail to Address Goes Here

 if(!$mail->Send()) {
    // echo "error " . $mail->ErrorInfo;
    echo "error";
 } else {
    echo "sent";
 }


?>