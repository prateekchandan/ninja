<?
include 'php/dbconnect.php';
function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
if(isset($_GET['exam'])){
  $a=mysqli_real_escape_string($con,$_GET['exam']);
  $q=mysqli_query($con,"select * from exam where link = '".$a."'");
  if (mysqli_num_rows($q)==0) {
    header('location:./');
  }
  else{
    $eid_arr=array();
    while($row=mysqli_fetch_assoc($q)){
      $name=$row['name'];
      array_push($eid_arr, $row['eid']);
    }
  }
}
else{
  header('location:./');
}

$title=$name." Cut off";
$desc="";

$pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }

?>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta name="title" content="<?php echo $title ?>">
    <meta name="description" content="<?php echo $desc ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan,career counsellig">
    <meta name="author" content="Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="<?php echo $title ?>"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/career/seo2.jpg"/>
    <meta property="og:url" content="<? echo $pageURL;?>"/>
    <meta property="og:description" content="<?php echo $desc ?>"/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="<?php echo $title ?>">
    <meta itemprop="description" content="<?php echo $desc ?>">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    <meta property="fb:admins" content="prateekchandan5545"/>
    
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link rel="stylesheet" href="./data/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="./data/font-awesome/css/font-awesome.css"/> 
</head>
<body>
<? include 'header.php';?>

<div class="container">
  <img src="img/exams-banner.jpg" style="width:100%">
  <h1><? echo $name; ?></h1>
  <hr>
  <p>Description about exam..<br>
  At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
   <h3>Chose the college to see cutoffs</h3>
  <ol>
    <?
      $str='select distinct cid from college_entrance_test where ';
      $i=0;
      foreach ($eid_arr as $value) {
        if($i>0){
          $str.=' && ';
        }
        $i++;
        $str.='name = '.$value;
      }
      $q=mysqli_query($con,$str);
      while($row=mysqli_fetch_assoc($q)){
        $college=mysqli_query($con,'select * from college_id where cid='.$row['cid'].' && disabled=1');
        if(mysqli_num_rows($college)==0)
          continue;
        $college=mysqli_fetch_assoc($college);
        echo '<li>';
        $url=clean($college['name']).'-'.$college['city'].'-'.$college['link'];
        echo '<a href="college/'.$url.'&tab=admission">'.$college['name'].'</a>';
        echo '</li>';
      }

    ?>
  </ol>
</div>


<?include 'footer.php';?>
</body>
</html>