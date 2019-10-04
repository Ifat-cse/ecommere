<?php 
	include "includes/header.php";
?>
	<div class="container">
		<div class="services">
			<h3>Services &amp; Refund Policy</h3>
			<div class="w3ls_service_grids">
				<div class="col-md-5 w3ls_service_grid_left">
					<h4>High Quality Product</h4>
					<p>
						M3nzcart 
					</p>
				</div>
				<div class="col-md-7 w3ls_service_grid_right">
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/18.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/19.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/20.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="w3ls_service_grids1">
				<div class="col-md-6 w3ls_service_grids1_left">
					<img src="images/4.jpg" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 w3ls_service_grids1_right">
					<ul>
						<li>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							You can get back the full value of the purchased product for any reason after accepting the product. In the case of maximum 48 hours after receiving the product <?php echo $row_direct['email']; ?> or our hotline number <?php echo $row_direct['phone']; ?> We need to notify us by calling this number. In order to withdraw the full refund of the product, the product must be fully intact / trim free and you have to send the product to today's office, note that you have to bear all the transportation costs for the return. If there is no extra charge, you can return the product without accepting it.
						</li>
						<li>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							Our Complaint Team will call you for any complaints related to products and services. For this, we want you to be active on the phone until your complaint is resolved. If the number given on your contact is not activated, the option number must be active. You will need to tell us the refund money for refund. If we do not receive any kind of cooperation on phone or email within 15 working days, we will consider your complaint as an adjudication.
						</li>

					</ul>
					<a href="all-products">View Products</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="services-bottom">
			<div class="container">
				<div class="col-md-3 about_counter_left">
					<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
					<p class="counter">89,147</p> 
					<h3>Followers</h3>
				</div>
				<div class="col-md-3 about_counter_left">
					<i class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></i>
					<p class="counter">54,598</p> 
					<h3>Savings</h3>
				</div>
				<div class="col-md-3 about_counter_left">
					<i class="glyphicon glyphicon-export" aria-hidden="true"></i>
					<p class="counter">83,983</p> 
					<h3>Supports</h3>
				</div>
				<div class="col-md-3 about_counter_left">
					<i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>
					<p class="counter">45,894</p> 
					<h3>Popularity</h3>
				</div>
				<div class="clearfix"> </div>
				<!-- Stats-Number-Scroller-Animation-JavaScript -->
					<script src="js/waypoints.min.js"></script> 
					<script src="js/counterup.min.js"></script> 
					<script>
						jQuery(document).ready(function( $ ) {
							$('.counter').counterUp({
								delay: 10,
								time: 1000
							});
						});
					</script>
				<!-- //Stats-Number-Scroller-Animation-JavaScript -->

			</div>
		</div>
		<div class="newsletter-top-serv-btm">
			<div class="container">
				<div class="col-md-4 wthree_news_top_serv_btm_grid">
					<div class="wthree_news_top_serv_btm_grid_icon">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<h3>Free Deliverty</h3>
					<p> If you shop at 3500 BDT, we offer free delivery in any place of Bangladesh, in this case use 'freedeshidosh' coupon.	</p>
				</div>
				<div class="col-md-4 wthree_news_top_serv_btm_grid">
					<div class="wthree_news_top_serv_btm_grid_icon">
						<i class="fa fa-bar-chart" aria-hidden="true"></i>
					</div>
					<h3>Free Return</h3>
					<p>If we do not like the product or if there is any problem in any product, then we get a free return from our store.</p>
				</div>
				<div class="col-md-4 wthree_news_top_serv_btm_grid">
					<div class="wthree_news_top_serv_btm_grid_icon">
						<i class="fa fa-truck" aria-hidden="true"></i>
					</div>
					<h3>Fast Delivery</h3>
					<p>In Bangladesh, our store has fast product delivery. In this case, the promise of reaching out to the buyer within two days of any product from the day of order.</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<?php 
	include "includes/footer.php";
?>