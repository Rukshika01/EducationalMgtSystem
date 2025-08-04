<?php
include("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $phno = $_POST['phno'];
    $Eno = $_POST['Eno'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Check if the Eno exists in the studenttable
    $sql_check = "SELECT * FROM studenttable WHERE Eno = '$Eno'";
    $result_check = mysqli_query($connect, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Get student's first name and last name
        $student_data = mysqli_fetch_assoc($result_check);
        $student_fname = $student_data['FName'];
        $student_lname = $student_data['LName'];

        // Show confirmation message
        echo "<script>
                var confirmMsg = confirm('Is this the student you want to register?\\nFirst Name: $student_fname\\nLast Name: $student_lname');
                if (confirmMsg) {
                    // Insert data into parent table
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'insert_parent.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200 && xhr.responseText === 'success') {
                            alert('Register Successfully Complete. Now You Can Login With Your Email & Password');
                            document.forms['register'].submit();
                        } else {
                            alert('Registration failed. Please try again later.');
                        }
                    };
                    xhr.send('pname=' + encodeURIComponent('$pname') + '&phno=' + encodeURIComponent('$phno') + '&Eno=' + encodeURIComponent('$Eno') + '&email=' + encodeURIComponent('$email') + '&pass=' + encodeURIComponent('$pass'));
                } else {
                    alert('Registration canceled.');
                }
             </script>";
    } else {
        ?><br><?php    
        echo "<div class='alert alert-danger' role='alert'>No student available with the provided Enrollment Number.</div>";
    }
}
?>

<!-- Favicon -->   
<link href="img/Capture.JPG" rel="shortcut icon"/>
<?php include('allhead.php'); ?>
<style>
    body {
        background-color:#edf4f6;
    }
</style>

<div class="container" style="max-width: 1200px;">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <form name="register" action="" method="POST" onsubmit="return validateForm()">
                <fieldset>
                    <legend>
                        <h3 style="padding-top: 25px; font-size: xx-large; font-weight: bolder; text-align-last: center;">Parent Registration Form </h3>
                    </legend>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name: <span style="color: #ff0000;">*</span></label>
                            <input type="text" class="form-control" name="pname" id="pname" maxlength="30">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Contact (format: without code only 10 digits): <span style="color: #ff0000;">*</span></label>
                            <input type="tel" pattern="^\d{10}$" required class="form-control" name="phno" id="phno" maxlength="10">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Student Enrollment Number: <span style="color: #ff0000;">*</span></label>
                            <input type="text" required class="form-control" name="Eno" id="Eno">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Id: <span style="color: #ff0000;">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" maxlength="50">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Password: <span style="color: #ff0000;">*</span></label>
                            <input type="password" class="form-control" name="pass" id="pass" maxlength="30"> <span style="color: #ff0000;"></span>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <button type="submit" name="submit" class="btn btn-success">Register</button>
                        <button type="reset" name="reset" class="btn btn-danger ml-4">Clear</button>
                    </div>
                </fieldset>
            </form>
            <button class="btn btn-info ml-4"><a href="parentlogin">Parent Login</a> </button>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php include('allfoot.php'); ?>

<script>
    // JavaScript validation for various fields
    function validateForm() {
        var pname = document.forms["register"]["pname"].value;
        var phno = document.forms["register"]["phno"].value;
        var Eno = document.forms["register"]["Eno"].value;
        var x = document.forms["register"]["email"].value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        var pass = document.forms["register"]["pass"].value;
        
        if (pname == null || pname == "") {
            alert("Full Name must be filled out");
            return false;
        }
        
        if (phno == null || phno == "") {
            alert("Phone Number must be filled out");
            return false;
        }
        
        if (Eno == null || Eno == "") {
            alert("Student Enrollment Number must be filled out");
            return false;
        }
        
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
            alert("Not a valid e-mail address");
            return false;
        }
        
        if (pass == null || pass == "") {
            alert("Password must be filled out");
            return false;
        }
    }
</script>