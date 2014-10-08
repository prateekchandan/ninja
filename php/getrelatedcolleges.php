<?php
 
 	$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
 	if(isset($_POST['id'])){
 		$id=$_POST['id'];
 	}
 	else if(isset($college_sql['cid'])){
 		$id=$college_sql['cid'];
 	}
 	else{
 		die("error");
 	}
 	$id=mysqli_real_escape_string($con,$id);

 	$qstr='select * from college_id where cid="'.$id.'"';
	$q=mysqli_query($con,$qstr);
	$college=mysqli_fetch_assoc($q);
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}


	$suggested_array=array();
	$suggested_array['Rajasthan']=array(904,1172,1243,1225,1520,1146,1183,1303,1155,1201,1165,1149,1176,1136,1199,1177,1170,1302,1230,1173,1178,1191,1248,1521,1145,1244);
	$suggested_array['Delhi/NCR']=array(958,966,972,974,979,1009,1030,1044,1065,1068,1089,1235,1236,1237,1238,1239,1240,1276,1277,1361,1362,1377,1379,1381,1383,1386,1387,908,912,920,922,923,928,929,930,931,932,933,934,939,940,941,942,943,944,946,948,950,951,952,953,956,957,1052,932,960,961,962,963,965,1080,1462,1463,1464,1465,1476,1477,1479,1480,1481,1482,1483,1484,1485,935,970,997,1001,1007,1024,1034,1063,1077,1086,1093,1233,1234,1245,1247,1249,1250,1251,1262,1263,1266,1267,1268,1269,1270,1271,1274,1448,1450,1451);

	$count=1;
	$return=array(array($college['name'],$college['cid'],clean($college['name'])."-".$college['link'],$college['city'],1));
	$allcid=array($college['cid']);
	if(isset($suggested_array[$college['state']])){
		$random=$suggested_array[$college['state']];
		shuffle($random);
		$i=0;
		while($count<5 && $i<sizeof($random)){

			$q=mysqli_query($con,'select * from college_id where cid = "'.$random[$i].'"');
			if($row=mysqli_fetch_assoc($q)){
				array_push($return, array($row['name'],$row['cid'],clean($row['name'])."-".$row['link'],$row['city'],1));
				array_push($allcid,$row['cid']);
				$count++;
			}
			$i++;
		}
	}

	$q=mysqli_query($con,'select * from college_id where city="'.$college['city'].'" && type="'.$college['type'].'"  && disabled="1" && cid!="'.$id.'" order by rand()');
 	
 	while($row=mysqli_fetch_assoc($q)){ 
 		if(!in_array($row['cid'],$allcid)){
 			if($count>=8)
				break;
			array_push($return, array($row['name'],$row['cid'],clean($row['name'])."-".$row['link'],$row['city'],1));
			array_push($allcid,$row['cid']);
			$count++;
		}
	}
	$q=mysqli_query($con,'select * from college_id where city="'.$college['city'].'" && type!="'.$college['type'].'"  && disabled="1" && cid!="'.$id.'" order by rand()');
 	while($row=mysqli_fetch_assoc($q)){ 
		if(!in_array($row['cid'],$allcid)){
			if($count>=9)
				break;
			array_push($return, array($row['name'],$row['cid'],clean($row['name'])."-".$row['link'],$row['city'],1));
			array_push($allcid,$row['cid']);
			$count++;
		}
	}

	$q=mysqli_query($con,'select * from college_id where state="'.$college['state'].'" && city!="'.$college['city'].'" && type="'.$college['type'].'"  && disabled="1" && cid!="'.$id.'" order by rand()');
 	while($row=mysqli_fetch_assoc($q)){ 
 		if(!in_array($row['cid'],$allcid)){
 			if($count>=10)
				break;
			array_push($return, array($row['name'],$row['cid'],clean($row['name'])."-".$row['link'],$row['city'],1));
			array_push($allcid,$row['cid']);
			$count++;	
		}
	}

	$q=mysqli_query($con,'select * from college_id where state="'.$college['state'].'" && city!="'.$college['city'].'" && type!="'.$college['type'].'"  && disabled="1" && cid!="'.$id.'" order by rand()');
 	while($row=mysqli_fetch_assoc($q)){ 
 		if(!in_array($row['cid'],$allcid)){
 			if($count>=10)
				break;
			array_push($return, array($row['name'],$row['cid'],clean($row['name'])."-".$row['link'],$row['city'],1));
			array_push($allcid,$row['cid']);
			$count++;
		}
	}
	echo json_encode($return);

?>
