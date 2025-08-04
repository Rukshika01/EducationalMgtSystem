
    <style>
        body {
            text-align: left;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        th, td {
            padding: 15px;
            text-align: center;
            vertical-align: top;
            border: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 13px;
        }

        td {
            background-color: #fff;
            font-size: 14px;
        }

        /* Footer styles */
        .site-footer {
            background-color: #26272b;
            padding: 45px 0 20px;
            font-size: 15px;
            line-height: 24px;
            color: #737373;
            text-align: center;
        }

        .site-footer hr {
            border-top-color: #bbb;
            opacity: 0.5;
        }

        .site-footer h6 {
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        .site-footer a {
            color: #737373;
        }

        .site-footer a:hover {
            color: #3366cc;
            text-decoration: none;
        }

        .footer-links {
            padding-left: 0;
            list-style: none;
        }

        .footer-links li {
            display: block;
        }

        .footer-links a {
            color: #737373;
        }

        .footer-links a:active,
        .footer-links a:focus,
        .footer-links a:hover {
            color: #3366cc;
            text-decoration: none;
        }

        .footer-links.inline li {
            display: inline-block;
        }

        .site-footer .social-icons {
            text-align: center;
            margin-top: 20px;
        }

        .site-footer .social-icons a {
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 0 6px;
            border-radius: 100%;
            background-color: #33353d;
            display: inline-block;
        }

        .social-icons a:hover {
            background-color: #29aafe;
        }

        @media (max-width: 767px) {
            .site-footer .col-sm-12 {
                text-align: center;
            }

            .site-footer .social-icons {
                text-align: center;
            }
        }
    </style>


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
    
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <?php 

            // Modify the SQL query to fetch only results of the sub_code associated with the faculty
            $sql = "SELECT e.*, ed.Q1, ed.Q2, ed.Q3, ed.Q4, ed.Q5 FROM examans e JOIN examdetails ed ON e.ExamID = ed.ExamID WHERE e.sub_code IN (SELECT sub_code FROM subjects WHERE FID = '$userid')";
            $rs = mysqli_query($connect, $sql);
            
            if (mysqli_num_rows($rs) > 0) {
                echo "<h2 class='page-header'>Assessment Details</h2>";
                echo "<h4 class='page-header'>**When more than 2 questions are wrong the student is fail**</h4>";
                echo "<form method='post'>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered table-hover'>";
                echo "<thead>
                        <tr>
                            <th>#</th>
                            <th>Enrolment No.</th>
                            <th>
                                <div style='white-space: nowrap;'>Question 1</div>
                            </th>
                            <th>Answer 1</th>
                            <th>Status</th>
                            <th>
                                <div style='white-space: nowrap;'>Question 2</div>
                            </th>
                            <th>Answer 2</th>
                            <th>Status</th>
                            <th>
                                <div style='white-space: nowrap;'>Question 3</div>
                            </th>
                            <th>Answer 3</th>
                            <th>Status</th>
                            <th>
                                <div style='white-space: nowrap;'>Question 4</div>
                            </th>
                            <th>Answer 4</th>
                            <th>Status</th>
                            <th>
                                <div style='white-space: nowrap;'>Question 5</div>
                            </th>
                            <th>Answer 5</th>
                            <th>Status</th>
                            <th>Pass/Fail</th>
                            <th>Action</th>        
                        </tr>
                    </thead>";
                $count = 1;
                while($row = mysqli_fetch_array($rs)) {
                    ?>
                    <tbody>
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
                                <option value="Pass" <?php if(isset($row['Marks']) && $row['Marks'] == 'Pass') echo 'selected'; ?>>Pass</option>
                                <option value="Fail" <?php if(isset($row['Marks']) && $row['Marks'] == 'Fail') echo 'selected'; ?>>Fail</option>
                            </select>
                        </td>
                        <td>
                            <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                        </td>
                    </tr>
                </tbody>
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
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'Ans1_status_') !== false) {
                $EAnsID = str_replace('Ans1_status_', '', $key);
                $Ans1_status = isset($_POST['Ans1_status_'.$EAnsID]) ? $_POST['Ans1_status_'.$EAnsID] : '';
                $Ans2_status = isset($_POST['Ans2_status_'.$EAnsID]) ? $_POST['Ans2_status_'.$EAnsID] : '';
                $Ans3_status = isset($_POST['Ans3_status_'.$EAnsID]) ? $_POST['Ans3_status_'.$EAnsID] : '';
                $Ans4_status = isset($_POST['Ans4_status_'.$EAnsID]) ? $_POST['Ans4_status_'.$EAnsID] : '';
                $Ans5_status = isset($_POST['Ans5_status_'.$EAnsID]) ? $_POST['Ans5_status_'.$EAnsID] : '';
                $PassFail = isset($_POST['PassFail_'.$EAnsID]) ? $_POST['PassFail_'.$EAnsID] : '';
                
                $update_query = "UPDATE `result` SET `Ans1_status`='$Ans1_status', `Ans2_status`='$Ans2_status', `Ans3_status`='$Ans3_status', `Ans4_status`='$Ans4_status', `Ans5_status`='$Ans5_status', `Marks`='$PassFail' WHERE `EAnsID`='$EAnsID'";
                if (mysqli_query($connect, $update_query)) {
                    echo "<div class='alert alert-success' role='alert'>Data updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error updating data: " . mysqli_error($connect) . "</div>";
                }
            }
        }
    }
}
?>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h6>About</h6>
                <p class="text-justify">Edu Dive is designed to provide you with the tools and resources you need to succeed in your educational journey. Whether you're a student looking to supplement your studies or a professional seeking to expand your skillset, Edu Dive offers high-quality content curated by experts in their fields.</p>
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h6>Contacts</h6>
                <ul class="contact-list">
                    <li>+94768392748</li>
                    <li>edudive@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa fa-heart-o" aria-hidden="true"></i> by Edu Dive
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.table').DataTable();
    });
</script>
</body>
</html>
