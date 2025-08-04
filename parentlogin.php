<?php include('allhead.php')?>

<style>
    body {
        background-color:#edf4f6;
    }
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<!-- Parent login page -->
			<fieldset>
				<legend>
					<h3 style="padding-top: 25px;font-size: xx-large;
    font-weight: bolder;
    text-align-last: center;"><span class="glyphicon glyphicon-lock"></span>&nbsp;  Parent Login</h3>
				</legend>
				<form name="parentlogin" action="loginlinkparent.php" method = "POST">
					<div class="control-group form-group">
						<div class="controls">
							<label>Email:</label>
							<input type="text" class="form-control" name="pemail" required>
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label>Passsword:</label>
							<input type="password" class="form-control" name="pass" required>
							<p class="help-block"></p>
						</div>
					</div>
					<center>
						
					<button type="submit" name="login" class="btn btn-success" style="border-radius:0%">Login</button>
						<button type="reset" class="btn btn-danger" style="border-radius:0%;">Clear</button>
						<br><br>
					<h5>Dont Have an Account? </h5>	 <a href="parentregistration.php" style="color: #00d1cc;font-weight: bolder;padding-right:20px;padding-left:20px;">Sign up</a>
					</center>
			</fieldset>
			</form>
		</div>

		<div class="col-md-4"></div>
	</div>
	<?php include('allfoot.php'); ?>