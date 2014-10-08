<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$eid=$_POST['exam'];
$rank=$_POST['rank'];
if(isset($_POST['category']))
	$cat=$_POST['category'];
else
	$cat="gen";

$q=mysqli_query($con,"select cid,name from college_entrance_test where name=".$eid);
while($row=mysqli_fetch_assoc($q)){
	$cid=$row['cid'];
	$col=mysqli_fetch_assoc(mysqli_query($con,"select * from college_id where cid=".$cid));
	$q1=mysqli_query($con1,"select * from t".$cid." where name=".$eid);
	$a="<h2><a target=_blank href=\"http://www.infermap.com/data/cp.php?cid=".$col['link']."\">".$col['name']."</a></h2>";
	$t=0;
	while($r1=mysqli_fetch_assoc($q1)){
		if($eid!=24&&$eid!=9&&$eid!=5){
			if($r1[$cat]!=0&&$r1[$cat]>$rank){
			$a.=$r1['department']." : ".$r1[$cat]."<br>";
			$t=1;
			}
		}
		else{
			if($r1[$cat]!=0&&$r1[$cat]<$rank){
			$a.=$r1['department']." : ".$r1[$cat]."<br>";
			$t=1;
			}
		}
	}
	if($t)
		echo $a;
}

?>