<?php
// <!-- conneting To DB -->
$host = "localhost";
$password = "";
$username = "root";
$db_name = "metroshoes";

$con = mysqli_connect($host,$username,$password,$db_name);
if(!$con){
    echo("Something is Wrong");
    echo mysqli_connect_error();
} else{
    // echo("Connectes");
}
?>