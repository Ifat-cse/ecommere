<?php 
	ob_start();
	include "includes/header.php";
?>
<?php
	$ref	= isset($_GET['ref']) ?  "{$base}my-account" : "{$base}my-account";
	if(isset($_COOKIE['clt'])) { header('Location:'.$ref);}
?>
	<div class="agile-login">
		<div class="wrapper">
		<?php 
			if(isset($_GET['wishlist'])) {
		?>
			<div class="alert alert-warning">
				You Must Login First!
			</div>
		<?php 
			}
		?>
			<h2>Login</h2>
			<div class="w3ls-form">
				<form action="#" method="post" id="loginForm">
					<input type="hidden" name="login" />
					<input type="hidden" name="ref_page" value="<?php echo $ref; ?>"/>
					
					<label>Username</label>
					<input type="text" name="username" placeholder="Username" required/>
					
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" required />
					
					<a href="#" class="pass">Forgot Password ?</a>
					<input type="submit" value="LogIn" />
				</form>
				<a href="register" class="newacc">Create New Account</a>
			</div>
		</div>
	</div>
</div>


<?php
	include "includes/footer.php";
?>