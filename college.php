<?php
include 'php/dbconnect.php';
session_start();
function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
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
        $cid=mysqli_real_escape_string($con,$abc);
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
$path_chk="data/data/".$cid."/";
$default_path="data/data/default/";
$mobile_browser = '0';
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
}    
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
    $mobile_browser = 0;
}
 
/*if ($mobile_browser > 0) {
   include "college-phone.php";
   die("");
}*/



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
  $logo ="../data/img/icon.png";
}
$q=mysqli_query($con,'select * from college_id where cid='.$cid);
$row=mysqli_fetch_array($q);
$college_sql=$row;
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

if(isset($_GET['tab'])){
  switch ($_GET['tab']) {
    case 'about':
      $tab='about';
      break;
    case 'academics':
      $tab='academics';
      break;
    case 'admission':
      $tab='admission';
      break;
    case 'fees':
      $tab='fees';
      break;
    case 'facilities':
      $tab='facilities';
      break;
    case 'sports':
      $tab='sports';
      break;
    case 'placements':
      $tab='placements';
      break;
    case 'contacts':
      $tab='contacts';
      break;
    default:
      $tab='about';
      break;
  }
}
else
  $tab='about';

$urlshare="www.infermap.com/college/".clean($row['name'])."-".clean($row['city'])."-".$row['link'].'&tab='.$tab;

$_HEADER=array();
$_HEADER['title']=$college_name.' - Infermap - '.$tab;
$_HEADER['desc']="This page is belongs to ".$college_name;
$_HEADER['keywords']="College, Education, Search, Query, About College, Admission,".$college_name;
$_HEADER['keywords'].= $college_name." Admissions,"; 
$_HEADER['keywords'].= $college_name." FEES,";
$_HEADER['keywords'].= $college_name." Facilities,";
$_HEADER['keywords'].= $college_name." Placements,";
$_HEADER['keywords'].= $college_name." Contacts,";
$_HEADER['keywords'].= $college_name." Academic,";
$_HEADER['keywords'].= $college_name." Courses,";
$_HEADER['keywords'].= $college_name." Closing Ranks,";
$_HEADER['keywords'].= $college_state.",";
$_HEADER['keywords'].= $college_city.",";
$_HEADER['keywords'].= $college_university.",";

for ($i=1; $i < 8; $i++) { 
  if($row['alias'.$i]!="")
  $_HEADER['keywords'].= $row['alias'.$i].",";
}

switch ($tab) {
  case 'about':
      $_HEADER['desc'].="It contains the  basic information about this college including the image gallery , about college , introduction of dean , rules and regulation.";
      $_HEADER['keywords'].="Dean Introduction,About College,Rules,Contacts,";
      break;
    case 'academics':
      $_HEADER['desc'].="It contains all the academics information about this college including the academic information, list of courses,courses offered , programmes offered";
      $_HEADER['keywords'].="Courses Offered, List of Courses, Programs Offered, btech, Mtech,academic information,";
      break;
    case 'admission':
      $_HEADER['desc'].="It contains information required for admission about this college including the closing ranks,admission procedure , eligibility Criteria etc.";
      $_HEADER['keywords'].="btech, Mtech, closing ranks, Admissions, eligibility criteria, intake, admission information,";
      break;
    case 'fees':
      $_HEADER['desc'].="It contains information about fees and scholarship of the college.";
      $_HEADER['keywords'].="fees, scholarship, caution deposit, fees per annum,fee per semester";
      break;
    case 'facilities':
      $_HEADER['desc'].="It contains the information of academic facilities , sports facilities , hostel and mess facilities and other important facilities.";
      $_HEADER['keywords'].="hostel facilities, sport facilities, academic facility, mess facility, placement facility,library,";
      break;
    case 'sports':
      $_HEADER['desc'].="It contains the information of sports and activities of the college.";
      $_HEADER['keywords'].="gym,sport facilities,";
      break;
    case 'placements':
      $_HEADER['desc'].="It contains the placement data of the college also including the placement info and stats.";
      $_HEADER['keywords'].="placement facility, contact for placement,placement statistics";
      break;
    case 'contacts':
      $_HEADER['desc'].="It contains the contact information of the college.";
      $_HEADER['keywords'].="contact information, view on map,";
      break;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_HEADER['title'];  ?></title>
    <!-- SEO FOR GOOGLE and other sites -->
    <meta name="title" content="<?php echo $_HEADER['title'];  ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="<?php echo $_HEADER['desc'];  ?>">
    <meta name="Keywords" content="<?php echo $_HEADER['keywords']; ?>">
    <meta name="author" content="">
    <link rel="author" href="https://plus.google.com/u/0/102559294513459206399/about"/>

    <!--  SEO FOR FACEBOOK and few others-->
    <meta property="og:title" content="<?php echo $_HEADER['title'];  ?>"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://<?php  echo $urlshare;?>"/>
    <meta property="og:description" content="<?php echo $_HEADER['desc'];  ?>"/>
    <meta property="article:author" content="https://www.facebook.com/infermap" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="<?php echo $_HEADER['title'];  ?>">

    <?php

       if ($handle = opendir($path_chk.'images/')) {
        while (false !== ($entry = readdir($handle))) {
           if($entry!=="." && $entry!=".." &&$entry!='thumbnail')
           {
              echo '<meta itemprop="image" content="http://www.infermap.com/data/data/'.$cid.'/images/'.$entry.'">
    <meta property="og:image" content="http://www.infermap.com/data/data/'.$cid.'/images/'.$entry.'"/>
    ';
           }
        }
      }
    ?>
    <meta property="og:image" content="http://www.infermap.com/img/social.png"/>

    <!--meta property="fb:admins" content=""/-->
    

    <link href="../data/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../data/font-awesome/css/font-awesome.css"/>
    <link href="../data/fonts/googleapi.css" rel="stylesheet"/>
    <link rel="icon" href="../data/img/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../data/css/college-view.css">
       
</head>
<body>
    <?php 
    $_HEADER=array();
    $_HEADER['dir']='1';
    include './header.php';
    ?>

    

    <ul id="college-nav-tabs" class="nav nav-tabs">
      <li <?php if($tab=='about') {echo 'class="active"';} ?> style="width:10%;text-align:right">
        <a href="#college-nav-about" data-toggle="tab" onclick="changeurl('about')">
            ABOUT
          <div class="tab-selector" style="right: 36px;position: absolute;">
          </div>
        </a>
      </li>
      <li <?php if($tab=='academics') {echo 'class="active"';} ?> style="width:10%">
        <a href="#college-nav-academics" data-toggle="tab" onclick="changeurl('academics')">
            ACADEMICS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='admission') {echo 'class="active"';} ?> style="width:10%">
        <a href="#college-nav-admission" data-toggle="tab" onclick="changeurl('admission')">
            ADMISSION
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='fees') {echo 'class="active"';} ?> style="width:10%">
        <a href="#college-nav-fees" data-toggle="tab" onclick="changeurl('fees')">
            FEES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='facilities') {echo 'class="active"';} ?> style="width:10%" id="tab-select-placement">
        <a href="#college-nav-facilities" data-toggle="tab" onclick="changeurl('facilities')">
            FACILITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='sports') {echo 'class="active"';} ?> style="width:20%" id="tab-select-placement">
        <a href="#college-nav-sports-activities" data-toggle="tab" onclick="changeurl('sports')">
            SPORTS AND ACTIVITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='placements') {echo 'class="active"';} ?> style="width:15%" >
        <a href="#college-nav-placements" data-toggle="tab" onclick="changeurl('placements')">
            PLACEMENTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='contacts') {echo 'class="active"';} ?> style="width:15%;border-right:1px solid #BBB">
        <a href="#college-nav-contacts" data-toggle="tab" onclick="changeurl('contacts')">
            CONTACTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
    </ul>
    <ul id="college-nav-tabs-phone" class="nav nav-tabs">
      <li <?php if($tab=='about') {echo 'class="active"';} ?> style="width:20%;margin-left:20%">
        <a href="#college-nav-about" data-toggle="tab" onclick="changeurl('about')">
            ABOUT
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='academics') {echo 'class="active"';} ?> style="width:20%">
        <a href="#college-nav-academics" data-toggle="tab" onclick="changeurl('academics')">
            ACADEMICS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='admission') {echo 'class="active"';} ?> style="width:20%">
        <a href="#college-nav-admission" data-toggle="tab" onclick="changeurl('admission')">
            ADMISSION
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='fees') {echo 'class="active"';} ?> style="width:20%">
        <a href="#college-nav-fees" data-toggle="tab" onclick="changeurl('fees')">
            FEES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='facilities') {echo 'class="active"';} ?> style="width:25%" id="tab-select-placement">
        <a href="#college-nav-facilities" data-toggle="tab" onclick="changeurl('facilities')">
            FACILITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='sports') {echo 'class="active"';} ?> style="width:25%" id="tab-select-placement">
        <a href="#college-nav-sports-activities" data-toggle="tab" onclick="changeurl('sports')">
            ACTIVITIES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='placements') {echo 'class="active"';} ?> style="width:25%" >
        <a href="#college-nav-placements" data-toggle="tab" onclick="changeurl('placements')">
            PLACEMENTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li <?php if($tab=='contacts') {echo 'class="active"';} ?> style="width:%;border-right:1px solid #BBB">
        <a href="#college-nav-contacts" data-toggle="tab" onclick="changeurl('contacts')">
            CONTACTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
    </ul>
    <div class="container college-head ">
        <div class="row">
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
        </div>
        <br>
        <div class="col-sm-12 row" class="facility-icon" >
          <?php
            if($row['computer_lab']==1)
              echo '<img src="../data/img/icons/computer.png" class="facility-icon" Title="Computer Lab available">';

            if($row['boys_hostel']==1)
              echo '<img src="../data/img/icons/boys hostel.png" class="facility-icon" Title="Boys Hostle Facility">';

            if($row['girls_hostel']==1)
              echo '<img src="../data/img/icons/girls hostel.png" class="facility-icon" Title="Girls Hostle Facility">';

            if($row['transport']==1)
              echo '<img src="../data/img/icons/bus.png" class="facility-icon" Title="Transport Facility">';

            if($row['sports_ground']==1)
              echo '<img src="../data/img/icons/ground.png" class="facility-icon" Title="Sports Facility">';

            if($row['gym']==1)
              echo '<img src="../data/img/icons/gym.png" class="facility-icon" Title="Gym Available">';

            if($row['internet']==1)
              echo '<img src="../data/img/icons/internet.png" class="facility-icon" Title="Internet Facility">';

            if($row['library']==1)
              echo '<img src="../data/img/icons/library.png" class="facility-icon" Title="Library Available">';

            if($row['scholarship']==1)
              echo '<img src="../data/img/icons/scholarship.png" class="facility-icon" Title="Scholarships available">';
          ?>
        </div>

    </div>
    <button id="feedbackbtn" class="btn btn-success">Feedback</button>
    
   

    <div id="feedbackpot">
        <h3>Give Your Feedback</h3>
        <form style="padding-top:20px;border-top:1px solid #ddd" role="form" id="feedback-form">
          <div class="form-group" id="feedback-sub">
            <label for="feedback-subject">Subject: *</label>
            <select class="form-control" name="feedback-subject" id="feedback-subject">
              <option>Regarding Basic details</option>
              <option>Academics</option>
              <option>Admissions</option>
              <option>Fees</option>
              <option>Facilities</option>  
              <option>Placements</option>  
              <option>Sports and Activities</option>  
              <option>Contacts</option>
              <option>Others</option>
            </select>
          </div>
          <div class="form-group" id="feedback-email-box">
            <label for="feedback-email">Email: *</label>
            <input type="email" class="form-control" name="feedback-email" id="feedback-email" placeholder="Enter email">
          </div>
           <div class="form-group" id="feedback-message">
            <label for="feedback-msg">Message: *</label>
            <textarea class="form-control" rows="3" id="feedback-msg" name="feedback-msg" placeholder="Write something...."></textarea>
           </div>
           <input type="hidden" value="<?php echo $row['name'];?>" name="college-name">
          <br>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

    <hr class="hr-full">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade <?php if($tab=='about') {echo 'active in';} ?> college-content" id="college-nav-about">
                
             <?php
            /* getting the college content about college and dean intro  */
            $true=0;
            $college_about=fetch_data($path_chk."about/about_college.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="../data/img/icons/about college.png"> About College</div>';
               
                $true=1;
            }
               echo '<div class="college-gallery" style="float:right;">
                       <div id="carousel-foreground">
                          <img src="../img/gallery.png" height="295px" width="550px">
                        </div>
                        <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
                          ';
                $return='<ol class="carousel-indicators">';
                 // Reading all images from directory 
                if ($handle = opendir($path_chk.'images/')) {
                    $count=0;
                /* This is the correct way to loop over the directory. */
                    while (false !== ($entry = readdir($handle))) {
                       if($entry!=="." && $entry!=".." &&$entry!="logo.png"&&$entry!='thumbnail')
                       {
                         if($count==0)
                            $add="active";
                        else
                            $add="";
                          $return.='<li data-target="#carousel-gallery" data-slide-to="'.$count.'" class="'.$add.'"></li>';
                         $count=$count+1;
                       }
                    }
                    $return.=' </ol>
                    <div class="carousel-inner">';
                     closedir($handle);
                     $handle = opendir($path_chk.'images/');
                $t=0;
                 while (false !== ($entry = readdir($handle))) {
                   if($entry!=="." && $entry!=".." &&$entry!="logo.png"&&$entry!='thumbnail')
                   {
                    $alt="";
                    if(file_exists($path_chk."img-alt/".$entry.".txt"))
                        {
                            $file = fopen($path_chk."img-alt/".$entry.".txt", "r") or exit("Unable to open file!");
                            $alt= fgets($file);
                            fclose($file);
                        }
                        else
                            $alt="";
                        $filename=$path."images/".$entry;
                        if($t==0)
                            $add="active";
                        else
                        $add="";
                        $return.='<div class="item '.$add.'">
                                        <img src="'.$filename.'">
                                        <div class="carousel-caption">
                                          <h4 style="background:rgba(100,100,100,0.3);height:27px;">'.$alt.'</h4>
                                        </div>
                                </div>';
                        $t=1;
                   }
                }

                $return.='</div>
                                    <a class="left carousel-control" href="#carousel-gallery" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-gallery" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                  ';
                closedir($handle);
                }
                echo $return;
                
                      echo '
                        </div>
                      </div>
                       ';
                
                echo '<div class="about-text" style="max-height:320px;overflow:auto">'.$college_about.'</div>';          
            $college_about=fetch_data($path_chk."about/dean_intro.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="../data/img/icons/dean intro.png"> Dean Introduction</div>'.$college_about;
                $true=1;
            }
            $college_about=fetch_data($path_chk."about/rules.txt");
            if($college_about!="<br>"&&$college_about!="")
            {
                echo '<div class="section-sub-heading"><img src="../data/img/icons/rules.png"> Rules</div>'.$college_about;
                $true=1;
            }
            if($true==0)
            {
                echo '<blockquote class="no-info">No Data available for this section</blockquote>';
            }
           ?>
    </div>
    <div class="tab-pane fade <?php if($tab=='admission') {echo 'active in ';} ?> college-content" id="college-nav-admission">
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
            echo "<div class='section-sub-heading'><img src=\"../data/img/icons/closing rank.png\"> Closing Ranks (".ucfirst($type).")</div><div id=\"".$type."-tables\">";
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
                $return.='<div class="section-sub-heading"><img src="../data/img/icons/admission info.png"> Admission Info</div>'.$college_adm;
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
        <div class="tab-pane fade <?php if($tab=='academics') {echo 'active in ';} ?>college-content" id="college-nav-academics">
        <?php
         $return='';
          $true=0;
           $college_acad=fetch_data($path_chk."academics/acad_info.txt");
           
            if($college_acad!="<br>"&&$college_acad!="")
            {
                $return.='<div class="section-sub-heading"><img src="../data/img/icons/academic info.png"> Academic Information</div>'.$college_acad;
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
            $return .= "<div class='section-sub-heading'><img src=\"../data/img/icons/closing rank.png\"> Courses Offered (".ucfirst($type).")</div><div id=\"".$type."-tables\">";
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
                      if($row['intake']>0)
                        $intake=$row['intake'];
                      else
                        $intake="--";
                        $return.= "<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$intake."</td>";
                        
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
                $return.='<div class="section-sub-heading"><img src="../data/img/icons/list of courses.png"> List of Courses</div>'.$college_acad;
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
        ?>
        <div class="tab-pane fade  <?php if($tab=='fees') {echo 'active in ';} ?> college-content" id="college-nav-fees">
        <?php
        // FEES 
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
          $return.="<div class=\"table-responsive\"><table class='mytable table table-bordered table-responsive'><tr><th>Cource </th><th> Cateory </th><th> Tution Fee</th><th> Miscellanous fee</th><th>Mess and Hostel fee</th><th>Total</th><th>Refundable Fee</th></tr>";
          $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot','refundable_fee'];
          while($row=mysqli_fetch_assoc($fee))
              {
                   $return.='<tr>';
                   for ($i=0; $i < 7; $i++) { 
                     $return.='<td>'.(($i>1)&&($row[$fee_array[$i]]==0)?"-":$row[$fee_array[$i]]).'</td>';
                   }
                   $return.='</tr>';
              }
              $return.="</table></div>";
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
        <div class="tab-pane <?php if($tab=='placements') {echo 'active in ';} ?> fade college-content" id="college-nav-placements">
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
                $return.="</div><div class=\"table-responsive\">
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
                $return.="</table></div>";
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
        <div class="tab-pane fade <?php if($tab=='facilities') {echo 'active in ';} ?> college-content" id="college-nav-facilities">
        <?php
        /*This Page is created for Placements now Facilities */
        $true=0;
        $return='';
            $cocurricular=fetch_data($path_chk."facilities/extra_cocurricular.txt");
            $college_acad=fetch_data($path_chk."academics/facilities.txt");
            if($college_acad!="<br>"&&$college_acad!="")
            {
                $return.='<div class="section-sub-heading"><img src="../data/img/icons/academic facility.png"> Academic Facilities</div>'.$college_acad;
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
        ?>
        <div class="tab-pane fade <?php if($tab=='sports') {echo 'active in ';} ?> college-content" id="college-nav-sports-activities">
        <?php
        /*This Page is created for sports and activities */
        $true=0;
        $return='';
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
        ?>
          <div class="tab-pane fade <?php if($tab=='contacts') {echo 'active in ';} ?> college-content" id="college-nav-contacts">
        <?php
        /*This Page is created for Sports and facilities now Contacts */
        $return='';
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
   <div id="share-buttons">
      <!-- Facebook -->
      <a href="http://www.facebook.com/sharer.php?u=http://<?php echo $urlshare; ?>" target="_blank">
        <img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
      </a>
      <!-- Twitter -->
      <a href="http://twitter.com/share?url=http://<?php echo $urlshare; ?>&text=<?php echo $college_sql['name']." via Infermap"; ?>" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" /></a>
       
      <!-- Google+ -->
      <a href="https://plus.google.com/share?url=http://<?php echo $urlshare; ?>" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/google.png" alt="Google" /></a>
      <!-- LinkedIn -->
      <a href="http://www.linkedin.com/shareArticle?mini=true&url=http://<?php echo $urlshare; ?>" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" /></a>    
      <!-- Pinterest 
      <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><img src="http://www.simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" /></a-->
      <!-- Email -->
      <a href="mailto://?Subject=<?php echo $college_sql['name']." via Infermap"; ?>&Body=Hey%20I%20found%20this%20college%20on%20Infermap%20and%20thought%20to%20to%20share%20with%20you
       <?php echo $urlshare; ?>"><img src="http://www.simplesharebuttons.com/images/somacro/email.png" alt="Email" /></a>    
    </div>
  <div class="related-colleges-div">
    <div class="row container" style="padding:30px;">
      <div class="col-md-6">
        <h4><u>Similar Colleges</u></h4>
        <table>
          <tr>
            <td>
              <b><a href="<?php echo '../main.php?search=side-filter&state='.$college_sql['state'].'&city='.$college_sql['city']; ?> ">See colleges from <?php echo $college_sql['city'];?></a></b>
              <br>
              <b><a href="<?php echo '../main.php?search=side-filter&state='.$college_sql['state']; ?> ">See colleges from <?php echo $college_sql['state'];?></a></b>
            </td>
            <td>
              <ul id="related-college">
              
              </ul>
            </td>
          </tr>
        </table>
        
      </div>
      <div class="col-md-4">
        
        
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
<script type="text/javascript" src="../data/js/jquery.js"></script>
<script type="text/javascript" src="../data/js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php echo "var cid=".$cid.";"; ?>

function changeurl(str){
  history.pushState({}, "",<?php echo '"'.$_GET['college'].'"'; ?>+"&tab="+str);
}
        function refreshlink()
        {
        jQuery.ajax({
                        url: "../data/php/fetch_links.php?cid="+cid,
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
                /*function refresh_gallery()
                {
                    jQuery.ajax(
                        {
                            url: "../data/php/get-image-gallery.php?cid="+cid,
                            type:"GET",
                            success: function(data)
                            {
                                $("#carousel-gallery").html(data);
                                $(".carousel").carousel();
                            }
                        })
                }
                refresh_gallery();*/
                $(".carousel").carousel();

  var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
$(window).resize(function(){
  var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
});

$("#feedbackbtn").click(function(){
    togglefeedback();
});
  var feedbackshown = false;
  function togglefeedback(){
    if(feedbackshown){
        feedbackshown = false;
        $('#feedbackpot').animate({
            opacity: 0,
            right: -500,
        }, 1000, function(){
            $('#feedbackpot').css('display', 'none');
        }
        );
    }
    else{
        feedbackshown = true;
        $('#feedbackpot').css('display', 'block');
        $('#feedbackpot').animate({
            opacity: 1,
            right: 50,
        }, 1000
        );
    }
  }
  $("#feedback-form").submit(function(){
    var k=0;
    if($("#feedback-subject").val()==""){
        k=1;
        $("#feedback-sub").addClass("has-error");
    }
    else
        $("#feedback-sub").removeClass("has-error");
     if($("#feedback-msg").val()==""){
        k=1;
        $("#feedback-message").addClass("has-error");
    }
    else
        $("#feedback-message").removeClass("has-error");

    if($("#feedback-email").val()==""){
        k=1;
        $("#feedback-email-box").addClass("has-error");
    }
    else
        $("#feedback-email-box").removeClass("has-error");
    if(k==1)
        return false;
    $.ajax({
        url:"../php/send-college-feedback.php",
        type:"POST",
        data:$("#feedback-form").serialize(),
        success:function(data){
            console.log(data);
            togglefeedback();
            $("#feedback-subject").val("");
            $("#feedback-email").val("");
            $("#feedback-msg").val("");
            alert("Feedback Sent");

        },
        error:function(){
            alert("Failed to send feedback\n Network error");
        }
    });
    return false;
  });

$("a").attr("target", "_blank");
 jQuery.ajax({
      type:'POST',
      data:{id:<?php  echo "'".$cid."'";?>},
      url:'../php/getrelatedcolleges.php',
      success:function(data){
        console.log(data);
        try{
          coll=JSON.parse(data);
        }
        catch(e){
          $('#related-college').html('Failed to load colleges');
          return;
        }
        if(coll.length==0){
          $('#related-college').html('Failed to load colleges');
        }
        else{
          var str="";
          for (var i = coll.length - 1; i >= 1; i--) {
            str+="<li><a href="+coll[i][2]+">"+coll[i][0]+"</a></li>";
          };
          $('#related-college').html(str);
        }
      },
      error:function(){
        $('#related-college').html('Failed to load colleges');
      }

    });
            </script>

         

         <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48869263-1', 'infermap.com');
    ga('send', 'pageview');
  </script>
            

</html>
