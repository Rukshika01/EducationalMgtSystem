<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
    header('Location:facultylogin');
    exit(); // Stop further execution
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include('database.php');

$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['submit'] as $EAnsID => $value) {
        // Get form data
        $Ans1_status = mysqli_real_escape_string($connect, $_POST['Ans1_status_'.$EAnsID]);
        $Ans2_status = mysqli_real_escape_string($connect, $_POST['Ans2_status_'.$EAnsID]);
        $Ans3_status = mysqli_real_escape_string($connect, $_POST['Ans3_status_'.$EAnsID]);
        $Ans4_status = mysqli_real_escape_string($connect, $_POST['Ans4_status_'.$EAnsID]);
        $Ans5_status = mysqli_real_escape_string($connect, $_POST['Ans5_status_'.$EAnsID]);
        $PassFail = mysqli_real_escape_string($connect, $_POST['PassFail_'.$EAnsID]);

        // Get sub_code from the logged-in faculty
        $sub_code_query = "SELECT sub_code FROM subjects WHERE FID = '$userid'";
        $sub_code_result = mysqli_query($connect, $sub_code_query);
        $row_sub_code = mysqli_fetch_assoc($sub_code_result);
        $sub_code = $row_sub_code['sub_code'];

        // Get Ex_ID from examdetails
        $ex_id_query = "SELECT ExamID FROM examans WHERE EAnsID='$EAnsID'";
        $ex_id_result = mysqli_query($connect, $ex_id_query);
        $row_ex_id = mysqli_fetch_assoc($ex_id_result);
        $Ex_ID = $row_ex_id['ExamID'];

        // Get Eno (students' enrollment number) from examans
        $eno_query = "SELECT Senrl FROM examans WHERE EAnsID='$EAnsID'";
        $eno_result = mysqli_query($connect, $eno_query);
        $row_eno = mysqli_fetch_assoc($eno_result);
        $Eno = $row_eno['Senrl'];

        // Check if data already exists in the result table
        $check_query = "SELECT * FROM result WHERE EAnsID='$EAnsID'";
        $check_result = mysqli_query($connect, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Update result table if data already exists
            $update_sql = "UPDATE result SET Ans1_status='$Ans1_status', Ans2_status='$Ans2_status', Ans3_status='$Ans3_status', Ans4_status='$Ans4_status', Ans5_status='$Ans5_status', Marks='$PassFail' WHERE EAnsID='$EAnsID'";
            mysqli_query($connect, $update_sql);
        } else {
            // Insert data into result table if it doesn't exist
            $insert_sql = "INSERT INTO result (Eno, Ex_ID, EAnsID, sub_code, Marks, Ans1_status, Ans2_status, Ans3_status, Ans4_status, Ans5_status) VALUES ('$Eno', '$Ex_ID', '$EAnsID', '$sub_code', '$PassFail', '$Ans1_status', '$Ans2_status', '$Ans3_status', '$Ans4_status', '$Ans5_status')";
            mysqli_query($connect, $insert_sql);
        }
    }
    
    $success_message = "Assessment details successfully updated.";
}

include('fhead.php');
?>

<script>
function validateForm() {
    var radios = document.querySelectorAll('input[type=radio]');
    var selects = document.querySelectorAll('select');

    var radioChecked = false;
    var selectFilled = false;

    // Check if at least one radio button is checked for each question
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            radioChecked = true;
            break;
        }
    }

    // Check if at least one select field is filled for each assessment
    for (var i = 0; i < selects.length; i++) {
        if (selects[i].value !== '') {
            selectFilled = true;
            break;
        }
    }

    if (!radioChecked) {
        alert("Please select an option for all questions.");
        return false;
    }

    if (!selectFilled) {
        alert("Please select Pass/Fail for at least one assessment.");
        return false;
    }

    return true;
}
</script>

<div class="container">
    <div class="row">
        <?php if(!empty($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>

        <?php
        $sql = "SELECT e.*, ed.Q1, ed.Q2, ed.Q3, ed.Q4, ed.Q5 FROM examans e JOIN examdetails ed ON e.ExamID = ed.ExamID WHERE e.sub_code IN (SELECT sub_code FROM subjects WHERE FID = '$userid') AND e.EAnsID NOT IN (SELECT EAnsID FROM result)";
        $rs = mysqli_query($connect, $sql);
        
        if (mysqli_num_rows($rs) > 0) {
            echo "<h2 class='page-header'>Assessment Details</h2>";
            echo "<h4 class='page-header red'>**When more than Two Questions are wrong the student is Fail**</h4>";
            echo "<form method='post' onsubmit='return validateForm()'>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-hover' style='width:100%'>
            <tr>
                <th>#</th>
                <th>Enrolment No.</th>
                <th>Question 1</th>
                <th>Answer 1</th>
                <th>Status</th>
                <th>Question 2</th>
                <th>Answer 2</th>
                <th>Status</th>
                <th>Question 3</th>
                <th>Answer 3</th>
                <th>Status</th>
                <th>Question 4</th>
                <th>Answer 4</th>
                <th>Status</th>
                <th>Question 5</th>
                <th>Answer 5</th>
                <th>Status</th>
                <th>Pass/Fail</th>
                <th>Action</th>        
            </tr>";
            $count = 1;
            while($row = mysqli_fetch_array($rs)) {
                ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td><?php echo $row['Senrl'];?></td>
                    <td><?php echo $row['Q1'];?></td>
                    <td><?php echo $row['Ans1'];?></td>
                    <td>
                        <input type="radio" name="Ans1_status_<?php echo $row['EAnsID']; ?>" value="right" <?php if(isset($row['Ans1_status']) && $row['Ans1_status'] == 'right') echo 'checked'; ?>> Right
                        <input type="radio" name="Ans1_status_<?php echo $row['EAnsID']; ?>" value="wrong" <?php if(isset($row['Ans1_status']) && $row['Ans1_status'] == 'wrong') echo 'checked'; ?>> Wrong
                    </td>
                    <td><?php echo $row['Q2'];?></td>
                    <td><?php echo $row['Ans2'];?></td>
                    <td>
                        <input type="radio" name="Ans2_status_<?php echo $row['EAnsID']; ?>" value="right" <?php if(isset($row['Ans2_status']) && $row['Ans2_status'] == 'right') echo 'checked'; ?>> Right
                        <input type="radio" name="Ans2_status_<?php echo $row['EAnsID']; ?>" value="wrong" <?php if(isset($row['Ans2_status']) && $row['Ans2_status'] == 'wrong') echo 'checked'; ?>> Wrong
                    </td>
                    <td><?php echo $row['Q3'];?></td>
                    <td><?php echo $row['Ans3'];?></td>
                    <td>
                        <input type="radio" name="Ans3_status_<?php echo $row['EAnsID']; ?>" value="right" <?php if(isset($row['Ans3_status']) && $row['Ans3_status'] == 'right') echo 'checked'; ?>> Right
                        <input type="radio" name="Ans3_status_<?php echo $row['EAnsID']; ?>" value="wrong" <?php if(isset($row['Ans3_status']) && $row['Ans3_status'] == 'wrong') echo 'checked'; ?>> Wrong
                    </td>
                    <td><?php echo $row['Q4'];?></td>
                    <td><?php echo $row['Ans4'];?></td>
                    <td>
                        <input type="radio" name="Ans4_status_<?php echo $row['EAnsID']; ?>" value="right" <?php if(isset($row['Ans4_status']) && $row['Ans4_status'] == 'right') echo 'checked'; ?>> Right
                        <input type="radio" name="Ans4_status_<?php echo $row['EAnsID']; ?>" value="wrong" <?php if(isset($row['Ans4_status']) && $row['Ans4_status'] == 'wrong') echo 'checked'; ?>> Wrong
                    </td>
                    <td><?php echo $row['Q5'];?></td>
                    <td><?php echo $row['Ans5'];?></td>
                    <td>
                        <input type="radio" name="Ans5_status_<?php echo $row['EAnsID']; ?>" value="right" <?php if(isset($row['Ans5_status']) && $row['Ans5_status'] == 'right') echo 'checked'; ?>> Right
                        <input type="radio" name="Ans5_status_<?php echo $row['EAnsID']; ?>" value="wrong" <?php if(isset($row['Ans5_status']) && $row['Ans5_status'] == 'wrong') echo 'checked'; ?>> Wrong
                    </td>
                    <td>
                        <select name="PassFail_<?php echo $row['EAnsID']; ?>">
                            <option value="">Select Pass/Fail</option>
                            <option value="Pass" <?php if(isset($row['Marks']) && $row['Marks'] == 'Pass') echo 'selected'; ?>>Pass</option>
                            <option value="Fail" <?php if(isset($row['Marks']) && $row['Marks'] == 'Fail') echo 'selected'; ?>>Fail</option>
                        </select>
                    </td>
                    <td>
                        <button type='submit' name='submit[<?php echo $row['EAnsID']; ?>]' class='btn btn-primary'>Submit</button>
                    </td>
                </tr>
                <?php
                $count++;
            }   
            echo "</table>";
           
            echo "</form>";
            echo "</div>";
        } else {
            // No assessment details for this subject
            echo "<h2>No assessment details for this subject</h2>";
        }
        ?>  
    </div>
</div>
<?php include('allfoot.php');  ?>
