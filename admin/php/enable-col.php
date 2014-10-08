<?php
include '../../php/dbconnect.php';
 session_start();
  if (!isset($_SESSION['truth']))
  	die("error");

  if(isset($_POST['cid']))
  	$cid=$_POST['cid'];
  else
  	die("error");


$val=mysqli_fetch_assoc(mysqli_query($con,"select disabled from college_id where cid=".$cid))['disabled'];
if($val==0)
  mysqli_query($con,"update college_id set disabled=1 where cid =".$cid);
else
	mysqli_query($con,"update college_id set disabled=0 where cid =".$cid);
  echo $val;
?>