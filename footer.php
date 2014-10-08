    <?php
      session_start();
if(isset($_SESSION['user-email']))
  $user=$_SESSION['user-email'];
else
  $user=false;
    ?>

    <style type="text/css">

.login-box{
  width: 95%;
  margin: auto;
  margin-top: 10%;
  
  border-radius: 10px;
  background: #1D9E74;
  box-shadow: 0 0 25px #000;
  color: white;
}
#log-head {
padding: 5px;
padding-left: 50px;
border-bottom: 1px solid #aaa;
}
.modal-footer{
  border:0px;
}
/* LOGIN NAV BAR */
.login-nav>li{
  width: 50%;
  margin: 0px;
}
.login-nav>li.active>a{
  color: #666 !important;
}
.login-nav>li>a{
color: #fff !important;
border-radius: 0px;
border-top-right-radius:10px; 
}
.login-nav>:first-child>a{
  border-top-left-radius:10px; 
  border-top-right-radius:0px; 
}
  
  .left-inner-addon input {
    padding-left: 30px;    
}
.left-inner-addon i {
    position: absolute;
    padding: 10px 12px;
    pointer-events: none;
}
.left-inner-addon-form {
    margin-top: 0px;
}
.left-inner-addon-form input {
    padding-left: 30px;    
}
.left-inner-addon-form i {
    position: absolute;
    padding: 14px 12px;
    pointer-events: none;
     color:#ababab;
}
.fa-darkinp{
  color:#666;
}
.register-input{
  border-radius: 0px;
}
#login-form>div>div.form-group{
  overflow: auto;
  margin-top: 4px;
  margin-bottom: 0px;
}
#register-form>div>div.form-group{
  overflow: auto;
  margin-top: 4px;
  margin-bottom: 0px;
}
@media screen and (max-width :900px){


  }
    </style>
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content login-box">                    
                
                        <ul class="nav nav-tabs  login-nav">
                          <li class="active"><a href="#login-modal" data-toggle="tab"><h4>Login to site</h4></a></li>
                          <li class=""><a href="#register-modal" data-toggle="tab"><h4>Register </h4></a></li>                          
                        </ul>      
                        <!--button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button-->                  
                        <div class="tab-content">
                          <div class="tab-pane active" id="login-modal">
                              <form role="form" id="login-form">
                                <div class="modal-body">                       
                                      <div class="alert alert-danger alert-dismissable" style="display:none" id="login-alert">
                                          <button type="button" class="close" onclick="$('#login-alert').css('display','none')">×</button>
                                          <div id="login-alert-text">Please signup to get an user account</div>
                                      </div>
                                        <div class="form-group">
                                      <label class="form-label col-sm-12">Email : </label>
                                    <div class="col-sm-12 left-inner-addon ">
                                        <i class="fa fa-envelope fa-darkinp"></i>
                                        <input type="email" class="form-control register-input" placeholder="user@infermap.com" name="email" required/>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="form-label col-sm-12">Password: </label>
                                    <div class="col-sm-12 left-inner-addon ">
                                        <i class="fa fa-lock fa-darkinp"></i>
                                        <input type="password" class="form-control register-input" required placeholder="**********" name="pass"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                              </form>
                          </div>
                          <div class="tab-pane" id="register-modal">
                          <form role="form" id="register-form">
                              <div class="modal-body">    
                                   <div class="alert alert-danger alert-dismissable" id="reg-err" style="display:none">
                                      <button type="button" class="close" onclick="$('#reg-err').toggle()">&times;</button>
                                      <div id="reg-msg"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                   </div>                  
                                   <div class="form-group">
                                      <label  class="form-label col-sm-3">Name : </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-user fa-darkinp"></i>
                                        <input type="text" class="form-control register-input" name="name" required/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-label col-sm-3">Email : </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-envelope fa-darkinp"></i>
                                        <input type="email" class="form-control register-input" placeholder="user@infermap.com" name="email" required/>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="form-label col-sm-3">Password: </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-lock fa-darkinp"></i>
                                        <input type="password" class="form-control register-input" placeholder="**********" name="pass"/>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="form-label col-sm-3">Retype : </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-lock fa-darkinp"></i>
                                        <input type="password" class="form-control register-input" placeholder="**********" name="repass"/>
                                    </div>
                                   </div>
                                  <div class="form-group">
                                      <label class="form-label col-sm-3">Phone: </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-phone fa-darkinp"></i>
                                        <input type="text" class="form-control register-input" placeholder="eg 9876543210" name="phone"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="form-label col-sm-3">City: </label>
                                    <div class="col-sm-9 left-inner-addon ">
                                        <i class="fa fa-globe fa-darkinp"></i>
                                        <input type="text" class="form-control register-input" placeholder="eg Mumbai" name="city"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-label col-sm-3">Presently  </label>
                                    <div class="form-label col-sm-9">
                                      <select class=" form-control register-input" name="type">
                                        <option value="2">11th or 12th student</option>
                                        <option value="3">12th Passed</option>
                                        <option value="1">Under 10th student</option>
                                        <option value="4">A college student</option>
                                        <option value="5">Already Graduated</option>
                                        <option value="6">In Job Person</option>
                                        <option value="7">Guardian of a student</option>
                                        <option value="0">Other</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-11 col-sm-offset-1">
                                    <input type="checkbox" name="agree">
                                    I want to receive regular email updates
                                  </div>                                
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button class="btn btn-primary" type="submit">REGISTER</button>
                              </div>
                            </form>
                            
                          </div>                          
                        </div>                   
                </div>
            </div>
    </div>


    <style type="text/css">
     	.footer{
  		
  			width: 100%;
  			min-height: 30px;
  			background: #121215;
  			font-size: 16px;
  			color: #999;
  			border-top:1px solid orange;
        overflow: auto;
  		}
      .footerin{
        padding: 10px;
        max-width: 1170px;
        margin: auto;
      }
      .footerin>div.col-md-2{
        border-right: 1px solid #444;
        text-align: center;
        min-height: 32px;
        width: 15%;
      }
  		.footerin>div>a{
  			color:#999;
  		  }
  		.footer-right{
  		  	float: right
  		  }
      .page-view-btn{
        float: right;
       color: #444;
        border: 2px solid rgb(218, 96, 0);
        background:rgba(255,255,255,0.05);
        }
      .page-view-btn:hover,.page-view-btn:focus{
        color:#666;
        }
        @media screen and (max-width :900px){
          .footerin>div{
            padding: 0px;
            display: inline;
            padding-right: 4%;
            padding-left: 4%;
          }
          
        }
     </style>
    <div class="footer">
      <div class="footerin">
  		  <div class="col-md-2">    
          <?php
          if(!$user)    
      			echo '<a class="whitelink" data-toggle="modal" href="#" data-target="#login">Login</a> ';
            else{
              echo '<a class="whitelink" href="#" class="btn page-view-btn" id="logout-btn">Logout</a> ';
            //echo '<button  class="btn page-view-btn" id="savecollege-btn">Saved College</button> ';

          }
          ?>
        </div>
        <div class="col-md-2">
  			 <a href="about.php" target="_blank">About us</a> 
        </div>
        <div class="col-md-2">
         <a href="FAQ.php" target="_blank">FAQ's</a> 
        </div>
        <div class="col-md-2">
          <a href="http://blog.infermap.com" target="_blank">Blog</a> 
        </div>
        <div class="col-md-2">
          <a target=_blank class="whitelink" href="https://www.facebook.com/infermap"><i class="grow faicon fa fa-facebook-square fa-2x" ></i> </a>&nbsp;&nbsp;
          <a target=_blank class="whitelink" href="https://plus.google.com/u/0/102559294513459206399/"><i class="faicon fa fa-google-plus-square fa-2x grow" ></i></a> &nbsp;&nbsp;
          <a target=_blank class="whitelink" href="https://twitter.com/inferm" ><i class="faicon fa fa-twitter-square fa-2x grow" ></i></a>			
  		  </div>
    		<div class="col-md-3" style="font-size:14px;">
    		&copy; Copyright <a href="http://www.infermap.com">Infermap.com</a>
    		</div>
       </div>
	</div>
  <script>
  $("#register-form").submit(function(e){
  var data=$("#register-form").serialize();
  jQuery.ajax({
    url:"php/register.php",
    data:data,
    type:"POST",
    success:function(data){
      console.log(data);
      $("#reg-err").addClass("alert-danger");
      $("#reg-err").removeClass("alert-success");
      if(data=="done")
      {
        $("#reg-err").removeClass("alert-danger");
        $("#reg-err").addClass("alert-success");
        $("#reg-err").css("display","block");
        $("#reg-msg").html("You have been successfully registered please check your email to activate your account");
        $("#register-form")[0].reset();
      }
      else if(data=="error"){
        $("#reg-err").css("display","block");
        $("#reg-msg").html("Password didnt match");
      }
      else if(data=="email-err")
      {
        $("#reg-err").css("display","block");
        $("#reg-msg").html("Email already exists <strong>Click login</strong>");
      }
      else if(data=="pass-err")
      {
        $("#reg-err").css("display","block");
        $("#reg-msg").html("Password lenght should be atleast 5 character");
      }
      else
      {

        $("#reg-err").css("display","block");
        $("#reg-msg").html(data);
      }
    },
    error:function(){
      alert("NETWORK ERROR..");
    }
  })
  return false;
  e.preventDefault();
})
$("#login-form").submit(function(){
  var data=$(this).serialize();
  jQuery.ajax({
    url:"php/user-login.php",
    data:data,
    type:"POST",
    success:function(data){
      console.log(data);
      if(data=="done")
      {
        location.reload();
      }
      else if(data=="email-err"){
        $('#login-alert').css('display','block');
        $('#login-alert-text').html("The email doesnt exists Please register");
      }
      else if(data=="pass-err"){
        $('#login-alert').css('display','block');
        $('#login-alert-text').html("The Password doesn't matched <a href=\"password-reset.php\" target=_blank> Forgot Password? </a>");
      }
      else
      {
        $('#login-alert').css('display','block');
        $('#login-alert-text').html("Some unknown error occured.. Please report it");
      }
      
    },
    fail:function(){

    }
  })
  return false;
})
$("#logout-btn").click(function(){
  jQuery.ajax({
    url:"php/logout.php",   
    type:"POST",
    success:function(data){
      
        location.reload();
      
    },
    fail:function(){

    }
  })
})
  </script>