<?php
include '../../php/dbconnect.php';
 session_start();
  if (!isset($_SESSION['truth']))
  	die("error");

  if(isset($_POST['cid']))
  	$cid=$_POST['cid'];
  else
  	die("error");

 if(isset($_POST['rank']))
  	$rank=mysqli_real_escape_string($con,$_POST['rank']);
  else
  	die("error");

  $strank=mysqli_real_escape_string($con,$_POST['strank']);


  mysqli_query($con,"update college_id set rank='".$rank."' , state_rank='".$strank."' where cid =".$cid);

  echo "done";
?>