<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$name=mysqli_real_escape_string($con,$_POST['stream_name']);
$view=mysqli_real_escape_string($con,$_POST['stream_val']);
mysqli_query($con,"insert into allcourses (name,value) values ('".$name."','".$view."')");
?>