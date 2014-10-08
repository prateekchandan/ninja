<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$email=$_POST['email'];
$password=$_POST['pass'];
$r=mysqli_query($con,"select * from user where email='".$email."'");
if(mysqli_num_rows($r)<=0)
	die("email-err");

if(mysqli_fetch_assoc($r)['password']!=md5($password))
	die("pass-err");

session_start();
$_SESSION['user-email']=$email;

echo "done";

?>