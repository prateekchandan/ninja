<?php

include('dbconnect.php');
$con=mysqli_connect($dbhost, $dbusername, $dbpass,$dbname) or die("Database error");


foreach ($_POST as $key => $value) {
	$_POST[$key]=mysqli_real_escape_string($con,$value);
}

$var=$_POST['cllg'];
$var1=$_POST['rate'];
$var2=$_POST['que'];
$email=$_POST['email'];


if(empty($var2))
{
	$msg="Please answer all the questions.";
}
else if(!($var1>=1 && $var1<=10))
{
	$msg="Input integer between 1-10.";
}
else
{
	mysqli_query($con,"INSERT INTO quiz_feedback (`college`,`rate`,`question`,`email`) values('$var','$var1','$var2','$email')");
	$msg="done";	
}
echo $msg;
?>
