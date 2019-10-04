<?php
	ob_start();
	include "includes/header.php";
?>
<?php
	$main		=  isset ($_GET['main']) ? get_url_variables($_GET['main']) : $error_main	= TRUE;
	$sub		=  isset ($_GET['sub']) ? get_url_variables($_GET['sub']) : "all";
	$subfilter	=	isset ($_GET['subfilter']) ? get_url_variables($_GET['subfilter']) : "all";
	
	if(isset($error_main)) {
		exit(header('Location: index.php'));
	}
?>
<?php
	include "includes/product-function.php";
?>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="left-sidebar3" id="left-sidebarmanu">
						<h4 class="left-sidebarmanutitle">SHOP BY CATAGORY</h4>
						<div class="panel-group category-products" id="accordian">
							<?php
								$menu_i			= 1;
								$result_main	= get_menu();
								while($row_menu = $result_main->fetch_array()) {
							?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordian" href="#menu_<?php echo $menu_i; ?>">
												<span class="badge pull-right"></span>
												<?php echo strtoupper(trim($row_menu['main'])); ?>
											</a>
										</h4>
									</div>
									<div id="menu_<?php echo $menu_i; ?>" class="panel-collapse collapse">
										<div class="panel-body">
											<ul>
											<?php
												$result_menu_headers	= get_header_by_menu($row_menu['main']);
												while($row_menu_headers = $result_menu_headers->fetch_array()) {
											?>
												<li class="dropdown">
													<a href="Manpro" data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"><?php echo $row_menu_headers['header']; ?><i class="fa fa-angle-down"></i></a>
													<ul class="dropdown-menu">
													<?php
														$result_sub	= get_sub_by_header($row_menu['main'], $row_menu_headers['header']);
														while($row_sub = $result_sub->fetch_array()) {
													?>
														<li><a href="products/<?php echo restyle_url($row_menu['main']); ?>/<?php echo restyle_url($row_sub['sub']); ?>/all"><?php echo $row_sub['sub']; ?></a></li>
													<?php
														}
														mysqli_free_result($result_sub);
													?>
													</ul>
												</li>
											<?php 
												}
												mysqli_free_result($result_menu_headers);
											?>	
											</ul>
										</div>
									</div>
								</div>
							<?php
									$menu_i++;
								}
								mysqli_free_result($result_main);
							?>
						</div>
					</div>
					
					
				</div>
				
				<div class="col-md-9">
					<div class="features_items">						
						<div class="row hr">
							<div class="">
								<div class="col-md-7">
									<ul class="pajeurl">
										<li><a href="index">Home <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
										<li><a href="products/<?php echo restyle_url($main); ?>/all" class="text-capitalize"><?php echo $main; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
										<li><a class="text-capitalize"><?php echo $subfilter." ".$sub; ?></a></li>
									</ul>
								</div>
								<div class="col-md-5">
									<div class="toolbar-sorter">
										<label class="sorter-label" for="sorter">Sort By</label>
										<select id="sorter" data-role="sorter" class="sorter-options">
											<option value="1">
												Popular
											</option>
											<option value="2">
												Latest Product            
											</option>
											<option value="5">
												High Price            
											</option>
											<option value="4">
												Low Price            
											</option>
											<option value="3">
												Discount            
											</option>
										</select>
										<script>
											$(document).ready(function(){
												$('#sorter option[value=<?php echo $sort; ?>]').attr('selected','true');
												$('#sorter').change(function(){
													showPageLoading();
													var sort_value	= $(this).val();
													$('html body').load("<?php echo $self_url; ?>?brand=<?php echo $brand; ?>&page=<?php echo $page; ?>&sort="+sort_value);
												});
											});
										</script>
									</div>
								</div>
							</div>
						</div>
						<?php 
							if($total_products == 0) {
						?>
							<div class="no-products">
								<h4>Sorry! No Products</h4>
								<ul>
									<li>We have not any product in this category </li>
									<li>Please go back to Home Page. And select other category.</li>
									<li>For any help, Please contact our help center</li>
								</ul>
							</div>
						<?php		
							}
						?>	
						<div class="row pd-t20">
						
						<?php
							$i	= 1;
							while($row_products = $result_products->fetch_array()) {
								$ava_color		= $row_products['colors'];
								$ava_colors		= explode(',', $ava_color);
								
								$pr_price				= $row_products['price'];
								$pr_discount_tk			= $pr_price*($row_products['discount']/100);
								
								$price_after_discount	= $pr_price - $pr_discount_tk;
						?>
						
							<div class="col-sm-4">
								<div class="proima">
									<div class="single-products  text-center">
										<div class="productinfo">
											<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><img src="proimg/<?php echo "{$row_products['id']}"; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" /></a>														
										</div>
										<div class="nameandprice1">
											<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><p><?php echo $row_products['name']; ?></p></a>
											<h5>
												<?php if($pr_discount_tk > 0){ ?><span class="old"><?php echo $currency.' '.$pr_price; ?></span><?php } ?>
												<?php echo $currency; ?> <?php echo $price_after_discount; ?>
											</h5>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<ul class="wishlistall1">
													<div class="prbuttons">
														<li class="add_to_class_li"><a data-id="<?php echo $row_products['id']; ?>">Add To Cart</a></li>
														<li class="details_li"><a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></li>
														<li class="add_to_wishlist_btn"><a data-id="<?php echo $row_products['id']; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
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
														<li class="pr_color_btn" data-color="<?php echo $row_ava_color; ?>" style="background: <?php echo $row_ava_color; ?>;">&nbsp;</li>
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
												<ul class="wishlistall1">
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
							</div>
							
						<?php 
							if($i%3 == 0) {
						?>
						
						</div>
						<div class="row pd-t10">
						
						<?php 
							}
						?>
						
						<?php 
								$i++;
							}
							mysqli_free_result($result_products);
						?>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="ul-center">
									<ul class="pagination">
										<?php 
											if($page > 1){
										?>
											<li><a href="products/<?php echo restyle_url($main); ?>/<?php echo restyle_url($sub); ?>/<?php echo restyle_url($subfilter); ?>/<?php echo restyle_url($sort); ?>/<?php echo restyle_url($brand) ?>/<?php echo restyle_url($page-1); ?>">«</a></li>
										<?php
											} else {
										?>
											<li><a>&laquo;</a></li>
										<?php
											}
										?>
										
										<?php
											for($page_i=1 ; $page_i<= $last_page ; $page_i++){
												if ($page	 ==	 $page_i){
													$class = "class=\"active\"";
												}else {
													$class = "";
												}
										?>
											<li><a <?php echo $class; ?> href="products/<?php echo restyle_url($main); ?>/<?php echo restyle_url($sub); ?>/<?php echo restyle_url($subfilter); ?>/<?php echo restyle_url($sort); ?>/<?php echo restyle_url($brand) ?>/<?php echo restyle_url($page_i); ?>"> <?php echo $page_i; ?> </a></li>
										<?php
											}
										?>
										
										<?php
											if($page 	== 	$last_page){
										?>
											<li><a>&raquo;</a></li>
										<?php
											}else{
										?>
											<li><a href="products/<?php echo restyle_url($main); ?>/<?php echo restyle_url($sub); ?>/<?php echo restyle_url($subfilter); ?>/<?php echo restyle_url($sort); ?>/<?php echo restyle_url($brand) ?>/<?php echo restyle_url($page+1); ?>">&raquo;</a></li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="ul-center">
									<div class="bottom-sorter">
										<label class="bottom-sorter-label" for="sorter">Show Per Page</label>
										<select id="sorter" data-role="sorter" class="bottom-sorter-options">
											<option value="18" selected="selected">
												15            
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="brands">
		<div class="container">
				<div class="febr">
					<h2>FEATURED BRANDS</h2>
				</div>
			<div class="row">
				<div class="">
					<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width:1200px; height: 100px; overflow: hidden;">
						<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1200px; height: 100px; overflow: hidden;">
							<?php 
							$result_sliders	= get_sliders('index', 7);
							while($row_sliders	= $result_sliders->fetch_array()) {
						?>	
							<div><img u="image" src="<?php echo $row_sliders['image']; ?>" /></div>
						<?php
							}
							mysqli_free_result($result_sliders);
						?>
						</div>
						
						<style>
							/* jssor slider arrow navigator skin 03 css */
							/*
							.jssora03l                  (normal)
							.jssora03r                  (normal)
							.jssora03l:hover            (normal mouseover)
							.jssora03r:hover            (normal mouseover)
							.jssora03l.jssora03ldn      (mousedown)
							.jssora03r.jssora03rdn      (mousedown)
							*/
							.jssora03l, .jssora03r {
								display: block;
								position: absolute;
								/* size of arrow element */
								width: 55px;
								height: 55px;
								cursor: pointer;
								background: url(images/a03.png) no-repeat;
								overflow: hidden;
							}
							.jssora03l { background-position: -3px -33px; }
							.jssora03r { background-position: -63px -33px; }
							.jssora03l:hover { background-position: -123px -33px; }
							.jssora03r:hover { background-position: -183px -33px; }
							.jssora03l.jssora03ldn { background-position: -243px -33px; }
							.jssora03r.jssora03rdn { background-position: -303px -33px; }
						</style>
						<!-- Arrow Left -->
						<span u="arrowleft" class="jssora03l" style="top: 123px; left: 8px;">
						</span>
						<!-- Arrow Right -->
						<span u="arrowright" class="jssora03r" style="top: 123px; right: 8px;">
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
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