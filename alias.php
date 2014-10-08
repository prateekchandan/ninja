<?php
include 'php/dbconnect.php';
function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  }
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Infermap</title>
    <meta name="title" content="Use your college experience to lead future engineers">
    <meta name="description" content="Infermap.com is an IIT Bombay student initiative to guide students in taking the right career path. Do your part and  help the future engineers by telling us about your college and branch.">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Infermap">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="Use your college experience to lead future engineers"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/social1.png"/>
    <meta property="og:url" content="http://www.infermap.com/counsel.php"/>
    <meta property="og:description" content="Infermap.com is an IIT Bombay student initiative to guide students in taking the right career path. Do your part and  help the future engineers by telling us about your college and branch."/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="Use your college experience to lead future engineers">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <meta itemprop="description" content="Infermap.com is an IIT Bombay student initiative to guide students in taking the right career path. Do your part and  help the future engineers by telling us about your college and branch.">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link href="data/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/hover.css">


    
</head>
<body>

 <?php
 include "header.php"; ?>
 <style type="text/css">
  body{
    overflow-x: hidden;
  }
      h2{
        text-align: center;
        font-size: 2.4em;
        margin-bottom: 10px;
      }
      .text{
        font-size: 1.1em;
      }
      .container{
        min-height: 600px;
      }
      .imp-link{
        font-weight: bold;
      }
      input , select , button{
        border-radius: 0px !important;
      }
      #feedbackpot {
    opacity: 0;
    border: 1px solid #999;
    box-shadow: 0px 0px 25px grey;
    color: black;
    padding: 20px;
    position: absolute;
    top: 72px;
    min-width: 400px;
    right: -100px;
    background-color: white;
    z-index: 1031;
    display: none;
}
#feedbackbtn {
    position: absolute;
    right: -27px;
    top: 265px;
    border-radius: 0px;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.initiative{
  position: absolute;
  top: 120px;
  right: -32px;
  box-shadow: 0px 0px 8px #ccc;
  padding: 5px;
  background-color: rgb(233, 233, 233);
  font-weight: bold;
  -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
    </style>
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content login-box">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Login to site</h4>
              </div>
              <div class="modal-body">
               <form role="form" id="login-form">
                    <div class="alert alert-danger alert-dismissable" style="display:none" id="login-alert">
                                <button type="button" class="close"onclick="$('#login-alert').css('display','none')">×</button>
                                <div id="login-alert-text">Please signup to get an user account</div>
                            </div>
                  <div class="form-group">
                    <label for="login-email">Email address</label>
                    <input type="email" class="form-control" name="email" id="login-email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="login-pass">Password</label>
                    <input type="password" class="form-control" name="password" id="login-pass" placeholder="Password">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
               </form>
            </div>
          </div>
        </div>
   
  <div class="container">
    <h2>Fill aliases and analysis</h2>
   
    <div class="col-md-12">
        <div class="form-group">
          <label for="state" class="col-sm-2 control-label">Select state</label>
          <div class="col-sm-10">
            <select id="state" class="form-control" name="state">
              <option value="">choose the state </option>
                <?php
                  $q=mysqli_query($con,"select distinct state from college_id where disabled='1' && state!='' && state!='--Select State--' order by state");
                  $sta=array();
                  while($row=mysqli_fetch_assoc($q))
                  {
                    echo "<option>".$row['state']."</option>";
                    $sta[$row['state']]=array();
                  }
                  $q=mysqli_query($con,"select  * from college_id where disabled='1' && state!='' && state!='--Select State--' order by name");
                    while($row=mysqli_fetch_assoc($q))
                    {
                      array_push($sta[$row['state']],$row);
                    }

                ?>
            </select>
          </div>
        </div>
       
       <div id="table-box">
       </div>
    </div>
  </div>
  <button id="feedbackbtn" class="btn btn-success">Feedback</button>
  <div id="feedbackpot">
        <h3>Give Your Feedback</h3>
        <form style="padding-top:20px;border-top:1px solid #ddd" role="form" id="feedback-form">
          <div class="form-group" id="feedback-sub">
            <label for="feedback-subject">Subject: *</label>
            <input required class="form-control" name="feedback-subject" id="feedback-subject" placeholder="Enter your feedback subject">
            <!--select class="form-control" name="feedback-subject" id="feedback-subject">
              <option>Regarding Basic details</option>
              <option>Academics</option>
              <option>Admissions</option>
              <option>Fees</option>
              <option>Facilities</option>  
              <option>Placements</option>  
              <option>Sports and Activities</option>  
              <option>Contacts</option>
              <option>Others</option>
            </select-->
          </div>
           <div class="form-group" id="feedback-email-box">
            <label for="Enter college-name">Enter college name: *</label>
            <input type="text" class="form-control" name="college-name" id="college-name" placeholder="Enter your college name" required>
          </div>
          <div class="form-group" id="feedback-email-box">
            <label for="feedback-email">Email: *</label>
            <input type="email" class="form-control" name="feedback-email" id="feedback-email" placeholder="Enter email" required>
          </div>
          <div class="form-group" id="feedback-message">
            <label for="feedback-msg">Message: *</label>
            <textarea class="form-control" rows="3" id="feedback-msg" name="feedback-msg" placeholder="Write something...."></textarea>
           </div>
          <br>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <?php
      include "footer.php";
    ?>
<script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">
$("#state").change(function(){
  jQuery.ajax({
    url:'php/get-college-aliases.php',
    type:'post',
    data:{state:$("#state").val()},
    success:function(data){
      data=JSON.parse(data);
      var str='<table class="table table-striped"><thead><tr><td>Sl no</td><td>Name</td><td>Alias1</td><td>Alias2</td><td>Alias3</td><td>Alias4</td><td>Alias5</td><td>Alias6</td><td>Alias7</td><td>Alias8</td><td>No of Responses</td><td></td></tr></thead>';
      var l=data.length;
      for (var i = data.length - 1; i >= 0; i--) {
        str+='<tr><div  id="college'+data[i][0]+'">';
        str+='<td>'+(l-i)+'</td>';
        str+='<td><a href="./college/'+data[i][12]+'" target=_blank>'+data[i][1]+'</a></td>';
        for(var j=1;j<=8;j++){
          str+='<td><input id="alias'+data[i][0]+''+j+'" name="alias'+j+'" class="form-control" value="'+data[i][2+j]+'"></td>';
        }
        str+='<td>'+data[i][11]+'</td>';
        str+='<td><button class="btn btn-info" onclick="editalias('+data[i][0]+')">Edit</button></td>';
        str+='</div></tr>';
      };
      str+='</table>';
      $("#table-box").html(str);

    },
    error:function(){
      alert("Network Error");
    }
  })
})



$("#feedbackbtn").click(function(){
    togglefeedback();
});
  var feedbackshown = false;
  function togglefeedback(){
    if(feedbackshown){
        feedbackshown = false;
        $('#feedbackpot').animate({
            opacity: 0,
            right: -500,
        }, 1000, function(){
            $('#feedbackpot').css('display', 'none');
        }
        );
    }
    else{
        feedbackshown = true;
        $('#feedbackpot').css('display', 'block');
        $('#feedbackpot').animate({
            opacity: 1,
            right: 50,
        }, 1000
        );
    }
  }
  $("#feedback-form").submit(function(){
    var k=0;
    /*if($("#feedback-subject").val()==""){
        k=1;
        $("#feedback-sub").addClass("has-error");
    }
    else
        $("#feedback-sub").removeClass("has-error");
     if($("#feedback-msg").val()==""){
        k=1;
        $("#feedback-message").addClass("has-error");
    }
    else
        $("#feedback-message").removeClass("has-error");

    if($("#feedback-email").val()==""){
        k=1;
        $("#feedback-email-box").addClass("has-error");
    }
    else
        $("#feedback-email-box").removeClass("has-error");
    if(k==1)
        return false;*/
    $.ajax({
        url:"./php/send-college-feedback.php",
        type:"POST",
        data:$("#feedback-form").serialize(),
        success:function(data){
            console.log(data);
            /*togglefeedback();
            $("#feedback-subject").val("");
            $("#feedback-email").val("");
            $("#feedback-msg").val("");
            alert("Feedback Sent");*/

        },
        error:function(){
            alert("Failed to send feedback\n Network error");
        }
    });
    return false;
  });

function editalias (id) {
  var data={cid:id};
  for (var i = 1; i < 9; i++) {
    data['alias'+i]=$("#alias"+id+i).val();
  };
  jQuery.ajax({
    url:'php/change-alias.php',
    type:'post',
    data:data,
    success:function(data){
      console.log(data);
    },
    error:function(){
      alert("Network error");
    }
  })
}
</script>


</body>
</html>