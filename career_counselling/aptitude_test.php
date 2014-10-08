<?php
    $allquestions=array(
        array("Q_5","Favorite color?",array("Red","Pink","Orange","Yellow","Green","Blue","Gray","White","Black")),
        array("Q_9","Favorite kitchen utensil?",array("Meat thermometer","Wire whisk","Microwave","Blender","Spatula")),
        array("Q_3","Favorite way to spend your free time?",array("Expressing myself through art or something I create","Expressing myself directly, like writing my thoughts down or speaking to groups","Hanging out with friends and family","Doing puzzles or creating things that involve putting pieces together")),
        array("Q_4","I'm good at helping people...",array("Understand themselves and what they're really looking for","Get their head out of the clouds and have a reality check","Understand others and resolve disagreements","Understand complex ideas")),
        array("Q_1","If I'm late on a project, it's more likely because it...",array("Takes me a while to get done, I'm a perfectionist"," Takes me a while to get motivated, I'm a procrastinator")),
        array("Q_6","Are you good at minding your own business?",array("Yes","No")),
        array("Q_7","Word that best describes you",array("Ambitious","Organized","Nerdy","Adventurous","Practical")),
        array("Q_10","What do people like about you?",array("I'm convincing, opinionated, and fresh"," I'm relaxed and easy to get along with","I'm very supportive and loyal")),
        array("Q_2","Where would you like to go to work?",array("My own special cubicle","A different city every week","A busy factory","Outer space","The great outdoors","A hospital")),
        array("Q_8","Do you like being in charge?",array("Yes","No","Doesn't matter")),
        array("Q_11","What size company do you think you'd want to work at?",array("Huge, like the government","A small company, with a few dedicated people I'm close to","A big company, with lots of people to meet and room to move around","Someplace in the middle")),
        array("Q_12","My mad scientist laboratory would have...",array("A greenhouse full of plants (maybe evil plants?)","Blinky lights","Colorful liquids in test tubes","Everything, it'd be a total mess!")),
        array("Q_13","I'd rather work",array("Alone. I don't care how helpful the group is."," With a group of helpful people.")),
        array("Q_14","What are you most likely to doodle on the side of a paper when you're bored?",array("Lines","Cars, buildings, trees... other things you see around you","Arrows","Squares","Clouds, airplanes, rockets, other things in the sky","Circles")),
        array("Q_15","I'd rather have friends who are...",array("Unique","Generous","Confident","Imaginative","Not into creating drama")),
        array("Q_16","Word that describes you best?",array("Successful","Happy","Helpful","Understanding")),
        array("Q_17","What's something you'd HATE at work?",array("Getting messy","Sitting at a desk all day","Constantly being distracted and having to switch tasks","Working in isolation")),
        array("Q_18","What's more important?",array("That everything is done right","That people get along")),
        array("Q_19","What would you rather do?",array("Build big impressive things","Invent cool gadgets","Make the world a better place","Be a mad scientist","Break stuff")),
        array("Q_20","Another possible job for me might be...",array("Teacher","Politician","Retail","Pilot","Veterinarian","Cosmetologist"))
        );

    shuffle($allquestions);

    if(isset($_GET['t'])){
        $title=$_GET['t'];
    }
    else
        $title="Infermap | Career Counselling";

    if(isset($_GET['d']))
        $desc=$_GET['d'];
    else
        $desc="Get to know your best career by our smart career counsellor";

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
            font-size: 21px;
        }
        .row{
            margin-left: 0px;
            margin-right: 0px;
            padding-top: 10px;
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
        <img src="../img/career/banner.jpg" style="width:100%;height:auto">
        <h3>Quiz:What kind of engineer should you be?</h3>
        <hr>
        <p>Engineering is one of the coolest jobs in the world, but there are so many disciplines it can be a little daunting to choose one for yourself! I wasn't happy with the existing quizzes, they were mostly way too direct (do you like bridges or wires? uh...) or way too career-spammy, and they were all way too serious. So with that in mind I took some personality traits and kinda did my best attempt at mapping them to engineering fields. It's not scientific or accurate because it really doesn't matter, engineers do so many things and move around so much there's no way to predict what path you'll end up on... so relax! This point of this test is to combine the fun of a personality quiz with the usefulness of a career test... hey look at that, fun AND useful? It's getting engineer-y already!
            <br>
            <br>You can skip a few questions if you don't like them, but the more you answer the more accurate the test will be. Well, within all the accuracy it's capable of, that is. Which isn't much.
        </p>
        <form id="form-id">
            <?php
                $i=0;
                foreach ($allquestions as $q) {
                    $i++;
                   ?>
                <div class="well row">
                    <div class="question col-md-12"><? echo 'Q'.$i.". ".$q[1]  ?></div>
                    <?
                        $c='a';
                        $j=0;
                        foreach ($q[2] as $answer) {
                            if($j%2==0){
                                echo '<div class="row">';
                            }
                            ?>
                            <div class="col-md-6">
                                <input type="radio" name="<? echo $q[0]; ?>" value="<? echo $q[0].$c;?>">
                                <?echo $answer;?>
                            </div>

                            <?
                            if($j%2==1){
                                echo '</div>';
                            }
                            $j++;
                        }
                        if($j%2==1){
                            echo '</div>';
                        }


                    ?>
                </div>

                   <?
                }
            ?>
            <div style="text-align:center"><button class="btn btn-lg btn-success">SUBMIT</button></div>
            <br>
        </form>
    </div>

    <div class="container" id="result-container" style="display:none">
        <img src="../img/career/banner.jpg" style="width:100%;height:auto">
        <h3 id="r-branch"></h3>
        <hr>
        <div class="question col-md-12" id="r-about">
        </div>
        <br>
        <div class="question col-md-12" id="r-engg">
        </div>
        <hr>
        <div class="question row">Other Matches</div>
        <div class="col-md-12" id="r-other">
        </div>
        <br>
        <div class="col-md-12" style="text-align:center">
            <button class="btn btn-success btn-lg" onclick="againtest();">START AGAIN !</button>
        </div>
        <div class="col-md-12" style="text-align:center">
            <br>
            <a class="btn btn-primary btn-lg" target=_blank style="" id="fb-share"><i class="fa fa-facebook"></i> Share on Facebook</a>
        </div>
        <hr>
        <h2>
        Feedback
        </h2>
        <form id="feedback-form">
            <div class="form-group row">
                <label class="col-md-5">Enter Your Branch or the one you are Interested in :</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" type="text" name="cllg" placeholder="Input Branch" required>
                </div>
            </div>
             <div class="form-group row">
                <label class="col-md-5">Enter your email :</label>
                <div class="col-md-4">
                    <input type="email" name="email"  class="form-control" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-5">Rate the Test(1-10) :</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" min="1" max="10"  name="rate"  placeholder="Input integer(1-10)" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-5">Were the questions easy to understand and answer?</label>
                <div class="col-md-2">
                    <input type="radio" name="que" value="yes">&nbsp;Yes
                </div>
                <div class="col-md-2">
                    <input type="radio" name="que" value="no">&nbsp;No
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-info">
        </form>
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
    <script src="form.js"></script>
    <script type="text/javascript" src="../js/typeahead.js"></script>
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
