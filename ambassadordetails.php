<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  }
  $page_desc="Infermap.com, a next generation education solution provider. The key objective of this program is to develop and foster a synergistic association between Indian students, faculty, alumni and universities across India.";
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Infermap Ambassdors</title>
    <meta name="title" content="Infermap College Ambassador Program">
    <meta name="description" content="<?php echo $page_desc;?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Infermap">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan, Ambassdors">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="Infermap College Ambassador Program"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/ambassador/seo.jpg"/>
    <meta property="og:url" content="http://www.infermap.com/ambassadordetails.php"/>
    <meta property="og:description" content="<?php echo $page_desc;?>"/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="Infermap College Ambassador Program">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <meta itemprop="description" content="<?php echo $page_desc;?>">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link href="data/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/hover.css"> 
</head>
<body>
  <?php
    include "header.php"; 
  ?>
  <style type="text/css">
    body{
      overflow-x: hidden;
    }
    p{
      font-size: 1.1em;
    }
    .header{
      padding: 0px;
    }
    #header-image{
      position: relative;
      width: 100%;
      height: auto;
      z-index: 0;
    }
    h3,h2{
      padding-left: 20px;
    }
    h2{
      text-decoration: underline;
    }
    .above-footer div{
      height: 5px;
      margin-bottom: -1px;
    }
    .yellow{
      background: #FFD800;
    }
    .blue{
      background: #01B8AD;
    }
    .pink{
      background: #FF5B6E;
    }
    .green{
      background: #A8FF00;
    }
    #alink{
      font-size: 1.2em;
      font-weight: bold;
    }
  </style>
  <div class='container'>
    <div class="header col-md-12">
      <img src="img/ambassador/Campus-Ambassadors.png" id="header-image">
     
    </div>
     <h2 > Campus Ambassadors</h2>
    <div>
        <div class="row col-md-12 ">
          <p class="col-md-9">
            <br>
            <br>
              Infermap.com, a next generation education solution provider, is in the process of launching a pan-India University Student connect program. The key objective of this program is to develop and foster a synergistic association between Indian students, faculty, alumni and universities across India. To successfully role out this program across colleges in India, we plan to nominate 2-4 campus ambassadors in each college.
          </p>  
          <img src="img/ambassador/amb1.png" style="float:right ">
        </div>  
        <hr>
        <div class="row col-md-12 ">
          <h3>What does a campus ambassador do?</h3>
          <div class="col-md-9">
            <ul>
                <li>
                    <p>Promote Infermap University Student connect program in college by holding presentations & informal talks after classes or in hostels</p>
                </li>
                <li>
                    <p>Encourage students to register and solve challenges posted</p>
                </li>
                <li>
                    <p>Display the program posters in prominent locations in their college campus</p>
                </li>
                <li>
                    <p>Publicize the website and its products with friends and classmates</p>
                </li>
                <li>
                    <p>Bring out the distinctive features and the basic information about the institute</p>
                </li>
                <li>
                    <p>Run various data collection drives across their institute and city</p>
                </li>
                <li>
                    <p>Run publicity drive across city</p>
                </li>
            </ul>
          </div>
          <img src="img/ambassador/amb2.png" style="float:right ">
        </div>
        <hr>
        <div class="row col-md-12 ">
          <h3>What does he or she get in return?</h3>
          <div class="col-md-9">
            <ul>
                <li>
                    <p>Opportunity to Do exciting work</p>
                </li>
                <li>
                    <p>Opportunity to Interact with industry</p>
                </li>
                <li>
                    <p>Gain experience in the exciting world of communication and marketing</p>
                </li>
                <li>
                    <p>Certificate from Infermap.com</p>
                </li>
                <li>
                    <p>Preference for internship opportunities with Infermap</p>
                </li>
            </ul>
          </div>
          <img src="img/ambassador/amb3.png" style="float:right ">
        </div>
        <hr>
        <div class="row col-md-12 ">
          <h3>What are we looking for?</h3>
          <div class="col-md-9">
            <ul>
                <li>
                    <p>Enthusiasm</p>
                </li>
                <li>
                    <p>Internet / social media skills</p>
                </li>
                <li>
                    <p>3-5 hours per week, approx 45 minutes every day (can be higher initially)</p>
                </li>
            </ul>
          </div>
          <img src="img/ambassador/amb4.png" style="float:right ">
        </div>
        <hr>
        <h3>How to apply?</h3>
        <ul>
            <li>
                <p><a href="#" data-toggle="modal" data-target="#ambasdor" id="alink">Click here</a> to fill your details.</p>
            </li>
        </ul>
        <br>
    </div>
  </div>
  <div class="modal fade" id="ambasdor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <form class="modal-content" id="ab-form" enctype="multipart/form-data" >
              <div class="modal-header" >
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Register as college ambassdor</h4>
                  <h7 class="small-text">All fields are compulsory</h7>
              </div>
              <div class="modal-body">
                  <div class="form-group row">
                    <label class="col-md-4"  for="name">Name</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="name" placeholder="Enter Your name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="email">Email id</label>
                    <div class="col-md-8">
                      <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="college">Enter college name</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="college" placeholder="Enter your college name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="city">City</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="city" placeholder="Enter your city" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="state">State</label>
                    <div class="col-md-8">
                      <select class="form-control" name="state" required>
                        <?php
                            $state=mysqli_query($con,"select * from states");
                            while($row=mysqli_fetch_assoc($state))
                            {
                              echo '<option>'.$row['name'].'</option>';
                            }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="phone">Phone no</label>
                    <div class="col-md-8">
                      <input type="number" class="form-control" name="phone" placeholder="Enter phone no" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="sop">Why do you want to be ambassdor?</label>
                    <div class="col-md-8">
                      <textarea  class="form-control" name="sop" required></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="sop">Mention any other skills and areas u have experience in.</label>
                    <div class="col-md-8">
                      <textarea  class="form-control" name="skills" required></textarea>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-md-4" for="resume">Upload your resume</label>
                    <div class="col-md-8">
                      <input type="file" class="form-control" name="resume" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4" for="id">Upload your identitycard</label>
                    <div class="col-md-8">
                      <input type="file" class="form-control" name="id" required>
                    </div>
                  </div-->            
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary">Submit</button>
              </div>     
          </form>
      </div>
  </div>
   
  <div class="above-footer">
    <div class="col-md-3 yellow"></div>
    <div class="col-md-3 blue"></div>
    <div class="col-md-3 pink"></div>
    <div class="col-md-3 green"></div>
  </div>
  <?php
    include "footer.php";
  ?>
  <script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>


  <script type="text/javascript">
  
   $("#ab-form").submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#ab-form')[0]);
            var str= $('#ab-form').serialize();
            jQuery.ajax({
                url: 'php/ambasdor.php?',  //Server script to process data
                type: 'POST',
                data:str,
                success: function(data){
                    if(data=="done"){
                       $("#ab-form")[0].reset();
                       alert('response submitted');
                       $('#ambasdor').modal('hide');
                    }
                    else{
                        console.log(data);
                    }
                },
                error: function(data){
                    alert("Network error");
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            });

        })
  </script>
</body>
</html>