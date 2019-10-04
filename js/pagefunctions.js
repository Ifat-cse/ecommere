$(document).ready(function() {
	$('#loginForm').submit(function(e) {
		var ref_page	= $(this).find('input[name="ref_page"]').val();
		
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 0) {
					showPageAlert('Invaild Username Or Password !');
					$this.button('reset');
				} else if(data == 1) {
					window.location.href=ref_page;
				} else {
					showPageAlert(data);
				}
			}
		});

		e.preventDefault();
	});
	$('#registrationForm').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 1) {
					showPageAlert('Successfully Registered ! Please go back to <a href="index">Home</a> Page');
				} else if(data == 2) {
					showPageAlert('Email Or Mobile Number Already Registered !');
				} else {
					showPageAlert(data);
				}
			}
		});

		e.preventDefault();
	});
	$('#contactForm').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $("#contactForm").serialize(), 
			success: function(data){
				showPageAlert(data);
			}
		});

		e.preventDefault();
	});
	$('#updadeMyAccount').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $("#updadeMyAccount").serialize(), 
			success: function(data){
				showPageAlert(data);
			}
		});

		e.preventDefault();
	});
	$("#newslettersubmit").submit(function(e) {
		showPageLoading();
		var url = "ajax"; 

		$.ajax({
			type: "POST",
			url: url,
			data: $("#newslettersubmit").serialize(), 
			success: function(data){
				showPageAlert(data);
			}
		});

		e.preventDefault();
	});
	$("#couponForm").submit(function(e) {
		e.preventDefault();
		showPageLoading();
		
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 12) {
					showPageAlert('You have '+data+'% discount');
				} else {
					showPageAlert(data);
				}
			}
		});
		
	});
	$(".pass").click(function() {
		var html	 = '<div class="w3ls-form">';
		html	 	+= '	<form action="#" method="post" id="forgotPassword">';
		html		+= '		<input type="hidden" name="forgotPassword" />';
		html		+= '		<label>Email Or Phone</label>';
		html		+= '		<input type="text" name="username" placeholder="Enter Your Email Or Phone" required/>';
		html		+= '		<input type="submit" value="Send" />';
		html		+= '	</form>';
		html		+= '</div>';

		showPageAlert(html);
	});
	$("#forgotPassword").on('submit', function(e) {
		showPageLoading();
		var url = "ajax"; 

		$.ajax({
			type: "POST",
			url: url,
			data: $(this).serialize(), 
			success: function(data){
				showPageAlert(data);
			}
		});

		e.preventDefault(); 
	});
	
	if($('div.product-item').length > 0) {
		var maxHeight = Math.max.apply(null, $("div.product-item").map(function(){
			return $(this).height();
		}).get());
		$('div.product-item').height(maxHeight);
	}
	
	/*------------------------------------------
	------------ PHP CEHECKOUT ----------------*/
	$('.first-tab-btn').click(function(){
		$('#menu1-btn').click();
	});
	$('.second-tab-btn').click(function(){
		$('#menu2-btn').click();
		$('#menu2-btn').parent().removeClass('disabled');
		
		var twi	= parseInt($('.order-summery #total-without-includes').text());
		var dt	= parseInt($('.order-summery #discount-total').text());
		if(orderLocation.toLowerCase() == 'dhaka') {var dl='Dhaka City'; var dc = 50;} else {var dl=orderLocation; var dc = 100;}
		var t	= twi-dt+dc;
		
		$('.order-summery #delivery-location').html(dl+' Division');
		$('.order-summery #delivery-total').html(dc);
		$('.order-summery #total-with-includes').html(t);
	});
	$('.third-tab-btn').click(function(){
		$('#menu3-btn').click();
		$('#menu3-btn').parent().removeClass('disabled');
	});
	
	$('.quick-checkout-btn').click(function(){
		$('.not-logged-in').hide();
		$('.quick-checkout').fadeIn('slow');
	});
	$('.back-login-btn').click(function(){
		$('.quick-checkout').hide();
		$('.not-logged-in').fadeIn('slow');
	});
	
	$('#quickCheckout').submit(function(e){
		$('#menu2-btn').click();
		$('#menu2-btn').parent().removeClass('disabled');
		
		userToken		= '';
		orderLocation	= $(this).find('select[name="delivery_location"]').val()
		mobileNumber	= $(this).find('input[name="mobile_number"]').val();
		fullAddress		= $(this).find('textarea[name="address"]').val();
		
		var twi	= parseInt($('.order-summery #total-without-includes').text());
		var dt	= parseInt($('.order-summery #discount-total').text());
		if(orderLocation == 'dhaka') {var dl='Dhaka'; var dc = 50;} else {var dl='Outside Dhaka'; var dc = 100;}
		var t	= twi-dt+dc;
		
		$('.order-summery #delivery-location').html(dl);
		$('.order-summery #delivery-total').html(dc);
		$('.order-summery #total-with-includes').html(t);
		e.preventDefault()
	});
	
	$('.payment-information .radio-inline').click(function(){
		var payment_type	= $('input[name=payment_type]:checked', '#co-payment-information').val();
		
		if(payment_type == 'bkash' || payment_type == 'rocket') {
			$('.get-transaction-id').slideDown();
			$('.get-transaction-id #payment-type').html(payment_type);
		} else {
			$('.get-transaction-id').slideUp('fast');
		}
		
		$('.payment-information .radio-inline').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
	});
	
	$('.submit-order').click(function(){
		paymentType	= $('input[name=payment_type]:checked', '#co-payment-information').val();
		paymentNumber	= $('input[name=account_number]', '#co-payment-information').val();
		paymentTrxnId	= $('input[name=transaction_id]', '#co-payment-information').val();
		
		if(paymentType == 'bkash' || paymentType == 'rocket') {
			if(paymentNumber == '' || paymentNumber == null || paymentTrxnId =='' || paymentTrxnId == null) {
				showPageAlert('Please Enter Payment Number and Transaction Id !!');
				return false;
			}
		}
		
		$.post("ajax", {
			order_submit: 1,
			userToken: userToken,
			mobileNumber: mobileNumber,
			orderLocation: orderLocation,
			fullAddress: fullAddress,
			paymentType: paymentType,
			paymentNumber: paymentNumber,
			paymentTrxnId: paymentTrxnId
		}, 
		function(data){
			window.location="thank-you?"+data; 
		});
	});
	/*------------------------------------------
	-------------- PHP Cart ------------------*/
	cart_total 	= $('#cart_total').text();
	cart_total	= parseInt(cart_total);
	
	$('.add_to_wishlist_btn').click(function(){
		$this	= $(this);
		pr_id	= $this.find('a').attr('data-id');
		$.post("ajax",{
		  prid: pr_id,
		  wishlist_add: 1
		}, function(data,status){
			if(data == 1) {
				border_color	= $this.css("border-color");
				$this.css("background", border_color);
				$this.find('i').css("color", "#FFF");
			}else if(data == 2){
				showPageAlert('Already Added');
				border_color	= $this.css("border-color");
				$this.css("background", border_color);
				$this.find('i').css("color", "#FFF");
			}else {
				//alert(data);
				window.location="login?wishlist="+data;
			}
		});
	});
	$('.wishlist_added').click(function(){
		$this		= $(this);
		array_id	= $this.attr('data-array-num');
		$.post("ajax",{
		  id: array_id,
		  remove_wishlist: 1
		}, function(data,status){
			if(data == 1) {
				window.location='my-account';
			}else {
				//alert(data);
				showPageAlert(data);
			}
		});
	});

	$('.add_to_class_li').click(function(){
		pr_id	= $(this).find('a').attr('data-id');
		that	= this;
		
		$(this).closest('.wishlistall1').find('.prbuttons').hide();	
		
		if($(this).closest('.wishlistall1').find('.prsizes').children().length>0){
			$(this).closest('.wishlistall1').find('.prsizes').fadeIn();
		} else if($(this).closest('.wishlistall1').find('.prcolors').children().length>0) {
			pr_size		= 'N/A';
			
			$(this).closest('.wishlistall1').find('.prcolors').fadeIn();
		} else {
			pr_size		= 'N/A';
			pr_color	= 'N/A';
			
			$(this).closest('.product-overlay').next().fadeIn();
			PostProductToAjax(pr_id,pr_size,pr_size,that);
		}
	});

	$('.pr_sizes_btn').click(function(){
		pr_size	= $(this).attr('data-size');
		that	= this;
		
		$(this).closest('.wishlistall1').find('.prsizes').hide();	
		
		if($(this).closest('.wishlistall1').find('.prcolors').children().length>0) {
			$(this).closest('.wishlistall1').find('.prcolors').fadeIn();
		} else {
			pr_color	= 'N/A';
			
			$(this).closest('.product-overlay').next().fadeIn();
			PostProductToAjax(pr_id,pr_size,pr_color,that);
		}
	});
	$('.pr_color_btn').click(function(){							
		pr_color	= $(this).attr('data-color');
		that	= this;
		
		$(this).closest('.wishlistall1').find('.prcolors').hide();	
		$(this).closest('.product-overlay').next().fadeIn();
		
		PostProductToAjax(pr_id,pr_size,pr_color,that)
	});
	
	$('.single-products').mouseleave(function(){
		$(this).find('.prbuttons').show();	
		$(this).find('.prsizes').hide();	
		$(this).find('.prcolors').hide();	
	});
});

$(document).ready(function(){
	$('a[href="#"]').click(function(e){
		e.preventDefault();
	});
	
	$(window).scroll(function() {
		var windscroll = $(window).scrollTop();
		
		if (windscroll >= 135) {

			$('#top').addClass('attach-fixed');
		}else {
			$('#top').removeClass('attach-fixed');
		}
	});	
});

function isInt(n) {
    return +n === n && !(n % 1);
}
function PostProductToAjax(pr_id,pr_size,pr_color,that) {
	$.post("ajax",{
	  prid: pr_id,
	  qty: 1,
	  size: pr_size,
	  color: pr_color,
	  add: 1
	}, function(data,status){
		cart_total++;
		$('#cart_total').html(cart_total);
	});
	
	setTimeout(function(){
		$(that).closest('.product-overlay').next().hide();
	}, 3000);
}
function showPageAlert(htmlToAlert) {
	$('body .page-alert .alert-text').html(htmlToAlert);
	$('body .page-alert').fadeIn('fast');
}
function showPageLoading() {
	$('body .page-alert .alert-text').html('<img src="images/ajax-loader.gif" class="loading"></img>');
	$('body .page-alert').show();
}
$('[data-close="pageAlert"]').click(function(){
	hidePageAlert();
}).children().click(function(e) {
	e.stopPropagation();
});
function hidePageAlert() {
	$('body .page-alert').fadeOut();
}