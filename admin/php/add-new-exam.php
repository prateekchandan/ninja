<?php
include '../../php/dbconnect.php';
$examname=mysqli_escape_string($con,$_POST['examname']);
$type=$_POST['type'];
$q="[";
$categories=mysqli_query($con,"select id from category");
$i=0;
while ($row=mysqli_fetch_assoc($categories)) {
	if(isset($_POST[$row['id']]))
	{	
		if($i>0)
			$q.=",";
		$q.='"'.$row['id'].'"';
		$i=1;
	}
}
$q.="]";
$query="insert into exam (name,type,category) values ('".$examname."','".$type."','".$q."')";
mysqli_query($con,$query);

?>