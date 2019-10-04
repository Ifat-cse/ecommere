<?php
	include "includes/config.php";
	
	if(isset($_GET['orderno'])) {
		$today			= date("d-m-Y");
		$orderno		= $_GET['orderno'];
		$name			= isset($_GET['name']) ? $_GET['name'] : '';
		$mobile			= isset($_GET['mobile']) ? $_GET['mobile'] : '';
		$email			= isset($_GET['email']) ? $_GET['email'] : '';
		$address		= isset($_GET['address']) ? $_GET['address'] : '';
		$location		= isset($_GET['location']) ? $_GET['location'] : '';
		$shipment		= isset($_GET['shipment']) ? $_GET['shipment'] : '';
		$payment		= isset($_GET['payment']) ? $_GET['payment'] : '';
		$payment_number	= isset($_GET['payment_number']) ? $_GET['payment_number'] : '';
		$payment_trid	= isset($_GET['payment_trid']) ? $_GET['payment_trid'] : '';
		$pr_id			= isset($_GET['pr_id']) ? $_GET['pr_id'] : '';
		$pr_size		= isset($_GET['pr_size']) ? $_GET['pr_size'] : '';
		$pr_qty			= isset($_GET['pr_qty']) ? $_GET['pr_qty'] : '';
		$pr_color		= isset($_GET['pr_color']) ? $_GET['pr_color'] : '';
			
?>
<?php
	include "includes/header.php";
?>

	<div id="thank-you">
		<div class="container">
			<div class="top-content">
				<h2 class="successfull"> Successfully Posted Your Order! </h2> 
				<p>Thank you so much for ordering us. Our representative will confirm the order by contacting you within the maximum 24 hours. If your order no. <?php echo $orderno; ?> is confirmed then we will reach your product within the maximum 3 days. You can also review the product if you want to verify it.</p>
			
			</div>
			<div class="your-data">
				<h3><span class="p-title"> YOUR DATA </span></h3>
				<div class="row background-white">
					<div class="col-md-6 col-md-offset-3">
						<table border="0" class="">
							<tbody>
								<tr><td>Name</td><td>:</td><td> <?php echo $name; ?></td> </tr>
								<tr><td>Mobile Number</td><td>:</td><td> <?php echo $mobile; ?> </td> </tr>
								<tr><td>Email</td><td>:</td><td> <?php echo $email; ?> </td> </tr>
								<tr><td>Address</td><td>:</td><td>  <?php echo $address; ?> </td> </tr>
								<tr><td>Location</td><td>:</td><td>  <?php echo $location; ?> </td> </tr>
								<tr><td>Delivery</td><td>:</td><td>  <?php echo $shipment ;?> </td> </tr>
								<tr><td>Payment Type</td><td>:</td><td>  <?php if($payment == 'rocket') {echo 'Rocket';} else if($payment == 'bkash'){echo 'bKash';} else {echo 'Cash On Delivery';} ?> </td> </tr>
							<?php
							if($payment == 'bkash') {
							?>
								<tr><td> bKash Number</td><td>:</td><td>  <?php echo $payment_number; ?> </td> </tr>
								<tr><td> Transaction ID</td><td>:</td><td>  <?php echo $payment_trid; ?> </td> </tr>
							<?php } else if($payment == 'rocket') { ?>
								<tr><td>Rocket Number</td><td>:</td><td>  <?php echo $payment_number; ?> </td> </tr>
								<tr><td>Transaction ID</td><td>:</td><td>  <?php echo $payment_trid; ?> </td> </tr>
							<?php	}	?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="your-bill">
				<h3><span class="p-title">YOUR BILL</span></h3> 
				<p><span class="invoice-print" onclick="window.print()"><i class="fa fa-download"></i> Download PDF |  </span><span class="invoice-print" onclick="window.print()"><i class="fa fa-print"></i> Print</span></p> 
				
				<div class="row background-white">
					<div class="invoice">
						<div class="row invoice-top">
							<div class="col-md-4 col-sm-3 col-xs-3">
								<img src="images/logo.png">
							</div>
							<div class="col-md-8 col-sm-6 col-xs-6 tagline">
								<h2 class="company-name"><?php echo $companyName; ?></h2>
								<div class="separator"></div>
								<p class="company-address"><?php echo get_contact_information('address'); ?></p>
								<p class="company-contact"><?php echo get_contact_information('mobile1'); ?> | <?php echo get_contact_information('email'); ?></p>
							</div>
							
						</div>
						<div class="row invoice-middle">
							<div class="col-md-12 invoice-id">
								<h1>INVOICE</h1>
								<div class="separator"></div>
								<h3>#<?php echo $orderno; ?></h3>
							</div>
							<div class="clearfix"></div>
			
							<div class="col-md-6 invoice-info">
								<table border="0">
									<tr><td>Issue Date</td><td>:</td><td><?php echo date("d-m-Y") ?> </td></tr>
									<tr><td>Net</td><td>:</td><td> <?php echo 50; ?> </td></tr>
									<tr><td>Currency</td><td>:</td><td> <?php echo $currency; ?> </td></tr>
									<tr><td>Delivery Type</td><td>:</td><td> Normal </td></tr>
									<tr><td>Payment Type</td><td>:</td><td>  <?php if($payment == 'rocket') {echo 'Rocket';} else if($payment == 'bkash'){echo 'bkash';} else {echo 'Cash On Delivery';} ?> </td></tr>
								</table>
							</div>
							<div class="col-md-6 invoice-bill-to">
								<p><u>Bill To: </u></p>
								<p><strong><?php echo $name; ?></strong></p>
								<p><?php echo $address; ?></p>
								<p>Delivery Location: <?php echo $location; ?></p>
								<p><?php echo $mobile; ?></p>
								<p><?php echo $email; ?></p>
							</div>
						</div>
						<div class="row invoice-table">
							<div class="col-md-12">
								<table border="0" class="itemLists">
									<thead>
										<tr><th> Sl No </th><th> Description </th><th> Quantity </th><th> Size </th><th> Color </th><th> Price </th></tr>
									</thead>
									<tbody>
										<?php
											$id = 0;
											$prids 		=  explode(',' , $pr_id) ;
											$qty 		=  explode(',' , $pr_qty) ;
											$size 		=  explode(',' , $pr_size) ;
											$color 		=  explode(',' , $pr_color) ;
											
											$length		=  count($prids);
											$subtotal		= 0;
											
											for($i = 0;$i < $length;$i++) {
												$id			= $id+1;
												$prid			= $prids[$i];
												$row_details	= details_page($prid);
												
												$pr_total	= $row_details['price']*$qty[$i];
										?>
										
										<tr>
											<td><?php echo "{$id}" ;?> </td>
											<td><?php echo "{$row_details['name']}" ;?></td>
											<td><?php echo "{$qty[$i]}" ;?></td>
											<td><?php echo "{$size[$i]}" ;?></td>
											<td><?php echo "{$color[$i]}" ;?></td>
											<td><?php echo $currency.' '.$pr_total;?></td>
										</tr>
										
										<?php 
												$subtotal	= $subtotal+$pr_total;
											}
										?>
										
									</tbody>
								</table>
								<table class="itemTotal" border="0">
									<tr><td>Total</td><td><?php echo $currency.' '.$subtotal ?></td></tr>
									<tr><td>Delivery Cost</td><td><?php if($location == 'dhaka'){$dcharge = 50;} else {$dcharge = 100;} echo $currency.' '.$dcharge ?></td></tr>
									<tr class="subtotal"><td>Subtotal</td><td><?php $almost = $subtotal+$dcharge; echo $currency.' '.$almost;?></td></tr>
								</table>
								<div class="clearfix"></div>
								
								<div class="separator"></div>
								<div class="payment-info">
									Payment Details: <?php if($payment == 'rocket') {echo 'Rocket';} else if($payment == 'bkash'){echo 'bKash';} else {echo 'Cash On Delivery';} ?>
									<?php if($payment == 'bkash' || $payment == 'rocket') { ?>
									, Number: <?php echo $payment_number; ?> 
									, Trxn ID: <?php echo $payment_trid; ?>
									<?php } ?>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>			
		</div>
	</div>


<?php
	include "includes/footer.php";
?>
<?php
	} else {
		exit(header('Location: checkout.php'));
	}
?>