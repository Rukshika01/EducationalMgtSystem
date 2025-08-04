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

    // Query to fetch videos corresponding to the selected subject code
    $sql = "SELECT * FROM video WHERE sub_code = '$selected_subject_code'";
    $result = mysqli_query($connect, $sql);

    // Check if there are videos available
    if (mysqli_num_rows($result) > 0) {
?>
        <?php include('studenthead.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php
                    include('database.php');
                    echo "<h2 class='page-header'>Videos Details</h2>";
                    echo "<table class='table table-striped table-hover' style='width:100%'>
                        <tr>
                            <th>#</th>
                            <th>Video Title</th>
                            <th>Description</th>
                            <th>View</th>
                        </tr>";
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td>
                                <?php echo $row['V_Title']; ?>
                            </td>
                            <td>
                                <?php echo $row['V_Remarks']; ?>
                            </td>
                            <td>
                                <a href="viewvideos2.php?viewid=<?php echo $row['V_id']; ?>">
                                    <button class="btn btn-info btn-sm" style="border-radius:0%">View</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include('allfoot.php');  ?>
    <?php
    } else {
        // No videos available for this subject
        echo "<h2>No videos available for this subject.</h2>";
    }
} else {
    // If no subject code is selected
    echo "Please select a subject first.";
}
?>
