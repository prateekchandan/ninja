<?php
include '../../php/dbconnect.php';
$name=mysqli_real_escape_string($con2,$_POST['coaching-name']);
$id=$_POST['name'];
$password=md5($_POST['password']);
$q=mysqli_query($con2,"select * from coaching where id='".$id."'");
if(mysqli_num_rows($q)>0)
	die("error");
mysqli_query($con2,"insert into coaching (`id`,`name`,`link`,`password`) values ('".$id."','".$name."','".$id."','".$password."') ");
 if(!is_dir("../../coaching/data/".$id))
		mkdir("../../coaching/data/".$id, 0777);

 if(!is_dir("../../coaching/data/".$id."/contact"))
		mkdir("../../coaching/data/".$id."/contact", 0777);
mysqli_query($con2,"create table t_".$id." like t_dummy");
mysqli_query($con2,"create table fee_".$id." like fee_dummy");
echo "<br>New coaching added <br> Remember the password :".$_POST['password'];
?>