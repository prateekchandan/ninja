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

  $catQuery=mysqli_query($con,"select * from category");
  $categories=[];
  $i=0;
  while($row=mysqli_fetch_assoc($catQuery))
  {
    $a=['id'=>$row['id'],'name'=>$row['name']];
    $categories[$i]=$a;
    $i+=1;
  }
?>
<body cz-shortcut-listen="true">
    <div style="color:#fff;width:100%;height:100%;position:fixed;top:0px;padding:100px;background-color:rgba(0,0,0,0.9);z-index:11000;display:none" id="waiting">
        <h4>Please wait <br>
      The addition of a  new category brings some changes so it will take some time</h4>

    </div>
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
          <div class="col-md-12">
            <div class="span3">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                      <li class="nav-header"><i class="icon-wrench"></i> Administration</li>
                      <li><a href="college-details.php">Colleges</a>
                      </li>
                      <li><a href="coachings.php">Coachings</a>
                      </li>
                      <li class="nav-header"><i class="icon-edit"></i> Manage data</li>
                      <li class="active"><a href="categories.php">Categories/Exams</a>
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
                    <div class="row-fluid">
                        <div class="page-header">
                            <h1>Add new categories</h1>
                        </div>
                        <form class="form-horizontal" id="cat-form">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="id">Id for the category* .. </label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" id="id" name="id" required>      
                                    </div>
                                    (Only lowercase aplhabets which should be unique)
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="name">Name* (Short descriptive name of category)</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn" type="submit" id="save">Save</button>
                                    <button class="btn" type="reset">Reset</button>
                                </div>
                            </fieldset>
                        </form>
                        <div id="message" class="form-actions" style="margin:auto;font-size:1.2em">Hello , Here you will recieve all messages</div>
                    </div>
                </div>
            </div>
            <div class="span3" style="margin-top:30px">
                <h2>List of current categories</h2>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                        </tr>
                    </thead>
                    <?php 
                      $q=mysqli_query($con, "select * from category"); 
                      while($row=mysqli_fetch_assoc($q)) 
                      {
                        echo "<tr>". "<td>".$row[ 'id']. "</td>". "<td>".$row[ 'name']. "</td>". "</tr>"; 
                      } 
                    ?>
                </table>
            </div>
          </div>

          <div class="col-md-12">
            <div class="span3">
            </div>
            <div class=" span9">
              <h2>
                Exam Addition
              </h2>
              <form class="form-horizontal" role="form" id="add-exam-form">
                <div class="control-group">
                  <label for="examName" class="control-label">Exam </label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="examname" name="examname" placeholder="Exam Name">
                  </div>
                </div>
                <div class="control-group">
                  <label for="type" class="control-label">Program for exam</label>
                  <div class="controls">
                    <select class="input-xlarge" name="type">
                      <?php
                        $courses=mysqli_query($con,"select * from allcourses");
                        while($row=mysqli_fetch_assoc($courses))
                        {
                          echo "<option value='".$row['name']."'>".$row['value']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <?php
                    $category=mysqli_query($con, "select * from category"); 
                      while($row=mysqli_fetch_assoc($category)) 
                      {
                        echo '  <span style="padding:6px">
                                    <input type="checkbox" name="'.$row['id'].'">'.$row['name'].'
                                 </span>';
                      } 
                  ?>
                  
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" >Add Exam</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class=" span12">
              <h2>
                Category change for Exams
              </h2>
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      Sl.no
                    </th>
                    <th>
                      Name of Exam
                    </th>
                    <th>
                      Program
                    </th>
                    <th>
                      Cateogries list
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <?php
                  $q=mysqli_query($con,"select * from exam");
                  $i=1;
                  mysqli_fetch_assoc($q);
                  while($row=mysqli_fetch_assoc($q))
                  {
                    echo "<tr><td>".$i."</td><td>".$row['name']."</td><td>".$row['type']."</td><td><form id=\"form".$row['eid']."\">";
                    $cat=$row['category'];
                    $cat=json_decode($cat,true);
                    echo "<input type=\"hidden\" name=\"eid\" value=\"".$row['eid']."\">";
                    foreach ($category as $key) {
                      echo " ".$key['name'].":";
                      if(in_array($key['id'], $cat))
                        echo "<input type=\"checkbox\" name=\"".$key['id']."\" checked>";
                      else
                        echo "<input type=\"checkbox\" name=\"".$key['id']."\">";
                    }
                    echo "</form></td><td><button class=\"btn btn-success\" onclick=\"examcatchange(".$row['eid'].")\">Change Category</button></td></tr>";
                    $i+=1;
                  }

                ?>
              </table>
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
    <script type="text/javascript">
    $('#id').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-z]/g,'') ); 
   });
      function deleteq(a){
        $.ajax({
          url: "php/delete-a-category.php",
          method:"POST",
          data:{id:a},
          success:function(data){
            alert(data);
          },
           error:function(data){
            alert(data);
          }
        })
      }
        $("#cat-form").on('submit', function () {
            $("#waiting").css("display", "block");
            $.ajax({
                url: "php/add-new-category.php",
                type: "POST",
                data: $("#cat-form").serialize(),
                success: function (data) {
                    console.log(data);
                    if (data == "error")
                        $("#message").html("OOps ! Error occured..");
                    else {
                        alert("Succesfully added");
                        location.reload();
                    }
                    $("#waiting").css("display", "none");
                },
                error: function (data) {
                    $("#waiting").css("display", "none");
                    $("#message").html("Network error..");
                }
            })

            return false;
        });


        // ADD EXAAM FORM CHANGE
         $("#add-exam-form").on('submit', function () {
            $.ajax({
                url: "php/add-new-exam.php",
                type: "POST",
                data: $("#add-exam-form").serialize(),
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (data) {
                  alert($("#add-exam-form").serialize());
                    $("#message").html("Network error..");
                }
            })

            return false;
        });

         //
         function examcatchange(eid)
         {
           $.ajax({
                url: "php/change-category-for-exam.php",
                type: "POST",
                data: $("#form"+eid).serialize(),
                success: function (data) {
                  console.log(data);
                    alert("Categories for this exam changed..");
                },
                error: function (data) {
                  
                    alert("Network error..");
                }
            })
         }
    </script>


</body>

</html>