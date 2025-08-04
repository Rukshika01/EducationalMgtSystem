<?php
session_start();
 
if (!isset($_SESSION["pidx"])) {
    header('Location: parentlogin.php');
    exit;
}

$userid = $_SESSION["pidx"];
$userfname = $_SESSION["pname"];
$sEno = $_SESSION["seno"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edu Dive</title>
    <meta charset="UTF-8">
    <meta name="description" content="WebUni Education Template">
    <meta name="keywords" content="webuni, education, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->   
    <link href="img/Capture.JPG" rel="shortcut icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/style.css"/>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
        body {
           
            margin: 0; 
            padding: 0;
        }
        .header-section {
            background-color: #444444;
            padding-bottom: 40px;
            color: #fff; 
        }
        .site-logo img {
            max-width: 100%; }
       .categorie-item:hover{
		background-color:#9bc9ff !important;
	   }
	   .categorie-item{
		background: #b3b3b3;
	   }
	.site-footer
{
  background-color:#26272b;
  padding:45px 0 20px;
  font-size:15px;
  line-height:24px;
  color:#737373;
}
.site-footer hr
{
  border-top-color:#bbb;
  opacity:0.5
}
.site-footer hr.small
{
  margin:20px 0
}
.site-footer h6
{
  color:#fff;
  font-size:16px;
  text-transform:uppercase;
  margin-top:5px;
  letter-spacing:2px
}
.site-footer a
{
  color:#737373;
}
.site-footer a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links
{
  padding-left:0;
  list-style:none
}
.footer-links li
{
  display:block
}
.footer-links a
{
  color:#737373
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links.inline li
{
  display:inline-block
}
.site-footer .social-icons
{
  text-align:right
}
.site-footer .social-icons a
{
  width:40px;
  height:40px;
  line-height:40px;
  margin-left:6px;
  margin-right:0;
  border-radius:100%;
  background-color:#33353d
}
.copyright-text
{
  margin:0
}
@media (max-width:991px)
{
  .site-footer [class^=col-]
  {
    margin-bottom:30px
  }
}
@media (max-width:767px)
{
  .site-footer
  {
    padding-bottom:0
  }
  .site-footer .copyright-text,.site-footer .social-icons
  {
    text-align:center
  }
}
.social-icons
{
  padding-left:0;
  margin-bottom:0;
  list-style:none
}
.social-icons li
{
  display:inline-block;
  margin-bottom:4px
}
.social-icons li.title
{
  margin-right:15px;
  text-transform:uppercase;
  color:#96a2b2;
  font-weight:700;
  font-size:13px
}
.social-icons a{
  background-color:#eceeef;
  color:#818a91;
  font-size:16px;
  display:inline-block;
  line-height:44px;
  width:44px;
  height:44px;
  text-align:center;
  margin-right:8px;
  border-radius:100%;
  -webkit-transition:all .2s linear;
  -o-transition:all .2s linear;
  transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
  color:#fff;
  background-color:#29aafe
}
.social-icons.size-sm a
{
  line-height:34px;
  height:34px;
  width:34px;
  font-size:14px
}
.social-icons a.facebook:hover
{
  background-color:#3b5998
}
.social-icons a.twitter:hover
{
  background-color:#00aced
}
.social-icons a.linkedin:hover
{
  background-color:#007bb6
}
.social-icons a.dribbble:hover
{
  background-color:#ea4c89
}
@media (max-width:767px)
{
  .social-icons li.title
  {
    display:block;
    margin-right:0;
    font-weight:600
  }
}

    </style>
    
</head>
<body >


<!-- Header section -->
<header class="header-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
            <div class="site-logo">
    <a href="">
        <img src="img/Capture.JPG" alt="Edu Dive">
    </a>
</div>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav navbar-right" style="padding-top:40px;">
				<a href="parentdetails.php?myds=<?php echo $userid; ?>"> 
                <button type="submit" style="color: #00d1cc;font-weight: bolder;background-color:#444;"> 
                    My Profile
                </button>
				<a href="welcomeparent.php" style="color: #00d1cc;font-weight: bolder;padding-right:20px;padding-left:20px;">Home</a>                     
						<a href="logoutparent" type="submit" style="color: #00d1cc;font-weight: bolder;padding-left:20px;">Logout</a> 
						
                </ul>
            </div>
            </div>
        </div>
    </div>
</header>

<!-- Header section end -->
<br><br><br>
<!-- Categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
		<h3> Welcome! <?php echo "<span style='font-weight:bolder'>" . $userfname ."</span>"; ?></h3>
       <p> Your children are about to embark on an exciting journey of learning and discovery. Here at Edu Dive, we strive to provide them with the best possible educational experience.</p> 
        </div>
        <div class="row">
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
    <div class="categorie-item">
        <div class="ci-thumb set-bg" data-setbg="img/p-viewresult.jpg"></div>
        <div class="ci-text">
		<a href="viewresultsparent.php?seno=<?php echo $sEno; ?>"style="display: block; text-align: center; font-weight: bold;"><i class="fa fa-file"></i> View Results</button> </a>
        </div>
    </div>
</div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="img/p-student.webp"></div>
                    <div class="ci-text">
					<a href="parentstudentdetails.php?myds=<?php echo $userid; ?>"style="display: block; text-align: center; font-weight: bold;"><i class="fa fa-video-camera"></i> View Students Profile</button></a>
                    </div>
                </div>
            </div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="img/p-assessment.jpg"></div>
                    <div class="ci-text">
					<a href="parent_assessment.php?myds=<?php echo $userid; ?>"style="display: block; text-align: center; font-weight: bold;"><i class="fa fa-video-camera"></i> View Students Assessments</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories section end -->
<h2 style="text-align: center;">Thank you! for choosing Edu Dive for your Childs education.</h2><br><br>
 <!-- Site footer -->
 <footer class="site-footer">
	<div class="container">
	  <div class="row">
		<div class="col-sm-12 col-md-6">
		  <h6>About</h6>
		  <p class="text-justify">Edu Dive is designed to provide you with the tools and resources you need to succeed in your educational journey. Whether you're a student looking to supplement your studies or a professional seeking to expand your skillset, Edu Dive offers high-quality content curated by experts in their fields.</p>
		</div>
		<div class="col-xs-6 col-md-3">
		 
		</div>

		<div class="col-xs-6 col-md-3">
		  <h6>Contacts</h6>
		  <ul class="contact-list">
			<li>+94768392748</li>
			<li>edudive@gmail.com</li>
		</ul>
		</div>
	  </div>
	  <hr>
	</div>
	<div class="container">
	  <div class="row">
		<div class="col-md-8 col-sm-6 col-xs-12">
			<div class="copyright" style="text-align: center;">
				Copyright &copy;<script >document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa fa-heart-o" aria-hidden="true" ></i> by Edu Dive</div>
						</div>
		</div>
	  </div>
	</div>
</footer>

<!--====== Javascripts & Jquery ======-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/circle-progress.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
