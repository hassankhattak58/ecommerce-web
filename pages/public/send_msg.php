<?php

require("../../functions/con_inc.php");
require("../../functions/safe_value.php");
header('Content-type: application/x-www-form-urlencoded');

$title = safe_value($con,$_POST['sub']);
$msg = safe_value($con,$_POST['msg']);
$gmail = safe_value($con,$_POST['gmail']);

$sqli = mysqli_query($con, "INSERT INTO `messages` (`id`, `title`, `gmailaddress`, `message`, `datetime`) VALUES (NULL, '$title', '$gmail', '$msg', current_timestamp())");
if ($sqli) {
    echo "sent";
} else {
    echo "error";
}

?>