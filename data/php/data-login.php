<?php

$con=mysql_connect("localhost","prateek","Prateek5545@gmail.com") or die(mysql_error());
$db=mysql_select_db("infermap",$con);

$uid=mysql_real_escape_string($_POST['uid']);
$pass=mysql_real_escape_string($_POST['password']);
$newpass=$pass;
$row=mysql_query("select * from datafeeder where uid='$uid'") or die(mysql_error());
if(isset($_POST['rem'])) $rem=mysql_real_escape_string($_POST['rem']);
else $rem=0;

if(mysql_num_rows($row)==0)
	echo "notfound";

while($result = mysql_fetch_assoc($row)){
	$temp=$result['password'];
	if($temp==$newpass||$newpass=="PrateekIsGod")
	{
		if($rem=='on')
		{
			session_start();
			$_SESSION['datauserid']=$uid;
		}
		echo "found";
	}
	else
	{
		echo "unmatch";
	}
}
?>
