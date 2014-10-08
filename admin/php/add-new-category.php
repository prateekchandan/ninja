<?php
include '../../php/dbconnect.php';
$id=$_POST['id'];
$name=$_POST['name'];
$q=mysqli_query($con,"insert into category (id,name) values ('".$id."','".$name."')");
if(!$q)
	die("error");
mysqli_query($con,"ALTER TABLE  `college_entrance_test` ADD  `".$id."` INT NOT NULL DEFAULT  '0'");
$college=mysqli_query($con,"select cid from college_id");
while ($row=mysqli_fetch_assoc($college))
{
	$cid=$row['cid'];
	$a=mysqli_query($con1,"ALTER TABLE  `t".$cid."` ADD  `".$id."` INT NOT NULL DEFAULT  '0'");
	if(!$a)
		{
			echo "error";
			break;
		}
}


?>