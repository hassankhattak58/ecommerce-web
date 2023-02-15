<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

header('Content-type: application/x-www-form-urlencoded');
$entered_otp = safe_value($con,$_POST['otp']);
session_start();
$main_otp = $_SESSION['main_otp'];
$username = $_SESSION['username'];
if($entered_otp == $main_otp){
    $sqli = mysqli_query($con, "UPDATE `admins` SET `status` = '1' WHERE `admins`.`uname` = '$username'");
    if(!$sqli){
        echo "Error Occeured. Please Try again later";
    }else{
        echo "verified";
        $_SESSION['status'] = 1;
    }
}else{
    echo "invalidotp";
}


?>