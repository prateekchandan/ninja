<?php
session_start();
$email="noreply@infermap.com";
$headers  = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Return-Path: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
if(isset($_SESSION['truth']))
{
	mail('data@infermap.com', 'NEW COLLEGE ENTRY NOTIFICATION','<h1> Admins cant send feedback :P' ,$headers);
	die("");
}
$_SESSION['college_name']=$_POST['college'];
$mail="<b> NEW COLLEGE ENTRY NOTIFICATION </b><br> COLLEGE NAME : ".$_POST['college']."<br>Phone no :".$_POST['phone']."<br>Email :".$_POST['email']."
<br>USER ID :".$_SESSION['datauserid']."<br> Being the administrator its your responsibility to take care of this";
echo $mail;
mail('data@infermap.com', 'NEW COLLEGE ENTRY NOTIFICATION',$mail ,$headers);


?>
