<?php
session_start();
$cid=$_SESSION['coachingid'];
$q=mysqli_query($con,"select * from coaching where link='".$cid."'");
$data=mysqli_fetch_assoc($q);
unset($_SESSION['coachingid']);
header("Location: ../coaching.php?coaching=".$data['link']);
?>