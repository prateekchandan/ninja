<?php
include '../../php/dbconnect.php';
$pwd=$_POST['pwd'];
$check=mysqli_fetch_array(mysqli_query($con,"select * from variables where var='admin'"))['value'];
if($pwd!=$check)
{
	session_start();
	unset($_SESSION['truth']);
	header("location:../");
}
else{
session_start();
$_SESSION['truth']=1;
header("location:../");
}


?>