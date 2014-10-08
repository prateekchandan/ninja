<?php
include '../../php/dbconnect.php';
$eid=$_POST['eid'];
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
$query="update exam set category ='".$q."' where eid=".$eid;
mysqli_query($con,$query);

?>