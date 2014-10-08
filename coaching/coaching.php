<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","coaching") or die(mysql_error());
function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'InfermaNKJs98';
    $secret_iv = 'SecretInfermap';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

session_start();
$auth=false;
    if(!isset($_SESSION['coachingid'])){
        if(!isset($_GET['coaching'])){
            header("Location:./");
        }
    }
    if(isset($_SESSION['coachingid'])&&!isset($_GET['coaching']))
    {
        $cid=$_SESSION['coachingid'];
        $q=mysqli_query($con,"select * from coaching where link='".$cid."'");
        $data=mysqli_fetch_assoc($q);
         $auth=true;
    }
    else if(isset($_SESSION['coachingid'])) {
        $link=mysqli_real_escape_string($con,$_GET['coaching']);
         $q=mysqli_query($con,"select * from coaching where link='".$link."'");
         if(mysqli_num_rows($q)<=0)
            header("Location:./");

        $data=mysqli_fetch_assoc($q);

        if($data['id']==$_SESSION['coachingid'])
            $auth=true;

        $cid=$data['id'];
    }
    else{
         $link=mysqli_real_escape_string($con,$_GET['coaching']);
         $q=mysqli_query($con,"select * from coaching where link='".$link."'");
         if(mysqli_num_rows($q)<=0)
            header("Location:./");

        $data=mysqli_fetch_assoc($q);
        $cid=$data['id'];
    }

$name=$data['name'];
$advselection=$data['advselection'];
$adv10=$data['adv10'];  
$adv100=$data['adv100'];  
$adv500=$data['adv500'];  
$adv1000=$data['adv1000'];  
$adv2000=$data['adv2000'];  
$mainselection=$data['mainselection'];
$main10=$data['main10'];  
$main100=$data['main100'];  
$main500=$data['main500'];  
$main1000=$data['main1000'];  
$main2000=$data['main2000']; 

$path="data/".$cid."/";
$path_chk="data/".$cid."/";
$default_path="data/default/";
function fetch_data($path_to_file)
{
  $str='';
    if(file_exists($path_to_file))
    {
      //$file = fopen($path_to_file, "r");
         $str.=file_get_contents($path_to_file);
          $str = iconv("UTF-8", "ASCII//TRANSLIT", $str);
      //fclose($file);
      $str=trim($str);
      return $str;
      }
    else
      return $str;
}
$website= fetch_data($path_chk."contact/weblink.txt");
 if($website=="")
    $website="#";
 if(substr($website,0,4)!="http"&&substr($website,0,3)!="ftp"&&$website!="#")
                                  $website="http://".$website;
if(file_exists($path_chk."logo.png") )
{
  $logo =$path."logo.png";
}
else
{
  $logo =$default_path."logo.png";
}
$auth=0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Infermap | <?php  echo $name;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="coaching,Education,Shivam Mittal,Search,Query,About coaching,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css"/>
    <link href="fonts/googleapi.css" rel="stylesheet"/>
    <link href="css/redit.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/blueimp_gallery.min.css">
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
    <noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
    <link href="css/coaching-profile.css" rel="stylesheet">
    <style type="text/css">
        .col-md-12{
            overflow: auto;
        }
    </style>
</head>
<body>
    <?php if($auth){
    echo '
    <div id="notificationspot"></div>
    <button id="feedbackbtn" class="btn btn-success">Feedback</button>
    <div id="feedbackpot">
        <h3>Give Your Feedback</h3>
        <form style="padding-top:20px;border-top:1px solid #ddd" role="form" id="feedback-form">
          <div class="form-group" id="feedback-sub">
            <label for="feedback-subject">Subject: *</label>
            <input type="name" class="form-control" name="feedback-subject" id="feedback-subject" placeholder="Subject">
          </div>
          <div class="form-group">
            <label for="feedback-email">Email:</label>
            <input type="email" class="form-control" name="feedback-email" id="feedback-email" placeholder="Enter email">
          </div>
           <div class="form-group" id="feedback-message">
            <label for="feedback-msg">Message: *</label>
            <textarea class="form-control" rows="3" id="feedback-msg" name="feedback-msg" placeholder="Write something...."></textarea>
           </div>
          <br>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div id="waiting" style="display:none">
        <div style="margin-top:250px">Please wait while the page is being saved
        </div>
    </div>';}
    ?>
    <style type="text/css">
        .brand-image{
      position: fixed;
      top:0px;
      left: 120px;
      z-index: 10000;
      height: 100px;
    }
    </style>
     <a href="http://www.infermap.com"><img src="../img/logo-header.png" class="brand-image"></a>
    <nav class="navbar-collapse navbar-fixed-top" role="navigation" style="min-height:35px;">
        <div class="navbar-brand" href="#">
            <a href="http://www.infermap.com">
               <div style="width:200px"></div>
            </a>
        </div>
        <ul class="nav navbar-nav" style="margin-left:20%;">
            <li class="">
                <a href="../" data-toggle="modal">Home</a>
            </li>
            <li class="">
                <a href="#" data-target="#instruction" data-toggle="modal">Instruction</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
         <?php  if($auth){
                echo '
            <li id="notifications" style="">
                <a id="notificationslink" onclick="togglenotifications()">
                    <div style="position:relative">
                        <i style="font-size:1.3em" class="fa  fa-bell"></i>
                        <span id="notificationsbadge"  class="badge">0</span>
                </div>
                </a>
            </li>
            
            <li id="nav-login-btn" class="">
                <a href="php/logout.php"">
                    <i class="fa fa-logout"></i>Logout
                </a>
            </li>';} ?>
         </ul>
    </nav>
    <ul id="coaching-nav-tabs" class="nav nav-tabs">
      <li class="active" style="width:10%;margin-left:15%">
        <a href="#coaching-nav-about" data-toggle="tab">
            ABOUT 
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:9%">
        <a href="#coaching-nav-results" data-toggle="tab">
            RESULTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:9%">
        <a href="#coaching-nav-courses" data-toggle="tab">
            BATCHES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:10%">
        <a href="#coaching-nav-faculty" data-toggle="tab">
            FACULTY
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:16%">
        <a href="#coaching-nav-fees" data-toggle="tab">
            ADMISSION & FEES
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%;">
        <a href="#coaching-nav-teaching" data-toggle="tab">
           TEACHING METHODOLOGY 
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:11%;border-right:1px solid #BBB">
        <a href="#coaching-nav-contacts" data-toggle="tab">
            CONTACTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
    </ul>
    <div class="container coaching-head ">
        <div class="col-lg-10">
            <h1 id="coaching-name" name="coaching-name"  <?php 
        if($auth){ echo 'contenteditable="true"';}?>><?php echo $name;?></h1>
         <?php 
        if($auth){
        echo '<div class="coaching-website-link">Website : ';
            echo "<a id=\"coaching-website\" href=\"".$website."\" target=_blank>";
            if($website=="#")echo "Link for website"; else echo $website; 
            echo "</a>";
        
         echo '   <button id="link-edit-btn" title="Edit these links" class="btn-primary" onclick=\'$(".except-web").css("display","none");\' style="margin-bottom:0px;width:25px;height:25px;margin-left:5px" data-toggle="modal" data-target="#link-edit"><i class="fa fa-edit fa-sm" ></i></button>
        </div>';
         } ?>
        </div>
        <div class="col-lg-2" >
        <?php if($auth){
            echo '<form enctype="multipart/form-data" id="logo-up">';
                 echo ' <input type="hidden" value="'.$cid.'" id="cid">';
                  echo ' <input type="file" id="logo-uploader" name="logo" style="display:none;position:absolute;right:0px;top:0px">
                    <p id="edit-logo-text" style="display:none;background-color:rgba(0,0,0,0.7);position:absolute;left:25%;top:20%;color:white;padding:5px;">
                        click to edit
                    </p>';}
                echo ' <img src="'.$logo.'" id="coaching-logo"></div></form>'; ?>
            
        </div>
    </div>
    <hr class="hr-full">
    <!--Contents for All the tabs -->
    <div id="myTabContent" class="tab-content">
        <!--Contents for the about tab -->
        <div class="tab-pane fade active in coaching-content" id="coaching-nav-about">
            <div class="coaching-gallery" <?php
 if(!$auth)
              echo 'style="float:right"';

            ?>>
            <?php
           if(!$auth)
            echo '<div id="carousel-foreground">
                <img src="../img/gallery.png" height="295px" width="550px">
                </div>';
                ?>
                <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
                    <h2><div style="margin:auto"><img style="width:100%" src="img/loading.gif"></div></h2>
                </div>
            </div>
            <?php if($auth){
            echo '<div class="col-md-12 coaching-gallery" ';

            echo '><br> <br>
            </div> 
            <div class="col-md-6">
                <button class="btn btn-primary" id="img-edit-btn" style="width:80% ; margin-bottom:2%;  margin-left:10% ">
                    Edit Gallery
                </button>
            </div>
            <!--div class="col-md-4">
                <button class="btn btn-primary" id="img-delete-btn" style="width:80% ; margin-bottom:2%; margin-left:10%">Delete Images
                </button>
            </div-->
            <div class="col-md-6">
                <button class="btn btn-primary" id="img-caption-edit-btn" style="width:80% ;  margin-bottom:2%; margin-left:10%">
                    Edit Images Caption
                </button>
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
            <div class="img-delete">
                Loading the images..
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
            </div>';}?>
           <?php
               $true=0;
               $about=fetch_data($path_chk."about.txt");
               $usp=fetch_data($path_chk."usp.txt");
               if($auth){
                echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                    About us
                </div>
                <div class="edit-button" id="about_coaching-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span>
                    edit
                </div>
                <div id="about_coaching" name="aboutcoaching" style="min-height:40px;">
                    '.$about.'
                </div>
                <div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                    Special Features
                </div>
                <div class="edit-button" id="usp-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="usp" name="usp" style="min-height:40px;">
                    '.$usp.'
                </div>';
            }
            else{
                if($about==''&&$usp=='')
                    echo "<blockquote>No data available</blockquote>";
                if($about!='')
                    echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                    About us
                </div>
                <div id="about_coaching" name="aboutcoaching" style="min-height:40px;">
                    '.$about.'
                </div>';
                if($usp!='')
                    echo '<div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                    Special Features
                </div>            
                <div id="dean_intro" name="dean_intro" style="min-height:40px;">
                    '.$usp.'
                </div>';
            }
              ?> 
        </div>
        <!--Contents for the admission tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-results">
            <div class="section-sub-heading">
                <img src="./img/icons/academic info.png">
                   Overall Results (Year: <?php
                    if($auth)
                   echo '<input id="year" type="number" class="form-control" value="'.$data['result_year'].'" style="width:10%;display:inline">';
                    else
                    {
                      if($data['result_year']==0)
                        echo "---";
                      else
                        echo $data['result_year'];
                    }
                    ?>
                   )
            </div>
          <div class="col-md-6">
            <div class="section-sub-sub-heading">Jee Mains:</div><br>
                <table class="table">
                            <?php
                    if($auth){            
                        echo '
                    <tr>
                        <td>
                            Overall Selection :
                        </td>
                        <td>
                            <input type="number"  id="mainselection" class="form-control" value="'.$mainselection.'">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">No of students:</th>
                    </tr>                    
                    <tr>
                    <td>
                            in top 10 :
                        </td>
                        <td>
                            <input type="number"  id="main10" class="form-control" value="'.$main10.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 100 :
                        </td>
                        <td>
                            <input type="number"  id="main100" class="form-control" value="'.$main100.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 500 :
                        </td>
                        <td>
                            <input type="number"  id="main500" class="form-control" value="'.$main500.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 1000 :
                        </td>
                        <td>
                            <input type="number"  id="main1000" class="form-control" value="'.$main1000.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 2000 :
                        </td>
                        <td>
                            <input type="number"  id="main2000" class="form-control" value="'.$main2000.'">
                        </td>
                    </tr>';
                }
                else{
                    if($mainselection==0)
                      $mainselection="--";
                        echo '<tr>
                        <td>
                            Overall Selection :
                        </td>
                        <td>
                            '.$mainselection.'
                        </td>
                    </tr>';
                    if($main10==0)
                      $main10="--";
                        echo '<tr>
                        <td>
                            in Top 10
                        </td>
                        <td>
                            '.$main10.'
                        </td>
                    </tr>';
                    if($main100==0)
                      $main100="--";
                        echo '<tr>
                        <td>
                            in Top 100
                        </td>
                        <td>
                            '.$main100.'
                        </td>
                    </tr>';
                    if($main500==0)
                      $main500="--";
                        echo '<tr>
                        <td>
                            in Top 500
                        </td>
                        <td>
                            '.$main500.'
                        </td>
                    </tr>';
                    if($main1000==0)
                      $main1000="--";
                        echo '<tr>
                        <td>
                            in Top 1000
                        </td>
                        <td>
                            '.$main1000.'
                        </td>
                    </tr>';
                    if($main2000==0)
                      $main2000="--";
                        echo '<tr>
                        <td>
                            in Top 2000
                        </td>
                        <td>
                            '.$main2000.'
                        </td>
                    </tr>';
                }
                    ?>
                </table>
          </div>
          <div class="col-md-6">
            <div class="section-sub-sub-heading">Jee Advanced:</div><br>
                 <table class="table">
                 <?php
                    if($auth){            
                        echo '
                    <tr>
                        <td>
                            Overall Selection :
                        </td>
                        <td>
                            <input type="number"  id="advselection" class="form-control" value="'.$advselection.'">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">No of students:</th>
                    </tr>                    
                    <tr>
                    <td>
                            in top 10 :
                        </td>
                        <td>
                            <input type="number"  id="adv10" class="form-control" value="'.$adv10.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 100 :
                        </td>
                        <td>
                            <input type="number"  id="adv100" class="form-control" value="'.$adv100.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 500 :
                        </td>
                        <td>
                            <input type="number"  id="adv500" class="form-control" value="'.$adv500.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 1000 :
                        </td>
                        <td>
                            <input type="number"  id="adv1000" class="form-control" value="'.$adv1000.'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            in top 2000 :
                        </td>
                        <td>
                            <input type="number"  id="adv2000" class="form-control" value="'.$adv2000.'">
                        </td>
                    </tr>';
                }
                else{
                    if($advselection==0)
                      $advselection="--";
                        echo '<tr>
                        <td>
                            Overall Selection :
                        </td>
                        <td>
                            '.$advselection.'
                        </td>
                    </tr>';
                    if($adv10==0)
                      $adv10="--";
                        echo '<tr>
                        <td>
                            in Top 10
                        </td>
                        <td>
                            '.$adv10.'
                        </td>
                    </tr>';
                    if($adv100==0)
                      $adv100="--";
                        echo '<tr>
                        <td>
                            in Top 100
                        </td>
                        <td>
                            '.$adv100.'
                        </td>
                    </tr>';
                    if($adv500==0)
                      $adv500="--";
                        echo '<tr>
                        <td>
                            in Top 500
                        </td>
                        <td>
                            '.$adv500.'
                        </td>
                    </tr>';
                    if($adv1000==0)
                      $adv1000="--";
                        echo '<tr>
                        <td>
                            in Top 1000
                        </td>
                        <td>
                            '.$adv1000.'
                        </td>
                    </tr>';
                    if($adv2000==0)
                      $adv2000="--";
                        echo '<tr>
                        <td>
                            in Top 2000
                        </td>
                        <td>
                            '.$adv2000.'
                        </td>
                    </tr>';
                }
                    ?>
                
                </table>
              </div>
            <?php   
                $display=['selection_main','selection_advance','selection_bits'];
                if($auth){
                    $str="select * from t_".$cid;
                } 
                else{
                    $str="select * from t_".$cid." where ";
                    $i=0;
                    foreach ($display as $key) {
                        if($i!=0)
                            $str.=" &&";
                        $i+=1;
                        $str.=$key."!='' ";
                    }
                }
                $q=mysqli_query($con,$str);
                if(mysqli_num_rows($q)>0||$auth){
                    echo '<div class="section-sub-heading">
                        <img src="./img/icons/academic info.png">
                       Center wise results
                    </div>';
                    if($auth){
                        echo "<div class='edit-button' id='result-table-edit-btn'>
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                        </div>
                        <div id='result-editable' style='display:none'>
                            <table class='table table-bordered mytable' id='result-table-editable'>

                            </table>               
                            <button class='btn btn-primary btn-save' id='result-table-save-btn'>SAVE</button>
                            <button class='btn btn-danger btn-save' id='result-table-cancel-btn'>CANCEL</button>
                        </div>";
                    }
                    echo '<table class="table mytable" id="result-table"><tr><td>Center</td><td>JEE Mains</td><td>JEE Advanced</td><td>BITS</td></tr>';                                  
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr><td>".$row['center']."</td>";
                        foreach ($display as $key ){
                            echo "<td>".$row[$key]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                $result=fetch_data($path_chk."resultinfo.txt");
                if($auth){
                   echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                    Detailed Results
                </div>
                <div class="edit-button" id="result-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span>
                    edit
                </div>
                <div id="result" name="result" style="min-height:40px;">
                    '.$result.'
                </div>';
                }
                else if($result!=""){
                  echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                    Detailed Results
                </div>              
                <div id="result" name="result" style="min-height:40px;">
                    '.$result.'
                </div>';
                }
            ?>
         
        </div>
        <!--Contents for the academics tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-courses">
            <?php
                $progchk=true;
                 $programoffered=fetch_data($path_chk."programoffered.txt");
                if($auth||$programoffered!=''){
                    $progchk=false;
                    echo '<div class="section-sub-heading">
                            <img src="./img/icons/about coaching.png">
                            Batches Run
                        </div>';
                    if($auth)
                    echo '<div class="edit-button" id="programoffered-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span>
                        edit
                    </div>  ';
                    echo '<div id="programoffered" style="min-height:40px;">
                        '.$programoffered.'
                    </div>';
                }
                if($progchk){
                    echo "<blockquote>No data available</blockquote>";
                }
                $display=['batch8','batch9','batch10','batch11','batch12','batch13'];  
                if($auth){
                    $str="select * from t_".$cid;
                } 
                else{
                    $str="select * from t_".$cid." where ";
                    $i=0;
                    foreach ($display as $key) {
                        if($i!=0)
                            $str.=" &&";
                        $i+=1;
                        $str.=$key."!='' ";
                    }
                }
                $q=mysqli_query($con,$str);
                if(mysqli_num_rows($q)>0||$auth){
                    $progchk=false;
                    echo '<div class="section-sub-heading">
                        <img src="./img/icons/academic info.png">
                       Center wise estimated batch-size
                    </div> ';
                    if($auth){
                        echo "<div class='edit-button' id='batch-table-edit-btn'>
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                        </div>
                        <div id='batch-editable' style='display:none'>
                            <table class='table table-bordered mytable' id='batch-table-editable'>

                            </table>               
                            <button class='btn btn-primary btn-save' id='batch-table-save-btn'>SAVE</button>
                            <button class='btn btn-danger btn-save' id='batch-table-cancel-btn'>CANCEL</button>
                        </div>";
                    }
                    echo '                
                    <table class="table mytable" id="batch-table"><tr><td>Center</td><td>8th</td><td>9th</td><td>10th</td><td>11th</td><td>12th</td><td>12th passout</td></tr>';
                              
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr><td>".$row['center']."</td>";
                        foreach ($display as $key ){
                            echo "<td>".$row[$key]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
               
            ?>
         
        </div>
        <!--Contents for the fees tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-faculty">
            <?php                
                $display=['fac_phy','fac_chem','fac_math','fac_bio'];
                if($auth){
                    $str="select * from t_".$cid;
                }  
                else{
                    $str="select * from t_".$cid." where ";
                    $i=0;
                    foreach ($display as $key) {
                        if($i!=0)
                            $str.=" &&";
                        $i+=1;
                        $str.=$key."!='' ";
                    }
                }
                $q=mysqli_query($con,$str);
                if(mysqli_num_rows($q)>0||$auth){
                    echo '<div class="section-sub-heading">
                        <img src="./img/icons/academic info.png">
                       Center wise estimated faculty-size
                    </div> ';
                    if($auth){
                        echo "<div class='edit-button' id='faculty-table-edit-btn'>
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                        </div>
                       
                        <div id='faculty-editable' style='display:none'>
                            <table class='table table-bordered mytable' id='faculty-table-editable'>

                            </table>               
                            <button class='btn btn-primary btn-save' id='faculty-table-save-btn'>SAVE</button>
                            <button class='btn btn-danger btn-save' id='faculty-table-cancel-btn'>CANCEL</button>
                        </div>";
                    }
                    echo '             
                    
                    <table class="table mytable" id="faculty-table"><tr><td>Center</td><td>Physics</td><td>Chemistry</td><td>Math</td><td>Bio</td></tr>';
                              
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr><td>".$row['center']."</td>";
                        foreach ($display as $key ){
                            echo "<td>".$row[$key]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                $display=['st_math','st_phy','st_chem','st_bio'];
                if($auth){
                    $str="select * from t_".$cid;
                }  
                else{
                    $str="select * from t_".$cid." where ";
                    $i=0;
                    foreach ($display as $key) {
                        if($i!=0)
                            $str.=" &&";
                        $i+=1;
                        $str.=$key."!='' ";
                    }
                }
                $q=mysqli_query($con,$str);
                if(mysqli_num_rows($q)>0||$auth){
                    echo '<div class="section-sub-heading">
                        <img src="./img/icons/academic info.png">
                       Center wise Student Teacher ratio
                    </div> ';
                    if($auth){
                        echo "<div class='edit-button' id='stratio-table-edit-btn'>
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                        </div>
                        <div id='stratio-editable' style='display:none'>
                            <table class='table table-bordered mytable' id='stratio-table-editable'>

                            </table>               
                            <button class='btn btn-primary btn-save' id='stratio-table-save-btn'>SAVE</button>
                            <button class='btn btn-danger btn-save' id='stratio-table-cancel-btn'>CANCEL</button>
                        </div>";
                    }
                    echo '             
                    <table class="table mytable" id="stratio-table"><tr><td>Center</td><td>Physics</td><td>Chemistry</td><td>Math</td><td>Bio</td></tr>';
                              
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr><td>".$row['center']."</td>";
                        foreach ($display as $key ){
                            echo "<td>".$row[$key]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
              
        </div>
        <!--Contents for the placements tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-fees">
            <?php
                $q=mysqli_query($con,"select * from fee_".$cid);
                $feechk=true;
                if(mysqli_num_rows($q)>0||$auth){
                    $feechk=false;
                    echo '<div class="section-sub-heading">
                            <img src="./img/icons/about coaching.png">
                            Fee structure
                        </div>';
                        if($auth){
                             echo "<div class='edit-button' id='fee-table-edit-btn'>
                                <span class='glyphicon glyphicon-pencil'></span> edit table
                            </div>                        
                            <div id='fee-editable' style='display:none'>
                                <table class='table table-bordered mytable' id='fee-table-editable'>

                                </table>               
                                <button class='btn btn-primary btn-save' id='fee-table-save-btn'>SAVE</button>
                                <button class='btn btn-danger btn-save' id='fee-table-cancel-btn'>CANCEL</button>
                            </div>";
                        }
                        echo "<table class='table table-bordered mytable' id='fee-table'><tr>
                            <td>Course</td>
                            <td>Mode</td>
                            <td>Payment 1</td>
                            <td>Payment 2</td>
                            <td>Payment 3</td>
                            <td>Payment 4</td>
                            <td>Payment 5</td>
                            <td>Payment 6</td>
                            <td>Total</td>
                        </tr>";
                        while($row=mysqli_fetch_assoc($q)){
                            echo "<tr><td>".$row['course']."</td>";
                            echo "<td>".$row['mode']."</td>";
                            for($iter=1;$iter<7;$iter++){
                                echo "<td>".$row['payment'.$iter]."</td>";
                            }
                            echo "<td>".$row['total']."</td></tr>";
                        }
                        echo "</table>";

                }   
                $testdetails=fetch_data($path_chk."testdetails.txt");       
                $scholarships=fetch_data($path_chk."scholarships.txt");
                $financebenefits=fetch_data($path_chk."financebenefits.txt");
                 if($auth||$scholarships!='')
                {
                    $progchk=false;
                    echo '<div class="section-sub-heading">
                            <img src="./img/icons/about coaching.png">
                            Admission Test Details
                        </div>';
                    if($auth)
                    echo '<div class="edit-button" id="testdetails-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span>
                        edit
                    </div>  ';
                    echo '<div id="testdetails" style="min-height:40px;">
                        '.$testdetails.'
                    </div>';
                }
                if($auth||$scholarships!='')
                {
                    $progchk=false;
                    echo '<div class="section-sub-heading">
                            <img src="./img/icons/about coaching.png">
                            Scholarships
                        </div>';
                    if($auth)
                    echo '<div class="edit-button" id="scholarships-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span>
                        edit
                    </div>  ';
                    echo '<div id="scholarships" style="min-height:40px;">
                        '.$scholarships.'
                    </div>';
                }
                if($auth||$financebenefits!='')
                {
                    $feechk=false;
                    echo '<div class="section-sub-heading">
                            <img src="./img/icons/about coaching.png">
                            Financial Benefits
                        </div>';
                    if($auth)
                    echo '<div class="edit-button" id="financebenefits-edit-btn">
                        <span class="glyphicon glyphicon-pencil"></span>
                        edit
                    </div>  ';
                    echo '<div id="financebenefits" style="min-height:40px;">
                        '.$financebenefits.'
                    </div>';
                }
                if($feechk){
                    echo "<blockquote>No data available</blockquote>";
                }

            ?>
        <div id="fee_detail" name="fee_details" style="min-height:40px;">
        </div>   
    
        </div>
        <!--Contents for the sports tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-teaching">
             <?php
               $true=0;
               $test=fetch_data($path_chk."test.txt");
               $testinfo=fetch_data($path_chk."testinfo.txt");
               $usptest=fetch_data($path_chk."usptest.txt");
               if($auth){
                echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                    Practice Methodology
                </div>
                <div class="edit-button" id="test-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span>
                    edit
                </div>
                <div id="test" name="test" style="min-height:40px;">
                    '.$test.'
                </div>
                <div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                    Test Series info and Stats
                </div>
                <div class="edit-button" id="testinfo-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="testinfo" name="testinfo" style="min-height:40px;">
                    '.$testinfo.'
                </div>
                 <div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                    USP\'s
                </div>
                <div class="edit-button" id="usptest-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="usptest" name="usptest" style="min-height:40px;">
                    '.$usptest.'
                </div>';
            }
            else{
                if($test==''&&$testinfo==''&&$usptest=='')
                    echo "<blockquote>No data available</blockquote>";
                if($test!='')
                    echo '<div class="section-sub-heading">
                    <img src="./img/icons/about coaching.png">
                        No of test in Year
                    </div>
                <div id="test" name="test" style="min-height:40px;">
                    '.$test.'
                </div>';
                if($testinfo!='')
                    echo '<div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                        Test Series info and Stats
                    </div>
                <div id="testinfo" name="testinfo" style="min-height:40px;">
                    '.$testinfo.'
                </div>';
                if($usptest!='')
                    echo ' <div class="section-sub-heading">
                    <img src="./img/icons/dean intro.png">
                    USP\'s
                </div>
                 <div id="usptest" name="usptest" style="min-height:40px;">
                    '.$usptest.'
                </div>';
               
            }
              ?> 
        </div>
        <!--Contents for the contacts tab -->
        <div class="tab-pane fade coaching-content" id="coaching-nav-contacts">
            <?php
                $contactchk=true;
                $display=['phone','address','email','alphone'];  
                if($auth){
                    $str="select * from t_".$cid;
                }
                else
                {
                    $str="select * from t_".$cid." where ";
                    $i=0;                 
                    foreach ($display as $key) {
                        if($i!=0)
                            $str.=" &&";
                        $i+=1;
                        $str.=$key."!='' ";
                    }                   
                }
                $q=mysqli_query($con,$str);
                if(mysqli_num_rows($q)>0||$auth){
                    $contactchk=false;
                    echo '<div class="section-sub-heading">
                        <img src="./img/icons/academic info.png">
                       Center-wise Contacts
                    </div> ';
                    if($auth){
                        echo "<div class='edit-button' id='contact_center-table-edit-btn'>
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                        </div>                        
                        <div id='contact_center-editable' style='display:none'>
                            <table class='table table-bordered mytable' id='contact_center-table-editable'>

                            </table>               
                            <button class='btn btn-primary btn-save' id='contact_center-table-save-btn'>SAVE</button>
                            <button class='btn btn-danger btn-save' id='contact_center-table-cancel-btn'>CANCEL</button>
                        </div>";
                    }
                    echo '             
                    
                    <table class="table mytable" id="contact_center-table"><tr><td>Center</td><td>Phone No</td><td>Address</td><td>Email</td><td>Alternate phone</td></tr>';
                              
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr><td>".$row['center']."</td>";
                        foreach ($display as $key ){
                            echo "<td>".$row[$key]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                if($contactchk){
                     echo "<blockquote>No data available</blockquote>";
                }
            ?>
            <div class="coaching-content">
               
                <div id="socials">
                    <div>
                        <a target="_blank" id="weblinka" href="#" title="Web Page">
                            <i class="fa fa-desktop fa-2x" ></i>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" id="fblinka" href="#" title="Facebook Page of coaching">
                            <i class="fa fa-facebook fa-2x" ></i>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" id="twitterlinka" href="#" title="Twitter link">
                            <i class="fa fa-twitter fa-2x" ></i>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" id="pluslinka" href="#" title="Google Plus profile">
                            <i class="fa fa-google-plus fa-2x" ></i>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" id="linkedlinka" href="#" title="Linked In">
                            <i class="fa fa-linkedin fa-2x" ></i>
                        </a>
                    </div>
                    <?php
                    if($auth)
                        echo '
                    <div>
                        <button id="link-edit-btn" title="Edit these links" class="btn btn-primary" onclick=\'$(".except-web").css("display","table-row");\' style="margin-bottom:10px" data-toggle="modal" data-target="#link-edit">
                            <i class="fa fa-edit fa-lg" ></i>
                        </button>
                    </div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if($auth)
    echo '
    <div class="modal fade" id="link-edit" tabindex="-1" role="form" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Configure Social Links
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="link-table" role="form" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Social Profile</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><i class="fa fa-desktop"></i> Web Page</td>
                                <td>
                                    <input id="weblink" name="weblink" type="url" class="form-control" placeholder="Link to coaching Web Site" style="width:100%">
                                </td>
                            </tr>
                            <tr class="except-web" style="color: rgb(19, 55, 131);">
                                <td><i class="fa fa-facebook"></i> Facebook</td>
                                <td>
                                    <input id="fblink" name="fblink" class="form-control" type="url" placeholder="Link to FB Page" style="width:100%">
                                </td>
                            </tr>
                            <tr class="except-web" style="color:rgb(8, 80, 158)">
                                <td><i class="fa fa-twitter"></i> Twitter</td>
                                <td><input id="twitterlink" name="twitterlink" type="url" class="form-control" placeholder="Link to Twitter Profile" style="width:100%"></td>
                            </tr>
                            <tr class="except-web" style="color:rgb(197, 55, 39)">
                                <td><i class="fa fa-google-plus"></i> Google Plus</td>
                                <td><input id="pluslink" name="pluslink" type="url" class="form-control" placeholder="Link to Google Plus" style="width:100%"></td>
                            </tr>
                            <tr class="except-web" style="color:rgb(60, 140, 198)">
                                <td><i class="fa fa-linkedin"></i> Linked In</td>
                                <td><input id="linkedlink" name="linkedlink" type="url" class="form-control" placeholder="Link to LinkedIn Profile" style="width:100%"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="link-save-notify" style="visibility:hidden">Saved..
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" id="link-submit" type="submit">Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="instruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color:#111;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b style="font-size:1.5em">INSTRUCTION</b>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Editing paragraphs</strong>
                        <br>
                        &emsp;&emsp;To edit paragraphs, Click on the edit button or click anywhere on the paragraph you want to edit. Use the editor to edit the information. To save the information click anywhere outside the editor.
                        <br><br><strong>Editing tabular information</strong><br>
                        &emsp;&emsp;To edit the tables, click on the edit button above the table. You can choose the headings of the table from the dropdowns that appear in the first row. To add/remove on of the rows or columns click on the +/x buttons. To cancel te changes that have been made click on the cancel button below the table. To save the change click on the save button below the table. Don\'t forget to save the changes. The changes will be lost if you leave the page without saving the changes.
                        <br><br><strong>Editing photo gallery</strong><br>
                        &emsp;&emsp;Clicking the Edit Gallery button will open up box which will allow you to add or remove photos that are being shown in the gallery. After you have made your changes hit Finish Edit button on top.
                        To add captions to your images, click on the Edit Captions button below the gallery. After finishing your edit hit Submit Captions button on top.
                        <br><i>Note : To maintain the ordering of the photos ensure that the names of teh photos is in alphabetical order</i> 
                        <br><br><strong>Changing the Logo of your coaching</strong><br>
                        &emsp;&emsp;When you hover the logo image of your coaching, a button appears at the top right corner of your image. Click on that button to add a new logo image.
                        <br><p>If you currently don\'t have any information about some tags, e.g. Dean Introduction, Rules and Regulations, don\'t write anything in the editor, just keep it blank.
                        </p>
                        <b>Note : The Changes made by you will be saved only after you click the save page button at ate bottom of the page</b>
                        If you find bugs  Please mail to infermap@gmail.com
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->';
    
    ?>
    <footer>
        <?php
        if($auth){
           echo '<button class="btn btn-success col-md-4 col-offset-4" onclick="savecoachingdata()"  style="margin-left:33%;margin-right:33%;margin-top:1%">
            Save the coaching Data
            </button>&copy; Infermap.com 2014';
        }
       ?>
    </footer>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php 
    if($auth){
    echo fetch_data("js/xml.txt");
    
    echo '<script type="text/javascript" src="js/redit.js"></script>
    <script type="text/javascript" src="js/table-editor.js"></script>
    <script src="js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
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
    <!--script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgrj58PbXr2YriiRDqbnL1RSqrCjdkglBijPNIIYrqkVvD1R4QxRl47Yh2D_0C1l5KXQJGrbkSDvXFA"
      type="text/javascript"-->
    </script>
    <script type="text/javascript" src="js/edit-page.js"></script>';}?>

    <style type="text/css">
    <?php  if(!$auth)
    echo '
#carousel-gallery {
    margin-left: 30px;
    height: 285px;
    width: 522px;
    margin-top: 5%;
}

#carousel-foreground{
  position: absolute;
  z-index: 11;
  pointer-events:none;
}
#carousel-gallery img {
    width: 100%;
    height: 285px;
}
#about_coaching{
  overflow: auto;
  max-height: 250px;
}
';
else
echo '#carousel-gallery {
    height: 450px;
    margin: auto;
    margin-top: 5%;
    border: 1px solid rgba(43, 21, 16, 0.66);
    box-shadow: 0px 0px 15px #888888;
}

#carousel-gallery img {
   width: auto;
    margin: auto;
    max-width: 100%;
    height: 448px;
}';
?>
    </style>
    <script type="text/javascript">
      
        <?php echo "var cid='".$cid."';"; 
          if(!$auth){
            echo " var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
$(window).resize(function(){
  var car_pos = $('#carousel-gallery').position();
  $('#carousel-foreground').css('left', car_pos.left+7);
  $('#carousel-foreground').css('top', car_pos.top+25);
});";
          }


        ?>


        // This function is reloads the image gallery with proper images
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
        function put_caption()
        {
            jQuery.ajax({
                url: "php/put-image-caption.php?cid="+cid,
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
        
        function get_caption()
        {
            jQuery.ajax({
                url: "php/get-image-caption.php?cid="+cid,
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
        function refresh_links(cid)
        {
            jQuery.ajax({
                        url: "php/fetch_links.php?cid="+cid,
                        type:"GET",
                        success:function(data)
                        {
                            var links=JSON.parse(data);
                            var link=['weblink','fblink','twitterlink','pluslink','linkedlink'];
                            for (var i = link.length - 1; i >= 0; i--) {
                                if(links[i])
                                {
                                    document.getElementById(link[i]).value=links[i];
                                    if(links[i].substr(0,4)!="http"&&links[i].substr(0,3)!="ftp")
                                        links[i]="http://"+links[i];
                                    document.getElementById(link[i]+'a').href=links[i];
                                    document.getElementById(link[i]+'a').target="_blank";
                                }
                                else
                                {
                                     document.getElementById(link[i]+'a').href="#";
                                     document.getElementById(link[i]+'a').target="";
                                 }
                                 if(i==0){
                                    if(links[i])
                                    {
                                        document.getElementById(link[i]).value=links[i];
                                        if(links[i].substr(0,4)!="http"&&links[i].substr(0,3)!="ftp")
                                            links[i]="http://"+links[i];
                                        <?php
                                        if($auth)
                                        echo "document.getElementById('coaching-website').href=links[i];
                                        document.getElementById('coaching-website').target='_blank';
                                        document.getElementById('coaching-website').innerHTML=links[i];";
                                        ?>
                                    }
                                    else
                                    {
                                        <?php
                                         echo 'document.getElementById("coaching-website").href="#";
                                         document.getElementById("coaching-website").target="";
                                         document.getElementById("coaching-website").innerHTML="Click button to add website";';
                                         ?>
                                     }
                                 }
                            };

                        },
                        error:function(data)
                        {
                            alert(data);
                        }
                    })
        }

        refresh_links(cid);
        refresh_gallery();
        document.addEventListener("keydown", function(e) {
          if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
           savecoachingdata();
          }
        }, false);
        <?php
        if($auth)
        echo 'load(19.5,82.3)';
        ?>
    </script>
</body>
</html>
