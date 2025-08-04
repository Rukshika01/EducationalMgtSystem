<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location: facultylogin.php');
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include('fhead.php');  ?>

<div class="container">
    <div class="row">
        <?php
        if (isset($_REQUEST['deleteid'])) {
            include("database.php");
            $deleteid = $_GET['deleteid'];
            $sql = "DELETE FROM `query` WHERE Qid = '$deleteid'";

            if (mysqli_query($connect, $sql)) {
                echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Query Details has been deleted.
                    </div>";
            } else {
                echo "<br><Strong>Query Details Updation Failure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
            }
            mysqli_close($connect);
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
         
            <?php
            include("database.php");
            // Modified SQL query to fetch only queries related to the subject code of the faculty
            $sql = "SELECT * FROM query WHERE sub_code IN (SELECT sub_code FROM subjects WHERE FID = '$userid')";
            $result = mysqli_query($connect, $sql);
            // Table to display query details
            echo "<h3 class='page-header'>Query Details</h3>";
            echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>Student's Email</th>
                    <th>Query</th>
                    <th>Answer</th>
                    <th>Actions</th>
                <tr>";
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['Eid']; ?></td>
                    <td><?php echo $row['Query']; ?></td>
                    <td><?php echo $row['Ans']; ?></td>
                    <td>
                        <a href="updatequery.php?gid=<?php echo $row['Qid']; ?>">
                            <input type="button" Value="Answer" class="btn btn-success btn-sm" style="border-radius:0%">
                        </a>
                        <a href="qureydetails.php?deleteid=<?php echo $row['Qid']; ?>">
                            <input type="button" Value="Delete" name="" class="btn btn-danger btn-sm" style="border-radius:0%">
                        </a>
                    </td>
                </tr>
            <?php $count++;
            } ?>
            </table>
        </div>
    </div>
    <?php include('allfoot.php');  ?>
