<?php

require("../../functions/con_inc.php");
require("../../functions/safe_value.php");
if (isset($_GET['master']) && $_GET['master'] == "color") {
    $color_id = safe_value($con, $_GET['id']);
    $query = mysqli_query($con, "DELETE FROM `color_master` WHERE `color_master`.`id` = '$color_id'");
    header("location: color_master.php");
} elseif (isset($_GET['master']) && $_GET['master'] == "size") {
    $size_id = safe_value($con, $_GET['id']);
    $query = mysqli_query($con, "DELETE FROM `size_master` WHERE `size_master`.`id` = '$size_id'");
    header("location: size_master.php");
}else{
    header("location: dashboard.php");
}
