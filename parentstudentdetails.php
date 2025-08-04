<?php
session_start();

if (!isset($_SESSION["pidx"]) || empty($_SESSION["pidx"])) {
    header('Location: parentlogin.php');
    exit;
}

include('parenthead.php');

$parent_id = $_SESSION["pidx"];


// Include database connection
include('database.php');

// Query to fetch the Eno of the parent
$sql = "SELECT Eno FROM parent WHERE parent_id = '$parent_id'";
$result = mysqli_query($connect, $sql);

// Check if the parent's Eno exists
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $student_eno = $row['Eno'];

    // Query to fetch student profile details
    $sql_profile = "SELECT * FROM studenttable WHERE Eno = '$student_eno'";
    $result_profile = mysqli_query($connect, $sql_profile);

    if ($result_profile && mysqli_num_rows($result_profile) > 0) {
        $row_profile = mysqli_fetch_assoc($result_profile);
?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center">
                    <fieldset>
                        <br>
                        <form action="" method="POST" name="update">
                            <table class="table table-hover">
                                <tr>
                                    <td><strong>Enrolment number :</strong></td>
                                    <td><?php echo $row_profile['Eno']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>First Name :</strong> </td>
                                    <td><?php echo $row_profile['FName']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name :</strong> </td>
                                    <td><?php echo $row_profile['LName']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Father Name :</strong> </td>
                                    <td><?php echo $row_profile['FaName']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Address : </strong></td>
                                    <td><?php echo $row_profile['Addrs']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Gender :</strong></td>
                                    <td><?php echo $row_profile['Gender']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>D.O.B. :</strong> </td>
                                    <td><?php echo $row_profile['DOB']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Contact :</strong></td>
                                    <td><?php echo $row_profile['PhNo']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email :</strong></td>
                                    <td><?php echo $row_profile['Eid']; ?></td>
                                </tr>
                                
                            </table>
                        </form>
                    </fieldset>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
<?php
    } else {
        echo "<h2>No profile found for the student.</h2>";
    }
} else {
    echo "<h2>No student associated with this parent.</h2>";
}

include('allfoot.php');
?>
