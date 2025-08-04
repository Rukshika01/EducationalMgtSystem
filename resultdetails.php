<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location:facultylogin');
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include('fhead.php');  ?>

<div class="container">
    <div class="row">
        <?php
        include("database.php");
        if (isset($_REQUEST['deleteid'])) {
            $deleteid = $_GET['deleteid'];
            //below query will delete result details from result table
            $sql = "DELETE FROM `result` WHERE RsID = $deleteid";
            if (mysqli_query($connect, $sql)) {
                echo "
    <br><br>
    <div class='alert alert-success fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Success!</strong> Result details deleted.
    </div>
    ";
            } else {
                //error message if SQL query fails
                echo "<br><Strong>Result Details Deletion Failure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
            }
        }

        // Fetch only the results associated with the sub_code of the faculty
        $sql = "SELECT * FROM result WHERE Eno IN (SELECT Eno FROM result WHERE Sub_code IN (SELECT Sub_code FROM subjects WHERE FID = '$userid'))";
        $rs = mysqli_query($connect, $sql);

        if ($rs) {
            if (mysqli_num_rows($rs) > 0) {
                echo "<h2 class='page-header'>Result Details</h2>";
                echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                <th>Result ID</th>
                <th>Enrolment No.</th>
                <th>Result</th>
                <th>Actions</th>        
                </tr>";
                while ($row = mysqli_fetch_array($rs)) {
                    ?>
                    <tr>
                        <td><?php echo $row['RsID']; ?></td>
                        <td><?php echo $row['Eno']; ?></td>
                        <td><?php if ($row['Marks'] == 'Pass') {
                                echo '<div style="color:green;"><b>' . $row['Marks'];
                            } else if ($row['Marks'] == 'Fail') {
                                echo '<div style="color:red;"><b>' . $row['Marks'];
                            } else {
                                echo '<b>' . $row['Marks'];
                            } ?>
                        </td>
                        <td><a href="updateresultdetails.php?editid=<?php echo $row['RsID']; ?>"><input type="button" Value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"></a>
                            <a href="resultdetails.php?deleteid=<?php echo $row['RsID']; ?>"><input type="button" Value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%"></a>
                        </td>
                    </tr>
            <?php
                }
                echo "</table>";
            } else {
                // No results for this subject
                echo "<h2>No results yet for this subject</h2>";
            }
        } else {
            // Display error if the query fails
            echo "Error: " . mysqli_error($connect);
        }
        ?>

    </div>

</div>

<?php include('allfoot.php');  ?>
