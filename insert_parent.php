<?php
include("database.php");

$pname = $_POST['pname'];
$phno = $_POST['phno'];
$Eno = $_POST['Eno'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$insert_sql = "INSERT INTO parent (parent_name, phone_number, Eno, p_email, p_pass) VALUES ('$pname', '$phno', '$Eno', '$email', '$pass')";
if (mysqli_query($connect, $insert_sql)) {
    echo "success";
} else {
    echo "error";
}
?>
