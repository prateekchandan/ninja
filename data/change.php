<!DOCTYPE html>
<html>
<?php phpinfo(); ?>
<head>
	<title>Closing-Rank Analyzer</title>
</head>
<style type="text/css">
	table{
		width:100%;
	}
	td{
		border:1px solid #440055;
		width:150px;
		text-align: center;
	}
</style>
<body>
<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
$query=mysqli_query($con,"select * from exam");
while($exam=mysqli_fetch_assoc($query))
{
	$name=$exam['eid'];
	$type=$exam['type'];
	$exam_name=$exam['name'];
	if($name==0)
		continue;
	$q=mysqli_query($con,"select distinct college_id.name,college_id.cid from college_entrance_test,college_id where college_entrance_test.name=".$name." && college_entrance_test.cid=college_id.cid");
	echo "<h1>".$exam_name."</h1><h2>".$type."</h2>";
	while($college=mysqli_fetch_assoc($q))
	{
		$cid=$college['cid'];
		$newq=mysqli_query($con1,"select * from t".$cid." where name=".$name." && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0))");
			echo "<h4>".$college['name']."</h4><table>";
			while($field=mysqli_fetch_assoc($newq))
			{
				echo "<tr>";
				echo "<td>".$field['department']."</td>";
				echo "<td>".(($field['gen']==0)?"-":$field['gen'])."</td>";
				echo "<td>".(($field['obc']==0)?"-":$field['obc'])."</td>";
				echo "<td>".(($field['sc']==0)?"-":$field['sc'])."</td>";
				echo "<td>".(($field['st']==0)?"-":$field['st'])."</td>";
				echo "<td>".(($field['state']==0)?"-":$field['state'])."</td>";
				echo "<td>".(($field['rg_obc']==0)?"-":$field['rg_obc'])."</td>";
				echo "<td>".(($field['rg_sc']==0)?"-":$field['rg_sc'])."</td>";
				echo "<td>".(($field['rg_st']==0)?"-":$field['rg_st'])."</td>";
				echo "</tr>";
			}
			echo "</table>";
	}
}
?>
</body>
</html>