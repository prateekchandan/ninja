<?php
include 'dbconnect.php';
function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
$state=mysqli_real_escape_string($con,$_POST['state']);
$q=mysqli_query($con,'select * from department_ranking where `state`="'.$state.'"');
$ratings=array();
while($row=mysqli_fetch_assoc($q)){
	if(array_key_exists($row['college'], $ratings))
		$ratings[$row['college']]++;
	else
		$ratings[$row['college']]=1;
}

$q=mysqli_query($con,'select * from college_id where `state`="'.$state.'" && disabled=1');
$college=array();
while($row=mysqli_fetch_assoc($q)){
	if(array_key_exists($row['cid'],$ratings)){
		$row['noof']=$ratings[$row['cid']];
	}
	else
		$row['noof']=0;
	array_push($college, array($row['cid'],$row['name'],$row['city'],$row['alias1'],$row['alias2'],$row['alias3'],$row['alias4'],$row['alias5'],$row['alias6'],$row['alias7'],$row['alias8'],$row['noof'],clean($row['name'])."-".$row['link']));

}
function cmp($a, $b)
{
    return $a[11] - $b[11];
}

usort($college, "cmp");
echo json_encode($college);


?>