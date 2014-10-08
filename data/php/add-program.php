<?php
session_start();

  if(!isset($_SESSION['datauserid'])&&!isset($_SESSION['truth']))
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
if(!isset($_POST['cid']))
	die("error");
$cid=$_POST['cid'];
$exams=mysqli_query($con,"select * from allcourses");
  while($row=mysqli_fetch_assoc($exams))
    {
    	if(isset($_POST[$row['name']]))
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
echo "ok";
?>