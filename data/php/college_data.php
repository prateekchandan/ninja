<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
    if($cid>2)
        $cid=1;
}
    else
$cid=1;
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$path="data/".$cid."/";
$path_chk="data/".$cid."/";
$default_path="data/default/";

function fetch_data($path_to_file)
{
  $str="";
    if(file_exists($path_to_file))
    {
      $file = fopen($path_to_file, "r");
      while(!feof($file))
        {
         $str.=fgets($file);
        }
      fclose($file);
      $str=trim($str);
      return $str;
      }
    else
      return $str;
}

$return="";
if( file_exists($path_chk."images/logo.png") )
{
    $logo =$path."images/logo.png";
}
else
{
    $logo =$default_path."images/logo.png";
}
$return='<link href="css/bootstrap.min.css" rel="stylesheet" /><link href="css/college-profile.css" rel="stylesheet" /><link href="themes/1/js-image-slider.css" rel="stylesheet" type="text/css" /> <script src="themes/1/js-image-slider.js" type="text/javascript"></script> <div class="container college-head college-div"><img src="'.$logo.'" id="college-logo"><h1 id="college-name" name="college-name">'.mysqli_fetch_array(mysqli_query($con,'select * from college_id where cid='.$cid))['name'].'</h1></div>';
$return=$return.' <ul id="college-nav-tabs" class="nav nav-tabs"><li class="active"><a href="#college-nav-about" data-toggle="tab"><strong>About</strong></a></li><li><a href="#college-nav-admission" data-toggle="tab"><strong>Admission</strong></a></li><li><a href="#college-nav-academics" data-toggle="tab"><strong>Academics</strong></a></li><li><a href="#college-nav-fees" data-toggle="tab"><strong>Fees</strong></a></li><li><a href="#college-nav-placements" data-toggle="tab"><strong>Placements</strong></a></li><li><a href="#college-nav-sports" data-toggle="tab"><strong>Sports and Facilities</strong></a></li><li><a href="#college-nav-contacts" data-toggle="tab"><strong>Contacts</strong></a></li></ul><div id="myTabContent" class="tab-content"><div class="tab-pane fade active in" id="college-nav-about"><div class="college-gallery college-div"><div id="sliderFrame" style="padding-top:10px"><div id="slider">';
     // Reading all images from directory 
    if ($handle = opendir($path_chk.'images')) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." &&$entry!="logo.png")
       {
        if(file_exists($path_chk."img-alt/".$entry.".txt"))
            {
                $file = fopen($path_chk."img-alt/".$entry.".txt", "r") or exit("Unable to open file!");
                $alt= fgets($file);
                fclose($file);
            }
            else
                $alt="";
            $filename=$path_chk."images/".$entry;
            $return.='<img src="'.$filename.'" alt="'.$alt.'">';
       }
    }


    closedir($handle);
    }
    $return .= ' </div></div></div><div class="col-md-12 college-gallery"><br> <br></div> <div class="college-content">';
   
    /* getting the college content about college and dean intro  */
    $true=0;
    $college_about=fetch_data($path_chk."about/about_college.txt");
    if($college_about!="<br>"&&$college_about!="")
    {
        $return.='<div class="section-sub-heading">About College</div>'.$college_about;
        $true=1;
    }
    $college_about=fetch_data($path_chk."about/dean_intro.txt");
    if($college_about!="<br>"&&$college_about!="")
    {
        $return.='<div class="section-sub-heading">What Dean Speaks..</div>'.$college_about;
        $true=1;
    }
    $college_about=fetch_data($path_chk."about/rules.txt");
    if($college_about!="<br>"&&$college_about!="")
    {
        $return.='<div class="section-sub-heading">Rules</div>'.$college_about;
        $true=1;
    }
    $college_about=fetch_data($path_chk."about/related_contacts.txt");
    if($college_about!="<br>"&&$college_about!="")
    {
        $return.='<div class="section-sub-heading">Contacts</div>'.$college_about;
        $true=1;
    }
    if($true==0)
    {
        $college_about=fetch_data($default_path."/about/noinfo.txt");
        $return.='<div class="section-sub-heading"></div>'.$college_about;
    }

$return .='</div></div>';
echo $return ;

/* THE PAGE FOR GALLERY ABOUT AND ALL CREATED  NOW ADMISSION*/

$return='<div class="tab-pane fade" id="college-nav-admission"><div class="container college-div college-admission"><div class="college-content">';

 $true=0;
$college_exams=mysqli_query($con,'select gen,sc,st,obc,state,rg_obc,rg_sc,rg_st from college_entrance_test where cid='.$cid);
$exam=array('gen','sc','st','obc','state','rg_obc','rg_sc','rg_st');
$exampr=array(0,0,0,0,0,0,0,0); 
$examname=array("General","OBC","SC","ST","Region/Gen","Region/OBC","Region/SC","Region/ST");
$query="select department,program";
while($row=mysqli_fetch_assoc($college_exams))
    {
        for ($i=0; $i < sizeof($exam); $i++) { 
            if($row[$exam[$i]]!=0)
            {
                $exampr[$i]=$row[$exam[$i]];
                $query.=",".$exam[$i];
            }
            else
               $examname[$i]="";
        }
    }
$query.=" from t".$cid." where (program = 'Btech' || program = 'btech' || program = 'B.tech') && (gen!=0 || sc!=0 || state!=0 || obc!=0 || st!=0 || rg_obc!=0 )";
$closingrank=mysqli_query($con1,$query);
if(mysqli_num_rows($closingrank)!=0)
{
    $eid=mysqli_fetch_assoc(mysqli_query($con,'select name from college_entrance_test where cid='.$cid))['name'];
    $return.="<div class='section-sub-heading'>Closing Ranks (Btech)</div><div class='section-sub-heading' style='text-shadow: 0 0px 0px;font-size: 1.5em;padding-left: 5%;'> Exam : ".mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name']." </div><table class='table table-bordered'>";
    $return.="<tr> <th>Sl. No.</th><th> Depatment </th>";
    for ($i=0; $i <sizeof($exam) ; $i++) {
        if($examname[$i]!="")
        {
            $return.="<th>".ucfirst($examname[$i])."</th>";
        }
    }
    $return.="</tr>";
    $rc=1;
    while($row=mysqli_fetch_assoc($closingrank))
    {
        $return.="<tr><td>".$rc."</td><td>".$row['department']."</td>";
        for ($i=0; $i <sizeof($exam) ; $i++) {
            if($examname[$i]!="")
            {
              if($row[$exam[$i]]!==0)
                $return.="<td>".$row[$exam[$i]]."</td>";
              else
                $return.="<td></td>";
            }
        }
        $return.='</tr>';
        $rc+=1;
    }
    $return.="</table>";
    $true=1;
  }
    $college_adm=fetch_data($path_chk."admissions/eligibility.txt");
    if($college_adm!="<br>"&&$college_adm!="")
    {
        $return.='<div class="section-sub-heading">Eligibiltiy Criteria</div>'.$college_adm;
        $true=1;
    }
    $college_adm=fetch_data($path_chk."admissions/admission_info.txt");
    if($college_adm!="<br>"&&$college_adm!="")
    {
        $return.='<div class="section-sub-heading">Admission Info</div>'.$college_adm;
        $true=1;
    }
    $college_adm=fetch_data($path_chk."admissions/misc.txt");;
    if($college_adm!="<br>"&&$college_adm!="")
    {
        $return.='<div class="section-sub-heading">Miscellanous</div>'.$college_adm;
        $true=1;
    }
  if($true==0)
    {
        $return.='<div class="section-sub-heading"></div>'."NO DATA";
    }
    $return.='</div></div></div>';
echo $return;

/* THE PAGE FOR GALLERY ABOUT AND ALL CREATED  NOW ADMISSION*/
  $return='<div class="tab-pane fade college-content" id="college-nav-academics">';
  $true=0;
  /*$program=mysqli_query($con1,"select distinct(program) from t".$cid);
  if(mysqli_num_rows($program)!=0)
  {
    $return.="<div class='section-sub-heading'>Programs</div><b>List of Programs in the college:</b><ul>";
    while($row=mysqli_fetch_assoc($program))
      {
        $return.="<li> ".ucfirst($row['program'])."</li>";
      }
      $return.="</ul>";
   }*/
   $college_acad=fetch_data($path_chk."academics/acad_info.txt");
    if($college_acad!="<br>"&&$college_acad!="")
    {
        $return.='<div class="section-sub-heading">Academic Information</div>'.$college_acad;
        $true=1;
    }
    $college_acad=fetch_data($path_chk."academics/facilities.txt");
    if($college_acad!="<br>"&&$college_acad!="")
    {
        $return.='<div class="section-sub-heading">Academic Facilities</div>'.$college_acad;
        $true=1;
    }
     $college_acad=fetch_data($path_chk."academics/list_of_courses.txt");
    if($college_acad!="<br>"&&$college_acad!="")
    {
        $return.='<div class="section-sub-heading">List of Courses</div>'.$college_acad;
        $true=1;
    }
     $college_acad=fetch_data($path_chk."academics/misc.txt");
    if($college_acad!="<br>"&&$college_acad!="")
    {
        $return.='<div class="section-sub-heading">Misc Academic Info</div>'.$college_acad;
        $true=1;
    }
     if($true==0)
    {
        $return.='<div class="section-sub-heading"></div>'."NO DATA";
    }
$return.="</div>";
echo $return;
/*This Page is created for Acads now FEES */
$return='<div class="tab-pane fade college-content" id="college-nav-fees">';
$true=0;
$fee=mysqli_query($con1,"select course,category,tut_fee,misc_fee,mnh_fee,tot from fee_t".$cid);
$return.="<div class='section-sub-heading'>Fee per Semester</div>";
if(mysqli_num_rows($fee)!=0)
{
  $return.="<table class='table table-bordered'><tr><th>Cource </th><th> Cateory </th><th> Tution Fee</th><th> Miscellanous fee</th><th>Mess and Hostel fee</th><th>Total</th></tr>";
  $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot'];
  while($row=mysqli_fetch_assoc($fee))
      {
           $return.='<tr>';
           for ($i=0; $i < 6; $i++) { 
             $return.='<td>'.(($i>1)&&($row[$fee_array[$i]]==0)?"-":$row[$fee_array[$i]]).'</td>';
           }
           $return.='</tr>';
      }
      $return.="</table>";
      $true=1;
    }
    $fee_data=fetch_data($path_chk."fees/scholarships.txt");
    if($fee_data!="<br>"&&$fee_data!="")
    {
        $return.='<div class="section-sub-heading">Scholarships</div>'.$fee_data;
        $true=1;
    }
    $fee_data=fetch_data($path_chk."fees/benefits.txt");
    if($fee_data!="<br>"&&$fee_data!="")
    {
        $return.='<div class="section-sub-heading">Benefits</div>'.$fee_data;
        $true=1;
    }
    $fee_data=fetch_data($path_chk."fees/caution.txt");
    if($fee_data!="<br>"&&$fee_data!="")
    {
        $return.='<div class="section-sub-heading">Caution Deposits</div>'.$fee_data;
        $true=1;
    }
    $fee_data=fetch_data($path_chk."fees/misc.txt");
    if($fee_data!="<br>"&&$fee_data!="")
    {
        $return.='<div class="section-sub-heading">Miscellanous info</div>'.$fee_data;
        $true=1;
    }
      if($true==0)
    {
        $return.='<div class="section-sub-heading"></div>'."NO DATA";
    }
$return.="</div>";
echo $return;
/*This Page is created for EES now Placements */
$return='<div class="tab-pane fade college-content" id="college-nav-placements">';
$true=0;
$query="select department,total_intake,placed,min_package,max_package,avg_package from t".$cid." where placed != 0 || min_package!=0 || max_package!=0 || avg_package!=0 ";
$package=mysqli_query($con1,$query);
if(mysqli_num_rows($package)!=0)
{
    $return.="<div class='section-sub-heading'>Placement Record (Btech)</div><table class='table table-bordered'>";
    $return.="<tr> <th>Sl. No.</th><th> Depatment </th><th> Total Intake </th><th> Placed </th><th> Min Package </th><th> Max Package </th><th> Average Package </th></tr>";
    $rc=1;
    while($row=mysqli_fetch_assoc($package))
    {
        $return.="<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$row['total_intake']."</td><td>".$row['placed']."</td><td>".$row['min_package'];
        $return.="</td><td>".$row['max_package']."</td><td>".$row['avg_package'].'</td></tr>';
        $rc+=1;
    }
    $return.="</table>";
    $true=1;
}
$placement_contact=fetch_data($path_chk."placements/placement_info.txt");
    if($placement_contact!="<br>"&&$placement_contact!="")
    {
        $return.='<div class="section-sub-heading">Placement  Information</div>'.$placement_contact;
        $true=1;
    }
$placement_contact=fetch_data($path_chk."placements/contacts.txt");
    if($placement_contact!="<br>"&&$placement_contact!="")
    {
        $return.='<div class="section-sub-heading">Contact for Placements</div>'.$placement_contact;
        $true=1;
    }
    if($true==0)
    {
        $return.='<div class="section-sub-heading"></div>'."NO DATA";
    }
$return.="</div>";
echo $return;
/*This Page is created for Placements now Sports and Facilities */
$true=0;
$return='<div class="tab-pane fade college-content" id="college-nav-sports">';
    $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
    if($cocurricular!="<br>"&&$cocurricular!="")
    {
        $return.='<div class="section-sub-heading">Extra Cocurricular Activities</div>'.$cocurricular;
        $true=1;
    }
    $hostel=fetch_data($path_chk."facilities/mess_and_hostel_facilities.txt");
    if($hostel!="<br>"&&$hostel!="")
    {
        $return.='<div class="section-sub-heading">Hostel Facilities and Mess</div>'.$hostel;
        $true=1;
    }
    $sports=fetch_data($path_chk."facilities/sports.txt");
    if($sports!="<br>"&&$sports!="")
    {
        $return.='<div class="section-sub-heading">Sports Facilities</div>'.$sports;
        $true=1;
    }
    if($true==0)
    {
        $return.='<div class="section-sub-heading"></div>'."NO DATA";
    }
$return.="</div>";
echo $return;
/*This Page is created for Sports and facilities now Contacts */
$return='<div class="tab-pane fade college-content" id="college-nav-contacts">';
$true=0;
$contact=fetch_data($path_chk."contact/contacts.txt");
    if($contact!="<br>"&&$contact!="")
    {
        $return.='<div class="section-sub-heading">Contact info</div>'.$contact;
        $true=1;
    }
    if($true==0)
    {
        $return.='<div class="no-info">NO DATA</div>';
    }
$return.="</div>";
echo $return;
/*This Page is created for Contact Page creation ends */
echo ' <script src="js/jquery.js"></script><script src="js/bootstrap.min.js"></script>';

?>