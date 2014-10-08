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
    <div class="initiative"> An IIT Bombay Student Initiative</div>
  <div class="container">
    <h2>Tell us about your college</h2>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text">Why?? You know your colleges and the colleges around you well
        enough to guide the next batches. Your feedback would help them
        choose the right college and branch.
      </div>
    </div>
<hr>
    <div class="col-md-12">
      <form class="form-horizontal" role="form" id="depts-form">
        <div class="form-group">
          <label for="state" class="col-sm-2 control-label">Select your state</label>
          <div class="col-sm-10">
            <select id="state" class="form-control" name="state">
              <option value="">choose the state of your college</option>
                <?php
                  $q=mysqli_query($con,"select distinct state from college_id where disabled='1' && state!='' && state!='--Select State--' order by state");
                  $sta=array();
                  while($row=mysqli_fetch_assoc($q))
                  {
                    echo "<option>".$row['state']."</option>";
                    $sta[$row['state']]=array();
                  }
                  $q=mysqli_query($con,"select  cid,name,state,link,city from college_id where disabled='1' && state!='' && state!='--Select State--' order by name");
                    while($row=mysqli_fetch_assoc($q))
                    {
                      array_push($sta[$row['state']],array($row['cid'],$row['name'],clean($row['name'])."-".$row['link']));
                    }

                  $city=array();
                  $q=mysqli_query($con,"select  cid,name,state,link,city from college_id where disabled='1' && city!='' && state!='' && state!='--Select State--' order by name");
                    while($row=mysqli_fetch_assoc($q))
                    {
                      if(isset($city[$row['city']]))
                        array_push($city[$row['city']],array($row['cid'],$row['name'],clean($row['name'])."-".$row['link'],$row['state']));
                      else
                        $city[$row['city']]=array(array($row['cid'],$row['name'],clean($row['name'])."-".$row['link'],$row['state']));
                    }
                    ksort($city);
                ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Your email (Optional)</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
         <div class="form-group">
          <label for="city" class="col-sm-2 control-label">Your city</label>
          <div class="col-sm-10">
            <select id="city" class="form-control" name="city" disabled>
              <option>Chose City Of Your College</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="college" class="col-sm-2 control-label">Select your college</label>
          <div class="col-sm-10">
            <select id="college" class="form-control" name="college" disabled>
              <option>Select college from the list</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="college" class="col-sm-2 control-label"></label>
          <div class="col-sm-10" id="college-link">
        
          </div>
        </div>
        <input type="hidden" id="depts" name="depts">
        <input type="hidden" id="colrank" name="colrank">

        <div class="form-group" >
          <div class=" col-sm-10 col-md-offset-2" id="depts-box">
          </div>
        </div>
        <div class="form-group" >
          <div class=" col-sm-10 col-md-offset-2" id="college-box">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-info">Save Ranking</button>
          </div>
        </div>
      </form>
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
var coll=0;
var states=<?php echo json_encode($sta);?>;
var cities=<?php echo json_encode($city);?>;
$("#state").change(function(e) {
  if($("#state").val()==""){
    $("#college").html("<option value=''>Select College</option>");
    $("#city").html("<option value=''>Chose City Of Your College</option>");
    $("#college").attr("disabled","true");
    $("#city").attr("disabled","true");
    $("#depts-box").html('');
    $("#college-box").html('');
    $("#college-link").html('');

    $("#depts-box").removeClass('well');
    $("#college-box").removeClass('well');
    $("#college-link").removeClass('well');

  }
  else{
    $("#college").removeAttr("disabled");
    $("#city").removeAttr("disabled");
    var str="<option value=''>Select College</option>";
   
    for (var i = 0; i <= states[$("#state").val()].length - 1; i++) {
      var college=states[$("#state").val()][i];
      str+="<option value='"+college[0]+"'>"+college[1]+"</option>";
    };
    $("#college").html(str);

    str="<option value=''>Chose city of your college</option>";
    
    $.each(cities,function(index,value){
      if(value.length>0){
        if(value[0][3]==$("#state").val())
          str+="<option>"+index+"</option>";
      }
    })

    $("#city").html(str);
     $("#depts-box").html('');
    $("#college-box").html('');
    $("#college-link").html('');
    $("#depts-box").removeClass('well');
    $("#college-box").removeClass('well');
    $("#college-link").removeClass('well');
    
    
  }
})

$("#city").change(function(e) {
  if($("#city").val()==""){
    if($("#state").val()==""){
      $("#college").html("<option value=''>Select College</option>");
      $("#college").attr("disabled","true");
    }
    else{
      $("#college").removeAttr("disabled");
      var str="<option value=''>Select College</option>";
     
      for (var i = 0; i <= states[$("#state").val()].length - 1; i++) {
        var college=states[$("#state").val()][i];
        str+="<option value='"+college[0]+"'>"+college[1]+"</option>";
      };
      $("#college").html(str);
    }
    $("#depts-box").html('');
    $("#college-box").html('');
    $("#college-link").html('');

    $("#depts-box").removeClass('well');
    $("#college-box").removeClass('well');
    $("#college-link").removeClass('well');

  }
  else{
    $("#college").removeAttr("disabled");
    var str="<option value=''>Select College</option>";
   
    for (var i = 0; i <= cities[$("#city").val()].length - 1; i++) {
      var college=cities[$("#city").val()][i];
      str+="<option value='"+college[0]+"'>"+college[1]+"</option>";
    };
    $("#college").html(str);

     $("#depts-box").html('');
    $("#college-box").html('');
    $("#college-link").html('');
    $("#depts-box").removeClass('well');
    $("#college-box").removeClass('well');
    $("#college-link").removeClass('well');
    
    
  }
})

$("#college").change(function(e) {
  $("#depts-box").html("<h4>Loading departments...</h4>");
  $("#college-box").html("");

  if($("#college").val()==""){
    $("#depts-box").html('');
    $("#college-box").html('');
    $('#college-link').html('');
    $("#depts-box").removeClass('well');
    $("#college-box").removeClass('well');
    $("#college-link").removeClass('well');

  }
  else{
    $("#depts-box").addClass('well');
    $("#college-box").addClass('well');
    var link="";
    for (var i = 0; i < states[$("#state").val()].length; i++) {
      var college=states[$("#state").val()][i];
      if($("#college").val()==college[0] ){
        link=college[2];
      }
    };
    $('#college-link').html("<a class='imp-link' target=_blank href='./college/"+link+"'>Click here to see the profile of your college.</a><br>Please visit your college profile here and give us a feedback if there is anything missing or misinformed. We would appreciate your contribution.");
    $('#college-link').addClass('well');
    jQuery.ajax({
      type:'POST',
      data:{id:$("#college").val()},
      url:'php/getdepts.php',
      success:function(data){
        try{
          var depts=JSON.parse(data);
        }
        catch(e){
          $("#depts-box").html("Error loading departments");
          return;
        }
        if(depts.length==0){
          $("#depts-box").html("<h4>No departments available for this college please write us a feedback</h4>");
        }
        else{
          var innert="<option value=''>select rank</option>";
          
          for (var i = 1; i <= depts.length ; i++) { 
            innert+="<option>"+i+"</option>";
          };
          var str="<h4>Rank the branches in your college according to your experience.</h4><h5>Give rank 1 to the best branch according to you and follow..</h5><table class='table' id='col-table'>";
          for (var i = depts.length - 1; i >= 0; i--) {
            str+='<tr>';
            str+='<td><div id="dept'+i+'">'+depts[i]+"</div></td><td><select id='row"+i+"'' class='form-control'>"+innert+"<select></td>";
            str+='</tr>';

          };
          str+='</table>';
          $("#depts-box").html(str);
        }
        $("#col-table tbody tr td select").change(function(e){
          var no=$("#col-table tbody tr td select").length,all=[];
          for (var i = 0; i < no; i++) {
            if($("#row"+i).val()!="")
            all.push($("#row"+i).val());
          };

          var innert="<option value=''>select rank</option>";
          for (var i = 0; i < no; i++) {
            if(all.indexOf((i+1)+"")==-1){
              innert+="<option>"+(i+1)+"</option>";
            }
          };

          for (var i = 0; i < no; i++) {
            if($("#row"+i).val()==""){
              $("#row"+i).html(innert);
            }
            else{
              var temp=$("#row"+i).val();
              var put=innert+"<option>"+temp+"</option>";
              $("#row"+i).html(put);
              $("#row"+i).val(temp);
            }
          }


        })
      },
      error:function(){
        alert("Error in loading department. Internet connection error");
      }
    });

    jQuery.ajax({
      type:'POST',
      data:{id:$("#college").val()},
      url:'php/getrelatedcolleges.php',
      success:function(data){
             try{
          coll=JSON.parse(data);
        }
        catch(e){
          console.log(data);   
          $("#college-box").html("Error loading colleges");
          return;
        }
        if(coll.length==0){
          $("#college-box").html("<h4>No related available for this college please write us a feedback</h4>");
        }
        else{
          var innert="<option value=''>select rank</option>";
          
          for (var i = 1; i <= coll.length ; i++) { 
            innert+="<option>"+i+"</option>";
          };
          var str="<h4>Rank these colleges from 1 to 10 according to your understanding of them. Give rank 1 to the best college out of these and 10 to the last one.</h4><table class='table' id='dept-table'>";
          for (var i = 0 ; i <  coll.length; i++) {
            str+='<tr>';
            str+='<td><div><input type="hidden"  id="col'+i+'" value="'+coll[i][1]+'"><a target=_blank href="./college/'+coll[i][2]+'">'+coll[i][0]+"</a></div></td><td>"+coll[i][3]+"</td><td><select id='crow"+i+"'' class='form-control'>"+innert+"<select></td>";
            str+='<td><button type="button" class="btn-danger btn" onclick="deletecollege('+i+')"><span class="glyphicon glyphicon-trash"></span></button></td>'
            str+='</tr>';

          };
          str+='</table>';
          $("#college-box").html(str);
        }
        
        $("#dept-table tbody tr td select").change(function(e){
          var no=$("#dept-table tbody tr td select").length,all=[];
          for (var i = 0; i < no; i++) {
            if($("#crow"+i).val()!="")
            all.push($("#crow"+i).val());
          };

          var innert="<option value=''>select rank</option>";
          for (var i = 0; i < no; i++) {
            if(all.indexOf((i+1)+"")==-1){
              innert+="<option>"+(i+1)+"</option>";
            }
          };

          for (var i = 0; i < no; i++) {
            if($("#crow"+i).val()==""){
              $("#crow"+i).html(innert);
            }
            else{
              var temp=$("#crow"+i).val();
              var put=innert+"<option>"+temp+"</option>";
              $("#crow"+i).html(put);
              $("#crow"+i).val(temp);
            }
          }


        })
      },
      error:function(){
        alert("Error in loading colleges. Internet connection error");
      }
    });
  }
})


$("#depts-form").submit(function(e){
  e.preventDefault();
  if($("#state").val()==""){
    alert("Please chose state");
    return;
  }
  if($("#college").val()==""){
    alert("Please chose college");
    return;
  }
  var no=$("#col-table tbody tr td select").length;
  for (var i = 0; i < no; i++) {
    if($("#row"+i).val()==''){
      alert("Please rank all departments");
      return;
    }
  };
  var thing={};
  for (var i = 0; i < no; i++) {
    var index=$("#row"+i).val();
    var name=$("#dept"+i).html();
    thing[index]=name;
  };

  var depts=JSON.stringify(thing);
  $("#depts").val(depts);

   no=coll.length;
  for (var i = 0; i < no; i++) {
    if(coll[i][4]==0)
      continue;
    if($("#crow"+i).val()==''){
      alert("Please rank all Colleges");
      return;
    }
  };
  thing={};
  for (var i = 0; i < no; i++) {
    if(coll[i][4]==0)
      continue;
    var index=$("#crow"+i).val();
    var name=$("#col"+i).val();
    thing[index]=name;
  };

  var colrank=JSON.stringify(thing);
  $("#colrank").val(colrank);

  var data=$(this).serialize();
  
  jQuery.ajax({
    url:"php/submitdepts.php",
    data:data,
    type:"post",
    success:function(data){
      //console.log(data);
      alert("Ranks recorded");
      location.reload();
    },
    error:function(){
      alert("Failed to record ranks");
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

function deletecollege(i){
  coll[i][4]=0;
  var innert="<option value=''>select rank</option>";
          
          for (var i = 1,count=1; i <= coll.length ; i++) { 
            if(coll[i-1][4]==0)
              continue;
            innert+="<option>"+count+"</option>";
            count++;
          };
          var str="<h4>Rank these colleges from 1 to 10 according to your understanding of them. Give rank 1 to the best college out of these and 10 to the last one.</h4><table class='table' id='dept-table'>";
          for (var i = 0 ; i <  coll.length; i++) {
            if(coll[i][4]==0)
              continue;
            str+='<tr>';
            str+='<td><div><input type="hidden"  id="col'+i+'" value="'+coll[i][1]+'"><a target=_blank href="./college/'+coll[i][2]+'">'+coll[i][0]+"</a></div></td><td>"+coll[i][3]+"</td><td><select id='crow"+i+"'' class='form-control'>"+innert+"<select></td>";
            str+='<td><button type="button" class="btn-danger btn" onclick="deletecollege('+i+')"><span class="glyphicon glyphicon-trash"></span></button></td>'
            str+='</tr>';

          };
          str+='</table>';
          $("#college-box").html(str);
          $("#dept-table tbody tr td select").change(function(e){
          var no=coll.length,all=[];
          for (var i = 0; i < no; i++) {
              if(coll[i][4]==0)
                continue;
              if($("#crow"+i).val()!="")
              all.push($("#crow"+i).val());
          };

          var innert="<option value=''>select rank</option>";
          for (var i = 0,count=1; i < no; i++) {
            if(coll[i][4]==0)
                continue;
            if(all.indexOf(count+"")==-1){
              innert+="<option>"+count+"</option>";
            }
            count++;
          };

          for (var i = 0; i < no; i++) {
            if(coll[i][4]==0)
                continue;
            if($("#crow"+i).val()==""){
              $("#crow"+i).html(innert);
            }
            else{
              var temp=$("#crow"+i).val();
              var put=innert+"<option>"+temp+"</option>";
              $("#crow"+i).html(put);
              $("#crow"+i).val(temp);
            }
          }


        })
}
</script>


</body>
</html>