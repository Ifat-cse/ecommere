
	<?php
		$result_main	= get_menu();
		while($row_menu = $result_main->fetch_array()) {
	?>
	
		<li class="dropdown">
			<a href="products/<?php echo restyle_url($row_menu['main']); ?>/all" class="">
				<span><img src="images/category-slides/<?php echo restyle_url($row_menu['main']); ?>-icon.png"></span> 
				<?php echo trim($row_menu['main']); ?> <i class="fa fa-angle-right"></i>
			</a>
			<ul role="menu" class="sub-menu">
			
			<?php
				$result_menu_headers	= get_header_by_menu($row_menu['main']);
				while($row_menu_headers = $result_menu_headers->fetch_array()) {
			?>
				<div class="col-md-4">
					<h3><?php echo $row_menu_headers['header']; ?></h3>
					<?php
						$result_sub	= get_sub_by_header($row_menu['main'], $row_menu_headers['header']);
						while($row_sub = $result_sub->fetch_array()) {
					?>
					<li><a href="products/<?php echo restyle_url($row_menu['main']); ?>/<?php echo restyle_url($row_sub['sub']); ?>/all"><?php echo $row_sub['sub']; ?></a></li>
					<?php
						}
						mysqli_free_result($result_sub);
					?>
				</div>
			<?php 
				}
				mysqli_free_result($result_menu_headers);
			?>	
			</ul>
		</li>
		
	<?php
		}
		mysqli_free_result($result_main);
	?>