<?php
	session_start();
	if(isset($_SESSION['datauserid']))
	{
		header("Location: dataeditor.php");
	}
?>
<!Doctype HTML>
<html>
	<head>
		<title>Member Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="Description" content="The ultimate portal for web enquiry">
	    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
	    <meta name="author" content="Prateek Chandan">
	     <link rel="icon" href="img/icon.png" type="image/x-icon">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css"/>
        <link href="fonts/googleapi.css" rel="stylesheet">
		<style>
		body{
			background:url('img/geometry.png');
			font-family: "open sans" , serif;
		}
		h1
		{
			font-family: "love ya" , serif;
			font-size:5em;
			margin-top:4%;
			text-align: center;
		}
		#main-box {
			margin:auto;
			background-color: rgba(20,20,20,0.8);
			color:#fcfcfc;
			height:300px;
			padding-top:50px;
			margin-top:50px;
			border-radius: 8px;
		}
		#main-box a
		{
			color:#fcfcfc;
		}
		footer{
			position: absolute;
			bottom: 0px;
			left:0px;
			width:100%;
			height:40px;
			background-color: rgba(60,60,60,0.2);
			color:#000;
			padding-top:10px;
			padding-left: 50px;
		}
		footer a,footer a:hover{
			color:#000;
		}
		.popover{
			background-color: rgba(40,40,40,1);
		}
		</style>
	</head>
	<body>
	<div id="header"><h1>INFERMAP DATA ENTRY PORTAL</h1></div>
	<div class="col-md-4"></div>
	<div class="col-md-4" id="main-box">
		<form class="form-horizontal" role="form" method="post" id="login">
		  <div class="form-group">
		    <label for="uid" class="col-md-3 control-label">User Id</label>
		    <div class="col-md-9">
		      <input type="text" class="form-control" id="uid" name="uid" placeholder="User Id">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-md-3 control-label">Password</label>
		    <div class="col-md-9">
		      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		    </div>
		  </div>
		  <div class="form-group" style="display:none;">
		    <div class="col-sm-offset-3 col-sm-9">
		      <div class="checkbox">
		        <label>
		          <input type="checkbox" id="rem" name="rem"> Remember me
		        </label>
		      </div>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-9">
		      <button type="submit" class="btn btn-default">Sign in</button>
		    </div>
		  </div>
		</form>
		<br>
		<div id="help-div" class="col-md-12">
		<a id="help" data-toggle="popover"  data-html="true" data-content="We are very pleased to recieve your help. You may mail us your details at <a>infermap@gmail.com</a><br>Thanks" role="button" data-original-title=""><i>Wanna help us collecting data ?</i></a>
		</div>
	</div>
	<footer>
	&copy <a href="http://www.infermap.com">Infermap.com</a>
	</footer>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#help").popover({
    	trigger:'hover'
    });
    $("#login").submit(function(){
        $.ajax({
           type: "POST",
           url: "php/data-login.php",
           data: $(this).serialize(), // serializes the form's elements.
           success: function(data)
           {
               if(data=="found")
               {
                window.location="dataeditor.php";
               }
               else if(data=="notfound")
               {
                 $("#password").val("");
                 $("#uid").parent().addClass("has-error");
                 $("#password").parent().addClass("has-error");
               }
               else
               {
                $("#password").val("");
                $("#uid").parent().removeClass("has-error");
                $("#password").parent().addClass("has-error");
               }
           },
           error:function()
           {
           	
                 $("#password").val("");
                 $("#uid").parent().addClass("has-error");
                 $("#password").parent().addClass("has-error");
           }
         });
     return false;
   });
    </script>
	</body>
</html>