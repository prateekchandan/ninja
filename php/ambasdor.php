<?php 
//define the receiver of the email 
/*$to = 'infermap@gmail.com'; 
$subject ="[AMBASSDOR APPLICATION] : by ".$_GET['name'];
$message = "<h4>Name : ".$_GET['name']."</h4>";
	$message .= "<h4>Email : ".$_GET['email']."</h4>";
	$message .= "<h4>College : ".$_GET['college']."</h4>";
	$message .= "<h4>City: ".$_GET['city']."</h4>";
	$message .= "<h4>State : ".$_GET['state']."</h4>";
	$message .= "<h4>Phone : ".$_GET['phone']."</h4>";
	$message .= "<h4>Statement of purpose : ".$_GET['sop']."</h4>";
$headers = 'From: no-reply@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
echo "done";*/
include 'dbconnect.php';
foreach ($_POST as $key => $value) {
	$value=mysqli_real_escape_string($con,$value);
	$value=str_replace('\r\n', '<br>',$value);
	$_POST[$key]=$value;
}
$qstr="insert into ambassador (name,email,college,state,city,phone,sop,skills,ip) values (
		'".$_POST['name']."',
		'".$_POST['email']."',
		'".$_POST['college']."',
		'".$_POST['state']."',
		'".$_POST['city']."',
		'".$_POST['phone']."',
		'".$_POST['sop']."',
		'".$_POST['skills']."',
		'".$_SERVER['REMOTE_ADDR']."')
	";

mysqli_query($con,$qstr);

echo 'done';



?>
