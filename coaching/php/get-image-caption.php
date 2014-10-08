<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
$path="data/".$cid."/";
$path_chk="../data/".$cid."/";
$return='<form id="img-cp-edit" role="form" method="post"><table class="table form-group"><thead><th>Image</th><th>Name</th><th>Caption</th></thead>';
if ($handle = opendir($path_chk.'images')) {
	$count=0;
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." && $entry!="thumbnail")
       {
        if(file_exists($path_chk."img-alt/".$entry.".txt"))
            {
                $file = fopen($path_chk."img-alt/".$entry.".txt", "r") or exit("Unable to open file!");
                $alt= fgets($file);
                fclose($file);
            }
            else
                $alt="";
            $filename=$path."images/thumbnail/".$entry;
            $return.='<tr><td><img src="'.$filename.'"></td><td>'.$entry.'</td><td><input type="text" name="a'.$count.'" value="'.addslashes($alt).'" class="form-control" maxlength="80" width="50%"></td></tr>';
            $count+=1;
       }
    }
    closedir($handle);
}
$return.="</table></form>";
echo $return;