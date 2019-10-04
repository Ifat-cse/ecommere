<?php
	ob_start(); 
	include "includes/header.php";
?>

<?php 
	if(!isset($_COOKIE['clt'])) {
		header('Location: login/'.restyle_url($_SERVER['REQUEST_URI']));
	}
	$token	= $_COOKIE['clt'];
	$result_user	= get_user_info($token);
	
	if($result_user->num_rows ==1) {
		$row_user	= $result_user->fetch_array();
	} else {
?>
	<div class="alert alert-warning">
		Invalid Token ! Or User May Be Deleted ! <a href="logout.php">Clear Token</a>
	</div>
<?php
		include "includes/footer.php";
		exit;
	}
?>

<div class="agile-login">
	<div class="wrapper inner-page">
		<div class="main">
			<div class="registration_left">
				<h2 class="text-center">Welcome, <?php echo $row_user['last_name']; ?></h2>
				<div class="registration_form">
					<!-- Form -->
					<div class="col-md-8 col-md-offset-2 login-area">
						<?php 
							if(!empty($row_user['wishlists'])) {
						?>

						<div class="secendslider">
							<div class="col-md-4">
								<div class="dailysell"> Wishlists </div>
							</div>
							<div class="clearfix"></div>
						<?php
							$array_i		= 0;
							$wishlists		= explode(',' , $row_user['wishlists']);
							
							foreach($wishlists as $row_wishlist) {
								$prid	= $row_wishlist;
								$row_details	= details_page($prid);
										
								$ava_color		= $row_details['colors'];
								$ava_colors		= explode(',', $ava_color);
						?>
							<div class="single-wishlist">									
								<div class="col-md-3">								
									<img src="<?php echo "proimg/{$row_details['id']}/{$ava_colors[0]}1.jpg" ?>" class="img-responsive" alt="" />
								</div>
								<div class="col-md-9 sl2sm7">
									<h4 class="sl2h4"><?php echo "{$row_details['name']}" ;?></h4>
									<?php 
										$previous_price	= $row_details['price'];
										$discount_taka	= $previous_price*($row_details['discount']/100);
										$discount_price	= $previous_price-$discount_taka;
									?>
									<div><span class="preseprice"><?php echo $currency.' '.$discount_price ;?></span><?php if($discount_taka > 0){ ?> <span class="preprice"><?php echo $currency.' '.$row_details['price'] ;?></span><?php }?></div>
									<div class="wishlis2">
										<li><a href="details/<?php echo restyle_url($row_details['category']) ;?>/<?php echo $row_details['id'] ;?>">Details</a></li>
										<li class="wishlist_added" data-array-num="<?php echo $array_i; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></li>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php
								$array_i++;
							}
						?>
						</div>
						<script>
							$('.wishlist_added').click(function(){
								$this		= $(this);
								array_id	= $this.attr('data-array-num');
								$.post("ajax.php",{
								  id: array_id,
								  remove_wishlist: 1
								}, function(data,status){
									if(data == 1) {
										window.location='wishlists';
									}else {
										//alert(data);
										alert(data);
									}
								});
							});
						</script>
						<?php 
							} else {
						?>
						<div class="no-products">
							<h4> Wishlist Is Empty ! </h4>
							<ul>
								<li>You have no product in your wishlist </li>
								<li>Please go back. And add product to wishlist</li>
								<li>For any help, Please contact our help center</li>
							</ul>
						</div>
						<?php 
							}
						?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>


<?php
	include "includes/footer.php";
?>