
</head>
<body>

<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
    header('Location: studentlogin');
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
    $sql = "SELECT ea.EAnsID, ed.Q1, ed.Q2, ed.Q3, ed.Q4, ed.Q5, ed.ExamID, ea.Ans1, ea.Ans2, ea.Ans3, ea.Ans4, ea.Ans5 FROM examans ea JOIN examdetails ed ON ea.ExamID = ed.ExamID WHERE ed.sub_code = '$selected_subject_code'";
    $result = mysqli_query($connect, $sql);

    // Check if there are assessments available
    if (mysqli_num_rows($result) > 0) {
        include('studenthead.php');
?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $seno = $_GET['seno'];
                    // below query will print the existing record of result
                    $sql = "SELECT ea.EAnsID, ed.Q1, ed.Q2, ed.Q3, ed.Q4, ed.Q5, ed.ExamID, ea.Ans1, ea.Ans2, ea.Ans3, ea.Ans4, ea.Ans5 FROM examans ea JOIN examdetails ed ON ea.ExamID = ed.ExamID WHERE ed.sub_code = '$selected_subject_code' AND ea.Senrl='$seno'";
                    $re = mysqli_query($connect, $sql);

                    if (!$re) {
                        echo "Error: " . mysqli_error($connect);
                    } else {
                        echo "<h2 class='page-header'>Assessment Question and Answers</h2>";
                        echo "<div style='overflow-x:auto;'>";
                        echo "<table id='test2' class='table table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam ID</th>
                                        <th>Answer ID</th>
                                        <th>Question 1</th>
                                        <th>Answer 1</th>
                                        <th>Question 2</th>
                                        <th>Answer 2</th>
                                        <th>Question 3</th>
                                        <th>Answer 3</th>
                                        <th>Question 4</th>
                                        <th>Answer 4</th>
                                        <th>Question 5</th>
                                        <th>Answer 5</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        $count = 1;
                        while ($row = mysqli_fetch_array($re)) {
                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['ExamID']; ?></td>
                                <td><?php echo $row['EAnsID']; ?></td>
                                <td><?php echo $row['Q1']; ?></td>
                                <td><?php echo $row['Ans1']; ?></td>
                                <td><?php echo $row['Q2']; ?></td>
                                <td><?php echo $row['Ans2']; ?></td>
                                <td><?php echo $row['Q3']; ?></td>
                                <td><?php echo $row['Ans3']; ?></td>
                                <td><?php echo $row['Q4']; ?></td>
                                <td><?php echo $row['Ans4']; ?></td>
                                <td><?php echo $row['Q5']; ?></td>
                                <td><?php echo $row['Ans5']; ?></td>
                            </tr>
                    <?php
                            $count++;
                        }
                        echo "</tbody></table></div>";
                    }
                    ?>
                </div>
            </div>
        </div>

<?php
    include('allfoot.php');
    } else {
        // No assessments available for this subject
        echo "<h2>No Results available for this subject.</h2>";
    }

    // Query to fetch assessments corresponding to the selected subject code
    $sql = "SELECT * FROM result WHERE sub_code = '$selected_subject_code'";
    $result = mysqli_query($connect, $sql);

    // Check if there are assessments available
    if (mysqli_num_rows($result) > 0) {
?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $seno = $_GET['seno'];
                    // below query will print the existing record of result
                    $sql = "SELECT * FROM result WHERE Eno='$seno' AND sub_code = '$selected_subject_code'";
                    $rs = mysqli_query($connect, $sql);
                    echo "<h2 class='page-header'>Assessment View Results</h2>";
                    echo "<div style='overflow-x:auto;'>";
                    echo "<table id='test' class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Exam ID</th>
                                    <th>Answer ID</th> 
                                    <th>Enrolment Number</th>                                    
                                    <th>Question 1</th>
                                    <th>Question 2</th>
                                    <th>Question 3</th>
                                    <th>Question 4</th>
                                    <th>Question 5</th>
                                    <th>Marks</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $count = 1;
                    while ($row = mysqli_fetch_array($rs)) {
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['Ex_ID']; ?></td>
                            <td><?php echo $row['EAnsID']; ?></td>
                            <td><?php echo $row['Eno']; ?></td>
                            <td style="color: <?php echo $row['Ans1_status'] == 'wrong' ? 'red' : 'green'; ?>"><?php echo $row['Ans1_status']; ?></td>
                            <td style="color: <?php echo $row['Ans2_status'] == 'wrong' ? 'red' : 'green'; ?>"><?php echo $row['Ans2_status']; ?></td>
                            <td style="color: <?php echo $row['Ans3_status'] == 'wrong' ? 'red' : 'green'; ?>"><?php echo $row['Ans3_status']; ?></td>
                            <td style="color: <?php echo $row['Ans4_status'] == 'wrong' ? 'red' : 'green'; ?>"><?php echo $row['Ans4_status']; ?></td>
                            <td style="color: <?php echo $row['Ans5_status'] == 'wrong' ? 'red' : 'green'; ?>"><?php echo $row['Ans5_status']; ?></td>
                            <td><?php if ($row['Marks'] == 'Pass') {
                                    echo '<div style="color:green;"><b>' . $row['Marks'];
                                } else {
                                    echo '<div style="color:red;"><b>' . $row['Marks'];
                                } 
                                ?>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    }
                    ?>
                    </tbody>
                    </table></div>
                </div>
            </div>
        </div>

<?php
    include('allfoot.php');
    } 
} else {
    // If no subject code is selected
    echo "<h2>Please select a subject first.</h2>";
}
?>

<!-- JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#test').DataTable();
        $('#test2').DataTable();
    });
</script>
</body>
</html>
