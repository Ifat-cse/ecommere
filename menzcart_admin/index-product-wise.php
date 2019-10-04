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
						<th>Product Name</th>
						<th>Uploaded</th>
						<th>Total Sale</th>
						<th>Selling Dates</th>
						<th>Item Left</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$orders = get_all("p_order", "ORDER BY id DESC");
					$ordered_pr_id = array(); $ordered_pr_ts = array(); $selling_date = array();
					while($row_od = $orders->fetch_assoc()) {
						$imploded_ids = $row_od['pr_id'];
						$ids = explode(",", $imploded_ids);
						foreach($ids as $id){
							$position = array_search($id, $ordered_pr_id);
							if($position !== false) {
								$old_qty = $ordered_pr_ts[$position];
								$ordered_pr_ts[$position] = $old_qty+1;
								$selling_date[$position][] = $row_od['date'];
							} else { 
								$ordered_pr_id[] = $id;
								$ordered_pr_ts[] = 1;
								$selling_date[][] = $row_od['date'];
							}
						}
					} mysqli_free_result($orders);
					foreach($ordered_pr_id as $key=>$pr_id){
						$row_details = details_page($pr_id);
				?>
					<tr>
						<td>
							<h4><?= $row_details['name'] ?></h4>
							<small><em>(Code: <?= $row_details['id'] ?>)</em></small>
						</td>
						<td><?= date("F j, Y", strtotime($row_details['date_added']))  ?></td>
						<td><?= $ordered_pr_ts[$key] ?></td>
						<td>
						<?php
							foreach($selling_date[$key] as $date) echo date("F j, Y", strtotime($date))."<br/>";
						?>
						</td>
						<td>
							<?= $row_details['item_left'] ?>
							<?php if($row_details['item_left'] < 6) echo'<div class="text-danger">* Low Stock</div>';  ?>
						</td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			
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
		</div>
	</div>	
<?php
	include "includes/footer.php";
?>