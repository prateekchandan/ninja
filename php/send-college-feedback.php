<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$to = "prateekchandan5545@gmail.com";
$subject = "[COLLEGE FEEDBACK]:".$_POST['feedback-subject'];
$message = "<h3>Message sent by : ".$_POST['feedback-email']."</h3><h3>College Name : ".$_POST['college-name']."<h3>";
$message .= "<h4>Message:</h4><p>".$_POST['feedback-msg']."</p>";
$headers = 'From: no-reply@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if(isset($_SESSION['truth']))
{
	mail("infermap@gmail.com",$subject,'<h1>Admins Cant send feedbacks.. contact Prateek Directly :P </h1>YOur message was <br>'.$_POST['feedback-msg'],$headers,'-fno-reply@infermap.com');
	die("daw");
}
//mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
mail("infermap@gmail.com",$subject,$message,$headers,'-fno-reply@infermap.com');
?>