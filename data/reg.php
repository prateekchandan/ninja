<?php
header("Location: index.php");
session_start();
  if(!isset($_SESSION['datauserid']))
  {
    header("Location: index.php");
  }
  if(!isset($_SESSION['college_name']))
  {
    header("Location: index.php");
  }
$college_name=$_SESSION['college_name'];
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
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
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="The ultimate portal for web enquiry">
    <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan">
    <meta name="author" content="Prateek Chandan">

    <title>
      Registraion for college
    </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"/>
    <script src="js/jquery.js">
    </script>
    <script src="bootstrap/js/bootstrap.min.js">
    </script>
     <link rel="icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="fonts/googleapi.css">
    <style type="text/css">
    
      body{
        color: #4d4d4d;
        font-family: "open sans";
        /*font-family: "Open Sans", "Helvetica Neue", "Helvetica", sans-serif;*/
        font-size: 15px;
        -webkit-font-smoothing: antialiased;
        line-height: 1.7333;
      }
      #regbody
      {
        padding: 2%;
        border-right: 1px solid #ccc;
        
      }
      #headline
      {
        text-align: center;
        font-family: "Open Sans", "Helvetica Neue", "Helvetica", sans-serif;
      }
      .onhoverfunction:hover{
        cursor:pointer;
      }
      .stream-inner-container> .stream-inner select{
        margin-bottom:10px;
      }
      .btn
      {
        border-radius: 0px;
      }
      input{
        border-radius: 0px !important;
      }

	.stream-inner-container> .stream-inner{
		background-color: #fff;
		/*border: 1px solid #aaa;*/
	}/*
	.stream-inner-container> .stream-inner:first-of-type{
		border-top-left-radius: 8px;
		border-bottom-right-radius: 8px;
		border: 1px solid #aaa;
		border-bottom: 0px;
	}
	.stream-inner-container> .stream-inner:last-of-type{
		border-bottom-left-radius: 8px;
		border-bottom-right-radius: 8px;
		border: 1px solid #aaa;
	}*/
  #college-reg-heading {
    background: url('img/college-reg-header.jpg') no-repeat center top transparent;
    background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    -ms-background-size: cover;
    height: 150px;
   }
   #college-reg-heading h1 {
    font-weight: bold;
    margin: 0px;
    text-align: center;
    vertical-align: middle;
    color: #fff;
    width: 100%;
    line-height: 150px;
    font-family: 'Open sans';
    font-weight: normal;
    letter-spacing: 3px;
    }

.navbar-brand{
  padding: 0px
}
    .adress>input,.adress>select{
      width:85%;
      float:right;
       margin-bottom: 10px;
    }
    .adress>addressname{
      width:15%;
      float:left;
      min-height: 34px;
      margin-bottom: 10px;
    }
    
    select{
      border-radius: 0px !important;
    }

    </style>
  </head>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-brand" href="#">
            <a href="http://www.infermap.com">
                <img src="img/head.png" >
            </a>
        </div>
    <ul class="nav navbar-nav">
        <li class=""><a href="dataeditor.php">Home</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
       <li id="nav-login-btn" class=""><a href="#" onclick="logout()"><i class="fa fa-logout"></i>Logout</a></li>
         </ul>
    </nav>
  <body style="padding-top:60px;">
  <div style="margin-bottom:20px" id="college-reg-heading">
    <h1>REGISTER YOUR COLLEGE HERE</h1>
  </div>
  
  <div class="container" style="width:85%;">
    <div class="container col-xs-7" id="regbody">
      <form class="form" role="form" method="post" action="php/new-college-entry.php" id="mainform">
        <div class="form-group">
          <label for="inputName">
            College Name
          </label>
          <?php echo '<input type="text" class="form-control" id="inputName" name="inputName" value="'.$college_name.'" readonly>';?>
            
        </div>
          <div class="form-group">
        <label for="aliasformgroup">
          <div>
            <h4>
              <a id="alias-add" class="onhoverfunction" onclick="addalias(this)"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Click this to add aliases">
                Add an alias 
              </a>
              <i class="fa fa-question" id="alias-info" data-toggle="tooltip" data-placement="right" title="Chosing Aliases for college Names enhances the seach for your college
Ex- IITB , IIT Powai , IIT Bombay etc ">
              </i>
            </h4>
            (at most 8)
          </div>
        </label>
        <div id="aliasformgroup">
          <input type="hidden" id="noofalias" name="noofalias" value="0">
        </div>
        </div>
         <div class="form-group adress">
         <addressname> State : </addressname>
         <select class="form-control" name="statename" placeholder="Select State">
          <option>--Select State--</option>
          <?php
              $exams=mysqli_query($con,"select * from states");
              while($row=mysqli_fetch_assoc($exams))
              {
              echo '<option>'.$row['name'].'</option>';
              }
              ?>
        </select>
            
        </div>
        
        <div class="form-group" >
          <label for="">
            Chose the Available Degrees for this institute:
          </label>
          <div id="stream_checkbox">
          <table>
            <?php
              $i=0;
              $exams=mysqli_query($con,"select * from allcourses");
              while($row=mysqli_fetch_assoc($exams))
              {if($i==0){
                echo "<tr>";
                $i=1;
              }
              else
                $i=0;
              echo '<td>
              <label class="checkbox-inline">
              <input type="checkbox"  value="'.$row['name'].'" id="'.$row['name'].'-select" name="'.$row['name'].'-select">
              '.$row['value'].'
              </label></td>
              ';
              if($i==0){
                echo "</tr>";
              }
              }
              echo "</table>";
              $exams=mysqli_query($con,"select * from allcourses");
              echo '<div class="stream-inner-container"> <i>Cant find your stream? Email us to infermap@gmail.com or fill the feedback form on one of the college page</i><br> ';
              while($row=mysqli_fetch_assoc($exams))
              {
              echo '
              <div id="'.$row['name'].'-inner">
              </div>
              ';
              }
              echo '</div>'
            ?>
          </div>
        </div>
  </form>
  <div class="modal fade" id="new_stream" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color:#111;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <b style="font-size:1.5em">INSTRUCTION</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="Stream_name">Name of Stream</label>
                    <input type="text" class="form-control" id="Stream_name" placeholder="Ex :- btech">
                    <p class="help-block">It should not contain <b>only</b> alphabets and no speacial characters</p>
                  </div>
                  <div class="form-group">
                    <label for="stream_view">How it should be viewed</label>
                    <input type="text" class="form-control" id="stream_view" name="stream_view" placeholder="Ex :- B.Tech">
                    <p class="help-block">This will be dispalyed in the names of tables and viewing purposes everywhere</p>
                  </div>
                  <button id="stream_add" class="btn btn-success">Submit</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
   <div class="form-group">
      <button id="submit-btn" class="btn btn-primary">
        Submit
      </button>
  </div>
    </div>
  <div class="col-xs-5">
    <h2 style="text-align:center;">FAQs</h2>
    <b>Q: What is alias and why is it important ?</b>
    <p><strong>Ans:</strong> Alias means what are the other names by which your college is called. Ir is important because it will help you in a better searching of your college
      For example IIT Bombay can be called by many otherf names like IITB , IIT Powai etc.. Similarly give all other possible names by which your college can be searched.<br>
      Click on add new alias for adding a new alias</p>
       <b>Q: I cant find a stream / Exam name?</b>
    <p><strong>Ans:</strong>Click o the link to add stream , feed the proper data and click on add. To add a exam , Select the stream Type the exam name in the box provided then press ENTER </p>
    <b>Q: What should we chose the streams over here?</b>
    <p><strong>Ans:</strong> While editing the the profile for the college we need these information to build the tables. </p>
    <b>Q:Can we change the data for chosing the stream and the the category iformation later?</b>
    <p><strong>Ans:</strong>Yes , Ofcourse but you wont be able to feed the admission and placement data while editing the profile </p>
  </div></div>
  </body>
  <script>
    $(document).on('change', '#alias-select', function() {
      console.log($(this).val());
      // the selected options’s value
      
      // if you want to do stuff based on the OPTION element:
      var opt = parseInt($(this).val());
      // use switch or if/else etc.
      var res="";
      if(opt!=0)
    	res="Enter Aliases<br>";
  for (var i = 1; i <= opt; i++) {
    res+='<div class="col-xs-3"><input type="text" class="form-control" id="alias'+i+'" name="alias'+i+'" placeholder="Alias '+i+'"> </div>';
  }
  ;
  $("#alias-names").html(res);
}
              );
  
  
  function addalias(t){
	var no =$("#noofalias").val();
  if(no == 8) return;
  no++;
  $("#noofalias").val(no);
  var temp ='';
  temp += '<div style="padding-top:10px;""><div class="col-xs-11" style="padding:0px"><input class="form-control" id="alias'+no+'" name="alias'+no+'" placeholder="alias '+no+'"></div><button class="btn btn-danger" onclick="removeparent(this)"><i class="fa fa-times"></button><div>';
  $("#aliasformgroup").append(temp);
}
  
  function removeparent(t){
	var index = $(t).parent().index();
  var no = $("#noofalias").val();
  no--;
  $("#noofalias").val(no);
  for(var i = index-1; i < no+1; i++){
    var id = "#alias" + (i+1);
    $(id).attr('name', 'alias'+i);
    $(id).attr('placeholder', 'alias '+i);
    $(id).attr('id', 'alias'+i);
  }
  $(t).parent().remove();
}
  var a;
  <?php
  $exams=mysqli_query($con,"select * from allcourses");
  while($row=mysqli_fetch_assoc($exams))
  {
    echo $row['name']."=\"".$row['name']."\";";
    $a="<H4>".$row['value']."</H4><select class=\"form-control\" id=\"".$row['name']."-exam-name\" name=\"".$row['name']."-exam-name\">";
    $exam_names=mysqli_query($con,"select name from exam where type = '".$row['name']."' || type='wild'");
    while($row1=mysqli_fetch_assoc($exam_names))
    {
      $a.="<option>".$row1['name']."</option>";
    }
    $a.="</select>";
    $a.="<div class=\"col-md-12\">Or add a <a href=\"#".$row['name']."-new-exam\" onclick=\" $(\'#".$row['name']."-new-exam\').toggle(); \" name=\"\">new</a> Exam: </div><input class=\"form-control\" id=\"".$row['name']."-new-exam\" name=\"".$row['name']."-new-exam\" onKeyDown=\"if(event.keyCode==13) addnewexam(".$row['name'].");\" placeholder=\"Exam Name\" style=\"display:none\"></input>";
    foreach ($categories as $key) {
          $a.="<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"".$row['name'].$key['id']."\" id=\"".$row['name']."-".$key['id']."\">".$key['name']."</label>";
      }
      echo '$("#'.$row['name'].'-select").click(function() {
		if($("#'.$row['name'].'-select").is(":checked"))
		{
          $("#'.$row['name'].'-inner").html(\''.$a.'\');
          $("#'.$row['name'].'-inner").addClass("stream-inner");
          }
    else{
      $("#'.$row['name'].'-inner").html("");
      $("#'.$row['name'].'-inner").removeClass("stream-inner");
    }
		});
    ';
    }
  ?>
  $("#submit-btn").click(function(e){
    var r=confirm("Submitting this form create changes everywhere \n\nIts your responsibility that about the correctness of data and maintaining intergrity of being a user\n\nPlease check the college name again and all the details which you have filled here as it cant be changed later \n\n\nAre You sure of its correctness ?");
    if (r==true)
      {
          $("#mainform").submit();
      }
    else
      {
      }
      });
  $("#stream_add").click(function(e){
    var c=$("#Stream_name").val(),st=0;
    for (var i = c.length - 1; i >= 0; i--) {
      var l=c.charCodeAt(i);
      if(l<97||l>123)
      {
        st=1;
      }
    };
    if($("#Stream_name").val()==""||st!=0)
    {
      $("#Stream_name").parent().addClass("has-error");
      return false;
    }
    else
      $("#Stream_name").parent().removeClass("has-error");
    if($("#stream_view").val()=="")
    {
      $("#stream_view").parent().addClass("has-error");
      return false;
    }
    else
      $("#stream_view").parent().removeClass("has-error");
      $.post("php/stream_add.php",{

                            stream_name:$("#Stream_name").val(),
                             stream_val:$("#stream_view").val(),
                            
                        })
                        .done(function(data) {
                          location.reload();
                          })
                          .fail(function(data) {
                            
                          })
    return false;
  });
  function change(a)
  {
    alert(a);
  }
  function logout()
      {
        window.location="php/logout.php";
      }
  function addnewexam(stream)
  {
    var exam_name=$("#"+stream+"-new-exam").val();
    var c=confirm("Are you sure want to add "+exam_name+" for "+stream+" stream ?");
    if(c==true)
    {
      $.post("php/add_new_exam.php",{

                            stream_name:stream,
                             stream_exam:exam_name,
                            
                        })
                        .done(function(data) {
                          })
                          .fail(function(data) {
                            alert( "fail" );
                          })
      $("#"+stream+"-exam-name").append('<option>'+$("#"+stream+"-new-exam").val()+'</option>');
    }
    
  }
  $("#alias-add").tooltip();
  </script>
</html>
