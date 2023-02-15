<?php

require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

$cat_id = safe_value($con,$_GET['id']);
$query = mysqli_query($con, "DELETE FROM `category` WHERE `category`.`id` = '$cat_id'");
$query_product = mysqli_query($con, "DELETE FROM `products` WHERE `products`.`cat` = '$cat_id'");
header("location: dashboard.php");



?>