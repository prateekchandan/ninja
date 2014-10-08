<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
$path_chk="../data/".$cid."/";
if ($handle = opendir($path_chk.'img-alt')) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." && $entry!="thumbnail")
       {
       		unlink($path_chk."img-alt/".$entry);
       }
    }
}
if ($handle = opendir($path_chk.'images')) {
$count=0;
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." && $entry!="thumbnail")
       {
       		$file = fopen($path_chk."img-alt/".$entry.".txt", "w");
       		fwrite($file,addslashes($_POST["a".$count]));
       		$count+=1;
       		fclose($file);
       }
    }
}
?>



