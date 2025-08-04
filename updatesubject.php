<?php
session_start();

if($_SESSION["umail"]=="" || $_SESSION["umail"]==NULL)
{
header('Location:AdminLogin.php');
}

$userid = $_SESSION["umail"];
?><?php include('adminhead.php'); ?>
	<div class="container">
     <div class="row">
			<div class="col-md-3"></div>

			<div class="col-md-6">
	<br>
				<?php
				include("database.php");
				$new2=$_GET['sub_id'];
				
     			$sql="select * from  subjects where sub_id=$new2";
				$result=mysqli_query($connect,$sql);
				
				while($row=mysqli_fetch_array($result))
				{ 
				?>
				<form action="" method="POST" name="update">
				<div class="form-group">
				Subject ID : <?php echo $row['sub_id']; ?></div>
				<div class="form-group">
				Subject Name : <input type="text" name="sub_name" class="form-control" value="<?php echo $row['sub_name']; ?>"></div>
				<div class="form-group">
				Subject Code : <input type="text" name="sub_code" class="form-control" value="<?PHP echo $row['sub_code'];?>"><br></div>
				<div class="form-group">
				Description : <input type="text" name="description" class="form-control"  value="<?PHP echo $row['description'];?>"><br></div>
				<div class="form-group">
				Faculty ID : <input type="text" name="FID" class="form-control" value="<?PHP echo $row['FID'];?>"><br></div>
				<div class="form-group">
				<input type="submit" value="Make Changes" name="update" class="btn btn-success" style="border-radius:0%"></div>
				</form>
				<?php
				}
				?>
           
          <?php
		if(isset($_POST['update']))		
			{
				$tempsub_name = $_POST[ 'sub_name' ];
				$tempsub_code = $_POST[ 'sub_code' ];
				$tempdescription = $_POST[ 'description' ];
				$tempFID = $_POST[ 'FID' ];
				//below SQL query will update the existing faculty 
				$sql="UPDATE `subjects` SET sub_name='$tempsub_name',sub_code='$tempsub_code',description='$tempdescription', FID='$tempFID' WHERE sub_id=$new2"; 
				
				if (mysqli_query($connect, $sql)) {
					echo "<br>

					<br><br>
					<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Success!</strong> Subject Details updated has been updated.
					</div>";
					} else {
					// below statement will print error
					echo "<br><Strong>Subject Details Updating Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
					}
				//for close connection
					mysqli_close($connect);
						} 
				?>
            </div>
			

			<div class="col-md-3"></div>
	</div>
<?php include('allfoot.php'); ?>