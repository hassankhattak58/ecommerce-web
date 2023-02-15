<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");
header('Content-type: application/x-www-form-urlencoded');
$entered_otp = safe_value($con,$_POST['otp']);
session_start();
$main_otp = $_SESSION['main_otp'];
$username = $_SESSION['username'];
if ($entered_otp == $main_otp) {
    echo "verified";;
} else {
    echo "invalidotp";
}
