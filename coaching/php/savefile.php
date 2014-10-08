<?php
session_start();
if(isset($_SESSION['coachingid']))
    {
        $cid=$_SESSION['coachingid'];
    }
    else
    {
        die("error");
    }

$path_chk="../data/".$cid."/";
  if(isset($_POST['about_coaching'])){
  $file = fopen($path_chk."about.txt", "w");
  fwrite($file,$_POST['about_coaching']);
  fclose($file);
}
  if(isset($_POST['usp'])){
  $file = fopen($path_chk."usp.txt", "w");
  fwrite($file,$_POST['usp']);
  fclose($file);
}

 if(isset($_POST['test'])){
  $file = fopen($path_chk."test.txt", "w");
  fwrite($file,$_POST['test']);
  fclose($file);
}
if(isset($_POST['result'])){
  $file = fopen($path_chk."resultinfo.txt", "w");
  fwrite($file,$_POST['result']);
  fclose($file);
}

 if(isset($_POST['testinfo'])){
  $file = fopen($path_chk."testinfo.txt", "w");
  fwrite($file,$_POST['testinfo']);
  fclose($file);
}
 if(isset($_POST['usptest'])){
  $file = fopen($path_chk."usptest.txt", "w");
  fwrite($file,$_POST['usptest']);
  fclose($file);
}

 if(isset($_POST['programoffered'])){
  $file = fopen($path_chk."programoffered.txt", "w");
  fwrite($file,$_POST['programoffered']);
  fclose($file);
}

 if(isset($_POST['scholarships'])){
  $file = fopen($path_chk."scholarships.txt", "w");
  fwrite($file,$_POST['scholarships']);
  fclose($file);
}
 if(isset($_POST['financebenefits'])){
  $file = fopen($path_chk."financebenefits.txt", "w");
  fwrite($file,$_POST['financebenefits']);
  fclose($file);
}
echo $_POST['scholarships'];


?>