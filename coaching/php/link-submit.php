<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;

$path_chk="../data/".$cid."/";
$link=['weblink','fblink','twitterlink','pluslink','linkedlink'];
foreach ($link as $entry) {
   $file = fopen($path_chk."contact/".$entry.".txt", "w");
          fwrite($file,$_POST[$entry]);
          fclose($file);
}
?>



