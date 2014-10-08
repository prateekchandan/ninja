<?php
include 'php/dbconnect.php';
$colleges=[];
function clean($string) {
	return '';
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
foreach ($_GET as $key => $value) {
  $value = str_replace("'", '', $value);
  $value = str_replace('"', '', $value);
  $value=mysqli_real_escape_string($con,$value);
  $value = str_replace("\\n", '', $value);
  $value = str_replace("\\r", '', $value);
  $_POST[$key]=$value;

}
for ($i=0; $i < 2000; $i++) { 
  $colleges[$i]=0;
  $maxm=10;
}
$max_weight="2";
$available_depts=false;
$map=false;
if(isset($_POST['state']))
  $state=$_POST['state'];
else
  $state='';
if(isset($_POST['city']))
  $city=$_POST['city'];
else
  $city='';
if(isset($_POST['address']))
  $address=$_POST['address'];
else
  $address='';
if(isset($_POST['distance']))
  $distance=$_POST['distance'];
else
  $distance='';
if(isset($_POST['exam']))
  $exam=$_POST['exam'];
else
  $exam='';
if(isset($_POST['rank']))
  $rank=$_POST['rank'];
else
  $rank='';
if(isset($_POST['category']))
  $category=$_POST['category'];
else
  $category='';
if(isset($_POST['department']))
  $department=$_POST['department'];
else
  $department='';
if(isset($_POST['exam-weight']))
  $exam_weight=$_POST['exam-weight']*1.5;
else
  $exam_weight='1';
if(isset($_POST['location-weight']))
  $location_weight=$_POST['location-weight']*1.2;
else
  $location_weight='1';

if(isset($_POST['department-weight']))
  $department_weight=$_POST['department-weight'];
else
  $department_weight='1';
if(isset($_POST['type-weight']))
	$type_weight=$_POST['type-weight'];
else
	$type_weight='1';
$maxm=0;
if(isset($_POST['search']))
{
    if($_POST['search']=='keyword')
    {
        $querystr=mysqli_real_escape_string($con,$_POST['value']);
        $queryno=100;
        $q=mysqli_query($con,"select * from college_id where disabled='1' && name='".$querystr."'");
        if(mysqli_num_rows($q)>0)
        {
          $tempcollege=mysqli_fetch_assoc($q);
          header("Location:./college/".clean($tempcollege['name']."-".$tempcollege['city'])."-".$tempcollege['link']);
        }
        else
        include 'php/keyword.php';

      $count=sizeof($colleges);
      $maxm+=10;
      $total_data=array();
      foreach ($colleges as $key => $value) {
        $q=mysqli_query($con,"select * from college_id where disabled='1' && cid=".$key);
        if(mysqli_num_rows($q)==0)
          continue;
        $row=mysqli_fetch_assoc($q);
        $row['score']=10-$value;
        $total_data[$row['cid']]=$row;
      }
     
    }
    /*if($_POST['search']=='rank')
    {
        $eid=$exam;
        $rank=$rank;
        $cat=$category;
        if($exam!=''){
        if($cat=='')
          $cat='gen';
        include 'php/ranksearch.php';
        $count=sizeof($colleges);
        }
    }
    if($_POST['search']=='dept')
    {
      
        if($department=='')
         {}
        else{
          $colleges=[];
          
          $q=mysqli_query($con,"select * from college_department where `".$department."`=1");
           while($row=mysqli_fetch_assoc($q))
           {
           
            $q2=mysqli_query($con,"select * from college_id where cid=".$row['cid']." && disabled=1");
            if(mysqli_num_rows($q2)>0)
            array_push($colleges, $row['cid']);
           }
          $count=sizeof($colleges);
        }
    }
     if($_POST['search']=='location')
    {

        if($state==''){

        }else{
           $colleges=[];
          $q="select * from college_id where disabled='1' && state='".$state."' ";
          if($city!='')
              $q.=" && city ='".$city."' ";
          $q.="limit 100";
          $q=mysqli_query($con,$q);
          while($row=mysqli_fetch_assoc($q))
            array_push($colleges, $row['cid']);
        }
        $count=sizeof($colleges);
        
    }*/
    if($_POST['search']=='dept'||$_POST['search']=='side-filter'||$_POST['search']=='guide'||$_POST['search']=='rank'||$_POST['search']=='location')
    {
      $total_data=array();
      $coll=array();
      $q=mysqli_query($con,"select * from college_id where disabled='1'");

      while($row=mysqli_fetch_assoc($q))
      {
        $row['score']=0;
        $row['depts']=array();
        $total_data[$row['cid']]=$row;
        array_push($coll,$row['cid']);
      }
      if(isset($_POST['typeofcollege'])){
        if($_POST['typeofcollege']=='govt'){
          $_POST['govt']='on';
          $_POST['autonomous']='on';
        }
        if($_POST['typeofcollege']=='private')
          $_POST['private']='on';
        if($_POST['typeofcollege']=='autonomous')
          $_POST['autonomous']='on';
      }
      if($department_weight>0&&$department!=''){
      	$maxm+=$department_weight;
        $q=mysqli_query($con,"select * from college_department where `".$department."`=1");
        while($row=mysqli_fetch_assoc($q)){
          if(isset($total_data[$row['cid']]))
          $total_data[$row['cid']]['score']+=$department_weight;
        }

      }
      if($type_weight>0){
      	$q="";
      	if(isset($_POST['govt'])){
      		$q.=" `type`='Government' ";
      	}
      	if(isset($_POST['autonomous'])){
      		if($q!='')
      			$q.="||";
      		$q.=" `type`='Autonomous' ";
      	}
      	if(isset($_POST['private'])){
      		if($q!='')
      			$q.="||";
      		$q.=" `type`='private' ";
      	}
      	if($q!='')
      	{
      		$maxm+=$type_weight;
      		$queres=mysqli_query($con,"select * from college_id where disabled='1' && (".$q.")");
      		while($row=mysqli_fetch_assoc($queres)) {
		        $total_data[$row['cid']]['score']+=$type_weight;
		    }
      	}
      }
      if(isset($_POST['fee-help'])){
      	if($_POST['fee-help']=="2"){
      		$q=mysqli_query($con,"select * from college_id where disabled='1' && `type`='Government'");
	        while($row=mysqli_fetch_assoc($q)){
	          $total_data[$row['cid']]['score']+=2;
        	}
        	$maxm+=2;
      	}
      	else if($_POST['fee-help']=="1"){
      		$q=mysqli_query($con,"select * from college_id where disabled='1'");
	        while($row=mysqli_fetch_assoc($q)){
	        	if($row['type']=='Government'||$row['type']=='Autonomous')
	        		$total_data[$row['cid']]['score']+=2;
	        	else
	        		$total_data[$row['cid']]['score']+=1;
        	}
        	$maxm+=2;
      	}

      }
      if($exam_weight>0){
        $available_depts=true;
         $eid=$exam;
          $rank=$rank;
          $cat=$category;
          if($exam!=''){
          	$maxm+=$exam_weight;
          if($cat=='')
            $cat='gen';
            $q=mysqli_query($con,"select eid from exam where name='".$eid."'");
            $str="";
            $eidar=array();
            while($row=mysqli_fetch_assoc($q)){
              if($str!="")
                $str.=" || ";
              array_push($eidar,$row['eid']);
              $str.=" name = ".$row['eid'];
            }
            $q=mysqli_query($con,"select distinct cid,name from college_entrance_test where ".$str." group by cid");
            while($row=mysqli_fetch_assoc($q)){
              $cid=$row['cid'];
              if(!isset($total_data[$cid]))
                continue;
              if($rank==''){
                if(isset($total_data[$cid]))
                  $total_data[$cid]['score']+=$exam_weight;
                    continue;
              }
              $col=mysqli_fetch_assoc(mysqli_query($con,"select * from college_id where disabled='1' && cid=".$cid));
              $q1=mysqli_query($con1,"select distinct department,".$cat." from t".$cid." where ".$str." ");
              $t=0;
              if($q1)
              while($r1=mysqli_fetch_assoc($q1)){
                
                foreach ($eidar as $eid ) {
                 // print_r($eidar);
                  if($eid!=24&&$eid!=9&&$eid!=5&&(intval($r1[$cat])>intval($rank))){

                    
                      if($r1[$cat]!=0&&!in_array($total_data[$cid]['depts'], $r1['department']))
                      {
                        $t=1;
                       // echo $r1['department']." Added in ".$col['name']." rank is ".intval($r1[$cat])." / ".intval($rank)."<br> ";
                        array_push($total_data[$cid]['depts'], $r1['department']);
                      }
                    }
                    else if($eid==24&&$eid==9&&$eid==5){
                      if($r1[$cat]!=0&&(intval($r1[$cat])<intval($rank))){                   
                        if(!in_array($total_data[$cid]['depts'], $r1['department'])){
                          array_push($total_data[$cid]['depts'], $r1['department']);
                           $t=1;
                        }
                      }
                    }
                }               
              }
              if($t){
                $total_data[$cid]['score']+=$exam_weight;
              // echo $total_data[$cid]['name']." added ".$t."<br>";
              }
            }
          }
      }
      if($location_weight=='big-city'){
      	$maxm+=2;
      	
      	$q=mysqli_query($con,"select * from college_id where disabled='1' && (state='delhi' || city= 'mumbai' || city='delhi'||city='pune'||city='hyderabad'||city='chennai'||city='bangalore') " );
          while($row=mysqli_fetch_assoc($q)){
            $total_data[$row['cid']]['score']+=2;
          }
      }
      else if($location_weight>0)
      {
        if($state!=''&&$city!=''){
        	$maxm+=$location_weight;
          $q=mysqli_query($con,'select * from college_id where disabled=\'1\' && state="'.$state.'"');
          while($row=mysqli_fetch_assoc($q)){
            $total_data[$row['cid']]['score']+=$location_weight/2;
          } 
          $q=mysqli_query($con,'select * from college_id where disabled="1" && state="'.$state.'" && city="'.$city.'" ');
          while($row=mysqli_fetch_assoc($q)){
            $total_data[$row['cid']]['score']+=$location_weight/2;
          }
        }
        else if($state!=''){
        	$maxm+=$location_weight;
          $q=mysqli_query($con,'select * from college_id where disabled=\'1\' && state="'.$state.'"');
          while($row=mysqli_fetch_assoc($q)){
            $total_data[$row['cid']]['score']+=$location_weight;
          }
        }
        if($address!=''){
          // Now calculating the distances from given place
          $lat=0; $lng=0;
          function getLatandLong($addr)
          { 
            global $lat,$lng;
            try 
            {
              $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address=,+'.$addr.',+India&sensor=false');
              $output= json_decode($geocode);  
              if($output->status!='OK')
                return;
            } 
            catch (Exception $e) 
            {
              return;
            }
            $lat = $output->results[0]->geometry->location->lat;
            $lng = $output->results[0]->geometry->location->lng;
          }
          getLatandLong($address);
          if($lat!=0&&$lng!=0){
          	$maxm+=$location_weight;
            function distance($lat1, $lon1, $lat2, $lon2) {
              $theta = $lon1 - $lon2;
              $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $miles = $dist * 60 * 1.1515;
              return ($miles * 1.609344);
            }
            $q=mysqli_query($con,"select * from college_id where disabled='1'"); 
            $all=array();
            $no= mysqli_num_rows($q);
            while ($row=mysqli_fetch_assoc($q)) {
                array_push($all, $row);
            }
            for ($i=0; $i < $no; $i++) 
            { 
              $mylat=$all[$i]['latitude'];
              $mylog=$all[$i]['longitude'];
              $all[$i]['distance']=distance($mylat,$mylog,$lat,$lng);
            }
            $price = array();
            foreach ($all as $key => $row)
            {
              $price[$key] = $row['distance'];
            }
            array_multisort($price, SORT_ASC, $all);
            for ($i=0; $i < $no; $i++) { 
              if ($distance!=''&&$distance!='0'&&$distance!=0) {
                if($all[$i]['distance']>$distance)
                  break;
                $total_data[$all[$i]['cid']]['score']+=$location_weight;
              }          
              else{
                if(($location_weight-$i/10)<0)
                {
                  break;
                }
                else
                {
                  $total_data[$all[$i]['cid']]['score']+=($location_weight-((int)($i/10)));
                }
              }
            }//End of if lat & kng !=0
          }    
        }//End of if address!=''
      }// End of if location weight
      if(isset($_POST['college-list'])){
      	$college_list=json_decode($_POST['college-list']);
      	foreach ($college_list as $key) {
      		$name=mysqli_real_escape_string($key);
      		$q=mysqli_query($con,"select * from college_id where disabled='1' && name='".$key."'");
      		while($row=mysqli_fetch_assoc($q)){
      			$total_data[$row['cid']]['score']+=50;
      		}
      	}
      }
  $count=0;
  $perfect_college=0;
      $price = array();
      foreach ($total_data as $key => $row)
       	{
          $price[$key] = $row['score'];
          if($row['score']>0){
            $count+=1;
          }
          if($row['score']>=$maxm){
            $perfect_college+=1;
          }
        }
        array_multisort($price, SORT_DESC, $total_data);
    }//End of side filter
}//End of isset search

session_start();
if(isset($_SESSION['user-email']))
  $user=$_SESSION['user-email'];
else
  $user=false;

if($exam_weight!=2)
  $exam_weight/=1.5;

if($location_weight!=2)
  $location_weight/=1.2;

if($_GET['map']=="on")
$map=1;

$page_title='Infermap - ';
if($state!='' && $location_weight>0){
  $page_title.='Colleges from '.$state;
}
else if($exam.='' && $exam_weight>0){
  $page_title.='Colleges from '.$exam;
}
else{
  $page_title.=' Next generation education portal';
}
$page_desc='Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Infermap</title>
    <meta name="title" content="<?php  echo $page_title; ?>">
    <meta name="description" content="<?php  echo $page_desc; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="College,Education,About College,Admission, Courses Offered, Programs Offered, closing ranks, Admissions, fees,  facilities,  contact information, view on map, Extra Co-curricular Activities">
    <meta name="author" content="Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="<?php  echo $page_title; ?>"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/social.png"/>
    <meta property="og:url" content="<?php echo $_SERVER['HTTP_REFERER'].'?'.$_SERVER['QUERY_STRING']; ?>"/>
    <meta property="og:description" content="<?php  echo $page_desc; ?>"/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="<?php  echo $page_title; ?>">
    <meta itemprop="description" content="<?php  echo $page_desc; ?>">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link href="data/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    
</head>
<body>

  <?php include "header.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <div class="background" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:10000;display:none" id="back">
    </div>
    <div class="container" style="max-width:1140px;margin:auto;padding:0px;">
      <div class="col-xs-3 sidebar">
          <form class="well side-filter" id="side-filter" method="get">  
            <input type="hidden" name="map" <?php if($map==1) echo "value='on'"; else echo "value='off'"; ?>>
            <input   type="hidden" value="side-filter" name='search'>
              <div class="filter-head" id="filter-head2" onclick="filteropen(2)">
                  <span class="side-ticker <?php   
                      if($_POST['location-weight']>0&&($state!=""||$address!=""))
                        echo ' side-ticker-active ';
                    ?> " id="sidef2"></span>
                  Location Search
                  <i class="fa fa-caret-right"></i>
              </div>
              
              <div class="filter-head" id="filter-head3" onclick="filteropen(3)">
                  <span class="side-ticker <?php   
                      if($_POST['exam-weight']>0&&($exam!=""))
                        echo ' side-ticker-active ';
                    ?>" id="sidef3"></span>
                  EXAM
                  <i class="fa fa-caret-right"></i>
              </div>
               
              <div class="filter-head" id="filter-head4" onclick="filteropen(4)">
                  <span class="side-ticker <?php   
                      if($_POST['department-weight']>0&&($department!=""))
                        echo ' side-ticker-active ';
                    ?>" id="sidef4"></span>
                  DEPARTMENT
                  <i class="fa fa-caret-right"></i>
              </div>
              <div class="filter-head" id="filter-head5" onclick="filteropen(5)">
                  <span class="side-ticker <?php   
                      if($_POST['type-weight']>0&&(isset($_POST['govt'])||isset($_POST['private'])||isset($_POST['autonomous'])))
                        echo ' side-ticker-active ';
                    ?>" id="sidef5"></span>
                  TYPE OF COLLEGE
                  <i class="fa fa-caret-right"></i>
              </div>
              <br>
              <div class="filter-head" id="filter-head6" onclick="filteropen(6)">
                  <span class="side-ticker" id="sidef6"></span>
                  FEES
                  <i class="fa fa-caret-right"></i>
              </div>
              <div class="filter-head" id="filter-head7" onclick="filteropen(7)">
                  <span class="side-ticker" id="sidef7"></span>
                  Hostel Facilities
                  <i class="fa fa-caret-right"></i>
              </div>
              <div class="filter-head" id="filter-head8" onclick="filteropen(8)">
                  <span class="side-ticker" id="sidef8"></span>
                  Connectivity
                  <i class="fa fa-caret-right"></i>
              </div>
              <div class="filter-head" id="filter-head9" onclick="filteropen(9)">
                  <span class="side-ticker" id="sidef9"></span>
                  Financial Benefits
                  <i class="fa fa-caret-right"></i>
              </div>
             
              <button class="btn btn-sidebar-go">GO</button>
              
          
          <!--div class="well">
            <b> The Heading </b>
            <p>The content goes here <br>            
            <p style="text-align:right"><b>Next ></b></p>
          </div-->
      </div>
      <div class="filter-box" id="filter2">
        <div class="filter-box-head">
        	<button type="button" class="close" onclick="filteropen(2)">&times;</button>
          <strong>Modify the location to get the colleges</strong>
        </div>
        <div class="col-xs-12">
          <div class="row">
            <h5 style="padding-left:20px;">Search colleges by State and city</h5>
            <div style="padding-left:20px;">
            <div class="form-group" style="padding-bottom:3px;overflow:auto;">
              <label class="col-xs-3">State:</label>
              <div class="col-xs-9">
                <select class="form-control" id="location-state" name="state">
                  <option value="">Select State</option>
                  <?php
                    $q=mysqli_query($con,"select distinct state from college_id where disabled='1' && state!='' && state!='--Select State--' order by state");
                    $sta=array();
                    while($row=mysqli_fetch_assoc($q))
                    {
                      if($state==$row['state'])
                        echo "<option selected>".$row['state']."</option>";
                      else
                        echo "<option>".$row['state']."</option>";
                      $sta[$row['state']]=array();
                    }
                    $str="";
                    $q=mysqli_query($con,"select distinct city,state from college_id where disabled='1' && state!='' && state!='--Select State--' && city!='' order by city DESC");
                    while($row=mysqli_fetch_assoc($q))
                    {
                      array_push($sta[$row['state']],$row['city']);
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group" style="padding-bottom:3px;overflow:auto;">
              <label class="col-xs-3">City :</label>
              <div class="col-xs-9">
                <script type="text/javascript">
                    var states=<?php echo json_encode($sta); ?>;
                    var city=<?php echo "'".$city."'"; ?>;
                    function setcity(){
                      if($("#location-state").val()==""){
                        $("#location-city").html("<option value=''>Select city</option>");
                        return;
                      }
                      var cities=states[$("#location-state").val()];
                      var str="<option value=''>Select city</option>";
                      for (var i = cities.length - 1; i >= 0; i--) {
                        if(cities[i]==city){
                          str+="<option selected>"+cities[i]+"</option>";
                         // city='';
                        }
                        else
                          str+="<option>"+cities[i]+"</option>";
                      };
                      $("#location-city").html(str);
                    }
                    $("#location-state").change(function(){
                      setcity();
                    });
                    setcity();
                </script>
                <select class="form-control" id="location-city" name="city">
                  <option value="">Select city</option>
                </select>
              </div>
            </div>
          </div></div>
          <h5 style="border-top:1px solid #eee;margin-top:0px;padding-top:10px">Or select a landmark and give radius to find college within it </h5>
          <div style="padding-left:20px;"><div class="form-group row" >
            <label class="col-xs-3">Landmark / City / State</label>
            <div class="col-xs-9">
              <input class="form-control" name="address" id="location-address" value="<?php echo $address;?>">
            </div>
          </div>
          <div class="form-group row">
            <label  class="col-xs-3">Kilometres</label>
            <div class="col-xs-9">
              <input class="form-control" type="number" id="location-distance" name="distance" value="<?php 
              if($distance=='')
                echo '0';
              else
              echo $distance;
              ?>">
            </div>
          </div>
        </div></div>
        <div class="row col-xs-12">
          <label class="col-xs-3"> Requirement</label>
          <div class="col-xs-9">Not required<input type="range" id="slider" name="location-weight" min="0" max="2" value="<?php echo $location_weight;?>" />Must</div>
        </div>
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter3">
        <div class="filter-box-head">
        	<button type="button" class="close" onclick="filteropen(3)">&times;</button>
        	Modify the exam taken and your rank to refine your search
        </div>
        <div class="col-xs-12">
          <div class="form-group row">
            <label class="col-xs-3">Which exam? :</label>
            <div class="col-xs-9">
              <select class="form-control" id="exam-search" name="exam">
                <option value="">Select exam</option>
                <?php
                  $q=mysqli_query($con,"select distinct name from exam where  active='1' order by name");
                  while($row=mysqli_fetch_assoc($q))
                    {
                      if($exam==$row['name'])
                        echo "<option selected>".$row['name']."</option>";
                      else
                      echo "<option>".$row['name']."</option>";
                    }
                ?>
              </select>
              <script type="text/javascript">
                var categories={<?php
                      $cate=mysqli_query($con,"select * from category");
                      $i=0;
                      while($row=mysqli_fetch_assoc($cate))
                      {
                        if($i!=0)
                          echo ",";
                        $i+=1;
                        echo $row['id'].":'".$row['name']."'";
                      }
                  ?>}
                var exams={<?php
                  $exam=mysqli_query($con,"select distinct name,category from exam where  active='1' order by name");
                  $i=0;
                  while($row=mysqli_fetch_assoc($exam))
                  {
                    if($i!=0)
                    echo ",";
                    echo "'".$row['name']."':['".$row['name']."',".$row['category']."]";
                    $i+=1;
                  }
                  echo "};";
                  ?>
              </script>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-3">Your rank(Optional)</label>
            <div class="col-xs-9">
              <input type="number" class="form-control" placeholder="rank" name="rank" value="<?php echo $rank; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-3">Your Category</label>
            <div class="col-xs-9">
              <select class="form-control" id="exam-category" name="category">
                <option value="">Select Category</option>
              </select>
            </div>
            <script type="text/javascript">
            <?php
            echo "var category='".$category."';";
            ?>
              function setcategory(){
                if($("#exam-search").val()==""){
                   $("#exam-category").html("<option value=''>Select Category</option>");
                   return;
                }
                 var cat=exams[$("#exam-search").val()][1],str="<option value=''>Select Category</option>";
                for (var i = 0; i < cat.length; i++) {
                  if(cat[i]==category){
                     str+="<option selected value='"+cat[i]+"'>"+categories[cat[i]]+' ('+cat[i]+')'+"</option>";
                     category='';
                   }
                    else
                     str+="<option value='"+cat[i]+"'>"+categories[cat[i]]+' ('+cat[i]+')'+"</option>";
                };
                $("#exam-category").html(str);
              }
              $("#exam-search").change(function(){
               setcategory();
              })
              setcategory();
            </script>
          </div>
        </div>
        <div class="row col-xs-12">
          <label class="col-xs-3"> Requirement</label>
          <div class="col-xs-9">Not required<input type="range" id="slider" min="0" max="2" value="<?php echo $exam_weight;?>" name="exam-weight"/>Must</div>
        </div>
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter4">
        <div class="filter-box-head">
        	<button type="button" class="close" onclick="filteropen(4)">&times;</button>
        	Refine search with your field of interest
        </div>
        <div class="col-xs-12">
          <label>Chose field of study</label>
              <select class="form-control" name="department">
                <option value=''>Select department</option>
                        <?php
                          $q=mysqli_query($con,"select * from departments");
                          while($row=mysqli_fetch_assoc($q))
                          {
                            if($department==$row['key'])
                              echo "<option selected value='".$row['key']."'>".$row['value']."</option>";
                            else
                              echo "<option value='".$row['key']."'>".$row['value']."</option>";
                          }
                        ?>
            </select>
        </div>
        <div class="row col-xs-12" style="margin-top:20px;">
          <label class="col-xs-3"> Requirement</label>
          <div class="col-xs-9">Not required<input type="range" name="department-weight" xid="slider" min="0" max="2" value="<?php echo $department_weight;?>" />Must</div>
        </div>
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter5">
        <div class="filter-box-head">
        	<button type="button" class="close" onclick="filteropen(5)">&times;</button>
        	Chose the type of colleges you wanna see
        </div>
        <div class="col-xs-12">
          <label>What type of college you prefer :</label>
           <ul style="list-style:none">
           		<li><input type="checkbox" <?php if(isset($_POST['govt'])) echo "checked";?> name="govt"> Government Colleges</li>
           		<li><input type="checkbox" <?php if(isset($_POST['autonomous'])) echo "checked";?> name="autonomous"> Autonommous Colleges</li>
           		<li><input type="checkbox" <?php if(isset($_POST['private'])) echo "checked";?> name="private"> Private Colleges</li>
           </ul>
        </div>
        <div class="row col-xs-12" style="margin-top:20px;">
          <label class="col-xs-3"> Requirement</label>
          <div class="col-xs-9">Not required<input type="range" name="type-weight" xid="slider" min="0" max="2" value="<?php echo $type_weight;?>" />Must</div>
        </div>
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter6">
        <div class="filter-box-head">
          <button type="button" class="close" onclick="filteropen(6)">&times;</button>
          Chose the fees limits
        </div>
        <div class="col-xs-12">
          <label>What fees limit is affordable to you :</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['fees-mark']==1) echo "checked";?> value="1" name="fees-mark"> 50,000 per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==2) echo "checked";?> value="2" name="fees-mark"> 1 Lac per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==3) echo "checked";?> value="3" name="fees-mark"> 1.5 lac per pear</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==4) echo "checked";?> value="4" name="fees-mark"> 2 lac per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==5) echo "checked";?> value="5" name="fees-mark"> No preference</li>

           </ul>
        </div>        
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter7">
        <div class="filter-box-head">
          <button type="button" class="close" onclick="filteropen(7)">&times;</button>
          Chose the hostel facilities
        </div>
        <div class="col-xs-12">
          <label>Select the required hostel facilities</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['hostel']==1) echo "checked";?> value="1" name="hostel"> Boys Hostel</li>
              <li><input type="radio" <?php if($_POST['hostel']==2) echo "checked";?> value="2" name="hostel"> Girls Hostel</li>
              <li><input type="radio" <?php if($_POST['hostel']==0) echo "checked";?> value="0" name="hostel"> Hostel not necessary</li>
           </ul>
        </div>        
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter8">
        <div class="filter-box-head">
          <button type="button" class="close" onclick="filteropen(8)">&times;</button>
          Accessibility of college
        </div>
        <div class="col-xs-12">
          <label>Rural or urban colleges</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['connectivity']==1) echo "checked";?> value="1" name="connectivity"> Urban </li>
              <li><input type="radio" <?php if($_POST['connectivity']==2) echo "checked";?> value="2" name="connectivity"> Rural</li>
              <li><input type="radio" <?php if($_POST['connectivity']==3) echo "checked";?> value="3" name="connectivity"> No preference</li>
           </ul>
        </div>  
         <div class="col-xs-12">
          <label>College transport:</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['transport']==1) echo "checked";?> value="1" name="transport">Required </li>
              <li><input type="radio" <?php if($_POST['transport']==2) echo "checked";?> value="2" name="transport">Not required</li>
           </ul>
        </div>        
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
      <div class="filter-box" id="filter9">
        <div class="filter-box-head">
          <button type="button" class="close" onclick="filteropen(9)">&times;</button>
          Financial benefits from college
        </div>
        <div class="col-xs-12">
          <label>Scholarships :</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['scholarships']==1) echo "checked";?> value="1" name="scholarships"> Required</li>
              <li><input type="radio" <?php if($_POST['scholarships']==2) echo "checked";?> value="2" name="scholarships"> Not required</li>
           </ul>
        </div>  
         <div class="col-xs-12">
          <label>Educational Loans provided by college:</label>
           <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['loans']==1) echo "checked";?> value="1" name="loans"> Required</li>
              <li><input type="radio" <?php if($_POST['loans']==2) echo "checked";?> value="2" name="loans"> Not required</li>
           </ul>
        </div>        
        <div class="go-btn-container">
          <button class="btn btn-success">GO</button>
        </div>
      </div>
        </form>
      <div class="col-xs-9 main" id="grid-view" <?php if($map==1)  echo 'style="display:none"'; ?>>
        <div class="col-xs-12 row" style="margin:0;margin-top: 39px;padding-right:4px;padding-left:1px">
              <div class="col-md-12"><div style="float:left;font-size:1.2em"><?php 
              if($_POST['search']=='keyword')
                echo "<b>Showing best possible matches for keyword <span class=\"match-show\">\"".$_POST['value']."\"</span></b>";
              else if($perfect_college>0) {
                echo "<b>".$count." Matches for </b>";
                  

                }
                elseif ($count) {
                    echo "<b>No direct matches. Showing results for </b>";
               

                 } 
                  else {
                    echo "<b>No result found for </b>";

                  }
                       $t=0;
                    if($_POST['location-weight']>0&&$state!='')
                    {
                      echo "<span class=\"match-show1\">\"".$state."\"</span>";
                      $t=1;
                    }
                    if($_POST['location-weight']>0&&$address!='')
                    {
                      if($t==1){
                        echo " or ";
                        $t=0;
                      }
                      echo "<span class=\"match-show1\">\"".$address."\"</span>";
                      $t=1;
                    }
                    if($_POST['exam-weight']>0&&isset($_POST['exam']))
                    {
                      if($_POST['exam']!=''){
                         if($t==1){
                            echo " or ";
                            $t=0;
                          }
                        echo "<span class=\"match-show1\">\"".$_POST['exam']."\"</span>";
                        $t=1;
                      }
                    }
                    if($_POST['department-weight']>0&&$department!='')
                    {
                      if($t==1){
                        echo " or ";
                        $t=0;
                      }
                      $toshow=mysqli_fetch_assoc(mysqli_query($con,"select * from departments where `key` = '".$department."'"))['value'];
                      echo "<span class=\"match-show1\">\"".$toshow."\"</span>";
                      $t=1;
                    }
                    if(isset($_POST['typeofcollege']))
                    {
                      if($_POST['typeofcollege']!='none'){
                         if($t==1){
                            echo " or ";
                            $t=0;
                          }
                        echo "<span class=\"match-show1\">".$_POST['typeofcollege']." College</span>";
                        $t=1;
                      }
                    }
                    if(isset($_POST['govt']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">\"Government College\"</span>";
                      $t=1;
                      
                    }
                    if(isset($_POST['private']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">\"Private College\"</span>";
                      $t=1;
                      
                    }
                    if(isset($_POST['autonomous']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">\"Autonomous College\"</span>";
                      $t=1;
                      
                    }
                ?>
                </div>
                  <button style="float:right" class="btn btn-primary" onclick="openonmap(1)">Map View</button>
                </div>
              <!--div class="col-md-4" style="text-align:left;padding-right:0px;margin-right:0px"><button  class="btn page-view-btn" id="change-view" disabled>Map View<sup>*</sup></button>  </div-->
        </div>
        <div class="col-xs-12 row" >
       
        </div>
        <div id="college-container" style="overflow: auto;">
        <?php
           
        ?>
        </div>
         <div class="col-xs-12 row page-btn">
            <div class="prev-btn col-xs-6">
                <button class="btn btn-active btn-fail prev-btnp">Prev</button>
            </div>
            <div class="next-btn col-xs-6">
                <button class="btn btn-active next-btnp">Next</button>
            </div>
        </div>
      </div>
      <?php
      if($map==1){
        echo '<div class="col-xs-9 main" id="map-view">
      <div class="col-xs-12 row" style="margin:0;margin-top: 39px;padding-right:4px;padding-left:1px">
                <div class="col-md-12"><div style="float:left;font-size:1.2em">';
                if($_POST['search']=='keyword')
                echo "<b>Showing best possible matches for keyword <span class=\"match-show\">\"".$_POST['value']."\"</span></b>";
              else if($perfect_college>0) {
                echo "<b>".$count." Matches for </b>";
                  

                }
                elseif ($count) {
                    echo "<b>No direct matches. Showing results for </b>";
               

                 } 
                  else {
                    echo "<b>No result found for </b>";

                  }
                       $t=0;
                    if($_POST['location-weight']>0&&$state!='')
                    {
                      echo "<span class=\"match-show1\">\"".$state."\"</span>";
                      $t=1;
                    }
                    if($_POST['location-weight']>0&&$address!='')
                    {
                      if($t==1){
                        echo " or ";
                        $t=0;
                      }
                      echo "<span class=\"match-show1\">\"".$address."\"</span>";
                      $t=1;
                    }
                    if($_POST['exam-weight']>0&&isset($_POST['exam']))
                    {
                      if($_POST['exam']!=''){
                         if($t==1){
                            echo " or ";
                            $t=0;
                          }
                        echo "<span class=\"match-show1\">\"".$_POST['exam']."\"</span>";
                        $t=1;
                      }
                    }
                    if($_POST['department-weight']>0&&$department!='')
                    {
                      if($t==1){
                        echo " or ";
                        $t=0;
                      }
                      $toshow=mysqli_fetch_assoc(mysqli_query($con,"select * from departments where `key` = '".$department."'"))['value'];
                      echo "<span class=\"match-show1\">\"".$toshow."\"</span>";
                      $t=1;
                    }
                    if(isset($_POST['typeofcollege']))
                    {
                      if($_POST['typeofcollege']!='none'){
                         if($t==1){
                            echo " or ";
                            $t=0;
                          }
                        echo "<span class=\"match-show1\">".$_POST['typeofcollege']." College</span>";
                        $t=1;
                      }
                    }
                    if(isset($_POST['govt']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">Government College</span>";
                      $t=1;
                      
                    }
                    if(isset($_POST['private']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">Private College</span>";
                      $t=1;
                      
                    }
                    if(isset($_POST['autonomous']))
                    {
                        if($t==1){
                          echo " or ";
                          $t=0;
                        }
                      echo "<span class=\"match-show1\">Autonomous College</span>";
                      $t=1;
                      
                    }
                    echo '</h4></div></div>
                  <button style="float:right" class="btn btn-primary" onclick="openonmap(0)">Grid view</button>';
        echo '
          <div id="googleMap" style=""></div>
        </div>';
      }
      else
        echo '<div class="col-xs-9 main" id="map-view" style="display:none;padding-top:100px;text-align:center" >
        <blockquote><h3>Coming Soon</h3></blockquote>
      </div>';
      ?>
    </div>
    </div>
    <?php
    
    echo '
    <div class="col-xs-12 second-bottom" id="second-bottom"';
    if($map==1)
      {echo "style=\"display:none;padding-left:25%;\"";}
    echo ' style="padding-left:25%;">
       <form action="compare.php" id="compare-form">
        <div class="col-xs-2 compare-box empty-box" id="compare1">
        <i style="position:absolute;right:10px;top:7px" class="fa fa-times removecomp"></i>
        Add College
        </div>
         <div class="col-xs-2 compare-box empty-box" id="compare2">
         <i style="position:absolute;right:10px;top:7px" class="fa fa-times removecomp"></i>
        Add College
        </div>
         <div class="col-xs-2 compare-box empty-box" id="compare3">
         <i style="position:absolute;right:10px;top:7px" class="fa fa-times removecomp"></i>
        Add College
        </div>
         <div class="col-xs-2 compare-box empty-box" id="compare4"> 
         <i style="position:absolute;right:10px;top:7px" class="fa fa-times removecomp"></i>
        Add College
        </div>
        <div class="col-xs-2 compare-box btn-box" id="compare4">
        <button class="btn btn-default"><strong>Compare now</strong></button>
        </div>
        </form>
    </div>';
    ?>
    <!--div class="saved-college">
      <h4>Saved colleges</h4>
    </div-->
<?php
  include "footer.php";
?>
  <?php
  if($map==1){
echo '<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>';}
?>
<script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript">
function collegefn(name, position, rating,link){
  this.name = name;
  this.position = position;
  this.rating = rating;
  this.link = link;
}
var colleges_map = [];
var map;
<?php
$i=0;
  if($map==1){
    if(isset($total_data)){
      foreach ($total_data as $key => $row) {
        if($row['score']==0)
          break;
        if($row['latitude']!=0){
          if($row['score']==$maxm)
            $score=10;
          else
            $score=0;
           //$score=(int)(($row['score']/$maxm)*10);
          echo "var temp= new collegefn(\"".$row['name']."\",new google.maps.LatLng(".$row['latitude'].",".$row['longitude']."),".$score.",'".$row['link']."');
          ";
          echo "colleges_map.push(temp);
          ";
          $i+=1;
          }
       }
     }
     else
     {
        foreach ($colleges as $key) {
           $q=mysqli_query($con,"select * from college_id where disabled='1' && cid=".$key);
           if(mysqli_num_rows($q)==0)
            continue;
           $row=mysqli_fetch_assoc($q);
        }
     }
     echo "var total_college=".$i.";";
    }
?>
  </script>
  <?php
  if($map==1)
  {
  echo '<script type="text/javascript" src="js/map-search.js"></script>';
  }?>
<script type="text/javascript">
    var colleges=[];
    var csores=[];
    <?php
    if(isset($total_data)){
         $i=0;
         foreach ($total_data as $key => $row) {
            if(isset($_POST['fees-mark'])&&$_POST['fees-mark']!="5"){
            if($row['gross_fees']>$_POST['fees-mark']*50000)
              continue;
            }
            if(isset($_POST['hostel'])){
              if($_POST['hostel']=='1'&&$row['boys_hostel']==0)
                continue;
            if($_POST['hostel']=='2'&&$row['girls_hostel']==0)
                continue;
            }
            if(isset($_POST['transport'])){
              if($_POST['transport']=='1'&&$row['transport']=='0')
                continue;           
            }
            if(isset($_POST['scholarships'])){
              if($_POST['scholarships']=='1'&&$row['scholarship']=='0')
                continue;           
            }
            $cid=$row['cid'];
            $str= '<div class="college-box col-xs-3"  id="'.$row['link'].'">';
            if(file_exists("data/data/".$cid."/logo.png"))
                $f="data/data/".$cid."/logo.png";
            else
                $f="img/center-icon.jpg";

            if($row['state']=='--Select State--'||$row['state']=="")
                $state="India";             
            else
                $state=$row['state'];

            if($row['university']=='')
                $univ="---";                
            else
                $univ=$row['university'];

            if($row['type']==''||$row['type']=='-Not Selected-')
                $type="---";                
            else
               $type=$row['type']." College";

            if($row['city']!=""){
            	$cityc=$row['city'].", ";
            }
            else
            	$cityc="";
            $str.= '<div class="top-box"><div class="col-xs-12 logo-div"><img src="'.$f.'" class="logo-img" title="'.$row['name'].'"></div>';
            $str.= '<div class="college-name" title="'.$row['name'].'"><a target=_blank href="college/'.$row['link'].'">'.$row['name'].'</a></div>';
            $str.= '<div class="orange-state">'.$cityc.$state.'</div>';
            $score=(int)(($row['score']/$maxm)*10);
            $score=min($score*10,100);
            if($score==100){
              $str.= "<img class='p100' src='img/100.png'>";
              $test=10;
            }
            else
              $test=1;
            $str.= '<div class="univ">'.$type.'</div>';
            if($available_depts&&sizeof($row['depts'])>0)
            {
              $row['depts']=array_unique($row['depts']);
              $str.='<div class="depts" id="'.$row['cid'].'-dept" onclick="$(\'#'.$row['cid'].'-dept\').fadeToggle()">';
            $str.= '<div class="college-name" title="'.$row['name'].'"><a style="color:#333" target=_blank href="data/cp.php?cid='.$row['link'].'">'.$row['name'].'</a></div>';

              $str.="<div class='close'style='color:#fff;margin-top:-15px;margin-right:-15px;' onclick='$(\"#".$row['cid']."-dept\").fadeToggle()'>&times;</div>"; 
              $i=1;
                foreach ($row['depts'] as $key) {
                  $str.=$i.". ".$key."<br>";
                  $i+=1;
                }
              $str.='</div>';
            }
            if($available_depts&&sizeof($row['depts'])>0)
            {
              $str.="<button onclick='$(\"#".$row['cid']."-dept\").fadeToggle()' class='dept-btn' style='border:0px;margin-top:4px;max-height:44px;margin-bottom:-5px'>Click here to see<br> available departments";
                
              $str.='</button>';
            }
            else{
              $str.= '<div class="col-md-12 row" style="margin-top:16px;margin-bottom:-5px">';

              if($row['boys_hostel']==1||$rows['girls_hostel']==1)
              $str.= '<div class="col-md-3 "><img src="img/hostel-icon.png"></div>';
              else
              $str.= '<div class="col-md-3  "><img src="img/hostel-icon.png"></div>';
              
              if($row['transport']==1)
                $str.= '<div class="col-md-3"><img src="img/transport-icon.png"></div>';
              else
                $str.= '<div class="col-md-3"><img src="img/transport-icon.png"></div>';

              if($row['scholarship']==1)
                $str.= '<div class="col-md-3"><img src="img/fees-icon.png"></div>';
              else
                $str.= '<div class="col-md-3"><img src="img/fees-icon.png"></div>';
              
              if($row['internet']==1)
                $str.= '<div class="col-md-3"><img src="img/internet-icon.png"></div>';
              else
                $str.= '<div class="col-md-3 "><img src="img/internet-icon.png"></div>';
              $str.= '</div>';
            }
            $str.='</div>';
            $str.= '<div class="bottom-box"><button class="btn btn-add-list" onclick="addtocompare(\''.$row['link'].'\')">Add to Compare</button></div>';
            $str.= '</div>';
            if($row['score']>0){
              echo "colleges.push('".mysqli_real_escape_string($con,$str)."');\n";
              echo "csores.push(".$test.");";
              $i+=1;
              if($i>50)
                break;
            }
        }
      }
      else
    {
         $i=1;
       
       foreach ($colleges as $key) {
        if($i>55)
          break;
  
         $q=mysqli_query($con,"select * from college_id where disabled='1' && cid=".$key);
         if(mysqli_num_rows($q)==0)
          continue;
        $row=mysqli_fetch_assoc($q);
          
          /*  if(!in_array($row['cid'], $colleges))
                continue;*/
              echo $row['cid'];
            $cid=$row['cid'];
            $str= '<div class="college-box col-xs-3"  id="'.$row['link'].'">';
            if(file_exists("data/data/".$cid."/logo.png"))
                $f="data/data/".$cid."/logo.png";
            else
                $f="img/center-icon.jpg";

            if($row['state']=='--Select State--'||$row['state']=="")
                $state="India";             
            else
                $state=$row['state'];

            if($row['type']==''||$row['type']=='-Not Selected-')
                $type="---";                
            else
                $type=$row['type']." College";

            if($row['university']=='')
                $univ="---";                
            else
                $univ=$row['university'];

            if($row['city']!=""){
              $cityc=$row['city'].", ";
            }
            else
              $cityc="";

            $str.= '<div class="top-box"><div class="col-xs-12 logo-div"><a target=_blank href="data/cp.php?cid='.$row['link'].'"><img src="'.$f.'" class="logo-img" title="'.$row['name'].'"></div>';
            $str.= '<div class="college-name" title="'.$row['name'].'"><span>'.$row['name'].'</a></span></div>';
            $str.= '<div class="orange-state">'.$cityc.$state.'</div>';
            $str.= '<div class="univ">'.$type.'</div>';
             $str.= '<div class="col-md-12 row" style="margin-top:28px;margin-bottom:-5px">';

              if($row['boys_hostel']==1||$rows['girls_hostel']==1)
              $str.= '<div class="col-md-2 col-md-offset-1"><i style="color:rgb(0, 4, 111)" title="Hostel Facilities" class="fa fa-building-o fa-lg"></i></div>';
              else
              $str.= '<div class="col-md-2 col-md-offset-1"><i style="color:#999" title="Hostel Facilities" class="fa fa-building-o fa-lg"></i></div>';
              
              if($row['transport']==1)
                $str.= '<div class="col-md-2"><i style="color:rgb(0, 4, 111)" title="Transport Facilities" class="fa fa-truck fa-lg"></i></div>';
              else
                $str.= '<div class="col-md-2"><i style="color:#999" title="Transport Facilities" class="fa fa-truck fa-lg"></i></div>';

              if($row['scholarship']==1)
                $str.= '<div class="col-md-2"><i style="color:rgb(0, 4, 111)" title="Scholarship" class="fa fa-rupee fa-lg"></i></div>';
              else
                $str.= '<div class="col-md-2"><i style="color:#999" title="Scholarship" class="fa fa-rupee fa-lg"></i></div>';
              
              if($row['internet']==1)
                $str.= '<div class="col-md-2"><i style="color:rgb(0, 4, 111)" title="Internet Facility" class="fa fa-rss fa-lg"></i></div>';
              else
                $str.= '<div class="col-md-2"><i style="color:#999" title="Internet Facility" class="fa fa-rss fa-lg"></i></div>';
              $str.= '</div>';
            $str.='</div>';
            
            $str.= '<div class="bottom-box"><button class="btn btn-add-list" onclick="addtocompare(\''.$row['link'].'\')">Add to Compare</button></div>';
            $str.= '</div>';
            echo "colleges.push('".mysqli_real_escape_string($con,$str)."');\n";
            $i+=1;
        }
      }
    ?>;
    function URLToArray(url) {
      url = url.replace("+", "%20");
      var request = {};
      var pairs = url.substring(url.indexOf('?') + 1).split('&');
      for (var i = 0; i < pairs.length; i++) {
        var pair = pairs[i].split('=');
        request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
      }
      return request;
    }
    function ArrayToURL(array) {
      var pairs = [];
      for (var key in array)
        if (array.hasOwnProperty(key))
          pairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(array[key]));
      return pairs.join('&');
    }
    <?php
      if($map==1)
        echo 'mapstatus=1;';
      else
        echo 'mapstatus=0;';
    ?>
    function openonmap(chk){
      var a=URLToArray(location.search);
      console.log(a);
      if(chk==1 &&  mapstatus==0){
        a['map']="on";
        a=ArrayToURL(a);
        a=location.origin+location.pathname+"?"+a;
        location.href=a;
      }

      if(chk==1)
        $("input[name=map]").val("on");
      if(chk==0)
        $("input[name=map]").val("off");
      $("#grid-view").toggle();
      $("#map-view").toggle();
      $("#second-bottom").toggle();
    }
    function min(a, b) {
    if(a< b) return a;
    return b;
    }   
    var page=1;
    $("#college-container").html("");
            var str="";
            for (var i = (page-1)*12; i<min(page*12, colleges.length); i++) {
                if(csores[i]<csores[i-1]){
                  var j=0;
                  while((i+j)%4!=0){
                    str+='<div class="college-box col-xs-3 empty-college-box"></div>';
                    j++;
                  }
                  str+="<br><hr class=\"col-md-12\"><div style=\"font-size:1.2em\"><b>Colleges with atleast one match</b></div>";
                  str+= colleges[i];
                }
                else
                  str+= colleges[i];
            }
            $("#college-container").append(str);
    if(colleges.length==0){
        $("#college-container").html("<br><h4><br><br><blockquote>To Start searching colleges select some filters in the left and click on the button GO</blockquote></h4>");
    }
    if(colleges.length<=12)
      $(".next-btnp").addClass('btn-fail');
</script>
<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript">
  setcity();
</script>
</body>
</html>
