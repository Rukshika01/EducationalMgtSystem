<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location: facultylogin.php');
    exit;
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
$subject_code = $_SESSION["subject_code"];

// Include database connection
include('database.php');

// Fetch the subject code associated with the logged-in faculty
$sql = "SELECT sub_code FROM facutlytable WHERE FID = '$userid'";
$result = mysqli_query($connect, $sql);

if (!$result) {
    // If the query fails, display the error message
    echo "Error: " . mysqli_error($connect);
    exit; // Stop execution
}

if (mysqli_num_rows($result) > 0) {
    // If a row is found, fetch the subject code
    $row = mysqli_fetch_assoc($result);
    $subject_code = $row['sub_code'];
} else {
    // If no row is found, display a message
    echo "No subject code associated with the faculty.";
    exit; // Stop execution
}



mysqli_close($connect); // Close the database connection
?>

<?php include('fhead.php');  ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">

            <h3> Welcome Faculty : <a href="welcomefaculty.php" ><span style="color:#FF0004"> <?php echo $fname; ?></span></a> </h3>
            <!-- Display the subject code associated with the faculty -->
            <h4>Subject Code: <?php echo $subject_code; ?></h4>
            <a href="addvideos.php?sub_code=<?php echo $subject_code; ?>"><button  href="" type="submit" class="btn btn-primary" style="border-radius:0%">Add Videos</button></a>
            <a href="managevideos.php?sub_code=<?php echo $subject_code; ?>"><button  href="" type="submit" class="btn btn-primary" style="border-radius:0%">Manage Videos</button></a>
        </div>
    </div>
</div>
<?php include('allfoot.php');  ?>
