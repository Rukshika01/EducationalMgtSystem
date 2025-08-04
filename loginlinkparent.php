<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = $_POST["pemail"];
    $y = $_POST["pass"];

    include("database.php");

    // Search for the login ID and password entered in $x & $y
    $sql = "SELECT * FROM parent WHERE p_email='" . $x . "' AND p_pass='" . $y . "'";
    $result = mysqli_query($connect, $sql);

    if ($result->num_rows > 0) {
        // Create session variables
        if ($row = $result->fetch_assoc()) {
            $_SESSION["pidx"] = $row["parent_id"];
            $_SESSION["pname"] = $row["parent_name"];
            $_SESSION["phone"] = $row["phone_number"];
            $_SESSION["seno"] = $row["Eno"];
            $_SESSION["pemail"] = $row["p_email"];
        }

        // Redirect to welcome student page
        header('Location: welcomeparent.php');
    } else {
        // Error message if SQL query fails
        echo "<h3><span style='color:red; '>Invalid Parent ID & Password. Page will redirect to the Login Page after 2 seconds</span></h3>";
        header("refresh:3;url=parentlogin.php");
    }

    // Close the database connection
    $connect->close();
}
?>
