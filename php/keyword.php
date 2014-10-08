<?php
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
if(isset($querystr)){
	$query = mysqli_query($con,'select * from college_id where disabled=\'1\'');
	$ans = [];
	$input = $querystr;
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
	//print_r($ans);
	$i=0;
	$no = 10;
	if(isset($queryno)) $no = $queryno;
	if(!is_numeric($no))
		$no=20;
	$colleges=[];
	foreach ($ans as $key ) {
		$i++;
		if($i > $no) break;
		$colleges[$key['cid']]=$key['lev'];
		//array_push($colleges, $key['cid']);
	}
}
?>