	<div class="before-footer-wrap">
		<div class="container">
			<!--div class="footer-newsletter">
				<div class="media"> <i class=" footer-newsletter-icon  fa fa-plane"></i>
					<div class="media-body">
						<div class="clearfix">
							<div class="newsletter-header">
								<h5 class="newsletter-title">Sign up to Newsletter</h5> <span class="newsletter-marketing-text">...and receive <strong>coupon for first shopping</strong></span></div>
							<div class="newsletter-body">
								<form action="#" method="post" class="newsletter-form"><input type="hidden" name="newsletter_add" value="1"/><input type="text" name="email" placeholder="Enter your email address"> <input class="button" name="submitNewsletter" type="submit" value="Sign up" /></form>
							</div>
						</div>
					</div>
				</div>
			</div-->
			<div class="footer-social-icons">
				<ul class="social-icons nav">
					<li class="nav-item"><a class="sm-icon-label-link nav-link" href="<?php echo get_contact_information('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
					
				</ul>
			</div>
		</div>
	</div>
	
	<footer id="footer">
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="single-widget">
							<div class="media">
								<span class="media-lefticon"><i class="fa fa-headphones"></i></span>
								<div class="media-body"> <div class="call-us-title">Got Questions ? Call us 24/7!</div> 
								<div class="call-us-title"><?php echo get_contact_information("mobile1"); ?></br> <?php echo get_contact_information("mobile2"); ?></br> <?php echo get_contact_information("mobile3"); ?></br> <?php echo get_contact_information("phone"); ?></div>
								<div class="call-us-title"><span class="bkash">bkash/Rocket(Personal)</span> 01820511002 </br><?php echo get_contact_information("email"); ?></div>
								<address class="footer-contact-address"><?php echo get_contact_information("address"); ?></address> <a href="https://www.google.com/maps/search/<?php echo urlencode(get_contact_information("address")); ?>" class="btn  get" target="_blank"> Find us on map </a></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="single-widget">
							<h2 >Payment Method</h2>
							<ul class="brand22">
								<li class="li2">							
									<img src="images/footer/gift.png" alt="" />							
								</li>
								<li class="li2">							
									<img src="images/footer/bkash.png" alt="" />							
								</li>
								
								<li class="li2">							
									<img src="images/footer/rok.jpg" alt="" />							
								</li>								
								
							</ul>
							
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="single-widget">
							<h2>FIND IT FAST</h2>
							<ul class="nav nav-pills nav-stacked">
							<?php
								$foot_col_i		= 1;
								$result_main	= get_menu();
								while($row_menu = $result_main->fetch_array()) {
							?>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="products/<?php echo restyle_url($row_menu['main']); ?>/all"><?php echo strtoupper(trim($row_menu['main'])); ?></a></li>
							
							<?php	if($foot_col_i == 4) {	?>
							</ul>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="single-widget">
							<h2 class="displ-nio">&nbsp;</h2>
							<ul class="nav nav-pills nav-stacked">
							<?php } ?>
							<?php
									$foot_col_i++;
								}
								mysqli_free_result($result_main);
							?>
							</ul>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="single-widget ">
							<h2>Customer Care</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="my-account">My account</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="about">About Shop</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="wishlists">Wishlists</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="page/customer-service">Customer Service</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="privacy">Returns/Exchange</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="faqs">FAQs</a></li>
								<li><i class="fa fa-chevron-right" aria-hidden="true"></i><a href="contact">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="pull-left">
						<img src="images/logo.png" class="footerlogo">
					</div>
					<p class="pull-right">Copyright © <?php echo date("Y"); ?>  All rights reserved. Developed by <span><a target="_blank" href="http://www.facebook.com/Weird0o/">Ifat</a></span></p>
				</div>
			</div>
		</div>
	</footer>
	
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/imagezoom.js"></script> 
	<script src="js/jquery.flexslider.js"></script> 
	<script src="js/pagefunctions.js"></script> 
</body>
</html>

<?php 
	if(isset($conn)) {
		mysqli_close($conn);
	}
?>