<?php include "includes/header.php"; ?>
<?php
	$prid	= isset($_GET['prid']) ? get_url_variables($_GET['prid']) : exit() ;
	$main	= isset($_GET['main']) ? get_url_variables($_GET['main']) : exit() ;
	$row_details = details_page($prid);
?>
	<section class="details-page-bg">
		<div class="container">
			<div class="row">				
				<div class="col-sm-12">
					<div class="features_items">
					<?php if(empty($row_details)) { ?>
						<div class="alert alert-danger text-center">
						  <strong>Product Not Found!</strong> Invalid Product Id Or Product Deleted! Go Back To <a href="index" class="alert-link">Home Page</a>.
						</div>
					<?php } else { ?>
						<div class="row">
							<div class="col-md-7" style="margin:12px 3px;">
								<ul class="pajeurl" style="margin:0px; padding: 0px;">
									<li><a href="">Home <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
									<li><a href="products/<?php echo restyle_url($main); ?>/all" class="text-capitalize"><?php echo $main; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
									<li><a href="javascript:void(0)"><?php echo $prid; ?></a></li>
								</ul>
							</div>
							<div class="col-md-5"></div>
						</div>
						<div class="row hrbotder">
							<div class="col-md-4 single-top-left">	
								<div class="flexslider">
									<ul class="slides">
									<?php 
										$ava_color = $row_details['colors']; $images = $row_details['images'];
										$ava_images = explode(',', $images); $ava_colors = explode(',', $ava_color);
										for($j = 1 ; $j <= $ava_images[0]; $j++) {
									?>
										<li data-thumb="proimg/<?php echo $row_details['id']; ?>/<?php echo $ava_colors[0].$j; ?>.jpg"  >
											<div class="thumb-image detail_images" id="slides"> <img src="proimg/<?php echo $row_details['id']; ?>/<?php echo $ava_colors[0].$j; ?>.jpg"  data-imagezoom="true" class="img-responsive" alt=""> </div>
										</li>
									<?php } ?>
										<div class="clearfix"></div>
									</ul>
								</div>
								<script>
									$(window).load(function(){
										$('.flexslider').flexslider({
											animation: "fade",
											controlNav: "thumbnails",
											autoplay: true
										});
									});
								</script>
							</div>
							
							<div class="col-md-5 single-top-right">
								<div class="row cardditeltop">
									<div class="col-md-6 pnamecirdsmall">	
										<h2 class="pnamecird"><?= $row_details['name'] ?></h2>
										<small>By <?= $row_details['brand'] ?></small>
										<p class="cardpri"><?php echo $currency; ?> <?= $row_details['price'] ?></p>
									</div>
									<div class="col-md-6" style="display: flex; flex-wrap: wrap; padding-right: 0;">
										<ul class="stocknum12">
											<li>Code</li><li><?= $row_details['id'] ?></li>								
										</ul>
										<ul class="stocknum">
											<li>Stock</li><li><?= $row_details['item_left'] ?></li>
										</ul>
										
										<p class="freeora" id="item_alert" style="displa: block; width: 100%; color: red;"> </p>
										<ul class="contatytopul">
											<img src="images/no-stock.png" alt="" id="no-stock" style="width: 150px;display: none;" />
											<li class="add-to-card" >
												<a>BUY NOW</a>
											</li>
											<li class="add-to-wishlist">
												<a data-id="<?php echo $row_details['id']; ?>">ADD TO WISHLIST</a>
											</li>
										</ul>
									</div>
								</div>
								
								<div class="syn-rightblock-two">
									<div class="row syn-desktop-view">
										<div class="syn-payment-methods col-md-6">
											<h3 class="payment-methods-heading">Payment Methods</h3>
											<p class="freeora1">Card/Cash on delivery</p>
											<p class="freeora1">bKash/Online payment</p>
											<?php
												$ava_size	= $row_details['size'];
												if($ava_size != '' && $ava_size != NULL) {
													$ava_size	= explode(',',$ava_size);
											?>
												<ul class="Sizepdc">
													<p>Size</p>
													<?php foreach($ava_size as $row_ava_size) { ?>
													<li class="pr-size-btn" data-size="<?= $row_ava_size ?>"><?= $row_ava_size ?></li>
													<?php }	?>
												</ul>
												<script>
													hasSize	= true;
													$('.pr-size-btn').click(function() {
														pr_size	= $(this).attr('data-size');
														$('.pr-size-btn').each(function(){$(this).css('background','#fff');});
														$(this).css('background','#d6d6d6');
													});
												</script>
											<?php } ?>
											<?php
												if($ava_color != '' && $ava_color != NULL) {
													$ava_color	= explode(',', $ava_color);
											?>
												<ul class="colorpdc">
													<p>Color</p>
													<?php
														foreach($ava_color as $row_ava_color) {
															$image_key	= array_search("{$row_ava_color}", $ava_color);
															$row_ava_image	= $ava_images[$image_key];	
													?>
													<li class="color1" onclick="image_change('<?= htmlspecialchars($row_ava_color); ?>', '<?= $row_ava_image ?>', this)" style="background: <?= $row_ava_color ?>"></li>
													<?php } ?>
												</ul>
												<script>hasColor = true;</script>
											<?php }	?>
												
												<p class="freeora" id="item_alert" style="color: red;"></p>
												<ul class="contatytopul">
													<li>
														<ul class="contaty">										
															<li class="item_minus">-</li>
															<li class="item_qty" data-value="1"><input type="text" value="1" class="item_qty_input" onkeyup="keyUpQty(this.value)" /></li>
															<li class="item_plus">+</li>
														</ul>
													</li>
												</ul>
										</div>
										<div class="syn-payment-security-guarenteed col-md-6">
											<div class="forodermin row">
												<div class="col-md-12">
													<div class="logoiconopad">
														<div class="logoiconad">
															<i class="fa fa-phone" aria-hidden="true"></i>						
														</div>
														<div class="logoiconpad">
															<p class="pnormelad">Call for Order</p>
															<p class="pstrongad"><?php echo get_contact_information('phone'); ?></p>
															<p class="pstrongad"><?php echo get_contact_information('mobile1'); ?></p>
															<p class="pstrongad"><?php echo get_contact_information('mobile2'); ?></p>
															<p class="pstrongad"><?php echo get_contact_information('mobile3'); ?></p>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<ul class="share">										
									<p class="shareli">Share on:</p>
									<li><a href="https://www.facebook.com/sharer.php?caption=<?php echo $companyName; ?>&description=<?php echo urlencode("Check Our New Products On ".$companyName); ?>&u=<?php echo urlencode($base.'details/'.$main.'/'.$prid); ?>&picture=<?php echo urlencode($base.'proimg/'.$prid.'/'.$ava_colors[0]).'1.jpg'; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<li><a href="http://twitter.com/share?text=<?php echo $companyName; ?>+Product&url=<?php echo urlencode($base.'details/'.$main.'/'.$prid); ?>&hashtags=<?php echo $companyName; ?>,Ecommerce,Products,<?php echo urlencode($main); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($base.'details/'.$main.'/'.$prid); ?>&title=<?php echo $companyName; ?>%20Products&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="https://plus.google.com/share?url=<?php echo urlencode($base.'details/'.$main.'/'.$prid); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($base.'proimg/'.$prid.'/'.$ava_colors[0]).'1.jpg'; ?>&media=<?php echo urlencode($base.'details/'.$main.'/'.$prid); ?>&description=" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-3 details-top-right">
								<ul class="list-group">
									<li class="list-group-item">
										<span class="title">Delivered In :</span>
										<p class="info"><i class="fa fa-map-marker"></i> Inside Dhaka City <span>2-3 Working Days</span></p>
										<p class="info"><i class="fa fa-map-marker"></i> Outside Dhaka City <span>4-5 Working Days</span></p>
									</li>
									<li class="list-group-item">
										<p class="info"><i class="fa fa-home"></i> Home Delivery</p>
										<p class="info"><i class="fa fa-handshake-o"></i> Cash On Delivery</p>
									</li>
									<li class="list-group-item">
										<span class="title">Return & Warranty:</span>
										<p class="info"><i class="fa fa-repeat"></i> 7 Day Free Shipping Return</p>
									</li>
									<li class="list-group-item">
										<span class="title">Delivery Cost:</span>
										<p class="info"><i class="fa fa-telegram"></i> Inside Dhaka: 50Tk</p>
										<p class="info"><i class="fa fa-telegram"></i> Outside Dhaka: 100Tk</p>
									</li>
								</ul>
							</div>
						</div>
						
						<div class="row hrbotder details-page-bottom">
							<h4 class="discription-review-title">Product Full Description</h4>
							<div class="discription-review-body">
								<?= $row_details['description'] ?>
							</div>
						</div>
						
						<div class="row hrbotder details-page-bottom" id="Rating">
							<div class="col-md-12">
								<h4 class="discription-review-title">Ratings &amp; Reviews</h4>
								<div class="discription-review-body">
									<div class="row reviews-top">
										<div class="reviews-title"><h4>Reviews</h4></div>
									<?php
										$result_comments = get_product_comments($prid) ;
										if($result_comments->num_rows > 0) {
									?>
										<?php while($row_comments = $result_comments->fetch_array() ){ ?>
										<div class="media">
											<div class="media-left">
												<img src="images/man3.png" class="media-object" style="width:60px">
											</div>
											<div class="media-body">
												<h4 class="media-heading"><?= $row_comments['name'] ?></h4>
												<p><?= $row_comments['message'] ?></p>
											</div>
										</div><hr/>
										<?php	}	?><?php mysqli_free_result($result_comments)	?>
									<?php	} else {	?>
										<div class="media" id="no-comment">
											<div class="media-body text-center">
												<p><i class="fa fa-meh-o fa-5x"></i></p>
												Sorry ! No Reviews Found
											</div>
										</div><hr/>
									<?php	}	?>
									</div>
									<div class="row reviews-bottom">
										<div class="col-lg-12 col-md-12">
											<h4>Your Review</h4>
											<p>Help us to improve product quality...</p>
											<form action="" id="reviewForm" method="post">
												<input type="hidden" name="comment_submit" value="1" />
												<input type="hidden" name="prid" value="<?php echo $prid; ?>" />
												<div class="form-group">
													<label>Your Comment </label>
													<textarea type="text" class="form-control" Name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
												</div>	
												<div class="row">
													<div class="col-md-6 form-group">
														<label>Your Name </label>
														<input type="text" class="form-control" value="Name" Name="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
													</div>
													<div class="col-md-6 form-group">
														<label>Your Email </label>
														<input type="email" class="form-control" value="Email" Name="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
													</div>
													<div class="clearfix"></div>
												</div>
												<input type="submit" class="btn btn-success" value="Submit">
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row hrbotder">
							<div class="row">
								<div class="febr">
									<h2>Related Products</h2>
								</div>
								
							<?php
								$result_trending	= get_suggestion($main ,4);
								while($row_trending	= $result_trending->fetch_array()) {
									$ava_color		= $row_trending['colors'];
									$ava_colors		= explode(',', $ava_color);
							?>
							
								<div class="col-md-3">
									<div class="proima">
										<div class="single-products  text-center">
											<div class="productinfo">
												<img src="proimg/<?php echo "{$row_trending['id']}"; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" />														
											</div>
											<div class="nameandprice1">
												<p><?php echo $row_trending['name'];?></p>
												<h5><?php echo $currency; ?> <?php echo $row_trending['price'];?></h5>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<ul class="wishlistall1">
														<div class="prbuttons">
															<li class="add_to_class_li"><a data-id="<?php echo $row_trending['id']; ?>">Add To Cart</a></li>
															<li class="details_li"><a href="details/<?php echo restyle_url($row_trending['category']); ?>/<?php echo $row_trending['id']; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
															<li><a class="add_to_wishlist_btn"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
														</div>
														<div class="prsizes" style="display: none;">
														<?php
															$ava_size	= $row_trending['size'];
															if($ava_size != '' && $ava_size != NULL) {
																$ava_size	= explode(',',$ava_size);
																foreach($ava_size as $row_ava_size) {
														?>
															<li class="pr_sizes_btn" data-size="<?= $row_ava_size ?>"><?= $row_ava_size ?></li>
														<?php 
																}
															}
														?>
														</div>
														<div class="prcolors" style="display: none;">
														<?php
															$ava_color	= $row_trending['colors'];
															if($ava_color != '' && $ava_color != NULL) {
																$ava_color	= explode(',',$ava_color);
																foreach($ava_color as $row_ava_color) {
														?>
															<li class="pr_color_btn" data-color="<?= $row_ava_color ?>" style="background: <?= $row_ava_color ?>;"></li>
														<?php	
																}
															}
														?>
														</div>
													</ul>
												</div>
											</div>
											<div class="product-overlay success-gif" data-id="<?php echo $row_trending['id']; ?>" style="display: none;">
												<div class="overlay-content">
													<ul class="wishlistall1">
														<div class="pradded">
															<img src="images/checkmark.gif" width="30px" alt="" />
														</div>
														<div class="prqty" style="display: none;">
															<li class="item_minus added-product-quantiy remove_item_from_cart">&times;</li>
															<li class="item_qty added-product-quantiy" data-qty="1">1</li>
															<li class="item_plus added-product-quantiy" data-left="<?php echo $row_trending['item_left']; ?>">+</li>
														</div>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							<?php
								}
								mysqli_free_result($result_trending);
							?>
							</div>
						</div>
						
						<script>
							cart_total = <?php echo "{$cart_total}"; ?>;

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
							
							function PostProductToAjax(pr_id,pr_size,pr_color,that) {
								$.post("ajax",{
								  prid: pr_id,
								  qty: 1,
								  size: pr_size,
								  color: pr_color,
								  add: 1
								}, function(data,status){
									cart_total++;
									$('.badge.shopping-cart-badge').html(cart_total);
								});
								
								setTimeout(function(){
									//$(that).closest('.product-overlay').next().find('.prqty').fadeIn();
									//$(that).closest('.product-overlay').next().find('.pradded').hide();
									$(that).closest('.product-overlay').next().hide();
									
								}, 3000);
							}
						</script>
						<script>
							$(function(){$('span.stars').stars({starSize: 13});});
							$("#reviewForm").submit(function(e) {
								e.preventDefault();
								var url = "ajax"; 
								$.ajax({
								 type: "POST",
								 url: url,
								 data: $("#reviewForm").serialize(), 
								 success: function(data){
										if($('#no-comment').length) $('#no-comment').hide();
										$('.row.reviews-top').append(data);
										$('html, body').animate({scrollTop: $(".row.reviews-top").offset().top}, 1000);
								 }
							 });
							});
						</script>
						<script>
							var item_left	= <?php echo isset($row_details['item_left']) ? $row_details['item_left'] : 0 ; ?>;
							var item_qty	= $('.item_qty_input').val();
							if(item_left == 0) {$('#no-stock').show(); $('.contaty').remove(); $('.add-to-card').remove(); $('.add-to-wishlist').remove();}
							
							$('.item_plus').click(function() {
								if(item_qty < item_left) {
									item_qty++;
									$('#item_alert').html('');
									keyUpQty(item_qty);
								} else {
									$('#item_alert').html('* Low Stock');
									return false;
								}
								
								$('.item_qty_input').val(item_qty);
								$('.item_qty').attr('data-value', item_qty);
							});
							$('.item_minus').click(function() {
								if(item_qty > 1) {
									item_qty--;
									$('#item_alert').html('');
									keyUpQty(item_qty);
								} else {
									$('#item_alert').html('* Minimmum quantity selection is 1');
									return false;
								}
								
								$('.item_qty_input').val(item_qty);
								$('.item_qty').attr('data-value', item_qty);
							});
							
							$('.add-to-wishlist').click(function(){
								$this	= $(this);
								pr_id	= $this.find('a').attr('data-id');
								$.post("ajax",{
									prid: pr_id,
									wishlist_add: 1
								}, function(data,status){
									if(data == 1) {
										$this.find('a').html('<i class="fa fa-check"></i> Added');
									}else if(data == 2){
										$this.find('a').html('Already Added')
									}else {
										window.location="login?wishlist="+data;
									}
								});
							});
							
							$('.add-to-card').click(function(){
								//Check Product Size 
								if(typeof(hasSize) != "undefined") {
									if(typeof(pr_size) == "undefined") {
										$('#item_alert').html('Please Select Product Size');
										return false;
									}
								} else {
									pr_size	= 'N/A';
								}
								
								if(typeof(hasColor) != "undefined") {
									if(typeof(pr_color) == "undefined") {
										$('#item_alert').html('Please Select Product Color');
										return false;
									}
								} else {
									pr_color	= 'N/A';
								}
								
								$('#item_alert').html('');
								//POST ID TO ADD PRODUCT TO Cart
								$.post("ajax", {
									prid: <?php echo $row_details['id']; ?>,
									qty: item_qty,
									size: pr_size,
									color: pr_color,
									add: 1
								}, 
								function(data,status){
									window.location.href="cart";
								});
							});
							
							function keyUpQty(value) {
								if(value <= item_left) {
									item_qty = value;
									value = value.toString();
									$('#item_alert').html('');
								} else {
									$('#item_alert').html('* Low Stock');
									$('.item_qty_input').val(item_left);
								}
								
								$('.item_qty').css({
									"width" : 30+(12*(value.length-1)),
								}) 
							}
						</script>
						<script>
							function image_change(color, count , that) {
								pr_color	= color;
								$('.color1').each(function(){
									$(this).html('');
								});
								
								$(that).html('<i class="fa fa-check"></i>');
								
								var htmlforetalage 	 = "";
								htmlforetalage		+= '<div class="flexslider_new">';
								htmlforetalage		+= '	<ul class="slides" style="left: 90px;">';
								for(i = 1; i <= count; i++) {
									htmlforetalage 	 	+= '	<li data-thumb="proimg/<?php echo $row_details['id']; ?>/'+color+i+'.jpg"  >';
									htmlforetalage		+= '		<div class="thumb-image detail_images" id="slides"> <img src="proimg/<?php echo $row_details['id']; ?>/'+color+i+'.jpg"  data-imagezoom="true" class="img-responsive" alt=""> </div>';
									htmlforetalage		+= '	</li>';
								}
								htmlforetalage		+= '	</ul>';
								htmlforetalage		+= '</div>';

								
								$('.col-md-7.single-top-left').html(htmlforetalage);
								
								$('.flexslider_new').flexslider({
									animation: "fade",
									controlNav: "thumbnails",
									autoplay: true
								});
							}
						</script>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
		
<?php 
	include "includes/footer.php";
?>