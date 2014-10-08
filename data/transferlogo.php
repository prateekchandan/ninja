<html>
<head>
    <title>Logo analysis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    

    </style>
</head>
<?php
function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
$st=$_GET['st'];
$en=$_GET['en'];
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$q=mysqli_query($con,"select * from college_id");
@mkdir('./data/logo',0755);
echo '<table class="table"><tr><th>College name</th><th>Image</th><th>Size</th>';
while($row=mysqli_fetch_assoc($q)){
	$cid=$row['cid'];
	if($cid<$st||$cid>$en){
		continue;
	}
	if(file_exists('./data/'.$cid.'/logo.png'))
	{
		copy('./data/'.$cid.'/logo.png', './data/logo/'.$cid.'.png');
		echo '<tr><td>'.$row['name'].'</td>';
		echo '<td><img src = "./data/logo/'.$cid.'.png"></td>';
		echo '<td>'.formatSizeUnits(filesize('./data/logo/'.$cid.'.png')).'</td>';
		echo '</tr>';
	}
}
echo '</table>';
?>
<?php
/*
    $zipname = 'logo.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    if ($handle = opendir('./data/logo')) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && !strstr($entry,'.php')) {
            $zip->addFile($entry);
        }
      }
      closedir($handle);
    }

    $zip->close();

    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename='logo.zip'");
    header('Content-Length: ' . filesize($zipname));
    header("Location: logo.zip");*/

    ?>