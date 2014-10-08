<?php

if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
$c=0;
$return=array();
$path_chk="../data/".$cid."/";
$link=['weblink','fblink','twitterlink','pluslink','linkedlink'];
foreach ($link as $entry) {
   $file = fopen($path_chk."contact/".$entry.".txt", "a+");
          $alt= fgets($file);
          fclose($file);
         array_push($return, $alt);
}
echo json_encode($return);
?>



