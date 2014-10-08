<?php
include 'dbconnect.php';
foreach ($_POST as $key => $value) {
	$_POST[$key]=mysqli_real_escape_string($con,$value);
}
$q="update college_id set ";
for ($i=1; $i <= 8; $i++) { 
	$q.=' alias'.$i.' = "'.$_POST['alias'.$i].'"';
	if($i!=8)
		$q.=' , ';
}
$q.=" where `cid`=".$_POST['cid'];
mysqli_query($con,$q);
?>