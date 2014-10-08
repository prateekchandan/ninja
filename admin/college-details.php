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
include '../php/dbconnect.php';
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
      <li><a href="#">Home</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="new-user.php">New User</a></li>
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
                      <li class="active"><a href="college-details.php">Colleges</a>
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
        <h1>List of All Colleges</h1>
        <blockquote>Note: Click on a college name to go to its editing page</blockquote>
        <div class="span9">
            <table class="table table-condensed" id="example">
            <thead>
              <tr>
                <th>Sl no</th>
                <th>Name of College</th>
                <th>City</th>
                <th>State</th>
                <th>User Id</th>
                <th>Rank(India)</th>
                <th>Rank(State)</th>
                <th>Action</th>
              </tr>
            </thead>
            <?php
            $num=1;
              $colleges=mysqli_query($con,"select * from college_id");
              $all=mysqli_query($con , "select * from datafeeder") ;
              $user_reg=array();
              while($user=mysqli_fetch_assoc($all)){
                $pages=json_decode($user['pages']);
                $name=$user['uid'];
                foreach ($pages as $id) {
                 $user_reg[$id]=$name;
                }
              }
              $_SESSION['datauserid']='infermap';
              //print_r($user_reg);
              while($college=mysqli_fetch_assoc($colleges)){
                $id=$college['cid'];
                $name=$college['name'];
                if($college['disabled']==0)
                  $button="<button class='btn btn-success label label-important' id='enablebtn".$id."' onclick='enable(".$id.")'>Enable</button>";
                else
                  $button="<button  class='btn btn-danger label label-important' id='enablebtn".$id."' onclick='enable(".$id.")'>Disable</button>";
                
                echo '<tr><td>'.$num.'</td><td ><a href="../data/college-editable.php?link='.$college['link'].'">'.$name.'</a></td><td>'.$college['city'].'</td><td>'.$college['state'].'</td><td>'.$user_reg[$id]."</td>
                <td id='rate".$id."' onfocusout='rate(".$id.")' contenteditable=\"true\">".$college['rank']."</td>
                <td id='strate".$id."' onfocusout='rate(".$id.")' contenteditable=\"true\">".$college['state_rank']."</td>
                <td>".$button.""."</td></tr>";
                $num+=1;
              }
            ?>
            </table>
          
        </div>
      </div>
      <hr>

      <footer class="well">
        © Infermap
      </footer>

    </div>
    <script type="text/javascript" src="../data/js/jquery.js"></script>
    <script type="text/javascript" src="../data/bootstrap/js/bootstrap.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="js/paginated.js"></script>
    <script type="text/javascript">
      <?php
            $a=$_SERVER['REMOTE_ADDR'];
            echo "console.log('Your IP : ".$a."');";
            ?>
    function rate(id){
      jQuery.ajax({
          url:"php/changerank.php",
          data:{'cid':id,'rank':$("#rate"+id).html(),'strank':$("#strate"+id).html()},
          type:"POST",
          success:function(data){
            console.log(data);
            if(data!="done")
            {
              alert("Oops some error occured");
            }
          },
          error:function(data){
            alert("error connecting server");
          }
    })
  }
      function enable (id) {
        jQuery.ajax({
          url:"php/enable-col.php",
          data:{'cid':id},
          type:"POST",
          success:function(data){
            console.log(data);
            if(data==0)
            {
              $("#enablebtn"+id).removeClass("btn-success");
              $("#enablebtn"+id).addClass("btn-danger");
               $("#enablebtn"+id).html("Disable");
            }
            else if(data==1)
            {
              $("#enablebtn"+id).removeClass("btn-danger");
              $("#enablebtn"+id).addClass("btn-success");
              $("#enablebtn"+id).html("Enable");
            }
            else
            {
              alert("Oops some error occured");
            }
          },
          error:function(data){
            alert("Error connecting server");
          }
        })
        // body...
      }
    </script>

</body></html>