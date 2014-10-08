cur = 0;

            function exampleClickToEdit(area, b) {
                if(cur==area)
                {
                    return;
                }
                if(cur!=0)
                {
                    exampleClickToSave(cur);
                }
                cur = area;
                $('#' + area).redactor({
                    focus: true,
                    convertDivs: true,
                    deniedTags: ['h1','h2'],
                    //  allowedTags: ['p', 'h1', 'h2', 'pre','li','u','i','ul','ol','b']
                });
                $(".redactor_toolbar").css("height", "30px");
                setConfirmUnload(true);
            }

            function exampleClickToSave(area) {
                /* var html = $('#redactor_content').redactor('get');
                        alert(html);*/
                // destroy editor
                $('#' + area).redactor('destroy');
                var t=$('#'+area).html();
               
                cur = 0;
                var data={};
                data[area]=$("#"+area).html();
                $.post("php/savefile.php?cid="+cid,data)
                .done(function(data){
                    console.log(data);
                    console.log(area+" saved");
                }).fail(function(){
                    console.log("Network error");
                })
            }
            jQuery(function ($) {
                $('body').click(function (e) {
                    //alert(e.target.className==='redactor_toolbar');
                    var clickedOn = $(e.target);
                    //alert((e.target.id.trim()==cur.trim()+'-edit-btn') + "#"+e.target.id.trim()+"#"+cur.trim()+'-edit-button'+"#"  );
                    if (cur == 0 || clickedOn.parents().andSelf().is('.redactor_box') || clickedOn.parents().andSelf().is('#redactor_modal') || clickedOn.parents().andSelf().is('.redactor-link-tooltip') || e.target.id===cur+'-edit-btn') {} else if (clickedOn.parents().andSelf().is('#' + cur)) {} else {
                        exampleClickToSave(cur);
                    }
                });
            });
              function edittable(a,b){
                //a is the exam id and b is type i.e a wil be 1,2,3.. and b will be btech mtech .. 
                $.ajax({
                    url:"php/get-exams-for-branch.php?branch="+b,
                    type:"POST",
                    success:function(data){
                        console.log(data);
                        var inside="<h3>Change the Exam</h3><hr><select class=\"form-control\" id=\"new-exam\" name=\"new-exam\">";
                        var listofexam=JSON.parse(data);
                        for (var i =  1; i < listofexam.length; i++) {
                            inside+="<option value="+listofexam[i][1]+">"+listofexam[i][0]+"</option>";
                        };
                        inside+="</select><input type=\"hidden\" name=\"type\" value=\""+b+"\"><input type=\"hidden\" name=\"previous\" value=\""+$("#"+b+a+"-eid").val()+"\">";
                        inside+="<input type=\"hidden\" name=\"examnametype\" id=\"examnametype\" value=\""+b+"\"><input type=\"hidden\" name=\"examnameinmodal\" id=\"examnameinmodal\" value=\""+a+"\">";
                        inside+="<blockquote>If you cant find the exam please write in feedback or mil us at infermap@gmail.com</blockquote>"
                        $("#edit-tables-body").html(inside);
                        $("#edit-exam-name").modal('show');
                    }
                })
              }
              $("#save-table-col").click(function(){
                var a=$("#examnameinmodal").val(),b=$("#examnametype").val();
                var data=$("#edit-tables-body").serialize();
                 $.ajax({
                     url: 'php/change-exam-for.php?cid='+cid,  //Server script to process data
                     type: 'POST',
                     data:data,
                     success: function(data){
                        console.log(data);
                        if(data=="error")
                        {
                            alert("The exam you are trying to add already exists.. Please try  different one");
                        }
                        else{
                            $("#"+b+a+"-eid").val($("#new-exam").val());
                              $("#edit-exam-name").modal('hide');
                              $("#"+b+a+"TableData").html(data);
                              $("#"+b+a+"TableData").attr('id',b+$("#new-exam").val()+'TableData');
                            }

                        },
                        error: function(data){
                          console.log("error"); 
                          $("#edit-exam-name").modal('hide');
                        }
                     });
              });
            $(document).on('click', '#about_college', function (e) {
                //handler code here\
                exampleClickToEdit('about_college');
            });
            $("#about_college-edit-btn").click(function (e) {
                exampleClickToEdit('about_college');
            });
            $(document).on('click', '#dean_intro', function (e) {
                //handler code here\
                exampleClickToEdit('dean_intro');
            });
            $("#dean_intro-edit-btn").click(function (e) {
                exampleClickToEdit('dean_intro');
            });
            $(document).on('click', '#about_rules', function (e) {
                //handler code here\
                exampleClickToEdit('about_rules');
            });
            $("#about_rules-edit-btn").click(function (e) {
                exampleClickToEdit('about_rules');
            });
            $(document).on('click', '#adm_eligibility', function (e) {
                //handler code here\
                exampleClickToEdit('adm_eligibility');
            });
            $("#adm_eligibility-edit-btn").click(function (e) {
                exampleClickToEdit('adm_eligibility');
            });
            $(document).on('click', '#adm_info', function (e) {
                //handler code here\
                exampleClickToEdit('adm_info');
            });
            $("#adm_info-edit-btn").click(function (e) {
                exampleClickToEdit('adm_info');
            });
            $(document).on('click', '#adm_misc', function (e) {
                //handler code here\
                exampleClickToEdit('adm_misc');
            });
            $("#adm_misc-edit-btn").click(function (e) {
                exampleClickToEdit('adm_misc');
            });
            $(document).on('click', '#acad_info', function (e) {
                //handler code here\
                exampleClickToEdit('acad_info');
            });
            $("#acad_info-edit-btn").click(function (e) {
                exampleClickToEdit('acad_info');
            });
            $(document).on('click', '#acad_facility', function (e) {
                //handler code here\
                exampleClickToEdit('acad_facility');
            });
            $("#acad_facility-edit-btn").click(function (e) {
                exampleClickToEdit('acad_facility');
            });
            $(document).on('click', '#acad_courses', function (e) {
                //handler code here\
                exampleClickToEdit('acad_courses');
            });
            $("#acad_courses-edit-btn").click(function (e) {
                exampleClickToEdit('acad_courses');
            });
            $(document).on('click', '#acad_misc', function (e) {
                //handler code here\
                exampleClickToEdit('acad_misc');
            });
            $("#acad_misc-edit-btn").click(function (e) {
                exampleClickToEdit('acad_misc');
            });
            $(document).on('click', '#fee_scholarships', function (e) {
                //handler code here\
                exampleClickToEdit('fee_scholarships');
            });
            $("#fee_scholarships-edit-btn").click(function (e) {
                exampleClickToEdit('fee_scholarships');
            });
            $(document).on('click', '#fee_benefits', function (e) {
                //handler code here\
                exampleClickToEdit('fee_benefits');
            });
            $("#fee_benefits-edit-btn").click(function (e) {
                exampleClickToEdit('fee_benefits');
            });
            $(document).on('click', '#fee_caution', function (e) {
                //handler code here\
                exampleClickToEdit('fee_caution');
            });
            $("#fee_caution-edit-btn").click(function (e) {
                exampleClickToEdit('fee_caution');
            });
            $(document).on('click', '#fee_misc', function (e) {
                //handler code here\
                exampleClickToEdit('fee_misc');
            });
            $("#fee_misc-edit-btn").click(function (e) {
                exampleClickToEdit('fee_misc');
            });

             $(document).on('click', '#placement_info', function (e) {
                //handler code here\
                exampleClickToEdit('placement_info');
            });
            $("#placement_info-edit-btn").click(function (e) {
                exampleClickToEdit('placement_info');
            });
              $(document).on('click', '#placement_contact', function (e) {
                //handler code here\
                exampleClickToEdit('placement_contact');
            });
            $("#placement_contact-edit-btn").click(function (e) {
                exampleClickToEdit('placement_contact');
            });

             $(document).on('click', '#extra_cocurricular', function (e) {
                //handler code here\
                exampleClickToEdit('extra_cocurricular');
            });
            $("#extra_cocurricular-edit-btn").click(function (e) {
                exampleClickToEdit('extra_cocurricular');
            });

             $(document).on('click', '#hostel_facilities', function (e) {
                //handler code here\
                exampleClickToEdit('hostel_facilities');
            });
            $("#hostel_facilities-edit-btn").click(function (e) {
                exampleClickToEdit('hostel_facilities');
            });

             $(document).on('click', '#sports_facilities', function (e) {
                //handler code here\
                exampleClickToEdit('sports_facilities');
            });
            $("#sports_facilities-edit-btn").click(function (e) {
                exampleClickToEdit('sports_facilities');
            });

             $(document).on('click', '#misc_facilities', function (e) {
                //handler code here\
                exampleClickToEdit('misc_facilities');
            });
            $("#misc_facilities-edit-btn").click(function (e) {
                exampleClickToEdit('misc_facilities');
            });
            $(document).on('click', '#contact_info', function (e) {
                //handler code here\
                exampleClickToEdit('contact_info');
            });
            $("#contact_info-edit-btn").click(function (e) {
                exampleClickToEdit('contact_info');
            });



            /* Button Assignment for Table edit buttons  */
               
                $("#fee-table-edit-btn").click(function(e){
                    //alert("ok");
                    editTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable', ['Course','Category', 'Tution Fee','Miscellanous fee','Mess and Hostel fee','Total','Refundable Fee'],0,0);
                });
                $("#fee-table-save-btn").click(function(e){
                    saveTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable',0,0);
                });
                $("#fee-table-cancel-btn").click(function(e){
                    cancelTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable',0,0);
                });

            


                $(".redactor_editor").on("click",function(event){
                    event.preventDefault();
                })
                var cid=$("#cid").val();
                $("#college-logo").mouseenter(function(){
                    $('#edit-logo-text').css('display','block');
                });
                $("#college-logo").mouseout(function(){
                    $('#edit-logo-text').css('display','none');
                });
                $("#college-logo").click(function(e){
                $("#logo-uploader").click();
                });
                $("#logo-uploader").on("change",function(e){
                    var filename=$("#logo-uploader").prop("files")[0].name;
                    var name=filename.split('.').pop();
                    var filesize=$("#logo-uploader").prop("files")[0].size;
                    if(name=='jpg'||name=='jpeg'||name=='png'||name=='gif'||name=='icon'||name=='jfif'||name=='JPG')
                    {
                        if(filesize>1024*1024)
                        {
                            alert("File size exeeds max of 1MB its of size :"+parseInt(filesize/1024)+"kb");
                        }
                        else
                        {
                             var formData = new FormData($('form')[1]);
                                $.ajax({
                                    url: 'php/logo-upload.php?cid='+cid,  //Server script to process data
                                    type: 'POST',
                                    data:$("#logo-up").serialize(),
                                    //Ajax events
                                    success: function(data){
                                     $("#college-logo").attr('src','data/'+cid+'/logo.png');
                                    },
                                    error: function(data){
                                        alert("error");},
                                    // Form data
                                    data: formData,
                                    //Options to tell jQuery not to process data or worry about content-type.
                                    cache: false,
                                    contentType: false,
                                    processData: false
                                });
                        }
                    }
                    else
                    {
                        alert("Bad File type "+name);
                    }
                });

            /*   End of table edits*/

             $("#img-edit-btn").on("click",function(e){
                    if($(".img-edit").hasClass('pullDown'))
                    {
                        $(".img-edit").removeClass('pullDown');
                        $(".img-edit").addClass('rollUp');
                        $(".img-edit").css('display','none');
                        $(this).html("Edit Gallery");
                        refresh_gallery();
                    }
                    else
                    {
                        $(".img-edit").removeClass('rollUp');
                        $(".img-edit").css('display','block');
                        $(".img-edit").addClass('pullDown');
                        $(this).html("Finish Edit");
                    }
                    if($(".img-caption-edit").hasClass('pullDown'))
                    {
                        $(".img-caption-edit").removeClass('pullDown');
                        $(".img-caption-edit").addClass('rollUp');
                        $(".img-caption-edit").css('display','none');
                        $("#img-caption-edit-btn").html("Edit Captions");
                        put_caption()
                    }
                    if($(".img-delete").hasClass('pullDown'))
                    {
                        $(".img-delete").removeClass('pullDown');
                        $(".img-delete").addClass('rollUp');
                        $(".img-delete").css('display','none');
                         refresh_gallery();
                    }

                });

                $("#img-caption-edit-btn").on("click",function(e){
                    if($(".img-caption-edit").hasClass('pullDown'))
                    {
                        $(".img-caption-edit").removeClass('pullDown');
                        $(".img-caption-edit").addClass('rollUp');
                        $(".img-caption-edit").css('display','none');
                        $(this).html("Edit Captions");
                        put_caption()
                    }
                    else
                    {
                        $(".img-caption-edit").removeClass('rollUp');
                        $(".img-caption-edit").css('display','block');
                        $(".img-caption-edit").addClass('pullDown');
                        $(this).html("Submit Captions");
                        get_caption();
                    }
                    if($(".img-edit").hasClass('pullDown'))
                    {
                        $(".img-edit").removeClass('pullDown');
                        $(".img-edit").addClass('rollUp');
                        $(".img-edit").css('display','none');
                        $("#img-edit-btn").html("Edit Gallery");
                        refresh_gallery();
                    }
                    if($(".img-delete").hasClass('pullDown'))
                    {
                        $(".img-delete").removeClass('pullDown');
                        $(".img-delete").addClass('rollUp');
                        $(".img-delete").css('display','none');
                         refresh_gallery();
                    }
                });
          $("#img-delete-btn").on("click",function(e){
             if($(".img-delete").hasClass('pullDown'))
                    {
                        $(".img-delete").removeClass('pullDown');
                        $(".img-delete").addClass('rollUp');
                        $(".img-delete").css('display','none');
                         refresh_gallery();
                    }
                    else
                    {
                        $(".img-delete").removeClass('rollUp');
                        $(".img-delete").css('display','block');
                        $(".img-delete").addClass('pullDown');
                        setimgdelete();
                    }
                     if($(".img-edit").hasClass('pullDown'))
                    {
                        $(".img-edit").removeClass('pullDown');
                        $(".img-edit").addClass('rollUp');
                        $(".img-edit").css('display','none');
                        $("#img-edit-btn").html("Edit Gallery");
                        refresh_gallery();
                    }
                     if($(".img-caption-edit").hasClass('pullDown'))
                    {
                        $(".img-caption-edit").removeClass('pullDown');
                        $(".img-caption-edit").addClass('rollUp');
                        $(".img-caption-edit").css('display','none');
                        $("#img-caption-edit-btn").html("Edit Captions");
                        put_caption()
                    }
          })

        function refresh_links(cid)
        {
            jQuery.ajax({
                        url: "php/fetch_links.php?cid="+cid,
                        type:"GET",
                        success:function(data)
                        {
                            var links=JSON.parse(data);
                            var link=['weblink','fblink','twitterlink','pluslink','linkedlink'];
                            for (var i = link.length - 1; i >= 0; i--) {
                                if(links[i])
                                {
                                    document.getElementById(link[i]).value=links[i];
                                    if(links[i].substr(0,4)!="http"&&links[i].substr(0,3)!="ftp")
                                        links[i]="http://"+links[i];
                                    document.getElementById(link[i]+'a').href=links[i];
                                    document.getElementById(link[i]+'a').target="_blank";
                                }
                                else
                                {
                                     document.getElementById(link[i]+'a').href="#";
                                     document.getElementById(link[i]+'a').target="";
                                 }
                                 if(i==0){
                                    if(links[i])
                                    {
                                        document.getElementById(link[i]).value=links[i];
                                        if(links[i].substr(0,4)!="http"&&links[i].substr(0,3)!="ftp")
                                            links[i]="http://"+links[i];
                                        document.getElementById('college-website').href=links[i];
                                        document.getElementById('college-website').target="_blank";
                                        document.getElementById('college-website').innerHTML=links[i];
                                    }
                                    else
                                    {
                                         document.getElementById('college-website').href="#";
                                         document.getElementById('college-website').target="";
                                         document.getElementById('college-website').innerHTML="Click button to add website";
                                     }
                                 }
                            };

                        },
                        error:function(data)
                        {
                            alert(data);
                        }
                    })
        }
function deleteimg(a){
   jQuery.ajax({
                        url: "php/deleteimg.php?cid="+cid,
                        type:"GET",
                        data : "img="+a,
                        success:function(data)
                        {
                            if(data=="success")
                            {
                                setimgdelete();
                            }
                            else
                            {
                                alert(data);
                            }
                        },
                        error:function(data)
                        {
                           // alert(data);
                        }
                    })

}
function load(x,y) {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
      //  map.addControl(new GSmallMapControl());
       // map.addControl(new GMapTypeControl());
        var center = new GLatLng(x,y);
        map.setCenter(center, 15);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: true});  
        map.addOverlay(marker);
        document.getElementById("lat").innerHTML = center.lat().toFixed(5);
        document.getElementById("lng").innerHTML = center.lng().toFixed(5);

      GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
          map.panTo(point);
       document.getElementById("lat").innerHTML = point.lat().toFixed(5);
       document.getElementById("lng").innerHTML = point.lng().toFixed(5);

        });


    /* GEvent.addListener(map, "moveend", function() {
          map.clearOverlays();
    var center = map.getCenter();
          var marker = new GMarker(center, {draggable: true});
          map.addOverlay(marker);
          document.getElementById("lat").innerHTML = center.lat().toFixed(5);
       document.getElementById("lng").innerHTML = center.lng().toFixed(5);
 
        });*/

     GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
         map.panTo(point);
      document.getElementById("lat").innerHTML = point.lat().toFixed(5);
         document.getElementById("lng").innerHTML = point.lng().toFixed(5);

        });

      }
    }

       function showAddress(address) {
       var map = new GMap2(document.getElementById("map"));
     //  map.addControl(new GSmallMapControl());
     //  map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
          document.getElementById("lat").innerHTML = point.lat().toFixed(5);
       document.getElementById("lng").innerHTML = point.lng().toFixed(5);
         map.clearOverlays()
            map.setCenter(point, 14);
   var marker = new GMarker(point, {draggable: true});  
         map.addOverlay(marker);

        GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
         map.panTo(pt);
      document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
         document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });


     GEvent.addListener(map, "moveend", function() {
    /*      map.clearOverlays();
    var center = map.getCenter();
          var marker = new GMarker(center, {draggable: true});
          map.addOverlay(marker);
          document.getElementById("lat").innerHTML = center.lat().toFixed(5);
       document.getElementById("lng").innerHTML = center.lng().toFixed(5);
*/
     GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
        map.panTo(pt);
    document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
       document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
        });
 
        });

            }
          }
        );
      }
    }
    function addtable(a)
    {
        $("#add-dept-title").html(a+" exam addition");
        $("#add-dept").modal('show');
        var dept;
         $.ajax({
             url: 'php/get-exams-for-branch.php?branch='+a,  //Server script to process data
             type: 'POST',
             success: function(data){
                var exam="",dept=JSON.parse(data);
                for (var i = 1; i <= dept.length - 1; i++) {
                    exam+="<option value="+dept[i][1]+">"+dept[i][0]+"</option>";
               };
                var html='<h4>'+a+'</h4><input type="hidden" id="new-type" name="type" value="'+a+'">';
                html+='<select class="form-control" id="'+a+'-new-exam-name" name="'+a+'-new-exam-name">'+exam+'</select>';
                
                $("#add-dept-body").html(html);
            },
            error: function(data){
               $("#add-dept-body").html("Connection error");
            }
         });
         
        
    }
function addnewexam(stream)
  {
    var exam_name=$("#"+stream+"-new-new-exam").val();
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
                           
                          })
      $("#"+stream+"-exam-name").append('<option>'+$("#"+stream+"-new-new-exam").val()+'</option>');
       $("#"+stream+"-new-exam-name").append('<option>'+$("#"+stream+"-new-new-exam").val()+'</option>');
       return false;
    }
    return false;
  }
  function addnewexamfor(stream,id)
  {
    var exam_name=$("#"+id+"-examadd").val();
    var c=confirm("Are you sure want to add "+exam_name+" for "+stream+" stream ?");
    if(c==true)
    {
      $.post("php/add_new_exam.php",{

                            stream_name:stream,
                             stream_exam:exam_name,
                            
                        })
                        .done(function(data) {
                            if(data!="error")
                            $("."+stream+"-examselect").append('<option value="'+data+'">'+$("#"+id+"-examadd").val()+'</option>');
                          })
                          .fail(function(data) {
                           
                          })
      
    
       return false;
    }
    return false;
  }
  $("#save-new-exam").click(function(){
    if($("#dead-test").val()==0)
    {
        $("#add-dept").modal('hide');
        return false;
    }
     $.ajax({
             url: 'php/add-new-exam.php?cid='+cid,  //Server script to process data
             type: 'POST',
             data:$("#add-dept-body").serialize(),
             success: function(data){
               if(data=="error")
               {
                alert("New Exam couldn't be added as it already exists");
                return false;
               }
               else{
                var type=$("#new-type").val();
	               $("#add-dept-body").html("<input type=\"hidden\" id=\"dead-test\" value=\"0\">");
	              $("#"+type+"-tables").append(data);
	               $("#add-dept-body").append("Your table has been added..");
            }
              
            },
            error: function(data){
               alert("Network error");
            }
         });
  });
  $("#add-dept-body").submit(function(){return false});
  window.onbeforeunload = "Are you sure you want to leave?";
  function setConfirmUnload(on) {
    
     window.onbeforeunload = (on) ? unloadMessage : null;

}

function unloadMessage() {
    
     return 'You have entered new data on this page.' +
        ' If you navigate away from this page without' +           
        ' first saving your data, the changes will be' +
        ' lost.';

}
 function setnotification(){
    var notices=["The image gallery is modified. Try to put HD Images for the colleges in the ratio as of the image Gallery","Noe you just need to chose the exam for a program and categories will automatically come. If you find any problem write us a feedback"];
    if(notices.length == 0){
        $(notificationspot).html("<br>No new notification");
    }
    else{
        $('#notificationsbadge').html(notices.length);
        $('#notificationsbadge').css('display','');
        var innerstring = '<strong style="line-height:50px;">Notifications</strong>';// <i style="float:right;top:10px;right:10px;" onclick="togglenotifications()" class="fa fa-times">';
        for(var i = 0; i < notices.length; i++){
            innerstring = innerstring + '<div class="onenotification">' + notices[i] + '</div>';
        }
        $(notificationspot).html(innerstring);
    }
  }
  setnotification();
  var notificationshown = false;
  function togglenotifications(){
    $('#notificationsbadge').css('display','none');
    if(notificationshown == false){
        notificationshown = true;
        var pos = $('#notifications').position();
        
        if(pos.left > 250){
            $('#notificationspot').css('left', pos.left-250);
            $('#notificationspot').css('top', pos.top+60);
        }
        else{
            $('#notificationspot').css('left', pos.left+ 50);
            $('#notificationspot').css('top', pos.top);
        }
        $('#notificationspot').css('display', 'block');
         
    }
    else if(notificationshown){
        notificationshown = false;
        $('#notificationspot').css('display', 'none');
    }
  }

  window.onresize = function(){
    if(notificationshown){
        var pos = $('#notifications').position();
        if(pos.left > 250){
            $('#notificationspot').css('left', pos.left-250);
            $('#notificationspot').css('top', pos.top+60);
        }
        else{
            $('#notificationspot').css('left', pos.left+ 50);
            $('#notificationspot').css('top', pos.top);
        }
        $('#notificationspot').css('display', 'block');
    }
  }
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
    if($("#feedback-subject").val()==""){
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
    if(k==1)
        return false;
    $.ajax({
        url:"php/send-feedback.php",
        type:"POST",
        data:$("#feedback-form").serialize(),
        success:function(data){
            togglefeedback();
            $("#feedback-subject").val("");
            $("#feedback-email").val("");
            $("#feedback-msg").val("");
            alert("Feedback Sent");
        },
        failure:function(){
            alert("Failed to send feedback\n Network error");
        }
    });
    return false;
  });
  function saveTheTableData(a,b){
  	  $.post("php/save-closingrank-table.php?cid="+cid,{
                            closing_year:$("#"+a+"-closing-year").val(),
                            closing_rank_tab: JSON.stringify(tableToJson(document.getElementById(a+"-closing-rank-table"))),
                            exam:$("#"+a+"-eid").val(),
                            name:$("#"+a+"-eid").val(),
                            type:$("#"+a+"-type").val(),
                        })
                        .done(function(data) {
                            console.log(data);
                        	if(data=="error")
                          alert("Oops ! There seems to be some problem with the exam name..");
                          $("#"+a+"-eid").val($("#"+a+"-exam-name").val());
                          })
                          .fail(function(data) {
                             $("body").css("overflow","auto");
                            $("#waiting").css("display","none");
                            alert("Network error... Failed to save");
                          })
  }
  $("#program-add").click(function(){
    $.ajax({
        url:"php/add-program.php",
        method:"POST",
        data:$("#add-program-body").serialize(),
        success:function(data){
            if(data=="ok")
            {
                location.reload();
                $("#add-program-body").html("Reload page now..");
            }
            else
            $("#add-program-body").html("Error in Adding Program");
        },
        error:function(data){
            $("#add-program-body").html("NETWORK Error");
        }
    });
  });