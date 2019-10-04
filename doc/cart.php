<?php 
	include "includes/header.php";
?>
	
	<section>
		<div class="container">
			<div class="row">				
				<div class="col-sm-12">
					<div class="features_items">						
						<div class="row  pd-t20">
							<div class="col-md-12">
								<ul class="pajeurl" style="padding:10px 0px;">
									<li><a href="index">Home <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
									<li><a>Cart </a></li>
								</ul>
							</div>
						</div>
						<div class="row hrbotder">
							<div class="row b-b-p-t">
								<div class="col-md-12">
								<?php 
									$main	= null;
								?>
								<?php
									if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
										
										$prids 		= explode(',' , $_SESSION['prids']) ;
										$qty 		= explode(',' , $_SESSION['qty']) ;
										$size 		= explode(',' , $_SESSION['size']) ;
										$color 		= explode(',' , $_SESSION['color']) ;
										
										$length		= count($prids);
										$subtotal	= 0;
										$discount_total	= 0;
								?>
								
									<table class="cart-table">
										<tbody>
										<tr class="cart-table-header">
											<td class="cart-table-header-ITEM">ITEM</td>
											<td>QUANTITY</td>
											<td>UNIT PRICE</td>
											<td>SUBTOTAL</td>
										</tr>
										
									<?php
										for($i = 0;$i < $length;$i++) {
											$prid			= $prids["{$i}"];
											$row_details	= details_page($prid);
											
											$ava_color		= $row_details['colors'];
											$ava_colors		= explode(',', $ava_color);
									?>
									<?php 															
										$unit_price		= $row_details['price'];
										$unit_discount	= $row_details['price']*($row_details['discount']/100);
										$unit_dprice	= $unit_price-$unit_discount;
										
										$item_price_total		= $unit_dprice*$qty[$i];
										$item_discount_total	= $unit_discount*$qty[$i];
										
										$subtotal			= $subtotal+$item_price_total;
										$discount_total		= $discount_total+$item_discount_total;
									?>
									<?php 
										$main	= $row_details['category'];
									?>
										<tr class="cart-table-detal">
											<td class="cart-table-header-ITEM">
												<img src="<?php echo "proimg/{$row_details['id']}/{$ava_colors[0]}1.jpg" ?>" class="osh-order-image">
												<div class="item1">
													<div class="ft-product-Georgette"><?php echo "{$row_details['name']}" ;?></div>
													<div class="ft-product-name">Size: <?php echo "{$size[$i]}" ;?> &nbsp; Color: <?php echo "{$color[$i]}" ;?></div>
													<div class="ft-product-name ">Brand: <?php echo "{$row_details['brand']}" ;?></div>
													<a class="remove" data-price="<?php echo $item_price_total ;?>" data-discount="<?php echo $item_discount_total ;?>" data-static="<?php echo "{$i}" ?>" data-dynamic="<?php echo "{$i}" ?>">DELETE PRODUCT</a> 
												</div>
												<div class="clearfix"></div>
											</td>
											<td style="text-align: center;">
												<input type="number" class="input-quantity" value="<?php echo $qty[$i]; ?>" min="1" max="<?php echo $row_details['item_left']; ?>"/>
											</td>
											<td>
												<div class="unit-price ft-product-unit-price">
													<div class="current">
														<?php echo $currency." ".$unit_dprice ;?>
													</div>
													
													<?php if($unit_discount > 0) {?>
													
													<div class="old">
														<?php echo $currency; ?> <?php echo $unit_price ;?>
													</div> 
													<div class="save">
														<span> Savings: </span> 
														<span><?php echo $currency." ".$unit_discount ;?></span> 
													</div>
													
													<?php } ?>
												</div>
											</td>
											<td>
												<div class="subtotal">												
													<span><?php echo $item_price_total; ?></span> 
												</div> 
											</td>
										</tr>
										
									<?php												
										}
									?>
										</tbody>
									</table>
									
									<script>
										var i = <?php echo "{$length}"; ?>;

										$(".remove").on('click', function(e){
											i--;
											
											var dynamic_value 	= $(this).attr("data-dynamic");
												
											$(this).closest('.cart-table-detal').fadeOut('slow', function(){
												$(this).closest('.cart-table-detal').remove();
												
												$('.remove').each(function(index){
													var newdatavalue 	= index+1;
													newdatavalue 		= newdatavalue-1;
													$(this).attr('data-dynamic', newdatavalue);
												});
												
												//POST ID TO DELTE PRODUCT FROM Cart
												$.post("ajax", {
												  prid: dynamic_value,
												  delete: 1
												},
												function(data,status){
													showPageLoading();
													var loadUrl = "cart";
													
													$('html body').load(loadUrl);
												}); 
											});

										});
										
										$(".input-quantity").bind("keyup change", function(e) {
											var dynamic_value 	= $(this).parent().prev().find('.remove').attr("data-dynamic");
											var new_qty			= $(this).val();
											
											$.post("ajax", {
											  prid: dynamic_value,
											  qty: new_qty,
											  update: 1
											},
											function(data,status){
												showPageLoading();
												var loadUrl = "cart";
												$('html body').load(loadUrl);
											});
										})
										

									</script>
									
									<div class="sutotota">
										<div class="suto">
											<div class="Subtotal-width">
												<div class="osh-resume">
													<div class="ft-total">
														<span class="ft-total-left">Total:</span>
														<span class="ft-total-right"><?php echo $currency.' '.$subtotal; ?></span> 
													</div>
												</div>
											</div>											
										</div>
										<div class="bott-part">
											<div class="ft-total-bottom">
												<span class="title">Total:</span>
												<span class="ft-total-tk">
													<?php echo $currency.' '.$subtotal; ?>
												</span>
											</div>
											<div class="ft-total-bottom">
												<span>Savings:</span>
												<span class="total-discount">
													<?php echo $currency.' '.$discount_total; ?>
												</span>
											</div>
											<div class="Checkout-Proceed">
												<a href="index" class="ft-go-to-checkout continue-shopping">
													Continue Shopping
												</a>
												<a href="checkout" class="ft-go-to-checkout">
													Proceed to Checkout
												</a>
											</div>
										</div>
									</div>
									
							<?php
								} else {
							?>
								
								<div class="no-products">
									<h4> Shopping Cart Empty! </h4>
									<ul>
										<li>You didn't add any product to cart. </li>
										<li>Please go back to Product Page. And add a product to cart.</li>
										<li>For any help, Please contact our help center</li>
									</ul>
								</div>
								
							<?php 
									}
							?>	
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		
<?php 
	include "includes/footer.php";
?>