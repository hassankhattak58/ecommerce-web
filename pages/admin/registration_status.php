<?php

require_once ("../../functions/con_inc.php");
$check_status = mysqli_query($con, "SELECT * FROM `registration_status` WHERE `id` = 1");
$row = mysqli_fetch_assoc($check_status);

echo $row['status'];
if($row['status'] == 1){
$sql = mysqli_query($con, "UPDATE `registration_status` SET `status` = '0' WHERE `registration_status`.`id` = 1");
header("location: dashboard.php");

}else{
$sql = mysqli_query($con, "UPDATE `registration_status` SET `status` = '1' WHERE `registration_status`.`id` = 1");
header("location: dashboard.php");

}
