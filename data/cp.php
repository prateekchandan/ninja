<?php
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
    else
    {
        header("Location:http://www.infermap.com");
    }
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

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css"/>
    <link href="fonts/googleapi.css" rel="stylesheet"/>
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/college-view.css">
       
</head>
<body>
    <nav class="navbar-collapse navbar-fixed-top" role="navigation" id="navbar-top">
        <div class="navbar-brand" href="#" id="brand-img"><a href="http://www.infermap.com"><img src="../img/logo-header.png" height="82px"></a></div>
        <form class="" role="search">
            <div id="searchbar" class="input-group add-on">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
        </form>
    </nav>

    

    <ul id="college-nav-tabs" class="nav nav-tabs">
      <li class="active" style="width:10%">
        <a href="#college-nav-about" data-toggle="tab">
            ABOUT
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:10%">
        <a href="#college-nav-academics" data-toggle="tab">
            ACADEMICS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:10%">
        <a href="#college-nav-admission" data-toggle="tab">
            ADMISSION
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:10%">
        <a href="#college-nav-fees" data-toggle="tab">
            FEES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:10%" id="tab-select-placement">
        <a href="#college-nav-facilities" data-toggle="tab">
            FACILITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%" id="tab-select-placement">
        <a href="#college-nav-sports-activities" data-toggle="tab">
            SPORTS AND ACTIVITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:15%" >
        <a href="#college-nav-placements" data-toggle="tab">
            PLACEMENTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:15%;border-right:1px solid #BBB">
        <a href="#college-nav-contacts" data-toggle="tab">
            CONTACTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
    </ul>
     <ul id="college-nav-tabs-phone" class="nav nav-tabs">
      <li class="active" style="width:20%;margin-left:20%">
        <a href="#college-nav-about" data-toggle="tab">
            ABOUT
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%">
        <a href="#college-nav-academics" data-toggle="tab">
            ACADEMICS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%">
        <a href="#college-nav-admission" data-toggle="tab">
            ADMISSION
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%">
        <a href="#college-nav-fees" data-toggle="tab">
            FEES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:25%" id="tab-select-placement">
        <a href="#college-nav-facilities" data-toggle="tab">
            FACILITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:25%" id="tab-select-placement">
        <a href="#college-nav-sports-activities" data-toggle="tab">
            ACTIVITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:25%" >
        <a href="#college-nav-placements" data-toggle="tab">
            PLACEMENTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:%;border-right:1px solid #BBB">
        <a href="#college-nav-contacts" data-toggle="tab">
            CONTACTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
    </ul>
    <div class="container college-head ">
        <div class="col-sm-10">
            <h1 id="college-name" name="college-name">
                <?php echo mysqli_fetch_array(mysqli_query($con,'select * from college_id where cid='.$cid))['name'];  ?>
            </h1>
            <div class="short-address">
                <?php  echo " ".$college_area.$college_city.$college_state;?>
            </div>
            <div class="short-address">
                <?php  ?>
            </div>
        </div>
        <div class="col-sm-2" >
            <?php echo ' <img src="'.$logo.'" id="college-logo">'; ?>
        </div>
        <br>
        <div class="col-sm-12" class="facility-icon" >
          <?php
            if($row['computer_lab']==1)
              echo '<img src="./img/icons/computer.png" class="facility-icon" Title="Computer Lab available">';

            if($row['boys_hostel']==1)
              echo '<img src="./img/icons/boys hostel.png" class="facility-icon" Title="Boys Hostle Facility">';

            if($row['girls_hostel']==1)
              echo '<img src="./img/icons/girls hostel.png" class="facility-icon" Title="Girls Hostle Facility">';

            if($row['transport']==1)
              echo '<img src="./img/icons/bus.png" class="facility-icon" Title="Transport Facility">';

            if($row['sports_ground']==1)
              echo '<img src="./img/icons/ground.png" class="facility-icon" Title="Sports Facility">';

            if($row['gym']==1)
              echo '<img src="./img/icons/gym.png" class="facility-icon" Title="Gym Available">';

            if($row['internet']==1)
              echo '<img src="./img/icons/internet.png" class="facility-icon" Title="Internet Facility">';

            if($row['library']==1)
              echo '<img src="./img/icons/library.png" class="facility-icon" Title="Library Available">';

            if($row['scholarship']==1)
              echo '<img src="./img/icons/scholarship.png" class="facility-icon" Title="Scholarships available">';
          ?>
        </div>

    </div>
    <hr class="hr-full">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in college-content" id="college-nav-about">
                
             <?php
           /* getting the college content about college and dean intro  */
            $true=0;
            $college_about=fetch_data($path_chk."about/about_college.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="./img/icons/about college.png"> About College</div>';
               
                $true=1;
            }
               echo '<div class="college-gallery" style="float:right;"> <div id="carousel-foreground"><img src="../img/gallery.png" height="295px" width="550px"></div><div id="carousel-gallery" class="carousel slide" data-ride="carousel"><h2><br> Uploading Carousel..<br></h2></div></div><div class="col-md-12 college-gallery"></div> ';
                
                echo '<div class="about-text" style="max-height:320px;overflow:auto">'.$college_about.'</div>';          
            $college_about=fetch_data($path_chk."about/dean_intro.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="./img/icons/dean intro.png"> Dean Introduction</div>'.$college_about;
                $true=1;
            }
            $college_about=fetch_data($path_chk."about/rules.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="./img/icons/rules.png"> Rules</div>'.$college_about;
                $true=1;
            }
            if($true==0)
            {
                echo '<blockquote class="no-info">No Data available for this section</blockquote>';
            }
           ?>
		</div>
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
            if($noui>0){
            echo "<div class='section-sub-heading'><img src=\"./img/icons/closing rank.png\"> Closing Ranks (".ucfirst($type).")</div><div id=\"".$type."-tables\">";
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
                        for ($i=0; $i < sizeof($exam); $i++) { 
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
                if(mysqli_num_rows($closingrank)>0){
                    echo "<div class='section-sub-sub-heading' '><div class=\"col-md-8\"> Exam : ";
                $exams=mysqli_query($con,"select * from allcourses");

                $real_name=mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name'];
               $a=$real_name;
                echo $a;
                

                echo " </div>";
                if($closing_year!=0)
                   echo "<div class=\"col-md-4\" >Year : ".$closing_year."</div>";

                echo "</div>";
                echo '<br>
                    <div class="table-responsive"><table id="'.$type.$name.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
                    echo "<tr> <td>Sl. No.</td><td>Department</td>";
                    for ($i=0; $i <sizeof($exam) ; $i++) {
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
                        for ($i=0; $i <sizeof($exam) ; $i++) {
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
            echo "</div>";
            }
        }
        echo $return; ?>
        <?php
        $true=0;
         $college_adm=fetch_data($path_chk."admissions/eligibility.txt");
            if($college_adm!="<br>"&&$college_adm!="")
            {
                $return.='<div class="section-sub-heading">Eligibility Criteria</div>'.$college_adm;
                $true=1;
            }
            $college_adm=fetch_data($path_chk."admissions/admission_info.txt");
            if($college_adm!="<br>"&&$college_adm!="")
            {
                $return.='<div class="section-sub-heading"><img src="./img/icons/admission info.png"> Admission Info</div>'.$college_adm;
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
        <?php
         $return='<div class="tab-pane fade college-content" id="college-nav-academics">';
          $true=0;
           $college_acad=fetch_data($path_chk."academics/acad_info.txt");
           
            if($college_acad!="<br>"&&$college_acad!="")
            {
                $return.='<div class="section-sub-heading"><img src="./img/icons/academic info.png"> Academic Information</div>'.$college_acad;
                $true=1;
            }


            $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
           while($type=mysqli_fetch_assoc($availtypes))
        {
            $type= $type['type'];
            $names=mysqli_query($con,'select name from college_entrance_test where cid = '.$cid.' && type="'.$type.'"');
            $checkq=mysqli_query($con1,"select * from `t".$cid."` where `program`='".$type."' && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0))");
            $noui=mysqli_num_rows($checkq);
            if($noui>0){
            $return .= "<div class='section-sub-heading'><img src=\"./img/icons/closing rank.png\"> Courses Offered (".ucfirst($type).")</div><div id=\"".$type."-tables\">";
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
                if(mysqli_num_rows($closingrank)>0){
                   $return.= "<div class='section-sub-sub-heading' '><div class=\"col-md-8\"> Exam : ";
                $exams=mysqli_query($con,"select * from allcourses");

                $real_name=mysqli_fetch_assoc(mysqli_query($con,'select name from exam where eid='.$eid))['name'];
               $a=$real_name;
                $return.= $a;
                

                 $return.=" </div>";
                if($closing_year!=0)
                   $return.= "<div class=\"col-md-4\" >Year : ".$closing_year."</div>";

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
                     $return.= "</table></div>";
                 }
            }
            $return.= "</div>";
            }
        }












            
             $college_acad=fetch_data($path_chk."academics/list_of_courses.txt");
            if($college_acad!="<br>"&&$college_acad!="")
            {
                $return.='<div class="section-sub-heading"><img src="./img/icons/list of courses.png"> List of Courses</div>'.$college_acad;
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
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
        $return.="</div>";
        echo $return;
        // FEES 
        $return='<div class="tab-pane fade college-content" id="college-nav-fees">';
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
          $return.="<table class='mytable table table-bordered'><tr><th>Cource </th><th> Cateory </th><th> Tution Fee</th><th> Miscellanous fee</th><th>Mess and Hostel fee</th><th>Total</th><th>Refundable Fee</th></tr>";
          $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot','refundable_fee'];
          while($row=mysqli_fetch_assoc($fee))
              {
                   $return.='<tr>';
                   for ($i=0; $i < 7; $i++) { 
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
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
        $return.="</div>";
        echo $return;
        ?>
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
                $return.="<div class='section-sub-heading'>Placement Record (".ucfirst($type).")";
                 if($placement_year!=0)
                 {
                    $return.="<div>".$placement_year."</div>";
                 }
                $return.="</div>
                <table class='table table-bordered mytable' id='".$type."-placement-table'>";
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
                $return.="</table>";
            }
        }
        echo $return;
        $return='';
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
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
            echo $return;
        ?>
        </div>
        <?php
        /*This Page is created for Placements now Facilities */
        $true=0;
        $return='<div class="tab-pane fade college-content" id="college-nav-facilities">';
            $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
            $college_acad=fetch_data($path_chk."academics/facilities.txt");
            if($college_acad!="<br>"&&$college_acad!="")
            {
                $return.='<div class="section-sub-heading"><img src="./img/icons/academic facility.png"> Academic Facilities</div>'.$college_acad;
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
            $sports=fetch_data($path_chk."facilities/misc_facilities.txt");
            if($sports!="<br>"&&$sports!="")
            {
                $return.='<div class="section-sub-heading">Other Important Facilities</div>'.$sports;
                $true=1;
            }
            if($true==0)
            {
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
        $return.="</div>";
        echo $return;

        /*This Page is created for sports and activities */
        $true=0;
        $return='<div class="tab-pane fade college-content" id="college-nav-sports-activities">';
            $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
            if($cocurricular!="<br>"&&$cocurricular!="")
            {
                $return.='<div class="section-sub-heading">Extra Cocurricular Activities</div>'.$cocurricular;
                $true=1;
            }
            if($true==0)
            {
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
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
                $return.='<blockquote class="no-info">No Data available for this section</blockquote>';
            }
            echo $return;
        ?>
                <div id="socials">
                                <div id="weblink"><a target="_blank" id="weblinka" href="#" title="Web Page"><i class="fa fa-desktop fa-2x" ></i></a></div>
                                <div id="fblink"><a target="_blank" id="fblinka" href="#" title="Facebook Page of College"><i class="fa fa-facebook fa-2x" ></i></a></div>
                                <div id="twitterlink"><a target="_blank" id="twitterlinka" href="#" title="Twitter link"><i class="fa fa-twitter fa-2x" ></i></a></div>
                                <div id="pluslink"><a target="_blank" id="pluslinka" href="#" title="Google Plus profile"><i class="fa fa-google-plus fa-2x" ></i></a></div>
                                <div id="linkedlink"><a target="_blank" id="linkedlinka" href="#" title="Linked In"><i class="fa fa-linkedin fa-2x" ></i></a></div>
                            </div>
      </div>
     </div>
    </div>
	<footer class="footer">
		<div class="footer-content" >
			<div class="col-md-5" style="padding:0px;margin-top:5px;">
	       		<!--button class="btn footer-btn">Register</button>
	       		<button class="btn footer-btn">Login</button-->
	      	</div>
	      	<div class="col-md-2 col-md-offset-5" style="padding:15px;">
	      	&copy; <a href="http://www.infermap.com" class="copyright-link">Infermap.com</a>
	      	</div>
	    </div>

	</footer>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php echo "var cid=".$cid.";"; ?>
        function refreshlink()
        {
        jQuery.ajax({
                        url: "php/fetch_links.php?cid="+cid,
                        type:"GET",
                        success:function(data)
                        {
                            var links=jQuery.parseJSON(data);
                            var link=["weblink","fblink","twitterlink","pluslink","linkedlink"];
                            
                            for (var i = link.length - 1; i >= 0; i--) {
                                if(links[i]&&links[i]!="false")
                                {
                                    if(links[i].substr(0,4)!="http"&&links[i].substr(0,3)!="ftp")
                                        links[i]="http://"+links[i];

                                    document.getElementById(link[i]+"a").href=links[i];
                                    document.getElementById(link[i]+"a").target="_blank";
                                    $("#"+link[i]).css("display","block");
                                }
                                else
                                {
                                     $("#"+link[i]).css("display","none");
                                }
                            };

                        },
                        error:function(data)
                        {
                            alert(data);
                        }
                    })
        }
        refreshlink();
                function refresh_gallery()
                {
                    jQuery.ajax(
                        {
                            url: "php/get-image-gallery.php?cid="+cid,
                            type:"GET",
                            success: function(data)
                            {
                                $("#carousel-gallery").html(data);
                                $(".carousel").carousel();
                            }
                        })
                }
                refresh_gallery();

  var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
$(window).resize(function(){
  var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
});

$("a").attr("target", "_blank");
            </script>
            

</html>
