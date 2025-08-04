<?php
session_start();

if ( $_SESSION[ "pidx" ] == "" || $_SESSION[ "pidx" ] == NULL ) {
	header( 'Location:parentlogin' );
}

$userid = $_SESSION["pidx"];
$userfname = $_SESSION["pname"];
$sEno = $_SESSION["seno"];
?>
<?php include('parenthead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<br>
			<?php
			include( "database.php" );
            if (!isset($_GET['parent_id']) || empty($_GET['parent_id'])) {
                // Handle the case where parent_id is not set or empty
                // redirect the user to the parent profile page
                header('Location: parentdetails.php');
                exit;
            }
            
            $new3 = $_GET['parent_id'];
			//below query will print the existing record of parent
			$sql = "select * from  parent where parent_id=$new3";
			$result = mysqli_query( $connect, $sql );

			while ( $row = mysqli_fetch_array( $result ) ) {
				?>
			<form action="" method="POST" name="update">
				
				
				<div class="form-group">
					Full Name : <input type="text" name="pname" class="form-control" value="<?php echo $row['parent_name']; ?>">
				</div>
				<div class="form-group">
					Phone Number : <input type="text" name="phno" class="form-control" value="<?PHP echo $row['phone_number'];?>" maxlength="10"><br>
				</div>
				<div class="form-group">
					Email : <input type="text" name="email" class="form-control" value="<?PHP echo $row['p_email'];?>" readonly><br>
				</div>
				<div class="form-group">
					Password : <input type="text" name="pass" class="form-control" value="<?PHP echo $row['p_pass'];?>"><br>
				</div>
                <div class="form-group">
                Student Enrolment number : <?php echo $row['Eno']; ?>
				</div><br>
				<div class="form-group">

					<input type="submit" value="Update!" name="update" class="btn btn-primary" style="border-radius:0%">
				</div>
			</form>
			<?php
			}
			?>

			<?php

			if ( isset( $_POST[ 'update' ] ) ) {
				
				$tempfname = $_POST[ 'pname' ];
				$tempphno = $_POST[ 'phno' ];
				$tempeid = $_POST[ 'email' ];
				$temppass = $_POST[ 'pass' ];
				//below query will update the existing record of parent
				$sql = "UPDATE `parent` SET parent_name='$tempfname',phone_number=$tempphno, p_email='$tempeid', p_pass='$temppass'  WHERE parent_id=$new3";


				if ( mysqli_query( $connect, $sql ) ) {
					echo "

				<br><br>
				<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>Success!</strong> Parent Details has been updated.
				</div>

				";
				} else {
					//below statement will print error if SQL query fail.
					echo "<br><Strong>Parent Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
				}
				//for close connection
				mysqli_close( $connect );

			}
			?>
		</div>

		<div class="col-md-4"></div>
	</div>
	<?php include('allfoot.php'); ?>