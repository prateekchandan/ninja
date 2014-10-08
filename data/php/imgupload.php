<?php
$upload_path="../tmp/";
$img=$_POST['file'];
echo getimagesize($img);
//echo file_get_contents($_FILES["file"]["tmp_name"])."<br>" ;
$allowedExts = array("gif", "jpeg", "jpg", "png","JPG","jfif");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2*1024*1024)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . (intval($_FILES["file"]["size"] / 1024)) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
   /* if (file_exists($upload_path . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {*/
      move_uploaded_file($_FILES["file"]["tmp_name"],$upload_path . $_FILES["file"]["name"]);
      echo "<br>Stored in: " . $upload_path. $_FILES["file"]["name"];
      //}
    }
  }
else
  {
  	 echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . (intval($_FILES["file"]["size"] / 1024)) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
     echo "Invalid file";
  }
?>