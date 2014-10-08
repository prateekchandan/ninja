<?php
include '../../php/dbconnect.php';
session_start();
if (!isset($_SESSION['truth']))
{
	die("error");
}
else{
$uid=mysqli_real_escape_string($con,$_POST['uid']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$phone=mysqli_real_escape_string($con,$_POST['phone']);
if(!ctype_lower($uid))
	die("error");
$q=mysqli_query($con,"select * from datafeeder where uid='".$uid."'");
if(mysqli_num_rows($q)>0)
die("error");
mysqli_query($con,"insert into datafeeder (uid,name,password,email,phone) values ('".$uid."','".$name."','".$password."','".$email."','".$phone."')");
};

?>