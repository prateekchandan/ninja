<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$eid=$_POST['eid'];
echo mysqli_fetch_assoc(mysqli_query($con,"select * from exam where eid=".$eid))['category'];
?>