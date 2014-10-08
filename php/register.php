<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$email=mysqli_escape_string($con,$_POST['email']);
$name=mysqli_escape_string($con,$_POST['name']);
$phone=mysqli_escape_string($con,$_POST['phone']);
$city=mysqli_escape_string($con,$_POST['city']);
$type=mysqli_escape_string($con,$_POST['type']);
if($_POST['pass']!=$_POST['repass'])
die("error");

$password=md5($_POST['pass']);

if(isset($_POST['agree']))
	$spam_me="yes";
else
	$spam_me="no";

$q=mysqli_query($con,"select * from user where email='".$email."'");
if(mysqli_num_rows($q)>0)
die("email-err");

mysqli_query($con,"insert into user (name,email,phone,city,type,password,spamme) values ('".$name."','".$email."','".$phone."','".$city."','".$type."','".$password."','".$spam_me."')");
echo "done";
?>