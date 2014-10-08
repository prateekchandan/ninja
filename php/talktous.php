<?php
$to = "infermap@gmail.com";
$subject = "[TALK TO US]:by".$_POST['name'];
$message = "<h4>Message sent by : ".$_POST['name']."</h4><h4>Company : ".$_POST['company']."</h4>";
$message .= "<h4>Email ".$_POST['email']."</h4>";
if($_POST['phone']!="")
$message .= "<h4>Phone no ".$_POST['phone']."</h4>";
$message .="<h4>Message : </h4>  ".$_POST['message'];
$headers = 'From: no-reply@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
echo "done";
?>