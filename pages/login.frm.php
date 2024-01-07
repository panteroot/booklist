<?php
	include ("../config.php");
	include "../".LAYOUT."top.php";
?>	

<?php $valid = $_GET['valid']; ?>
<div class="container">
	
		<div class="col-sm-6 col-md-4 col-sm-offset-4">
			<h1 class="text-center login-title"><b class="text-info">Booklist</b></h1>
			
			<?php if($valid == 'NO') { ?>
				<div class="alert alert-danger text-center" role="alert">
					Invalid Username and/or Password!
				</div>
			<?php } ?>
			
			<div class="account-wall">
				<form class="form-signin" action="login.process.php" accept-charset="UTF-8" method="POST">
					<input type="text" class="form-control" placeholder="Username" name="username" required autofocus autocomplete="off">
					<input type="password" class="form-control" placeholder="Password" name="password" required>
					<br/>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
					Log in</button>
				</form>
			</div>			
		</div>
	
	<br/>
</div>


<?php
	include "../".LAYOUT."footer.php";
?>