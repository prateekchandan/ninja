<?php
if($_GET["pass"]=="!nferm@p26O7")
{
	session_start("admin");
	$_SESSION["truth"]=true;
	print_r("true");
}
else
{
	print_r("false");
}
//header("Location:../search.php");
?>