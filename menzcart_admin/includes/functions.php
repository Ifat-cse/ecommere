<?php
	function get_max($table, $index, $min) {
		global $conn;
		$get = "SELECT MAX({$index}) as {$index} FROM {$table}";
		$result = $conn->query($get);
		$row = $result->fetch_array();
		if(empty($row[$index])) { return $min;}
		else { return $row[$index]; }
	}
	function get_sum_of_index($table, $index, $extra_sql=true){
		global $conn;
		$get = "SELECT SUM({$index}) AS {$index} FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		if(empty($row[$index])) { return 0;}
		else { return $row[$index]; }
	}
	function get_total_rows($table, $extra_sql=true){
		global $conn;
		$get = "SELECT * FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get); $num = $result->num_rows;
		return $num;
	}
	function get_all($tablename, $extra_sql=true) {
		global $conn;
		$get = "SELECT * FROM {$tablename} ";
		$get.= $extra_sql; 
		$result = $conn->query($get);
		return $result;
	}
	function get_some_data($tablename, $condition) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		return $result;
	}
	function get_single_data($tablename, $condition) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row;
	}
	function get_single_index_data($tablename, $condition, $index) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row[$index];
	}
	function get_imploded_column($char, $tablename, $column, $extra_sql=true){
		global $conn;
		$implode_array = array(); $result = get_some_data($tablename, $extra_sql);
		foreach($result as $value) $implode_array[] = $value[$column];
		return implode($char, $implode_array);
	}
	function get_menu() {
		global $conn;
		$get			= "SELECT main,main_bn FROM procat GROUP BY main ORDER BY position ASC";
		$result_menu	= $conn->query($get);
		return  $result_menu;
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
	function get_sub_by_main($main)  {
		global $conn;
		$get		= "SELECT * FROM procat WHERE main= '".addslashes($main)."' ORDER BY id ASC ";
		$result_sub	= $conn->query($get);
		return  $result_sub;
	}
	function get_subItems_by_sub($main,$header,$sub){
		global $conn;
		$get		= "SELECT * FROM procat WHERE main= '".addslashes($main)."' AND header='".addslashes($header)."' AND sub='".addslashes($sub)."' ORDER BY id ASC";
		$result		= $conn->query($get);
		return  $result;
	}
	
	function get_sliders($page, $position) {
		global $conn;
		$sql	= "SELECT * FROM sliders WHERE page='{$page}' AND position='{$position}' ORDER BY id ASC";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_stickers($page, $position) {
		global $conn;
		$sql	= "SELECT * FROM sliders WHERE page='{$page}' AND position='{$position}' ORDER BY id ASC";
		$result	= $conn->query($sql);
		$row	= $result->fetch_array();
		return $row;
	}
	function get_inner_page() {
		global $conn;
		$get		= "SELECT * FROM page_contents";
		$result		= $conn->query($get);
		return  $result;
	}
	function get_products($main) {
		global $conn;
		$sql 	= "SELECT * FROM products WHERE category='".addslashes(strtolower($main))."'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_page_title() {
		global $conn;
		$sql		= "SELECT title FROM site_settings";
		$result		= $conn->query($sql);
		$row		= $result->fetch_array();
		return $row['title'];
	}
	function get_contact_information($index) {
		global $conn;
		$get		= "SELECT * FROM contact_information";
		$result		= $conn->query($get);
		$row		= $result->fetch_array();
		$output		= $row[$index];
		return  $output;
	}
	function get_brands() {
		global $conn;
		$get				= "SELECT brand FROM products GROUP BY brand ";
		$get				.= "ORDER BY id DESC ";
		
		$result_brands		= $conn->query($get);
		return  $result_brands;  
	}
	
	/*==========================================
	===== Admin Panel Compulsory Functions === */
	function get_user_info($username) {
		global $conn;
		$sql	= "SELECT * FROM users WHERE username='".addslashes($username)."'";
		$result	= $conn->query($sql);
		$row	= $result->fetch_array();
		return $row;
	}
	function get_page_view() {
		global $conn;
		$sql 	= "SELECT * FROM site_settings";
		$result	= $conn->query($sql);
		$row	= $result->fetch_array();
		return $row;
	}
	function get_unread_message() {
		global $conn;
		$sql 	= "SELECT admin_read FROM contact WHERE admin_read = '0'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_message($limit) {
		global $conn;
		$sql 	= "SELECT * FROM contact ORDER BY Id DESC LIMIT {$limit}";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_unread_order() {
		global $conn;
		$sql 	= "SELECT admin_read FROM p_order WHERE admin_read = '0'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_processing_order() {
		global $conn;
		$sql 	= "SELECT admin_read FROM p_order WHERE admin_read = '1'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_order($limit) {
		global $conn;
		$sql 	= "SELECT * FROM p_order ORDER BY id DESC LIMIT {$limit}";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_unread_comments() {
		global $conn;
		$sql 	= "SELECT admin_read FROM product_comments WHERE admin_read = '0'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_comments($limit) {
		global $conn;
		$sql 	= "SELECT * FROM product_comments LIMIT {$limit}";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_product_id(){
		global $conn, $min_prid;
		$get 	= "SELECT MAX(id) AS id FROM products";
		$result = $conn->query($get);
		$row	= $result->fetch_array();
		if(empty($row['id'])) {
			$num	= $min_prid;
		} else {
			$num	= $row['id']+1;
		}
		return $num;
	}
	function get_admins(){
		global $conn;
		$get		= "SELECT * FROM admins";
		$result		= $conn->query($get);
		return  $result;
	}
	function details_page($prid) {
		global $conn;
		$get	 = "SELECT * FROM products ";
		$get	.= "WHERE id = '{$prid}' ";
		
		$result_details		= $conn->query($get);
		$row_details		= $result_details->fetch_array();	 
		return  $row_details;
	}
	function get_today_added_products($main) {
		global $conn;
		$today	= date('Y-m-d');
		$sql 	= "SELECT * FROM products WHERE category='".addslashes(strtolower($main))."' AND date_added='{$today}'";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_registered_users() {
		global $conn;
		$get		= "SELECT * FROM users";
		$result		= $conn->query($get);
		return  $result;
	}
	function upload_image($imageName, $imageArray, $outputFolder, $outputFile){
		$target_path 	= "../"; 
		$target_path 	= $target_path  . basename( $_FILES[$imageName]['name'][$imageArray]); 
		if(move_uploaded_file($_FILES[$imageName]['tmp_name'][$imageArray], $target_path)) {
			
			if (!file_exists($outputFolder)) {
				mkdir($outputFolder, 0777, true);
			}
			
			$file 	= basename( $_FILES[$imageName]['name'][$imageArray]);
			if(file_exists($target_path)){
				rename("../".$file , $outputFile);
			}
		}
	}
	function upload_image_noArray($imageName, $outputFolder){
		$target_path 	= "../"; 
		$target_path 	= $target_path  . basename( $_FILES[$imageName]['name']); 
		if(move_uploaded_file($_FILES[$imageName]['tmp_name'], $target_path)) {
			
			if (!file_exists($outputFolder)) {
				mkdir($outputFolder, 0777, true);
			}
			
			$file 	= basename( $_FILES[$imageName]['name']);
			if(file_exists($target_path)){
				rename("../".$file , $outputFolder.'/'.$file);
			}
		}
		return $file;
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
	function adminMessage($background, $html) {
		global $conn;
		echo "\n";
		echo "<script>";
		echo "	$(document).ready(function(){ \n";
		echo "		$('.site-message').slideDown(); \n";
		echo "		$('.site-message').css({'background': '{$background}'}); \n";
		echo "		$('.site-message').html('".addslashes($html)."'); \n";
		echo " \n";
		echo "		setTimeout(function(){ \n";
		echo "			$('.site-message').fadeOut(); \n";
		echo "		},7000); \n";
		echo "	}); \n";
		echo "</script>";
		echo "\n";
	}
	function restyle_url($url) {
		$from		= array("-", "~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ");
		$to			= array("-dash-", "-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-");
		
		$restyle	= trim($url);
		$restyle	= str_replace($from, $to, $restyle);
		$restyle	= str_replace("--", "~", $restyle);
		return $restyle;
	}
	function random_token() {
		$alpha = "abcdefghijklmnopqrstuvwxyz";
		$alpha_upper = strtoupper($alpha);
		$numeric = "0123456789";
		$special = ".-+=_,!@$#*%<>[]{}";
		$chars = "";
		$chars = $alpha . $alpha_upper . $numeric;
		$length = 16;
		 
		$len = strlen($chars);
		$pw = '';
		 
		for ($i=0;$i<$length;$i++)
				$pw .= substr($chars, rand(0, $len-1), 1);
		 
		// the finished password
		$pw = str_shuffle($pw);
		return $pw;
	}
	function resize($newWidth, $newHeight, $targetFile, $originalFile) {

		$info = getimagesize($originalFile);
		$mime = $info['mime'];

		switch ($mime) {
				case 'image/jpeg':
						$image_create_func = 'imagecreatefromjpeg';
						$image_save_func = 'imagejpeg';
						$new_image_ext = 'jpg';
						break;

				case 'image/png':
						$image_create_func = 'imagecreatefrompng';
						$image_save_func = 'imagepng';
						$new_image_ext = 'png';
						break;

				case 'image/gif':
						$image_create_func = 'imagecreatefromgif';
						$image_save_func = 'imagegif';
						$new_image_ext = 'gif';
						break;

				default: 
						throw new Exception('Unknown image type.');
		}

		$img = $image_create_func($originalFile);
		list($width, $height) = getimagesize($originalFile);

		//$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

		if(file_exists($targetFile)) {
			unlink($targetFile);
		}
		$image_save_func($tmp, "{$targetFile}.{$new_image_ext}");
	}
	function get_image_information($originalFile) {
		if(file_exists($originalFile) && $originalFile != "../"){
			if($info = getimagesize($originalFile)) {
				$mime = $info['mime'];
			
				switch ($mime) {
					case 'image/jpeg':
						$image_extension = 'jpg';
						break;

					case 'image/png':
						$image_extension = 'png';
						break;

					case 'image/gif':
						$image_extension = 'gif';
						break;

					default: 
						throw new Exception('Unknown image type.');
				}

				list($width, $height) = getimagesize($originalFile);
				$imageInfo	= array($width, $height, $image_extension);
				return $imageInfo;
			}else {
				$imageInfo	= array(0, 0, 'Unknown');
				return $imageInfo;
			}
		} else {
			$imageInfo	= array(0, 0, 'Unknown');
			return $imageInfo;
		}
		
	}
	function get_edit_field_name_and_label($input){
		switch ($input) {
			case 1:
				$label 	= 'Image';
				$name	= 'image';
				break;
			case 2:
				$label 	= 'Image Link';
				$name	= 'image_link';
				break;
			case 3:
				$label 	= 'Image Heading';
				$name	= 'image_heading';
				break;
			case 4:
				$label 	= 'Heading Link';
				$name	= 'heading_link';
				break;
			case 5:
				$label 	= 'Text Line 1';
				$name	= 'image_text1';
				break;
			case 6:
				$label 	= 'Text Line 1 Link';
				$name	= 'text1_link';
				break;
			case 7:
				$label 	= 'Text Line 2';
				$name	= 'image_text2';
				break;
			case 8:
				$label 	= 'Text Line 2 Link';
				$name	= 'text2_link';
				break;
			case 9:
				$label 	= 'Text Line 3';
				$name	= 'image_text3';
				break;
			case 10:
				$label 	= 'Text Line 3 Link';
				$name	= 'text3_link';
				break;
			default: 
				exit;
		}
		
		$output	= array('label' => $label, 'name' => $name);
		return $output;
	}
	function restyle_text($input){
		$input = number_format($input);
		$input_count = substr_count($input, ',');
		if($input_count != '0'){
			if($input_count == '1'){
				return substr($input, 0, -4).'K';
			} else if($input_count == '2'){
				return substr($input, 0, -8).'M';
			} else if($input_count == '3'){
				return substr($input, 0,  -12).'B';
			} else {
				return;
			}
		} else {
			return $input;
		}
	}
	function deleteDir($dir) { 
		if(!file_exists($dir)) {
			return false;
		} else {
			$files = array_diff(scandir($dir), array('.','..')); 
			foreach ($files as $file) { 
				(is_dir("{$dir}/{$file}")) ? delTree("{$dir}/{$file}") : unlink("{$dir}/{$file}"); 
			} 
			return rmdir($dir); 
		}
	}
?>