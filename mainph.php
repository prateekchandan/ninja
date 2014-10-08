<?php
include 'php/dbconnect.php';
  $colleges=[];
  function clean($string) {
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
            $link=mysqli_fetch_assoc($q)['link'];
            header("Location:./data/cp.php?cid=".$link);
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
?>

<html lang="en">
<head>
    <title>Infermap</title>
    <meta name="title" content="Infermap - Next Generation Education Portal">
    <meta name="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="Infermap - Next Generation Education Portal"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/social.png"/>
    <meta property="og:url" content="http://www.infermap.com"/>
    <meta property="og:description" content="Infermap is a free comprehensive platform 
        that improves the college selecting process, based on individual resources and 
        requirements. Inspired by a belief that all students deserve access to good guidance, 
        infermap aims to create the interactive tools and media that guide students as they find,
         afford and enroll in a college that’s a good fit for them."/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="Infermap - Next Generation Education Portal">
    <meta itemprop="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/main-phone.css"/>

</head>
<body>
  <div href="#" id="brand-img">
    <a href="http://www.infermap.com">
      <img src="./img/logo-header.png">
    </a>
  </div>
  <ul class="top-bar">
    <li>
      <a href="./main.php">Search College</a>
    </li>
    <li>
      <a href="./compare.php">Compare Colleges</a>
    </li>
    <li>
      <a href="./guide.php">Plan My College</a>
    </li>
  </ul>

  <div class="second-bar">
    <form method="get" action="./main.php" id="search-form">
      <input type="hidden" name="search" value="keyword">
      <input type="text" name="value" id="keyword-value" placeholder="Type here to search college">
      <button class="searchbar-btn"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <div class="sidebar">
    <div class="marker" id="marker">
      <b><i class="fa fa-2x fa-bars"></i></b>
    </div>
    <form>
      <input type="hidden" value="side-filter" name="search">
      <ul class="sidebar-list">
        <li>
          <a class="filter-name" onclick="filteropen(1)">            
            <div class="tab-selector <?php   
                      if($state!=""||$address!="")
                        echo 'tab-selector-active ';
                    ?>
                    ">
            </div>
            Location Search
          </a>
        </li>
        <li class="filter-content" id="filter1">
          <a>
            <h4>Search college by state or city:</h4>
            <div class="row">
              <div class="col-md-4">State: </div>
              <div class="col-md-8">
                <select class="form-control" name="state" id="location-state" onchange="setcity()">
                  <option value=''>Select State</option>
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
            <div class="row">
              <div class="col-md-4">City: </div>
              <div class="col-md-8">
                <select class="form-control" name="city" id="location-city">
                </select>
              </div>
            </div>
            <hr> 
            <h4>Or select a landmark and give radius to find college within it</h4> 
            <div class="row">
              <div class="col-md-4">Landmark / Location : </div>
              <div class="col-md-8">
                 <input class="form-control" placeholder="Ex : IIT Bombay" name="address" id="location-address" value="<?php echo $address;?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">Kilometres: </div>
              <div class="col-md-8">
                <input class="form-control" placeholder="Ex : 20" type="number" id="location-distance" name="distance" value="<?php 
                  if($distance=='')
                    echo '0';
                  else
                  echo $distance;
                  ?>">
              </div>
            </div>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(2)">            
            <div class="tab-selector <?php   
                      if($exam!="")
                        echo ' tab-selector-active ';
                    ?>">
            </div>
            EXAM
          </a>
        </li>
        <li class="filter-content" id="filter2">
          <a>
            <h4>Modify the exam taken and your rank to refine your search</h4>
            <div class="row">
              <div class="col-md-4">Exam: </div>
              <div class="col-md-8">
                <select class="form-control" id="exam-search" name="exam">
                  <option value="">Select exam</option>
                    <?php
                      $q=mysqli_query($con,"select distinct name from exam where  eid = '1' || eid='2' || eid='5' || eid='11' || eid='21' || eid='29' || eid='39' || eid='28' || eid='38' order by name");
                      while($row=mysqli_fetch_assoc($q))
                      {
                         if($exam==$row['name'])
                          echo "<option selected>".$row['name']."</option>";
                        else
                        echo "<option>".$row['name']."</option>";
                      }
                    ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">Your rank (Optional): </div>
              <div class="col-md-8">
                <input type="number" class="form-control" placeholder="rank" name="rank" value="<?php echo $rank; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">Your Category: </div>
              <div class="col-md-8">
                <select class="form-control" id="exam-category" name="category">
                  <option value="">Select Category</option>
                </select>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(3)">            
            <div class="tab-selector <?php   
                      if($department!="")
                        echo 'tab-selector-active ';
                    ?>">
            </div>
            DEPARTMENT
          </a>
        </li>
        <li class="filter-content" id="filter3">
           <a>
            <h4>Chose your field of study</h4>
            <div class="row">
              <div>Select department: </div>
              <div>
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
            </div>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(4)">            
            <div class="tab-selector ?php   
                      if(isset($_POST['govt'])||isset($_POST['private'])||isset($_POST['autonomous']))
                        echo ' side-ticker-active ';
                    ?>">
            </div>
            TYPE OF COLLEGE
          </a>
        </li>
        <li class="filter-content" id="filter4">
          <a>
            <div>
              <h4>What type of college you prefer :</h4>
               <ul style="list-style:none">
                  <li><input type="checkbox" <?php if(isset($_POST['govt'])) echo "checked";?> name="govt"> Government Colleges</li>
                  <li><input type="checkbox" <?php if(isset($_POST['autonomous'])) echo "checked";?> name="autonomous"> Autonommous Colleges</li>
                  <li><input type="checkbox" <?php if(isset($_POST['private'])) echo "checked";?> name="private"> Private Colleges</li>
               </ul>
            </div>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(5)">            
            <div class="tab-selector">
            </div>
            FEES
          </a>
        </li>
        <li class="filter-content" id="filter5">
          <a>
            <h4>
              What fees limit is affordable to you :
            </h4>
            <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['fees-mark']==1) echo "checked";?> value="1" name="fees-mark"> 50,000 per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==2) echo "checked";?> value="2" name="fees-mark"> 1 Lac per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==3) echo "checked";?> value="3" name="fees-mark"> 1.5 lac per pear</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==4) echo "checked";?> value="4" name="fees-mark"> 2 lac per year</li>
              <li><input type="radio" <?php if($_POST['fees-mark']==5) echo "checked";?> value="5" name="fees-mark"> No preference</li>
           </ul>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(6)">            
            <div class="tab-selector">
            </div>
            Hostel Facilities
          </a>
        </li>
        <li class="filter-content" id="filter6">
          <a>
            <h4>Select the required hostel facilities</h4>
            <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['hostel']==1) echo "checked";?> value="1" name="hostel"> Boys Hostel</li>
              <li><input type="radio" <?php if($_POST['hostel']==2) echo "checked";?> value="2" name="hostel"> Girls Hostel</li>
              <li><input type="radio" <?php if($_POST['hostel']==0) echo "checked";?> value="0" name="hostel"> Hostel not necessary</li>
           </ul>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(7)">            
            <div class="tab-selector">
            </div>
            Connectivity
          </a>
        </li>
        <li class="filter-content" id="filter7">
          <a>
            <h4>College transport</h4>
            <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['transport']==1) echo "checked";?> value="1" name="transport">Required </li>
              <li><input type="radio" <?php if($_POST['transport']==2) echo "checked";?> value="2" name="transport">Not required</li>
           </ul>
          </a>
        </li>
        <li>
          <a class="filter-name" onclick="filteropen(8)">            
            <div class="tab-selector">
            </div>
            Financial Benefits
          </a>
        </li>
        <li class="filter-content" id="filter8">
          <a>
            <h4>Scholarships :</h4>
            <ul style="list-style:none">
              <li><input type="radio" <?php if($_POST['scholarships']==1) echo "checked";?> value="1" name="scholarships"> Required</li>
              <li><input type="radio" <?php if($_POST['scholarships']==2) echo "checked";?> value="2" name="scholarships"> Not required</li>
           </ul>
          </a>
        </li>
      </ul>
      <button class="btn btn-submit"> SUBMIT</button>
    </form>
  </div>
  <div class="row">
    <?php 
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
      if($state!='')
      {
        echo "<span class=\"match-show1\">\"".$state."\"</span>";
        $t=1;
      }
      if($address!='')
      {
        if($t==1){
          echo " or ";
          $t=0;
        }
        echo "<span class=\"match-show1\">\"".$address."\"</span>";
        $t=1;
      }
      if(isset($_POST['exam']))
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
      if($department!='')
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
    ?>
  </div>
  <div class="college-container">

    <?php
      if(isset($_GET['start']))
      {
        $start=$_GET['start'];
      }
      else
      {
        $start=0;
      }
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
            $str= '<div class="college-box">';
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
            $str.= '<div class="logo-div"><img src="'.$f.'" class="logo-img" title="'.$row['name'].'"></div>';
            $str.= '<div class="college-name" title="'.$row['name'].'"><a target=_blank href="data/college-phone.php?college='.clean($row['name']." ".$row['city']).'-'.$row['link'].'">'.$row['name'].'</a></div>';
            $str.= '<div class="orange-state">'.$cityc.$state.'</div>';
            $score=(int)(($row['score']/$maxm)*10);
 
            $str.= '<div class="univ">'.$type.'</div>';
           
              $str.= '<div class="row icon-row" >';

              if($row['boys_hostel']==1||$rows['girls_hostel']==1)
              $str.= '<div class="facility-icon"><i style="color:rgb(0, 4, 111)" title="Hostel Facilities" class="fa fa-building-o fa-lg"></i></div>';
              else
              $str.= '<div class="facility-icon"><i style="color:#999" title="Hostel Facilities" class="fa fa-building-o fa-lg"></i></div>';
              
              if($row['transport']==1)
                $str.= '<div class="facility-icon"><i style="color:rgb(0, 4, 111)" title="Transport Facilities" class="fa fa-truck fa-lg"></i></div>';
              else
                $str.= '<div class="facility-icon"><i style="color:#999" title="Transport Facilities" class="fa fa-truck fa-lg"></i></div>';

              if($row['scholarship']==1)
                $str.= '<div class="facility-icon"><i style="color:rgb(0, 4, 111)" title="Scholarship" class="fa fa-rupee fa-lg"></i></div>';
              else
                $str.= '<div class="facility-icon"><i style="color:#999" title="Scholarship" class="fa fa-rupee fa-lg"></i></div>';
              
              if($row['internet']==1)
                $str.= '<div class="facility-icon"><i style="color:rgb(0, 4, 111)" title="Internet Facility" class="fa fa-rss fa-lg"></i></div>';
              else
                $str.= '<div class="facility-icon"><i style="color:#999" title="Internet Facility" class="fa fa-rss fa-lg"></i></div>';
              $str.= '</div>';
            
            $str.='</div>';
            if($row['score']>0){

              $i+=1;

              if($i>$start)
              echo $str;

              if(($i-$start)>=8)
              {
                break;
              }
            }
        }
      }
    ?>

  </div>
  <script type="text/javascript">
    var states=<?php echo json_encode($sta); ?>;
    var city=<?php echo "'".$city."'"; ?>;
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
                  $exam=mysqli_query($con,"select * from exam where  eid = '1' || eid='2' || eid='5' || eid='11' || eid='21' || eid='29' || eid='39'");
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
    <?php
      echo "var category='".$category."';";
    ?>
  </script>
  <script type="text/javascript">
    var marker=document.getElementById('marker');
    var sidebar=document.getElementsByClassName('sidebar');
    var sidebarpos=-60;
    marker.onclick=function(){
      var cur = sidebarpos;
      if(sidebarpos==-60)
        sidebarpos=0;
      else
        sidebarpos=-60;

      function shift(){
        if(cur>sidebarpos)
          cur--;
        else
          cur++;

        sidebar[0].style.left=cur+"%";

        if(cur==sidebarpos)
        clearInterval(id)

      }
      var id = setInterval(shift, 1)  
    }

    function filteropen(i){
        for (var j = 8; j >= 1; j--) {
          if(i!=j)
          document.getElementById('filter'+j).style.display='none';
        };
        var box=document.getElementById('filter'+i);
        console.log(box.style.display);
        box.style.display = (box.style.display == 'none' || box.style.display == '') ? 'block' : 'none';
    }
      
    // Function to set city
    function setcity(){
      var stateval=document.getElementById('location-state').value;
      if(stateval==""){
        document.getElementById('location-city').innerHTML="<option value=''>Select city</option>";
      return;
      }
      var cities=states[stateval];
      var str="<option value=''>Select city</option>";
      for (var i = cities.length - 1; i >= 0; i--) {
        if(cities[i]==city){
          str+="<option selected>"+cities[i]+"</option>";
        }
        else
         str+="<option>"+cities[i]+"</option>";
      };
      document.getElementById('location-city').innerHTML=str;
      document.getElementById('location-address').value="";
      document.getElementById('location-distance').value="";
    }

    function stateclear(){
      document.getElementById('location-state').value='';
      document.getElementById('location-city').innerHTML="<option value=''>Select city</option>";
    }
    document.getElementById('location-address').onkeyup=stateclear;
    document.getElementById('location-distance').onkeyup=stateclear;
    setcity();
    function setcategory(){
      var examval=document.getElementById("exam-search").value;
      var categoryobj=document.getElementById('exam-category');
      if(examval==""){
       categoryobj.innerHTML="<option value=''>Select Category</option>";
       return;
      }
       var cat=exams[examval][1],str="<option value=''>Select Category</option>";
      for (var i = 0; i < cat.length; i++) {
      if(cat[i]==category){
       str+="<option selected value='"+cat[i]+"'>"+categories[cat[i]]+' ('+cat[i]+')'+"</option>";
       category='';
       }
      else
       str+="<option value='"+cat[i]+"'>"+categories[cat[i]]+' ('+cat[i]+')'+"</option>";
      };
      categoryobj.innerHTML=str;
    }
    document.getElementById('exam-search').onchange=setcategory;
    setcategory();
  </script>
</body>