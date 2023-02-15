<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");
$admin_id = safe_value($con,$_GET['id']);
session_start();
$username = $_SESSION['username'];


$sql = mysqli_query($con, "SELECT * FROM `admins` WHERE `id` = '$admin_id'");
$row = mysqli_fetch_assoc($sql);



$sql = mysqli_query($con, "DELETE FROM `admins` WHERE `admins`.`id` = '$admin_id'");

if (!$sql) {
    header("location: adminlist.php");
}else {
    if ($row['uname'] == $username) {
        header("location: ../log&sign/signup.php");
        echo $uname;
    } else {
        header("location: ./dashboard.php");
    }
}
