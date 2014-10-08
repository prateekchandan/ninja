$("#keyword-img").mouseover(function() {
	$("#keyword-point").css("display","block");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	$("#search-content").html("<div class=\"color-text\"><b>Have an<br> idea what to look for?</b></div><!--b>Search Here</b><br-->The one search engine to find any college across the country.<br>Our vast database makes sure you bag the best seat.");
	$(this).click();
})

$("#keyword-img").click(function() {
	$("#keyword-point").css("display","block");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	$("#search-content").html("<br><div class=\"color-text\">Start by typing a college name or city or state</div><form class=\"form\" method='post' action=\"main.php\"><input class=\"form-control\" required name='value' type='text' placeholder='eg: IIT Mumbai'><input type='hidden' name='search' value='keyword'><button class='btn btn-success' >GO</button></form>");
})
$("#keyword-imgph").click(function() {
	$(".ask-box").html("<br><div class=\"color-text\">Start by typing a college name or city or state</div><form class=\"form\" method='post' action=\"main.php\"><input class=\"form-control\" required name='value' type='text' placeholder='eg: IIT Mumbai'><input type='hidden' name='search' value='keyword'><button class='btn btn-success' >GO</button></form>");
});
var rankch=function(){
	var t=document.getElementById('rank');
	t.value=t.value.replace(/[^0-9\.]/g,'');
}

$("#keyword-img").click();
$("#rank-img").click(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","block");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	var str="<div class=\"color-text\" title=\"Search by exam\">Exam finder</div><input type='hidden' name='search' value='rank'><input type='hidden' name='exam-weight' value='2'>";
	str+= "<select class='form-control' style='margin-top:5px' name='exam' id='exam-select'>";
	for (key in exams){
		str+='<option value="'+key+'">'+exams[key][0]+'</option>';
	}
	str+="</select>";
	str+="<input type='number' class='form-control' onkeyup='rankch()' onchange='rankch()' style='margin-top:5px' name='rank' id='rank' placeholder='Your Rank'>";
	str+="<select class='form-control' name='category' style='margin-top:5px' id='exam-category'>";
	str+="</select>";
	str+="<button class='btn btn-success' style='margin-top:3px'>GO</button>";
	$("#search-content").html(str);
	function setcat() {
		if($("#exam-select").val()==''){
			$("#exam-category").html("<option value=''>Select Category</option>");
			return;
		}
		var depts=exams[$("#exam-select").val()][1];
		var str2="<option value=''>Select Category</option>";
		for (var i = 0; i < depts.length; i++) {
                     str2+="<option value='"+depts[i]+"'>"+categories[depts[i]]+' ('+depts[i]+')'+"</option>";
		};
		$("#exam-category").html(str2);
	}
		setcat();
	$("#exam-select").change(setcat);
})
$("#rank-imgph").click(function() {
	var str="<div class=\"color-text\" title=\"Search by exam\">Exam finder</div><input type='hidden' name='search' value='rank'><input type='hidden' name='exam-weight' value='2'>";
	str+= "<select class='form-control' style='margin-top:5px' name='exam' id='exam-select'>";
	for (key in exams){
		str+='<option value="'+key+'">'+exams[key][0]+'</option>';
	}
	str+="</select>";
	str+="<input type='number' class='form-control' onkeyup='rankch()' onchange='rankch()' style='margin-top:5px' name='rank' id='rank' placeholder='Your Rank'>";
	str+="<select class='form-control' name='category' style='margin-top:5px' id='exam-category'>";
	str+="</select>";
	str+="<button class='btn btn-success' style='margin-top:3px'>GO</button>";
	$(".ask-box").html(str);
	function setcat() {
		if($("#exam-select").val()==''){
			$("#exam-category").html("<option value=''>Select Category</option>");
			return;
		}
		var depts=exams[$("#exam-select").val()][1];
		var str2="<option value=''>Select Category</option>";
		for (var i = 0; i < depts.length; i++) {
                     str2+="<option value='"+depts[i]+"'>"+categories[depts[i]]+' ('+depts[i]+')'+"</option>";
		};
		$("#exam-category").html(str2);
	}
		setcat();
	$("#exam-select").change(setcat);
})
$("#rank-img").mouseover(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","block");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	$("#search-content").html("<div class=\"color-text\"><b>Gave an exam <br>recently?</b></div>Have no idea which colleges it can fetch you or confused with the options at hand?Just enter your expected rank and leave the rest to us.");
	$(this).click();
})
$("#depart-img").click(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","block");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	var str="<br><div class=\"color-text\">Pick a department:</div><br>";
	str+="<select data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Select a department\" class=\"form-control\" id=\"dept\" name='department'><option value=''>Select Department</option>";
	for (key in departments){
		str+="<option value='"+key+"'>"+departments[key]+"</option>";
	}
	str+="</select>";
	str+="<input type='hidden' name='search' value='dept'><input type='hidden' name='department-weight' value='2'><button class='btn btn-success' >GO</button>";
	$("#search-content").html(str);
})
$("#depart-imgph").click(function() {
	var str="<br><div class=\"color-text\">Pick a department:</div>";
	str+="<select data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Select a department\" class=\"form-control\" id=\"dept\" name='department'><option value=''>Select Department</option>";
	for (key in departments){
		str+="<option value='"+key+"'>"+departments[key]+"</option>";
	}
	str+="</select>";
	str+="<input type='hidden' name='search' value='dept'><input type='hidden' name='department-weight' value='2'><button class='btn btn-success' >GO</button>";
	$(".ask-box").html(str);
})
$("#depart-img").mouseover(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","block");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","none");
	$("#search-content").html("<div class=\"color-text\"><b>Have a <br>stream in mind?</b></div><br>Just select a department and get the best colleges offering the course of your choice(s).");
	$(this).click();
})
$("#stepbystep-img").hover(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","block");
	$("#location-point").css("display","none");
	$("#search-content").html("<div class=\"color-text\"><b>Confused ? <br> Grab our hand.</b></div><br>Use our interactive guide to plan your college search. A series of simple questions to find your best match.");
})
$("#location-img").mouseover(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","block");
	$("#search-content").html("<div class=\"color-text\"><b>Is location <br>that important?</b></div> We get you the best colleges depending on location. Just choose how far away or close to home you desire it");
	$(this).click();
})
$("#location-img").click(function() {
	$("#keyword-point").css("display","none");
	$("#rank-point").css("display","none");
	$("#depart-point").css("display","none");
	$("#stepbystep-point").css("display","none");
	$("#location-point").css("display","block");
	var str="<div class=\"color-text\">Search by<br>location</div><input type='hidden' name='location-weight' value='2'><input type='hidden' name='search' value='location'>";
	str+= "<select class='form-control' name='state' id='state'><option value=''>Select state</option>";
	for (key in states){
		str+='<option>'+key+'</option>';
	}
	str+="</select>";
	str+="<select class='form-control' name='city' id='statecity'>";
	str+="</select>";
	str+="<button class='btn btn-success'>GO</button>";
	$("#search-content").html(str);
	function setcity() {
		if($("#state").val()==''){
			$("#statecity").html("<option value=''>Select city</option>");
			return;
		}
		var depts=states[$("#state").val()];
		var str2="<option value=''>Select city</option>";
		for (var i = 0; i < depts.length; i++) {
			str2+="<option>"+depts[i]+"</option>";
		};
		$("#statecity").html(str2);
	}
		setcity();
	$("#state").change(setcity);
})

$("#location-imgph").click(function() {
	var str="<div class=\"color-text\">Search by location</div><input type='hidden' name='location-weight' value='2'><input type='hidden' name='search' value='location'>";
	str+= "<select class='form-control' name='state' id='state'><option value=''>Select state</option>";
	for (key in states){
		str+='<option>'+key+'</option>';
	}
	str+="</select>";
	str+="<select class='form-control' name='city' id='statecity'>";
	str+="</select>";
	str+="<button class='btn btn-success'>GO</button>";
	$(".ask-box").html(str);
	function setcity() {
		if($("#state").val()==''){
			$("#statecity").html("<option value=''>Select city</option>");
			return;
		}
		var depts=states[$("#state").val()];
		var str2="<option value=''>Select city</option>";
		for (var i = 0; i < depts.length; i++) {
			str2+="<option>"+depts[i]+"</option>";
		};
		$("#statecity").html(str2);
	}
		setcity();
	$("#state").change(setcity);
})
$( "body" ).mousemove(function( event ) {
  var x=event.clientX,y=event.clientY;
  var xx=$(window).width(),yy=$(window).height();
  var pos1x=xx*0.53-(((xx*0.53-x)/xx)*30);
  $("#boy3-img").css("left",pos1x+"px");
  var pos2x=(((xx*0.61-x)/xx)*60)+xx*0.61;
  $("#boy2-img").css("left",pos2x+"px");
  pos2x=(((xx*0.5-x)/xx)*40)+xx*0.5;
  $("#boy-img").css("left",pos2x+"px");

});


$('img').on('dragstart', function(event) { event.preventDefault(); });
$('img').addClass("unselectable");

$(".faicon").hover(function() {
   
});

$(".faicon").mouseout(function() {
   
});
var feedbackval=1;
$("#feedback-img").click(function(){
	$(".feedback-back").css("display","block");
	$(".feedback-box").addClass("fadeIn");
})
$("#feedback-close").click(function(){
	$(".feedback-box").removeClass("fadeIn");
	$(".feedback-box").fadeOut("slow",function(){
		$(".feedback-inner"+feedbackval).css("display","none");
		feedbackval=1;
		$(".feedback-inner"+feedbackval).css("display","block");
		$(".feedback-back").css("display","none");
		$(".feedback-box").css("display","block");
	});	
})
$("#feedback-left").click(function(){
	if(feedbackval==1)
		return;
	$(".feedback-inner"+feedbackval).css("display","none");
	feedbackval--;
	$(".feedback-inner"+feedbackval).css("display","block");
})
$("#feedback-right").click(function(){
	if(feedbackval==4)
		return;
	$(".feedback-inner"+feedbackval).css("display","none");
	feedbackval++;
	$(".feedback-inner"+feedbackval).css("display","block");
})
$("#yes-btn").click(function(){
	var a=parseInt($("#feedback-slider").val());
	$("#feedback-slider").val(a+1);
})
$("#no-btn").click(function(){
	var a=$("#feedback-slider").val();
	$("#feedback-slider").val(a-1);
})
function feedbackdifficulty(i){
	var a=$("#feed-difficulty").val();
	if(a!=0)
	{
		$("#feed-diff"+a).removeClass("round-selector-selected");
		$("#feed-diff"+a).addClass("round-selector");
	}
	$("#feed-diff"+i).removeClass("round-selector");
		$("#feed-diff"+i).addClass("round-selector-selected");
		$("#feed-difficulty").val(i);

}
function feedbackNews(i){
	var a=$("#q2inputhidden").val();
	if(a=="Ad"||a!="College"&&a||"Friends")
	{
		$("#feed-"+a).removeClass("round-selector-selected");
		$("#feed-"+a).addClass("round-selector");
	}
	$("#feed-"+i).removeClass("round-selector");
		$("#feed-"+i).addClass("round-selector-selected");
		if(i=="Ad")
			$("#q2input").val("Social - Media");
		else
		$("#q2input").val(i);
		$("#q2inputhidden").val(i);

}

//REGISTER EVENTS
$("#login-img").click(function(){
	$(".register-back").css("display","block");
	$(".register-box").addClass("fadeIn");
})
$("#register-close").click(function(){
	$(".register-box").removeClass("fadeIn");
	$(".register-box").fadeOut("fast",function(){
		$(".register-back").css("display","none");
		$(".register-box").css("display","block");
	});	
})
function pageview(){
	var w=$("#search-box").css('width'),h=parseInt($("#search-box").css('height'));
	var w1=parseInt(w)-60,h1=(h*0.6);
	$("#search-content").css('left',parseInt($("#search-box").css('left'))+30+"px");
	$("#search-content").css('top',parseInt($("#search-box").css('top'))+50+"px");
	$("#search-content").css('height',h1+"px");
	$("#search-content").css('width',w1+"px");
	
}
$("#search-box").load(function(e){
	pageview();
})
$(window).resize(function(e){
	pageview();
});
pageview();

$("#register-portal").submit(function(e){
	var data=$("#register-portal").serialize();
	jQuery.ajax({
		url:"php/register.php",
		data:data,
		type:"POST",
		success:function(data){
			if(data=="done")
			{
				$("#register-portal")[0].reset();
				alert("You have been successfully registered");
			}
		},
		error:function(){
			alert("NETWORK ERROR..");
		}
	})
	e.preventDefault();
})

$("#feedback-portal").submit(function(e){
	var data=$("#feedback-portal").serialize();
	jQuery.ajax({
		url:"php/feedback.php",
		data:data,
		type:"POST",
		success:function(data){
			if(data=="done")
			{
				$("#feedback-portal")[0].reset();
				alert("Feedback Sent .. We are Pleased to recieve feedback..");
				$("#feedback-close").click();
				var a=['Ad','Friends','College'];
				for (var i = 1; i <= 3; i++) {
					$("#feed-diff"+i).removeClass("round-selector-selected");
					$("#feed-diff"+i).addClass("round-selector");
					$("#feed-"+a[i]).removeClass("round-selector-selected");
					$("#feed-"+a[i]).addClass("round-selector");
				}
			}
			$("#feedback-portal")[0].reset();
			$("#feed-diff"+i).removeClass("round-selector-selected");
			$("#feed-diff"+i).addClass("round-selector");
			$("#feed-"+a[i]).removeClass("round-selector-selected");
			$("#feed-"+a[i]).addClass("round-selector");
		},
		error:function(e){
			alert("Oops... It seems a network error");
			e.preventDefault();
		}
	})

	e.preventDefault();
})
$("#talktous").submit(function(e){
	var data=$("#talktous").serialize();
	jQuery.ajax({
		url:"php/talktous.php",
		data:data,
		type:"POST",
		success:function(data){
			if(data=="done")
			{
				$("#talktous")[0].reset();
				alert("Your response is recorded.. We will be contacting soon to you..");
			}
		},
		error:function(){
			alert("Network error...");
		}
	})
	e.preventDefault();
})

$(".feedback-back").click(function(e){
	if(e.target.className=='feedback-back'){
		$("#feedback-close").click();
	}
})
$(".register-back").click(function(e){
	if(e.target.className=='register-back'){
		$("#register-close").click();
	}
})


/**** checks on form   */
$("#search-content").submit(function(){
	if($("#dept").val()==0)
	{
		alert("Please select a department");
		return false;
	}

	if($("#state").val()==0)
	{
		alert("Please select a state");
		return false;
	}
})
