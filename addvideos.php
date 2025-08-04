<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location:facultylogin.php');
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include('fhead.php');  ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <br>
            <?php
            include("database.php");
            if (isset($_POST['submit'])) {
                $title = $_POST['videotitle'];
                $v_url = $_POST['VideoURL'];
                $v_info = $_POST['Videoinfo'];

                // Get the subject code of the faculty
                $sql_subcode = "SELECT sub_code FROM subjects WHERE FID = '$userid'";
                $result_subcode = mysqli_query($connect, $sql_subcode);
                if (!$result_subcode) {
                    die('Error fetching sub_code: ' . mysqli_error($connect));
                }
                $row_subcode = mysqli_fetch_assoc($result_subcode);
                $sub_code = $row_subcode['sub_code'];

                $done = "<center>
                            <div class='alert alert-success fade in' style='margin-top:10px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
                                <strong><h3 style='margin-top: 10px;margin-bottom: 10px;'> Video added successfully.</h3></strong>
                            </div>
                        </center>";

                $sql = "INSERT INTO `video` (`V_Title`, `V_Url`, `V_Remarks`, `sub_code`) VALUES ('$title', '$v_url', '$v_info', '$sub_code')";
                // Execute the query
                if (mysqli_query($connect, $sql)) {
                    echo $done;
                } else {
                    echo 'Error: ' . mysqli_error($connect);
                }
            }
            ?>
            <fieldset>
                <legend>Add Videos</legend>
                <form action="" method="POST" name="AddAssessment">
                    <table class="table table-hover">
                        <tr>
                            <td><strong>Video Title</strong></td>
                            <td><input type="text" class="form-control" name="videotitle"></td>
                        </tr>
                        <tr>
                            <td><strong>Video URL: Embedded Code</strong></td>
                            <td><textarea name="VideoURL" class="form-control" rows="1" cols="150"></textarea></td>
                        </tr>
                        <tr>
                            <td><strong>Video Description</strong></td>
                            <td><textarea name="Videoinfo" class="form-control" rows="5" cols="150"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" name="submit" class="btn btn-success" style="border-radius:0%">Add Video</button></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
    <?php include('allfoot.php');  ?>
