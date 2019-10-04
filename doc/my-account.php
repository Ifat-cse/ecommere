<?php
	ob_start(); 
	include "includes/header.php";
?>

<?php 
	if(!isset($_COOKIE['clt'])) {
		header('Location: login');
	}
	
	$token	= $_COOKIE['clt'];
	$result_user	= get_user_info($token);
	
	if($result_user->num_rows ==1) {
		$row_user	= $result_user->fetch_array();
	} else {
?>
	<div class="alert alert-warning">
		Invalid Token ! Or User May Be Deleted ! <a href="logout">Clear Token</a>
	</div>
<?php
		include "includes/footer.php";
		exit;
	}
?>


	<div class="agile-login">
		<div class="wrapper my-account">
			<h2>Welcome, <?php echo $row_user['last_name']; ?> &nbsp; <a href="logout">Sign Out</a></h2>
			<div class="w3ls-form inner-page">
				<table class="table">
					<form method="post" action="" id="updadeMyAccount">
						<input type="hidden" name="updadeMyAccount" />
						<input type="hidden" name="id" value="<?php echo $row_user['id']; ?>"/>
						<thead>
							<tr>
								<td>First Name:</td>
								<td><input type="text" name="first_name" class="form-control" value="<?php echo $row_user['first_name']; ?>"/></td>
							</tr>
							<tr>
								<td>Last Name:</td>
								<td><input type="text" name="last_name" class="form-control" value="<?php echo $row_user['last_name']; ?>" /></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input type="text" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" /></td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text" name="address" class="form-control" value="<?php echo $row_user['address']; ?>" /></td>
							</tr>
							<tr>
								<td>City:</td>
								<td><input type="text" name="city" class="form-control" value="<?php echo $row_user['city']; ?>" /></td>
							</tr>
							<tr>
								<td>District:</td>
								<td><input type="text" name="district" class="form-control" value="<?php echo $row_user['district']; ?>" /></td>
							</tr>
							<tr>
								<td>Postal Code:</td>
								<td><input type="text" name="postalcode" class="form-control" value="<?php echo $row_user['postalcode']; ?>" /></td>
							</tr>
							<tr>
								<td>Mobile Number:</td>
								<td><input type="text" name="mobile_number" class="form-control" value="<?php echo $row_user['mobile_number']; ?>" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Update" class="btn btn-success"></td>
							</tr>
						</thead>
					</form>
				</table>
				<?php 
					if(!empty($row_user['wishlists'])) {
				?>

				<div class="my-wishlist">
					<div id="slider-carousel2" class="carousel slide" data-ride="carousel">
						
						<div class="dailysell"> MY WISHLISTS </div>
						
						<div class="carousel-inner">
						<?php 
							$sliders_i		= 0;
							$wishlists		= explode(',' , $row_user['wishlists']);
							
							foreach($wishlists as $row_wishlist) {
								$prid	= $row_wishlist;
								$row_details	= details_page($prid);
										
								$ava_color		= $row_details['colors'];
								$ava_colors		= explode(',', $ava_color);
						?>
						
							<div class="item <?php if($sliders_i == 0){echo "active";} ?>">									
								<div class="col-md-4">										
									<img src="<?php echo "proimg/{$row_details['id']}/{$ava_colors[0]}1.jpg" ?>" class="sl img-responsive" alt="" />
								</div>
								<div class="col-md-8 sl2sm7">
									<h4 class="sl2h4"><?php echo "{$row_details['name']}" ;?></h4>
									<?php 
										$previous_price	= $row_details['price'];
										$discount_taka	= $previous_price*($row_details['discount']/100);
										$discount_price	= $previous_price-$discount_taka;
									?>
									<div><span class="preseprice"><?php echo $currency.' '.$discount_price ;?></span><?php if($discount_taka > 0){ ?> <span class="preprice"><?php echo $currency.' '.$row_details['price'] ;?></span><?php }?></div>
									<div class="wishlis2">
										<li><a href="details/<?php echo restyle_url($row_details['category']) ;?>/<?php echo $row_details['id'] ;?>">Details</a></li>
										<li class="wishlist_added" data-array-num="<?php echo $sliders_i; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></li>
									</div>
								</div>									
							</div>
							
						<?php
								$sliders_i++;
							}
							//mysqli_free_result($result_sliders);
						?>
						</div>

						<a href="#slider-carousel2" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel2" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
				
				<?php 
					}
				?>
			</div>
		</div>
	</div>
</div>


<?php
	include "includes/footer.php";
?>