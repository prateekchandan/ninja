<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
session_start();
$to = "prateekchandan5545@gmail.com";
$subject = "[INFERMAP FEEDBACK]:".$_POST['feedback-subject'];
$uid=$_SESSION['datauserid'];
$cid=$_SESSION['cid'];
$name=mysqli_fetch_assoc(mysqli_query($con,"select name from college_id where cid=".$cid))['name'];
$message = "<h3>Message sent by : ".$uid."</h3><h2>College Name : ".$name."<h3>";
$message .= "<b> Reply to : ".$_POST['feedback-email']."</b><h4>Message:</h4><p>".$_POST['feedback-msg']."</p>";
$headers = 'From: no-reply@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if(isset($_SESSION['truth']))
{
	mail("infermap@gmail.com",$subject,'<h1>Admins Cant send feedbacks.. contact Prateek Directly :P </h1>YOur message was <br>'.$_POST['feedback-msg'],$headers,'-fno-reply@infermap.com');
	die("");
}

mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
mail("infermap@gmail.com",$subject,$message,$headers,'-fno-reply@infermap.com');

?>