<?php
	function restyle_url($url) {
		$from		= array("-", "~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ");
		$to			= array("-dash-", "-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-");
		
		$restyle	= trim(strtolower($url));
		$restyle	= str_replace($from, $to, $restyle);
		$restyle	= str_replace("--", "~", $restyle);
		return $restyle;
	}
	function get_url_variables($variable) {
		$variable	= str_replace("~", "--", $variable);
		$from		= array("-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-", " dash ");
		$to			= array("~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ", "-");
		
		$restyle	= trim($variable);
		$restyle	= str_replace($from, $to, $restyle);
		return $restyle;
	}
	function get_title()  {
		global $conn;
		$get		= "SELECT title FROM site_settings";
		$result		= $conn->query($get);
		$row		= $result->fetch_array();
		return  $row['title'];
	}
	function cart_total() {
		$prids		= isset($_SESSION['prids']) ? $_SESSION['prids'] : '';
		$qty		= isset($_SESSION['qty']) ? $_SESSION['qty'] : '';
		
		if(empty($prids)) {
			$total = 0;
		} else {
			$prids 		= explode(',' , $prids) ;
			$qty 		= explode(',' , $qty) ;
			$total		= 0;
			
			$length	= count($prids);
			for($i=0 ; $i<$length ; $i++) {
				$total	= $total+(1*$qty[$i]);
			}
		}
		return $total;
	}
	function get_cart_information($index) {
		if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
			$prids 		= explode(',' , $_SESSION['prids']) ;
			$qty 		= explode(',' , $_SESSION['qty']) ;
			$size 		= explode(',' , $_SESSION['size']) ;
			$color 		= explode(',' , $_SESSION['color']) ;
			
			$length		= count($prids);
			$subtotal	= 0;
			$discount_total	= 0;
			
			for($i = 0;$i < $length;$i++) {
				$prid			= $prids[$i];
				$row_details	= details_page($prid);
				
				$unit_price		= $row_details['price'];
				$unit_discount	= $row_details['price']*($row_details['discount']/100);
				$unit_dprice	= $unit_price-$unit_discount;
				
				$item_price_total		= $unit_dprice*$qty[$i];
				$item_discount_total	= $unit_discount*$qty[$i];
				
				$subtotal			= $subtotal+$item_price_total;
				$discount_total		= $discount_total+$item_discount_total;
			}
			
			$output_array	= array("subtotal" => $subtotal, "discount_total" =>  $discount_total, "total_without_discount" => $subtotal+$discount_total);
			return $output_array[$index];
		} else {
			$output_array	= array("subtotal" => 0,"discount_total" => 0, "total_without_discount" => 0);
			return $output_array[$index];
		}
	}
	function get_browse_menu()  {
		global $conn;
		$get			= "SELECT id,main,position FROM procat WHERE position='0' ORDER BY id ASC";
		$result_menu	= $conn->query($get);
		return  $result_menu;
	}
	function get_menu()  {
		global $conn;
		$get			= "SELECT main,main_bn,position FROM procat WHERE position!='0' GROUP BY main ORDER BY position ASC";
		$result_menu	= $conn->query($get);
		return  $result_menu;
	}
	function get_sub($main, $offset)  {
		global $conn;
		$get		= "SELECT sub,main,header FROM procat WHERE main= '".addslashes($main)."' GROUP BY sub ORDER BY id ASC LIMIT 6 OFFSET {$offset} ";
		$result_sub	= $conn->query($get);
		return  $result_sub;
	}
	function get_header_by_menu($main){
		global $conn;
		$get		= "SELECT header FROM procat WHERE main= '".addslashes($main)."' GROUP BY header ORDER BY id ASC";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_sub_by_header($main,$header){
		global $conn;
		$get		= "SELECT sub,main,header FROM procat WHERE main= '".addslashes($main)."' AND header='".addslashes($header)."' GROUP BY sub ORDER BY id ASC";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_sliders($page, $position) {
		global $conn;
		$sql	= "SELECT * FROM sliders WHERE page='{$page}' AND position='{$position}' ORDER BY id ASC";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_inner_page($page) {
		global $conn;
		$get		= "SELECT * FROM page_contents WHERE page='{$page}'";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_user_info($token) {
		global $conn;
		$get		= "SELECT * FROM users WHERE token='{$token}'";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_order_history($email){
		global $conn;
		$get		= "SELECT * FROM p_order WHERE email='{$email}'";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_contact_information($index) {
		global $conn;
		$get		= "SELECT * FROM contact_information";
		$result		= $conn->query($get);
		$row		= $result->fetch_array();
		$output		= $row[$index];
		return  $output;
	}
	function get_productpage_data($main , $sub) {
		global $conn;
		$get		= "SELECT * FROM procat WHERE main = '".addslashes($main)."' AND sub = '".addslashes($sub)."' ";
		$result		= $conn->query($get);
		$row		= $result->fetch_array();
		return  $row;
	}
	function get_products($main , $sub,  $sor , $limit , $offset) {
		global $conn;
		$get				 = "SELECT * FROM products ";
		$get				.= "WHERE category= '".addslashes($main)."' AND subcategory='".addslashes($sub)."' {$sor} ";
		$get				.= "LIMIT {$limit} OFFSET {$offset} ";
		
		$result				 = $conn->query($get);
		return  $result;
	}
	function get_subfilter_products($main , $sql,  $sor , $limit , $offset) {
		global $conn;
		$get				 = "SELECT * FROM products ";
		$get				.= $sql." ".$sor." ";
		$get				.= "LIMIT {$limit} OFFSET {$offset} ";

		$result				 = $conn->query($get);
		return  $result;
	}
	function get_query_products( $brand,  $sor, $offset) {
		global $conn;
		$get= "SELECT * FROM products ";
		$get.= "WHERE brand= '".addslashes($brand)."' {$sor} ";
		$get.= "LIMIT 3 OFFSET {$offset} ";
		
		$result_products	= $conn->query($get);
		return  $result_products;
	}
	function get_search_products($search, $main,  $sor, $limit, $offset) {
		global $conn;
		$get				   = "SELECT * FROM products WHERE ";
		$get				  .= "(name LIKE '%".addslashes($search)."%' ";
		$get				  .= "OR id LIKE '%".addslashes($search)."%'  ";
		$get				  .= "OR brand LIKE '%".addslashes($search)."%') ";
		$get				  .= "AND (category LIKE '%".addslashes($main)."%') ";
		$get				  .= "LIMIT {$limit} OFFSET {$offset} ";
		
		$result_products	= $conn->query($get);
		return  $result_products;
	}
	
	function get_min_price_from_category($main) {
		global $conn;
		$get	 = "SELECT  MIN(price) AS price FROM products WHERE category = '".addslashes($main)."' ";
		$result	 = $conn->query($get);
		$row	 = $result->fetch_array();
		return  $row;
	}
	function get_max_price_from_category($main) {
		global $conn;
		$get	 = "SELECT  MAX(price) AS price FROM products WHERE category = '".addslashes($main)."' ";
		$result	 = $conn->query($get);
		$row	 = $result->fetch_array();
		return  $row;
	}
	
	function paging($main , $sub , $sor ) {
		global $conn;
		$get	 = "SELECT * FROM products WHERE category = '".addslashes($main)."' AND subcategory='".addslashes($sub)."' ";
		$get	.= "{$sor} ";
		
		$result_products	= $conn->query($get);
		return  $result_products;
	}
	
	function details_page($prid) {
		global $conn;
		$get	 = "SELECT * FROM products ";
		$get	.= "WHERE id = '{$prid}' ";
		
		$result_details		= $conn->query($get);
		$row_details		= $result_details->fetch_array();	 
		return  $row_details;
	}
	function get_suggestion($main,$limit) {
		global $conn;
		$get				 = "SELECT * FROM products ";
		$get				.= "WHERE category = '".addslashes($main)."' ";
		$get				.= "ORDER BY id DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_suggestion	= $conn->query($get);
		return  $result_suggestion;
	}
	
	function  get_product_comments($prid){
		global $conn;
		$get				= "SELECT * FROM product_comments ";
		$get				.= "WHERE prid = '{$prid}' ";
		$get				.= "ORDER BY id DESC ";
		
		$result_comments	= $conn->query($get);
		return  $result_comments;  
	}
	
	function get_new_arrivals($limit) {
		global $conn;
		$get				= "SELECT * FROM products ";
		$get				.= "ORDER BY date_added DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_new		= $conn->query($get);
		return  $result_new;  
	}
	function get_trending($limit) {
		global $conn;
		$get				= "SELECT * FROM products ";
		$get				.= "ORDER BY views DESC,id DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_new		= $conn->query($get);
		return  $result_new; 
	}
	function get_featured_product($limit) {
		global $conn;
		$get				= "SELECT * FROM products ";
		$get				.= "ORDER BY discount DESC,views DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_new		= $conn->query($get);
		return  $result_new;
	}
	function get_best_selling($limit) {
		global $conn;
		$get				= "SELECT * FROM products ";
		$get				.= "ORDER BY views DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_new		= $conn->query($get);
		return  $result_new; 
	}
	function get_offers($limit) {
		global $conn;
		$get				= "SELECT * FROM products ";
		$get				.= "ORDER BY discount DESC ";
		$get				.= "LIMIT {$limit} ";
		
		$result_new		= $conn->query($get);
		return  $result_new; 
	}
	
	function get_brands() {
		global $conn;
		$get				= "SELECT id,brand FROM products GROUP BY brand ";
		$get				.= "ORDER BY id DESC ";
		
		$result_brands		= $conn->query($get);
		return  $result_brands;  
	}
	function get_brands_by_manu($main) {
		global $conn;
		$get				= "SELECT * FROM brands ";
		$get				.= "WHERE main='".addslashes($main)."' ";
		$get				.= "ORDER BY id DESC ";
		
		$result_brands		= $conn->query($get);
		return  $result_brands;  
	}
	function get_page_view() {
		global $conn;
		$get		= "SELECT * FROM About ";		
		$result		= $conn->query($get);
		$row		= $result->fetch_array();
		
		return  $row;
	}
	function update_page_view($count) {
		global $conn;
		$count		= $count+1;
		$update		= "UPDATE about SET page_view = '{$count}'";		
		$conn->query($update);
	}
	function get_highest_discount() {
		global $conn;
		$sql	= "SELECT category,MAX(discount) AS discount FROM products";
		$result	= $conn->query($sql);
		$row	= $result->fetch_array();
		return $row;
	}
	function send_mail($from, $to, $subject, $messageBody) {
		$email_to 		= $to;
		$email_from		= $from;
		$email_subject= $subject;
		
		if(!isset($messageBody) || strlen($messageBody) <= 5) {
			exit('Message content must be greater than 5 letter...');		
		} else {
			$bad 	= array("content-type","bcc:","to:","cc:");
			$Xman = array("\r\n","\n");
			$email_message	= str_replace($bad,"",$messageBody);
			$email_message	= str_replace($Xman,"<br>",$email_message);
		}
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$email_from."\r\n";
		$mail = mail($email_to, $email_subject, $email_message, $headers);
	}
	function InsertInTable($table,$fields){
		global $conn;
		$sql  = "INSERT INTO {$table} (".implode(" , ",array_keys($fields)).") ";
		$sql .= "VALUES('";      
		foreach($fields as $key => $value) { 
			$fields[$key] = $value;
		}
		$sql .= implode("' , '",array_values($fields))."');";       
		
		return $sql;
	}
	function UpdateTable($table,$fields,$condition) {
		global $conn;
		$sql = "UPDATE {$table} SET ";
		foreach($fields as $key => $value) { 
			$fields[$key] = " {$key} = '{$value}' ";
		}
		$sql .= implode(" , ",array_values($fields))." WHERE ".$condition.";";  
		
		return $sql;
	}
	function DeleteTable($tablename, $condition) {
		$sql		 = "DELETE FROM {$tablename} ";
		$sql		.= "WHERE {$condition}" ;
		return $sql;
	}
?>