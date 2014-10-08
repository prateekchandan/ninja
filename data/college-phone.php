<?php
error_reporting(E_ALL | E_STRICT);
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
session_start();
 if(isset($_GET["cid"])){
        $cid=$_GET["cid"]; 
            $query=mysqli_query($con,"select cid from college_id where link='".$cid."'");
            if(mysqli_num_rows($query)<1||mysqli_num_rows($query)>1)
            header("Location:http://data.infermap.com");
            else
                $cid=mysqli_fetch_array($query)['cid'];
    }
    else if(isset($_GET["college"]))
    {
        $abc=$_GET["college"];
        $cid=$newstring = substr($abc, -20);
        $query=mysqli_query($con,"select cid from college_id where link='".$cid."'");
            if(mysqli_num_rows($query)<1||mysqli_num_rows($query)>1)
            header("Location:http://www.infermap.com");
            else
                $cid=mysqli_fetch_array($query)['cid'];
    }
    else{
        header("Location:http://www.infermap.com");
    }
$path="../data/data/".$cid."/";
$path_chk="../data/data/".$cid."/";
$default_path="../data/data/default/";
$mobile_browser = '0';
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
if( file_exists($path_chk."logo.png") )
{
  $logo =$path."logo.png";
}
else
{
  $logo ="img/icon.png";
}
$q=mysqli_query($con,'select * from college_id where cid='.$cid);
$row=mysqli_fetch_array($q);
$college_name=$row['name'];  
$fee_type=$row['fee_type'];  
$college_state=$row['state'];
if($college_state=='--Select State--')
$college_state="";
$college_city=$row['city'];
if($college_state!=""&&$college_city!="")
    $college_city.=" , ";
$college_area=$row['area'];
if(($college_state!=""||$college_city!="")&&$college_area!="")
    $college_area.=" , ";
$college_university=$row['university'];
$college_type=$row['type'];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $college_name;  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">
    <link href="../data/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../data/font-awesome/css/font-awesome.css"/>
    <link href="../data/fonts/googleapi.css" rel="stylesheet"/>
    <link rel="icon" href="../data/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../data/css/phone-view.css"/>
</head>
<body>
    <div href="#" id="brand-img">
          <a href="http://www.infermap.com">
            <img src="../img/logo-header.png">
          </a>
    </div>
    <ul class="top-bar">
      <li>
        <a href="../main.php">Search College</a>
      </li>
      <li>
        <a href="../compare.php">Compare Colleges</a>
      </li>
      <li>
        <a href="../guide.php">Plan My College</a>
      </li>
    </ul>
    <div class="second-bar">
      <form method="get" action="../main.php" id="search-form">
        <input type="hidden" name="search" value="keyword">
        <input type="text" name="value" id="keyword-value" placeholder="Type here to search college">
        <button class="searchbar-btn"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <div class="sidebar">
      <div class="marker" id="marker">
        <b><i class="fa fa-2x fa-bars"></i></b>
      </div>
      <ul class="sidebar-list">
        <li>
          <a href="#college-nav-about" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            ABOUT
          </a>
        </li>
        <li>
          <a href="#college-nav-academics" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            ACADEMICS
          </a>
        </li>
        <li>
          <a href="#college-nav-admission" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            ADMISSION
          </a>
        </li>
        <li>
          <a href="#college-nav-fees" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            FEES
          </a>
        </li>
        <li>
          <a href="#college-nav-facilities" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            FACILITIES
          </a>
        </li>
        <li>
          <a href="#college-nav-sports-activities" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            SPORTS AND ACTIVITIES
          </a>
        </li>
        <li>
          <a href="#college-nav-placements" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            PLACEMENTS
          </a>
        </li>
        <li>
          <a href="#college-nav-contacts" data-toggle="tab">            
            <div class="tab-selector">
            </div>
            CONTACTS
          </a>
        </li>
      </ul>
    </div>
    <div class="college-header">
      <div class="address">
        <h1 id="college-name">
          <?php echo $college_name;  
          ?>
        </h1>
        <div class="short-address">
                <?php  echo " ".$college_area.$college_city.$college_state;?>
        </div>
      </div>
      <div class="logo">
        <?php echo ' <img src="'.$logo.'" id="college-logo">'; ?>
      </div>
    </div>
    <hr>

    <div>
      <div id="myTabContent" class="tab-content">
        <?php  //This section contains the about tab   ?>
        <div class="tab-pane fade active in college-content" id="college-nav-about">
          <?php
              /* getting the college content about college and dean intro  */
              $true=0;
              $college_about=fetch_data($path_chk."about/about_college.txt");
              if($college_about!="<br>"&&$college_about!="")
              {
                  echo '<div class="section-sub-heading">About College</div>';
                  echo '<div class="article">'.$college_about.'</div>';  
                  $true=1;
              }           
              $college_about=fetch_data($path_chk."about/dean_intro.txt");
              if($college_about!="<br>"&&$college_about!="")
              {
                  echo '<div class="section-sub-heading" style="background:#279683"> Dean Introduction</div><div class="article">'.$college_about.'</div>';
                  $true=1;
              }
              $college_about=fetch_data($path_chk."about/rules.txt");
              if($college_about!="<br>"&&$college_about!="")
              {
                  echo '<div class="section-sub-heading" style="background:#FC5857">Rules</div><div class="article">'.$college_about.'</div>';
                  $true=1;
              }
              if($true==0)
              {
                  echo '<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
              }
          ?>
        </div>
        <?php  //This section contains the academics tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-academics">
          <?php
            $return='';
            $true=0;
            $college_acad=fetch_data($path_chk."academics/acad_info.txt"); 
            if($college_acad!="<br>"&&$college_acad!="")
            {
              $return.='<div class="section-sub-heading"> Academic Information</div><div class="article">'.$college_acad.'</div>';
              $true=1;
            }
            $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
            while($type=mysqli_fetch_assoc($availtypes))
            {
              $type= $type['type'];
              $names=mysqli_query($con,'select name from college_entrance_test where cid = '.$cid.' && type="'.$type.'"');
              $checkq=mysqli_query($con1,"select * from `t".$cid."` where `program`='".$type."' && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0))");
              $noui=mysqli_num_rows($checkq);

              if($noui>0)
              {
                $return .= "<div class='section-sub-heading' style=\"background:#279683\"> Courses Offered (".ucfirst($type).")</div><div class='article'><div id=\"".$type."-tables\">";

                while($name=mysqli_fetch_assoc($names))
                {
                  $name=$name['name'];
                  $college_exams=mysqli_query($con,'select gen,sc,st,obc,state,rg_obc,rg_sc,rg_st,name from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
                  $exam=array('gen','obc','sc','st','state','rg_obc','rg_sc','rg_st');
                  $exampr=array(0,0,0,0,0,0,0,0); 
                  $examname=array("General","OBC","SC","ST","Region/Gen","Region/OBC","Region/SC","Region/ST");
                  $query="select department,program,intake";
                  $table_list="['Department','Intake']";
                  
                  $query.=" from t".$cid." where program = '".$type."' && name=".$name." && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0)) ";
                  $closingrank=mysqli_query($con1,$query);
                  $closing_year=mysqli_fetch_assoc(mysqli_query($con,'select closing_year from college_entrance_test where cid='.$cid.'&&type="'.$type.'" && name='.$name))['closing_year'];
                  $eid=$name;

                  if(mysqli_num_rows($closingrank)>0)
                  {
                    $return.= "<div class='section-sub-sub-heading' '><div class=\"mycol-md-8\"> Exam : ";
                    $exams=mysqli_query($con,"select * from allcourses");
                    $real_name=mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name'];
                    $a=$real_name;
                    $return.= $a;
                    $return.=" </div>";

                    if($closing_year!=0)
                     $return.= "<div class=\"mycol-md-4\" >Year : ".$closing_year."</div>";

                    $return.= "</div>";
                    $return.= '<br>
                      <div class="table-responsive"><table id="'.$type.$name.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
                    $return.= "<tr> <td>Sl. No.</td><td>Department</td><td>Intake</td>";
                    $return.= "</tr>";
                    $rc=1;

                    while($row=mysqli_fetch_assoc($closingrank))
                    {
                      $return.= "<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$row['intake']."</td>"; 
                      $return.= '</tr>';
                      $rc+=1;
                    }
                    $return.= "</table></div></div>";
                  }
                }
                $return.= "</div>";
              }
            }

            $college_acad=fetch_data($path_chk."academics/list_of_courses.txt");
              
            if($college_acad!="<br>"&&$college_acad!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857"> List of Courses</div><div class="article">'.$college_acad."</div>";
              $true=1;
            }
            $college_acad=fetch_data($path_chk."academics/misc.txt");

            if($college_acad!="<br>"&&$college_acad!="")
            {
              $return.='<div class="section-sub-heading">Misc Academic Info</div><div class="article">'.$college_acad."</div>";
              $true=1;
            }

            if($true==0)
            {
              $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the admission tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-admission">
          <?php  
            $return="";
            $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
            while($type=mysqli_fetch_assoc($availtypes))
            {
              $type= $type['type'];
              $names=mysqli_query($con,'select name from college_entrance_test where cid = '.$cid.' && type="'.$type.'"');
              $checkq=mysqli_query($con1,"select * from `t".$cid."` where `program`='".$type."' && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0))");
              $noui=mysqli_num_rows($checkq);
              if($noui>0)
              {
                echo "<div class='section-sub-heading'>Closing Ranks (".ucfirst($type).")</div><div class=\"article\"><div id=\"".$type."-tables\">";
                while($name=mysqli_fetch_assoc($names))
                {
                  $name=$name['name'];
                  $college_exams=mysqli_query($con,'select gen,sc,st,obc,state,rg_obc,rg_sc,rg_st,name from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
                  $exam=array('gen','obc','sc','st','state','rg_obc','rg_sc','rg_st');
                  $exampr=array(0,0,0,0,0,0,0,0); 
                  $examname=array("General","OBC","SC","ST","Region/Gen","Region/OBC","Region/SC","Region/ST");
                  $query="select department,program,intake";
                  $table_list="['Department'";
                  while($row=mysqli_fetch_assoc($college_exams))
                  {
                    for ($i=0; $i < sizeof($exam); $i++) 
                    { 
                      if($row[$exam[$i]]!=0)
                      {
                        $exampr[$i]=$row[$exam[$i]];
                        $query.=",".$exam[$i];
                        $table_list.=",'".ucfirst($examname[$i])."'";
                      }
                      else
                        $examname[$i]="";
                    }
                  }
                  $table_list.="]";
                  $query.=" from t".$cid." where program = '".$type."' && name=".$name." && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0)) ";
                  $closingrank=mysqli_query($con1,$query);
                  $closing_year=mysqli_fetch_assoc(mysqli_query($con,'select closing_year from college_entrance_test where cid='.$cid.'&&type="'.$type.'" && name='.$name))['closing_year'];
                  $eid=$name;
                  if(mysqli_num_rows($closingrank)>0)
                  {
                    echo "<div class='section-sub-sub-heading'><div class=\"mycol-md-8\"> Exam : ";
                    $exams=mysqli_query($con,"select * from allcourses");
                    $real_name=mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name'];
                    $a=$real_name;
                    echo $a;
                      

                    echo " </div>";
                    if($closing_year!=0)
                      echo "<div class=\"mycol-md-4\" >Year : ".$closing_year."</div>";

                    echo "</div>";
                    echo '<br>
                      <div class="table-responsive"><table id="'.$type.$name.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
                    echo "<tr> <td>Sl. No.</td><td>Department</td>";
                    for ($i=0; $i <sizeof($exam) ; $i++) 
                    {
                      if($examname[$i]!="")
                      {
                        echo "<td>".ucfirst($examname[$i])."</td>";
                      }
                    }
                    echo "</tr>";
                    $rc=1;
                    while($row=mysqli_fetch_assoc($closingrank))
                    {
                      echo "<tr><td>".$rc."</td><td>".$row['department']."</td>";
                      for ($i=0; $i <sizeof($exam) ; $i++) 
                      {
                        if($examname[$i]!="")
                        {
                          if($row[$exam[$i]]!=0)
                            echo "<td>".$row[$exam[$i]]."</td>";
                          else
                            echo "<td>-</td>";
                        }
                      }
                      echo '</tr>';
                      $rc+=1;
                    }
                    echo "</table></div>";
                  }
                }
                echo "</div></div>";
              }
            }
            echo $return; 
          ?>
          <?php
            $true=0;
            $college_adm=fetch_data($path_chk."admissions/eligibility.txt");
            if($college_adm!="<br>"&&$college_adm!="")
            {
              $return.='<div class="section-sub-heading" style="background:#279683">Eligibility Criteria</div>'.$college_adm;
              $true=1;
            }
            $college_adm=fetch_data($path_chk."admissions/admission_info.txt");
            if($college_adm!="<br>"&&$college_adm!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857"> Admission Info</div>'.$college_adm;
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
              $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the fee tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-fees">
          <?php
            $return='';
            $true=0;
            $fee=mysqli_query($con1,"select * from fee_t".$cid);

            if(mysqli_num_rows($fee)!=0)
            {
              $return.="<div class='section-sub-heading'>Fee per ";

              if($fee_type==0)
                $return.="Semester";
              else
                $return.="Annum";
              $return.="</div>";
              $return.="<div class='article'><div class='table-responsive'><table class='mytable table table-bordered table-responsive'><tr><th>Cource </th><th> Cateory </th><th> Tution Fee</th><th> Miscellanous fee</th><th>Mess and Hostel fee</th><th>Total</th><th>Refundable Fee</th></tr>";
              $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot','refundable_fee'];

              while($row=mysqli_fetch_assoc($fee))
              {
                $return.='<tr>';
                for ($i=0; $i < 7; $i++)
                { 
                  $return.='<td>'.(($i>1)&&($row[$fee_array[$i]]==0)?"-":$row[$fee_array[$i]]).'</td>';
                }
                $return.='</tr>';
              }
              $return.="</table></div></div>";
              $true=1;
            }
            $fee_data=fetch_data($path_chk."fees/scholarships.txt");

            if($fee_data!="<br>"&&$fee_data!="")
            {
                $return.='<div class="section-sub-heading"  style="background:#279683">Scholarships</div><div class="article">'.$fee_data.'</div>';
                $true=1;
            }

            $fee_data=fetch_data($path_chk."fees/benefits.txt");
            if($fee_data!="<br>"&&$fee_data!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857">Benefits</div><div class="article">'.$fee_data.'</div>';
              $true=1;
            }

            $fee_data=fetch_data($path_chk."fees/caution.txt");
            if($fee_data!="<br>"&&$fee_data!="")
            {
              $return.='<div class="section-sub-heading">Caution Deposits</div><div class="article">'.$fee_data.'</div>';
              $true=1;
            }

            $fee_data=fetch_data($path_chk."fees/misc.txt");
            if($fee_data!="<br>"&&$fee_data!="")
            {
              $return.='<div class="section-sub-heading" style="background:#279683">Miscellanous info</div><div class="article">'.$fee_data.'</div>';
              $true=1;
            }
            if($true==0)
            {
              $return.='<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the facilities tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-facilities">
          <?php
            $true=0;
            $return='';
            $college_acad=fetch_data($path_chk."academics/facilities.txt");
            if($college_acad!="<br>"&&$college_acad!="")
            {
              $return.='<div class="section-sub-heading">Academic Facilities</div><div class="article">'.$college_acad.'</div>';
              $true=1;
            }

            $hostel=fetch_data($path_chk."facilities/mess_and_hostel_facilities.txt");
            if($hostel!="<br>"&&$hostel!="")
            {
              $return.='<div class="section-sub-heading" style="background:#279683">Hostel Facilities and Mess</div><div class="article">'.$hostel.'</div>';
              $true=1;
            }

            $sports=fetch_data($path_chk."facilities/sports.txt");
            if($sports!="<br>"&&$sports!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857">Sports Facilities</div><div class="article">'.$sports.'</div>';
              $true=1;
            }

            $sports=fetch_data($path_chk."facilities/misc_facilities.txt");
            if($sports!="<br>"&&$sports!="")
            {
              $return.='<div class="section-sub-heading">Other Important Facilities</div><div class="article">'.$sports.'</div>';
              $true=1;
            }

            if($true==0)
            {
              $return.='<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the sports and activities tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-sports-activities">
          <?php
            $true=0;
            $return='';
            $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
            if($cocurricular!="<br>"&&$cocurricular!="")
            {
              $return.='<div class="section-sub-heading">Extra Cocurricular Activities</div><div class="article">'.$cocurricular.'</div>';
              $true=1;
            }
            if($true==0)
            {
              $return.='<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the placement tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-placements">
          <?php
            $true=0;
            $return='';
            $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);

            while($type=mysqli_fetch_assoc($availtypes))
            {
              $type= $type['type'];
              $query="select department,total_intake,placed,min_package,max_package,avg_package from t".$cid." where (placed != 0 || min_package!=0 || max_package!=0 || avg_package!=0) && program='".$type."'";
              $package=mysqli_query($con1,$query);

              if(mysqli_num_rows($package)==0)
              {

              }
              else
              {
                $placement_year=mysqli_fetch_assoc(mysqli_query($con,'select placement_year from college_entrance_test where cid='.$cid.'&&type="'.$type.'"'))['placement_year'];
                $return.="<div class='section-sub-heading' style=\"background:#279683\">Placement Record (".ucfirst($type).")";
                if($placement_year!=0)
                {
                  $return.="<div>".$placement_year."</div>";
                }

                $return.="</div><div class='article'><div class='table-responsive'>
                  <table class='table table-bordered table-responsive mytable' id='".$type."-placement-table'>";
                $return.="<tr> <td>Sl. No.</td><td>Depatment</td><td>Total Intake</td><td>Placed</td><td>Min Package</td><td>Max Package</td><td>Average Package</td></tr>";
                $rc=1;

                while($row=mysqli_fetch_assoc($package))
                {
                  $intake=$row['total_intake'];
                  if($intake==0)
                    $intake="-";

                  $placed=$row['placed'];
                  if($placed==0)
                    $placed="-";

                  $mi=$row['min_package'];
                  if($mi==0)
                    $mi="-";

                  $ma=$row['max_package'];
                  if($ma==0)
                    $ma="-";

                  $av=$row['avg_package'];
                  if($av==0)
                    $av="-";

                  $return.="<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$intake."</td><td>".$placed."</td><td>".$mi;
                  $return.="</td><td>".$ma."</td><td>".$av.'</td></tr>';
                  $rc+=1;
                }
                $return.="</table></div></div>";
              }
            }
            echo $return;
            $return='';
            $placement_contact=fetch_data($path_chk."placements/placement_info.txt");

            if($placement_contact!="<br>"&&$placement_contact!="")
            {
              $return.='<div class="section-sub-heading">Placement  Information</div><div class="article">'.$placement_contact."</div>";
              $true=1;
            }

            $placement_contact=fetch_data($path_chk."placements/contacts.txt");
            if($placement_contact!="<br>"&&$placement_contact!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857">Contact for Placements</div><div class="article">'.$placement_contact."</div>";
              $true=1;
            }

            if($true==0)
            {
              $return.='<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
            }
            echo $return;
          ?>
        </div>
        <?php  //This section contains the contacts tab   ?>
        <div class="tab-pane fade college-content" id="college-nav-contacts">
          <?php
            $return='';
            $true=0;
            $contact=fetch_data($path_chk."contact/contacts.txt");
            if($contact!="<br>"&&$contact!="")
            {
              $return.='<div class="section-sub-heading"  style="background:#FC5857">Contact info</div><div class="article">'.$contact.'</div>';
              $true=1;
            }
            if($true==0)
            {
              $return.='<div class="article"><blockquote class="no-info">No Data available for this section</blockquote></div>';
            }
            echo $return;
          ?>
        </div>
      </div>

      <footer class="footer">
        <a href="http://www.infermap.com">&copy;  Infermap.com</a>
      </footer>

    </div>

</body>
<script type="text/javascript" src="../data/js/jquery.js"></script>
<script type="text/javascript" src="../data/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var slider=0;
  $("#marker").click(function(e){
    var k;
    if(slider==0)
      k="0%";
    else
      k="-60%";
    $( ".sidebar" ).animate({
      left: k
    }, 500, function() {
      slider=(slider+1)%2;
    });
  })
</script>
            

</html>
