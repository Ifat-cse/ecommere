<?php
	ob_start(); 
	include "includes/header.php";
?>

<?php 
	if(!isset($_COOKIE['clt'])) {
		header('Location: login/'.restyle_url($_SERVER['REQUEST_URI']));
	}
	
	$token	= $_COOKIE['clt'];
	
	$result_user	= get_user_info($token);
	
	if($result_user->num_rows ==1) {
		$row_user	= $result_user->fetch_array();
	} else {
?>
	<div class="alert alert-warning">
		Invalid Token ! Or User May Be Deleted ! <a href="logout.php">Clear Token</a>
	</div>
<?php
		include "includes/footer.php";
		exit;
	}
?>
<?php
	if(isset($_GET['update'])) {
		$id		= isset($_GET['id']) ? $_GET['id']: exit(header('Location: order-history'));
		$fields['admin_read']	= $_GET['value'];
		
		$sql	= UpdateTable('p_order',$fields," id = '{$id}' ");	
		if($conn->query($sql) == true) {
			header("Location:order-history");
		} else {
			adminMessage('red', $conn->error);
		} 
	}
?>

<div class="agile-login">
	<div class="wrapper inner-page">
		<div class="main">
			<div class="registration_left">
				<h2 class="text-center">Welcome, <?php echo $row_user['last_name']; ?></h2>
				<div class="registration_form">
					<!-- Form -->
					<div class="col-md-8 col-md-offset-2 login-area">
					<?php 
						$result_orderHistory	= get_order_history($row_user['email']);
						if($result_orderHistory->num_rows > 0) {
					?>
						<div class="secendslider">
							<div class="col-md-4">
								<div class="dailysell"> My Order History </div>
							</div>
							<div class="clearfix"></div>
						<?php
							while($row_orderHistory = $result_orderHistory->fetch_array()) {								
								switch($row_orderHistory['admin_read']) {
									case 0:
										$status	= 'Not Seen Yet';
										break;
									case 1:
										$status	= 'Order Is Processing';
										break;
									case 2:
										$status	= 'Order Delivered';
										break;
									case 3:
										$status	= 'Cancelled';
										break;
									default:
										$status	= '';
										break;
								}
						?>
							<div class="single-wishlist">									
								<div class="col-md-12">
									<div class="orderHistory-title">
										<p><strong>Order No:</strong> <?php echo $row_orderHistory['order_no']; ?></p>
										<p><strong>Ordering Date:</strong> <?php echo $row_orderHistory['date']; ?></p>
										<p><strong>Payment Type:</strong> Cash On Delivery</p>
										<p>
											<strong>Status:</strong> <span style="color: red;"><?php echo $status; ?></span> 
											<?php if($row_orderHistory['admin_read'] == 0){ ?><a href="order-history?update=1&id=<?php echo $row_orderHistory['id']; ?>&value=3">Cancel Order</a><?php } ?>
											<?php if($row_orderHistory['admin_read'] == 3){ ?><a href="order-history?update=1&id=<?php echo $row_orderHistory['id']; ?>&value=0">Order Again</a><?php } ?>
										</p>
										<div class="clearfix"></div>
									</div>
									
									<table class="table orderHistory-table" style="border: 1px solid #ddd;">
										<tr class="warning">
											<th> Product Name </th>
											<th> Size </th>
											<th> Color </th>
											<th> Quantity </th>
											<th> Action </th>
										</tr>
										<?php
											$o_products_id 		= explode(",", $row_orderHistory['pr_id']);
											$o_products_size	= explode(",", $row_orderHistory['pr_size']);
											$o_products_color	= explode(",", $row_orderHistory['pr_color']);
											$o_products_qty		= explode(",", $row_orderHistory['pr_qty']);
											
											$o_products_num = count($o_products_id) ;
											
											for($i = 0; $i < $o_products_num ; $i++) {
												$row_details	= details_page($o_products_id[$i]);
												$ava_color		= $row_details['colors'];
												$ava_colors		= explode(',', $ava_color);
										?>
										
										<tr>
											<td> 
												<img src="proimg/<?php echo $row_details['id'] ?>/<?php echo $ava_colors[0] ?>1.jpg" alt="<?php echo $row_details['id'] ?>/<?php echo $ava_colors[0] ?>-1.jpg" />
												<?php echo $row_details['name'] ?> 
											</td>
											<td> <?php echo $o_products_size[$i] ?> </td>
											<td> <?php echo $o_products_color[$i] ?> </td>
											<td> <?php echo $o_products_qty[$i] ?> </td>
											<td> <a href="<?php echo $base; ?>details/boys/<?php echo $o_products_id[$i] ?>" target="blank"> Details </a> </td>
										</tr>
										<?php
											}
										?>
									</table>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php
							}
							mysqli_free_result($result_orderHistory);
						?>
						</div> 
					<?php 
						} else {
					?>
						<div class="no-products">
							<h4> Order History Is Empty ! </h4>
							<ul>
								<li>You have no product in your order history </li>
								<li>Please go back. And order first</li>
								<li>For any help, Please contact our help center</li>
							</ul>
						</div>
					<?php	 } 		?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<?php
	include "includes/footer.php";
?>