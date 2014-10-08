    cur = 0;

    function exampleClickToEdit(area, b) {
        if (cur == area) {
            return;
        }
        if (cur != 0) {
            exampleClickToSave(cur);
        }
        cur = area;
        $('#' + area).redactor({
            focus: true,
            convertDivs: true,
            deniedTags: ['h1', 'h2'],
            //  allowedTags: ['p', 'h1', 'h2', 'pre','li','u','i','ul','ol','b']
        });
        $(".redactor_toolbar").css("height", "30px");
    }

    function exampleClickToSave(area) {
        /* var html = $('#redactor_content').redactor('get');
                        alert(html);*/
        // destroy editor
        $('#' + area).redactor('destroy');
        var t = $('#' + area).html();

        cur = 0;
        var data = {};
        data[area] = $("#" + area).html();
        $.post("php/savefile.php", data)
            .done(function (data) {
                console.log(data);
                console.log(area + " saved");
            }).fail(function () {
                console.log("Network error");
            })
    }
    jQuery(function ($) {
        $('body').click(function (e) {
            //alert(e.target.className==='redactor_toolbar');
            var clickedOn = $(e.target);
            //alert((e.target.id.trim()==cur.trim()+'-edit-btn') + "#"+e.target.id.trim()+"#"+cur.trim()+'-edit-button'+"#"  );
            if (cur == 0 || clickedOn.parents().andSelf().is('.redactor_box') || clickedOn.parents().andSelf().is('#redactor_modal') || clickedOn.parents().andSelf().is('.redactor-link-tooltip') || e.target.id === cur + '-edit-btn') {} else if (clickedOn.parents().andSelf().is('#' + cur)) {} else {
                exampleClickToSave(cur);
            }
        });
    });

    $(document).on('click', '#about_coaching', function (e) {
        exampleClickToEdit('about_coaching');
    });
    $("#about_coaching-edit-btn").click(function (e) {
        exampleClickToEdit('about_coaching');
    });

    $(document).on('click', '#usp', function (e) {
        exampleClickToEdit('usp');
    });
    $("#usp-edit-btn").click(function (e) {
        exampleClickToEdit('usp');
    });

    $(document).on('click', '#test', function (e) {
        exampleClickToEdit('test');
    });
    $("#test-edit-btn").click(function (e) {
        exampleClickToEdit('test');
    });

    $(document).on('click', '#testinfo', function (e) {
        exampleClickToEdit('testinfo');
    });
    $("#testinfo-edit-btn").click(function (e) {
        exampleClickToEdit('testinfo');
    });

    $(document).on('click', '#usptest', function (e) {
        exampleClickToEdit('usptest');
    });
    $("#usptest-edit-btn").click(function (e) {
        exampleClickToEdit('usptest');
    });

    $(document).on('click', '#programoffered', function (e) {
        exampleClickToEdit('programoffered');
    });
    $("#programoffered-edit-btn").click(function (e) {
        exampleClickToEdit('programoffered');
    });

    $(document).on('click', '#scholarships', function (e) {
        exampleClickToEdit('scholarships');
    });
    $("#scholarships-edit-btn").click(function (e) {
        exampleClickToEdit('scholarships');
    });

    $(document).on('click', '#testdetails', function (e) {
        exampleClickToEdit('testdetails');
    });
    $("#testdetails-edit-btn").click(function (e) {
        exampleClickToEdit('testdetails');
    });

     $(document).on('click', '#result', function (e) {
        exampleClickToEdit('result');
    });

    $("#result-edit-btn").click(function (e) {
        exampleClickToEdit('result');
    });

     $(document).on('click', '#financebenefits', function (e) {
        exampleClickToEdit('financebenefits');
    });
    $("#financebenefits-edit-btn").click(function (e) {
        exampleClickToEdit('financebenefits');
    });



    /* Button Assignment for Table edit buttons  */

    //Saving the table for batch size

    $("#batch-table-edit-btn").click(function (e) {
        editTable('batch-table', 'batch-table-edit-btn', 'batch-editable', 'batch-table-editable', ['Center',  '8th', '9th', '10th', '11th', '12th', '12th passout'], 0, 0);
    });
    $("#batch-table-save-btn").click(function (e) {
        saveTable('batch-table', 'batch-table-edit-btn', 'batch-editable', 'batch-table-editable', 0, 0);
        savecentertables()
    });
    $("#batch-table-cancel-btn").click(function (e) {
        cancelTable('batch-table', 'batch-table-edit-btn', 'batch-editable', 'batch-table-editable', 0, 0);
    });

    //Saving the table for Result
    $("#result-table-edit-btn").click(function (e) {
        editTable('result-table', 'result-table-edit-btn', 'result-editable', 'result-table-editable', ['Center', 'JEE Mains', 'JEE Advanced', 'BITS'], 0, 0);
    });
    $("#result-table-save-btn").click(function (e) {
        saveTable('result-table', 'result-table-edit-btn', 'result-editable', 'result-table-editable', 0, 0);
        savecentertables()
    });
    $("#result-table-cancel-btn").click(function (e) {
        cancelTable('result-table', 'result-table-edit-btn', 'result-editable', 'result-table-editable', 0, 0);
    });

    // Saving student teacher ratio
    $("#stratio-table-edit-btn").click(function (e) {
        editTable('stratio-table', 'stratio-table-edit-btn', 'stratio-editable', 'stratio-table-editable', ['Center', 'Physics', 'Chemistry', 'Math', 'Bio',], 0, 0);
    });
    $("#stratio-table-save-btn").click(function (e) {
        saveTable('stratio-table', 'stratio-table-edit-btn', 'stratio-editable', 'stratio-table-editable', 0, 0);
        savecentertables()
    });
    $("#stratio-table-cancel-btn").click(function (e) {
        cancelTable('stratio-table', 'stratio-table-edit-btn', 'stratio-editable', 'stratio-table-editable', 0, 0);
    });

    //Saving the table for Faculty
    $("#faculty-table-edit-btn").click(function (e) {
        editTable('faculty-table', 'faculty-table-edit-btn', 'faculty-editable', 'faculty-table-editable', ['Center', 'Physics', 'Chemistry', 'Math', 'Bio',], 0, 0);
    });
    $("#faculty-table-save-btn").click(function (e) {
        saveTable('faculty-table', 'faculty-table-edit-btn', 'faculty-editable', 'faculty-table-editable', 0, 0);
        savecentertables()
    });
    $("#faculty-table-cancel-btn").click(function (e) {
        cancelTable('faculty-table', 'faculty-table-edit-btn', 'faculty-editable', 'faculty-table-editable', 0, 0);
    });

    //Saving the table Center contact
    $("#contact_center-table-edit-btn").click(function (e) {
        editTable('contact_center-table', 'contact_center-table-edit-btn', 'contact_center-editable', 'contact_center-table-editable', ['Center', 'Phone No', 'Address','Email','Alternate phone'], 0, 0);
    });
    $("#contact_center-table-save-btn").click(function (e) {
        saveTable('contact_center-table', 'contact_center-table-edit-btn', 'contact_center-editable', 'contact_center-table-editable', 0, 0);
        savecentertables()
    });
    $("#contact_center-table-cancel-btn").click(function (e) {
        cancelTable('contact_center-table', 'contact_center-table-edit-btn', 'contact_center-editable', 'contact_center-table-editable', 0, 0);
    });

     //Saving the feetabel
    $("#fee-table-edit-btn").click(function (e) {
        editTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable', ['Course','Mode','Payment 1','Payment 2','Payment 3','Payment 4','Payment 5','Payment 6','Total'], 0, 0);        
    });
    $("#fee-table-save-btn").click(function (e) {
        saveTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable', 0, 0);
        saveFeeTable();        
    });
    $("#fee-table-cancel-btn").click(function (e) {
        cancelTable('fee-table', 'fee-table-edit-btn', 'fee-editable', 'fee-table-editable', 0, 0);
    });

    function savecentertables(){
        var tabledata={
            batchtable: JSON.stringify(tableToJson(document.getElementById("batch-table"))),
            resulttable: JSON.stringify(tableToJson(document.getElementById("result-table"))),
            facultytable: JSON.stringify(tableToJson(document.getElementById("faculty-table"))),
            contacttable: JSON.stringify(tableToJson(document.getElementById("contact_center-table"))),
            stratiotable: JSON.stringify(tableToJson(document.getElementById("stratio-table")))
        }
        jQuery.ajax({
            url:"php/savecentertable.php",
            method:"POST",
            data:tabledata,
            success:function(data){
                if(data=="done"){
                    setConfirmUnload(false);
                    location.reload();
                }
                 console.log(data);
            },
            error:function(){

            }
        })
    }

    function saveFeeTable(){
         var tabledata={            
            feetable: JSON.stringify(tableToJson(document.getElementById("fee-table")))
        };
        jQuery.ajax({
            url:"php/savefeetable.php",
            method:"POST",
            data:tabledata,
            success:function(data){
                 setConfirmUnload(false);
                console.log(data);                
            },
            error:function(){

            }
        })
    }

    $(".redactor_editor").on("click", function (event) {
        event.preventDefault();
    })
    var cid = $("#cid").val();
    $("#coaching-logo").mouseenter(function () {
        $('#edit-logo-text').css('display', 'block');
    });
    $("#coaching-logo").mouseout(function () {
        $('#edit-logo-text').css('display', 'none');
    });
    $('#edit-logo-text').click(function (e) {
        $("#logo-uploader").click();
    });
    $("#coaching-logo").click(function (e) {
        $("#logo-uploader").click();
    });
    $("#logo-uploader").on("change", function (e) {
        var filename = $("#logo-uploader").prop("files")[0].name;
        var name = filename.split('.').pop();
        var filesize = $("#logo-uploader").prop("files")[0].size;
        if (name == 'jpg' || name == 'jpeg' || name == 'png' || name == 'gif' || name == 'icon' || name == 'jfif' || name == 'JPG') {
            if (filesize > 1024 * 1024) {
                alert("File size exeeds max of 1MB its of size :" + parseInt(filesize / 1024) + "kb");
            } else {
                var formData = new FormData($('form')[1]);
                $.ajax({
                    url: 'php/logo-upload.php?cid=' + cid, //Server script to process data
                    type: 'POST',
                    data: $("#logo-up").serialize(),
                    //Ajax events
                    success: function (data) {
                        $("#coaching-logo").attr('src', 'data/' + cid + '/logo.png');
                    },
                    error: function (data) {
                        alert("error");
                    },
                    // Form data
                    data: formData,
                    //Options to tell jQuery not to process data or worry about content-type.
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        } else {
            alert("Bad File type " + name);
        }
    });

    /*   End of table edits*/

    $("#img-edit-btn").on("click", function (e) {
        if ($(".img-edit").hasClass('pullDown')) {
            $(".img-edit").removeClass('pullDown');
            $(".img-edit").addClass('rollUp');
            $(".img-edit").css('display', 'none');
            $(this).html("Edit Gallery");
            refresh_gallery();
        } else {
            $(".img-edit").removeClass('rollUp');
            $(".img-edit").css('display', 'block');
            $(".img-edit").addClass('pullDown');
            $(this).html("Finish Edit");
        }
        if ($(".img-caption-edit").hasClass('pullDown')) {
            $(".img-caption-edit").removeClass('pullDown');
            $(".img-caption-edit").addClass('rollUp');
            $(".img-caption-edit").css('display', 'none');
            $("#img-caption-edit-btn").html("Edit Captions");
            put_caption()
        }


    });

    $("#img-caption-edit-btn").on("click", function (e) {
        if ($(".img-caption-edit").hasClass('pullDown')) {
            $(".img-caption-edit").removeClass('pullDown');
            $(".img-caption-edit").addClass('rollUp');
            $(".img-caption-edit").css('display', 'none');
            $(this).html("Edit Captions");
            put_caption()
        } else {
            $(".img-caption-edit").removeClass('rollUp');
            $(".img-caption-edit").css('display', 'block');
            $(".img-caption-edit").addClass('pullDown');
            $(this).html("Submit Captions");
            get_caption();
        }
        if ($(".img-edit").hasClass('pullDown')) {
            $(".img-edit").removeClass('pullDown');
            $(".img-edit").addClass('rollUp');
            $(".img-edit").css('display', 'none');
            $("#img-edit-btn").html("Edit Gallery");
            refresh_gallery();
        }

    });

    function refresh_links(cid) {
        jQuery.ajax({
            url: "php/fetch_links.php?cid=" + cid,
            type: "GET",
            success: function (data) {
                var links = JSON.parse(data);
                var link = ['weblink', 'fblink', 'twitterlink', 'pluslink', 'linkedlink'];
                for (var i = link.length - 1; i >= 0; i--) {
                    if (links[i]) {
                        document.getElementById(link[i]).value = links[i];
                        if (links[i].substr(0, 4) != "http" && links[i].substr(0, 3) != "ftp")
                            links[i] = "http://" + links[i];
                        document.getElementById(link[i] + 'a').href = links[i];
                        document.getElementById(link[i] + 'a').target = "_blank";
                    } else {
                        document.getElementById(link[i] + 'a').href = "#";
                        document.getElementById(link[i] + 'a').target = "";
                    }
                    if (i == 0) {
                        if (links[i]) {
                            document.getElementById(link[i]).value = links[i];
                            if (links[i].substr(0, 4) != "http" && links[i].substr(0, 3) != "ftp")
                                links[i] = "http://" + links[i];
                            document.getElementById('coaching-website').href = links[i];
                            document.getElementById('coaching-website').target = "_blank";
                            document.getElementById('coaching-website').innerHTML = links[i];
                        } else {
                            document.getElementById('coaching-website').href = "#";
                            document.getElementById('coaching-website').target = "";
                            document.getElementById('coaching-website').innerHTML = "Click button to add website";
                        }
                    }
                };

            },
            error: function (data) {
                alert(data);
            }
        })
    }

    function load(x, y) {
        if (GBrowserIsCompatible()) {
            var map = new GMap2(document.getElementById("map"));
            //  map.addControl(new GSmallMapControl());
            // map.addControl(new GMapTypeControl());
            var center = new GLatLng(x, y);
            map.setCenter(center, 15);
            geocoder = new GClientGeocoder();
            var marker = new GMarker(center, {
                draggable: true
            });
            map.addOverlay(marker);
            document.getElementById("lat").innerHTML = center.lat().toFixed(5);
            document.getElementById("lng").innerHTML = center.lng().toFixed(5);

            GEvent.addListener(marker, "dragend", function () {
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

            GEvent.addListener(marker, "dragend", function () {
                var point = marker.getPoint();
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
                function (point) {
                    if (!point) {
                        alert(address + " not found");
                    } else {
                        document.getElementById("lat").innerHTML = point.lat().toFixed(5);
                        document.getElementById("lng").innerHTML = point.lng().toFixed(5);
                        map.clearOverlays()
                        map.setCenter(point, 14);
                        var marker = new GMarker(point, {
                            draggable: true
                        });
                        map.addOverlay(marker);

                        GEvent.addListener(marker, "dragend", function () {
                            var pt = marker.getPoint();
                            map.panTo(pt);
                            document.getElementById("lat").innerHTML = pt.lat().toFixed(5);
                            document.getElementById("lng").innerHTML = pt.lng().toFixed(5);
                        });


                        GEvent.addListener(map, "moveend", function () {
                            /*      map.clearOverlays();
                                    var center = map.getCenter();
                                          var marker = new GMarker(center, {draggable: true});
                                          map.addOverlay(marker);
                                          document.getElementById("lat").innerHTML = center.lat().toFixed(5);
                                       document.getElementById("lng").innerHTML = center.lng().toFixed(5);
                                */
                            GEvent.addListener(marker, "dragend", function () {
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

    function setnotification() {
        var notices = ["The image gallery is modified. Try to put HD Images for the coachings in the ratio as of the image Gallery", "Noe you just need to chose the exam for a program and categories will automatically come. If you find any problem write us a feedback"];
        if (notices.length == 0) {
            $(notificationspot).html("<br>No new notification");
        } else {
            $('#notificationsbadge').html(notices.length);
            $('#notificationsbadge').css('display', '');
            var innerstring = '<strong style="line-height:50px;">Notifications</strong>'; // <i style="float:right;top:10px;right:10px;" onclick="togglenotifications()" class="fa fa-times">';
            for (var i = 0; i < notices.length; i++) {
                innerstring = innerstring + '<div class="onenotification">' + notices[i] + '</div>';
            }
            $(notificationspot).html(innerstring);
        }
    }
    setnotification();
    var notificationshown = false;

    function togglenotifications() {
        $('#notificationsbadge').css('display', 'none');
        if (notificationshown == false) {
            notificationshown = true;
            var pos = $('#notifications').position();

            if (pos.left > 250) {
                $('#notificationspot').css('left', pos.left - 250);
                $('#notificationspot').css('top', pos.top + 60);
            } else {
                $('#notificationspot').css('left', pos.left + 50);
                $('#notificationspot').css('top', pos.top);
            }
            $('#notificationspot').css('display', 'block');

        } else if (notificationshown) {
            notificationshown = false;
            $('#notificationspot').css('display', 'none');
        }
    }

    window.onresize = function () {
        if (notificationshown) {
            var pos = $('#notifications').position();
            if (pos.left > 250) {
                $('#notificationspot').css('left', pos.left - 250);
                $('#notificationspot').css('top', pos.top + 60);
            } else {
                $('#notificationspot').css('left', pos.left + 50);
                $('#notificationspot').css('top', pos.top);
            }
            $('#notificationspot').css('display', 'block');
        }
    }
    $("#feedbackbtn").click(function () {
        togglefeedback();
    });
    var feedbackshown = false;

    function togglefeedback() {
        if (feedbackshown) {
            feedbackshown = false;
            $('#feedbackpot').animate({
                opacity: 0,
                right: -500,
            }, 1000, function () {
                $('#feedbackpot').css('display', 'none');
            });
        } else {
            feedbackshown = true;
            $('#feedbackpot').css('display', 'block');
            $('#feedbackpot').animate({
                opacity: 1,
                right: 50,
            }, 1000);
        }
    }
    $("#feedback-form").submit(function () {
        var k = 0;
        if ($("#feedback-subject").val() == "") {
            k = 1;
            $("#feedback-sub").addClass("has-error");
        } else
            $("#feedback-sub").removeClass("has-error");
        if ($("#feedback-msg").val() == "") {
            k = 1;
            $("#feedback-message").addClass("has-error");
        } else
            $("#feedback-message").removeClass("has-error");
        if (k == 1)
            return false;
        $.ajax({
            url: "php/send-feedback.php",
            type: "POST",
            data: $("#feedback-form").serialize(),
            success: function (data) {
                togglefeedback();
                $("#feedback-subject").val("");
                $("#feedback-email").val("");
                $("#feedback-msg").val("");
                alert("Feedback Sent");
            },
            failure: function () {
                alert("Failed to send feedback\n Network error");
            }
        });
        return false;
    });

    function tableToJson(table) {
        var data = [];

        // first row needs to be headers
        var headers = [];
        for (var i = 0; i < table.rows[0].cells.length; i++) {
            headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
        }

        // go through cells
        for (var i = 1; i < table.rows.length; i++) {

            var tableRow = table.rows[i];
            var rowData = {};

            for (var j = 0; j < tableRow.cells.length; j++) {

                rowData[headers[j]] = tableRow.cells[j].innerHTML;

            }

            data.push(rowData);
        }

        return data;
    }


    function savecoachingdata() {       
        $("body").css("overflow", "hidden");
        $("#waiting").css("display", "block");

        $.post("php/save-coaching-data.php?", {
            name:$("#coaching-name").html(),
            mainselection:$("#mainselection").val(),
            main10:$("#main10").val(),
            main100:$("#main100").val(),
            main500:$("#main500").val(),
            main1000:$("#main1000").val(),
            main2000:$("#main2000").val(),
            advselection:$("#advselection").val(),
            adv10:$("#adv10").val(),
            adv100:$("#adv100").val(),
            adv500:$("#adv500").val(),
            adv1000:$("#adv1000").val(),
            adv2000:$("#adv2000").val(),
            result_year:$("#year").val(),

        })
            .done(function (data) {
                $("body").css("overflow", "auto");
                $("#waiting").css("display", "none");
                alert(data);
                 savecentertables();
            })
            .fail(function (data) {
                $("body").css("overflow", "auto");
                $("#waiting").css("display", "none");
                alert("Network error... Failed to save");
            })

        setConfirmUnload(false);
    }
    $("#link-submit").on("click", function (e) {
        jQuery.ajax({
            url: "php/link-submit.php?cid=" + cid,
            type: "POST",
            data: $("#link-table").serialize(),
            success: function (data) {
                refresh_links(cid);
                $("#link-save-notify").css("visibility", "visible");
                $("#link-save-notify").addClass("fadeOut");
                setTimeout(function () {
                    $("#link-save-notify").removeClass("fadeOut");
                    $("#link-save-notify").css("visibility", "hidden");
                }, 2500)
            },
            error: function (data) {
                alert(data);
            }
        });
    })

