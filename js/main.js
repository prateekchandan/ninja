

$(".prev-btnp").click(function(){
	var max = ((colleges.length-colleges.length%12)/12)+1;
	if(page != 1){
		if (page == 2) $(".prev-btnp").addClass("btn-fail");
		if(page == max) $(".next-btnp").removeClass("btn-fail");
		page--;
		$("#college-container").html("");
		var str="";
		for (var i = (page-1)*12; i<min(page*12, colleges.length); i++) {
			if(csores[i]<csores[i-1]){
				var j=0;
                  while((i+j)%4!=0){
                    str+='<div class="college-box col-xs-3 empty-college-box"></div>';
                    j++;
                  }
                  str+="<hr class=\"col-md-12\"><div style=\"font-size:1.2em\"><b>Colleges with atleast one match</b></div>";
                  str+= colleges[i];
                }
                else
                  str+= colleges[i];
		}
		$("#college-container").append(str);
		if(colleges.length==0){
		        $("#college-container").html("<br><blockquote>The search which you requested is unavailable. Send us your query through feedback we will get to you with proper information. Or you may like to refine your searches to get better results</blockquote>");
		    }
	}
});

$(".next-btnp").click(function(){
	var max = ((colleges.length-colleges.length%12)/12)+1;

	if(page != max){
		if (page == 1) $(".prev-btnp").removeClass("btn-fail");
		if(page == (max-1)) $(".next-btnp").addClass("btn-fail");
		page++;
		$("#college-container").html("");
		var str="";
		for (var i = (page-1)*12; i<min(page*12, colleges.length); i++) {
			if(csores[i]<csores[i-1]){
                  var j=0;
                  while((i+j)%4!=0){
                    str+='<div class="college-box col-xs-3 empty-college-box"></div>';
                    j++;
                  }
                  str+="<hr class=\"col-md-12\"><div style=\"font-size:1.2em\"><b>Colleges with atleast one match</b></div>";
                  str+= colleges[i];
                }
                else
                  str+= colleges[i];
		}
		$("#college-container").append(str);
		if(colleges.length==0){
		        $("#college-container").html("<br><blockquote>The search which you requested is unavailable. Send us your query through feedback we will get to you with proper information. Or you may like to refine your searches to get better results</blockquote>");
		    }
	}
});


var compared=["","","",""];
function addtocompare(id){
	for (var i = compared.length - 1; i >= 0; i--) 
	{
		if(id==compared[i])
			return;
	}
	a=compared.shift();
	compared.push(id);
	for (var i = compared.length - 1; i >= 0; i--) 
	{
		if(compared[i]=="")
			continue;
		var am=$("#"+compared[i]+">div")[0];
		var name="<div class='cname'>"+am.childNodes[1].getAttribute('title')+'</div>';
		name+="<div class='ccity'>"+am.childNodes[2].innerHTML+'</div>';
		console.log(city);
		name+='<i style="position:absolute;right:10px;top:7px;z-index:5" class="fa fa-times removecomp" onClick="removefromcomp(this.id);"" id ="'+compared[i]+'"></i><input type="hidden" name="link'+i+'" value="'+compared[i]+'">'
		$("#compare"+(4-i)).html(name);
		$("#"+compared[i]).addClass("college-blur");
		$('#compare'+(4-i)).addClass('occupied-box');
			$('#compare'+(4-i)).removeClass('empty-box');
	}
	$("#"+a).removeClass("college-blur");
}

function removefromcomp(id){
	var temp = id;
	for(var i = compared.length-1; i >0;i--){
		if(temp == compared[i]){
			compared[i] = compared[i-1];
			temp = compared[i];
		}
	}
	compared[0] = "";
	for (var i = compared.length - 1; i >= 0; i--) 
	{
		if(compared[i]==""){
			$('#compare'+(4-i)).addClass('empty-box');
			$('#compare'+(4-i)).removeClass('occupied-box');
			var name = "Add College";
			name+='<i style="position:absolute;right:10px;top:7px;z-index:5;display:none" class="fa fa-times removecomp" onClick="removefromcomp(this.id);"" id ="'+compared[i]+'"></i><input type="hidden" name="link'+i+'" value="'+compared[i]+'">'
		}
		else {
			$('#compare'+(4-i)).addClass('occupied-box');
			$('#compare'+(4-i)).removeClass('empty-box');
			var am=$("#"+compared[i]+">div")[0];
			var name="<div class='cname'>"+am.childNodes[1].getAttribute('title')+'</div>';
			name+="<div class='ccity'>"+am.childNodes[2].innerHTML+'</div>';
			name+='<i style="position:absolute;right:10px;top:7px;z-index:5" class="fa fa-times removecomp" onClick="removefromcomp(this.id);"" id ="'+compared[i]+'"></i><input type="hidden" name="link'+i+'" value="'+compared[i]+'">'
		}
		
		$("#compare"+(4-i)).html(name);
		
	}
	$("#"+id).removeClass("college-blur");
}

$("#compare-form").submit(function(){
	var c=0;
	for (var i = compared.length - 1; i >= 0; i--) {
		if(compared[i]!="")
			c++;
	};
	if(c<2)
	{
		alert("Please select atleast two colleges to compare");
		return false;
	}
})
var current_filter=0;
function filteropen(n){
	current_filter=n;
	$("#back").toggle();
	$("#filter"+n).css("top",$("#filter-head"+n).position().top+50);
	if(n>5){
		$("#filter"+n).css("top",$("#filter-head"+n).position().top-parseInt($("#filter"+n).css("height"))+97);
	}
	for (var i = 1; i <= 10; i++) {
		if(i==n){
			$("#filter"+i).fadeToggle();
			$("#filter-head"+i).css("z-index","10010");
			//$("#sidef"+i).toggleClass('side-ticker-active');

		}
		else{
			$("#filter"+i).css("display","none");
			//$("#sidef"+i).removeClass('side-ticker-active');
			$("#filter-head"+i).css("z-index","100");
		}
	}
		
}
$("#location-state").change(function(){
	if($(this).val()!=''){
		$("#location-address").val("");
		$("#location-distance").val("0");
	}
})
$("#location-city").change(function(){
	if($(this).val()!=''){
		$("#location-address").val("");
		$("#location-distance").val("0");
	}
})
$("#location-address").keyup(function(){
	if($(this).val()!=''){
		$("#location-city").val("");
		$("#location-state").val("");
	}
})
$("#location-distance").blur(function(){
	if($(this).val()!=''){
		$("#location-city").val("");
		$("#location-state").val("");
	}
})

$("#change-view").click(function(){
	var val=$(this).html();
	if(val=="Map View"){
		$(this).html("Grid View");
		$(".second-bottom").css("display","none");		
		$("#college-container").css("display","none");
		$(".page-btn").css("display","none");
		$("#map-view").fadeToggle();	
		 google.maps.event.trigger(map, "resize");
    	map.setCenter(new google.maps.LatLng( 19.9204303,76.85674369));	
	}
	else if(val=="Grid View"){
		$(this).html("Map View");
		$("#map-view").css("display","none");
		$(".second-bottom").css("display","block");
		$("#college-container").fadeToggle();
		$("#.page-btn").fadeToggle();
	}

})

$(window).scroll(function() {
  return false;
});

/* Registration system */


$(".background").click(function(){
	filteropen(current_filter);
	$(".background").css("display","none");
})

$(".filter-box").css("left",($(".sidebar").width()+$(".sidebar").position().left+16)+"px");
$( window ).resize(function() {
  $(".filter-box").css("left",($(".sidebar").width()+$(".sidebar").position().left+16)+"px");
});