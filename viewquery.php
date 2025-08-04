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

    // Query to fetch queries corresponding to the selected subject code
    $sql = "SELECT * FROM query WHERE sub_code = '$selected_subject_code'";
    $result = mysqli_query($connect, $sql);

    // Check if there are queries available
    if (mysqli_num_rows($result) > 0) {
?>
        <?php include('studenthead.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">
             
                    <?php

                    include('database.php');
                    $seid = $_GET['eid'];
                    //below query will print the existing record of query
                    $sql = "SELECT * FROM query WHERE Eid='$seid' AND sub_code = '$selected_subject_code'";
                    $rs = mysqli_query($connect, $sql);
                    echo "<h2 class='page-header'>Query View</h2>";
                    echo "<table class='table table-striped table-hover' style='width:100%'>
                        <tr>
                            <th>#</th>
                            <th>Query</th>
                            <th>Answer</th>                        
                        </tr>";
                    $count = 1;
                    while ($row = mysqli_fetch_array($rs)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>

                            <td>
                                <?php echo $row['Query']; ?>
                            </td>
                            <td>
                                <?php echo $row['Ans']; ?>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    }
                    ?>
                    </table>
                    <a href="askquery.php?eid=<?php echo $userid; ?>">
                        <button class="btn btn-success" style="border-radius:0%">Ask New Query</button>
                    </a>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
        <?php include('allfoot.php'); ?>
    <?php
    } else {
        // No queries available for this subject
        echo "<h2>No Query available Yet for this subject.</h2>";
    }
} else {
    // If no subject code is selected
    echo "Please select a subject first.";
}
?>
