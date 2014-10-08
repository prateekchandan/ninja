<?php
    include '../php/dbconnect.php';

    if(isset($_GET['t'])){
        $title=$_GET['t'];
    }
    else
        $title="Infermap Career Counselling";

    if(isset($_GET['d']))
        $desc=$_GET['d'];
    else
        $desc="Infermap’s career counselling is developed keeping the student in mind. We are fully aware of the tension and mind boggling pressure on the student to find the best college and best branch. We aim to guide the students step wise to make the correct decision about their future.";

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
    <meta property="og:image" content="http://www.infermap.com/img/career/seo2.jpg"/>
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
        .product-box>a{
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: block;
            color:#333;
            box-shadow: inset 0px 0px 10px #eee;
            min-height: 275px;
            width: 32%;
            margin: 0.4%;
        }
        .product-box>a:hover{
            background: #eee;
            color:#222;
            text-decoration: none;
        }
        .product-box>a>div>i{
            color: #f39f19;
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
    <div class="container">
        <img src="../img/career/banner.jpg" style="width:100%;height:auto">
        <h2>Infermap Career Counselling</h2>
        <p class="description">
            Infermap’s career counselling is developed keeping the student in mind. We are fully aware of the tension
            and mind boggling pressure on the student to find the best college and best branch. We aim to guide
            the students step wise to make the correct decision about their future.
        </p>
        <p class="description">
            Our Branch Aptitude Test asks the students some pretty basic question to help them realise the branch 
            in which would be most comfortable in based on their personality traits. We also find all the colleges 
            nd branches which are available to you based on your marks, rank and other details. The student also has the power to develop their own counselling list based on their ranks, interest, preferred branch and other preferences..
        </p>
        <p class="description">
            We also find all the colleges and branches which are available to you based on your marks, rank and
            other details. The student also has the power to develop their own counselling list based on their 
            ranks, interest, preferred branch and other preferences.
        </p>
        <hr>
        <div class="product-box row col-md-12">
            <a class="col-md-4 " href="branch_predictor.php">
                <div class="col-md-12" style="text-align:center">
                    <i class="fa fa-university fa-4x"></i>
                </div>
                <div class="col-md-12">
                    <div class="question">
                        Branch Predictor for IITs and NITs
                    </div>
                    <p class="description"> 
                        Just tell us your rank we will get all the branches for you which are available in different IITs and 
                        NITs. You can also create your own Counselling list based on the choices available to you.
                    </p>
                </div>
            </a>
            <a class="col-md-4 " href="aptitude_test.php">
                <div class="col-md-12" style="text-align:center">
                    <i class="fa fa-child fa-4x"></i>
                </div>
                <div class="col-md-12">
                    <div class="question">
                        Branch Aptitude Test
                    </div>
                    <p class="description"> 
                        Get a free personality assessment to find which engineering branch suits you the most, based on the
                        personality traits of different engineers.
                    </p>
                </div>
            </a>
            <a class="col-md-4 "  href="state_counsellor.php">
                <div class="col-md-12" style="text-align:center">
                    <i class="fa fa-graduation-cap fa-4x"></i>
                </div>
                <div class="col-md-12">
                    <div class="question">
                        Personal Counsellor for State Exams
                    </div>
                    <p class="description"> 
                        Find all the branches and colleges available to you based on your state exam rank. Develop a free 
                        counselling list for yourself.
                    </p>
                </div>
            </a>
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
