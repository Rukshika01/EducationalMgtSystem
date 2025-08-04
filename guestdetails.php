<?php
session_start();

if($_SESSION["umail"]=="" || $_SESSION["umail"]==NULL)
{
header('Location:AdminLogin.php');
}

$userid = $_SESSION["umail"];
?>
<?php include('adminhead.php'); ?>
	
	<div class="container">
    <div class="row">
			<?php
					include("database.php");
					if(isset($_REQUEST['deleteid']))	{	
					include("database.php");
					$deleteid=$_GET['deleteid'];
					//deleting a particual guest SQL Query
					$sql="DELETE FROM `guest` WHERE GuEid = '$deleteid'";

					if (mysqli_query($connect, $sql)) {
					echo "

					<br><br>
					<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Success!</strong> Guest Details has been deleted.
					</div>";
					} else {
						//error message if SQL query fails
					echo "<br><Strong>Guest Details Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);
					}
						//close the connection
					mysqli_close($connect);
					}
			?>
		</div>
    
    
     <div class="row">
            <div class="col-md-12">
	<br>
				<?php
				include("database.php");
     			$sql="select * from  guest";
				$result=mysqli_query($connect,$sql);
				echo "<h3 class='page-header' >Guest Details</h3>";
				echo "<table id='guestTable'class='table table-striped table-hover' style='width:100%'>
				<thead>
				<tr>
					<th>#</th>
					<th>Guest Email</th>
					<th>Guest Name</th>
					<th>Actions</th>
				<tr>
				</thead>
				<tbody>";
				$count=1;
				while($row=mysqli_fetch_array($result))
				{	?>
					
					<tr>
						<td><?php echo $count?></td>
						 <td><?php echo $row['GuEid'];?></td>
						 <td><?php echo $row['Gname'];?></td>
						 <td><a href="updateguest.php?gid=<?php echo $row['GuEid']; ?>"><input type="button" Value="Edit" style="border-radius:0%" class="btn btn-success btn-sm"></a> 
						
					 </tr> 
					
				<?php $count++; } ?>
				</tbody>
				</table>     
            </div>
	</div>

<?php include('allfoot.php'); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

                <script>
                    $(document).ready( function () {
                        $('#guestTable').DataTable();
                    } );
                </script>