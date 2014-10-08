<?php
session_start();
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
else if(isset($_SESSION["ciddata"])){
    $cid=$_SESSION["ciddata"]; 
}
else
$cid=1;
$_SESSION['cid']=$cid;
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$path="data/".$cid."/";
$path_chk="../data/".$cid."/";
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
if( file_exists($path_chk."logo.png") )
{
	$logo =$path."logo.png";
}
else
{
	$logo =$default_path."logo.png";
}
$return='
        <div style="padding-top:50px" class="container" id="total-editable">
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/redit.min.css" rel="stylesheet">
        <link href="fonts/googleapi.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animation.css">
        <!-- TO be Removed -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css"/>
        <link rel="stylesheet" href="css/blueimp_gallery.min.css">
        <link rel="stylesheet" href="css/jquery.fileupload.css">
        <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
        <noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
        <noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
        <link href="css/college-profile.css" rel="stylesheet">';
    $return.=' <div class="container college-head ">
    <form enctype="multipart/form-data" id="logo-up">
    <input type="hidden" value="'.$cid.'" id="cid">
    <div class="col-sm-2" style="position:relative">
    <input type="file" id="logo-uploader" name="logo" style="display:none;position:absolute;right:0px;top:0px">
    <p id="edit-logo-text" style="display:none;background-color:rgba(0,0,0,0.7);position:absolute;left:25%;top:20%;color:white;padding:5px;">click to edit</p>
    <img src="'.$logo.'" id="college-logo"></div>
    </form>
    <h1 id="college-name" name="college-name">'.mysqli_fetch_array(mysqli_query($con,'select * from college_id where cid='.$cid))['name'].'</h1></div>';
    $return=$return.' <ul id="college-nav-tabs" class="nav nav-tabs"><li class="active"><a href="#college-nav-about" data-toggle="tab"><strong>About</strong></a></li><li><a href="#college-nav-admission" data-toggle="tab"><strong>Admission</strong></a></li><li><a href="#college-nav-academics" data-toggle="tab"><strong>Academics</strong></a></li><li>
            <a href="#college-nav-fees" data-toggle="tab"><strong>Fees</strong></a></li><li><a href="#college-nav-placements" data-toggle="tab"><strong>Placements</strong></a></li><li><a href="#college-nav-sports" data-toggle="tab"><strong>Sports and Facilities</strong></a></li><li><a href="#college-nav-contacts" data-toggle="tab"><strong>Contacts</strong></a></li></ul><div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="college-nav-about"><div class="college-gallery college-div"><div id="carousel-gallery" class="carousel slide" data-ride="carousel">';
    $return .= '<h2><br> Uploading Carousel..<br></h2></div></div><div class="col-md-12 college-gallery"><br> <br></div> <div class="col-sm-6">
                    <button class="btn btn-primary" id="img-edit-btn" style="width:60% ; margin-bottom:2%;  margin-left:20% ">Edit Gallery</button>
                </div>
               <div class="col-sm-6">
                    <button class="btn btn-primary" id="img-caption-edit-btn" style="width:60% ; margin-left:20%; margin-bottom:2%;">Edit Images Caption</button>
                </div>
                <br>
                <br>
                <div class="img-edit">
                    <form id="fileupload" method="POST" enctype="multipart/form-data">
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Add files...</span>
                                <input type="file" name="files[]" multiple>
                                </span>
                                <button type="submit" class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start upload</span>
                                </button>
                                <button type="reset" class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel upload</span>
                                </button>
                                <button type="button" class="btn btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                </button>
                                <input type="checkbox" class="toggle">
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>
                            <!-- The global progress state -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table ">
                            <tbody class="files"></tbody>
                        </table>
                    </form>
                </div>
                <div class="img-caption-edit">
                    <form id="img-cp-edit">
                    </form>
                </div>
                <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev"><i class="fa fa-arrow-circle-left" style="font-size: 40px;"></i></a>
                    <a class="next"><i class="fa fa-arrow-circle-right" style="font-size: 40px;"></i></a>
                    <a class="close">&times;</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div><div class="college-content">';
   
    /* getting the college content about college and dean intro  */
    $college_about=fetch_data($path_chk."about/about_college.txt");
        $return.='<div class="section-sub-heading">About College</div>
        <div class="edit-button" id="about-college-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
        <div id="about-college" name="aboutcollege" style="min-height:40px;">'.$college_about.'</div>';
    
    $dean_intro=fetch_data($path_chk."about/dean_intro.txt");
        $return.='<div class="section-sub-heading">Dean Introduction</div>
                <div class="edit-button" id="dean-intro-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="dean-intro" name="dean-intro" style="min-height:40px;">'.$dean_intro.'</div>';
    
     $rules=fetch_data($path_chk."about/rules.txt");
        $return.='<div class="section-sub-heading">Rules and Regulations</div>
                <div class="edit-button" id="rules-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="rules" name="rules" style="min-height:40px;">'.$rules.'</div>';

     $related_contacts=fetch_data($path_chk."about/related_contacts.txt");
        $return.='<div class="section-sub-heading">Related Contacts</div>
                <div class="edit-button" id="about-contacts-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="about-contacts" name="about-contacts" style="min-height:40px;">'.$related_contacts.'</div>';

$return .='</div></div>';
echo $return ;

/* THE PAGE FOR GALLERY ABOUT AND ALL CREATED  NOW ADMISSION*/
$availtypes=mysqli_query($con,'select type from college_entrance_test where cid = '.$cid);
$return='<div class="tab-pane fade" id="college-nav-admission"><div class="container college-div college-admission"><div class="college-content">';
while($type=mysqli_fetch_assoc($availtypes))
{
    $type= $type['type'];
    $college_exams=mysqli_query($con,'select gen,sc,st,obc,state,rg_obc,rg_sc,rg_st from college_entrance_test where cid='.$cid.'&& type="'.$type.'"');
    $exam=array('gen','obc','sc','st','state','rg_obc','rg_sc','rg_st');
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
    $query.=" from t".$cid." where program = '".$type."' && (gen!=0 || sc!=0 || state!=0 || obc!=0 || st!=0 || rg_obc!=0 || rg_sc!=0 || rg_st!=0 )";
    $closingrank=mysqli_query($con1,$query);
        $eid=mysqli_fetch_assoc(mysqli_query($con,'select name from college_entrance_test where cid='.$cid.' && type = "'.$type.'"'))['name'];
        $return.="<div class='section-sub-heading'>Closing Ranks (".ucfirst($type).")</div><div class='section-sub-heading' style='text-shadow: 0 0px 0px;font-size: 1.5em;padding-left: 5%; margin-top:-2%;'> Exam : ".mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name']." </div>";
        $return.='<br><div class="edit-button" id="'.$type.'-closing-rank-table-edit-btn" onclick="editTable(\''.$type.'-closing-rank-table\', \''.$type.'-closing-rank-table-edit-btn\', \''.$type.'-closing-rank-editable\', \''.$type.'-closing-rank-table-editable\', [\'Depatment\',\'General\', \'OBC\',\'SC\',\'ST\',\'Region/Gen\',\'Region/OBC\',\'Region/SC\',\'Region/ST\'],1,0)">
                            <span class="glyphicon glyphicon-pencil"></span> edit table
                    </div>
                    <div id="'.$type.'-closing-rank-editable" style="display:none">
                        <div class="table-responsive"><table class="table table-bordered mytable" id="'.$type.'-closing-rank-table-editable">

                        </table></div>
                        <button class="btn btn-primary btn-save"  id="'.$type.'-closing-rank-table-save-btn" onclick=" saveTable(\''.$type.'-closing-rank-table\', \''.$type.'-closing-rank-table-edit-btn\', \''.$type.'-closing-rank-editable\', \''.$type.'-closing-rank-table-editable\',1,0);">SAVE</button>
                        <button class="btn btn-danger btn-save" id="'.$type.'-closing-rank-table-cancel-btn" onclick=" cancelTable(\''.$type.'-closing-rank-table\', \''.$type.'-closing-rank-table-edit-btn\', \''.$type.'-closing-rank-editable\', \''.$type.'-closing-rank-table-editable\',1,0);">CANCEL</button>
                    </div>
        <div class="table-responsive"><table id="'.$type.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
        $return.="<tr> <td>Sl. No.</td><td>Depatment</td>";
        for ($i=0; $i <sizeof($exam) ; $i++) {
            if($examname[$i]!="")
            {
                $return.="<td>".ucfirst($examname[$i])."</td>";
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
         $return.="</table></div>";
}
    $eligibility=fetch_data($path_chk."admissions/eligibility.txt");
        $return.='<div class="section-sub-heading">Eligibiltiy Criteria</div>
                <div class="edit-button" id="adm-eligibility-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="adm-eligibility" name="adm-eligibility" style="min-height:40px;">'.$eligibility.'</div>';
    
    $adm_info=fetch_data($path_chk."admissions/admission_info.txt");
        $return.='<div class="section-sub-heading">Admission Info..</div>
                <div class="edit-button" id="adm-info-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="adm-info" name="adm-info" style="min-height:40px;">'.$adm_info.'</div>';
    
    $adm_misc=fetch_data($path_chk."admissions/misc.txt");;
         $return.='<div class="section-sub-heading">Miscellanous</div>
                <div class="edit-button" id="adm-misc-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="adm-misc" name="adm-misc" style="min-height:40px;">'.$adm_misc.'</div>';

    $return.='</div></div></div>';
echo $return;

/* THE PAGE FOR GALLERY ABOUT AND ALL CREATED  NOW ADMISSION*/
  $return='<div class="tab-pane fade college-content" id="college-nav-academics">';
   $acad_info=fetch_data($path_chk."academics/acad_info.txt");
   $return.='<div class="section-sub-heading">Academic Information</div>
                <div class="edit-button" id="acad-info-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="acad-info" name="acad-info" style="min-height:40px;">'.$acad_info.'</div>';
    
    $acad_facility=fetch_data($path_chk."academics/facilities.txt");
    $return.='<div class="section-sub-heading">Academic Facilities</div>
                <div class="edit-button" id="acad-facility-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="acad-facility" name="acad-facility" style="min-height:40px;">'.$acad_facility.'</div>';
     
     $acad_courses=fetch_data($path_chk."academics/list_of_courses.txt");
     $return.='<div class="section-sub-heading">List of Courses</div>
                <div class="edit-button" id="acad-courses-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="acad-courses" name="acad-courses" style="min-height:40px;">'.$acad_courses.'</div>';
     
     $acad_misc=fetch_data($path_chk."academics/misc.txt");
        $return.='<div class="section-sub-heading">Miscellanous</div>
                <div class="edit-button" id="acad-misc-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="acad-misc" name="acad-misc" style="min-height:40px;">'.$acad_misc.'</div>';
       
$return.="</div>";
echo $return;
/*This Page is created for Acads now FEES */
$return='<div class="tab-pane fade college-content" id="college-nav-fees">';
$fee=mysqli_query($con1,"select course,category,tut_fee,misc_fee,mnh_fee,tot from fee_t".$cid);
$return.="<div class='section-sub-heading'>Fee per Semester</div><br><div class='edit-button' id='fee-table-edit-btn'>
                        <span class='glyphicon glyphicon-pencil'></span> edit table
                </div>
                <div id='fee-editable' style='display:none'>
                    <table class='table table-bordered mytable' id='fee-table-editable'>

                    </table>
                    <button class='btn btn-primary btn-save'  id='fee-table-save-btn'>SAVE</button>
                    <button class='btn btn-danger btn-save' id='fee-table-cancel-btn'>CANCEL</button>
                </div>";
  $return.="<table id='fee-table' class='table table-bordered mytable'><tr><td>Course</td><td>Category</td><td>Tution Fee</td><td>Miscellanous fee</td><td>Mess and Hostel fee</td><td>Total</td></tr>";
  $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot'];
  while($row=mysqli_fetch_assoc($fee))
      {
           $return.='<tr>';
           for ($i=0; $i < 6; $i++) { 
             $return.='<td>'.(($i>1)&&($row[$fee_array[$i]]==0)?"-":ucfirst($row[$fee_array[$i]])).'</td>';
           }
           $return.='</tr>';
      }
      $return.="</table>";
    $fee_scholarships=fetch_data($path_chk."fees/scholarships.txt");
    $return.='<div class="section-sub-heading">Scholarships</div>
                <div class="edit-button" id="fee-scholarships-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="fee-scholarships" name="fee-scholarships" style="min-height:40px;">'.$fee_scholarships.'</div>';
       
    $fee_benefits=fetch_data($path_chk."fees/benefits.txt");
     $return.='<div class="section-sub-heading">Benefits</div>
                <div class="edit-button" id="fee-benefits-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="fee-benefits" name="fee-benefits" style="min-height:40px;">'.$fee_benefits.'</div>';
      
    $fee_caution=fetch_data($path_chk."fees/caution.txt");
     $return.='<div class="section-sub-heading">Caution Deposits</div>
                <div class="edit-button" id="fee-caution-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="fee-caution" name="fee-caution" style="min-height:40px;">'.$fee_caution.'</div>';
      
    $fee_misc=fetch_data($path_chk."fees/misc.txt");
     $return.='<div class="section-sub-heading">Miscellanous info</div>
                <div class="edit-button" id="fee-misc-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="fee-misc" name="fee-misc" style="min-height:40px;">'.$fee_misc.'</div>';

$return.="</div>";
echo $return;
/*This Page is created for EES now Placements */
$return='<div class="tab-pane fade college-content" id="college-nav-placements">';
$availtypes=mysqli_query($con,'select type from college_entrance_test where cid = '.$cid);
while($type=mysqli_fetch_assoc($availtypes))
{
    $type= $type['type'];
    $query="select department,total_intake,placed,min_package,max_package,avg_package from t".$cid." where (placed != 0 || min_package!=0 || max_package!=0 || avg_package!=0) && program='".$type."'";
    $package=mysqli_query($con1,$query);
        $return.="<div class='section-sub-heading'>Placement Record (".ucfirst($type).")</div>
            <div class='edit-button' id='".$type."-placement-table-edit-btn' onclick=\"editTable('".$type."-placement-table', '".$type."-placement-table-edit-btn', '".$type."-placement-editable', '".$type."-placement-table-editable', ['Depatment','Total Intake','Placed','Min Package','Max Package','Average Package'],1,0);\">
            <span class='glyphicon glyphicon-pencil'></span> edit table
                    </div>
                    <div id='".$type."-placement-editable' style='display:none'>
                        <table class='table table-bordered mytable' id='".$type."-placement-table-editable'>

                        </table>
                        <button class='btn btn-primary btn-save'  id='".$type."-placement-table-save-btn' onclick=\" saveTable('".$type."-placement-table', '".$type."-placement-table-edit-btn', '".$type."-placement-editable', '".$type."-placement-table-editable',1,0);\">SAVE</button>
                        <button class='btn btn-danger btn-save' id='".$type."-placement-table-cancel-btn' onclick=\" cancelTable('".$type."-placement-table', '".$type."-placement-table-edit-btn', '".$type."-placement-editable', '".$type."-placement-table-editable',1,0);\">CANCEL</button>
                    </div>
        <table class='table table-bordered mytable' id='".$type."-placement-table'>";
        $return.="<tr> <td>Sl. No.</td><td>Depatment</td><td>Total Intake</td><td>Placed</td><td>Min Package</td><td>Max Package</td><td>Average Package</td></tr>";
        $rc=1;
        while($row=mysqli_fetch_assoc($package))
        {
            $return.="<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$row['total_intake']."</td><td>".$row['placed']."</td><td>".$row['min_package'];
            $return.="</td><td>".$row['max_package']."</td><td>".$row['avg_package'].'</td></tr>';
            $rc+=1;
        }
        $return.="</table>";
}
$placement_info=fetch_data($path_chk."placements/placement_info.txt");
$return.='<div class="section-sub-heading">Placement  Information</div>
                <div class="edit-button" id="placement-info-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="placement-info" name="placement-info" style="min-height:40px;">'.$placement_info.'</div>';

$placement_contact=fetch_data($path_chk."placements/contacts.txt");
        $return.='<div class="section-sub-heading">Contacts for Placement</div>
                <div class="edit-button" id="placement-contact-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="placement-contact" name="placement-contact" style="min-height:40px;">'.$placement_contact.'</div>';

$return.="</div>";
echo $return;
/*This Page is created for Placements now Sports and Facilities */
$return='<div class="tab-pane fade college-content" id="college-nav-sports">';
    $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
    $return.='<div class="section-sub-heading">Extra Cocurricular Activities</div>
                <div class="edit-button" id="extra-cocurricular-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="extra-cocurricular" name="extra-cocurricular" style="min-height:40px;">'.$cocurricular.'</div>';

    $sports=fetch_data($path_chk."facilities/sports.txt");
    $return.='<div class="section-sub-heading">Sports Facilities</div>
                <div class="edit-button" id="sports-facilities-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="sports-facilities" name="sports-facilities" style="min-height:40px;">'.$sports.'</div>';
      
    $hostel=fetch_data($path_chk."facilities/mess_and_hostel_facilities.txt");
       $return.='<div class="section-sub-heading">Hostel and Mess Facilities</div>
                <div class="edit-button" id="hostel-facilities-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="hostel-facilities" name="hostel-facilities" style="min-height:40px;">'.$hostel.'</div>';
     
     
$return.="</div>";
echo $return;
/*This Page is created for Sports and facilities now Contacts */
$return='<div class="tab-pane fade college-content" id="college-nav-contacts">';
$contact_info=fetch_data($path_chk."contact/contacts.txt");
$return.='<div class="section-sub-heading">Contact Info</div>
                <div class="edit-button" id="contact-info-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span> edit
                </div><div id="contact-info" name="contact-info" style="min-height:40px;">'.$contact_info.'</div>';

$return.='<div id="socials">
                                <div><a target="_blank" id="weblinka" href="#" title="Web Page"><i class="fa fa-desktop fa-2x" ></i></a></div>
                                <div><a target="_blank" id="fblinka" href="#" title="Facebook Page of College"><i class="fa fa-facebook fa-2x" ></i></a></div>
                                <div><a target="_blank" id="twitterlinka" href="#" title="Twitter link"><i class="fa fa-twitter fa-2x" ></i></a></div>
                                <div><a target="_blank" id="pluslinka" href="#" title="Google Plus profile"><i class="fa fa-google-plus fa-2x" ></i></a></div>
                                <div><a target="_blank" id="linkedlinka" href="#" title="Linked In"><i class="fa fa-linkedin fa-2x" ></i></a></div>
                                <div><button id="link-edit-btn" title="Edit these links" class="btn btn-primary" style="margin-bottom:10px" data-toggle="modal" data-target="#link-edit"><i class="fa fa-edit fa-lg" ></i></button></div>
                            </div>
<div class="modal fade" id="link-edit" tabindex="-1" role="form" aria-hidden="true"> <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Configure Social Links</h4>
      </div>
      <div class="modal-body">
      <form id="link-table" role="form" method="post">
        <table class="table">
        <thead><th>Social Profile</th><th>Link</th></thead>
        <tr><td><i class="fa fa-desktop"></i> Web Page</td><td><input id="weblink" name="weblink" type="url" class="form-control" placeholder="Link to College Web Site" style="width:100%"></td></tr>
        <tr style="color: rgb(19, 55, 131);"><td><i class="fa fa-facebook"></i> Facebook</td><td><input id="fblink" name="fblink" class="form-control" type="url" placeholder="Link to FB Page" style="width:100%"></td></tr>
        <tr style="color:rgb(8, 80, 158)"><td><i class="fa fa-twitter"></i> Twitter</td><td><input id="twitterlink" name="twitterlink" type="url" class="form-control" placeholder="Link to Twitter Profile" style="width:100%"></td></tr>
        <tr style="color:rgb(197, 55, 39)"><td><i class="fa fa-google-plus"></i> Google Plus</td><td><input id="pluslink" name="pluslink" type="url" class="form-control" placeholder="Link to Google Plus" style="width:100%"></td></tr>
        <tr style="color:rgb(60, 140, 198)"><td><i class="fa fa-linkedin"></i> Linked In</td><td><input id="linkedlink" name="linkedlink" type="url" class="form-control" placeholder="Link to LinkedIn Profile" style="width:100%"></td></tr>
        </table></form>
        <div id="link-save-notify" style="visibility:hidden">Saved..</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="link-submit" type="submit">Save changes</button>
      </div></div></div></div>
                            ';

$return.="</div></div><hr style='border:1px solid #cb4437;;'><button class='btn btn-success col-md-4 col-offset-4' onclick='savecollegedata()' id='college-save-btn' style='margin-left:33%;margin-right:33%;margin-bottom:1%;'>Save the college Data</button></div>";
echo $return;
/*This Page is created for Contact Page creation ends */
echo fetch_data("js/xml.txt");
echo ' <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/redit.js"></script>
        <script type="text/javascript" src="js/table-editor.js"></script>
        <script src="js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/edit-page.js"></script>
            <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
            <script src="js/vendor/jquery.ui.widget.js"></script>
            <!-- The Templates plugin is included to render the upload/download listings -->
            <script src="js/uploader/tmpl.min.js"></script>
            <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
            <script src="js/uploader/load-image.min.js"></script>
            <!-- The Canvas to Blob plugin is included for image resizing functionality -->
            <script src="js/uploader/canvas-to-blob.min.js"></script>
            <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
            <script src="js/uploader/jquery.blueimp-gallery.min.js"></script>
            <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
            <script src="js/jquery.iframe-transport.js"></script>
            <!-- The basic File Upload plugin -->
            <script src="js/jquery.fileupload.js"></script>
            <!-- The File Upload processing plugin -->
            <script src="js/jquery.fileupload-process.js"></script>
            <!-- The File Upload image preview & resize plugin -->
            <script src="js/jquery.fileupload-image.js"></script>
            <!-- The File Upload audio preview plugin -->
            <script src="js/jquery.fileupload-audio.js"></script>
            <!-- The File Upload video preview plugin -->
            <script src="js/jquery.fileupload-video.js"></script>
            <!-- The File Upload validation plugin -->
            <script src="js/jquery.fileupload-validate.js"></script>
            <!-- The File Upload user interface plugin -->
            <script src="js/jquery.fileupload-ui.js"></script>
            <!-- The main application script -->
            <script src="js/main.js"></script>
            <script type="text/javascript">
                function refresh_gallery()
                {
                    jQuery.ajax(
                        {
                            url: "php/get-image-gallery.php?cid='.$cid.'",
                            type:"GET",
                            success: function(data)
                            {
                               // window.alert(data);
                                $("#carousel-gallery").html(data);
                                $(".carousel").carousel();
                            }
                        })
                }
                function put_caption()
                {
                    jQuery.ajax({
                        url: "php/put-image-caption.php?cid='.$cid.'",
                        type:"POST",
                        data:$("#img-cp-edit").serialize(),
                        success:function(data)
                        {
                            refresh_gallery();
                        },
                        error:function(data)
                        {
                            alert("Server failed to upload Captions..");
                        }
                    })
                }
                function savecollegedata()
                {
                   var r=confirm("Have You viewed the page .. And are you sure to save the content ?");
                   if(!r)
                    return;
                        $.post("php/save-college-data.php?cid='.$cid.'",{

                            about_college:$("#about-college").html(),
                            dean_intro:$("#dean-intro").html(),
                            about_rules:$("#rules").html(),
                            about_contacts:$("#about-contacts").html(),
                            adm_eligibility:$("#adm-eligibility").html(),
                            adm_info:$("#adm-info").html(),
                            adm_misc:$("#adm-misc").html(),
                            acad_info:$("#acad-info").html(),
                            acad_facility:$("#acad-facility").html(),
                            acad_courses:$("#acad-courses").html(),
                            acad_misc:$("#acad-misc").html(),
                            fee_scholarships:$("#fee-scholarships").html(),
                            fee_caution:$("#fee-caution").html(),
                            fee_benefits:$("#fee-benefits").html(),
                            fee_misc:$("#fee-misc").html(),
                            placement_info:$("#placement-info").html(),
                            placement_contact:$("#placement-contact").html(),
                            extra_cocurricular:$("#extra-cocurricular").html(),
                            sports_facilities:$("#sports-facilities").html(),
                            hostel_facilities:$("#hostel-facilities").html(),
                            contacts:$("#contact-info").html(),';
                            $availtypes=mysqli_query($con,'select type from college_entrance_test where cid = '.$cid);
                            while($type=mysqli_fetch_assoc($availtypes))
                            {
                                $type= $type['type'];
                                echo $type.'_closing_rank_table:$("#'.$type.'-closing-rank-table").html(),';
                                echo $type.'_placement_table:$("#'.$type.'-placement-table").html(),';
                            }
                            echo 'fee_table:$("#fee-table").html(),
                        })
                        .done(function(data) {
                            alert(data);
                          })
                          .fail(function(data) {
                            alert( data );
                          })
                }
                function get_caption()
                {
                    jQuery.ajax({
                        url: "php/get-image-caption.php?cid='.$cid.'",
                        type:"GET",
                        success:function(data)
                        {
                            $(".img-caption-edit").html(data);
                        },
                        error:function(data)
                        {
                            $(".img-caption-edit").html("Server error<br>Failed to fetch the image captions...");
                        }
                    })
                }
                $("#link-submit").on("click",function(e){
                     jQuery.ajax({
                        url: "php/link-submit.php?cid='.$cid.'",
                        type:"POST",
                        data:$("#link-table").serialize(),
                        success:function(data)
                        {
                            refresh_links('.$cid.');
                            $("#link-save-notify").css("visibility","visible");
                            $("#link-save-notify").addClass("fadeOut");
                           setTimeout(function(){
                                $("#link-save-notify").removeClass("fadeOut");
                                $("#link-save-notify").css("visibility","hidden");
                            },2500)
                           
                        },
                        error:function(data)
                        {
                            alert(data);
                        }
                    });
                })
                refresh_links('.$cid.');
                refresh_gallery();
                $(window).keypress(function(event) {
                    if (!(event.which == 115 && event.ctrlKey) && !(event.which == 19)) return true;
                    alert("Ctrl-S pressed");
                    event.preventDefault();
                    return false;
                });
            </script>';

?>