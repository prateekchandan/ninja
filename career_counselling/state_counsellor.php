<?php
        
        include '../php/dbconnect.php';


        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }

        if(isset($_GET['t'])){
            $title=$_GET['t'];
        }

        else
            $title="Infermap | Career Counselling";

        if(isset($_GET['d']))
            $desc=$_GET['d'];
        else
            $desc="Get to know your best career by our smart career counsellor";

        function find_did($dept){
            $dept=strtolower($dept);
            $pos=strpos($dept,"physics");
            if($pos!==false)
                    return 'phy';

            $pos=strpos($dept,"chemistry");
            if($pos!==false)
                return 'cham';

            $pos=strpos($dept,"math");
            if($pos!==false)
                return 'math';
            
            $pos=strpos($dept,"pharm");
            if($pos!==false){
                return 'pharm';
            }
            $pos=strpos($dept,"electronics");
            if($pos!==false){
                return 'electronic';
            }
            $pos=strpos($dept,"chemical");
            if($pos!==false){
                return 'chem';
            }
            $pos=strpos($dept,"aerospace");
            if($pos!==false){
                return 'aero';
            }
            $pos=strpos($dept,"cse");
            if($pos!==false){
                return 'cse';
            }
            $pos=strpos($dept,"computer");
            if($pos!==false){
                return 'cse';
            }
            $pos=strpos($dept,"civil");
            if($pos!==false){
                return 'civil';
            }
            $pos=strpos($dept,"me");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
                return 'mech';
            }
            $pos=strpos($dept,"mechanical");
            if($pos!==false){
                return 'mech';
            }
            $pos=strpos($dept,"mech");
            if($pos!==false){
                return 'mech';
            }
            $pos=strpos($dept,"electrical");
            if($pos!==false){
                return 'elec';
            }
            $pos=strpos($dept,"information");
            if($pos!==false){
                return 'it';
            }
            $pos=strpos($dept,"ee");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
                return 'elec';
            }
            $pos=strpos($dept,"ce");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
                return 'civil';
            }
            $pos=strpos($dept,"ec");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
                return 'elec';
            }
            $pos=strpos($dept,"it");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
                return 'it';
            }
            $pos=strpos($dept,"eee");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
                return 'elec';
            }
            $pos=strpos($dept,"ele");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
                return 'elec';
            }
            $pos=strpos($dept,"ece");
            if($pos!==false)
                if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
                    if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
                return 'electronic';
            }
        }

        if(isset($_POST['exam'])){
            $exam=mysqli_real_escape_string($con,$_POST['exam']);
            $q='select * from exam where name="'.$exam.'"';
            $q=mysqli_query($con,$q);
            if(mysqli_num_rows($q)>0){
                $str='select distinct cid from college_entrance_test where ';
                $name='';
                while($row=mysqli_fetch_assoc($q)){
                    if($name != '')
                        $name .= " ||";
                    $name .= "`name` = '".$row['eid']."'";
                }

                $q=mysqli_query($con,$str.$name);
                $alllist=array();
                $cat=mysqli_real_escape_string($con,$_POST['category']);
                $rank=$_POST['rank'];
                $rank-=$rank*0.1; 
                while($row=mysqli_fetch_assoc($q)){
                    $cid=$row['cid'];
                    $college=mysqli_fetch_assoc(mysqli_query($con,'select * from college_id where cid='.$cid));
                    $q1=mysqli_query($con1,'select `department` , `program` , `'.$cat.'` from t'.$cid.' where `'.$cat.'`>'.$rank.' && ('.$name.')');
                    while($col=mysqli_fetch_assoc($q1)){
                        $t=array();
                        $t['code']='';
                        $t['department']=$col['department'];
                        $t['link']=clean($college['name']).'-'.$college['city'].'-'.$college['link'];
                        $t['institute']=$college['name'];
                        $t['rank']=$col[$cat];
                        $t['did']=find_did($col['department']);
                        array_push($alllist,$t);
                    }

                }
                function cmp($a, $b)
                {
                    return $a['rank'] - $b['rank'];
                }

                usort($alllist, "cmp");
                $return=array();
                $count=1;
                    while (!empty($alllist)) {
                        $todel=array();
                        foreach ($deptrank as $key => $value) {
                            if($value!='9999')
                            for ($i=0; $i < 14; $i++) { 
                                if($alllist[$i]['did']==$key){
                                    $alllist[$i]['code']=$count;
                                    $count++;
                                    array_push($return,$alllist[$i]);
                                    array_push($todel, $i);
                                }
                            }
                        }

                        for ($i=0; $i < 14; $i++){ 
                            if(!in_array($i,$todel)){
                                $alllist[$i]['code']=$count;
                                $count++;
                                if(!empty($alllist[$i])&&$alllist[$i]['department']!='')
                                array_push($return,$alllist[$i]);
                                array_push($todel, $i);
                            }
                        }
                        array_splice($alllist,0,14);

                    }
                    echo json_encode($return);

                die();  
            }
        }

    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.face    book.com/2008/fbml">

    <head>
        <title><?php echo $title ?></title>
        <meta name="title" content="<?php echo $title ?>">
        <meta name="description" content="<?php echo $desc ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Keywords" content="College,Education,Shivam Mittal,Search,Query,About COllege,Admission,Prateek Chandan,career counsellig">
        <meta name="author" content="Prateek Chandan">
        <link rel="author" href="https://plus.google.com/+PrateekChandan"/>
        <meta property="og:title" content="<?php echo $title ?>"/>
        <meta property="og:site_name" content="Infermap"/>
        <meta property="og:type" content="article"/>
        <meta property="og:image" content="http://www.infermap.com/img/social.png"/>
        <meta property="og:url" content="http://www.infermap.com/career_counselling"/>
        <meta property="og:description" content="<?php echo $desc ?>"/>
        <meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
        <meta property="article:publisher" content="https://www.facebook.com/infermap" />
        <meta itemprop="name" content="<?php echo $title ?>">
        <meta itemprop="description" content="<?php echo $desc ?>">
        <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
        <meta property="fb:admins" content="prateekchandan5545"/>
       
        <link rel="icon" href="../img/favicon-icon.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../data/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../data/font-awesome/css/font-awesome.css"/>
        <style type="text/css">
            .question{
                margin-top: 10px;
                font-size: 23px;
                height: 75px;
            }
            h2{
                text-decoration: underline;
            }
            .description{
                font-size: 1.1em;
            }
            input[type="radio"]{
                width: 15%;
                height: 27px;
                vertical-align: middle;
            }
        </style>
        
    </head>

    <body>
        <style type="text/css">
            @font-face {
                font-family: we_are_hiring;
                src: url(../data/css/fonts/BebasNeue.otf);
            }
            .navbar-infermap {
                background-color: #02294A;
                color: #f4f4f4;
                margin: 0px;
                border: 0px solid #02294b;
                border-radius: 0px;
                color: #fff;
            }
            .navbar-infermap>div,
            .navbar-infermap>div>div {} .nav>li>a {
                color: #428bca !important;
                font-family: we_are_hiring;
                font-size: 16px;
                letter-spacing: 1px;
            }
            .navbar-main>li>a {
                color: white !important;
                height: 50px;
                padding-right: 20px;
                padding-left: 20px;
                margin-left: 0px;
                border-left: 1px solid #c6cac6;
                min-width: 120px;
                padding-top: 15px;
                padding-bottom: 10px;
                font-family: we_are_hiring;
                font-size: 1.4em;
                letter-spacing: 1px;
                text-align: center;
            }
            .navbar-main>li:last-child>a {
                border-right: 1px solid #c6cac6;
            }
            .navbar-main>li {
                -o-transition: .3s;
                -ms-transition: .3s;
                -moz-transition: .3s;
                -webkit-transition: .3s;
            }
            .navbar-main>li:hover {
                background: #fff;
            }
            .navbar-main>li>a:hover {
                color: #428bca !important;
            }
            .twitter-typeahead {
                width: 150%;
            }
            .typeahead {
                border-radius: 0px;
                box-shadow: none;
                border: 0px;
            }
            .typeahead:focus {
                box-shadow: none;
                border: 0px;
            }
            .btn-search {
                border-radius: 0px;
                margin-left: 80px;
                color: #999;
                min-height: 34px;
            }
            .btn-search:hover {
                background: #fff;
            }
            .tt-dropdown-menu {
                color: #888 !important;
                background: white !important;
                border: 1px solid #eee !important;
                width: 100% !important;
            }
            .tt-suggestion {
                border-bottom: 1px solid #ddd;
                padding-left: 11px !important;
            }
            .navbar-brand {
                padding-left: 110px !important;
            }
            .brand-image {
                position: absolute;
                top: 0px;
                left: 100px;
                z-index: 10000;
                height: 100px;
            }
            .container-fluid {
                max-width: 1140px;
                margin: auto;
            }
        </style>
        <a href="http://www.infermap.com">
            <img src="logo.png" class="brand-image">
        </a>
        <nav class="navbar navbar-default navbar-infermap" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>

                <!-- Collect the nav links,deorms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-main">
                        <li><a href="../main.php">College Search</a>
                        </li>
                        <li><a href="../compare.php">Compare Colleges</a>
                        </li>
                        <li><a href="../guide.php">My College Plan</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="navbar-form navbar-left" role="search" method="GET" action="../main.php">
                                <div class="form-group">
                                    <input type="hidden" name="search" value="keyword">
                                    <input type="text" class="form-control typeahead" placeholder="Search" name="value" placeholder="Search a college">
                                </div>
                                <button type="submit" class="btn btn-default btn-search"><i class="glyphicon glyphicon-search"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div class="container" id="question-container">
            <img src="../img/career/header3.jpg" style="width:100%;height:auto">
            <h2>Personal Counsellor for State Exams</h2>
            <p class="description">
                Find all the branches and colleges available to you based on your state exam rank. Develop a free 
                        counselling list for yourself.
            </p>
            <hr>
            <div class="product-box row col-md-12">
                <form id="predictor-form">
                    <div class="col-md-5 ">
                        <div class="form-group row">
                            <label style="font-size:1.2em"> Please Enter:</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="Name">Name:</label>
                            <div class="col-md-9">
                                <input id="bc-name" class="form-control" name="name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="Exam">Exam:</label>
                            <div class="col-md-9">
                                <select name="exam" id="bc-exam" class="form-control">
                                <option value=''>Select Exam</option>
                                <?
                                $state_exam=array(10, 11, 21, 23, 25, 26, 27, 28, 29, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 40, 42, 45, 46, 47, 48, 50, 51);
                                $qstr="select distinct name from exam where ";
                                $i=0;
                                foreach ($state_exam as $value) {
                                    if($i>0)
                                        $qstr.=' || ';
                                    $qstr.="eid='".$value."'";
                                      $i++;       
                                }
                                $qstr.=" order by name";
                                $q=mysqli_query($con,$qstr);
                                while($row=mysqli_fetch_assoc($q))
                                {
                                    echo "<option>".$row['name']."</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="rank">Rank:</label>
                            <div class="col-md-9">
                                <input type="number" id="bc-rank" class="form-control" name="rank" placeholder="Enter your rank" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-3" for="category">Category:</label>
                            <div class="col-md-9">
                                <select id="bc-category" class="form-control" name="category">
                                    <option value="gen">General</option>
                                    <option value="obc">OBC</option>
                                    <option value="sc">SC</option>
                                    <option value="st">ST</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12" style="text-align:center">
                            <button class="btn btn-info btn-lg"> Find Available Branches</button>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2 ">
                        <div class="form-group row">
                            <label style="font-size:1.2em"> Branch Preference: <small style="font-size:0.8em">(Optional)</small></label>
                        </div>
                        <?
                            $q=mysqli_query($con,"select * from departments");
                            $n=mysqli_num_rows($q);
                            $allnum='<option value="">--Preference Order--</option>';
                            for ($i=1; $i <= $n; $i++) { 
                                $allnum.='<option>'.$i.'</option>';
                            }
                            $i=0;
                            while ($row=mysqli_fetch_assoc($q)) {
                                $i++;
                                ?>
                                    <div class="form-group row">
                                        <label class="col-md-6  "><?echo $row['value']; ?></label>
                                        <div class="col-md-6">
                                            <select data-num="<? echo $i;?>" class="dept-select form-control" name='<? echo $row["key"]; ?>'>
                                                <?
                                                    echo $allnum;
                                                ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                <?
                            }
                        ?>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="container" id="waiting-container" style="text-align:center;display:none">
            <img src="../img/career/header2.jpg" style="width:100%;height:auto">
            <br>
            <br>
            <br><br><br><br>
            <br><br><br>
            <h3>Preparing counsiling list for you..</h3>
            <img src="../img/loader.gif">
            <br>
            <br><br><br>
            <br>
            <br>
            <br><br><br><br><br>
        </div>
        <div class="container" id="result-container" style="display:none">
            <img src="../img/career/header4.jpg" style="width:100%;height:auto">
            <h2>The Best prepared counselling list for you </h2>
            <hr>
            <div class="row col-md-12">
                <h3> Name : <span id='person-name'></span></h3>
                <h3> Exam : <span id='exam-name'></span></h3>
                <h3> Category : <span id='category-name'></span></h3>
            </div>
            <div id="result">
                
            </div>

            <div class="row col-md-12">
                <div class="col-md-4" style="text-align:center">
                    <button class="btn btn-info" onclick="printDiv()">Print this</button>
                </div>
                <div class="col-md-4" style="text-align:center">
                    <button class="btn btn-success" onclick="startagain()">Start again</button>
                </div>
                <div class="col-md-4" style="text-align:center">
                    <a class="btn btn-primary" target="_blank" href=""><i class="fa fa-facebook fa-lg"></i> Share of Facebook</a>
                </div>
            </div>
            <br>

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
                <a href="./">Home</a> 
            </div>
            <div class="col-md-2">
                 <a href="../about.php" target="_blank">About us</a> 
            </div>
            <div class="col-md-2">
             <a href="../FAQ.php" target="_blank">FAQ's</a> 
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
       
        <script src="../data/js/jquery.js"></script>
        <script type="text/javascript" src="../js/typeahead.js"></script>
        <script type="text/javascript" src="table-arrange.js"></script>
        <script type="text/javascript">
            var n=<? echo $n ?>;
            var categories={<?php
                $cate=mysqli_query($con,"select * from category");
                $i=0;
                while($row=mysqli_fetch_assoc($cate))
                {
                    if($i!=0)
                        echo ",";
                    $i+=1;
                        echo $row['id'].":'".$row['name']."'";
                }
            ?>}
            var exams={<?php
                $exam=mysqli_query($con,"select * from exam");
                $i=0;
                while($row=mysqli_fetch_assoc($exam))
                {
                    if($i!=0)
                    echo ",";
                    echo "'".$row['name']."':['".$row['name']."',".$row['category']."]";
                    $i+=1;
                }
                echo "};";
            ?>
            function setcategory(){
                if($("#bc-exam").val()==""){
                    $("#bc-category").html("<option value=''>Select Category</option>");
                    return;
                }
                var cat=exams[$("#bc-exam").val()][1],str="<option value=''>Select Category</option>";
                for (var i = 0; i < cat.length; i++) {
                    str+="<option value='"+cat[i]+"'>"+categories[cat[i]]+' ('+cat[i]+')'+"</option>";
                };
                $("#bc-category").html(str);
            }
            $("#bc-exam").change(function(){
                setcategory();
            })
            setcategory();

            var alldepts=[],deptval=[];
            for (var i = 1; i <= n; i++) {
                alldepts[i]=0;
                deptval[i]=0;
            };

            $('.dept-select').change(function(){
                var k=$(this).data('num');
                var i=$(this).val(),j=deptval[k];;
                alldepts[j]=(alldepts[j]+1)%2;
                if(i==''){
                    deptval[k]=0;
                }
                else{
                    deptval[k]=i;
                    alldepts[i]=(alldepts[i]+1)%2;
                }
                var str="<option value=''>--Preference Order--</option>";
                for (var i = 1; i <= n; i++) {
                    if(!alldepts[i]){
                        str+='<option>'+i+'</option>';
                    }
                }

                $('.dept-select').each(function(){
                    var val=$(this).val();
                    if(val!=''){
                        $(this).html(str+'<option>'+val+'</option>');
                    }
                    else
                        $(this).html(str);
                    $(this).val(val);
                })
            })

            $('#predictor-form').submit(function(e){
                e.preventDefault();
                if($('#bc-exam').val()=="")
                {
                    alert("Please select exam");
                    return;
                }
                if($('#bc-category').val()=="")
                {
                    alert("Please select category");
                    return;
                }
                $('#question-container').css('display','none');
                $('#waiting-container').css('display','block');
                jQuery.ajax({
                    data:$(this).serialize(),
                    type:'post',
                    success:function(data) {
                        //console.log(data);
                        try{
                            data=JSON.parse(data);
                            var str='<table class="table table-striped" id="result-table">\
                            <thead>\
                            <tr>\
                                <th>SL no</th>\
                                <th>Department</th>\
                                <th>Institute</th>\
                                <th>Closing rank</th>\
                            </tr>\
                            </thead>';
                            for (var i = 0; i < data.length && i <100; i++) {
                                str+='<tr id="row'+i+'">\
                                    <td>'+data[i]['code']+'</td>\
                                    <td>'+data[i]['department']+'</td>\
                                    <td><a href="../college/'+data[i]['link']+'" target=_blank>'+data[i]['institute']+'</td>\
                                    <td>'+data[i]['rank']+'</td>\
                                </tr>';
                            };
                            str+='</table>';
                            $('#result').html(str);
                            $('#exam-name').html($('#bc-exam').val());
                            $('#person-name').html($('#bc-name').val());
                            $('#category-name').html($('#bc-category').val());
                            $('#waiting-container').css('display','none');
                            $('#result-container').css('display','block');
                            $("#result-table").tableDnD();
                            
                        }
                        catch(e){
                            alert('Error in getting counselling list');
                        }
                        
                    },
                    error:function(){
                        alert('Network Fialure');
                    }
                })
            })
            function printDiv()
            {
              var divToPrint=document.getElementById('result-table');
              var str='<h2>Couselling List</h2>'+divToPrint.outerHTML+'<br><p>http://www.infermap.com/career_couselling</p>';
              newWin= window.open("");
              newWin.document.write(str);
              newWin.print();
              newWin.close();
            }
            function startagain() {
                location.reload();
            }

        </script>
        <script type="text/javascript">
         var bestPictures = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: '../college.json',
          remote: '../college.json'
        });
         
        bestPictures.initialize();
         
        $('.typeahead').typeahead(null, {
          name: 'best-pictures',
          displayKey: 'value',
          source: bestPictures.ttAdapter()
        });
        </script>

    </body>

    </html>
