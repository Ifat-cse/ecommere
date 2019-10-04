<?php
	include "includes/header.php";
?>
<?php
	$result_main	= get_menu();
	while($row_menu = $result_main->fetch_array()) {
?>

<div class="arriv">
	<div class="container">
		<div class="arriv-top">
			<div class="col-md-3 arriv-left">
				<div class="w_sidebar">
					<div class="w_nav1">
						<h4><?php echo $row_menu['main']; ?></h4>
						<ul>
						<?php
							$result_sub	= get_sub(addslashes($row_menu['main']), 0);
							while($row_sub = $result_sub->fetch_array()) {
						?>
							<li><a href="products/<?php echo restyle_url($row_menu['main']); ?>/<?php echo restyle_url($row_sub['sub']); ?>/all"><?php echo $row_sub['sub']; ?></a></li>
						<?php 
							}
							mysqli_free_result($result_sub);
						?>
						</ul>	
					</div>
				</div>
			</div>
			<div class="col-md-9 arriv-right" style="border: 1px solid #EBEBEB">
				<?php 
					$result_products 		= get_subfilter_products($row_menu['main'] , "WHERE category='".addslashes($row_menu['main'])."' ", " " , 888888 , 0);
				?>
				
				<?php
					if($result_products->num_rows>0) {
						while($row_products = $result_products->fetch_array()) {
							$ava_color		= $row_products['colors'];
							$ava_colors		= explode(',', $ava_color);
				?>
					
					
					<div class="col-sm-4">
						<div class="proima">
							<div class="single-products  text-center">
								<div class="productinfo">
									<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><img src="proimg/<?php echo "{$row_products['id']}"; ?>/<?php echo $ava_colors[0]; ?>1.jpg" alt="" /></a>														
								</div>
								<div class="nameandprice1">
									<a href="details/<?php echo restyle_url($row_products['category']); ?>/<?php echo $row_products['id']; ?>"><p><?php echo $row_products['name']; ?></p></a>
									<h5><?php echo $currency; ?> <?php echo $row_products['price']; ?></h5>
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
						}
						mysqli_free_result($result_products);
					} else {
				?>
				
				<div class="no-products">
					<h4> No Products In This Category </h4>
				</div>
				
				<?php
					}
				?>
				
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

<?php 
	}
	mysqli_free_result($result_main);
?>

		<script>
			var i = <?php echo "{$cart_total}"; ?>;
			
			function add(id){
				var quantity 	= $('#p-quantity'+id).val();
				var size 		= $('#p-size'+id).val();
				var color 		= $('#p-color'+id).val();
				
				//POST ID TO ADD PRODUCT TO Cart
				$.post("ajax.php",
				{
				  prid: id,
				  qty: quantity,
				  size: size,
				  color: color,
				  add: 1
				},
				function(data,status){
					i++;
					$('#cart_total').html("("+i+")");
					$('#OpenModal'+id).modal('hide');
					//alert(data);
				});
				
			}

		</script>
<?php
	include "includes/footer.php";
?>