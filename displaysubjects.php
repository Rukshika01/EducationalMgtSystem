<?php
session_start();
 
if (!isset($_SESSION["sidx"])) {
    header('Location: studentlogin.php');
    exit;
}

$userid = $_SESSION[ "sidx" ];
$userfname = $_SESSION[ "fname" ];
$sEno = $_SESSION[ "seno" ];
$userlname = $_SESSION[ "lname" ];

// Retrieve the selected subject code from the URL parameter
if (isset($_GET['sub_code'])) {
    $_SESSION['selected_sub_code'] = $_GET['sub_code'];
}
// Retrieve the selected subject code from the session
if (isset($_SESSION['selected_sub_code'])) {
    $selected_subject_code = $_SESSION['selected_sub_code'];

    // Connect to your database
    include("database.php");

    // Close the database connection
    mysqli_close($connect);
}
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
        
    </style>
    
</head>
<body >


<!-- Header section -->
<header class="header-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
            <div class="site-logo">
    <a href="index.html">
        <img src="img/Capture.JPG" alt="Edu Dive">
    </a>
</div>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="logoutstudent" type="submit" style="color: #00d1cc;font-weight: bolder;">Logout</a> 
                        

                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Header section end -->
<section class="categories-section spad" >
    <div class="container">
        <div class="section-title">
        <h3 style="padding-top:64px;"> Welcome! <?php echo "<span style='color:#00d1cc'>".$userfname." ".$userlname."</span>";?>, Please Choose a Subject</h3>
          
            <p>Choose one of the below subjects that you need to proceed your learning and practice with!</p>
        </div>
        <div class="row">
            <!-- categorie -->
            <?php
            // Loop through subjects and display them
            $subjects = array(
                array("sub_code" => "3000", "name" => "Maths", "description" => "Mathematics is the language of patterns and relationships, applied across various disciplines and everyday life.", "image" => "img/categories/1.jpg"),
                array("sub_code" => "2000", "name" => "History", "description" => "History is the study of past events, shaping our understanding of societies, cultures, and human progress.", "image" => "img/categories/5.jpg"),
                array("sub_code" => "1000", "name" => "Science", "description" => "Science is an application of knowledge and understanding of the natural and social world.", "image" => "img/categories/2.jpg"),
                array("sub_code" => "4000", "name" => "IT", "description" => "IT is the application of computer systems and telecommunications to store, retrieve, transmit, and manipulate data.", "image" => "img/categories/3.jpg"),
                array("sub_code" => "5000", "name" => "Health", "description" => "Health is the knowledge and practices aimed at maintaining and improving physical, mental, and social well-being.", "image" => "img/categories/4.jpg"),
                array("sub_code" => "6000", "name" => "Business", "description" => "Business is the study of organizations, markets, and strategies to understand how goods and services are produced.", "image" => "img/categories/6.jpg")
            );
            foreach ($subjects as $subject) {
                ?>
                <div class="col-lg-4 col-md-4">
                    <div class="categorie-item">
                        <a href="welcomestudent.php?sub_code=<?php echo $subject['sub_code']; ?>">
                            <div class="ci-thumb set-bg" data-setbg="<?php echo $subject['image']; ?>"></div>
                            <div class="ci-text">                            
                                <h5><?php echo $subject['name']; ?></h5>
                                <p><?php echo $subject['description']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<!--====== Javascripts & Jquery ======-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/circle-progress.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
