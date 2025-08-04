<?php
session_start();

if ( $_SESSION[ "fidx" ] == "" || $_SESSION[ "fidx" ] == NULL ) {
	header( 'Location:facultylogin' );
}

$userid = $_SESSION[ "fidx" ];
$fname = $_SESSION[ "fname" ];

?>
<?php include('fhead.php');  ?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">

<br>

			<?php
			include( 'database.php' );
			$make = $_GET[ 'makeid' ];
			//selecting data form result table form database
			$sql = "SELECT * FROM examans WHERE EAnsID=$make";
			$rs = mysqli_query( $connect, $sql );
			while ( $row = mysqli_fetch_array( $rs ) ) {
				?>
			<fieldset>
				<legend>Make Result</legend>
				<form action="" method="POST" name="makeresult">
					<table class="table table-hover">

						<tr>
							<td><strong>Enrolment number  </strong>
							</td>
							<td>
								<?php $eno=$row['Senrl']; echo $eno; ?>
							</td>

						</tr>
						<tr>
							<td><strong>Exam ID:</strong> </td>
							<td>
								<?php $ExamID= $row['ExamID']; echo $ExamID; ?>
							</td>
						</tr>
						<tr>
							<td><strong>Subject code:</strong> </td>
							<td>
								<?php $subcode= $row['sub_code']; echo $subcode; ?>
							</td>
						</tr>
						<tr>
							<td><strong>Marks</strong> </td>
							<td>
								<select class="form-control" name="marks" required>
									<option value="">---Select---</option>
									<option value="Pass">Pass</option>
									<option value="Fail">Fail</option>
								</select>
							</td>
						</tr>
						<td><button type="submit" name="make" class="btn btn-success" style="border-radius:0%">Publish</button>
						</td>
						<?php
						}
						?>
						<?php 

							if(isset($_POST['make']))
							{
							$mark= $_POST['marks'];

							$sql="INSERT INTO `result`(`Eno`, `Ex_ID`,`sub_code`, `Marks`) VALUES ($eno, '$ExamID', '$subcode','$mark')";

							if (mysqli_query($connect, $sql)) {
							echo "
							<br><br>
							<div class='alert alert-success fade in'>
							<a href='ResultDetails.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Success!</strong> Result Updated.
							</div>
							";
							} else {
								//error message if SQL query fails
							echo "<br><Strong>Result Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);

							//close the connection
							mysqli_close($connect);
							}
							}
							?>
					</table>
				</form>
			</fieldset>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include('allfoot.php');  ?>