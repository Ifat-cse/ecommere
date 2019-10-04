<?php
	include "includes/header.php";
?>
	<div class="main-grid">
		<div class="table-responsive">
			<div class="form-inline">
				<label>Search: </label>
				<div class="input-group">
					<input type="search" id="search-field" class="form-control" onkeyup="searchFunction()" />
					<span class="input-group-btn">
						<button class="btn btn-info" type="submit">
							 <i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
			</div>
			<p> &nbsp; </p>
			<table class="table table-hover table-striped" border id="report">
				<thead>
					<tr>
						<th>Date</th>
						<th>Uploaded Product</th>
						<th>Total Order</th>
						<th>Processed Order</th>
						<th>Delivered Order</th>
						<th>Total Sell</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$total_upload = 0; $subtotal_order = 0; $subtotal_processed = 0;  $subtotal_delivered = 0;  $subtotal_sell = 0;
					$limit = 300; $to = date('Y-m-d'); 
					if(isset($_GET['sort'])) {
						$from = $conn->real_escape_string($_GET['from']);
						$to = $conn->real_escape_string($_GET['to']);
						$diff=date_diff(date_create($from),date_create($to));
						$limit = $diff->format("%a");
					}
					for($i=0; $i<$limit; $i++){
						$date = date("Y-m-d", strtotime("-{$i} Day", strtotime($to)));
						
						$uploaded_product = get_total_rows("products", "date_added LIKE '".$date."%'"); 
						$total_order = get_total_rows("p_order", "date ='".date("d-m-Y", strtotime($date))."'", "date"); 
						$total_processed = get_total_rows("p_order", "date ='".date("d-m-Y", strtotime($date))."' AND admin_read='1'", "date,admin_read");
						$total_delivered = get_total_rows("p_order", "date ='".date("d-m-Y", strtotime($date))."' AND admin_read='2'", "date,admin_read");
						
						$total_upload += $uploaded_product; 
						$subtotal_order += $total_order;
						$subtotal_processed += $total_processed;
						$subtotal_delivered += $total_delivered;
						
						if(empty($uploaded_product) && empty($total_order)) continue;
				?>
					<tr>
						<td><?= date("F j, Y", strtotime($date)) ?></td>
						<td>
							<?= $uploaded_product ?>
						</td>
						<td>
							<?= $total_order ?>
						</td>
						<td>
							<?= $total_processed ?>
						</td>
						<td>
							<?= $total_delivered ?>
						</td>
						<td>
							Tk.
							<?php
								$total_sell = 0;
								$orders = get_some_data("p_order", "date ='".date("d-m-Y", strtotime($date))."' AND admin_read='2'");
								while($row_od = $orders->fetch_array()) {
									$product_ids_array = explode(',', $row_od['pr_id']);
									$product_qty_array = explode(',', $row_od['pr_qty']);
									foreach($product_ids_array as $key=>$pr_id) {
										$row_details = details_page($pr_id);
										$product_price = $row_details['price']; $product_discount = $row_details['discount'];
										$discount_in_amount = $product_price*($product_discount/100);
										$price_after_discount = $product_price-$discount_in_amount;
										$total_sell += $price_after_discount*$product_qty_array[$key];
									}
								}
								$subtotal_sell += $total_sell;
								echo $total_sell;
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<th>Total</th>
					<th><?= $total_upload ?></th>
					<th><?= $subtotal_order ?></th>
					<th><?= $subtotal_processed ?></th>
					<th><?= $subtotal_delivered ?></th>
					<th>Tk.<?= $subtotal_sell ?></th>
				</tfoot>
			</table>
			<a href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i> Print Report</a>
			<style>input[type="date"]{padding: 0 20px;}</style>
			<form class="form-inline" action="" method="GET">
				<input type="hidden" name="sort" />
				<div class="form-group">
					<label>From:</label>
					<input type="date" name="from" max="<?= date('Y-m-d', strtotime('-1 day')) ?>" value="<?= date('Y-m-d', strtotime('-1 day')) ?>" class="form-control date-select">
				</div>
				<div class="form-group">
					<label>To:</label>
					<input type="date" name="to" max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control date-select">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				<?php if(isset($_GET['sort'])){ ?>
					<a href="index.php" class="btn btn-danger">Clear Sort</a>
				<?php } ?>
			</form> 
			<script>
			function searchFunction() {
				var input, filter, table, tr, td, i;
				input = document.getElementById("search-field");
				filter = input.value.toUpperCase();
				table = document.getElementById("report");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
						if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}       
				}
			}
			</script>
			<style>
				@media print {
					body * {
						visibility: hidden;
					}
					.table, .table * {
						visibility: visible;
					}
					.table {
						width: 100%;
						position: absolute;
						left: 0;
						top: 0;
					}
				}
			</style>
		</div>
	</div>	
<?php
	include "includes/footer.php";
?>