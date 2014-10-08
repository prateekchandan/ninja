<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$stq=array();
$state=array();
$exam=array();
$dept=array();
$possibledept=array('cse','it','elec','electronic','mech','chem','aero','civil','math','phy','cham','pharm');
       $exams=mysqli_query($con,"select * from allcourses");
        while($row=mysqli_fetch_assoc($exams))
        {
        	if(isset($_POST[$row['name']]))
        		array_push($stq, $_POST[$row['name']]);
        }

        $exams=mysqli_query($con,"select * from states");
              while($row=mysqli_fetch_assoc($exams))
              {
              	if(isset($_POST[$row['name']]))
        		array_push($state, $_POST[$row['name']]);
              }
         $exams=mysqli_query($con,"select * from exam");
              while($row=mysqli_fetch_assoc($exams))
              {
                if(isset($_POST[$row['eid']]))
        		array_push($exam, $_POST[$row['eid']]);
              }

          foreach ($possibledept as $key) {
          	if(isset($_POST[$key]))
        		array_push($dept, $_POST[$key]);
          }
        

$q="select Distinct `college_id`.* FROM  `college_id`,`college_entrance_test`,`college_department` WHERE ( false ";
$len=sizeof($stq);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_entrance_test.type=\"".$stq[$i]."\"";
}
$q.=") && ( false ";

$len=sizeof($state);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_id.state=\"".$state[$i]."\"";
}
$q.=") && ( false ";

$len=sizeof($exam);
for ($i=1; $i < $len; $i++) { 
	$q.=" || college_entrance_test.name=".$exam[$i];
}
$q.=") && ( false ";

$len=sizeof($dept);
for ($i=1; $i < $len; $i++) { 
	$q.=" || `college_department`.`".$dept[$i]."`=1";
}
$q.=") && college_id.cid=college_entrance_test.cid && college_id.cid=college_department.cid";
$query=mysqli_query($con,$q);
$res=[];
echo "[";
$falg=false;
$c=1;
while ($row=mysqli_fetch_assoc($query)) {
	if(file_exists("../data/data/".$row['cid']."/logo.png"))
		$row['imgsrc']="data/data/".$row['cid']."/logo.png";
	else
	$row['imgsrc']="data/img/icon.png";

	if($falg)
		echo ",";
	print_r(json_encode($row));
	$falg=true;
	$c+=1;
	if($c>100)
		break;
}
echo "]";
?>