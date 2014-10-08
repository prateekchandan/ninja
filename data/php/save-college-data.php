<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
die("Error : College not set");
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
mysqli_query($con,"update college_id set latitude=".$_POST['latitude'].",longitude=".$_POST['longitude']." where cid=".$cid);
$path="/data/".$cid."/";
$path_chk="../data/".$cid."/";
$college_name=mysqli_real_escape_string($con,$_POST['college_name']);
$college_area=mysqli_real_escape_string($con,$_POST['college_area']);
$college_state=mysqli_real_escape_string($con,$_POST['college_state']);
$college_city=mysqli_real_escape_string($con,$_POST['college_city']);
$college_university=mysqli_real_escape_string($con,$_POST['college_university']);
$college_type=mysqli_real_escape_string($con,$_POST['college_type']);
$alias1=mysqli_real_escape_string($con,$_POST['alias1']);
$alias2=mysqli_real_escape_string($con,$_POST['alias2']);
$alias3=mysqli_real_escape_string($con,$_POST['alias3']);
$alias4=mysqli_real_escape_string($con,$_POST['alias4']);
$alias5=mysqli_real_escape_string($con,$_POST['alias5']);
$alias6=mysqli_real_escape_string($con,$_POST['alias6']);
$alias7=mysqli_real_escape_string($con,$_POST['alias7']);
$alias8=mysqli_real_escape_string($con,$_POST['alias8']);

$contact_name=mysqli_real_escape_string($con,$_POST['contact_name']);
$contact_email1=mysqli_real_escape_string($con,$_POST['contact_email1']);
$contact_email2=mysqli_real_escape_string($con,$_POST['contact_email2']);
$contact_phone1=mysqli_real_escape_string($con,$_POST['contact_phone1']);
$contact_phone2=mysqli_real_escape_string($con,$_POST['contact_phone2']);
$contact_address=mysqli_real_escape_string($con,$_POST['contact_address']);

$typeofFee=$_POST['typeofFee'];
$fee_type=0;
if($typeofFee=="Annum")
  $fee_type=1;
if($_POST['management_input']!=""&&$_POST['management']=="true")
  $_POST['management']=$_POST['management_input'];
if($_POST['management']=="true")
  $_POST['management']=0.01;
if($_POST['outside_state_input']!=""&&$_POST['outside_state']=="true")
  $_POST['outside_state']=$_POST['outside_state_input'];
if($_POST['outside_state']=="true")
  $_POST['outside_state']=0.01;
if($_POST['within_state_input']!=""&&$_POST['within_state']=="true")
  $_POST['within_state']=$_POST['management_input'];
if($_POST['within_state']=="true")
  $_POST['within_state']=0.01;
if($_POST['category_input']!=""&&$_POST['category']=="true")
  $_POST['category']=$_POST['category_input'];
if($_POST['category']=="true")
  $_POST['category']=0.01;
$checks=['boys_hostel','girls_hostel','internet','library','computer_lab','gym','sports_ground','transport','scholarship','gross_fees','management','outside_state','within_state','category'];
$q=" ";
foreach ($checks as $key) {
    $q.=" , ";
  if($_POST[$key]=="true")
  {
    $q.=$key."=1";
  }
  else if($_POST[$key]=="false")
  {
    $q.=$key."=0";
  }
  else if($_POST[$key]!="")
    $q.=$key."=".$_POST[$key];
  else 
    $q.=$key."='0'";
}

mysqli_query($con,"update college_id set type ='".$college_type."' ".$q." ,name ='".$college_name."' ,connectivity=".$_POST['connectivity']." ,area ='".$college_area."',city ='".$college_city."' ,state ='".$college_state."',university ='".$college_university."'  , fee_type=".$fee_type." where cid = ".$cid);
mysqli_query($con,"update college_id set alias1='".$alias1."' ,alias2='".$alias2."' ,alias3='".$alias3."' ,alias4='".$alias4."' ,alias5='".$alias5."' ,alias6='".$alias6."' ,alias7='".$alias7."' ,alias8='".$alias8."'   where cid = ".$cid);
mysqli_query($con,"update college_id set contact_name='".$contact_name."' ,contact_email1='".$contact_email1."' ,contact_email2='".$contact_email2."' ,contact_phone1='".$contact_phone1."' ,contact_phone2='".$contact_phone2."' ,contact_address='".$contact_address."'   where cid = ".$cid);

if(isset($_POST['about_college'])){
  $file = fopen($path_chk."about/about_college.txt", "w");
            fwrite($file,$_POST['about_college']);
            fclose($file);
}
if(isset($_POST['dean_intro'])){
  $file = fopen($path_chk."about/dean_intro.txt", "w");
        fwrite($file,$_POST['dean_intro']);
        fclose($file);
}

if(isset($_POST['about_rules'])){
  $file = fopen($path_chk."about/rules.txt", "w");
fwrite($file,$_POST['about_rules']);
fclose($file);
}

 if(isset($_POST['adm_eligibility'])){
  $file = fopen($path_chk."admissions/eligibility.txt", "w");
fwrite($file,$_POST['adm_eligibility']);
fclose($file);
}

 if(isset($_POST['adm_info'])){
  $file = fopen($path_chk."admissions/admission_info.txt", "w");
fwrite($file,$_POST['adm_info']);
fclose($file);
}

 if(isset($_POST['adm_misc'])){
  $file = fopen($path_chk."admissions/misc.txt", "w");
fwrite($file,$_POST['adm_misc']);
fclose($file);
}

 if(isset($_POST['acad_info'])){
  $file = fopen($path_chk."academics/acad_info.txt", "w");
fwrite($file,$_POST['acad_info']);
fclose($file);
}

 if(isset($_POST['acad_facility'])){
  $file = fopen($path_chk."academics/facilities.txt", "w");
fwrite($file,$_POST['acad_facility']);
fclose($file);
}

 if(isset($_POST['acad_courses'])){
  $file = fopen($path_chk."academics/list_of_courses.txt", "w");
fwrite($file,$_POST['acad_courses']);
fclose($file);
}

 if(isset($_POST['acad_misc'])){
  $file = fopen($path_chk."academics/misc.txt", "w");
fwrite($file,$_POST['acad_misc']);
fclose($file);
}

 if(isset($_POST['fee_scholarships'])){
  $file = fopen($path_chk."fees/scholarships.txt", "w");
fwrite($file,$_POST['fee_scholarships']);
fclose($file);
}

 if(isset($_POST['fee_caution'])){
  $file = fopen($path_chk."fees/caution.txt", "w");
fwrite($file,$_POST['fee_caution']);
fclose($file);
}

 if(isset($_POST['fee_benefits'])){
  $file = fopen($path_chk."fees/benefits.txt", "w");
fwrite($file,$_POST['fee_benefits']);
fclose($file);
}

 if(isset($_POST['fee_misc'])){
  $file = fopen($path_chk."fees/misc.txt", "w");
fwrite($file,$_POST['fee_misc']);
fclose($file);
}

 if(isset($_POST['placement_info'])){
  $file = fopen($path_chk."placements/placement_info.txt", "w");
fwrite($file,$_POST['placement_info']);
fclose($file);
}

 if(isset($_POST['placement_contact'])){
  $file = fopen($path_chk."placements/contacts.txt", "w");
fwrite($file,$_POST['placement_contact']);
fclose($file);
}

 if(isset($_POST['extra_cocurricular'])){
  $file = fopen($path_chk."facilities/extra_cocurricular.txt", "w");
fwrite($file,$_POST['extra_cocurricular']);
fclose($file);
}

 if(isset($_POST['sports_facilities'])){
  $file = fopen($path_chk."facilities/sports.txt", "w");
fwrite($file,$_POST['sports_facilities']);
fclose($file);
}

 if(isset($_POST['hostel_facilities'])){
  $file = fopen($path_chk."facilities/mess_and_hostel_facilities.txt", "w");
fwrite($file,$_POST['hostel_facilities']);
fclose($file);
}
if(isset($_POST['misc_facilitites'])){
  $file = fopen($path_chk."facilities/misc_facilities.txt", "w");
fwrite($file,$_POST['misc_facilitites']);
fclose($file);
}
 if(isset($_POST['contacts'])){
  $file = fopen($path_chk."contact/contacts.txt", "w");
fwrite($file,$_POST['contacts']);
fclose($file);
}

$query=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
while($type=mysqli_fetch_assoc($query))
{
  $type=$type['type'];
  $placement2=json_decode($_POST[$type."_placement_tab1"]);
  $p=[];
  for ($i=0; $i < 4; $i++) { 
    $p0=get_object_vars($placement2[$i]);
    $p[$i]=mysqli_real_escape_string($con,$p0['noofstudentsplaced']);
  }
  mysqli_query($con1,"delete * from placement_t".$cid." where type='".$type."'");
  mysqli_query($con1,"insert into placement_t".$cid." (`type`,`c1`,`c2`,`c3`,`c4`) values ('".$type."','".$p[0]."','".$p[1]."' ,'".$p[2]."' ,'".$p[3]."')");
}
$availtypes=mysqli_query($con,'select type,name from college_entrance_test where cid = '.$cid);
while($type=mysqli_fetch_assoc($availtypes))
{
  $name=$type['name'];
   $type= $type['type'];
  // SAVING THE YEARS 
  // $eid=$_POST[$type.$name."_exam"];
  // $closing_year=$_POST[$type.$name.'_closing_year'];
  $placement_year=$_POST[$type.'_placement_year'];
  //if($closing_year=="")
   // $closing_year=0;
  if($placement_year=="")
    $placement_year=0;
  mysqli_query($con,"update college_entrance_test set placement_year=".$placement_year.' where cid='.$cid.'&& type="'.$type.'" &&name='.$name);
  // YEARS SAVED

  // nOW Saving the closing-rank data
    $placement=json_decode($_POST[$type."_placement_tab"]);
 /*   $closing_rank=json_decode($_POST[$type.$name."_closing_rank_tab"]);

  $c=0;
  $college_exams=mysqli_query($con,'select gen,sc,st,obc,state,rg_obc,rg_sc,rg_st from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
  $exam=array('gen','obc','sc','st','state','rg_obc','rg_sc','rg_st');
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
       $q1=mysqli_query($con1,"select * FROM t".$cid." WHERE department='".$in[0]."' && program='".$type."' &&name=".$name );
       if(mysqli_num_rows($q1)>=1)
       {
          $query="update t".$cid." set intake=".$in[1].",";
          for ($i=0; $i <sizeof($availexam) ; $i++) { 
            if($i!=0)
              $query.=",";
            $query.=$availexam[$i]." = " .$in[$i+2];
          }
           if($in[0]!==0)
          mysqli_query($con1,$query." where department='".$in[0]."' && program='".$type."' && name=".$name);
       }
       else
       {
           $query="insert into t".$cid." (department,program,intake,name";
           for ($i=0; $i <sizeof($availexam) ; $i++) 
            $query.=",".$availexam[$i];
          $query.=") values ('".$in[0]."','".$type."',".$in[1].",".$name;
          for ($i=0; $i <sizeof($availexam) ; $i++) { 
              $query.=",".$in[$i+2];
          }
          $query.=")";
          if($in[0]!==0)
          mysqli_query($con1,$query);
       }
  }*/
  $c=0;
   foreach ($placement as $row) { 
    $row=get_object_vars($row);
      $i=0;
       $in=array();
       //Loop through each child (cell) of the row 
    foreach($row as $child)
    {
       if($i!=0)
          {
            $t=$child;
            if($t=="-"||$t=="")
              $t=0;
            array_push($in,$t);
          }
         $i+=1;
    }
     if($in[0]!==0){
           $q1=mysqli_query($con1,"select * FROM t".$cid." WHERE department='".$in[0]."' && program='".$type."'" );
           if(mysqli_num_rows($q1)>=1)
           {
              mysqli_query($con1,"update t".$cid." set total_intake='".$in[1]."', placed='".$in[2]."', min_package='".$in[3]."', max_package='".$in[4]."', avg_package='".$in[5]."' where department='".$in[0]."' && program='".$type."'");
           }
           else
           {
              mysqli_query($con1,"insert into t".$cid." (department,program,total_intake,placed,min_package,max_package,avg_package) values ('".$in[0]."','".$type."','".$in[1]."','".$in[2]."','".$in[3]."','".$in[4]."','".$in[5]."')");            
           }
       }
  }
}
mysqli_query($con1,"truncate fee_t".$cid);
$rows = json_decode($_POST["fee_table"]);
 foreach ($rows as $row) { 
  $row=get_object_vars($row);
    //Loop through each child (cell) of the row 
   if($row['course']!==""){
      $in=array();
      foreach ($row as $cell) { 
          $t=$cell;
          if($t=="-"||$t=="")
            $t=0;
          array_push($in,$t);
         // echo $t." # ";
      }
    mysqli_query($con1,"insert into fee_t".$cid." (course,category,tut_fee,misc_fee,mnh_fee,tot,refundable_fee) values ('".$in[0]."','".$in[1]."','".$in[2]."','".$in[3]."','".$in[4]."','".$in[5]."','".$in[6]."')");
  }
}
include("tag-dept.php");
echo "done";
?>