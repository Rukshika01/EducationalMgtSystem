<?php
session_start();

if ( $_SESSION[ "umail" ] == "" || $_SESSION[ "umail" ] == NULL ) {
	header( 'Location:AdminLogin.php' );
}

$userid = $_SESSION[ "umail" ];
?>
<?php include('adminhead.php'); ?>

<div class="container">

	<div class="row">
		<?php
		include( "database.php" );
		if ( isset( $_POST[ 'addnews' ] ) ) {
			$tempfname = $_POST[ 'pname' ];
				$tempphno = $_POST[ 'phno' ];
                $tempeno = $_POST ['Eno'];
				$tempeid = $_POST[ 'email' ];
				$temppass = $_POST[ 'pass' ];
			//adding new student into database SQL Query
			$sql = "INSERT INTO `parent` (`parent_name`, `phone_number`, `Eno`, `p_email`, `p_pass`) VALUES ('$tempfname','$tempphno','$tempeno','$tempeid','$temppass')";
			if ( mysqli_query( $connect, $sql ) ) {
				echo "<center><div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
				<h3 style='margin-top: 10px; margin-bottom: 10px;'>Registration Confirm.! </h4></div></center>
				";
			} else {
				//error message if SQL query fails
				echo "<br><Strong>Registration Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
			}
			//close the connection
			mysqli_close( $connect );
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">

			<h4 class="page-header">Add New Parent Details</h4>
			<form action="" method="POST" name="updateform">
				<div class="form-group">
					<label for="Full Name">Full Name : </label>
					<input type="text"  class="form-control" id="pname" name="pname" required>
				</div>

				<div class="form-group">
					<label for="Contact">Contact (format: without code only 10 digits):</label>
					<input type="text" class="form-control" name="phno" id="phno" maxlength="10" required>
				</div>

				<div class="form-group">
					<label for="Student Enrollment Number:">Student Enrollment Number:</label>
					<input type="text" class="form-control" id="Eno" name="Eno" required>
				</div>


				<div class="form-group">
					<label for="email">Email address:</label>
					<input type="email" class="form-control" name="email" placeholder="John@example.com" id="email" required>
				</div>

				<div class="form-group">
					<label for="Password">Password : </label>
					<input type="password" class="form-control" id="pass" name="pass" placeholder="Type Strong Password" required>
				</div>

				<div class="form-group">
					<input type="submit" value="Submit Details" name="addnews" class="btn btn-success" style="border-radius:0%">
				</div>
			</form>
		</div>

		<div class="col-md-4"></div>
	</div>
	<?php include('allfoot.php'); ?>