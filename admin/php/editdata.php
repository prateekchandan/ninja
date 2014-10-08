<?php
include '../../php/dbconnect.php';
session_start();
if (!isset($_SESSION['truth']))
{
	die("error");
}
else{
$uid=$_POST['uid'];
$phone=mysqli_real_escape_string($con,$_POST['phone']);
$email=mysqli_real_escape_string($con,$_POST['email']);
mysqli_query($con,"update `datafeeder` set email='".$email."' , phone='".$phone."' where `uid`='".$uid."'");
};

?>