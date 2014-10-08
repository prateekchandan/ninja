<?php

$name=$_GET["name"];
if(isset($_GET["name"]))
{
	$name=$_GET["name"];
}
else
{
	die("error");
}
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$query_res=mysqli_query($con,"select link from college_id where name='".$name."'");
if(mysqli_num_rows($query_res)>1||mysqli_num_rows($query_res)<1)
{
	die("error");
}
else
echo mysqli_fetch_array($query_res)['link'];
?>