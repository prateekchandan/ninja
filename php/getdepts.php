<?php
 
  $con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
  $id=mysqli_real_escape_string($con1,$_POST['id']);
  $qstr='select * from t'.$id.' where (program = "be" || program ="btech" || program = "bsc" || program ="dd" || program like "ba%") && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0))  ';

  $q=mysqli_query($con1,$qstr);
  $dept=array();
  while($row=mysqli_fetch_assoc($q)){ 
    array_push($dept, $row['department']);
    
  }
  echo json_encode($dept);

?>