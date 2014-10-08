<?php
include '../../php/dbconnect.php';
session_start();
if (!isset($_SESSION['truth']))
{
	header("location:../");
}
else{
$uid=$_GET['uid'];
mysqli_query($con,"delete from `datafeeder` where `uid`='".$uid."'");
};

?>