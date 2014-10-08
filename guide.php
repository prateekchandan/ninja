<?php
include 'php/dbconnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Infermap</title>
    <meta name="title" content="Infermap - Next Generation Education Portal">
    <meta name="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">
    <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
    <meta property="og:title" content="Infermap - Next Generation Education Portal"/>
    <meta property="og:site_name" content="Infermap"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="http://www.infermap.com/img/social.png"/>
    <meta property="og:url" content="http://www.infermap.com"/>
    <meta property="og:description" content="Infermap is a free comprehensive platform 
        that improves the college selecting process, based on individual resources and 
        requirements. Inspired by a belief that all students deserve access to good guidance, 
        infermap aims to create the interactive tools and media that guide students as they find,
         afford and enroll in a college that’s a good fit for them."/>
    <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
    <meta property="article:publisher" content="https://www.facebook.com/infermap" />
    <meta itemprop="name" content="Infermap - Next Generation Education Portal">
    <meta itemprop="description" content="Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
    <meta property="fb:admins" content="prateekchandan5545"/>
    <link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
    <link href="data/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <style type="text/css">
    </style>

    <style type="text/css">
    body,html{
      overflow-x:hidden;
      
    }
    .btn{
      border-radius:0px; 
    }
    .upperguide{
      background: #FFCC00;
      border-radius: 40px;
      min-height: 100px;
      height: 400px;
      padding-left: 50px;
      padding-right: 50px;
      padding-top: 50px;
       padding-bottom: 20px;
       color: #413100;
    font-size: 18px;
    line-height: 30px;
    width: 45%;
    margin-left: 3%;

    }
    .guide{
      background: #19EB7D;
      border-radius: 40px;
      min-height: 400px;
      height: 45%;
      padding: 30px;
      padding-left: 10px;
      overflow: auto;
      padding-right: 40px;
      font-size: 18px;
    }
    .header-guide{
      padding: 6px;
      text-align: center;
      font-size: 1.8em;
      font-weight: bold;
      line-height: 90px;
      color:#02294A;
    }
    .question{
      color:#111;
      padding-left: 10%;
      font-weight: bold;
      padding-top: 10px;

    }
    .answer{
      padding-top: 10px;
      padding-left: 10%;
      color: #333;
      list-style: none;
    }
    html,body{
      height: 100%;
    }
    .page-bar{
      margin:0px;
      padding:10px;
      text-align: center;
    }
    .point{
      min-height: 5px;
      min-width: 5px;
      border-radius: 50%;
      background: #aaa;
      color:#aaa;
      cursor: pointer;
      display: inline;
      padding-right: 8px;
      padding-left: 8px;
      margin: 1px;
    }
    .point-active{
       background: white;
      color:#FFCC00;;
    }
    #typeahead-parent>span{
      width: 100% !important;
    }
    .form-control{
      border-radius: 0px;
    }
    .other-filters{
      display: none;
    }
    .fa-7x {
      font-size: 7em;
      }
      .added-college{
        padding:4px;
        margin: 4px;
        background: rgba(0,0,0,0.2);
        border-radius: 3px;
        font-size: 12px;
      }
      .cutcol {
      font-size: 21px;
      font-weight: bold;
      line-height: 1;
      color: #fff;
      text-shadow: 0 1px 0 #ffffff;
      opacity: 0.2;
      margin-left: 9px;
      background: rgba(0,0,0,0.5);
      filter: alpha(opacity=20);
      }
      .row{
        margin-left: 0px;
      }
      label{
        font-size: 16px;
      }
      #speechbubble-y{
        position: absolute;
        bottom: -25%;
        height: 36%;
        right: 10px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
      }
    </style>
</head>
<body>

 <?php
 include "header.php"; ?>
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

            <div class="col-md-12 header-guide">
              Answer 7 simple questions and get your personal road map to college.
            </div>

    <div class="row container" style="margin:auto">
      <div class="col-md-6" style="padding-left:5%">
        <div>
          <div class="guide">
            <form method="get" action="main.php" id="guide-form">
              <input type="hidden" name="search" value="guide">
              <div id="page1">
                <img src="img/1.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                <br>
                  What grade are you in?
                </div>
              <div class="answer col-md-12">
                  <div class="col-md-12"><input type="radio" name="grade" value="in 11th grade" onchange="fillupperguide(' in 11th grade',0)"> 11th grade</div>
                  <div class="col-md-12"><input type="radio" name="grade" value="in 12th grade" onchange="fillupperguide(' in 12th grade',0)"> 12th grade</div>
                  <div class="col-md-12"><input type="radio" name="grade" value="a high school graduate" onchange="fillupperguide(' a high school graduate',0)"> High School Graduate</div>
              </div>
              </div>
              <div id="page2" style="display:none">
                <img src="img/2.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                  When it comes to searching for colleges, which best describes you?
                </div>
                <div class="answer col-md-12">
                  <div><input type="radio" name="college-weight" value="0" onchange="fillupperguide('  don’t  know where to start',1);$('#page2>.other-filters').css('display','none');"> I'm not sure where to start</div>
                  <div><input type="radio" name="college-weight" value="4" onchange="fillupperguide('   have some colleges in mind',1);$('#page2>.other-filters').css('display','block');"> I have some colleges in mind</div>
                </div>
                 <div class="other-filters col-md-12">
                  <div class="form-group row" style="font-size:12px; margin-top:10px;">
                    <label class="col-md-12">Select college:</label>
                    <div class="col-md-12" id="typeahead-parent">
                      <input class="form-control typeahead" placeholder="type college name" id="college-name">
                    </div>            
                  </div>
                  <div class="col-md-12 row" id="selected-colleges">
                  </div>
                  <input type="hidden" value="[]" name="college-list" id="college-list">
                </div>
              </div>
              <div id="page3" style="display:none">
                <img src="img/3.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                  Have you cleared any entrance test or planning to give any?
                </div>
                <div class="answer col-md-12">
                 <div class="col-md-12"><input type="radio" name="exam-weight" value="2" onchange="fillupperguide(' planning ',2);$('#page3>.other-filters').css('display','block');"> Yes</div>
                  <div class="col-md-12"><input type="radio" name="exam-weight" value="0" onchange="fillupperguide(' not planning ',2);$('#page3>.other-filters').css('display','none');"> No</div>
                  <div class="col-md-12"><input type="radio" name="exam-weight" value="0" onchange="fillupperguide(' not quite sure',2);$('#page3>.other-filters').css('display','none');"> I'm not sure</div> 
                </div>
                <div class="other-filters col-md-12">
                  <div class="form-group">
                    <label class="col-md-12">Which exam? :</label>
                    <div class="col-md-12">
                      <select class="form-control" id="exam-search" name="exam">
                        <option value="">Select exam</option>
                        <?php
                          $q=mysqli_query($con,"select distinct name from exam where type='be' || type='btech'");
                          while($row=mysqli_fetch_assoc($q))
                            {
                              if($exam==$row['name'])
                                echo "<option selected>".$row['name']."</option>";
                              else
                              echo "<option>".$row['name']."</option>";
                            }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div id="page4" style="display:none">
                <img src="img/4.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                  Do you have preferences to study in a particular location?
                </div>
                <div class="answer col-md-12">
                 <div class="col-md-12"><input type="radio" name="location-weight" value="2" onchange="fillupperguide(' at a specific place',3);$('#page4>.other-filters').css('display','block');$('#page6>.other-filters2').css('display','none');"> Yes, absolutely </div>
                  <div class="col-md-12"><input type="radio" name="location-weight" value="big-city" onchange="fillupperguide(' in big cities',3);$('#page4>.other-filters,#page6>.other-filters2').css('display','none');"> I would prefer big cities</div> 
                  <div class="col-md-12"><input type="radio" name="location-weight" value="2" onchange="fillupperguide(' close to home',3);$('#page4>.other-filters2').css('display','block');$('#page6>.other-filters').css('display','none');"> I want to stay close to home </div> 
                  <div class="col-md-12"><input type="radio" name="location-weight" value="0" onchange="fillupperguide(' anywhere',3);$('#page4>.other-filters,#page6>.other-filters2').css('display','none');"> No, not really </div>

                </div>
                <div class="col-md-12 other-filters">
                  <div class="row">
                    <div class="form-group col-md-12 row">
                      <label class="col-md-3">State:</label>
                      <div class="col-md-9">
                        <select class="form-control" id="location-state" name="state">
                          <option value="">Select State</option>
                          <?php
                            $q=mysqli_query($con,"select distinct state from college_id where state!='' && state!='--Select State--'");
                            $sta=array();
                            while($row=mysqli_fetch_assoc($q))
                            {
                                echo "<option>".$row['state']."</option>";
                              $sta[$row['state']]=array();
                            }
                            $str="";
                            $q=mysqli_query($con,"select distinct city,state from college_id where state!='' && state!='--Select State--' && city!=''");
                            while($row=mysqli_fetch_assoc($q))
                            {
                              array_push($sta[$row['state']],$row['city']);
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-12 row">
                      <label class="col-md-3">City :</label>
                      <div class="col-md-9">
                        <script type="text/javascript">
                            var states=<?php echo json_encode($sta); ?>;
                            function setcity(){
                              if($("#location-state").val()==""){
                                $("#location-city").html("<option value=''>Select city</option>");
                                return;
                              }
                              var cities=states[$("#location-state").val()];
                              var str="<option value=''>Select city</option>";
                              for (var i = cities.length - 1; i >= 0; i--) {                        
                                  str+="<option>"+cities[i]+"</option>";
                              };
                              $("#location-city").html(str);
                            }
                            $("#location-state").change(function(){
                              setcity();
                            });
                            setcity();
                        </script>
                        <select class="form-control" id="location-city" name="city">
                          <option value="">Select city</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 other-filters2" style="display:none">
                  <div class="form-group row" >
                    <label class="col-md-3">City </label>
                    <div class="col-md-9">
                      <input class="form-control" name="address">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-md-3">Kilometres </label>
                    <div class="col-md-9">
                      <input class="form-control" type="number" name="distance">
                    </div>
                  </div>
                </div>
              </div>
              <div id="page5" style="display:none">
                <img src="img/5.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                  When you imagine yourself after 4 years, how do u see yourself?
                </div>
                <div class="answer col-md-12">
                  <div class="col-md-12"><input type="radio" name="department-weight" onchange="fillupperguide('  have a',4);$('#page5>.other-filters').css('display','block');" value="2"> Yes, in ________ Engineering</div>
                  <div class="col-md-12"><input type="radio" name="department-weight" value="0" onchange="fillupperguide('  don\'t have a ',4);$('#page5>.other-filters').css('display','none');"> No , not Really </div>
                </div>
                <div class="other-filters col-md-12">
                <br>
                  <div class="form-group">
                    <label class="col-md-12">Chose your field :</label>
                    <div class="col-md-12">
                      <select class="form-control" name="department">
                        <option value=''>Select department</option>
                                <?php
                                  $q=mysqli_query($con,"select * from departments");
                                  while($row=mysqli_fetch_assoc($q))
                                  {
                                    if($department==$row['key'])
                                      echo "<option selected value='".$row['key']."'>".$row['value']."</option>";
                                    else
                                      echo "<option value='".$row['key']."'>".$row['value']."</option>";
                                  }
                                ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div id="page6" style="display:none">
               <img src="img/6.png" style="position:absolute;top:145px;right:17px;">
                <div class="question col-md-12">
                  How much help do you want finding ways to pay for college?
                </div>
                <div class="answer col-md-12">
                 <div class="col-md-12"><input type="radio" name="fee-help" value="2" onchange="fillupperguide('a lot of',5)"> A lot</div>
                  <div class="col-md-12"><input type="radio" name="fee-help" value="1" onchange="fillupperguide('some',5)"> Some</div>
                  <div class="col-md-12"><input type="radio"name="fee-help" value="0" onchange="fillupperguide(' no',5)"> Little or none</div> 
                </div>
              </div>
              
             
              
              <div id="page7" style="display:none">
                <img src="img/7.png" style="position:absolute;top:145px;right:17px;">
                <br>
                <div class="question col-md-12">
                  What would you prefer?
                </div>
                <div class="answer col-md-12">
                 <div class="col-md-12"><input type="radio" name="typeofcollege" value="govt" onchange="fillupperguide(' government',6)"> Government </div>
                  <div class="col-md-12"><input type="radio" name="typeofcollege" value="private" onchange="fillupperguide(' private',6)"> Private </div>
                  <div class="col-md-12"><input type="radio" name="typeofcollege" value="none" onchange="fillupperguide(' no',6)"> No Preference</div> 
                </div>
                 
              </div>
            </form>
            <div style="bottom:0px; position:absolute;left:42%;">
              <div class="col-md-12 page-bar">
                <div class="point point-active" id="point1" onclick="gotopage(1)"></div>
                <div class="point" id="point2" onclick="gotopage(2)"></div>
                <div class="point" id="point3" onclick="gotopage(3)"></div>
                <div class="point" id="point4" onclick="gotopage(4)"></div>
                <div class="point" id="point5" onclick="gotopage(5)"></div>
                <div class="point" id="point6" onclick="gotopage(6)"></div>
                <div class="point" id="point7" onclick="gotopage(7)"></div>
                
              </div>
            </div>
          </div>
          <div style="bottom:-5px; position:absolute;left:23%;" >
            <i id="prev-guide" class="fa fa-caret-left fa-5x"></i>
          </div>
          <div style="bottom:-5px; position:absolute;right:15%;" >
            <i id="next-guide" class="fa fa-caret-right fa-5x"></i>
          </div>
        </div>

      </div>
      <div class="col-md-6 upperguide">
        <img src="img/getplan.png" style="position:absolute;top:-10px;left:-10px;">
        <p id="guide-text">I am a ......... When it comes to college search, ...............
         As far as paying for college, I'm looking for ........ help. When I imagine future, ................... 
         Well I am ............ entrance exam.
             Definitely I would love to stay .......... Long story short I’m ...... in studies.</p>
        <img src="img/speech%20bubble.png" id="speechbubble-y">
      </div>
    </div>
    <div class="col-md-12 row" style="text-align:center;margin-top:20px;margin-bottom:40px">
        <button class="btn btn-lg btn-success" style="min-width:20%;" onclick="$('#guide-form').submit()">Proceed to result</button>
    </div>

    <?php
      include "footer.php";
    ?>
<script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">
  var guidepage=1;
  $("#prev-guide").click(function () {
    if(guidepage==1)
      return;
    $("#page"+guidepage).css("display","none");
    $("#point"+guidepage).removeClass("point-active");
    guidepage--;
     $("#page"+guidepage).css("display","block");
  })
  $("#next-guide").click(function () {
    if(guidepage==7)
      return;
    $("#page"+guidepage).css("display","none");
    guidepage++;
     $("#page"+guidepage).css("display","block");
      $("#point"+guidepage).addClass("point-active");
  })
  var que=["I am ", ". When it comes to college search, I ",".Well I am "," to give an entrance exam. Definitely I would love to stay "," . When I imagine future, I "," a department preference. As far as paying for college, I need "," help. I have a preference for a "," college."];
  var tempans = ["........","..............","......","..................","...............","............","........"];
  var ans=["........","..............","......","..................","...............","............","........"];
  function fillupperguide(value,no){
    ans[no]=value;
    var str=que[0];
    for(var i=0;i<7;i++){
      if(ans[i] == tempans[i]){
        str+="<b onclick='gotopage("+(i+1)+")' style='background:#CCA202;padding:2px;border-radius:15px;font-size:16px; cursor:pointer'>"+ans[i]+"</b>"+que[i+1];
      }
      else{
        str+="<b onclick='gotopage("+(i+1)+")' style='background:#5F4B04;padding:2px;border-radius:15px; color:white; padding-left:8px;padding-right:8px; font-size:16px; cursor:pointer'>"+ans[i]+"</b>"+que[i+1];
      }
      
    }
    $("#guide-text").html(str);
  }
  function gotopage(no){
    for(var i=1;i<=7;i++){
      if(i<=no)
        $("#point"+i).addClass("point-active");
      else
        $("#point"+i).removeClass("point-active");
    }
    $("#page"+guidepage).css("display","none");
      guidepage=no;
      $("#page"+guidepage).css("display","block");
  }
fillupperguide("..........",0);
var allselected=[];
$('#guide-form').find('input').keypress(function(e){ 
    if ( e.which == 13 ) // Enter key = keycode 13
    {
      if($("#college-name").val().length==0)
          return;
      jQuery.ajax({
        url:"php/compareadd.php",
        data:{key:$("#college-name").val()},
        type:"POST",
        success:function(data){
          if(data=="null"){
            $("#message").html("No college found");
          }
          else{
            if(data.substr(0,7)=="college")
            {
              arr=JSON.parse(data.substr(7));
              putcollege(arr['cid'])
            }
            else if(data.substr(0,7)=="keyword")
            {
              colleges=JSON.parse(data.substr(7));

              var cnt=0;
              var str="Click on one of the following to add:<ul>";
              for(var key in colleges)
              {
                str+='<li><a onclick="putcollege(colleges['+key+'])">'+colleges[key]['name']+'</a></li>'
                cnt++;
              }
              str+='</ul>';
              if(cnt==0)
                $("#message").html("The college not found try again");
              else
              {
                $("#message").html(str);
              }
              $("#message").append('</ul>');

            }
            else{
              $("#message").html("Some error occured");
            }
          }
        }
      })
       if(e.currentTarget.id=="college-name"){
        if($("#college-name").val().length<5)
          return;
          if(allselected.indexOf($("#college-name").val()) == -1){
            allselected.push($("#college-name").val());            
            var str="";          
            for (var i = 0; i <allselected.length ; i++) {
              var name=allselected[i];
              str+="<span class=\"added-college\" id='"+name+"'>"+name+"<span class=\"cutcol\" onclick='deletefrom(\""+name+"\")'>&times;</span></span>";
            };
             $("#selected-colleges").html(str);
             $("#college-name").val("")
             $("#college-list").val(JSON.stringify(allselected));
          }
       }
        return false;
    }
});
function deletefrom(id){
  var str="",index=allselected.indexOf(id);
  if (index > -1) {
    allselected.splice(index, 1);
  }          
  var str="";
  for (var i = 0; i <allselected.length ; i++) {
    var name=allselected[i];
    str+="<span class=\"added-college\" id='"+name+"'>"+name+"<span class=\"cutcol\" onclick=\"deletefrom('"+name+"')\">&times;</span></span>";
  };
  $("#selected-colleges").html(str);
  $("#college-list").val(JSON.stringify(allselected));
}
</script>



</body>
</html>