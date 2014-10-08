<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
$path="../data/".$cid."/";
$img=$_GET['img'];
unlink($path."images/".$img);
unlink($path."images/thumbnail/".$img);
echo "success";
?>