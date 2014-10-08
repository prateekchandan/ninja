<!DOCTYPE html>

<head>
	<link rel="stylesheet" type="text/css" href="../fonts/googleapi.css">
	<script src="js/jquery.js"></script>
</head>

<body>
<div id="img-container">
	<img src="img/maze1.png" style="width:100%">
</div>
<h1 style="color:white">INFERMAP</h1>
<div style="color:white;font-size:25pt"><strong>You seem to have lost your path.</strong></div><div style="color:white;font-size:15pt">Let me get you out of this 404 maze!</div>
<a style="text-decoration:none" id="linkhome"  href="http://www.infermap.com">
	<div id="gohome">
	<strong>HOME</strong>
</div>
</a>
</body>

<style type="text/css">
	#img-container{
		width: 100%;
		position: absolute;
		bottom: 0px;
		left: 0px;
		z-index: -1;
	}
	body{
		background-color: black;
		font-family: 'open sans';
		padding:100px;
		height: 100%;
	}
	#gohome{
		text-align: center;
		line-height: 50px;
		border:1px solid white;
		margin-top: 50px;
		color: white;
		width: 200px;
		height: 50px;
	}
	#gohome:hover{
		cursor:pointer;
		background-color: white;
		color: black;
	}
</style>


</html>