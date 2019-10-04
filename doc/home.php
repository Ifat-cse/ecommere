<?php 
	include "includes/header.php";
?>
	<div class="container">
		<div class=""id="slider" style="padding:0px;">
			<div id="slider-carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				<?php 
					$sliders_i		= 0;
					$result_sliders	= get_sliders('index', 1);
					while($row_sliders	= $result_sliders->fetch_array()) {
				?>
					<li data-target="#slider-carousel" data-slide-to="<?php echo $sliders_i; ?>" <?php if($sliders_i == 0){echo 'class="active"';} ?> ></li>
				<?php 
						$sliders_i++;
					}
					mysqli_free_result($result_sliders);
				?>
				</ol>	
				<div class="carousel-inner">
				<?php 
					$sliders_i		= 0;
					$result_sliders	= get_sliders('index', 1);
					while($row_sliders	= $result_sliders->fetch_array()) {
				?>
				
					<div class="item <?php if($sliders_i == 0){echo "active";} ?>">
						<div class="col-md-6 col-sm-6 col-xs-6 aligncenter">
							<h1><?php echo $row_sliders['image_text1']; ?></h1>
							<h2><?php echo $row_sliders['image_heading']; ?></h2>
							<p><?php echo $row_sliders['image_text2']; ?></p>
							<a href="<?php echo $row_sliders['text3_link']; ?>"><button type="button" class="btn btn-default get"><?php echo $row_sliders['image_text3']; ?></button></a>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<a href="<?php echo $row_sliders['text3_link']; ?>">
								<img src="<?php echo $row_sliders['image']; ?>" class="girl img-responsive" alt="" style="width: 100%;"/>
							</a>
						</div>
					</div>
					
				<?php
						$sliders_i++;
					}
					mysqli_free_result($result_sliders);
				?>
				</div>
				
				<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>								
		</div>
	</div>
	
	
	
	<?php 
		$result_na	= get_featured_product(25);
		if($result_na->num_rows > 0) {
	?>
	<section class="spd">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="category-tab">
						<div class="">
							<div class="tabul">
								<ul class="nav nav-tabs tablu">
									<h2>New Arrivals</h2>
								</ul>
							</div>							
						</div>
						<div class="">
							<div class="carousel slide" id="new-item-carousel" data-ride="carousel">
								<div class="carousel-inner">							
									<div class="fade active in item">
									<?php
										$pr_sl_i	= 1;
										while($row_na	= $result_na->fetch_array()) {
											$ava_color		= $row_na['colors'];
											$ava_colors		= explode(',', $ava_color);
											
											$pr_price				= $row_na['price'];
											$pr_discount_tk			= $pr_price*($row_na['discount']/100);
											
											$price_after_discount	= $pr_price - $pr_discount_tk;
									?>
										<div class="product-image-wrapper">
											<div class="single-products text-center">
												<div class="productinfo">
													<a href="details/<?php echo restyle_url($row_na['category']); ?>/<?php echo $row_na['id']; ?>"><img src="proimg/<?php echo $row_na['id']; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" /></a>
												</div>
												<div class="nameandprice1">
													<p><?php echo $row_na['name']; ?></p>
													<h5>
														<?php if($pr_discount_tk > 0){ ?><span class="old"><?php echo $currency.' '.$pr_price; ?></span><?php } ?>
														<?php echo $currency; ?> <?php echo $price_after_discount; ?>
													</h5>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<ul class="wishlistall1">
															<div class="prbuttons">
																<li class="add_to_class_li"><a data-id="<?php echo $row_na['id']; ?>">Add To Cart</a></li>
																<li class="details_li"><a href="details/<?php echo restyle_url($row_na['category']); ?>/<?php echo $row_na['id']; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
																<li class="add_to_wishlist_btn"><a data-id="<?php echo $row_na['id']; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
															</div>
															<div class="prsizes" style="display: none;">
															<?php
																$ava_size	= $row_na['size'];
																if($ava_size != '' && $ava_size != NULL) {
																	$ava_size	= explode(',',$ava_size);

																	foreach($ava_size as $row_ava_size) {
															?>
																<li class="pr_sizes_btn" data-size="<?php echo "{$row_ava_size}"; ?>"><?php echo "{$row_ava_size}"; ?></li>
															<?php 
																	}
																}
															?>
															</div>

															<div class="prcolors" style="display: none;">
															<?php
																$ava_color	= $row_na['colors'];
																if($ava_color != '' && $ava_color != NULL) {
																	$ava_color	= explode(',',$ava_color);
																
																	foreach($ava_color as $row_ava_color) {
															?>
																<li class="pr_color_btn" data-color="<?php echo $row_ava_color; ?>" style="background: <?php echo $row_ava_color; ?>;">&nbsp;</li>
															<?php	
																	}
																}
															?>
															</div>
														</ul>
													</div>
												</div>
												<div class="product-overlay success-gif" data-id="<?php echo $row_na['id']; ?>" style="display: none;">
													<div class="overlay-content">
														<ul class="wishlistall1">
															<div class="pradded">
																<img src="images/checkmark.gif" width="30px" alt="" />
															</div>
															<div class="prqty" style="display: none;">
																<li class="item_minus added-product-quantiy remove_item_from_cart">&times;</li>
																<li class="item_qty added-product-quantiy" data-qty="1">1</li>
																<li class="item_plus added-product-quantiy" data-left="<?php echo $row_na['item_left']; ?>">+</li>
															</div>
														</ul>
													</div>
												</div>
											</div>
										</div>
										
									<?php 
										if(($pr_sl_i%5 == 0) && ($pr_sl_i != $result_na->num_rows)) {
									?>
									</div>
									<div class="fade item in">
									<?php
										}
											$pr_sl_i++;
										}
										mysqli_free_result($result_na);
									?>
									</div>
								</div>
								<a class="left recommended-item-control" href="#new-item-carousel" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right recommended-item-control" href="#new-item-carousel" data-slide="next">
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
		}
	?>
	
	<?php 
		$result_trend	= get_trending(25);
		if($result_trend->num_rows > 0) {
	?>
	<section class="spd">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="category-tab">
						<div class="">
							<div class="tabul">
								<ul class="nav nav-tabs tablu">
									<h2>Trending</h2>
								</ul>
							</div>							
						</div>
						<div class="">
							<div class="carousel slide" id="recommended-item-trending" data-ride="carousel">
								<div class="carousel-inner">							
									<div class="fade active in item">
									<?php
										$pr_sl_i	= 1;
										while($row_trend	= $result_trend->fetch_array()) {
											$ava_color		= $row_trend['colors'];
											$ava_colors		= explode(',', $ava_color);
											
											$pr_price				= $row_trend['price'];
											$pr_discount_tk			= $pr_price*($row_trend['discount']/100);
											
											$price_after_discount	= $pr_price - $pr_discount_tk;
									?>
										<div class="product-image-wrapper">
											<div class="single-products text-center">
												<div class="productinfo">
													<a href="details/<?php echo restyle_url($row_trend['category']); ?>/<?php echo $row_trend['id']; ?>"><img src="proimg/<?php echo $row_trend['id']; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" /></a>
												</div>
												<div class="nameandprice1">
													<p><?php echo $row_trend['name']; ?></p>
													<h5>
														<?php if($pr_discount_tk > 0){ ?><span class="old"><?php echo $currency.' '.$pr_price; ?></span><?php } ?>
														<?php echo $currency; ?> <?php echo $price_after_discount; ?>
													</h5>
												</div>
																								<div class="product-overlay">
													<div class="overlay-content">
														<ul class="wishlistall1">
															<div class="prbuttons">
																<li class="add_to_class_li"><a data-id="<?php echo $row_trend['id']; ?>">Add To Cart</a></li>
																<li class="details_li"><a href="details/<?php echo restyle_url($row_trend['category']); ?>/<?php echo $row_trend['id']; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
																<li class="add_to_wishlist_btn"><a data-id="<?php echo $row_trend['id']; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
															</div>
															<div class="prsizes" style="display: none;">
															<?php
																$ava_size	= $row_trend['size'];
																if($ava_size != '' && $ava_size != NULL) {
																	$ava_size	= explode(',',$ava_size);

																	foreach($ava_size as $row_ava_size) {
															?>
																<li class="pr_sizes_btn" data-size="<?php echo "{$row_ava_size}"; ?>"><?php echo "{$row_ava_size}"; ?></li>
															<?php 
																	}
																}
															?>
															</div>

															<div class="prcolors" style="display: none;">
															<?php
																$ava_color	= $row_trend['colors'];
																if($ava_color != '' && $ava_color != NULL) {
																	$ava_color	= explode(',',$ava_color);
																
																	foreach($ava_color as $row_ava_color) {
															?>
																<li class="pr_color_btn" data-color="<?php echo $row_ava_color; ?>" style="background: <?php echo $row_ava_color; ?>;">&nbsp;</li>
															<?php	
																	}
																}
															?>
															</div>
														</ul>
													</div>
												</div>
												<div class="product-overlay success-gif" data-id="<?php echo $row_trend['id']; ?>" style="display: none;">
													<div class="overlay-content">
														<ul class="wishlistall1">
															<div class="pradded">
																<img src="images/checkmark.gif" width="30px" alt="" />
															</div>
															<div class="prqty" style="display: none;">
																<li class="item_minus added-product-quantiy remove_item_from_cart">&times;</li>
																<li class="item_qty added-product-quantiy" data-qty="1">1</li>
																<li class="item_plus added-product-quantiy" data-left="<?php echo $row_trend['item_left']; ?>">+</li>
															</div>
														</ul>
													</div>
												</div>
											</div>
										</div>
										
									<?php 
										if(($pr_sl_i%5 == 0) && ($pr_sl_i != $result_trend->num_rows)) {
									?>
									</div>
									<div class="fade item in">
									<?php
										}
											$pr_sl_i++;
										}
										mysqli_free_result($result_trend);
									?>
									</div>
								</div>
								 <a class="left recommended-item-control" href="#recommended-item-trending" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right recommended-item-control" href="#recommended-item-trending" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
		}
	?>
	
	<?php 
		$result_tc	= get_trending(25);
		if($result_tc->num_rows > 0) {
	?>
	<section class="spd">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div style="background-color:#f1f1f1" class="col-md-12">
						<div class="col-md-2"style="padding:0;">
							<div class="left-sidebar"id="left-sidebarmanu">
								<div class="panel-heading12">
									<h4 class="">
										Top
										categories
										this week
									</h4>
								</div>
							</div>
						</div>
				
						<div class="col-md-10" style="padding:0;">						
							<div class="">
								<div class="carousel slide" id="top-categories-carousel" data-ride="carousel">
									<div class="carousel-inner">							
										<div class="fade active in item">
										<?php
											$pr_sl_i	= 1;
											while($row_tc	= $result_tc->fetch_array()) {
										?>
											<div class="product-image-wrapper">
												<div class="single-products1 text-center">
													<div class="productinfo1">
														<img src="proimg/<?php echo $row_tc['id']; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" />
													</div>
													<div class="nameandprice1">
														<p><?php echo $row_tc['category']; ?></p>
													</div>													
												</div>
											</div>
										<?php 
											if(($pr_sl_i%5 == 0) && ($pr_sl_i != $result_tc->num_rows)) {
										?>
										</div>
										<div class="fade item in">
										<?php
											}
												$pr_sl_i++;
											}
											mysqli_free_result($result_tc);
										?>
										</div>
									</div>
									<a class="left recommended-item-control" href="#top-categories-carousel" data-slide="prev">
										<i class="fa fa-angle-left"></i>
									</a>
									<a class="right recommended-item-control" href="#top-categories-carousel" data-slide="next">
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
		}
	?>
	
	
	<?php
		$section_id		= 1;
		$result_main	= get_menu();
		while($row_menu = $result_main->fetch_array()) {
			$result_products 		= get_subfilter_products($row_menu['main'] , "WHERE category='".addslashes($row_menu['main'])."' ", " " , 9 , 0);
			$num_rows	= $result_products->num_rows;
			if($num_rows > 0) {
	?>
	<section class="spd">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="category-tab">
						<div class="">
							<div class="tabul">
								<ul class="nav nav-tabs tablu">
									<a href="products/<?php echo restyle_url($row_menu['main']); ?>/all"><h2><?php echo strtoupper(trim($row_menu['main'])); ?></h2></a>
								</ul>
							</div>							
						</div>
						<div class="">
							<div class="carousel slide" id="menu-<?php echo $section_id; ?>" data-ride="carousel">
								<div class="carousel-inner">							
									<div class="fade active in item">
									<?php
										$pr_slide_i	=	1;
										while($row_products = $result_products->fetch_array()) {
											$ava_color		= $row_products['colors'];
											$ava_colors		= explode(',', $ava_color);
									?>
										<div class="product-image-wrapper">
											<div class="single-products text-center">
												<div class="productinfo">
													<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><img src="proimg/<?php echo "{$row_products['id']}"; ?>/<?php echo htmlspecialchars($ava_colors[0]); ?>1.jpg" alt="" /></a>
												</div>
												<div class="nameandprice1">
													<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><p><?php echo $row_products['name']; ?></p></a>
													<h5><?php echo $currency; ?> <?php echo $row_products['price']; ?></h5>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<ul class="<?php if($section_id % 2 != 0) {echo "wishlistall1";} else {echo "wishlistall2";} ?>">
															<div class="prbuttons">
																<li class="add_to_class_li"><a data-id="<?php echo $row_products['id']; ?>">Add To Cart</a></li>
																<li class="details_li"><a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
																<li class="add_to_wishlist_btn" ><a data-id="<?php echo $row_products['id']; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
															</div>
															<div class="prsizes" style="display: none;">
															<?php
																$ava_size	= $row_products['size'];
																if($ava_size != '' && $ava_size != NULL) {
																	$ava_size	= explode(',',$ava_size);

																	foreach($ava_size as $row_ava_size) {
															?>
																<li class="pr_sizes_btn" data-size="<?php echo "{$row_ava_size}"; ?>"><?php echo "{$row_ava_size}"; ?></li>
															<?php 
																	}
																}
															?>
															</div>

															<div class="prcolors" style="display: none;">
															<?php
																$ava_color	= $row_products['colors'];
																if($ava_color != '' && $ava_color != NULL) {
																	$ava_color	= explode(',',$ava_color);
																
																	foreach($ava_color as $row_ava_color) {
															?>
																<li class="pr_color_btn" data-color="<?php echo $row_ava_color; ?>" style="background: <?php echo $row_ava_color; ?>;"></li>
															<?php	
																	}
																}
															?>
															</div>
														</ul>
													</div>
												</div>
												<div class="product-overlay success-gif" data-id="<?php echo $row_products['id']; ?>" style="display: none;">
													<div class="overlay-content">
														<ul class="<?php if($section_id % 2 != 0) {echo "wishlistall1";} else {echo "wishlistall2";} ?>">
															<div class="pradded">
																<img src="images/checkmark.gif" width="30px" alt="" />
															</div>
															<div class="prqty" style="display: none;">
																<li class="item_minus added-product-quantiy remove_item_from_cart">&times;</li>
																<li class="item_qty added-product-quantiy" data-qty="1">1</li>
																<li class="item_plus added-product-quantiy" data-left="<?php echo $row_products['item_left']; ?>">+</li>
															</div>
														</ul>
													</div>
												</div>
											</div>
										</div>
										
									<?php 
										if($pr_slide_i % 5 == 0 && $pr_slide_i != $num_rows) {
									?>
									
									</div>
									<div class="fade in item">
									
									<?php 
										}
											$pr_slide_i++;
										}
										mysqli_free_result($result_products);
									?>
									</div>
								</div>	
								<a class="left recommended-item-control" href="#menu-<?php echo $section_id; ?>" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right recommended-item-control" href="#menu-<?php echo $section_id; ?>" data-slide="next">
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
		if($section_id == 2) {
	?>
	
	<?php
		}
	?>
	<?php 
			$section_id++;
			}
		}
	?>
	
	
	<script src="js/jssor.js"></script>
	<script src="js/jssor.slider.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			var options = {
				$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
				$AutoPlaySteps: 4,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
				$AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
				$PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

				$ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
				$SlideDuration: 160,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
				$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
				$SlideWidth: 180,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
				$SlideHeight: 60,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
				$SlideSpacing:60, 					                //[Optional] Space between each slide in pixels, default value is 0
				$DisplayPieces: 4,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
				$ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
				$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
				$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
				$DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

				$BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
					$Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$AutoCenter: 0,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
					$Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
					$Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
					$SpacingX: 0,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
					$SpacingY: 0,                                   //[Optional] Vertical space between each item in pixel, default value is 0
					$Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
				},

				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
					$ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
					$Steps: 4                                       //[Optional] Steps to go for each navigation request, default value is 1
				}
			};

			var jssor_slider1 = new $JssorSlider$("slider1_container", options);

			//responsive code begin
			//you can remove responsive code if you don't want the slider scales while window resizes
			function ScaleSlider() {
				var bodyWidth = document.body.clientWidth;
				if (bodyWidth)
					jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1200));
				else
					window.setTimeout(ScaleSlider, 30);
			}
			ScaleSlider();

			$(window).bind("load", ScaleSlider);
			$(window).bind("resize", ScaleSlider);
			$(window).bind("orientationchange", ScaleSlider);
			//responsive code end
		});
	</script>

<?php 
	include "includes/footer.php";
?>