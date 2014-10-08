<?php

if($_SERVER['SERVER_NAME']=="infermap.com")
	header("location:http://www.infermap.com");
include 'php/dbconnect.php';
$ip=$_SERVER['REMOTE_ADDR'];
$q=mysqli_query($con,"select * from ip_addr where ip='".$ip."'");
if(mysqli_num_rows($q)>=1)
{
	$no=mysqli_fetch_assoc($q)['noofvisit'];
	mysqli_query($con,"update ip_addr set noofvisit=".($no+1)." where ip = '".$ip."'");
}
else
 mysqli_query($con,"insert into ip_addr (ip,noofvisit) values ('".$ip."',1)");

$page_desc="Making the right educational decisions can be tough. With so much at stake and so many factors to 
			consider, you might find it hard to collect and process all the information you need to make the 
			right choices that lead to your dream career. Infermap will accompany you in finding the college 
			and branch most suited to you. Just visit www.infermap.com and use the interactive methods of 
			search to find colleges across the country. With an array of cleverly designed tools and well sorted 
			and abundant data, Infermap powers your move from conception to completion.";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Infermap</title>
	<meta name="title" content="Infermap - Next Generation Education Portal">
	<meta name="description" content="<?php  echo $page_desc; ?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="Keywords" content="College,Education,About College,Admission, Courses Offered, Programs Offered, closing ranks, Admissions, fees,  facilities,  contact information, view on map, Extra Co-curricular Activities">
    <meta name="author" content="Infermap">
	<link rel="author" href="https://plus.google.com/+PrateekChandan"/>
	<meta property="og:title" content="Infermap - Next Generation Education Portal"/>
	<meta property="og:site_name" content="Infermap"/>
	<meta property="og:type" content="article"/>
	<meta property="og:image" content="http://www.infermap.com/img/social_temp.png"/>
	<meta property="og:url" content="http://www.infermap.com"/>
	<meta property="og:description" content="<?php  echo $page_desc; ?>"/>
	<meta property="article:author" content="https://www.facebook.com/prateekchandan5545" />
	<meta property="article:publisher" content="https://www.facebook.com/infermap" />
	<meta itemprop="name" content="Infermap - Next Generation Education Portal">
    <meta itemprop="description" content="<?php  echo $page_desc; ?>">
    <meta itemprop="image" width="200" height="200" content="http://www.infermap.com/img/logo.png">
	<meta property="fb:admins" content="prateekchandan5545"/>
	
	<link rel="icon" href="./img/favicon-icon.png" type="image/x-icon"/>
	<link rel="stylesheet" href="data/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="data/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" type="text/css" href="css/homepage.min.css">
</head>
<body>
	<div class="top col-md-12">
		<div style="position:absolute;z-index:-10000;">Infermap is a free comprehensive platform that improves the college selecting process, based on individual resources and requirements. Inspired by a belief that all students deserve access to good guidance, infermap aims to create the interactive tools and media that guide students as they find, afford and enroll in a college that’s a good fit for them.</div>
		<img src="./img/bg_hexagons.png" id="bg-img" alt="background image">
		<img src="./img/logo.png" id="logo" alt="Infermap logo">
		
		<div id="keyword-text" class="text">Keyword Search</div>
		<img src="./img/keyword%20%20hover.png" id="keyword-img" class="float" alt="keyword search">
		
		<div id="rank-text" class="text">Rank</div>	
		<img src="./img/rank%20hover.png" id="rank-img" class="float" alt="search by rank">
		
		<div id="dept-text" class="text">Department</div>	
		<img src="./img/depart%20%20hover.png" id="depart-img" class="float" alt="search by department">
		
		<div id="guide-text" class="text">My College plan</div>	
		<a href="guide.php"><img src="./img/step%20by%20step.png" id="stepbystep-img" class="float" alt="path finder"></a>
		
		<div id="location-text" class="text">Location</div>	
		<img src="./img/location%20%20hover.png" id="location-img" class="float" alt="location search">

		<img src="./img/arrow.png" id="keyword-point" alt="arrow">
		<img src="./img/arrow.png" id="rank-point" alt="arrow">
		<img src="./img/arrow.png" id="depart-point" alt="arrow">
		<img src="./img/arrow.png" id="stepbystep-point" alt="arrow">
		<img src="./img/arrow.png" id="location-point" alt="arrow">
		
		<div class="login-btn">
		<img src="./img/login.png" id="login-img" class="grow" alt="login image">
			REGISTER
		</div>

		<img src="./img/landing _small.png" alt="Infermap Shaping your career" id="landing-img">
		<img src="./img/search%20box%20hexa.png" id="search-box" alt="search box background">
		<form id="search-content" method="get" action="main.php">
			<br><div class="color-text">
			Start by typing a college name or city or state</div>
			<form class="form" method='post' action="main.php" id="mainform">
				<input class="form-control" name='value' type='text' placeholder='eg: IIT , Mumbai'>
				<input type='hidden' name='search' value='keyword'>
				<button class='btn btn-success' >GO</button>
			</form>
		</form>
		<img src="./img/feedback.png" class="buzz-out" id="feedback-img" alt="feedback-image">
		<img src="./img/about.png" id="about-img" alt="about-image">
		<?php // COMING SOON at bottom of page ?>
		<div class="feedback-back">
			<form class="feedback-box" method="POST" id="feedback-portal">
				<img src="./img/feedback-close.png" id="feedback-close" alt="feedback close button">
				<img src="./img/feedback-left.png" id="feedback-left" alt="feedback left">
				<img src="./img/feedback-right.png" id="feedback-right" alt="feedback right">
				<div class="feedback-inner1">
					Would you recommend infermap to your friends?<br>
					<img src="./img/no%20button.png" id="no-btn" class="feedback-btn" alt="no button">
					<input  type="range" min="1" max="10" value="10" id="feedback-slider" name="rate">					
					<img src="./img/yes%20button.png" id="yes-btn" class="feedback-btn" alt="yes button">
				</div>
				<div class="feedback-inner2">
					<div class="col-md-12">
						Where did you hear about Infermap?
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-Friends" onclick="feedbackNews('Friends');">
						Friends
						</div>
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-College" onclick="feedbackNews('College');">
						College
						</div>
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-Ad" onclick="feedbackNews('Ad');" style="padding-top: 17px;">
						Social-Media
						</div>
					</div>
					<br>
					<div class="col-md-12">
						<input class="form-control" placeholder="other" id="q2input" name="news">
						<input type="hidden" id="q2inputhidden">
					</div>
				</div>
				<div class="feedback-inner3">
					<div class="col-md-12">
						Using Infermap.com is...
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-diff1" onclick="feedbackdifficulty(1);">
						Easy
						</div>
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-diff2" onclick="feedbackdifficulty(2);">
						Normal
						</div>
					</div>
					<div class="col-md-4">
						<div class="round-selector" id="feed-diff3" onclick="feedbackdifficulty(3);">
						Hard
						</div>
					</div>
					<input type="hidden" value=0 name="difficulty" id="feed-difficulty">
					
				</div>
				<div class="feedback-inner4">
					<div class="col-md-12">
						Any feature we could improve upon?
						<textarea class="q2input" id="feedback-feature" name="feature"></textarea>
					</div>
					<div class="col-md-12">
						Tell us if any particular college you want to know about?
						<textarea class="q2input" id="feedback-college"  name="college"></textarea>
					</div>
					<div class="col-md-4 col-md-offset-4">
						<button id="feedback-submit" type="submit">Finish</button>
					</div>
				</div>
			</form>
		</div>
		<?php //REGISTER BLOCK ?>
		<div class="register-back">
			<form class="register-box form-horizontal" method="POST" id="register-portal">
				<div id="reg-head">
					<h4 >Register with us</h4>
					<div id="register-close">
						<i class="fa fa-times"></i>
					</div>
				</div>
				<div class="register-body">
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
						    <input type="email" class="form-control register-input" name="email" required/>
						</div>
					</div>
					<div class="form-group">
							<label class="form-label col-sm-3">Phone: </label>
						<div class="col-sm-9 left-inner-addon ">
						    <i class="fa fa-phone fa-darkinp"></i>
						    <input type="text" class="form-control register-input" name="phone"/>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label col-sm-3">City: </label>
						<div class="col-sm-9 left-inner-addon ">
						    <i class="fa fa-globe fa-darkinp"></i>
						    <input type="text" class="form-control register-input" name="city"/>
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
					<button class="btn btn-register" type="submit">REGISTER</button>

				</div>
			</form>
		</div>
	</div>
	<div class="mobile-top col-md-12">
		<div class="row col-md-12 center-align">
			<img src="./img/logo.png" id="logoph" alt="Infermap logo">
		</div>
		<hr class="col-md-12">
			<h3 class="intro-text">"Your Guide to the right college"</h3>
		<hr class="col-md-12">
		<div class="mycol-md-4 row center-align">
			<label>Keyword Search</label>
			<br>
			<a href="#ask-box"><img src="./img/keyword%20%20hover.png" id="keyword-imgph" class="float" alt="keyword search"></a>
		</div>
		<div class="mycol-md-4 row center-align">
			<label>Rank</label>
			<br>
			<a href="#ask-box"><img src="./img/rank%20hover.png" id="rank-imgph" class="float" alt="search by rank"></a>
		</div>
		<div class="mycol-md-4 row center-align">
			<label>Department</label>
			<br>
			<a href="#ask-box"><img src="./img/depart%20%20hover.png" id="depart-imgph" class="float" alt="search by department"></a>
		</div>
		<div class="mycol-md-6 row center-align">
			<label>My College plan</label>
			<br>
			<a href="guide.php"><img src="./img/step%20by%20step.png" id="stepbystep-imgph" class="float" alt="path finder"></a>
		</div>
		<div class="mycol-md-6 row center-align">
			<label>Location</label>
			<br>
			<a href="#ask-box"><img src="./img/location%20%20hover.png" id="location-imgph" class="float" alt="location search"></a>
		</div>
	</div>
	<form class="ask-box" id="ask-box"  method="get" action="main.php">
		<br>
		<div class="color-text">Start by typing a college name or city or state</div>
		<form class="form" method='post' action="main.php">
		<input class="form-control" required name='value' type='text' placeholder='eg: IIT Mumbai'>
		<input type='hidden' name='search' value='keyword'>
		<button class='btn btn-success' >GO</button></form>
	</form>
	<div class="company-info">
	<p><span class="bqstart">&#8220;</span>Infermap is a free comprehensive platform that 
		improves the college selecting process, based on individual resources and requirements.
		<br>Inspired by a belief that all students deserve access to good guidance, 
		infermap aims to create the interactive tools and media that guide students as 
		they find, afford and enroll in a college that’s a good fit for them.
		<span class="bqend">&#8221;</span></p>
	</div>
	<div class="bottom col-md-12">
		<div class="bottom-content container">
			<div class="blog col-md-6">
				<h3 class="orange">
					Related Blogs
				</h3>
				<div class="article-content col-md-12">
					<div class="beautiful-Heading">
						<a href="http://www.infermap.com/blog/2014/03/related-topics/" target=_blank>The Insight Story Of Premier Engineering Institutes Of India : "<b>The</b>" IITs </a>
					</div>
					<p>Indian Institutes Of Technology are undoubtedly  the most prestigious colleges of engineering 
					in India , giving admissions to the best brains of India . Getting into an IIT for an 
					engineering aspirant is like a roaring milestone . 
					<a href="http://www.infermap.com/blog/2014/03/related-topics/" target=_blank>read more...</a></p> 
				</div>
				<hr style="margin-bottom: 6px;">
				<div class="article-content col-md-12">
					<div class="beautiful-Heading">
						<a href="http://www.infermap.com/blog/2014/03/engineering-career/" target=_blank>Engineering as a career</a>
					</div>
					<p>The American Engineers' Council for Professional Development has defined "Engineering " as:
	 				" The creative application of scientific principles to design or develop structures, machines, apparatus, or manufacturing processes, or works utilizing .
					<a href="http://www.infermap.com/blog/2014/03/engineering-career/" target=_blank>read more...</a></p> 
					
				</div>
				<hr style="margin-bottom: 6px;">
				<div class="article-content col-md-12">
					<div class="beautiful-Heading">
						<a href="http://www.infermap.com/blog/2014/03/need-infermap/" target=_blank>Why we need Infermap?</a>
					</div>
					<p>Well, looking for the right college can be a menace! With the growing number of students 
					pting for engineering and decreasing no of off shore opportunities students finally end
					 up in a wrong college or with a wrong stream. ..
					<a href="http://www.infermap.com/blog/2014/03/need-infermap/" target=_blank>read more...</a></p> 					
				</div>
			</div>
			<div class="testimonials col-md-6">
				<h3 class="orange">
					What People say
				</h3>
				<div class="article-content">
					<div class="col-md-12 test-text" >
						<!--div class="col-md-3">
							<img src="img/saurabh.jpg" class="test-img" alt="Saurav">
						</div>
						<div class="col-md-9"-->
							<div class="col-md-12">
								"Infermap.com is changing the education scene by cutting through the traditional norms and practices."
							</div>
							<div class="speaker col-md-12" style="margin-bottom:10px">
								<b>Saurav Suman , Co-Founder
								<br>timemytask.com</b>
							</div>
						<!--/div-->
					</div>
					<hr style="margin-bottom: 6px;">
					<div class="col-md-12 test-text">
						<!--div class="col-md-3">
							<img src="img/kritagya.jpg" class="test-img" alt="kritagya">
						</div>
						<div class="col-md-9"-->
							<div class="col-md-12">
								"Infermap.com is aimed at transforming college hunting through it’s modern and unique user interface which empowers students with the ability to judge view a college based on hard core data."
							</div>
							<div class="speaker col-md-12">
								<b>Kritagya Tripathi , Chief Operating Officer ,
								 shoesonloose.com</b>
							</div>
						<!--/div-->
					</div>
					<hr style="margin-bottom: 6px;">
					<div class="col-md-12 test-text">
						<!--div class="col-md-3">
							<img src="img/kshitij.jpg" class="test-img" alt="Kshitiz">
						</div>
						<div class="col-md-9"-->
							<div class="col-md-12">
								"Infermap.com is a revolutionized way to help students tame the ‘chaotic’ education scenario in India. Providing such an extensive information to students who are fresh out of their high school, will definitely help them to mold their career."
							</div>
							<div class="speaker col-md-12">
								<b>Kshitij thavre , Chief Technology Officer
								Humming Whale Product Innovations </b>
							</div>
						<!--/div-->
					</div>
				</div>
			</div>
		</div>
		<div class="form-field col-md-12">
			<form class="col-md-8 col-md-offset-2" id="talktous">
				<h2 class="orange-heading" style="margin-left:-12%">
				Talk to us
				</h2>
				<div class="col-md-6 left-inner-addon-form " style="padding-right: 4px;">
				    <i class="glyphicon glyphicon-user"></i>
				    <input type="text" class="form-control form-input" name="name" placeholder="Name" required/>
				</div>
				<div class="col-md-6 left-inner-addon-form " style="padding-left: 4px;">
				    <i class="fa fa-building-o"></i>
				    <input type="text" class="form-control form-input" name="company" placeholder="Company / College"/>
				</div>
				<div class="col-md-6 left-inner-addon-form " style="padding-right: 4px;">
				    <i class="fa fa-envelope"></i>
				    <input type="email" class="form-control form-input" name="email" placeholder="Email" required/>
				</div>
				<div class="col-md-6 left-inner-addon-form " style="padding-left: 4px;">
				    <i class="glyphicon glyphicon-phone-alt"></i>
				    <input type="text" class="form-control form-input" name="phone" placeholder="Phone"/>
				</div>
				<div class="" style="width:100%;padding:12px;">
					<textarea id="tt-message" style="" name="message" required class="form-control form-input" placeholder="Your Message"></textarea> 
				</div>
				<div class="col-md-2 col-md-offset-5">
					<button class="btn btn-form-bottom">Send</button>
				</div>
			</form>
		</div>
		<div class="addressbar col-md-12">
			<div class="col-md-6">
				<div class="col-md-10 col-md-offset-2">
					<h2 class="orange-heading">
						About us
					</h2>
				</div>
				<div class="col-md-10 col-md-offset-2">
					<p><b>Infermap</b> is the hassle free approach to investigate your higher education needs. There is a huge set of factors that govern where one ends up studying, which eventually forge their career. Infermap’s set of tools and filtering options are designed keeping students in mind to help them find what they’re looking for. Our simplified interface and vast structured database makes sure you bag the best seat.
					</p>
				</div>
			</div>
			<div class="col-md-6">
			
				<div style="margin-top: 54px;" class="col-md-12">
					<div  >
						<i class="fa fa-envelope-o fa-2x"></i> <span style="padding:10px;font-size: 17px;"><a class="whitelink" href="mailto:\\help@infermap.com">help@infermap.com</a></span>
					</div>
					<div style="margin-top:30px;">
						<h4>Follow us on :</h4>
					</div>
					<div style="margin-top:15px;">
						<!--div class="fb-like" data-href="https://www.facebook.com/infermap" data-width="20" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div-->
						<a target=_blank class="whitelink" href="https://www.facebook.com/infermap"><i class="grow faicon fa fa-facebook-square fa-2x" ></i> </a>&nbsp;&nbsp;
						<a target=_blank class="whitelink" href="https://plus.google.com/u/0/102559294513459206399/"><i class="faicon fa fa-google-plus-square fa-2x grow" ></i></a> &nbsp;&nbsp;
						<i class="faicon fa fa-twitter-square fa-2x grow" ></i>
					</div>
				</div>
			</div>

		</div>
		<div class="footer">
			<div class="col-md-5">
				<a href="about.php" target="_blank">About us</a> | 
				<a href="FAQ.php" target="_blank">FAQ's</a> | 
				<a href="http://blog.infermap.com" target="_blank">Blog</a> |
				<a href="ambassadordetails.php" target="_blank">Be Campus Ambassador</a> 
			</div>
			<div class="footer-right">
				&copy; Copyright <a href="http://www.infermap.com">Infermap.com</a>
			</div>
		</div>
	</div>
	<?php /*
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=569798279758563";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script> */

?>

	<script src="./data/js/jquery.js"></script>
	<script type="text/javascript" src="data/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	var exams={<?php
			$exam=mysqli_query($con,"select distinct name,category from exam where  active='1' order by name");
			$i=0;
			while($row=mysqli_fetch_assoc($exam))
			{
				if($i!=0)
					echo ",";
				echo "'".$row['name']."':['".$row['name']."',".$row['category']."]";
				$i+=1;
			}
		?>
	}
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
	var departments={<?php
		$q=mysqli_query($con,"select * from departments");
		$i=0;
		while($row=mysqli_fetch_assoc($q))
		{
			if($i>0)
				echo ",";
			echo $row['key'].':"'.$row['value'].'"';
			$i+=1;
		}
	?>
	};
	var states={<?php
	$q=mysqli_query($con,"select distinct state from college_id where state!='' && disabled='1' && state!='--select state--' order by state");
	$i=0;
	while($row=mysqli_fetch_assoc($q))
		{
			if($i>0)
				echo ",";
			echo "'".$row['state']."':[]";
			$i+=1;
		}
	?>};
	<?php
	$q=mysqli_query($con,"select distinct city,state from college_id where city!='' && disabled='1' && state!='--Select State--' order by city");
	$i=0;
	while($row=mysqli_fetch_assoc($q))
		{
			echo "states['".$row['state']."'].push('".$row['city']."');";
			$i+=1;
		}
	?>
	</script>
	<script type="text/javascript" src="js/homepage.js"></script>
	<?php  // GOOGLE ANALYTICS CODE ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-48869263-1', 'infermap.com');
	  ga('send', 'pageview');
	</script>
</body>
