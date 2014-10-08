<?php
include '../../php/dbconnect.php';
$id=$_POST['id'];
$q=mysqli_query($con,"delete from category where id='".$id."'");
if(!$q)
	die("error");
mysqli_query($con,"ALTER TABLE  `college_entrance_test` DROP  `".$id."`");
$college=mysqli_query($con,"select cid from college_id");
while ($row=mysqli_fetch_assoc($college))
{
	$cid=$row['cid'];
	mysqli_query($con1,"ALTER TABLE  `t".$cid."` DROP  `".$id."`");
}


?>