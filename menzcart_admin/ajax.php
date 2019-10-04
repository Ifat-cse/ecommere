<?php
	include "includes/config.php";
	function replace_comma($variable) {
		$restyle	= str_replace(",", "~comma~", $variable);
		return $restyle;
	}
	
	if(isset($_POST['getProducts'])) {
		$prid	= mysqli_real_escape_string($conn, $_POST['prid']);
		$sql	= "SELECT * FROM products WHERE id='".$prid."'";
		$result	= $conn->query($sql);
		if($result->num_rows == 0) {
			echo 0;
		} else {
			$row	= $result->fetch_array();
			echo replace_comma($row['name']).",".replace_comma($row['brand']).",".replace_comma($row['description']).",".$row['price'].",".str_replace(',','|',$row['size']).",".str_replace(',','|',$row['colors']).",".$row['discount'].",".$row['item_left'];
		}
	}
	if(isset($_POST['report_pr'])) {
		$catid = $conn->real_escape_string($_POST['id']);
		$result_cat_name = $conn->query("SELECT main FROM procat WHERE id ='".$catid."'");
		$row_cat_name = $result_cat_name->fetch_array();
		
		$result_products = $conn->query("SELECT * FROM products WHERE category='".addslashes($row_cat_name['main'])."'");
		while($row_pr = $result_products->fetch_array()){
			echo "<option value='".$row_pr['id']."'>".htmlspecialchars($row_pr['name'])."</option>";
		}
	}
?>