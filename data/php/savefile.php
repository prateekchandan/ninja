<?php
session_start();
if(isset($_GET['cid']))
    {
        $cid=$_GET['cid'];
    }
    else
    {
        die("error");
    }
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());

$path="/data/".$cid."/";
$path_chk="../data/".$cid."/";
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
if(isset($_POST['misc_facilities'])){
  $file = fopen($path_chk."facilities/misc_facilities.txt", "w");
fwrite($file,$_POST['misc_facilities']);
fclose($file);
}
 if(isset($_POST['contact_info'])){
  $file = fopen($path_chk."contact/contacts.txt", "w");
fwrite($file,$_POST['contact_info']);
fclose($file);
}


echo "done";
?>