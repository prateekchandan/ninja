<?php
session_start();
  if(!isset($_SESSION['datauserid']))
  {
    die("error");
  }
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$catQuery=mysqli_query($con,"select * from category");
$categories=[];
$i=0;
while($row=mysqli_fetch_assoc($catQuery))
{
    $a=['id'=>$row['id'],'name'=>$row['name']];
    $categories[$i]=$a;
    $i+=1;
}
$link=substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCD7658123490EFGHIJKLMNOPQRSTUVWXYZ"), 0, 10).substr(md5(time()),4,10);
$uid=$_SESSION['datauserid'];
$query=mysqli_fetch_array(mysqli_query($con,"select * from datafeeder where uid='".$uid."'")) or die(mysql_error());
$pages=json_decode($query['pages']);
$college_name=mysqli_real_escape_string($con,$_POST['inputName']);
$college_query=mysqli_query($con, 'select * from `college_id` where name="'.$college_name.'"');
$cid=0;
if(mysqli_num_rows($college_query)==0)
{
	mysqli_query($con,"insert into college_id (name,link) values('".$college_name."','".$link."')");
	$cid=mysqli_fetch_array(mysqli_query($con,"select * from `college_id` where name='".$college_name."'"))['cid'];
	array_push($pages, intval($cid));
	mysqli_query($con,"update datafeeder set pages='".json_encode($pages)."' where uid='".$uid."'");
}
else
{
	$cid=mysqli_fetch_array(mysqli_query($con,"select * from college_id where name='".$college_name."'"))['cid'];
}
mysqli_query($con,"delete from college_entrance_test where cid=".$cid);
$exams=mysqli_query($con,"select * from allcourses");
  while($row=mysqli_fetch_assoc($exams))
    {
    	if(isset($_POST[$row['name'].'-select']))
    	{	
    		$query="insert into college_entrance_test (`cid`,`type`,`name`,";
			$all=[];
			$iter=0;
			foreach ($categories as $key) {
			    $all[$iter]=$key['id'];
			    $iter+=1;
			}
			$append=" values (".$cid.",'".$row['name']."',0,";
			for ($i=0; $i < sizeof($all); $i++) { 
				$query.="`".$all[$i]."`";
					$append.="0";
				if($i!=sizeof($all)-1)
				{
					$append.=",";
					$query.=",";
				}
			}
			$query.=")".$append.")";
			mysqli_query($con,$query);
		}
    }
    if(!is_dir("../data/".$cid))
		mkdir("../data/".$cid, 0755);
$path="../data/".$cid."/";
$directory=['about','academics','admissions','contact','facilities','fees','images','img-alt','placements'];
foreach($directory as $dir)
	{
		if(!is_dir($path.$dir))
			mkdir($path.$dir, 0755);
	}
mysqli_query($con1,"create table fee_t".$cid." like fee_t1");
mysqli_query($con1,"create table t".$cid." like t1");
mysqli_query($con1,"create table placement_t".$cid." like placement_dummy");
mysqli_query($con,"insert into college_department (`cid`) values (".$cid.")");
?>