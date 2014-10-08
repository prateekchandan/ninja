$(function () {
    $("#form-id").submit(function (e) {
        e.preventDefault();

        dataString = $("#form-id").serialize();
        cse = 0; //computer
        ind = 0; //industrial
        me = 0; //mechanical
        ae = 0; //aerospace
        ma = 0; //material
        el = 0; //electrical
        ci = 0; //civil
        ch = 0; //chemical
        en = 0; //environment
        $.ajax({
            type: "POST",
            url: "verify.php",
            data: dataString,
            dataType: "json",
            success: function (data) {
                if(data.n1 == "Q_1a") {
                    cse += 1;
                    ma += 1;
                    el += 1;
                }
                if(data.n1 == "Q_1b") {
                    ind += 1;
                    ch += 1;
                }
                if(data.n2 == "Q_2a") {
                    el += 1;
                }
                if(data.n2 == "Q_2b") {
                    ci += 1;
                }
                if(data.n2 == "Q_2c") {
                    ind += 1;
                }
                if(data.n2 == "Q_2d") {
                    ae += 1;
                }
                if(data.n2 == "Q_2e") {
                    en += 1;
                }
                if(data.n2 == "Q_2f") {
                    ch += 1;
                }
                if(data.n3 == "Q_3a") {
                    ci += 1;
                }
                if(data.n3 == "Q_3b") {
                    me += 1;
                }
                if(data.n3 == "Q_3c") {
                    ch += 1;
                }
                if(data.n3 == "Q_3d") {
                    ma += 1;
                }
                if(data.n4 == "Q_4a") {
                    ci++;
                }
                if(data.n4 == "Q_4b") {
                    me++;
                }
                if(data.n4 == "Q_4c") {
                    ch++;
                }
                if(data.n4 == "Q_4d") {
                    ma++;
                }
                if(data.n5 == "Q_5a") {
                    me++;
                }
                if(data.n5 == "Q_5b") {
                    ind++;
                }
                if(data.n5 == "Q_5d") {
                    cse++;
                }
                if(data.n5 == "Q_5f") {
                    ae++;
                }
                if(data.n5 == "Q_5g") {
                    ch++;
                }
                if(data.n5 == "Q_5h") {
                    ma++;
                }
                if(data.n5 == "Q_5i") {
                    el++;
                }
                if(data.n6 == "Q_6a") {
                    ind++;
                    ae++;
                    ci++;
                    ch++;
                    en++;
                }
                if(data.n6 == "Q_6b") {
                    me++;
                    cse++;
                }
                if(data.n7 == "Q_7a") {
                    ci++;
                }
                if(data.n7 == "Q_7b") {
                    me++;
                }
                if(data.n7 == "Q_7c") {
                    cse++;
                }
                if(data.n7 == "Q_7d") {
                    en++;
                }
                if(data.n7 == "Q_7e") {
                    ma++;
                }
                if(data.n8 == "Q_8a") {
                    ma++;
                    me++;
                    en++;
                }
                if(data.n8 == "Q_8b") {
                    ind++;
                    cse++;
                    ch++;
                }
                if(data.n8 == "Q_8c") {
                    ae++;
                    el++;
                    ci++;
                }
                if(data.n9 == "Q_9a") {
                    ind++;
                }
                if(data.n9 == "Q_9b") {
                    me++;
                }
                if(data.n9 == "Q_9c") {
                    cse++;
                }
                if(data.n9 == "Q_9e") {
                    ma++;
                }
                if(data.n10 == "Q_10a") {
                    me++;
                    el++;
                    cse++;
                }
                if(data.n10 == "Q_10b") {
                    ma++;
                    ci++;
                    ch++;
                }
                if(data.n10 == "Q_10c") {
                    ind++;
                    en++;
                    ae++;
                }
                if(data.n11 == "Q_11a") {
                    ci++;
                }
                if(data.n11 == "Q_11b") {
                    cse++;
                    en++;
                }
                if(data.n11 == "Q_11c") {
                    ae++;
                    ch++;
                }
                if(data.n11 == "Q_11d") {
                    ma++;
                    el++;
                }
                if(data.n12 == "Q_12a") {
                    ae++;
                    ci++;
                    en++;
                }
                if(data.n12 == "Q_12b") {
                    ind++;
                    cse++;
                    el++;
                }
                if(data.n12 == "Q_12c") {
                    ma++;
                    ch++;
                }
                if(data.n12 == "Q_12d") {
                    me++;
                }
                if(data.n13 == "Q_13a") {
                    el++;
                }
                if(data.n13 == "Q_13b") {
                    me++;
                }
                if(data.n14 == "Q_14a") {
                    el++;
                }
                if(data.n14 == "Q_14b") {
                    ci++;
                }
                if(data.n14 == "Q_14c") {
                    ind++;
                }
                if(data.n14 == "Q_14d") {
                    me++;
                }
                if(data.n14 == "Q_14e") {
                    ae++;
                }
                if(data.n14 == "Q_14f") {
                    ch++;
                }
                if(data.n15 == "Q_15a") {
                    ci++;
                }
                if(data.n15 == "Q_15b") {
                    ind++;
                }
                if(data.n15 == "Q_15c") {
                    cse++;
                }
                if(data.n15 == "Q_15d") {
                    ae++;
                }
                if(data.n15 == "Q_15e") {
                    ch++;
                }
                if(data.n16 == "Q_16a") {
                    cse++;
                }
                if(data.n16 == "Q_16b") {
                    ae++;
                }
                if(data.n16 == "Q_16c") {
                    en++;
                }
                if(data.n16 == "Q_16d") {
                    ma++;
                }
                if(data.n17 == "Q_17a") {
                    el++;
                }
                if(data.n17 == "Q_17b") {
                    ind++;
                    ae++;
                }
                if(data.n17 == "Q_17c") {
                    me++;
                }
                if(data.n17 == "Q_17d") {
                    en++;
                }
                if(data.n18 == "Q_18a") {
                    el++;
                    me++;
                    cse++;
                }
                if(data.n18 == "Q_18b") {
                    en++;
                    ind++;
                    ae++;
                }
                if(data.n19 == "Q_19a") {
                    ci++;
                }
                if(data.n19 == "Q_19b") {
                    cse++;
                }
                if(data.n19 == "Q_19c") {
                    en++;
                }
                if(data.n19 == "Q_19d") {
                    ch++;
                }
                if(data.n20 == "Q_20a") {
                    el++;
                }
                if(data.n20 == "Q_20b") {
                    ci++;
                }
                if(data.n20 == "Q_20c") {
                    ind++;
                }
                if(data.n20 == "Q_20d") {
                    ae++;
                }
                if(data.n20 == "Q_20e") {
                    en++;
                }
                if(data.n20 == "Q_20f") {
                    ch++;
                }
                var x = [];
                var tot = ae + ch + ci + cse + el + en + ind + ma + me;
                x[0] = (ae / tot) * 100;
                x[1] = (ch / tot) * 100;
                x[2] = (ci / tot) * 100;
                x[3] = (cse / tot) * 100;
                x[4] = (el / tot) * 100;
                x[5] = (en / tot) * 100;
                x[6] = (ind / tot) * 100;
                x[7] = (ma / tot) * 100;
                x[8] = (me / tot) * 100;
                var max = 0;
                var j;
                for(var i = 0; i < 9; i++) {
                    if(max < x[i]) {
                        j = i;
                        max = x[i];
                    }
                }
                for(var i = 0; i < j; i++) {
                    if(max == x[i]) {
                        j = i;
                        break;
                    }
                }
                var branch;
                var about_you;
                var you_engg;
                if(max == 0) {
                    alert("Answer at least one question to know the result.");
                }
                if(j == 0) {
                    branch = "Aerospace Engineer";
                    about_you = "You are optimistic and want to contribute to the world. You have your own unique style. You love having grand visions. You're a free spirit who is fun to be around. You like pursuing whatever your new crazy interest of the week is, rather than being told what to do.";
                    you_engg = "Aerospace engineers design aircraft, spacecraft, and other air vehicles. They work with the systems and equipment needed to propel and control anything that moves through the air. There is a great deal of overlap between aerospace and mechanical engineering, which is responsible for the physical design of all kinds of products.";
                }
                if(j == 1) {
                    branch = "Chemical Engineer";
                    about_you = "You're always thinking of a zillion things at once. You tell stories with great points that meander creatively.You enjoy life. There are only a few chosen people who really understand you and know how to get you to open up.";
                    you_engg = "Chemical engineers help figure out how to convert raw materials or chemicals into useful forms. They improve how we refine petroleum,design new plastics, or optimize paper production.";
                }
                if(j == 2) {
                    branch = "Civil Engineer";
                    about_you = "You are highly perceptive, and know what people think of you. Your work has a lot of meaning to yourself and others. You have a good eye for aesthetics.";
                    you_engg = "Civil engineers design and manage construction of large projects like roads, airports, bridges, dams, and buildings.";
                }
                if(j == 3) {
                    branch = "Computer Engineer";
                    about_you = "You are very energetic when you've got your eyes set on a task. You like hearing what people honestly think of you. You're proud of your accomplishments. You're not always great at working around the feelings of sensitive people at first, so people have to get to know you to appreciate what you're good at.";
                    you_engg = "Computer engineers apply and construct computers needed for system design. They write software, design hardware, and work onimproving capabilities like multimedia, mobile computing, simulations, and artificial intelligence.";
                }
                if(j == 4) {
                    branch = "Electrical Engineer";
                    about_you = "You have strong principles. You can sometimes be hard on yourself, but you achieve a lot and any team with you on it will be successful... even if you have to do the work yourself.";
                    you_engg = "Electrical engineers develop a wide range of technologies, from global positioning systems to power plants. They learn about how individual components interact in a circuit in addition to creating large systems out of devices and networks.";
                }
                if(j == 5) {
                    branch = "Environment Engineer";
                    about_you = "You relate easily to people and can be very convincing. You know what people need to make their lives better. You can be warm and generous, and when things are going well for you you tell everyone and can't help but share the laughter.";
                    you_engg = "Environmental engineers apply engineering principles to the improvement and protection of the environment. They help protect ecosystems, water resources, people and animals, from the effects of industry. They make sure we consider things like temperature changes, chemicals, fires or landscape changes in our technology projects.";
                }
                if(j == 6) {
                    branch = "Industrial Engineer";
                    about_you = "You are trustworthy, loyal, and socially conscious. Your friends have lots of different personalities. You're patient enough to slowly work through problems with people. You really like to think different and can be funny sometimes without even meaning to be.";
                    you_engg = "Industrial engineers design logistical and resource systems. They make manufacturing processes faster and help us use facilities more efficiently. They may plan out components and tools needed to make a product, or analyze reliability records to help companies understand maintenance costs.";
                }
                if(j == 7) {
                    branch = "Material Engineer";
                    about_you = "You can work out big ideas but in a very independent way. You love analyzing a problem from all different sides and viewpoints. You know a lot more than you let on.";
                    you_engg = "Materials engineers apply the properties of matter to engineering. They may work with special building materials like ceramics or composites, or assist electrical engineers in creating small components with crystals.";
                }
                if(j == 8) {
                    branch = "Mechanical Engineer";
                    about_you = "You're assertive and confident. You can stand up for yourself. You enjoy life if you're taking challenges head on and supporting the causes that are important to you.";
                    you_engg = "Mechanical engineers are responsible for the physical design of products. They think about how components transmit temperature, stress,or vibration between other connected components, and are heavily involved in the transportation industry.";
                }
                if(max != 0) {
			
                    //constants
                    /*$('img').each(function () {
                        var deg = $(this).data('rotate') || 0;
                        var rotate = 'rotate(' + $(this).data('rotate') + 'deg)';
                        $(this).css({
                            '-webkit-transform': rotate,
                            '-moz-transform': rotate,
                            '-o-transform': rotate,
                            '-ms-transform': rotate,
                            'transform': rotate
                        });
                    });*/
                    $("#question-container").css('display','none');
                    $("#result-container").css('display','block');
                    $("html body").animate({ scrollTop: 50 }, "slow");

                    $('#r-branch').html(branch);
                    $('#r-about').html(about_you);
                    $('#r-engg').html(you_engg);
                    //  $("#result-container").html('<br>'+'<br>'+branch+'<br>'+about_you+'<br>'+you_engg);
    		    
                    var a=[["Aerospace",x[0]],["Chemical",x[1]],["Civil",x[2]],["Computer",x[3]],["Electrical",x[4]],["Environment",x[5]],["Industrial",x[6]],["Material",x[7]],["Mechanical",x[8]]];
                    a.sort(function(a,b){return b[1]-a[1]})
                    var str="";
                    for (var i = 0; i < a.length; i++) {
                        str+=a[i][0]+'<br>';
                    }
                    $("#r-other").html(str);
                }

            }
        });

    });

	$("#feedback-form").submit(function(e){
		e.preventDefault();
		jQuery.ajax({
			url:'form_verify.php',
			data:$("#feedback-form").serialize(),
			type:'post',
			success:function(data){
                if(data=="done"){
				    $("#feedback-form")[0].reset();
                    alert('Thanx for your time and feedback');
                    $("html body").animate({ scrollTop: 250 }, "slow");
                }
                else
				alert(data);
			},
			error:function(data){
				alert("Network error");
			}

		})
	});

	
});

function againtest(){
    $("#form-id")[0].reset();
    $("#result-container").css("display","none");
    $("#question-container").css("display","block");
    $("html body").animate({ scrollTop: 50 }, "slow");
}
