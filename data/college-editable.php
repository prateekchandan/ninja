<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());

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
    if(isset($_SESSION['truth']))
    {
        $uid="infermap";
    }
    else if(isset($_SESSION['datauserid']))
    {
        $uid=$_SESSION['datauserid'];
    }
    else if(isset($_GET['college']))
    {
        $_GET['link']=encrypt_decrypt('decrypt',$_GET['college']);
        $uid="infermap";
    }
    else{
         header("Location: index.php");
    }

    if(isset($_GET['link']))
    {
         $link=$_GET['link'];
        $chk=mysqli_query($con,"select * from college_id where link='".$link."'");
        if(mysqli_num_rows($chk)<1)
            header("Location: index.php");
        else{
            $cid=mysqli_fetch_assoc($chk)['cid'];
            $_SESSION['cid']=$cid;
        }
    }
    else if(isset($_SESSION['cid']))
    {
        $cid=$_SESSION['cid'];
    }
    else
    {
        header("Location: index.php");
    }
if($uid!="infermap"){
    $pages=mysqli_query($con,"select * from datafeeder where uid='".$uid."'");
    $p=json_decode(mysqli_fetch_assoc($pages)['pages'],true);
    if(!in_array($cid, $p))
       header("Location: index.php");
}
$path="data/".$cid."/";
$path_chk="data/".$cid."/";
$default_path="data/default/";
function fetch_data($path_to_file)
{
  $str="";
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
if( file_exists($path_chk."logo.png") )
{
  $logo =$path."logo.png";
}
else
{
  $logo =$default_path."logo.png";
}
$q=mysqli_query($con,'select * from college_id where cid='.$cid);
$row=mysqli_fetch_assoc($q);
$college_data=$row;
$college_name=$row['name'];  
$fee_type=$row['fee_type'];  
$college_state=$row['state'];
$college_area=$row['area'];
$college_city=$row['city'];
$college_university=$row['university'];
$college_type=$row['type'];
$college_link=$row['link'];
$catQuery=mysqli_query($con,"select * from category");
$categories=[];
$i=0;
while($row=mysqli_fetch_assoc($catQuery))
{
	$a=['id'=>$row['id'],'name'=>$row['name']];
	$categories[$i]=$a;
	$i+=1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>College-editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
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
    <link href="css/college-profile.css" rel="stylesheet">
    <style type="text/css">
        .col-md-12{
            overflow: auto;
        }
    </style>
</head>
<body>
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
    </div>
    <nav class="navbar-collapse navbar-fixed-top" role="navigation" style="min-height:35px;">
        <div class="navbar-brand" href="#">
            <a href="http://www.infermap.com">
                <img src="img/head.png" class="brand-image">
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="">
                <a href="dataeditor.php">Home</a>
            </li>
            <li class="">
                <a href="#" data-target="#instruction" data-toggle="modal">Instruction</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li id="notifications" style="">
                <a id="notificationslink" onclick="togglenotifications()">
                    <div style="position:relative">
                        <i style="font-size:1.3em" class="fa  fa-bell"></i>
                        <span id="notificationsbadge"  class="badge">0</span>
                    </div>
                </a>
            </li>
            <li id="nav-login-btn" class="">
                <a href="#" onclick="logout()">
                    <i class="fa fa-logout"></i>Logout
                </a>
            </li>
         </ul>
    </nav>
    <ul id="college-nav-tabs" class="nav nav-tabs">
      <li class="active" style="width:10%">
        <a href="#college-nav-about" data-toggle="tab">
            ABOUT
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:15%">
        <a href="#college-nav-admission" data-toggle="tab">
            ADMISSION
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:15%">
        <a href="#college-nav-academics" data-toggle="tab">
            ACADEMICS
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
      <li style="width:15%">
        <a href="#college-nav-placements" data-toggle="tab">
            PLACEMENTS
          <div class="tab-selector">
          </div>
        </a>
      </li>
      <li style="width:20%;" id="tab-select-placement">
        <a href="#college-nav-sports" data-toggle="tab">
            SPORTS & FACILITIES
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
    <div class="college-website-link">
        <?php echo "<a id=\"college-website\" href=\"".$website."\" target=_blank>";
        if($website=="#")echo "Link for website"; else echo $website; 
        echo "</a>";
        ?>
        <button id="link-edit-btn" title="Edit these links" class="btn-primary" onclick='$(".except-web").css("display","none");' style="margin-bottom:0px;width:25px;height:25px;margin-left:5px" data-toggle="modal" data-target="#link-edit"><i class="fa fa-edit fa-sm" ></i></button>
    </div>
    <div class="container college-head ">
        <div class="col-lg-10">
            <h1 id="college-name" name="college-name" contenteditable="true"><?php echo $college_name;?></h1>
            <div class="col-md-4">
                <input class="input-address form-control input-area" value=<?php echo "\"".$college_area."\""; ?> type="text" id="college-area" placeholder="Area Ex:Powai">
            </div>
            <div class="col-md-4">
                <input class="form-control input-address input-area" value=<?php echo "\"".$college_city."\""; ?> type="text" id="college-city" placeholder="City Ex:Mumbai">
            </div>
            <div class="col-md-4">
                <select class="form-control input-address" id="college-state">
                    <option value="">--Select State--</option>
                        <?php
                            $exams=mysqli_query($con,"select * from states");
                            while($row=mysqli_fetch_assoc($exams))
                              {
                                if($row['name']==$college_state)
                                    echo '<option selected="selected">'.$row['name'].'</option>';
                                else
                              echo '<option>'.$row['name'].'</option>';
                              }
                        ?>
                </select>
            </div>
            <div class="container" style="padding-top: 50px;">
                <div class="col-md-5">
                    <div class="col-xs-4"><b>University</b> : </div>
                    <div class="col-xs-8">
                        <input class="form-control" value=<?php echo "\"".$college_university."\""; ?> placeholder="Type the name of university" id="college-university">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-xs-4"><b>Type of College</b> : </div>
                    <div class="col-xs-8">
                        <select id="college-type" class="form-control">
                            <option>-Not Selected-</option>
                            <option <?php echo ($college_type=="Government"?"selected=\"selected\"":"");?>>Government</option>
                            <option  <?php echo ($college_type=="Private"?"selected=\"selected\"":"");?>>Private</option>
                            <option  <?php echo ($college_type=="Autonomous"?"selected=\"selected\"":"");?>>Autonomous</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2" >
            <form enctype="multipart/form-data" id="logo-up">
                <?php echo ' <input type="hidden" value="'.$cid.'" id="cid">';?>
                    <input type="file" id="logo-uploader" name="logo" style="display:none;position:absolute;right:0px;top:0px">
                    <p id="edit-logo-text" style="display:none;background-color:rgba(0,0,0,0.7);position:absolute;left:25%;top:20%;color:white;padding:5px;">
                        click to edit
                    </p>
                <?php echo ' <img src="'.$logo.'" id="college-logo"></div>'; ?>
            </form>
        </div>
    </div>
    <hr class="hr-full">
    <!--Contents for All the tabs -->
    <div id="myTabContent" class="tab-content">
        <!--Contents for the about tab -->
        <div class="tab-pane fade active in college-content" id="college-nav-about">
            <div class="college-gallery">
                <div id="carousel-gallery" class="carousel slide" data-ride="carousel">
                    <h2><br> Uploading Carousel..<br></h2>
                </div>
            </div>
            <div class="col-md-12 college-gallery"><br> <br>
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
            </div>
            <div class="col-md-12">
                <p><b>Tick on the facilities which are available in the college:</b></p>
                <div class="col-md-4">
                    <input id="boys_hostel" type="checkbox" <?php  
                    if($college_data['boys_hostel']!=0) 
                    echo "checked=checked"; ?>> Boys Hostel
                </div>
                <div class="col-md-4">
                    <input id="girls_hostel" type="checkbox" <?php  if($college_data['girls_hostel']==1) 
                    echo "checked=checked"; ?>> Girls Hostel
                </div>
                <div class="col-md-4">
                    <input id="internet" type="checkbox" <?php  if($college_data['internet']==1) 
                    echo "checked=checked"; ?>> Internet 
                </div>
                <div class="col-md-4">
                    <input id="library" type="checkbox" <?php  if($college_data['library']==1) 
                    echo "checked=checked"; ?>> Library 
                </div>
                <div class="col-md-4">
                    <input id="computer_lab" type="checkbox" <?php  if($college_data['computer_lab']==1) 
                    echo "checked=checked"; ?>> Comptuer Lab
                </div>
                <div class="col-md-4">
                    <input id="gym" type="checkbox"  <?php  if($college_data['gym']==1) 
                    echo "checked=checked"; ?>> Gym 
                </div>
                <div class="col-md-4">
                    <input id="sports_ground" type="checkbox"  <?php  if($college_data['sports_ground']==1) 
                    echo "checked=checked"; ?>> Sports Ground
                </div>
                <div class="col-md-4">
                    <input id="transport" type="checkbox"  <?php  if($college_data['transport']==1) 
                    echo "checked=checked"; ?>> Transport
                </div>
                <div class="col-md-4">
                    <input id="scholarship" type="checkbox"  <?php  if($college_data['scholarship']==1) 
                    echo "checked=checked"; ?>> Scholarship
                </div>
            </div>
            <div class="col-md-12 row" style="margin:0;margin-top:10px">
                <label class="col-md-4">Input Gross Fees per Year
                </label>
                <div class="col-md-8">
                    <input class="form-control" type="number" id="gross_fees" <?php  if($college_data['gross_fees']>0) 
                    echo "value='".$college_data['gross_fees']."'"; ?>>
                </div>
            </div>
            <div class="row" style="margin:0;margin-top:10px;">
                <label class="col-md-3">Connectivity to campus</label>
                <div class="col-md-3"><input <?php  if($college_data['connectivity']==3)   echo "checked"; ?> autocomplete="off" type="radio" name="connectivity" value="3"> Good</div>
                <div class="col-md-3"><input <?php  if($college_data['connectivity']==1)   echo "checked"; ?> autocomplete="off" type="radio" name="connectivity" value="1"> Poor</div>
                <div class="col-md-3"><input <?php  if($college_data['connectivity']==2)   echo "checked"; ?> autocomplete="off" type="radio" name="connectivity" value="2"> Just Ok</div>
            </div>
            <div class="col-md-12">
                <p><b>Select the quotas available</b></p>
                <table class="table table-condensed">
                    <tr>
                        <th>
                            Quota
                        </th>
                        <th>
                            No/% of seats
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" <?php 
                            if ($college_data['management']>0)
                                echo "checked=checked";
                            ?> id="management"> Management
                        </td>
                        <td>
                            <input type="number" class="form-control" id="management-input" <?php 
                            if ($college_data['management']>0.01)
                                echo "value=".$college_data['management'];
                            ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" <?php 
                            if ($college_data['outside_state']>0)
                                echo "checked=checked";
                            ?> id="outside_state"> Outside State
                        </td>
                        <td>
                            <input type="number" class="form-control" id="outside_state-input" <?php 
                            if ($college_data['outside_state']>0.01)
                                echo "value=".$college_data['outside_state'];
                            ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" <?php 
                            if ($college_data['within_state']>0)
                                echo "checked=checked";
                            ?> id="within_state"> Within State
                        </td>
                        <td>
                            <input type="number" class="form-control" id="within_state-input" <?php 
                            if ($college_data['within_state']>0.01)
                                echo "value=".$college_data['within_state'];
                            ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" <?php 
                            if ($college_data['category']>0)
                                echo "checked=checked";
                            ?> id="category"> Category
                        </td>
                        <td>
                            <input type="number" class="form-control" id="category-input" <?php 
                            if ($college_data['category']>0.01)
                                echo "value=".$college_data['category'];
                            ?>>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <p><b>Fill up Aliases</b></p>
                <p>Note : Alias means the names with people search you on web</p>
                <div class="col-md-3">
                    Alias 1
                    <input id="alias1" class="form-control" <?php echo 'value="'.$college_data['alias1'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 2
                    <input id="alias2" class="form-control" <?php echo 'value="'.$college_data['alias2'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 3
                    <input id="alias3" class="form-control" <?php echo 'value="'.$college_data['alias3'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 4
                    <input id="alias4" class="form-control" <?php echo 'value="'.$college_data['alias4'].'"';?> >
                </div>
                 <div class="col-md-3">
                    Alias 5
                    <input id="alias5" class="form-control" <?php echo 'value="'.$college_data['alias5'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 6
                    <input id="alias6" class="form-control" <?php echo 'value="'.$college_data['alias6'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 7
                    <input id="alias7" class="form-control" <?php echo 'value="'.$college_data['alias7'].'"';?>>
                </div>
                 <div class="col-md-3">
                    Alias 8
                    <input id="alias8" class="form-control" <?php echo 'value="'.$college_data['alias8'].'"';?>>
                </div>
            </div>
                <div class="section-sub-heading">
                    <img src="./img/icons/about college.png">
                    About College
                </div>
                <div class="edit-button" id="about_college-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span>
                    edit
                </div>
                <div id="about_college" name="aboutcollege" style="min-height:40px;">
                    <?php echo fetch_data($path_chk."about/about_college.txt"); ?>
                </div>
                <br><br>
                <div class="section-sub-heading" style="display:none">
                    <img src="./img/icons/dean intro.png">
                    Dean Introduction
                </div>
                <div class="edit-button" id="dean_intro-edit-btn" style="display:none">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="dean_intro" name="dean_intro" style="min-height:40px;display:none">
                    <?php echo fetch_data($path_chk."about/dean_intro.txt"); ?>
                </div>
                <div class="section-sub-heading" style="display:none">
                    <img src="./img/icons/rules.png">
                    Rules and Regulations
                </div>
                <div class="edit-button" id="about_rules-edit-btn" style="display:none">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="about_rules" name="about_rules" style="min-height:40px;display:none">
                	<?php echo fetch_data($path_chk."about/rules.txt"); ?>
                </div>
        </div>
        <!--Contents for the admission tab -->
        <div class="tab-pane fade college-content" id="college-nav-admission">        
            <div class="modal fade" id="edit-exam-name" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <form class="modal-body" id="edit-tables-body">
                        
                    </form>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-table-col">Save changes</button>
                      </div>
                    </div>
                  </div>
            </div>
            <div style="float:left;left:20%;height:30px;padding:5px;width:120px;margin-top:-25px">
                <button class="btn btn-danger" href="#" data-target="#add-program" data-toggle="modal">Add programs</button>
            </div>
            <div class="modal fade" id="add-program" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Programs to this college</h4>
                  </div>
                    <form class="modal-body" id="add-program-body">
                        <?php
                            echo "<input type=\"hidden\" name=\"cid\" value=\"".$cid."\">";
                        ?>
                        <h3>Chose Programs to add</h3>
                        <div class="stream-checkbox">
                        <table class="">
                            <?php
                                $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
                                $allprog=mysqli_query($con,"select * from allcourses");
                                $ap=[];
                                $i=0;
                                while($row=mysqli_fetch_assoc($availtypes))
                                {
                                    $ap[$i]=$row['type'];
                                    $i+=1;
                                }
                                $i=0;
                                while($row=mysqli_fetch_assoc($allprog))
                                {   
                                    if(!(in_array($row['name'], $ap))){
                                        if($i%2==0)
                                        echo "<tr>";
                                        echo "<td><input type=\"checkbox\" name=\"".$row['name']."\">".$row['value']."</td>";
                                        if($i%2!=0)
                                        echo "</tr>";
                                        $i+=1;
                                    }
                                }

                            ?>
                        </table>
                        </div>
                    </form>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="program-add">Add</button>
                      </div>
                    </div>
                  </div>
            </div>
                <?php  
                $return="";
                $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
                while($type=mysqli_fetch_assoc($availtypes))
                {
                    $type= $type['type'];
                    $type_exam=[];
                    $names=mysqli_query($con,'select name from college_entrance_test where cid = '.$cid.' && type="'.$type.'"');
                    echo "<div class='section-sub-heading'><img src=\"./img/icons/closing rank.png\">
                    Closing Ranks (".ucfirst($type).")<button class=\"btn btn-success\" title=\"Add a new table for this type and a exam\" onclick=\"addtable('".$type."')\"><i class=\"fa fa-plus fa-2\"></i></button>
                    <button class=\"btn btn-success\" title=\"Click to ope and edit tables\" onclick=\"$('#".$type."-tables').toggle();\">View</button></div><div id=\"".$type."-tables\" style=\"display:none\">";
                    while($name=mysqli_fetch_assoc($names))
                    {
                        $name=$name['name'];
                        echo "<div id=\"".$type.$name."TableData\">";
                        $college_exams=mysqli_query($con,'select * from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
                        $exam=[];
                        $exampr=[];
                        $iter=0;
                        $examname=[];
                        foreach ($categories as $key) {
                        	$exam[$iter]=$key['id'];
                        	$exampr[$iter]=0;
                        	$examname[$iter]=$key['name'];
                        	$iter+=1;
                        }
                        $query="select department,program,intake";
                        $table_list="['Department','Intake'";
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
                            echo "<div class='section-sub-sub-heading' '><div class=\"col-md-2\"> Exam : </div>";
                        $exams=mysqli_query($con,"select * from allcourses");
                         $real_name_exx=mysqli_fetch_assoc(mysqli_query($con,'select name,eid from exam where eid='.$eid));
                         $real_name=$real_name_exx['name'];
                        $a="<div class=\"col-md-4\">".$real_name;
                       
                        $a.="</div>";
                         $type_exam[$real_name_exx['eid']]=1;
                        echo $a;
                        echo "<div class=\"col-md-2\"><button class=\"btn btn-success\" onclick=\"edittable('".$name."','".$type."')\">Change this exam</button></div>";
                        echo " <div class=\"col-md-4\" style='text-align: right;font-size: 0.66em;text-shadow: 0 0;min-height: 45px;'>Year : 
                            <input type=\"number\" id=\"".$type.$name."-closing-year\" min=2000 max=2020 value=".$closing_year." placeholder=".$closing_year." /></div></div>";
                        echo '<br><div class="col-md-4"><div class="edit-button" id="'.$type.$name.'-closing-rank-table-edit-btn" onclick="editTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\','.$table_list.',1,0)">
                                            <span class="glyphicon glyphicon-pencil"></span> edit table
                                        </div></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div id="'.$type.$name.'-closing-rank-editable" style="display:none">
                                        <div class="table-responsive"><table class="table table-bordered mytable" id="'.$type.$name.'-closing-rank-table-editable">

                                            </table></div>
                                            Note : Excpet department all others column should contain <b>Only numbers</b> or data wont be saved<br>
                                              <button class="btn btn-primary btn-save closingranksave"  id="'.$type.$name.'-closing-rank-table-save-btn" onclick=" saveTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\',1,0);saveTheTableData(\''.$type.$name.'\')">SAVE TABLE</button>
                                            <button class="btn btn-danger btn-save" id="'.$type.$name.'-closing-rank-table-cancel-btn" onclick=" cancelTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\',1,0);">CANCEL</button>
                                            <input type="hidden" id="'.$type.$name.'-eid" value='.$name.' />
                                            <input type="hidden" id="'.$type.$name.'-type" value="'.$type.'"/>
                                        </div>
                            <div class="table-responsive"><table id="'.$type.$name.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
                            echo "<tr> <td>Sl. No.</td><td>Department</td><td>Intake</td>";
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
                                echo "<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$row['intake']."</td>";
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
                             echo "</table></div></div>";
                    }
                    echo "</div>";
                }
                echo $return; ?>
                <div class="modal fade" id="add-dept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="add-dept-title"></h4>
                      </div>
                      <form class="modal-body" id="add-dept-body">
                        
                      </form>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-new-exam">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="section-sub-heading">
                    
                    Eligibility Criteria
                </div>
                <div class="edit-button" id="adm_eligibility-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="adm_eligibility" name="adm_eligibility" style="min-height:40px;">
                    <?php echo fetch_data($path_chk."admissions/eligibility.txt"); ?>
                </div>
                <div class="section-sub-heading">
                    <img src="./img/icons/admission info.png">
                    Admission Info..
                </div>
                <div class="edit-button" id="adm_info-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="adm_info" name="adm_info" style="min-height:40px;">
                    <?php echo fetch_data($path_chk."admissions/admission_info.txt");?>
                </div>
                <div class="section-sub-heading">Miscellanous
                </div>
                <div class="edit-button" id="adm_misc-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="adm_misc" name="adm_misc" style="min-height:40px;">
                    <?php echo fetch_data($path_chk."admissions/misc.txt");?>
                </div>
        </div>
        <!--Contents for the academics tab -->
        <div class="tab-pane fade college-content" id="college-nav-academics">
            <div class="section-sub-heading">
                <img src="./img/icons/academic info.png">
                Academic Information
            </div>
            <div class="edit-button" id="acad_info-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="acad_info" name="acad_info" style="min-height:40px;">
                <?php echo fetch_data($path_chk."academics/acad_info.txt"); ?>
            </div>
            <div class="section-sub-heading">
                <img src="./img/icons/academic facility.png">
                Academic Facilities
            </div>

            <div class="edit-button" id="acad_facility-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            
            <div id="acad_facility" name="acad_facility" style="min-height:40px;">
                <?php echo fetch_data($path_chk."academics/facilities.txt"); ?>
            </div>
            <div class="section-sub-heading">
                <img src="./img/icons/list of courses.png">
                List of Courses
            </div>
            <i>Note : List of courses means what is taught in different departments .. like Algorithms in CSE , Machines in Mechanical etc. If you have department name  like CSE , Mechanical etc then please fill it in tables in the Admission tab
            </i>
            <div class="edit-button" id="acad_courses-edit-btn" style="margin-top:18px;">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="acad_courses" name="acad_courses" style="min-height:40px;">
                <?php echo fetch_data($path_chk."academics/list_of_courses.txt"); ?>
            </div>
            <div class="section-sub-heading">Miscellanous
            </div>
            <div class="edit-button" id="acad_misc-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="acad_misc" name="acad_misc" style="min-height:40px;">
                <?php echo fetch_data($path_chk."academics/misc.txt"); ?>
            </div>
        </div>
        <!--Contents for the fees tab -->
        <div class="tab-pane fade college-content" id="college-nav-fees">
            <?php
                $return='';
                $fee=mysqli_query($con1,"select * from fee_t".$cid);
                $return.="<div class='section-sub-heading'>Fee Stucture per ";
                if($fee_type==0)
                $return.="<select id=\"typeofFee\"><option>Semester</option><option>Annum</option></select>";
                else
                $return.="<select id=\"typeofFee\"><option>Annum</option><option>Semester</option></select>";
                $return.="</div><br><div class='edit-button' id='fee-table-edit-btn'>
                                        <span class='glyphicon glyphicon-pencil'></span> edit table
                                </div>
                                <div id='fee-editable' style='display:none'>
                                    <table class='table table-bordered mytable' id='fee-table-editable'>

                                    </table>
                                    Note : Excpet 1st and 2nd column all others column should contain <b>Only numbers</b> or data wont be saved<br>
                                    <button class='btn btn-primary btn-save'  id='fee-table-save-btn'>DONE EDITING</button>
                                    <button class='btn btn-danger btn-save' id='fee-table-cancel-btn'>CANCEL</button>
                                </div>";
                  $return.="<table id='fee-table' class='table table-bordered mytable'><tr><td>Course</td><td>Category</td><td>Tution Fee</td><td>Miscellanous fee</td><td>Mess and Hostel fee</td><td>Total</td><td>Refundable Fee</td></tr>";
                  $fee_array=['course','category','tut_fee','misc_fee','mnh_fee','tot','refundable_fee'];
                  while($row=mysqli_fetch_assoc($fee))
                      {
                           $return.='<tr>';
                           for ($i=0; $i < 7; $i++) { 
                             $return.='<td>'.(($i>1)&&($row[$fee_array[$i]]==0)?"-":ucfirst($row[$fee_array[$i]])).'</td>';
                           }
                           $return.='</tr>';
                      }
                      $return.="</table>";
                echo $return;
            ?>
            <div class="section-sub-heading">Scholarships
            </div>
            <div class="edit-button" id="fee_scholarships-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="fee_scholarships" name="fee_scholarships" style="min-height:40px;">
                <?php echo fetch_data($path_chk."fees/scholarships.txt");?>
            </div>
            <div class="section-sub-heading">Benefits
            </div>
            <div class="edit-button" id="fee_benefits-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="fee_benefits" name="fee_benefits" style="min-height:40px;">
                <?php echo fetch_data($path_chk."fees/benefits.txt");?>
            </div>
            <div class="section-sub-heading">Caution Deposits
            </div>
            <div class="edit-button" id="fee_caution-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="fee_caution" name="fee_caution" style="min-height:40px;">
                <?php echo fetch_data($path_chk."fees/caution.txt");?>
            </div>
            <div class="section-sub-heading">Miscellanous info
            </div>
            <div class="edit-button" id="fee_misc-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="fee_misc" name="fee_misc" style="min-height:40px;">
                <?php echo fetch_data($path_chk."fees/misc.txt");?>
            </div>
        </div>
        <!--Contents for the placements tab -->
        <div class="tab-pane fade college-content" id="college-nav-placements">
            <?php
                $return='';
                $availtypes=mysqli_query($con,'select distinct type from college_entrance_test where cid = '.$cid);
                while($type=mysqli_fetch_assoc($availtypes))
                {
                    $type= $type['type'];
                    $query="select * from t".$cid." where (placed != 0 || min_package!=0 || max_package!=0 || avg_package!=0) && program='".$type."' group by department";
                    $package=mysqli_query($con1,$query);
                    $placement_year=mysqli_fetch_assoc(mysqli_query($con,'select placement_year from college_entrance_test where cid='.$cid.'&&type="'.$type.'"'))['placement_year'];
                    if($placement_year==0)
                        $placement_year="0000";
                        $return.="<div class='section-sub-heading'>Placement Record (".ucfirst($type).")<button class=\"btn btn-success\" title=\"Click to ope and edit tables\" onclick=\"$('#".$type."placement').toggle();\">View</button>
                        </div><div id=\"".$type."placement\" style=\"display:none\">
                            <div class='edit-button col-md-2' style=\"margin-bottom:0px\" id='".$type."-placement-table-edit-btn' onclick=\"editTable('".$type."-placement-table', '".$type."-placement-table-edit-btn', '".$type."-placement-editable', '".$type."-placement-table-editable', ['Depatment','Total Intake','Placed','Min Package','Max Package','Average Package'],1,0);\">
                            <span class='glyphicon glyphicon-pencil'></span> edit table
                                    </div><div class=\"col-md-2 col-md-offset-10\" style=\"text-align:right; margin-top:-3%\">Year : <input type=\"number\" id=\"".$type."-placement-year\" min=2000 max=2020 value='".$placement_year."' /></div>
                                    <h4 style=\"margin-top:5px\">Format 1</h4>
                                    <div id='".$type."-placement-editable' style='display:none'>
                                        <table class='table table-bordered mytable' id='".$type."-placement-table-editable'>

                                        </table>
                                        Note : Excpet department all others column should contain <b>Only numbers</b> or data wont be saved<br>
                                        <button class='btn btn-primary btn-save'  id='".$type."-placement-table-save-btn' onclick=\" saveTable('".$type."-placement-table', '".$type."-placement-table-edit-btn', '".$type."-placement-editable', '".$type."-placement-table-editable',1,0);\">DONE EDITING</button>
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
                        $q2=mysqli_query($con1 ,"select * from placement_t".$cid." where type='".$type."'");
                         $return.="<h4>Format 2</h4>
                        <table class='table table-bordered mytable' id='".$type."-placement-table1'>";
                        $return.="<tr> <td>Sl. No.</td><td>Category</td><td>No of students Placed</td></tr>";
                        $rc=1;
                        $row=mysqli_fetch_assoc($q2);
                       $return.="<tr><td>1</td><td>&lt; 3 lakh per Annum</td><td class=\"td-editable\" contenteditable=\"true\">".(($row['c1']!=0)?$row['c1']:"-")."</td></tr>";
                       $return.="<tr><td>2</td><td>3 lakh  to 6 lakh per Annum</td><td class=\"td-editable\" contenteditable=\"true\">".(($row['c2']!=0)?$row['c2']:"-")."</td></tr>";
                       $return.="<tr><td>3</td><td>6 lakh to 9 lakh per Annum</td><td class=\"td-editable\" contenteditable=\"true\">".(($row['c3']!=0)?$row['c3']:"-")."</td></tr>";
                       $return.="<tr><td>4</td><td>&gt; 9 lakh per Annum</td><td class=\"td-editable\" contenteditable=\"true\">".(($row['c4']!=0)?$row['c4']:"-")."</td></tr>";
                        $return.="</table>
                        <blockquote>If you have any other format than these , then please report us in feedback along with the link</blockquote></div>";
                }
                echo $return;
            ?>
            <div class="section-sub-heading">Placement  Information
            </div>
            <div class="edit-button" id="placement_info-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="placement_info" name="placement_info" style="min-height:40px;">
                <?php echo fetch_data($path_chk."placements/placement_info.txt");?>
            </div>
            <div class="section-sub-heading">Contacts for Placement
            </div>
            <div class="edit-button" id="placement_contact-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="placement_contact" name="placement_contact" style="min-height:40px;">
                <?php echo fetch_data($path_chk."placements/contacts.txt");?>
            </div>
        </div>
        <!--Contents for the sports tab -->
        <div class="tab-pane fade college-content" id="college-nav-sports">
            <div class="section-sub-heading">Extra Cocurricular Activities</div>
                <div class="edit-button" id="extra_cocurricular-edit-btn">
                    <span class="glyphicon glyphicon-pencil"></span> edit
                </div>
                <div id="extra_cocurricular" name="extra_cocurricular" style="min-height:40px;">
                    <?php echo fetch_data($path_chk."facilities/extra_cocurricular.txt");?>
                </div>
            <div class="section-sub-heading">Sports Facilities
            </div>
            <div class="edit-button" id="sports_facilities-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="sports_facilities" name="sports_facilities" style="min-height:40px;">
                <?php echo fetch_data($path_chk."facilities/sports.txt");?>
            </div>
            <div class="section-sub-heading">Hostel and Mess Facilities
            </div>
            <div class="edit-button" id="hostel_facilities-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="hostel_facilities" name="hostel_facilities" style="min-height:40px;">
                <?php echo fetch_data($path_chk."facilities/mess_and_hostel_facilities.txt");?>
            </div>
            <div class="section-sub-heading">Other Important Facilities
            </div>
            <div class="edit-button" id="misc_facilities-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
             <div id="misc_facilities" name="misc_facilities" style="min-height:40px;">
                <?php echo fetch_data($path_chk."facilities/misc_facilities.txt");?>
            </div>
        </div>
        <!--Contents for the contacts tab -->
        <div class="tab-pane fade college-content" id="college-nav-contacts">
            <div class="section-sub-heading">Main Contact
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            Contact Name
                        </td>
                        <td>
                            <input class="form-control" value="<?php echo $college_data['contact_name'];?>" type="text" placeholder="Enter contact person name" id="contact-name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact Email1
                        </td>
                        <td>
                            <input class="form-control" value="<?php echo $college_data['contact_email1'];?>" type="text" placeholder="Enter email" id="contact-email1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact Email2
                        </td>
                        <td>
                            <input class="form-control" value="<?php echo $college_data['contact_email2'];?>" type="text" placeholder="Enter another email" id="contact-email2">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact Phone1
                        </td>
                        <td>
                            <input class="form-control" value="<?php echo $college_data['contact_phone1'];?>" type="text" placeholder="Enter phone no" id="contact-phone1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact Phone2
                        </td>
                        <td>
                            <input class="form-control" value="<?php echo $college_data['contact_phone2'];?>" type="text" placeholder="Enter another phone no" id="contact-phone2">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address
                        </td>
                        <td>
                            <textarea class="form-control" placeholder="Enter address" id="contact-address"><?php echo $college_data['contact_address'];?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="section-sub-heading">Contact Info
            </div>
            <div class="edit-button" id="contact_info-edit-btn">
                <span class="glyphicon glyphicon-pencil"></span> edit
            </div>
            <div id="contact_info" name="contact_info" style="min-height:40px;">
                <?php echo fetch_data($path_chk."contact/contacts.txt");?>
            </div>
            <div class="section-sub-heading">Locate college on Map
            </div>  
            <div class="college-content">
                <form action="#" onsubmit="showAddress(this.address.value); return false">
                    <table  bgcolor="#FFFFCC" style="width:300px;margin:auto;margin-BOTTOM:17px;"  class="table table-striped">
                      <tr>
                        <td><b>Latitude</b></td>
                        <td><b>Longitude</b></td>
                      </tr>
                      <tr class="success">
                        <td id="lat"></td>
                        <td id="lng"></td>
                      </tr>
                    </table>
                    <div class="col-lg-12" style="margin-bottom:5px;">
                        <div class="input-group">
                          <input type="text" class="form-control" size="60" name="address" value="<?php echo $college_name." , ".$college_city.", ".$college_state;?>" >
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-success" type="button">Search!</button>
                              </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </form>
                <div align="center" id="map" style="width: 100%; height: 400px"><br/>
                </div>
                <div id="socials">
                    <div>
                        <a target="_blank" id="weblinka" href="#" title="Web Page">
                            <i class="fa fa-desktop fa-2x" ></i>
                        </a>
                    </div>
                    <div>
                        <a target="_blank" id="fblinka" href="#" title="Facebook Page of College">
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
                    <div>
                        <button id="link-edit-btn" title="Edit these links" class="btn btn-primary" onclick='$(".except-web").css("display","table-row");' style="margin-bottom:10px" data-toggle="modal" data-target="#link-edit">
                            <i class="fa fa-edit fa-lg" ></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <input id="weblink" name="weblink" type="url" class="form-control" placeholder="Link to College Web Site" style="width:100%">
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
                        &emsp;&emsp;To edit the tables, click on the edit button above the table. You can choose the headings of the table from the dropdowns that appear in the first row. To add/remove on of the rows or columns click on the +/x buttons. To cancel te changes that have been made click on the cancel button below the table. To save the change click on the save button below the table. Don't forget to save the changes. The changes will be lost if you leave the page without saving the changes.
                        <br><br><strong>Editing photo gallery</strong><br>
                        &emsp;&emsp;Clicking the Edit Gallery button will open up box which will allow you to add or remove photos that are being shown in the gallery. After you have made your changes hit Finish Edit button on top.
                        To add captions to your images, click on the Edit Captions button below the gallery. After finishing your edit hit Submit Captions button on top.
                        <br><i>Note : To maintain the ordering of the photos ensure that the names of teh photos is in alphabetical order</i> 
                        <br><br><strong>Changing the Logo of your college</strong><br>
                        &emsp;&emsp;When you hover the logo image of your college, a button appears at the top right corner of your image. Click on that button to add a new logo image.
                        <br><p>If you currently don't have any information about some tags, e.g. Dean Introduction, Rules and Regulations, don't write anything in the editor, just keep it blank.
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
    </div><!-- /.modal -->
    <footer>
    <?php
    if(isset($_SESSION['truth']))
       {

        echo'
        <button class="btn btn-success col-md-2 col-md-offset-3" onclick="savecollegedata()"  style="margin-top:7px">
        Save the college Data
        </button>
         <button class="btn btn-success col-md-2 col-md-offset-2" data-toggle="modal" data-target="#myModal" style="margin-top:7px">
        Send Mail to dean
        </button>
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" style="width: 80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Send Mail to Dean</h4>
              </div>
              <div class="modal-body">
                <form id="dean-mail-form">
                <div class="form-group">
                <label>Email of Dean :</label>
                <input class="form-control" name="id" type="email" required placeholder="Email of Dean">
                </div>
                <textarea name="email" class="form-control" id="email-dean" style="min-height:300px">';
echo '         <p>
    Respected sir/Ma\'am,
</p>
<p>
    Intro line
</p>
<p>
    Higher education is the foundation of one\'s
career, going to the right college and stream for
a dream career can be really tricky and stressful.
</p>
<p>
    Infermap is a platform for assisting
students, while making the most important decisions of their lives. Infermap
aims to equip students with all the relevant information about their choices
and provides a platform for founding the bond between a student and institution
before getting to the college.
</p>
<p>
    A college is not just an institution to learn about few subjects, it is the
nursery for careers. Thereby, making the experience of choosing a college for a
student a little hassle free would help them take not just informed decisions
but it would also help them know about all the available options at one institution and quantify their priorities to choose a
college which is best suited to their requirements.
</p>
<p>
    We would like students to know more about
your institute and further take up admissions and have a bright future and we
anticipate that you also share the same vision. Our plan is to create a unique
profile for each college which shall have some basic information about the
college and for that we need your help in data collection.
</p>
<p>
    We don\'t want the institute to do all the
work, so have prepared a profile for your college already. The source of
information for data collection is your college\'s website and the DTE website.
</p>
<p>
    Thus we have prepared a profile for your
institution, click the link for going to your profile. 
    <a href="www.infermap.com/data/college-editable.php?college='.encrypt_decrypt('encrypt',$college_link).'">www.infermap.com/data/college-editable.php?college='.encrypt_decrypt('encrypt',$college_link).'</a>
</p>
<p>
    As, apart from the information available on
web, there is a lot that institutes also want an aspirant to know. Therefore,
respective institute must edit their page by itself. Support from the
institutions for us to help students in an efficient ways is essential.
</p>
<p>
    There are a few fields in the profile which
do not contain adequate information. For information in those profile, Infermap
requests you to fill in the data, using login information provided to your
institution.
</p>
<p>
    We have a list of a few fields which are of
extreme importance to students before admission.
</p>
<p>
    1.      
Department wise intake and
closing ranks for required exam 2013.
</p>
<p>
    2.      
Fee structure and scholarship
</p>
<p>
    3.      
Seat bifurcation (number of
seats for state, outside states, management quota students)
</p>
<p>
    4.      
Facilities like hostel,
Internet, Library, Computer Lab.
</p>
<p>
    5.      
Other facilities and activities
</p>
<p>
    6.      
Campus transport and transport
to college available or not
</p>
<p>
    Now the obvious question that you might be
having is why should you register with us and allow us to show your
information?
</p>
<p>
    The answer to the above question is multi
fold let us examine them one by one.
</p>
<p>
</p>
<ol>
    <li><span style=""> </span><span style="">We target your potential
students so it is good to register with us to directly reach them.
    </span></li>
    <li style=" /* list-style: initial; */ "><span style="">It is free publicity for your
college.
    </span></li>
    <li><span style=""> </span><span style="">Our portal covers all parts of
India which in turn increases the visibility of your college.
    </span></li>
    <li><span style=""> </span><span style="">Also we link directly the students
to you via our Query portal. They can send their queries directly to you.
    </span></li>
    <li><span style=""> </span><span style="">We can also provide you with
data like location etc of the students searching for your college.
    </span></li>
    <li><span style=""> </span><span style="">You can easily publicize the
unique features of your institute and gather better students.
    </span></li>
    <li><span style=""> </span><span style="">Our portal is free and easy to
use.
    </span></li>
</ol>
<p>
    Also if you are still confused about
Infermap\'s origin then Infermap is a venture of IIT Bombay Alumni which is
supported by IITB faculty.
</p>
<p>
    Note- This mail confirms that we have
informed you about the data that is put up on the website and we have your
consent in putting up your college data.
</p>
<p>
    We are constantly evolving and creating
better tools for you and the students. So it is always beneficial to register
now.
</p>
<p>
    What is Infermap?
</p>
<p>
    Infermap is the next generation college
search portal. Our vision is to help students make an informed decision about
their colleges and in turn about their careers. We provide the most relevant
information about colleges that a student needs in order to make a decision
along with various statistical tools to analyse their choices. We believe
in----
</p>
<p>
    <span style="color:red">We are a team of IIT
Bombay alumni who have teamed up to complete this massive task.
    </span>
</p>
<p>
    We would like to have your support in this
process. We would like students to know more about your institute and further
take up admissions and have a bright future and we anticipate that you also
share the same vision. Our plan is to create a unique profile for each college
which shall have some basic information about the college and for that we need
your help in data collection.
</p>
<p>
    We have collected some information about
your college in advance to speed up the process.
</p>
<p>
    Please go through the following link.. It
shows all the data that we have collected from your website and other sources
from the internet. Please check the information and point out if there is any
mistake. Also there a few fields that are missing so please help us in filling
those.
</p>
<p>
    Now the obvious question that you might be
having is why should you register with us and allow us to show your
information?
</p>
<p>
    The answer to the above question is multi
fold let us examine them one by one.
</p>
<p>
    1.      
We target your potential
students so it is good to register with us to directly reach them.
</p>
<p>
    2.      
It is free publicity for your
college.
</p>
<p>
    3.  
Our portal covers all parts of
India which in turn increases the visibility of your college.
</p>
<p>
    4.  
Also we link directly the
students to you via our Query portal. They can send their queries directly to
you.
</p>
<p>
    5.  
We can also provide you with
data like location etc of the students searching for your college.
</p>
<p>
    6.  
You can easily publicize the
unique features of your institute and gather better students.
</p>
<p >
    7.  
Our portal is free and easy to
use.
</p>
<p>
    Other data that we require.-
</p>
<ol>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "></span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">G</span></li>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "> </span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">Gr</span></li>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "> </span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">Gr</span></li>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "> </span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">Gr</span></li>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "> </span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">Gr</span></li>
    <li><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; "> </span><span style="font-family: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-align: inherit; ">Gr</span></li>
</ol>
<p style="">
</p>
<p>
    Note- This mail confirms that we have
informed you about the data that is put up on the website and we have your
consent in putting up your college data.
</p>
<p>
    We are constantly evolving and creating
better tools for you and the students. So it is always beneficial to register
now.
</p>
<p>
    We students of IIT Bombay, have made a platform
for students to know about all the colleges to decide for going into one. That
is www.infermap.com
</p>
<p>
    As we have experienced during our time of
selecting college and branches that there are a few things which a student has
to know about the branch and college, before applying for admission. And we
understand that college also wishes to clarify student\'s queries as much as
possible and it is not feasible to do it on one on one basis.
</p>
<p>
    Learning about what information students
require at the time of admission, we have prepared this website which not only
searches the suitable college for students but also give them the information
about how they can get admission what are the procedures, the facilities and
fee structure
</p>
<p>
    Bases on all these requirements, we have
prepared a college profiles..
</p>
<p>
    For <b>'.$college_name.'</b> college, this is the link to your
college\'s profile. For filling up.details in fields for your college, we have
used the information available on your website and the admission criteria by
the respective authority website.
</p>
<p>
    As you know, for making a decision wisely,
one should get as much information as possible. That is the goal infermap has,
and it requires the information to be correct for each and every college.
</p>
<p>
    We have sent you the link to your profile,
please review the information and let us know if there is any disruption in the
information provided.
</p>
<p>
    There might be fields foe which we couldn\'t
find information, so thlaw are left empty. It would be very helpful for
students to search your college if the information is provided in all the
fields, as our search algorithm ranks the colleges based on the information
that is available in college\'s profile.
</p>';
                //echo 'Visit the following link to edit your college data:<br>
                //<a href="www.infermap.com/data/college-editable.php?college='.encrypt_decrypt('encrypt',$college_link).'">'.encrypt_decrypt('encrypt',$college_link).'</a>';
                echo '</textarea>
                <br>
                <input type="checkbox" name="infermap"> Send a copy to infermap@gmail.com
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Mail</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    ';
}
        else
        echo '<button class=\'btn btn-success col-md-2 col-offset-5\' onclick=\'savecollegedata()\'  style=\'margin-right:33%;margin-top:7px\'>
        Save the college Data
        </button>&copy; Infermap.com 2014';
        ?>
       <br>
    </footer>
    <?php echo fetch_data("js/xml.txt");?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/redit.js"></script>
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
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgrj58PbXr2YriiRDqbnL1RSqrCjdkglBijPNIIYrqkVvD1R4QxRl47Yh2D_0C1l5KXQJGrbkSDvXFA"
      type="text/javascript">
    </script>
     <script type="text/javascript">
    <?php
    	echo "var categories=".json_encode($categories).";";
    ?>
    </script>
    <script type="text/javascript" src="js/edit-page.js"></script>
    <script type="text/javascript">
  	 function logout()
            {
                window.location="php/logout.php";
            }
        function tableToJson(table) {
            var data = [];

            // first row needs to be headers
            var headers = [];
            for (var i=0; i<table.rows[0].cells.length; i++) {
                headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
            }

            // go through cells
            for (var i=1; i<table.rows.length; i++) {

                var tableRow = table.rows[i];
                var rowData = {};

                for (var j=0; j<tableRow.cells.length; j++) {

                    rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

                }

                data.push(rowData);
            }       

            return data;
        }
        <?php echo "var cid=".$cid.";"; ?>
        // This function is reloads the image gallery with proper images
        function refresh_gallery()
        {
            jQuery.ajax(
            {
                url: "php/get-image-gallery-editable.php?cid="+cid,
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
                url: "php/put-image-caption.php?cid="+<?php echo $cid; ?>,
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
        $("#email-dean").redactor();
        function savecollegedata()
        {
            $("body").css("overflow","hidden");
            $("#waiting").css("display","block");
            var connect;
            if($("input[name=connectivity]:checked").val()==undefined)
                connect=0;
            else
                connect=$("input[name=connectivity]:checked").val();
                $.post("php/save-college-data.php?cid="+<?php echo $cid; ?>,{
                    typeofFee:$("#typeofFee").val(),
                    alias1:$("#alias1").val(),
                    alias2:$("#alias2").val(),
                    alias3:$("#alias3").val(),
                    alias4:$("#alias4").val(),
                    alias5:$("#alias5").val(),
                    alias6:$("#alias6").val(),
                    alias7:$("#alias7").val(),
                    alias8:$("#alias8").val(),
                    college_name:$("#college-name").html(),
                    college_type:$("#college-type").val(),
                    college_area:$("#college-area").val(),
                    college_city:$("#college-city").val(),
                    college_state:$("#college-state").val(),
                    contact_name:$('#contact-name').val(),
                    contact_email1:$('#contact-email1').val(),
                    contact_email2:$('#contact-email2').val(),
                    contact_phone1:$('#contact-phone1').val(),
                    contact_phone2:$('#contact-phone2').val(),
                    contact_address:$('#contact-address').val(),
                    boys_hostel:$("#boys_hostel").is(':checked'),
                    girls_hostel:$("#girls_hostel").is(':checked'),
                    internet:$("#internet").is(':checked'),
                    library:$("#library").is(':checked'),
                    computer_lab:$("#computer_lab").is(':checked'),
                    gym:$("#gym").is(':checked'),
                    sports_ground:$("#sports_ground").is(':checked'),
                    transport:$("#transport").is(':checked'),
                    scholarship:$("#scholarship").is(':checked'),
                    gross_fees:$("#gross_fees").val(),
                    college_university:$("#college-university").val(),
                    management:$("#management").is(':checked'),
                    management_input:$("#management-input").val(),
                    outside_state:$("#outside_state").is(':checked'),
                    outside_state_input:$("#outside_state-input").val(),
                    within_state:$("#within_state").is(':checked'),
                    within_state_input:$("#within_state-input").val(),
                    connectivity:connect,
                    category:$("#category").is(':checked'),
                    category_input:$("#category-input").val(),
                    latitude:$("#lat").html(),
                    longitude:$("#lng").html(),
                    <?php
                        $availtypes=mysqli_query($con,'select * from college_entrance_test where cid = '.$cid);
                        while($type=mysqli_fetch_assoc($availtypes))
                        {
                            $name= $type['name'];
                            $type= $type['type'];
                            echo $type.'_placement_tab: JSON.stringify(tableToJson(document.getElementById("'.$type.'-placement-table"))),
                            ';
                             echo $type.'_placement_tab1: JSON.stringify(tableToJson(document.getElementById("'.$type.'-placement-table1"))),
                            ';
                             echo $type.'_placement_year:$("#'.$type.'-placement-year").val(),
                            ';
                        }
                        echo 'fee_table:JSON.stringify(tableToJson(document.getElementById("fee-table"))),' ?>
                })
                .done(function(data){
                    $("body").css("overflow","auto");
                    $("#waiting").css("display","none");
                    alert(data);
                })
                .fail(function(data) {
                    $("body").css("overflow","auto");
                    $("#waiting").css("display","none");
                    alert("Network error... Failed to save");
                })
                
            setConfirmUnload(false);
        }
        <?php
        if (isset($_SESSION['truth'])) {
            echo '
             $("#dean-mail-form").submit(function(){
                $("#myModal").modal("hide");
            var data=$(this).serialize();
            jQuery.ajax({
                url:"php/send-mail-dean.php",
                data:data,
                type:"POST",
                success:function(data){
                    console.log(data);
                    alert("Mail successfully sent");
                },
                fail:function(){
                    alert("Error sending Mail");
                  }  
                })
            return false;
        });
            ';
        }
        ?>

        function setimgdelete(){
            var number=<?php echo $cid; ?>;
            jQuery.ajax({
                url: "php/get-images-list.php?cid="+<?php echo $cid; ?>,
                type:"GET",
                success:function(data)
                {
                    var images=JSON.parse(data);
                    var txt='<table class="table"><thead><tr><td>Sl no</td><td>Preview</td><td>Name</td><td>Action</td></tr>',no=1;
                    for (var i = 0; i < images.length; i++){
                        txt+='<tr id="image'+images[i]+'"><td>'+(i+1)+'</td><td><img src="data/'+number+'/images/thumbnail/'+images[i]+'"></td><td>'+images[i]+'</td><td><button class="btn btn-danger" onclick="deleteimg(\''+images[i]+'\')">Delete</button></td></tr>'
                    };
                    txt+='</table>';
                    $(".img-delete").html(txt);
                },
                error:function(data)
                {
                    $(".img-delete").html("Server error<br>Failed to fetch the image captions...");
                }
            })
        }
        function get_caption()
        {
            jQuery.ajax({
                url: "php/get-image-caption.php?cid="+<?php echo $cid; ?>,
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
                url: "php/link-submit.php?cid="+cid,
                type:"POST",
                data:$("#link-table").serialize(),
                success:function(data)
                {
                    refresh_links(cid);
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
        refresh_links(cid);
        refresh_gallery();
        document.addEventListener("keydown", function(e) {
          if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
           savecollegedata();
          }
        }, false);
        load(<?php  
            $query = mysqli_fetch_array(mysqli_query($con,"select latitude,longitude from college_id where cid=".$cid));
                        echo $query['latitude'].",";
                        echo $query['longitude']
        ?>);
    </script>
</body>
</html>
