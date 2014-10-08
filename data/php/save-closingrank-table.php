<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
die("Error : College not set");
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$catQuery=mysqli_query($con,"select * from category");
$categories=[];
$i=0;
while($row=mysqli_fetch_assoc($catQuery))
{
  $a=['id'=>$row['id'],'name'=>$row['name']];
  $categories[$i]=$a;
  $i+=1;
}
$name=$_POST["name"];
$eid=$_POST["name"];
$type=$_POST["type"];
   $closing_year=$_POST['closing_year'];
   if($closing_year=="")
    $closing_year=0;
  
  mysqli_query($con1,"delete from t".$cid." where program='".$type."' && name=".$name." && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0)) ");
  // YEARS SAVED
    $closing_rank=json_decode($_POST["closing_rank_tab"]);
  $c=0;
  $college_exams=mysqli_query($con,'select * from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
  $exam=[];
  $iter=0;
  foreach ($categories as $key) {
    $exam[$iter]=$key['id'];
    $iter+=1;
  }
  $availexam=array();
  while($row=mysqli_fetch_assoc($college_exams))
      {
          for ($i=0; $i < sizeof($exam); $i++) { 
              if($row[$exam[$i]]!=0)
              {
                array_push($availexam, $exam[$i]);
              }
      }
    }
  foreach ($closing_rank as $row) { 
    $row=get_object_vars($row);
      //Loop through each child (cell) of the row 
      $i=0;
        $in=array();
  	    foreach ($row as $cell) { 
  	    	if($i!=0)
          {
  	    		$t=$cell;
            if($t=="-"||$t==""||$t=="NULL")
              $t=0;
            array_push($in,$t);
          }
  	     $i+=1;
  	    }
       $q1=mysqli_query($con1,"select * FROM t".$cid." WHERE department='".$in[0]."' && program='".$type."' &&name=".$eid );
       if(mysqli_num_rows($q1)>=1)
       {
          $query="update t".$cid." set intake=".$in[1].",";
          for ($i=0; $i <sizeof($availexam) ; $i++) { 
            if($i!=0)
              $query.=",";
            $query.=$availexam[$i]." = " .$in[$i+2];
          }
           if($in[0]!==0)
          mysqli_query($con1,$query." where department='".$in[0]."' && program='".$type."' && name=".$eid);
       }
       else
       {
           $query="insert into t".$cid." (department,program,intake,name";
           for ($i=0; $i <sizeof($availexam) ; $i++) 
            $query.=",".$availexam[$i];
          $query.=") values ('".$in[0]."','".$type."',".$in[1].",".$eid;
          for ($i=0; $i <sizeof($availexam) ; $i++) { 
              $query.=",".$in[$i+2];
          }
          $query.=")";
          if($in[0]!==0)
          mysqli_query($con1,$query);
       }
  }
  echo "Table for ".$type." saved\n";
  echo "If you are reading this.. we are hiring you :P";
?>