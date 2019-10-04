<?php 
	include "includes/header.php";
?>

<section id="contact" class="agile-login">
	<div class="wrapper inner-page">
		<div class="inner-page-header">
			<h2 class="text-center" ><img src="images/contact-us-banner.png" width="100%"/><span>Contact Us</span> </h2>
		</div>	
		<div class="inner-page-content">
			<div class="row">
				<div class="col-md-4 text-center">
					<img class="usp-img" src="images/icons/email.png" alt="">
					<div class="contact-box">
						<h3 class="sub-heading usp-heading">Email</h3>
						<p class="usp-text"><a href="mailto:<?php echo get_contact_information('email'); ?>"><?php echo get_contact_information('email'); ?></a></p>
					</div>
				</div>
				
				<div class="col-md-4 text-center">
					<img class="usp-img" src="images/icons/phone.png" alt="">
					<div class="contact-box">
						<h3 class="sub-heading usp-heading">Phone</h3>
						<p class="usp-text"><a href="tel:<?php echo get_contact_information('phone'); ?>"><?php echo get_contact_information('phone'); ?></a></p>
					</div>
				</div>
				
				<div class="col-md-4 text-center">
					<img class="usp-img" src="images/icons/social.png" alt="">
					<div class="contact-box">
						<h3 class="sub-heading usp-heading">Social</h3>
						<div class="content-row" style="padding:0px;">
							<div class="content-column lg" style="padding:0px;">
								<a href="<?php echo get_contact_information('facebook'); ?>"><img class="social-icon" src="images/icons/fb-icon.png" alt=""></a>
								<a href="<?php echo get_contact_information('twitter'); ?>"><img class="social-icon" src="images/icons/twitter-icon.png" alt=""></a>
								<a href="<?php echo get_contact_information('instagram'); ?>"><img class="social-icon" src="images/icons/insta-icon.png" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="margin: 20px 0px;">
				<div class="col-md-7">
					<iframe
						width="100%" style="height:300px"
						frameborder="0" style="border:0"
						src="https://www.google.com/maps/embed/v1/place?key=<?php echo $GoogleMapApi; ?>&q=<?php echo urlencode(get_contact_information('address')); ?>" 
						allowfullscreen >
					</iframe>
				</div>

				<div class="col-md-5">
					<h4><strong>Get in Touch</strong></h4>
					<form action="mail" method="post" id="contactForm" novalidate>
						<input type="hidden" name="contactFormSubmit" value="1"/>
						<div class="form-group">
							<input name="name" type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group">
							<input name="email" type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group">
							<input name="telephone" type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group">
							<textarea name="comments" class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
							<p class="help-block text-danger"></p>
						</div>
					
						<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send Message</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

<?php
	include "includes/footer.php";
?>