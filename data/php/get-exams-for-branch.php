<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
if(!isset($_GET['branch']))
 die('["--Select College--"]');
$a="[";
 $exam_names=mysqli_query($con,"select * from exam where type = '".$_GET['branch']."' || type='wild'");
 $i=0;
    while($row1=mysqli_fetch_assoc($exam_names))
    {
    	if($i>0)
    		$a.=",";
      $a.='["'.$row1['name'].'",'.$row1['eid'].']';
      $i+=1;
    }
    $a.="]";
    echo $a;
?>