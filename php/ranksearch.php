<?php

$q=mysqli_query($con,"select eid from exam where name='".$eid."'");
$str="";
$eidar=array();
while($row=mysqli_fetch_assoc($q)){
	if($str!="")
		$str.=" || ";
	array_push($eidar,$row['eid']);
	$str.=" name = ".$row['eid'];
}
$q=mysqli_query($con,"select cid,name from college_entrance_test where ".$str);
	$colleges=[];
while($row=mysqli_fetch_assoc($q)){
	$cid=$row['cid'];
	$q2=mysqli_query($con,"select * from college_id where cid=".$cid." && disabled='1'");
	if(mysqli_num_rows($q2)<=0)
		continue;
	if($rank==''){
			array_push($colleges, $cid);
				continue;
	}
	$col=mysqli_fetch_assoc(mysqli_query($con,"select * from college_id where disabled='1' && cid=".$cid));
	$q1=mysqli_query($con1,"select * from t".$cid." where ".$str);
	$t=0;
	if($q1)
	while($r1=mysqli_fetch_assoc($q1)){
		foreach ($eidar as $eid ) {
			if($eid!=24&&$eid!=9&&$eid!=5&&$r1[$cat]>$rank){
				$t=1;
				break;
			}
			else{
				if($r1[$cat]!=0&&$r1[$cat]<$rank){
				$t=1;
				break;
				}
			}
		}
		if($t==1)
			break;
	}
	if($t)
		array_push($colleges, $cid);
}
?>