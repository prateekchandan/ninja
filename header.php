<?
  if(isset($_HEADER['dir'])){
    $a=$_HEADER['dir'];
    switch ($a) {
      case '1':
        $dir='..';
        break;
      case '2':
        $dir='../..';
        break;
      case '3':
        $dir='../../..';
        break;
      default:
        $dir='.';
        break;
    }
  }
  else
    $dir='.';

?>

<style type="text/css">
   @font-face {
      font-family: we_are_hiring;
    src: url(<?php echo $dir; ?>/data/css/fonts/BebasNeue.otf);
    }
    .navbar-infermap{
    background-color: #02294A;
    color: #f4f4f4;
    margin: 0px;
    border:0px solid #02294b;
    border-radius: 0px;
    color: #fff;
    }
    .navbar-infermap>div,.navbar-infermap>div>div{
    }
    .nav>li>a{
      color: #428bca !important;
      font-family: we_are_hiring;
      font-size: 16px;
      letter-spacing: 1px;
    }
    .navbar-main>li>a{
      color: white !important;
      height: 50px;
    padding-right: 10px;
    padding-left: 10px;
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
    .navbar-main>li:last-child>a{
      border-right: 1px solid #c6cac6;
    }
    .navbar-main>li{
      -o-transition:.3s;
      -ms-transition:.3s;
      -moz-transition:.3s;
      -webkit-transition:.3s;
    }
    .navbar-main>li:hover{
      background: #fff;
    }
    .navbar-main>li>a:hover{
       color:#428bca !important;
    }
    .twitter-typeahead{
      width: 150%;
    }
    .typeahead{
      border-radius: 0px;
      box-shadow: none;
      border: 0px;
    }
    .typeahead:focus{
      box-shadow: none;
      border: 0px;
    }
    .btn-search{
      border-radius: 0px;
      margin-left: 80px;
      color: #999;
      min-height: 34px;
    }
    .btn-search:hover{
      background: #fff;
    }
    .tt-dropdown-menu{
    color: #888 !important;
    background: white !important;
    border: 1px solid #eee !important;
    width:100% !important;
    }
    .tt-suggestion{
    border-bottom:1px solid #ddd;
     padding-left: 11px !important;
    }
    .navbar-brand{
      padding-right:110px !important;
    }
    .brand-image{
      position: absolute;
      top:0px;
      left: 100px;
      z-index: 10000;
      height: 100px;
    }
    .container-fluid{
      max-width: 1140px;
      margin: auto;
    }
 </style>
    <a href="http://www.infermap.com"><img src="<?echo $dir;  ?>/img/logo-header.png" class="brand-image"></a>
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
          <a class="navbar-brand" href="#">.</a>
        </div>

        <!-- Collect the nav links,deorms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-main">
            <li><a href="<?echo $dir;  ?>/main.php">College Search</a></li>
            <li ><a href="<?echo $dir;  ?>/compare.php">Compare Colleges</a></li>
            <li><a href="<?echo $dir;  ?>/guide.php">My College Plan</a></li>
            <li><a href="<?echo $dir;  ?>/career_counselling">Career Counselling</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <form class="navbar-form navbar-left" role="search" method="GET" action="<?echo $dir;  ?>/main.php">
                <div class="form-group">
                  <input type="hidden" name="search" value="keyword">
                  <input type="text" class="form-control typeahead" placeholder="Search"  name="value" placeholder="Search a college">
                </div>
                <button type="submit" class="btn btn-default btn-search"><i class="glyphicon glyphicon-search"></i></button>
              </form>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <script src="<?echo $dir; ?>/data/js/jquery.js"></script>
<script type="text/javascript" src="<?echo $dir; ?>/js/typeahead.js"></script>
<script type="text/javascript">
 var bestPictures = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: '<?echo $dir; ?>/college.json',
  remote: '<?echo $dir; ?>/college.json'
});
 
bestPictures.initialize();
 
$('.typeahead').typeahead(null, {
  name: 'best-pictures',
  displayKey: 'value',
  source: bestPictures.ttAdapter()
});
</script>