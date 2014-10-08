<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","coaching") or die(mysql_error());
session_start();

if(isset($_SESSION['coachingid'])) {
    $cid=$_SESSION['coachingid'];
}
else
die("error");

print_r($_POST);
$fee=json_decode($_POST['feetable']);

mysqli_query($con,"delete from fee_".$cid." where 1");

$fst=array('course','mode' ,'payment1', 'payment2', 'payment3', 'payment4', 'payment5','payment6','total');

foreach ($fee as $row) {    
    $row=get_object_vars($row);
    $q="insert into fee_".$cid." " ;
    $a="(";
    $b="(";
    for($i=0;$i<9;$i++){
        if($i!=0){
            $a.=" , ";
            $b.=" , ";
          }
       $a.="`".$fst[$i]."`";
       $b.="'".$row[$fst[$i]]."'";
    }
    $q.=$a.") values ".$b.")";
echo $q."\n";
    mysqli_query($con,$q);
  }
  

?>