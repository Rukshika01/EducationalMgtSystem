

<?php include('parenthead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 text-center">

		
			<?php
			include( 'database.php' );
			$varid = $_REQUEST[ 'myds' ];
			
			$sql = "select * from  parent where parent_id='$varid'";
			$result = mysqli_query( $connect, $sql );
			//loop below will print details of assessment
			while ( $row = mysqli_fetch_array( $result ) ) {
				?>
			<fieldset>
				<br>
				<form action="" method="POST" name="update">
					<table class="table table-hover">
						<tr>
							<td><strong>Full Name :</strong> </td>
							<td>
								<?php echo $row['parent_name']; ?>
							</td>
						</tr>
						<tr>
							<td><strong>Contact :</strong>
							</td>
							<td>
								<?PHP echo $row['phone_number'];?> </td>
						</tr>
						<tr>
							<td><strong>Email : </strong>
							</td>
							<td>
								<?PHP echo $row['p_email'];?>
							</td>
						</tr>
                        <tr>
							<td><strong>Student Enrolment number : </strong>
							</td>
							<td>
								<?php echo $row['Eno']; ?>
							</td>
						</tr>
						
						<tr>
							<td><a href="updatedetailsfromparent.php?parent_id=<?php echo $varid; ?>"><input type="button" Value="Edit" class="btn btn-info btn-sm" style="border-radius:0%;"></a></td>
							
						</tr>
					</table>
				</form>
			</fieldset>
			<?php
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include('allfoot.php'); ?>