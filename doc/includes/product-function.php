<?php 
		// GET PAGE AND SORT VALUE FROM URL(?)
		
		$page 		= isset($_GET["page"]) ? $_GET["page"]:1 ;
		$sort 		= isset($_GET["sort"]) ? $_GET["sort"]:0 ;
		$brand 		= isset($_GET["brand"]) ? get_url_variables($_GET["brand"]): 0 ;
			
		if($page <= 0) {
			exit("<center> <span style=\"color: red; font-size: 30px;\">Invalid Page Number !</span></center>");
		} else {
			$page2 		= 	$page*$product_page_limit;
			$offset1 	=	$page2-$product_page_limit;
		}
?>

<?php
	//BRAND FILTER 
	(!empty($brand)) ? $sor = "AND brand = '{$brand}' " : $sor = "";
?>

<?php
	switch($subfilter) {
		case 'all_products':
			$sql	= "WHERE 1";
			break;
		case 'all':
			$sql	= "WHERE category='{$main}' ";
			break;
		case 'new_arrivals':
			$sql	= "WHERE 1";
			break;
		case 'special_discount':
			$sql	= "WHERE discount > 0 ";
			$sort = 3;
			break;
		default:
			$sql	= "WHERE 1";
			break;
	}
	
?>

<?php	
	// SORTING
	switch( $sort ) {
		case 1:
			$sor .= "ORDER BY views DESC,id DESC";
			break;
		case 2:
			$sor .= "ORDER BY id DESC";
			break;
		case 3:
			$sor .= "ORDER BY discount DESC" ; 
			break;
		case 4:
			$sor .= "ORDER BY price ASC" ;
			break;
		case 5:
			$sor .= "ORDER BY price DESC" ;
			break;
		case 6:
			$sor .= "AND discount > 60";
			break;
		case 7:
			$sor .= "AND discount > 50";
			break;
		case 8:
			$sor .= "AND discount > 40";
			break;
		case 9:
			$sor .= "AND discount > 30";
			break;
		case 10:
			$sor .= "AND discount > 20";
			break;
		case 11:
			$sor .= "AND discount > 10";
			break;
		default :
			$sor .= "ORDER BY id DESC";
			break;
	}
?>



<?php
	$row_productpage		= get_productpage_data("{$main}" , "{$sub}");
	
		if($sub != "all") {
			$result_products 		= get_products("{$main}" , "{$sub}", "{$sor}" , $product_page_limit , $offset1);
			$result_total_products 	= get_products("{$main}" , "{$sub}", "{$sor}" , 9999999999 , 0);
		} else {
			$result_products 		= get_subfilter_products("{$main}" , "{$sql}", "{$sor}" , $product_page_limit , $offset1);
			$result_total_products 	= get_subfilter_products("{$main}" , "{$sql}", "{$sor}" , 9999999999 , 0);
		}
?>
<?php 
	$total_products	= $result_total_products->num_rows;
	$last_page		= $total_products/$product_page_limit;
	
	if(is_float($last_page)) {
		$last_page		= intval($last_page);
		$last_page		= $last_page+1;
	}
?>
