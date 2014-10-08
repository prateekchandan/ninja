</html>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Admin-area | Infermap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">
    <link rel="icon" href="../img/favicon-icon.png" type="image/x-icon">
    <link href="style.css" rel="stylesheet">
    <style type="text/css">
    
    </style>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <style type="text/css"></style></head>
<?php
  include '../php/dbconnect.php';
  session_start();
  if (!isset($_SESSION['truth']))
    die("<form id=\"Login-form\" method=\"post\" action=\"php/authenticate.php\"><h1>Admin :</h3> Enter password to enter : <input type=\"password\" class=\"form-control\" name=\"pwd\" autofocus=\"autofocus\"></form>");
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
                      <li><a href="#">Home</a>
                      </li>
                      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="new-user.php">New User</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="#">Manage Users</a>
                              </li>
                          </ul>
                      </li>
                      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="#">New Role</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="">Manage Roles</a>
                              </li>
                          </ul>
                      </li>
                      <li><a href="#">Stats</a>
                      </li>
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
          <div class="span9">
              <div class="row-fluid">
                  <div class="row-fluid">
                      <div class="page-header">
                          <h1>List of Registered College Ambassadors</h1>
                      </div>
                      <table class="table" id="example">
                        <thead>
                          <tr>
                            <th>
                              Sl no
                            </th>
                            <th>
                              Name
                            </th>
                            <th>
                              Email
                            </th>
                            <th>
                              College
                            </th>
                            <th>
                              City
                            </th>
                            <th>
                              State
                            </th>
                            <th>
                              Phone
                            </th>
                            <th>
                              S.O.P.
                            </th>
                            <th>
                              Other Skills
                            </th>
                            <th>
                              Ip address
                            </th>
                          </tr>
                        </thead>
                        <?php
                          $i=0;
                          $q=mysqli_query($con,'select * from ambassador');
                          while($a=mysqli_fetch_assoc($q)){
                            $i++;
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$a['name'].'</td>';
                            echo '<td>'.$a['email'].'</td>';
                            echo '<td>'.$a['college'].'</td>';
                            echo '<td>'.$a['city'].'</td>';
                            echo '<td>'.$a['state'].'</td>';
                            echo '<td>'.$a['phone'].'</td>';
                            echo '<td>'.$a['sop'].'</td>';
                            echo '<td>'.$a['skills'].'</td>';
                            echo '<td>'.$a['ip'].'</td>';
                            echo '</tr>';
                          }

                        ?>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    <hr>

      <footer class="well">
        © Infermap
      </footer>

    </div>
    <script type="text/javascript" src="../data/js/jquery.js"></script>
      <script type="text/javascript" src="../data/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/paginated.js"></script>
    <script type="text/javascript">
   
    </script>
  

</body></html>