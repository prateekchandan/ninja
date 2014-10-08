<?php

$con=mysql_connect("localhost","prateek","Prateek5545@gmail.com") or die(mysql_error());
$db=mysql_select_db("infermap",$con);
$email=mysql_real_escape_string($_POST['reg-email']);
$pass=mysql_real_escape_string($_POST['reg-password']);
$newpass=md5($pass);
if(strlen($pass)<8)
	die("pass-err");
$name=mysql_real_escape_string($_POST['reg-name']);
if(strlen($name)<5)
	die("name-err");
error_reporting(0);
$query="insert into user (name,email,password) values ('".$name."','".$email."','".$newpass."')";
mysql_query($query) or die(mysql_error());
echo "success";
//}
?>
