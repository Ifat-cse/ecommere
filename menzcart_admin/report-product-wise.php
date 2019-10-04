<?php
	include "includes/header.php";
?>
	<div class="row main-grid">
	<?php if(isset($_GET['view'])){ ?>
	<?php
		$from = (isset($_GET['from'])) ? date("d-m-Y", strtotime($_GET['from'] )) : "01-01-2000";
		$to = (isset($_GET['to'])) ? date("d-m-Y", strtotime($_GET['to'])) : date("d-m-Y");
		
		$row_products = details_page($_GET['view']);
		
		$sql = "SELECT * FROM p_order ";
		$sql.= "WHERE pr_id LIKE '%".$_GET['view']."%' ";
		$sql.= "AND STR_TO_DATE(date,'%d-%m-%y') BETWEEN ";
		$sql.= "STR_TO_DATE('{$from}','%d-%m-%y') AND STR_TO_DATE('{$to}','%d-%m-%y')";
		
		$result_sale = $conn->query($sql) or trigger_error($sql);
		$total_sale = $result_sale->num_rows;
	?>
		<div class="col-md-12">
			<div class="row well">
				<div class="invoice">
					<div class="col-md-4 col-md-offset-2 p_img">
						<img src="<?= $base ?>proimg/<?= $_GET['view'] ?>/1.jpg" class="img-responsive" style="max-width: 300px;" />
					</div>
					<div class="col-md-4 _p_list">
						<ul class="list-item">
							<li class="list-group-item"><strong>Name: </strong><?= $row_products['name'] ?></li>
							<li class="list-group-item"><strong>Price: </strong><?= $row_products['price'] ?></li>
							<li class="list-group-item"><strong>Brand: </strong><?= $row_products['brand'] ?></li>
							<li class="list-group-item"><strong>Category: </strong><?= ucfirst($row_products['category'])." - ".ucfirst($row_products['subcategory']) ?></li>
							<li class="list-group-item">
								<strong>Item in stock: </strong><?= $row_products['item_left'] ?>
								<?php if($row_products['item_left'] < 6){ ?><br/> <p class="text-danger">* Low Stock</p><?php } ?>
							</li>
							<li class="list-group-item"><strong>Total Sell: </strong><?= $total_sale ?></li>
						</ul>
						<p>&nbsp;</p>
						<a href="javascript:;" onclick="window.print()" class="no-print"><i class="fa fa-print"></i> Print Report</a>
					</div>
					<div class="clearfix"></div><p>&nbsp;</p>
					<div class="col-md-8 col-md-offset-2">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Date</th>
									<th>Order Id</th>
								</tr>
							</thead>
							<tbody>
							<?php while($row_sale = $result_sale->fetch_array()){ ?>
								<tr>
									<td><?= $row_sale['date'] ?></td>
									<td>#<?= sprintf("%06d",$row_sale['id']) ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<style>
					@media print {
						body * {
							visibility: hidden;
						}
						.invoice, .invoice * {
							visibility: visible;
						}
						.invoice {
							width: 100%;
							position: absolute;
							left: 0;
							top: 0;
						}
						.invoice img{width: 150px;}
						.no-print, .no-print * {visibility:hidden}
					}
				</style>
			</div>
		</div>
	<?php } ?>
		<div class="col-md-4 col-md-offset-4 well">
			<form action="" method="get">
				<div class="form-group">
					<label>From</label>
					<input class="form-control" type="date" name="from" value="<?= date("Y-m-d", strtotime("-1 day")) ?>" max="<?= date("Y-m-d", strtotime("-1 day")) ?>" />
				</div>
				<div class="form-group">
					<label>To</label>
					<input class="form-control" type="date" name="to" value="<?= date("Y-m-d") ?>" max="<?= date("Y-m-d") ?>" />
				</div>
				<div class="form-group">
					<label>Select Category</label>
					<select class="form-control" name="category" required>
						<option value="" selected>Select Category</option> 
					<?php
						$result_main = $conn->query("SELECT * FROM procat GROUP BY main");
						while($row_main = $result_main->fetch_array()) {
					?>
						<option value="<?= trim($row_main['id']) ?>"><?= ucfirst(htmlspecialchars($row_main['main'])) ?></option>
					<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Select Product</label>
					<select class="form-control" name="view" required readonly ></select>
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-success" />
				</div>
			</form>
			<style>	input[type="date"]{padding: 0 15px;}</style>
			<script>
				$(document).ready(function(){
					$("select[name='category']").change(function(){
						var $category = $(this).val();
						$.ajax({
							type: "POST",
							url: "ajax.php",
							data: {report_pr: 1,id: $category},
							success: function(data){
								if(data == "") {$('select[name="view"]').attr("readonly", "true")}
								else {
									$('select[name="view"]').removeAttr("readonly");
									$('select[name="view"]').html(data);
								}
							}
						});
					});
				});
			</script>
		</div>
	</div>	
<?php
	include "includes/footer.php";
?>