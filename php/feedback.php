<?php

$to = "infermap@gmail.com";
$subject = "[MAIN INFERMAP FEEDBACK]";
$diff=['','Easy','Normal','Hard'];
$message = "<h4>RATED : ".$_POST['rate']."</h4><h4>Came to know infermap from : ".$_POST['news']."</h4>";
$message .= "<h4> Using Infermap was ".$diff[$_POST['difficulty']]."</h4><b>Feature that can be Improved :</b>".$_POST['feature'];
$message .="<br> College which he want to know : ".$_POST['college'];
$headers = 'From: no-reply@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
echo "done";

?>