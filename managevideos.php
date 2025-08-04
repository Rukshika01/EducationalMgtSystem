<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location: facultylogin.php');
    exit;
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

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

    // Fetch the videos associated with the subject code of the logged-in faculty
    $videos_sql = "SELECT * FROM video WHERE sub_code = '$subject_code'";
    $videos_result = mysqli_query($connect, $videos_sql);

    if (!$videos_result) {
        // If the query fails, display the error message
        echo "Error: " . mysqli_error($connect);
        exit; // Stop execution
    }
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
        <div class="col-md-12">
          <br>
            <a href="addvideos.php?sub_code=<?php echo $subject_code; ?>" class="btn btn-primary btn-square">
                    <i class="fa fa-video-camera"></i> Add Videos
                </a>
            <?php
            // Display videos only if they are found
            if (mysqli_num_rows($videos_result) > 0) {
                echo "<h2 class='page-header'>Manage Videos Details</h2>";
                echo "<table class='table table-striped' style='width:100%'>
                    <tr>
                        <th>#</th>
                        <th>Video Title</th>
                        <th>Video URL</th>
                        <th>Description</th>
                        <th>Actions</th>      
                    </tr>";
                $count = 1;
                while ($row = mysqli_fetch_array($videos_result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $row['V_Title']; ?>
                        </td>
                        <td>
                            <?php echo $row['V_Url']; ?>
                        </td>
                        <td>
                            <?php echo $row['V_Remarks']; ?>
                        </td>
                        <td>
                            <a href="managevideos.php?deleteid=<?php echo $row['V_id']; ?>"> <input type="button" Value="Delete"  class="btn btn-danger btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal"></a>
                            <a href="managevideos2.php?editassid=<?php echo $row['V_id']; ?>"> <input type="button" Value="Edit"  class="btn btn-success btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal"></a>

                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                echo "</table>";
            } else {
                // If no videos found for the subject code
                echo "No videos found for the subject code: " . $subject_code;
            }
            ?>
        </div>
    </div>
</div>
<?php include('allfoot.php');  ?>
