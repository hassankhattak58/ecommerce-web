<?php
require_once("../../functions/con_inc.php");
require_once("../../functions/safe_value.php");

$oldname = safe_value($con,$_GET['username']);
$error = "";
if (isset($_POST['update_profile'])) {
    $uname = safe_value($con,$_POST['uname']);
    $gmail = safe_value($con,$_POST['gmail']);
    $phone = safe_value($con,$_POST['phone']);
    $query = mysqli_query($con, "UPDATE `admins` SET `uname` = '$uname', `gaddress` = '$gmail', `phoneno` = '$phone' WHERE `uname` = '$oldname'");
    if ($query) {
        $error = '<div class="nojs-alert">
            <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
            <div class="alert-content">
                <div>
                    <h1>Profile Updated Sucessffully</h1>
                </div>
            </div>
            <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                <svg width="24" height="24" role="button" arial-label="close alert">
                    <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                    <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                </svg>
            </label>
        </div>';
        header("location: ./profile.php?username=$uname");
        session_start();
        $_SESSION['username'] = $uname;
         if ($query) {
        $error = '<div class="nojs-alert">
            <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
            <div class="alert-content">
                <div>
                    <h1>Profile Updated Sucessffully</h1>
                </div>
            </div>
            <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                <svg width="24" height="24" role="button" arial-label="close alert">
                    <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                    <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                </svg>
            </label>
        </div>';
        header("location: ./profile.php?username=$uname");
    } 
    } else {
        $error = '<div class="nojs-alert">
            <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
            <div class="alert-content">
                <div>
                    <h1>Error Occured. Please Try again later</h1>
                </div>
            </div>
            <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                <svg width="24" height="24" role="button" arial-label="close alert">
                    <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                    <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                </svg>
            </label>
        </div>';
    }
}

if (isset($_POST['delete_profile'])) {
    $query = mysqli_query($con, "DELETE FROM  `admins` WHERE `uname` = '$oldname'");
    if ($query) {
        header("location: ./logout.php");
    }
}


?>

