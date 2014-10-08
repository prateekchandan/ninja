</html>
<!DOCTYPE html>
<!-- saved from url=(0053)http://wbpreview.com/previews/WB00L7291/new-user.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Admin-area | Infermap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">
    <link rel="icon" href="../img/favicon-icon.png" type="image/x-icon">
    <link href="style.css" rel="stylesheet">
    <style type="text/css">
    input{
      height:28px;
    }
    .dropdown-toggle{
      height:18px;
    }
    #Login-form{
      max-width:40%;
      padding:5%;
      margin: auto;
      color:#ffffcc;
      background-color: rgba(0,0,0,0.8);
      font-size:2em;
      border-radius: 15px;
      box-shadow: 

    }
    </style>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <style type="text/css"></style></head>
<?php
  session_set_cookie_params(10);
  session_start();
  if (!isset($_SESSION['truth']))
    die("<form id=\"Login-form\" method=\"post\" action=\"php/authenticate.php\"><h1>Admin :</h3> Enter password to enter : <input type=\"password\" class=\"form-control\" autofocus=\"autofocus\" name=\"pwd\"></form>");
?>
  <body cz-shortcut-listen="true">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Infermap Administration</a>
          <div class="btn-group pull-right">
      <a class="btn" href="php/logout.php"><i class="icon-user"></i> Logout</a>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
      <li><a href="index.php">Home</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">New User</a></li>
          <li class="divider"></li>
          <li><a href="index.php">Manage Users</a></li>
        </ul>
        </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">New Role</a></li>
          <li class="divider"></li>
          <li><a href="">Manage Roles</a></li>
        </ul>
        </li>
        <li><a href="#">Stats</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
                      <li class="nav-header"><i class="icon-wrench"></i> Administration</li>
                      <li><a href="college-details.php">Colleges</a>
                      </li>
                      <li><a href="coachings.php">Coachings</a>
                      </li>
                      <li class="nav-header"><i class="icon-edit"></i> Manage data</li>
                      <li><a href="categories.php">Categories/Exams</a>
                      </li>
                      <li class="nav-header"><i class="icon-signal"></i> User Statistics</li>
                      <li><a href="index.php">Users</a>
                      </li>
                      <li><a href="ambassadors.php">Ambassadors</a>
                      </li>
                      <li class="nav-header"><i class="icon-user"></i> Profile</li>
                      <li><a href="#">My profile</a>
                      </li>
                      <li><a href="#">Settings</a>
                      </li>
                      <li><a href="php/logout.php">Logout</a>
                      </li>
                  </ul>
          </div>
        </div>
        <div class="span6">
      <div class="row-fluid">
      <div class="page-header">
        <h1>New User <small>User registration</small></h1>
      </div>
      <form class="form-horizontal" id="user-form">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="uid">User Id*</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="uid" name="uid">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="name">Name*</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="name" name="name">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="password">Password*</label>
            <div class="controls">
              <input type="password" class="input-xlarge" id="password" name="password">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
              <input type="email" class="input-xlarge" id="email" name="email">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="pnohe">Phone</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="phone" name="phone">
            </div>
          </div>
          <div class="form-actions">
            <input type="submit" class="btn btn-primary btn-large" value="Save User"> <button class="btn" type="reset">Reset</button>
          </div>  
          <div id="message" class="form-actions" style="margin:auto;font-size:1.2em">Hello , Here you will recieve all messages</div>
        </fieldset>
      </form>
      </div>
        </div>
        <div class="span3" style="margin-top:30px">
        </div>
      </div>
      <hr>

      <footer class="well">
        © Infermap
      </footer>

    </div>
    <script type="text/javascript" src="../data/js/jquery.js"></script>
     <script type="text/javascript" src="../data/bootstrap/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
  

</body></html>