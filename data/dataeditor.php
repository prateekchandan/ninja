<?php
	session_start();
	if(isset($_SESSION['datauserid']))
	{
		$uid=$_SESSION['datauserid'];
	}
	else
	{
		header("Location: datafeeder.php");
	}
	$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
	$query=mysqli_fetch_array(mysqli_query($con,"select * from datafeeder where uid='$uid'")) or die(mysql_error());
	$pages=json_decode($query['pages']);
	$password=$query['password'];
	$name=$query['name'];
	function encrypt($string)
	{
		$key="StudPrateek";
		$return = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
		return $return;
	}
?>
<!Doctype HTML>
<html>
	<head>
		<title>Edit Your Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css"/>
        <link href="fonts/googleapi.css" rel="stylesheet"/>
        <link rel="icon" href="img/icon.png" type="image/x-icon">

        <style>
        body{
        	background: url('img/geometry.png');
        	font-family: "open sans" , serif;
        	color:#333;
        }
        body a{
        	color:#fcfcef;
        }
        body a:hover{
        	color:#fcfcef;
        }
        #main{
        	margin-top: 90px;
        	background-color: rgba(250,250,230,0.1);
        	min-height: 500px;
        }
        #uname{
        	font-family: "love ya" , serif;
        	margin-left:50px;
        	font-size: 2.5em;
        	margin-top: 15px;
        }
        .btn-custom {
			  background-color: hsl(0, 69%, 22%) !important;
			  background-repeat: repeat-x;
			  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#b42121", endColorstr="#5e1111");
			  background-image: -khtml-gradient(linear, left top, left bottom, from(#b42121), to(#5e1111));
			  background-image: -moz-linear-gradient(top, #b42121, #5e1111);
			  background-image: -ms-linear-gradient(top, #b42121, #5e1111);
			  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #b42121), color-stop(100%, #5e1111));
			  background-image: -webkit-linear-gradient(top, #b42121, #5e1111);
			  background-image: -o-linear-gradient(top, #b42121, #5e1111);
			  background-image: linear-gradient(#b42121, #5e1111);
			  border-color: #5e1111 #5e1111 hsl(0, 69%, 17%);
			  color: #fff !important;
			  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.33);
			  -webkit-font-smoothing: antialiased;
			}
			.btn-custom1 {
				color:#333;
			    background-color: rgba(250,250,250,0.55) !important;
			    border-color: #53bf6b;

			}
			.btn-custom1:hover {
				color:#000;
			    background-color: rgba(250,250,250,0.45) !important;
			}
			.modal-content{
				margin-top: 80px;
				background-color: rgba(130,30,30,0.9);
			}
			.navbar-nav>li>a:hover{
				background-color: rgba(3,3,3,0.5);
			}
			.navbar-collapse {
    background-color: #02294A;
    border-color: #02294A;
    color: #fff;
    }
    .navbar-brand{
    	padding: 0px;

    }
    .navbar{
    	padding-left:0px;
    }
    .navbar-nav>li>a{
       color:#fff !important;
    }
    .search-box {
    	
    }
    .modal{
    	color:#fff;
    }
    .twitter-typeahead{
    	background-color: white !important;
    	width:300px !important;
    	margin-top:10px !important;
    }
    .search-box>input{
    	margin-top: 10px;
    	width:300px;
    	background-color: transparent;
    }
    .tt-suggestions{
    	background-color: rgba(255,255,255,0.95);
    	color:#111;
    	border-radius: 4px !important;
    	min-width: 300px;
    }
    .tt-suggestion{
    	border-bottom: 1px solid #aaa!important;
    	border-radius: 2px;
    	padding-left: 10px !important;
    	padding-right: 10px !important;
    }
    .tt-hint{
    	top:4px !important;
    	left:12px !important;
    	color:rgba(8,8,8,0.3);
    	min-width: 280px !important;
    }
    .tt-query{
    	border-radius: 0px !important;
    }
    #search-college{
    	border-radius: 0px;
    	margin-bottom: 2px;
    }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-collapse navbar-fixed-top" role="navigation" style="min-height:30px;">
    <div class="navbar-brand" href="#">
            <a href="http://www.infermap.com">
                <img src="img/head.png" >
            </a>
        </div>
     <ul class="nav navbar-nav">
      <li>		<span class="search-box"><input class="form-control" id="search" placeholder="Type College Name to search.."/>
      	<button class="btn" id="search-college">GO</button></div></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
            <li id="nav-register-btn" class=""><a href="#" data-target="#modal_about_user" data-toggle="modal"><i class="fa fa-logout"></i>Account</a></li>
       <li id="nav-login-btn" class=""><a href="#" onclick="logout()"><i class="fa fa-logout"></i>Logout</a></li>
         </ul>
 	</nav>
    <div class="container" id="main">
    	<div id="uname"><?php echo "Welcome ".ucfirst($name)." ,";?></div>
    	<div class="col-md-7" style="min-height:400px ;">
    	<H4 class="col-md-11 col-md-offset-1" style="margin-top:50px;margin-bottom:30px;">Choose one of your registered colleges to edit </H4>
    	<div class="col-md-11 col-md-offset-1" >
    	<ol>
    	<?php
    	$q=mysqli_query($con,"select * from college_id");
    	$i=0;
    		while($row=mysqli_fetch_assoc($q)){
    			if(in_array($row['cid'], $pages)){
    				$i++;
    			echo "<li><a href=\"college-editable.php?link=".$row['link']."\"><button class='btn-custom1' style='width:80%; margin-bottom:20px; padding:10px;'>";
    			echo $row['name']."</button></a></li>";
    			}
    		}
    	?>
    	</ol>
    	</div>
    	</div>
    	<div class="col-md-5" style="border-left:1px solid #444; min-height:400px">
    	<div style="margin-top:30%;text-align:center"><strong><u>Or</u></strong></div>
    	<div class="col-md-11 col-md-offset-1">
    	<button class="btn btn-custom" style="margin-top: 5%;
        	  width:100%;
        	  height: 60px;
        	  font-size: 1.2em;" data-toggle="modal" data-target="#myModal">Register a new college</button>
    	</div>
    	</div>
    	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Enter details of your college</h4>
		      </div>
		      <div class="modal-body">
		      <form role="form"  method="post" id="mainform">
				    <div class="form-group">
			          <label for="inputName">
			            College Name
			          </label>
			          <input type="text" class="form-control" id="inputName" name="inputName" value="">
			            
			        </div>
			        <div class="form-group" >
			          <label for="">
			            Chose the Available Degrees for this institute:
			          </label>
			          <div id="stream_checkbox">
			          <table>
			            <?php
			              $i=0;
			              $exams=mysqli_query($con,"select * from allcourses");
			              while($row=mysqli_fetch_assoc($exams))
			              {if($i==0){
			                echo "<tr>";
			                $i=1;
			              }
			              else
			                $i=0;
			              echo '<td>
			              <label class="checkbox-inline">
			              <input type="checkbox"  value="'.$row['name'].'" id="'.$row['name'].'-select" name="'.$row['name'].'-select">
			              '.$row['value'].'
			              </label></td>
			              ';
			              if($i==0){
			                echo "</tr>";
			              }
			              }
			             ?>
			             </table>
			             </div>
			          </div>
		      		</form>
		      	</div>	
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button class="btn btn-danger" type="submit" id="reg-new-btn">Save changes</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="modal fade" id="modal_about_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		      </div>
		      <div class="modal-body">
		      	<form id="user_details_form">
		   		 <div class="form-group alert alert-danger" id="op-err" style="display:none" >
                         The old password is incorrect
                 </div>
                 <div class="form-group alert alert-danger" id="np-err" style="display:none" >
                          New Password and Old Password doesn't matches or Password is less than 6 characters
                  </div>
                   <div class="form-group alert alert-success" id="pass-succ" style="display:none" >
                         Password Successfully Changed
                  </div>
		        <div class="form-group">
				    <label for="u-name">Enter Name</label>
				    <?php echo '<input type="text" class="form-control"  name="uname" id="u-name" placeholder="Ex : Prateek Chandan" value= "'.$name.'" >';?>
				  </div>
				  <div class="form-group">
				    <label for="opass">Old password</label>
				    <input type="password" class="form-control"  name="opass" id="opass" placeholder="Old Password">
				  </div>
				   <div class="form-group">
				    <label for="npass">New password</label>
				    <input type="password" class="form-control"  name="npass" id="npass" placeholder="">
				  </div>
				   <div class="form-group">
				    <label for="rnpass">Retype New password</label>
				    <input type="password" class="form-control"  name="rnpass" id="rnpass" placeholder="">
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal" id="close-btn">Close</button>
		        <button class="btn btn-danger" type="submit" id="user_submit_btn">Save changes</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	    <script src="js/jquery.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="js/typeahead.min.js"></script>
	    <script>
	    $("#reg-new-btn").click(function(){
	    	var r=confirm("Submitting this form create changes everywhere \n\nIts your responsibility that about the correctness of data and maintaining intergrity of being a user\n\nPlease check the college name again and all the details which you have filled here as it cant be changed later \n\n\nAre You sure of its correctness ?");
		    if (r==true)
		    {
		       $.ajax({
		       	url:"php/new-college-entry.php",
		       	type:"POST",
		       	data:$("#mainform").serialize(),
		       	success:function(data){
		       		location.reload();
		       	},
		       	error:function(){
		       		alert("Network Error.. failed to save new college...");
		       	}
		       })
		    }
	    })
	    $("#user_submit_btn").click(function(){
	    	var np=$("#npass").val(),rnp=$("#rnpass").val(),op=$("#opass").val();
	    	$("#op-err").css("display","none");
	    	$("#np-err").css("display","none");
	    	$("#pass-succ").css("display","none");
	    		if(op==""||op.length<6)
	    		{
	    			$("#op-err").css("display","block");
	    			return false;
	    		}
	    		if(np==""||(np!=rnp)||np.length<6)
	    		{
	    			$("#np-err").css("display","block");
	    			return false;	
	    		}
	    	$.ajax({
	           type: "POST",
	           url: "php/change_password.php?"+$("#user_details_form").serialize(),
	           success: function(data)
	           {
	           	if(data=="error")
	           	{
	           		$("#op-err").css("display","block");
	    			return false;
	           	}
	           	else
	           	{
	           		$("#npass").val("");
	           		$("#rnpass").val("");
	           		$("#opass").val("");
	             	$("#pass-succ").css("display","block");
	         	}
	           },
	           error:function()
	           {
	           	alert("error");
	           }
	         });
	    });
	    /*$("#form-submit").submit(function(){   // NEW COLLEGE ENTRY FORM
	    	if($("#college").val()=="")
	    	{
	    		alert("Error in data .. College name cant be empty Please maintain the quality of data uploading");
	    		return false;
	    	}
	    	$.ajax({
	           type: "POST",
	           url: "php/register_new.php",
	           data: $(this).serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	              window.location="reg.php";
	           },
	           error:function()
	           {
	           	alert("error");
	           }
	         });
	    	return false;
	    });*/
	    $("#about_user").submit(function(){  // DATA CHANGING FOR THE USER
	    	alert("user data updated");
	    	return false;
	    });
	    $("#search-college").click(function(){
	    	$.ajax({
	           type: "POST",
	           url: "php/get-the-link.php?name="+$("#search").val(),
	           success: function(data)
	           {
	             if(data=="error")
	             {
	             	alert("No College found");
	             }
	             else
	             {
	             	window.location="cp.php?cid="+data;
	             }
	           },
	           error:function()
	           {
	           	alert("error");
	           }
	         });
	    });
	    function logout()
	    {
	    	window.location="php/logout.php";
	    }
	    function setpage(i)
	    {
	    	 window.location="php/set-cid.php?cid="+i;
	    }
	    $("#search").typeahead({
		  name: 'accounts',
		  local: [''<?php 
		  $query=mysqli_query($con,"select name from college_id where 1");
		  while($row=mysqli_fetch_assoc($query))
		        {
		           echo ",'".mysqli_real_escape_string($con,$row['name'])."'";
		        } ?>]
	});

	    </script>
    </body>
</html>