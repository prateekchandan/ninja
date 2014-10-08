<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
else
$cid=0;
session_start();
$_SESSION['cid']=$cid;
header("Location: ../college-editable.php");
?>