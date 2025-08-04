
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->   
    <link href="img/Capture.JPG" rel="shortcut icon"/>
    <title>Edu Dive</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/ 5shiv/3.7.0/ 5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {

            background-size: cover; 
            background-repeat: no-repeat; 
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        .header-section {
            background-color: #444444;
            padding-bottom: 40px;
            color: #fff; /* Adjust text color as needed */
        }
        .site-logo img {
            max-width: 100%; /* Adjust logo size as needed */
        }
        
    </style>
    
</head>
<body style="overflow-x: hidden;">

<!-- Header section -->
<header class="header-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
            <div class="site-logo">
    <a href="welcomefaculty.php">
        <img src="img/Capture.JPG" alt="Edu Dive">
    </a>
</div>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav navbar-right" style="padding-top:40px;">
                    
                        <a href="welcomefaculty.php" style="color: #00d1cc;font-weight: bolder;padding-right:20px;">Home</a> 
                        <button onclick="goBack()" style="color: #00d1cc;font-weight: bolder;background-color:#444;">Go Back</button>
                </ul>
            </div>
        </div>
    </div>

</header>
<!-- Header section end -->

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
        function goBack() {
            window.history.back();
        }
        
    </script>
</body>
</html>
