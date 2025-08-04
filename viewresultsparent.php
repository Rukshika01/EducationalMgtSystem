<?php
session_start();

// Check if the parent is logged in
if (!isset($_SESSION["pidx"]) || empty($_SESSION["pidx"])) {
    header('Location: parentlogin.php');
    exit;
}

// Include database connection
include('database.php');

// Get the parent's ENo from the session
$parent_id = $_SESSION['pidx'];

// Query to fetch assessments corresponding to the parent's ENo
$sql = "SELECT r.*, s.sub_name 
        FROM result r 
        INNER JOIN subjects s ON r.sub_code = s.sub_code 
        WHERE r.Eno IN (SELECT Eno FROM parent WHERE parent_id = '$parent_id')";

$result = mysqli_query($connect, $sql);

// Check if there are assessments available
if ($result && mysqli_num_rows($result) > 0) {
    include('parenthead.php');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="page-header">Result View</h2>
                <table class="table table-striped table-hover" style="width:100%">
                    <tr>
                        <th>#</th>
                        <th>Result ID</th>
                        <th>Enrolment Number</th>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                    <?php
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['RsID']; ?></td>
                            <td><?php echo $row['Eno']; ?></td>
                            <td><?php echo $row['sub_name']; ?></td>
                            <td><?php echo ($row['Marks'] == 'Pass') ? '<span style="color:green;"><b>' . $row['Marks'] : '<span style="color:red;"><b>' . $row['Marks']; ?></td>
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
    echo "<h2>No Results available for this subject.</h2>";
}

?>
