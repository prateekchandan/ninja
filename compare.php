<?php
error_reporting(0);
include 'php/dbconnect.php';
$c=0;
$cid=array();
for ($i=0; $i < 4; $i++) {
	 if(!isset($_GET["link".$i])) 
	 	continue;
	 $co=$_GET["link".$i];
	 $co = str_replace("'", '', $co);
	  $co = str_replace('"', '', $co);
	  $co=mysqli_real_escape_string($con,$co);
	  $co = str_replace("\\n", '', $co);
	  $co = str_replace("\\r", '', $co);
	 if($co=="")
	 	continue;
            $query=mysqli_query($con,"select cid from college_id where link='".$co."'");
            if(mysqli_num_rows($query)>0)
            {
            	array_push($cid, mysqli_fetch_assoc($query)['cid']);
            	$c+=1;
            }
}

$q='select * from college_id where cid = ';
$i=0;
foreach ($cid as $key) {
	if($i==0)
	$q.=$key;
	else
		$q.=" || cid =".$key;
	$i+=1;
}
$q=mysqli_query($con,$q);
$row = array();
$num_rows = mysqli_num_rows($q);
while($num_rows--){
	$ar=mysqli_fetch_assoc($q);
	$row[$ar['cid']]=$ar ;
}
$tocomp=$c;
$temp = 4;
$examq=mysqli_query($con,"select * from exam");
$exam = array();
while($row1=mysqli_fetch_assoc($examq)){
	$exam[$row1['eid']]=$row1['name'];
}

$user=0;
?>

<html>
<head>
    <title>Infermap | Compare Colleges</title>
    <meta name="title" content="Infermap - Next Generation Education Portal">
    <meta name="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="Infermap - Next Generation Education Portal"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/social.png"/>
    <meta property="og:url" content="http://www.infermap.com"/>
    <meta property="og:description" content="Infermap is a free comprehensive platform 
        that improves the college selecting process, based on individual resources and 
        requirements. Inspired by a belief that all students deserve access to good guidance, 
        infermap aims to create the interactive tools and media that guide students as they find,
         afford and enroll in a college that’s a good fit for them."/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="Infermap - Next Generation Education Portal">
    <meta itemprop="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link href="data/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <style type="text/css">
    	.college_name{
    		height: 65px;
    	}
    </style>
</head>
<div>

<?php
 include "header.php"; ?>
 	<div class="container">
			<img id="paperflip" src="img/paperflip.png" style="position:relative;top:223px;left:0px;width:20%;height:auto">
		<table id="compare-table">
			
			<tr>
				<td id="paperflipcontainer">
					
				</td>
				<?php
				$p=0;
				foreach ($cid as $key) {
					$p++;
					if(file_exists("data/data/".$key."/logo.png"))
						$imgsrc="data/data/".$key."/logo.png";
					else
						$imgsrc="img/center-icon.jpg";
					echo '<td id="td'.$p.'"><div class="college-short-profile">
						<div class="close" onclick="cancel('.$p.')">&times;</div>
					<div class="img-container"><img src="'.$imgsrc.'" height="100px" width="100px"></div><strong><div class="college_name"><a href="data/cp.php?cid='.$row[$key]['link'].'" target="_blank">'.$row[$key]['name'].'</a></div></strong></div></td>';
					if($p!=$temp) echo '<div id="hb'.$p.'" style="background-color:#AEAEAE;width:1px;position:absolute"></div><div id="ball'.$p.'" style="position:absolute;height:8px;width:8px;border-radius:4px;background-color:#AEAEAE"></div>';
				}
				for(; $p < $temp;){
					$p++;
					echo '<td id="td'.$p.'"><a class="addcollege" onclick="addcollege('.$p.')">Add College<a></td>';
					if($p!=$temp) echo '<div id="hb'.$p.'" style="background-color:#AEAEAE;width:1px;position:absolute"></div><div id="ball'.$p.'" style="position:absolute;height:8px;width:8px;border-radius:4px;background-color:#AEAEAE"></div>';
				}
				?>
			</tr>
			<tr> 
			<td><strong>Affilated to</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$univ=$row[$key]['university'];
						if($univ=="")
							$univ="--";
						echo "<td>".$univ."</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Government / Private</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$type=$row[$key]['type'];
					if($type==""||$type=="-Not Selected-")
						$type="No info";
						echo "<td>".$type."</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>City</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$field=$row[$key]['city'];
					if($field==""||$field=="-Not Selected-")
						$field="No info";
						echo "<td>".$field."</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>State</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$field=$row[$key]['state'];
					if($field==""||$field=="-Not Selected-")
						$field="No info";
						echo "<td>".$field."</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Entrace Exam</strong></td>
				<?php
					$q="select * from college_entrance_test where (type='btech' || type='be') && (cid=";
					$i=0;
					$p=0;
					foreach ($cid as $key) {
						$p++;
						if($i==0)
						$q.=$key;
						else
							$q.=" || cid =".$key;
						$i+=1;
					}

					$q.=")";
					$examname = array();
					foreach ($cid as $key) {
						$examname[$key]=[];
					}
					$query=mysqli_query($con,$q);
					while($r=mysqli_fetch_assoc($query)){
						if($r['name']!=0)
						array_push($examname[$r['cid']], $exam[$r['name']].' ('.$r['type'].")");
					}
					foreach ($cid as $key) {
						echo "<td>";
						$i=0;
						foreach ($examname[$key] as $ename) {
							if($i>0)
								echo "<br>";
							echo $ename;
							$i+=1;
						}
						echo "</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Departments</strong></td>
				<?php
					$q=mysqli_query($con,"select * from departments");
					$dept=array();
					while($r=mysqli_fetch_assoc($q)){
						$dept[ $r['key']]=$r['value'];
					}
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$q=mysqli_fetch_assoc(mysqli_query($con,"select * from college_department where cid=".$key));
						echo "<td>";
						$i=0;
						foreach ($dept as $kd => $value) {
							if($q[$kd]==1){
								if($i>0)
								echo "<br>";
								echo $value;
								$i+=1;
							}
						}
						echo "</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Annual Fee in ₹</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$fee=$row[$key]['gross_fees'];
						if($fee=='0')
							echo "<td>No info</td>";
						else
							echo "<td>".$fee."</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Scholarships</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['scholarship'];
						if($data=='1')
							echo "<td>Offered</td>";
						else if($data=='0')
							echo "<td> Not Offered</td>";
						else
							echo "<td>No info</td>";

					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Boys Hostel</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['boys_hostel'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Girls Hostel</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['girls_hostel'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Sport Facilities	</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['sports_ground'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Internet</strong></td>
				<?php
				$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['internet'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Library</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['library'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>Computer Lab</strong></td>
				<?php
					$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['computer_lab'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
			<tr>
				<td><strong>College Transport</strong></td>
				<?php
				$p=0;
					foreach ($cid as $key) {
						$p++;
						$data=$row[$key]['transport'];
						if($data=='1')
							echo "<td>Present</td>";
						else if($data=='0')
							echo "<td> Not Present</td>";
						else
							echo "<td>No info</td>";
					}
					for(; $p < $temp;){
						$p++;
						echo '<td></td>';
					}
				?>
			</tr>
		</table>
	</div>
	<?php
		include "footer.php";
	?>
	
</div>
<div class="modal fade" id="add-college-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title">Select Your College to add</h4>
      </div>
      <div class="modal-body college-modal">
        <label>Select College to add:</label>
        <input type="hidden" value="-1" id="toadd">
        <input class="form-control" id="college-name">
        <div class="well" id="message">
        	Select college from above to add
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="showcollege()">GO</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style type="text/css">
#mydiv{
	padding: 4px;
	background: #111;
	border-top: 1px solid orange;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
table, th, td
{
	border-right: 1px solid #AEAEAE;
}
#td1 , #td2, #td3 , #td4{
	vertical-align: inherit;

}
.addcollege{
	color: #02294A;
	font-weight: bold;
	border: 1px solid #ccc;
	 padding: 15%; 
	padding-top: 30%;
	padding-bottom: 30%;
	box-shadow: 0px 0px 4px #eee;
	cursor: pointer;
	background: url(img/addcollege.png);
	background-size: cover;
}
.addcollege:hover,.addcollege:focus{
	color:#02294A;
}

.college-short-profile{
	background-color: ;
	padding: 5%;
}

.college-short-profile a{
	text-decoration: none;
	color: black;
}

#compare-table{
	width: 100%;
	line-height: 1.5em;
	border:1px solid #999;
	box-shadow: 0px 0px 10px #888;
	margin-top: -77px;
}

#compare-table td{
	width: 20%;
}

tr{
	text-align: center;
}


.img-container{
	width:auto;
	height: auto;
	margin-bottom: 30px; 
}



td:nth-child(1){
	padding-top: 0px;
	text-align: right;
	padding-right:2%;
	background-color: white;
	line-height: 2.5em;
	border:0px solid black;
	color: white;
}

tr:nth-child(even) td{
	background-color: #E8E8E8;
}

tr:nth-child(odd) td:nth-child(1){
	background-color: #022543;
}

tr:nth-child(even) td:nth-child(1){
	background-color: #02294A;
}

tr:nth-child(1) td:nth-child(1){
	padding-right: 0px;
	padding-left: 2%;
	background-color: white;
}

tr:nth-child(1) td{
	border-right: 0px solid white;
	height:300px;
}

.college-modal>.twitter-typeahead{
	width:100%;
}
</style>
<script src="./data/js/jquery.js"></script>
<script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/typeahead.js"></script>
<script type="text/javascript">
 var bestPictures = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: './college.json',
  remote: './college.json'
});
 
bestPictures.initialize();


$('#college-name').typeahead(null, {
  name: 'best-pictures',
  displayKey: 'value',
  source: bestPictures.ttAdapter()
});
var collegesp=[<?php
	$i=0;
	foreach ($cid as $key) {
		if($i>0)
			echo ",";
		echo $key;
		$i++;
	}
	while($i<4)
	{
		if($i>0)
			echo ",";
		echo "0";
		$i++;
	}

?>];


function setpositions(){
	 var x = $('#paperflipcontainer').position().left;
	var y = $('#paperflipcontainer').position().top;
	var w = $('#paperflipcontainer').width()-5;
	var h = $('#paperflipcontainer').height();
	/*$('#paperflip').width(w);
	$('#paperflip').css('left', x+15);
	$('#paperflip').css('top', y+h-$('#paperflip').height()+2);*/

	for(var i = 1; i < 5; i++){
		var x = $('#td'+i).position().left;
		var y = $('#td'+i).position().top;
		var w = $('#td'+i).width();
		var h = $('#td'+i).height();
		$('#hb'+i).css('top',y+h/4+2);
		$('#hb'+i).css('left',x+w+2);
		$('#hb'+i).css('height',3*h/4);
		$('#ball'+i).css('top',y+h/4-2);
		$('#ball'+i).css('left',x+w-2);
	}
}
function addcollege(i){
	$('#add-college-modal').modal('show');
	$('#toadd').val(i);
}

var colleges;
function putcollege(arr){
	var added=$('#toadd').val();
	if(arr['cid']==collegesp[0]||arr['cid']==collegesp[3]||arr['cid']==collegesp[2]||arr['cid']==collegesp[1])
	{
		alert("College already present");
		return false;
	}
	collegesp[added]=arr['cid'];
	$("#college-name").val("");
	$("#message").html("type a college name to add");
	$('#add-college-modal').modal('hide');
	var added=$('#toadd').val();
	$("#compare-table tr").each(function(rowIndex) {
	    $(this).find("td").each(function(cellIndex) {
	        if (cellIndex==added){
	        	switch(rowIndex){
	        		case 0:
	        			$(this).html(arr['main']);
	        		break;
	        		case 1:
	        			if(arr['university']=='')
	        				$(this).html("");
	        			else
	        				$(this).html(arr['university']);
	        			break;
	        		case 2:
	        			if(arr['type']==''||arr['type']=='-Not Selected-')
	       				 $(this).html("");
	        			else
	        				$(this).html(arr['type']);
	        			break;
	        		case 3:
	        			if(arr['city']=='')
	        				$(this).html("");
	        			else
	        				$(this).html(arr['city']);
	        			break;
	        		case 4:
	        			if(arr['state']=='')
	        				$(this).html("");
	        			else
	        				$(this).html(arr['state']);
	        			break;
	        		case 5:
	        			$(this).html(arr['exam']);
	        			break;
	        		case 6:
	        			$(this).html(arr['depts']);
	        			break;
	        		case 7:
	        			if(arr['gross_fees']=='0'||arr['gross_fees']=='')
	        				$(this).html("No info");
	        			else
					        $(this).html(arr['gross_fees']);
	        			break;
	        		case 8:
	        			if(arr['scholarship']=='1')
	        				$(this).html("Present");
	        			else if(arr['scholarship']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 9:
	        			if(arr['boys_hostel']=='1')
					        $(this).html("Present");
	        			else if(arr['boys_hostel']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 10:
	        			if(arr['girls_hostel']=='1')
	        				$(this).html("Present");
	        			else if(arr['girls_hostel']=='0')
	        				$(this).html("Not Present");
	        			else
					        $(this).html("No info");
	        			break;
	        		case 11:
	        			if(arr['sports_ground']=='1')
	        				$(this).html("Present");
	        			else if(arr['sports_ground']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 12:
	        			if(arr['internet']=='1')
	        				$(this).html("Present");
	        			else if(arr['internet']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 13:
	        			if(arr['library']=='1')
	        				$(this).html("Present");
	        			else if(arr['library']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 14:
	        			if(arr['computer_lab']=='1')
	        				$(this).html("Present");
	        			else if(arr['computer_lab']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		case 15:
	        			if(arr['transport']=='1')
	        				$(this).html("Present");
	        			else if(arr['transport']=='0')
	        				$(this).html("Not Present");
	        			else
	        				$(this).html("No info");
	        			break;
	        		default:
	        			$(this).html("--");
	        	}
	        }
	    });
    });
}
function showcollege(){
	var rn=$("#toadd").val(),name=$("#college-name").val();
	jQuery.ajax({
		url:"php/compareadd.php",
		type:"POST",
		data:{key:name,no:$('#toadd').val()},
		success:function(data){
			if(data=="null"){
				$("#message").html("No college found");
			}
			else{
				if(data.substr(0,7)=="college")
				{
					arr=JSON.parse(data.substr(7));
					putcollege(arr);
				}
				else if(data.substr(0,7)=="keyword")
				{
					colleges=JSON.parse(data.substr(7));
					var cnt=0;
					var str="Click on one of the following to add:<ul>";
					for(var key in colleges)
					{
						str+='<li><a onclick="putcollege(colleges['+key+'])">'+colleges[key]['name']+'</a></li>'
						cnt++;
					}
					str+='</ul>';
					if(cnt==0)
						$("#message").html("The college not found try again");
					else
					{
						$("#message").html(str);
					}
					$("#message").append('</ul>');

				}
				else{
					$("#message").html("Some error occured");
				}
			}
			
		},
		error:function(){
			$("#message").html("Connection error");
		}
	})

}
function cancel(i){
	collegesp[i]=0;
	$("#compare-table tr").each(function(rowIndex) {
    $(this).find("td").each(function(cellIndex) {
        if (cellIndex==i){
        	if(rowIndex==0)
        		$(this).html("<a class=\"addcollege\" onclick=\"addcollege("+i+")\">Add College</a>");
        	else
            	$(this).html("--");
        }

    });
});
}
$('#college-name').keydown(function(event) {
  if(event.keyCode == '13') {
    showcollege();
  }
});

$( window ).resize(function() {
 setpositions();
});
$(window).load(setpositions);
</script>
</html>