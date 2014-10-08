<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","coaching") or die(mysql_error());
session_start();

if(isset($_SESSION['coachingid'])) {
    $cid=$_SESSION['coachingid'];
}
else
die("error");
$results=json_decode($_POST['resulttable']);
$batch=json_decode($_POST['batchtable']);
$faculty=json_decode($_POST['facultytable']);
$stratio=json_decode($_POST['stratiotable']);
$contact=json_decode($_POST['contacttable']);
$centres=array();

foreach ($results as $row) {    
    $row=get_object_vars($row);
    if(!in_array($row['center'], $centres))
    array_push($centres, $row['center']);
  }
  foreach ($batch as $row ){ 
    $row=get_object_vars($row);
    if(!in_array($row['center'], $centres))
    array_push($centres, $row['center']);
  }
  foreach ($faculty as $row) { 
    $row=get_object_vars($row);
    if(!in_array($row['center'], $centres))
    array_push($centres, $row['center']);
  }
  foreach ($contact as $row) { 
    $row=get_object_vars($row);
    if(!in_array($row['center'], $centres))
    array_push($centres, $row['center']);
  }

   foreach ($stratio as $row) { 
    $row=get_object_vars($row);
    if(!in_array($row['center'], $centres))
    array_push($centres, $row['center']);
  }
mysqli_query($con,"delete from t_".$cid." where 1");
if(sizeof($centres)<=0)
die("");
$str="insert into t_".$cid." (`center`) values ";
$i=0;
foreach ($centres as $key) {
    if($i>0)
        $str.= ",";
    $i+=1;
    $str.="('".$key."')";
}
$bstl=array('8th', '9th', '10th', '11th', '12th', '12thpassout');
$rstl=array( 'jeemains', 'jeeadvanced', 'bits');
$fstl=array( 'physics', 'chemistry', 'math', 'bio');
$sstl=array( 'physics', 'chemistry', 'math', 'bio');
$cstl=array( 'phoneno', 'address','email','alternatephone');

$bst=array('batch8','batch9','batch10','batch11','batch12','batch13'); 
$rst=array('selection_main','selection_advance','selection_bits');
$fst=array('fac_phy','fac_chem','fac_math','fac_bio');
$sst=array('st_math','st_phy','st_chem','st_bio');
$cst=array('phone','address','email','alphone');
mysqli_query($con,$str);
foreach ($results as $row) {    
    $row=get_object_vars($row);
    $q="update t_".$cid." set ";
    for($i=0;$i<3;$i++){
        if($i!=0)
            $q.=" , ";
        $q.='`'.$rst[$i].'`'."='".$row[$rstl[$i]]."' ";
    }
    $q.=" where `center`='".$row['center']."'";
    mysqli_query($con,$q);
  }
  foreach ($batch as $row ){ 
     $row=get_object_vars($row);
    $q="update t_".$cid." set ";
    for($i=0;$i<6;$i++){
        if($i!=0)
            $q.=" , ";
        $q.='`'.$bst[$i].'`'."='".$row[$bstl[$i]]."' ";
    }
    $q.=" where `center`='".$row['center']."'";
    mysqli_query($con,$q);

   
  }
  foreach ($faculty as $row) { 
     $row=get_object_vars($row);
    $q="update t_".$cid." set ";
    for($i=0;$i<4;$i++){
        if($i!=0)
            $q.=" , ";
        $q.='`'.$fst[$i].'`'."='".$row[$fstl[$i]]."' ";
    }
    $q.=" where `center`='".$row['center']."'";
    mysqli_query($con,$q);

    
  }

  foreach ($stratio as $row) { 
     $row=get_object_vars($row);
    $q="update t_".$cid." set ";
    for($i=0;$i<4;$i++){
        if($i!=0)
            $q.=" , ";
        $q.='`'.$sst[$i].'`'."='".$row[$sstl[$i]]."' ";
    }
    $q.=" where `center`='".$row['center']."'";
    mysqli_query($con,$q); 
  }
  foreach ($contact as $row) { 
    $row=get_object_vars($row);
    $q="update t_".$cid." set ";
    for($i=0;$i<4;$i++){
        if($i!=0)
            $q.=" , ";
        $q.='`'.$cst[$i].'`'."='".$row[$cstl[$i]]."' ";
    }
    $q.=" where `center`='".$row['center']."'";
    mysqli_query($con,$q);

    
  }
echo "done";
?>