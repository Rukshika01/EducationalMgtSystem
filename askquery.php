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

        // Retrieve email ID from GET parameter
        $eid = $_GET['eid']; //get data from another page

        if (isset($_POST['addq'])) {
            // Fetch data from form
            $tempsquery = $_POST['squeryx'];

            // Insert query into database
            $sql = "INSERT INTO `query`(`Query`, `Eid`, `sub_code`) VALUES ('$tempsquery','$eid','$selected_subject_code')";
            if (mysqli_query($connect, $sql)) {
                echo "<br><br><br>
                <div class='alert alert-success fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Your Query Added Successfully. Ref. No: " . mysqli_insert_id($connect) . "
                </div>";
            } else {
                // Error message if SQL query fails
                echo "<br><Strong>Query Adding Failure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
            }
            // Close the connection
            mysqli_close($connect);
        }
    } else {
        // If no subject code is selected
        echo "Please select a subject first.";
    }
?>

<?php include('studenthead.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-8">
        <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="POST" name="update">
                            <fieldset>
                                <legend>Query Details</legend>
                                <table>
                                    <tr>
                                        <td><strong>Email ID :</strong></td>
                                        <td><strong><?php echo $eid; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong><h3>Query :</h3></strong></td>
                                        <td><textarea rows="10" cols="40" name="squeryx" class="form-control" required></textarea></td>
                                    </tr>
                                </table>
                                <br>
                                <input type="submit" value="Submit My Query" name="addq" style="border-radius:0%" class="btn btn-success">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>

<?php include('allfoot.php'); ?>
