<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;
print_r($_FILES);
$uploaddir = '../data/'.$cid.'/';
$uploadfile = $uploaddir . basename("logo.png");


if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo $uploaddir." ".$uploadfile;

?>
