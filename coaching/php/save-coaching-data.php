<?php
session_start();
if(isset($_SESSION['coachingid']))
    {
        $cid=$_SESSION['coachingid'];
    }
    else
    {
        die("error");
    }
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","coaching") or die(mysql_error());
$save=['name','mainselection','main10','main100','main500','main1000','main2000','advselection','adv10','adv100','adv500','adv1000','adv2000','result_year'];
$q="update coaching set ";
$i=0;
foreach ($save as $key) {
  if($i>0)
    $q.= ", ";
  $i=1;
  $q.="`".$key."`='".mysqli_real_escape_string($con,$_POST[$key])."'";
}
$q.=" where `id`='".$cid."'";
mysqli_query($con,$q);
echo $q;
?>