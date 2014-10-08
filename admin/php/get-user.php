<?php
include '../../php/dbconnect.php';
session_start();
if (!isset($_SESSION['truth']))
{
	echo "error";
}
else{

$q=mysqli_query($con,"select * from datafeeder");
$r="<table class='table table-condensed table-responsive'><tr><th>User Id</th><th>Password</th></tr>";
while($row=mysqli_fetch_assoc($q))
{
	$r.='<tr><td>'.$row['uid']." </td><td> ".$row['password']."</td></tr>";
}
$r.="</table>";
echo $r;
}