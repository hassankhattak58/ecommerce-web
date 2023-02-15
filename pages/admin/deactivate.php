<?php

require("../../functions/con_inc.php");
require("../../functions/safe_value.php");
$cat_id = safe_value($con,$_GET['id']);

$query = mysqli_query($con, "SELECT * FROM `category` WHERE `id` = '$cat_id'");
$row = mysqli_fetch_assoc($query);

if($row['status'] == 1){
    $query_update = mysqli_query($con, "UPDATE `category` SET `status` = '0' WHERE `id` = '$cat_id'");
    $product_cat_status = mysqli_query($con, "UPDATE `products` SET `cat_status` = '0' WHERE `cat` = '$cat_id'");
}else{
    $query_update = mysqli_query($con, "UPDATE `category` SET `status` = '1' WHERE `id` = '$cat_id'");
    $product_cat_status = mysqli_query($con, "UPDATE `products` SET `cat_status` = '1' WHERE `cat` = '$cat_id'");
}
header("location: dashboard.php");



?>