<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
    header('Location:studentlogin');
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];

// Include database connection
include('database.php');

// Retrieve the selected subject code from the session
if (isset($_SESSION['selected_sub_code'])) {
    $selected_subject_code = $_SESSION['selected_sub_code'];

    // Query to fetch assessments corresponding to the selected subject code
    $sql = "SELECT * FROM examdetails WHERE sub_code = '$selected_subject_code'";
    $result = mysqli_query($connect, $sql);

    // Check if there are assessments available
    if (mysqli_num_rows($result) > 0) {
?>
        <?php include('studenthead.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">
                   
                    <h2 class='page-header'>Take Assessment</h2>
                    <table class='table table-striped table-hover' style='width:100%'>
                        <tr>
                            <th>#</th>
                            <th>Assessment Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $row['ExamName'];?></td>
                                <td>
                                    <a href="takeassessment2.php?exid=<?php echo $row['ExamID']; ?>">
                                        <button type="submit" class="btn btn-success" style="border-radius:0%">Start</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </table>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
        <?php include('allfoot.php'); ?>
        <?php
    } else {
        // No assessments available for this subject
        echo "<h2>No Assessment available for this subject.</h2>";
    }
} else {
    // If no subject code is selected
    echo "Please select a subject first.";
}
?>
