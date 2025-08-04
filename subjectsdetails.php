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
		if ( isset( $_REQUEST[ 'deleteid' ] ) ) {
			$deleteid = $_GET[ 'deleteid' ];
			//below will delete a particular student
			$sql = "DELETE FROM `subjects` WHERE sub_id = $deleteid";
			if ( mysqli_query( $connect, $sql ) ) {
				echo "
				<br><br>
				<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>Success!</strong> Subject deleted.
				</div>
				";
			} else {
				echo "<br><Strong>Subject Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $connect );
			}
		}
		mysqli_close( $connect );
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
<br>
			<a href="addnewsubject"><button type="button" value="AddNewsubject" class="btn btn-success btn-sm" style="border-radius:0%">Add New Subject</button></a>
			<?php
			include( "database.php" );
			$sql = "SELECT * from  subjects";
			$result = mysqli_query( $connect, $sql );
			echo "<h2 class='page-header'>Subject Details</h2>";
			
			//below will print all subject details to admin
			echo "<table class='table table-striped table-hover' style='width:100%'>
				<tr>
				<th>#</th>
				<th>subject id</th>
				<th>subject name</th>
				<th>subject code</th>
				<th>description</th>
				<th>teacher ID</th>
                <th>Action</th>	
				</tr>";
				$count=1;
			while ( $row = mysqli_fetch_array( $result ) ) {
				?>

			<tr>
				<td>
					<?php echo $count;?>
				</td>
				
				<td>
					<?php echo $row['sub_id'];?> 
				</td>
			
				<td>
					<?php echo $row['sub_name'];?>
				</td>
				<td>
					<?php echo $row['sub_code'];?>
				</td>
				<td>
					<?php echo $row['description'];?>
				</td>
				<td>
					<?php echo $row['FID'];?>
				</td>
				
				<td><a href="updatesubject.php?sub_id=<?php echo $row['sub_id']; ?>"><input type="button" Value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"></a>
		
				</td>
			</tr>
			<?php $count++; } ?>
			</table>
			
		</div>
	</div>
	<?php include('allfoot.php'); ?>