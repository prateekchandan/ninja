<?php
include "dbconnect.php";

foreach ($_POST as $key => $value) {
	$_POST[$key]=mysqli_real_escape_string($con,$value);
}
$ip=$_SERVER['REMOTE_ADDR'];
mysqli_query($con,"insert into department_ranking (college,state,depts,email,college_rate,`ip`) values 
	('".$_POST['college']."','".$_POST['state']."','".$_POST['depts']."','".$_POST['email']."','".$_POST['colrank']."','".$ip."')");
echo "done";
?>