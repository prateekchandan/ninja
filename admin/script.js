$("#user-form").submit(function(){
	var uid=$("#uid").val(),password=$("#password").val(),name=$("#name").val(),check=1,message="";
	if(uid.length<=4)
	{
		$("#uid").css("background-color","rgba(250,0,0,0.1)");
		check=0;
		message+="<br> User-Id error : It should be atleast 5 character";
	}
	else
		$("#uid").css("background-color","rgba(250,0,0,0)");
	if(name.length<=2)
	{
		$("#name").css("background-color","rgba(250,0,0,0.1)");
		check=0;
		message+="<br> Name error : It should be atleast 3 character";
	}
	else
		$("#name").css("background-color","rgba(250,0,0,0)");
	if(password.length<=7)
	{
		$("#password").css("background-color","rgba(250,0,0,0.1)");
		message+="<br> Password error : It should be atleast 8 character";
		check=0;
	}
	else
		$("#password").css("background-color","rgba(250,0,0,0)");
	if(check==0){
		$("#message").html(message);
		return false;
	}
	$.ajax({
             type: "POST",
             url: "php/add.php",
             data:$("#user-form").serialize(),
             success: function(data)
             {
               if(data=="error")
               {
                $("#message").html("Error : There was some error in adding this user , May be try changing user id");
               }
               else
               {
                $("#message").html(data+" BINGO ! You just registered a new User "+name);
                $("#uid").val("");$("#password").val("");$("#name").val("");
                $("#email").val("");$("#phone").val("");
                $("#generator").click();
               }
             },
             error:function()
             {
              $("#message").html("Fatal Error : Couldn't find script or cant connect to server")
             }
           });
return false;
});
function deleteuser(a){
  $.ajax({
             type: "POST",
             url: "php/delete.php?uid="+a,
             success: function(data)
             {
               if(data=="error")
               {
                alert("user cant be deleted");
               }
               else
               {
                alert("User successfully deleted");
                location.reload();
               }
             },
             error:function()
             {
              alert("Network error");
             }
           });
}
function saveuser(a){
  var data={
                email:$("#"+a+"em").html(),
                phone:$("#"+a+"ph").html(),
                uid:a
             };
  $.ajax({
             type: "POST",
             url: "php/editdata.php?uid="+a,
             data:data,
             success: function(data)
             {
               if(data=="error")
               {
                alert("user cant be updated");
               }
               else
               {
               
               }
             },
             error:function()
             {
              alert("Network error");
             }
           });
}
