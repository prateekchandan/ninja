<?php
include("dbconnect.php");
if(isset($_POST['key']))
{
	$key=$_POST['key'];
}
else
	$key="";
if($key=="")
	die("Error Please provide input");

$examq=mysqli_query($con,"select * from exam");
$exam = array();
while($row1=mysqli_fetch_assoc($examq)){
	$exam[$row1['eid']]=$row1['name'];
}

$name=mysqli_real_escape_string($con,$key);
$q=mysqli_query($con,"select * from college_id where name = '".$name."' && disabled=1");
if(mysqli_num_rows($q)>0)
{
	$data=mysqli_fetch_assoc($q);
	if(file_exists("../data/data/".$data['cid']."/logo.png"))
		$imgsrc="data/data/".$data['cid']."/logo.png";
	else
		$imgsrc="img/center-icon.jpg";
	$str='<div class="college-short-profile">
						<div class="close" onclick="cancel('.$_POST['no'].')">&times;</div>
					<div class="img-container"><img src="'.$imgsrc.'" height="100px" width="100px"></div><strong><div class="college_name" ><a href="data/cp.php?cid='.$data['link'].'" target="_blank">'.$data['name'].'</a></div></strong></div>';
	$data['main']=$str;
	$cid=$data['cid'];
	$q="select * from college_entrance_test where (type='btech' || type='be') && cid=".$cid;
		$examname = array();
		$examname[$cid]=[];
		$examstr="";
		$query=mysqli_query($con,$q);
		//$examstr.=$q;
		if(mysqli_num_rows($q==0))
			return "No exam available";
		while($r=mysqli_fetch_assoc($query)){
			if($r['name']!=0)
			array_push($examname[$r['cid']], $exam[$r['name']].' ('.$r['type'].")");
		}
		foreach ($examname[$cid] as $ename) {
			if($i>0)
				$examstr.= "<br>";
			$examstr.= $ename;
			$i+=1;
		}
	$data['exam']=$examstr;

	//
	$q=mysqli_query($con,"select * from departments");
	$dept=array();
	$str="";
	while($r=mysqli_fetch_assoc($q)){
		$dept[ $r['key']]=$r['value'];
	}
	$key=$cid;
		$q=mysqli_fetch_assoc(mysqli_query($con,"select * from college_department where cid=".$key));
		$i=0;
		
		foreach ($dept as $kd => $value) {
			if($q[$kd]==1){
				if($i>0)
				$str.= "<br>";
				$str.= $value;
				$i+=1;
			}
		}

	$data['depts']=$str;
	die("college".json_encode($data));
}
else
{
	
}
$pattern = '/[:,.-_ ()]/';
function mylev($array1, $str){
	$pattern = '/[:,.-_ ()]/';
	$array2 = preg_split($pattern, $str);
	$sum = 0;
	for($i = 0; $i < sizeof($array1); $i++){
		$min = 1000;
		for($j = 0; $j < sizeof($array2); $j++){
			if($array1[$i] == '');
			else{
				$temp = levenshtein($array1[$i], $array2[$j]);
				if($temp < $min) $min = $temp;
			}
		}
		$sum = $sum + $min;
	}
	return $sum;
}
function cmp($a, $b) {
    if ($a['lev'] == $b['lev']) {
        return 0;
    }
    return ($a['lev'] < $b['lev']) ? -1 : 1;
}

if(isset($key)){
	$query = mysqli_query($con,"select * from college_id where disabled=1");
	$ans = [];
	$input = $key;
	$arryain = preg_split($pattern, strtolower($input));
	while($row = mysqli_fetch_assoc($query)){
		$state = $row['state'];
		$a = $row['name'];
		$lev = mylev($arryain, strtolower($a));
		for($i = 1; $i < 11; $i++){
			if($i<9){
				$a = $row['alias'.$i];
				if($row['alias'.$i]!=""){
					$temp = mylev($arryain, strtolower($a));
					if($temp < $lev) $lev = $temp;
				}
			}
			elseif ($i==10) {
				$a = $row['city'];
				if($row['city']!=""){
					$temp = mylev($arryain, strtolower($a));
					if($temp < $lev) $lev = $temp;
				}
			}
			elseif ($i==9) {
				$a = $row['state'];
				if($row['state']!=""){
					$temp = mylev($arryain, strtolower($a));
					if($temp < $lev) $lev = $temp;
				}
			}
		}
		$strct = ['name' => "'".$row['name']."'",'cid'=>$row['cid'], 'lev' => $lev];
		array_push($ans, $strct);
	}


	uasort($ans, 'cmp');
	$iter=0;
	if(isset($queryno)) $no = $queryno;
	if(!is_numeric($no))
		$no=20;
	$colleges=[];
	$count=0;
	foreach ($ans as $key) {
		if($key['lev']>0&& $count>1) {
			break;
		}
		$count+=1;
		/*****/
			$q=mysqli_query($con,"select * from college_id where cid=".$key['cid']);
			$data=mysqli_fetch_assoc($q);
			if(file_exists("../data/data/".$key['cid']."/logo.png"))
				$imgsrc="data/data/".$key['cid']."/logo.png";
			else
				$imgsrc="img/center-icon.jpg";
			$str='<div class="college-short-profile">
								<div class="close" onclick="cancel('.$_POST['no'].')">&times;</div>
							<div class="img-container"><img src="'.$imgsrc.'" height="100px" width="100px"></div><strong><div class="college_name"><a href="data/cp.php?cid='.$data['link'].'" target="_blank">'.$data['name'].'</a></div></strong></div>';
			$data['main']=$str;
			$cid=$data['cid'];
			$q="select * from college_entrance_test where (type='btech' || type='be') && cid=".$cid;
				$examname = array();
				$examname[$cid]=[];
				$examstr="";
				$query=mysqli_query($con,$q);
				//$examstr.=$q;
				if(mysqli_num_rows($q==0))
					return "No exam available";
				while($r=mysqli_fetch_assoc($query)){
					if($r['name']!=0)
					array_push($examname[$r['cid']], $exam[$r['name']].' ('.$r['type'].")");
				}
				foreach ($examname[$cid] as $ename) {
					if($i>0)
						$examstr.= "<br>";
					$examstr.= $ename;
					$i+=1;
				}
			$data['exam']=$examstr;

			//
			$q=mysqli_query($con,"select * from departments");
			$dept=array();
			$str="";
			while($r=mysqli_fetch_assoc($q)){
				$dept[ $r['key']]=$r['value'];
			}
				$q=mysqli_fetch_assoc(mysqli_query($con,"select * from college_department where cid=".$cid));
				$i=0;
				
				foreach ($dept as $kd => $value) {
					if($q[$kd]==1){
						if($i>0)
						$str.= "<br>";
						$str.= $value;
						$i+=1;
					}
				}

			$data['depts']=$str;
			$colleges[$key['cid']]=$data;
		/****/
		$iter++;
		
	}
	echo "keyword";
	echo json_encode($colleges);
}
?>