<?php
include 'php/dbconnect.php';

$file=fopen("college.json","w+") or exit("Json Error");

$q=mysqli_query($con,"select * from college_id where disabled='1'");
$colleges=array();
$i=0;
while($row=mysqli_fetch_assoc($q)){
	$college=array();
	$college['year']=$row['cid'];
	$college['value']=$row['name'];
	$tokens=array();
	for ($i=1; $i < 9; $i++) { 
		if($row['alias'.$i]!='')
			array_push($tokens, $row['alias'.$i]);
	}
	$college['tokens']=$tokens;

	array_push($colleges, $college);
}
$str=json_encode($colleges);	
fwrite($file,$str);
echo $str;
?>