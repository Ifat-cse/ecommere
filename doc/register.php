<?php 
	ob_start();
	include "includes/header.php";
?>
<?php 
	if(isset($_COOKIE['clt'])) {
		header('Location: my-account');
	}
?>

	<div class="agile-login">
		<div class="wrapper my-account">
			<h2>Create New Account</h2>
			<div class="w3ls-form inner-page">
				<form class="col-md-10 col-md-offset-1 login-area" id="registrationForm" action="ajax.php" method="post">
					<input type="hidden" name="register_user" />
					<div class="form-group">
						<label> First Name </label>
						<input class="form-control" name="first_name" placeholder="First Name:" type="text" tabindex="1" required autofocus>
					</div>
					<div class="form-group">
						<label> Last Name </label>
						<input class="form-control" name="last_name" placeholder="Last Name:" type="text" tabindex="2" required>
					</div>
					<div class="form-group">
						<label> Email </label>
						<input class="form-control" name="email" placeholder="Email Address:" type="text" tabindex="3" required>
					</div>
					
					<div class="form-group">
						<label> Mobile Number </label>
						<input class="form-control" name="phone" placeholder="Mobile Number:" type="text" tabindex="3" required>
					</div>
					
					
					
					<div class="form-group">
						<label> Password </label>
						<input class="form-control" name="password" placeholder="password" type="password" tabindex="4" required>
					</div>
					
					<div class="form-group">
						<label> Address </label>
						<input class="form-control" name="address_line_1" placeholder="Address:" type="text" tabindex="3" required>
					</div>
					
					<div class="form-group">
						<label> Devision/City </label>
						<select class="form-control" id="id_city" name="state">
							<option>Barisal</option>
							<option>Chittagong</option>
							<option selected="">Dhaka</option>
							<option>Khulna</option>
							<option>Mymensingh</option>
							<option>Rajshahi</option>
							<option>Rangpur</option>
							<option>Sylhet</option>
						</select>
					</div>
					
					<div class="form-group">
						<label> District/State </label>
						<select class="form-control" id="id_state" name="city">
							
						</select>
					</div>
					
					<div class="form-group hidden">
						<label> Postal Code </label>
						<input class="form-control" name="postalcode" placeholder="Postal Code:" type="text" tabindex="3">
					</div>
					
					<script>
						Chittagong	= ["Brahmanbaria", "Comilla", "Chandpur", "Lakshimpur", "Noakhali", "Feni", "Khagrachari", "Rangamati", "Bandarban", "Chittagong", "Coxs Bazar"];
						Dhaka		= ["Dhaka", "Gazipur", "Kishoreganj", "Manikganj", "Munshiganj", "Narayanganj", "Narshindi", "Tangail", "Faridpur", "Gopalganj", "Madaripur", "Rajbari", "Shariatpur"];
						Khulna		= ["Bagerhat", "Chuadanga", "Jessore", "Jhenaidah", "Khulna", "Kustia", "Magura", "Meherpur", "Narail", "Satkhira"];
						Barisal		= ["Barisal", "Borguna", "Bhola", "Jalokhathi", "Patuakhali", "Pirojpur"];
						Rajshahi	= ["Bogra", "Chapainawabganj", "Joypurhat", "Naogaon", "Natore", "Pabna", "Rajshahi", "Sirajganj"];
						Sylhet		= ["Hobiganj", "Moulvibazar", "Sunamganj", "Sylhet"];
						Rangpur		= ["Thakurgaon", "Rangpur", "Panchagarh", "Nilphamari", "Lalmonirhat", "Kurigram", "Gaibandha", "Dinajpur"];
						Mymensingh	= ["Jamalpur", "Mymensingh", "Netrokona", "Sherpur"];
						
						html_for_state	= '';
						for(sti = 0; sti < Dhaka.length; sti++){
							html_for_state	+= '<option value="'+Dhaka[sti]+'">'+Dhaka[sti]+'</option>';
						}
						$('#id_state').html(html_for_state);
												
						$('#id_city').change(function(){
							state_array	= eval($(this).val());
							
							html_for_state	= '';
							for(sti = 0; sti < state_array.length; sti++){
								html_for_state	+= '<option value="'+state_array[sti]+'">'+state_array[sti]+'</option>';
							}
							$('#id_state').html(html_for_state);
						});
					</script>
					<?php
						$alpha = "abcdefghijklmnopqrstuvwxyz";
						$alpha_upper = strtoupper($alpha);
						$numeric = "0123456789";
						$special = ".-+=_,!@$#*%<>[]{}";
						$chars = "";
						 

						// default [a-zA-Z0-9]{9}
						$chars = $alpha . $alpha_upper . $numeric;
						$length = 16;
						 
						$len = strlen($chars);
						$pw = '';
						 
						for ($i=0;$i<$length;$i++)
								$pw .= substr($chars, rand(0, $len-1), 1);
						 
						// the finished password
						$pw = str_shuffle($pw);
					?>
					
					<input type="hidden" name="token" value="<?php echo "{$pw}"; ?>" />
					<input type="hidden" name="ref" value="index" />
					
					<div class="form-group">
						<input type="submit" value="create an account" class="btn btn-success">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include "includes/footer.php";
?>