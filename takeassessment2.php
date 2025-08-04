<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
    header('Location:studentlogin.php');
}
$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];
$sEno = $_SESSION["seno"];
$sname = $userfname . " " . $userlname; // Concatenate first and last name to get full name
?>
<?php include('studenthead.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <br>
            <?php
            $exid = $_GET['exid'];
            include('database.php');
            $sql = "SELECT * FROM studenttable WHERE Eno='$sEno'";
            $sql2 = "SELECT * FROM examdetails WHERE ExamID='$exid'";

            $result = mysqli_query($connect, $sql);
            $result2 = mysqli_query($connect, $sql2);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <fieldset>
                    <legend>Assessment Details</legend>
                    <form action="" method="POST" name="update">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td><strong>Enrolment Number :</strong></td>
                                    <td><?php echo $row['Eno']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Student's Name :</strong></td>
                                    <td><?php echo $row['FName']." ".$row['LName']; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td><strong>Exam ID :</strong></td>
                                    <td><?php echo $exid; ?><br></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <br>
                        <hr>
                        <?php
                    }
                    while ($row = mysqli_fetch_array($result2)) {
                    ?>
                        <div class="col-md-12">
                            <span style="color: red;"><h3>Answer The Following Questions..</h3></span>

                            <br>
                            <div>
                                <h4> <strong>Q1. <?php echo $row['Q1']; ?></strong></h4>
                                <div><textarea name="Q1" rows="5" class="form-control" cols="150" required></textarea></div>
                            </div>
                            <br>
                            <div>
                                <h4> <strong>Q2. <?php echo $row['Q2']; ?></strong></h4>
                                <div><textarea name="Q2" rows="5" class="form-control" cols="150" required></textarea></div>
                            </div>
                            <br>
                            <div>
                                <h4> <strong>Q3. <?php echo $row['Q3']; ?></strong></h4>
                                <div><textarea name="Q3" rows="5" class="form-control" cols="150" required></textarea></div>
                            </div>
                            <br>
                            <div>
                                <h4> <strong>Q4. <?php echo $row['Q4']; ?></strong></h4>
                                <div><textarea name="Q4" rows="5" class="form-control" cols="150" required></textarea></div>
                            </div>
                            <br>
                            <div>
                                <h4> <strong>Q5. <?php echo $row['Q5']; ?></strong></h4>
                                <div><textarea name="Q5" rows="5" class="form-control" cols="150" required></textarea></div>
                            </div>
                            <br>
                        </div>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="sname" value="<?php echo $sname; ?>">
                    <br><br>
                    <button type="submit" name="done" class="btn btn-success" style="border-radius:0px;">Submit Answers</button>
                    <?php
                    if (isset($_POST['done'])) {
                        $Ex_id = $exid;
                        $sEno = $sEno;
                        $sname = $_POST['sname'];
                        $tempq1 = $_POST['Q1'];
                        $tempq2 = $_POST['Q2'];
                        $tempq3 = $_POST['Q3'];
                        $tempq4 = $_POST['Q4'];
                        $tempq5 = $_POST['Q5'];

                        // Get the sub_code associated with the exam
                        $sql_subcode = "SELECT sub_code FROM examdetails WHERE ExamID = '$Ex_id'";
                        $result_subcode = mysqli_query($connect, $sql_subcode);
                        if (!$result_subcode) {
                            die('Error fetching sub_code: ' . mysqli_error($connect));
                        }
                        $row_subcode = mysqli_fetch_assoc($result_subcode);
                        $sub_code = $row_subcode['sub_code'];

                        $sql = "INSERT INTO `examans`(ExamID, Senrl, Sname, Ans1, Ans2, Ans3, Ans4, Ans5, sub_code) VALUES ($Ex_id,'$sEno','$sname','$tempq1','$tempq2','$tempq3','$tempq4','$tempq5', '$sub_code')";
                        if (mysqli_query($connect, $sql)) {
                            echo "<br><br><div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Assessment Have Submitted.</div>";
                        } else {
                            //error message if SQL query fails
                            echo "<br><Strong>Assessment Submitting Failure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
                        }
                        //close the connection
                        mysqli_close($connect);
                    }
                    ?>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
    <?php include('allfoot.php'); ?>
