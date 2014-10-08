<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
$path="data/".$cid."/";
$path_chk="../data/".$cid."/";
$return='[';
if ($handle = opendir($path_chk.'images')) {
	$count=0;
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." && $entry!="thumbnail")
       {
            if($count!=0)
                $return.=",";
            $count+=1;
            $return.='"'.$entry.'"';
       }
    }
    closedir($handle);
}
$return.="]";
echo $return;