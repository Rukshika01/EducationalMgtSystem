<?php
session_start();

if ($_SESSION["pidx"] == "" || $_SESSION["pidx"] == NULL) {
    header('Location:parentlogin');
}

$parentID = $_SESSION["pidx"];
$parentName = $_SESSION["pname"];
$studentEno = $_SESSION["seno"];

include("database.php");

// Query to fetch assessments of the parent's student along with the subject name and questions
$sql = "SELECT e.*, s.sub_name, d.*
        FROM examans e
        INNER JOIN subjects s ON e.sub_code = s.sub_code
        INNER JOIN examdetails d ON e.ExamID = d.ExamID
        WHERE e.Senrl = '$studentEno'";
$result = mysqli_query($connect, $sql);
?>
<style>
/* Custom CSS for table styling */
.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}
</style>
<?php include('parenthead.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Assessment Details</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
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
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$count}</td>";
                            echo "<td>{$row['sub_name']}</td>";
                            echo "<td>{$row['Q1']}</td>";
                            echo "<td>{$row['Ans1']}</td>";
                            echo "<td>{$row['Q2']}</td>";
                            echo "<td>{$row['Ans2']}</td>";
                            echo "<td>{$row['Q3']}</td>";
                            echo "<td>{$row['Ans3']}</td>";
                            echo "<td>{$row['Q4']}</td>";
                            echo "<td>{$row['Ans4']}</td>";
                            echo "<td>{$row['Q5']}</td>";
                            echo "<td>{$row['Ans5']}</td>";
                            echo "</tr>";
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('allfoot.php'); ?>
