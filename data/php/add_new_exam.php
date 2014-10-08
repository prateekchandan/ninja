<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$name=mysqli_real_escape_string($con,$_POST['stream_name']);
$view=mysqli_real_escape_string($con,$_POST['stream_exam']);
$query=mysqli_query($con,"select * from exam where name='".$view."' && type='".$name."'");
if(mysqli_num_rows($query)>=1)
{
	die("error");
}
mysqli_query($con,"insert into exam (name,type) values ('".$view."','".$name."')");
echo mysqli_fetch_assoc(mysqli_query($con,"select * from exam where name='".$view."' && type='".$name."'"))['eid'];
?>