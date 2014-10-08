<?php
session_start();
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$name=$_GET["uname"];
$uid=$_SESSION['datauserid'];
$op=mysqli_fetch_array(mysqli_query($con,"select * from datafeeder where uid='".$uid."'"))['password'];
$rop=$_GET["opass"];
if($op!=$rop)
die("error");
else
{
	mysqli_query($con,"update datafeeder set password='".$_GET['npass']."', name='".$name."' where uid='".$uid."'");
}

?>