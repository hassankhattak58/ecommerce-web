<?php

require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

$msg_id= safe_value($con,$_GET['id']);
$query = mysqli_query($con, "DELETE FROM `messages` WHERE `messages`.`id` = '$msg_id'");
header("location: inbox.php");

?>