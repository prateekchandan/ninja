<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$stq=$_POST['program'];
$q="select Distinct `college_id`.* FROM  `college_id`,`college_entrance_test`,`college_department` WHERE ( false ";
$len=sizeof($stq);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_entrance_test.type=\"".$stq[$i]."\"";
}
$q.=") && ( false ";
$stq=$_POST['state'];
$len=sizeof($stq);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_id.state=\"".$stq[$i]."\"";
}
$q.=") && ( false ";
$stq=$_POST['exam'];
$len=sizeof($stq);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_entrance_test.name=".$stq[$i];
}
$q.=") && ( false ";
$stq=$_POST['dept'];
$len=sizeof($stq);
for ($i=1; $i < $len; $i++) { 
	$q.=" || `college_department`.`".$stq[$i]."`=1";
}
$q.=") && college_id.cid=college_entrance_test.cid && college_id.cid=college_department.cid";
$query=mysqli_query($con,$q);
$res=[];
echo "[";
$falg=false;
while ($row=mysqli_fetch_assoc($query)) {
	if(file_exists("../data/data/".$row['cid']."/logo.png"))
		$row['imgsrc']="data/data/".$row['cid']."/logo.png";
	else
	$row['imgsrc']="data/img/icon.png";

	if($falg)
		echo ",";
	print_r(json_encode($row));
	$falg=true;
}
echo "]";
?>