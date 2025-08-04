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

    // Query to fetch assessment details for the faculty's subject code
    $sql_assessment = "SELECT * FROM examdetails WHERE sub_code = '$subject_code'";
    $result_assessment = mysqli_query($connect, $sql_assessment);

    if (!$result_assessment) {
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

            <?php
            if (isset($_REQUEST['deleteid'])) {
                //getting data from another page
                $deleteid = $_GET['deleteid'];
                $sql_delete = "DELETE FROM `examdetails` WHERE ExamID = $deleteid";
                if (mysqli_query($connect, $sql_delete)) {
                    echo "
                        <br><br>
                        <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Assessment details deleted.
                        </div>
                    ";
                } else {
                    //error message if SQL query fails
                    echo "<br><Strong>Assessment Details Updation Failure. Try Again</strong><br> Error Details: " . $sql_delete . "<br>" . mysqli_error($connect);
                }
            }
            
            ?>
<br>
<a href="addassessment.php?sub_code=<?php echo $subject_code; ?>" class="btn btn-primary btn-square">
                     Add Assessment
                </a>
            <?php
            if (mysqli_num_rows($result_assessment) > 0) {
                echo "<h2 class='page-header'>Assessment Details</h2>"; 
                echo "<table class='table table-striped table-hover' style='width:100%'>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Ques.1</th>
                        <th>Ques.2</th>
                        <th>Ques.3</th>
                        <th>Ques.4</th>
                        <th>Ques.5</th>
                        <th>Actions</th>
                    </tr>";
                $cnt = 1;
                while ($row = mysqli_fetch_array($result_assessment)) {
                    ?>
                    <tr>
                        <td><?PHP echo $cnt; ?></td>
                        <td><?PHP echo $row['ExamName']; ?></td>
                        <td><?PHP echo $row['Q1']; ?></td>
                        <td><?PHP echo $row['Q2']; ?></td>
                        <td><?PHP echo $row['Q3']; ?></td>
                        <td><?PHP echo $row['Q4']; ?></td>
                        <td><?PHP echo $row['Q5']; ?></td>
                        <td>
                            <a href="manageassessment.php?deleteid=<?php echo $row['ExamID']; ?>">
                                <input type="button" Value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal">
                            </a>
                            <a href="manageassessment2.php?editassid=<?php echo $row['ExamID']; ?>">
                                <input type="button" Value="Edit" class="btn btn-success btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal">
                            </a>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
                }
                echo "</table>";
            } else {
                // No assessments available for this subject
                echo "No Assessment details available for the subject.";
            }
            ?>
        </div>
    </div>
</div>
<?php include('allfoot.php');  ?>
