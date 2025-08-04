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
		<div class="col-md-4"></div>

		<div class="col-md-4">

			<h4 class="page-header">Add New Subject </h4>
			<?php
			include( "database.php" );
			?>
			<form action="" method="POST" name="update">

				<div class="form-group">
					<label for="Subject Name">Subject Name :<span style="color: #ff0000;">*</span></label>
					<input type="text" class="form-control" id="sub_name" name="sub_name" required>
				</div>

				<div class="form-group">
					<label for="Subject Code">Subject Code : <span style="color: #ff0000;">*</span></label>
					<input type="text" class="form-control" name="sub_code" required id="sub_code">
				</div>

				<div class="form-group">
					<label for="Description">Description : <span style="color: #ff0000;">*</span></label>
					<input type="textarea" class="form-control" id="description" name="description" maxlength="100" minlength="10" required>
				</div>
 
				<div class="form-group">
					<label for="Faculty ID">Faculty ID : <span style="color: #ff0000;">*</span></label>
					<input type="text" name="FID" class="form-control" id="FID" required>
				</div>

				<div class="form-group">
					<input type="submit" value="Add New Subject" name="addnewsubject" style="border-radius:0%" class="btn btn-success">
				</div>

			</form>
			<?php
			//}
			?>

			<?php
			if ( isset( $_POST[ 'addnewsubject' ] ) ) {
				
				$tempsub_name = $_POST[ 'sub_name' ];
				$tempsub_code = $_POST[ 'sub_code' ];
				$tempdescription = $_POST[ 'description' ];
				$tempFID = $_POST[ 'FID' ];
				// adding new faculty
				$sql = "insert subjects (sub_name, sub_code, description, FID) values ('$tempsub_name', '$tempsub_code','$tempdescription', '$tempFID')";

				if ( mysqli_query( $connect, $sql ) ) {

					echo "<br>
					<br><br>
					<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Success!</strong> New Subject Addded Subject ID is : <strong>" . mysqli_insert_id( $connect ) . "</strong></div>";

				} else {
					//error message if SQL query Fails
					echo "<br><Strong>New Subject Adding Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
				}
				//close the connection
				mysqli_close( $connect );

			}


			?>
		</div>

		<div class="col-md-4"></div>
	</div>

	<?php include('allfoot.php'); ?>