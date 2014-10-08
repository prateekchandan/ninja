<?php
$to = $_POST['id'];
$subject = "INFERMAP :New way to search college";
$message =$_POST['email']; 
$headers = 'From: data@infermap.com' . "\r\n" .
   'Reply-To: infermap@gmail.com' . "\r\n" .
   'X-Mailer: data@infermap.com';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to,$subject,$message,$headers,'-fno-reply@infermap.com');
$subject = "INFERMAP :New way to search college (Dean Mail Copy)";
$sending="<h4>Note : This is a copy of dean Mail originally sent to ".$to."</h4>".$message;
if(isset($_POST['infermap']))
mail("infermap@gmail.com",$subject,$sending,$headers,'-fno-reply@infermap.com');

?>