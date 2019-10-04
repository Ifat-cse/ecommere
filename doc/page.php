<?php
	ob_start();
	include "includes/header.php";
?>
<?php 
	$page	= isset($_GET['page']) ? $_GET['page'] : 'index';
	
	$result_page	= get_inner_page($page);
	if($result_page->num_rows == 0) {
		exit(header('Location: '.$base));
	} else {
		$row_page	= $result_page->fetch_array();
	}
?>
	<div class="agile-login">
		<div class="wrapper inner-page">
			<h2><?php echo $row_page['header']; ?></h2>
			<div class="w3ls-form inner-page">
				<?php echo $row_page['content']; ?>
			</div>
		</div>
	</div>


<?php
	include "includes/footer.php";
?>