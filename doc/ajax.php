<?php
	ob_start();
	session_start();
	include "includes/config.php";
	require_once "includes/functions.php";
?>
<?php
	if(isset($_POST['login'])) {
		$username	= mysqli_real_escape_string($conn,$_POST['username']);
		$password	= mysqli_real_escape_string($conn,$_POST['password']);
		
		$sql	= "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";
		$result	= $conn->query($sql);
		$row	= $result->fetch_assoc();
		
		if($result->num_rows == 1) {
			setcookie("clt","{$row['token']}", time() + (86400 * 2),"/");
			exit("1");
			;
		} else {
			exit("0");
		}
	}
?>
<?php
	if(isset($_POST['newsletter_add'])) {
		$field['email']	= mysqli_real_escape_string($conn,$_POST['email']);
		
		$check	= "SELECT * FROM newsletter WHERE email='{$field['email']}'";
		$result	= $conn->query($check);
		
		if($result->num_rows == 0) {
			$sql	= InsertInTable('newsletter', $field);
			$conn->query($sql);
			echo '<i class="fa fa-check"></i> Success';
			exit;
		} else {
			echo 'Already Exixts';
			exit;
		}
	}
?>
<?php
	if(isset($_POST['coupon_form'])) {
		$code	= mysqli_real_escape_string($conn,$_POST['code']);
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				
				$check	= "SELECT * FROM coupons WHERE username='{$row_user['username']}' AND coupon='{$code}'";
				
				if($conn->query($check)->num_rows > 0) {
					$row_coupon	= $conn->query($check)->fetch_array();
					exit($row_coupon['discount']);
				} else {
					exit("You Have Entered An Invalid Coupon Code !");
				}
			} else {
				exit('Invaild User ! Please <a href="logout.php">Login Again</a>');
			}
		} else {
			exit('Please <a href="login">Login</a> First To Use Coupon');
		}
	}
?>
<?php
	if(isset($_POST['wishlist_add'])) {
		$prid	= mysqli_real_escape_string($conn,$_POST['prid']);
		
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				$user_id	= $row_user['id'];
				$prev_wishlists	= $row_user['wishlists'];
				
				if(empty($prev_wishlists)) {
					$fields['wishlists']	= $prid;
				} else {
					$wishlist_array	= explode(',', $row_user['wishlists']);
					if(in_array($prid, $wishlist_array)) {
						exit("2");
					} else {
						$fields['wishlists']	= $prev_wishlists.','.$prid;
					}
				}
				
				$sql	= UpdateTable('users', $fields, "id='{$user_id}'");
				$conn->query($sql);
				
				exit("1");
			} else {
				exit($prid);
			}
		} else {
			exit($prid);
		}
	}
?>
<?php
	if(isset($_POST['remove_wishlist'])) {
		$id		= mysqli_real_escape_string($conn,$_POST['id']);
		
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				$user_id	= $row_user['id'];
				
				$prev_wishlists	= $row_user['wishlists'];
				$wishlist_array	= explode(',', $prev_wishlists);
				
				unset($wishlist_array[$id]);
				
				$fields['wishlists']	= implode(',', $wishlist_array);
				
				$sql	= UpdateTable('users', $fields, "id='{$user_id}'");
				$conn->query($sql);
				
				exit(1);
			} else {
				exit("User Removed !");
			}
		} else {
			exit("Not Logged In");
		}
	}
?>
<?php 
	if(isset($_POST['register_user'])) {
		$field['username']			= mysqli_real_escape_string($conn, $_POST['email']);
		$field['password']			= mysqli_real_escape_string($conn, $_POST['password']);
		$field['token']				= mysqli_real_escape_string($conn, $_POST['token']);
		$field['first_name']		= mysqli_real_escape_string($conn, $_POST['first_name']);
		$field['last_name']			= mysqli_real_escape_string($conn, $_POST['last_name']);
		$field['email']				= mysqli_real_escape_string($conn, $_POST['email']);
		$field['address']			= mysqli_real_escape_string($conn, $_POST['address_line_1']);
		$field['city']				= mysqli_real_escape_string($conn, $_POST['state']);
		$field['district']			= mysqli_real_escape_string($conn, $_POST['city']);
		$field['postalcode']		= mysqli_real_escape_string($conn, $_POST['postalcode']);
		$field['mobile_number']		= mysqli_real_escape_string($conn, $_POST['phone']);
		$field['wishlists']			= '';
		
		$check	= "SELECT * FROM users WHERE username='{$field['username']}' OR mobile_number LIKE '%{$field['mobile_number']}'";
		$check_result	= $conn->query($check);
		
		if($check_result->num_rows != 0) {
			exit('2');
		} else {
			echo $check_result->num_rows;
			$sql	= InsertInTable('users',$field);
			$ref_page	= isset($_POST['ref']) ? $_POST['ref'] : 'index';
			
			if($conn->query($sql)) {
				setcookie("clt",$_POST['token'], time() + (86400 * 2),"/");
				exit('1');
			} else {
				exit($conn->error);
			}
		}
	}
?>
<?php 
	if(isset($_POST['order_submit'])) {
		if(!empty($_POST['userToken'])) {
			$result_user	= get_user_info($_POST['userToken']);
			$row_user	= $result_user->fetch_array();
			
			$fields['order_no']			= (rand(10000,99999));
			$fields['date']				= date("d-m-Y");		
			$fields['name']				= $row_user['first_name'].' '.$row_user['last_name'];
			$fields['phone']			= $row_user['mobile_number'];
			$fields['email']			= $row_user['email'];
			$fields['address']			= $row_user['address'].', '.$row_user['district'].', '.$row_user['city'];
			$fields['shipment']			= isset($_POST['shipment']) ? $_POST['shipment'] : 'Normal';
			$fields['payment']			= $_POST['paymentType'];
			$fields['payment_number']	= $_POST['paymentNumber'];
			$fields['payment_trxn_id']	= $_POST['paymentTrxnId'];
			$fields['pr_id']			= $_SESSION['prids'];
			$fields['pr_size']			= $_SESSION['size'];
			$fields['pr_qty']			= $_SESSION['qty'];
			$fields['pr_color']			= $_SESSION['color'];
			$fields['admin_read']		= 0;
		} else {
			$fields['order_no']			= (rand(10000,99999));
			$fields['date']				= date("d-m-Y");		
			$fields['name']				= 'Guest';
			$fields['phone']			= mysqli_real_escape_string($conn, $_POST['mobileNumber']);
			$fields['email']			= '';
			$fields['address']			= mysqli_real_escape_string($conn, $_POST['fullAddress']);
			$fields['shipment']			= isset($_POST['shipment']) ? $_POST['shipment'] : 'Normal';
			$fields['payment']			= mysqli_real_escape_string($conn, $_POST['paymentType']);
			$fields['payment_number']	= mysqli_real_escape_string($conn, $_POST['paymentNumber']);
			$fields['payment_trxn_id']	= mysqli_real_escape_string($conn, $_POST['paymentTrxnId']);
			$fields['pr_id']			= $_SESSION['prids'];
			$fields['pr_size']			= $_SESSION['size'];
			$fields['pr_qty']			= $_SESSION['qty'];
			$fields['pr_color']			= $_SESSION['color'];
			$fields['admin_read']		= 0;
		}
		
		$sql	= InsertInTable('p_order',$fields);	
		if($conn->query($sql)) {
			if(isset($_SESSION['prids'])) unset($_SESSION['prids']);
			if(isset($_SESSION['size'])) unset($_SESSION['size']);
			if(isset($_SESSION['qty'])) unset($_SESSION['qty']);
			if(isset($_SESSION['color'])) unset($_SESSION['color']);
			
			$output	 = "orderno={$fields['order_no']}&name={$fields['name']}";
			$output	.= "&mobile={$fields['phone']}&email={$fields['email']}&address={$fields['address']}";
			$output	.= "&location=".mysqli_real_escape_string($conn, $_POST['orderLocation'])."&shipment={$fields['shipment']}&payment={$fields['payment']}";
			$output	.= "&payment_number={$fields['payment_number']}&payment_trid={$fields['payment_trxn_id']}";
			$output .= "&pr_id={$fields['pr_id']}&pr_size={$fields['pr_size']}&pr_qty={$fields['pr_qty']}&pr_color={$fields['pr_color']}";
			
			if(!empty($fields['email'])) {
				$AdminText	 = "You have received a new order from your website";
				$AdminText	.= "Order No: {$fields['order_no']}<br/>";
				$AdminText	.= "Order By: {$fields['name']}<br/>";
				$AdminText	.= "Mobile Number: {$fields['phone']}<br/><br/>";
				$AdminText	.= '<a href="'.$base.'admin/orders.php">Click here</a> to check your orders';
				
				$UserText	 = "Thanks for ordering us !.<br/>";
				$UserText	.= "Your Order No: {$fields['order_no']}<br/>";
				$UserText	.= "Ordered as: {$fields['name']}<br/>";
				$UserText	.= "Mobile Number: {$fields['phone']}<br/><br/>";
				$UserText	.= '<a href="'.$base.'order-history">Click here</a> to check your orders';
				
				//send_mail($fields['email'], $EmailToSend, "New order from your website !", $AdminText);
				//send_mail("no-reply@dhakasolution.com", $fields['email'], "Thanks for ordering us !", $UserText);
			} else {
				$AdminText	 = "You have received a new order from your website.<br/>";
				$AdminText	.= "Order No: {$fields['order_no']}<br/>";
				$AdminText	.= "Order By: {$fields['name']}<br/>";
				$AdminText	.= "Mobile Number: {$fields['phone']}<br/><br/>";
				$AdminText	.= '<a href="'.$base.'admin/orders.php">Click here</a> to check your orders';
				
				//send_mail("no-reply@dhakasolution.com", $EmailToSend, "New order from your website !", $AdminText);
			}
			exit($output);
		} else {
			exit($conn->error);
		}
	}
?>
<?php 
	if(isset($_POST['updadeMyAccount'])) {
		$id	= $_POST['id'];
		$fields['first_name']	= mysqli_real_escape_string($conn, $_POST['first_name']);
		$fields['last_name']	= mysqli_real_escape_string($conn, $_POST['last_name']);
		$fields['email']		= mysqli_real_escape_string($conn, $_POST['email']);
		$fields['address']		= mysqli_real_escape_string($conn, $_POST['address']);
		$fields['city']			= mysqli_real_escape_string($conn, $_POST['city']);
		$fields['district']		= mysqli_real_escape_string($conn, $_POST['district']);
		$fields['postalcode']		= mysqli_real_escape_string($conn, $_POST['postalcode']);
		$fields['mobile_number']		= mysqli_real_escape_string($conn, $_POST['mobile_number']);
		
		$sql	= UpdateTable('users', $fields, "id='{$id}'");
		if($conn->query($sql)){
			echo '<i class="fa fa-check"></i> Success';
		}else {
			echo $conn->error;
		}
	}
?>
<?php
	if(isset($_POST['contactFormSubmit'])) {
		$email_to = $EmailToSend;
		$email_subject = "New Contact From ".$companyName;
		
		function died($error) {
			// your error code can go here
			echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
			echo $error."<br /><br />";
			echo "Please go back and fix these errors.<br /><br />";
			die();
		}
		
		if(!isset($_POST['name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['telephone']) ||
			!isset($_POST['comments'])) {
			died('We are sorry, but there appears to be a problem with the form you submitted.');		
		}
		
		$name 			= $_POST['name']; // required
		$email_from		= $_POST['email']; // required
		$telephone 		= $_POST['telephone']; // not required
		$comments 		= $_POST['comments']; // required
		
		$fields['Name']			= mysqli_real_escape_string($conn, $name);
		$fields['Email']		= mysqli_real_escape_string($conn, $email_from);
		$fields['Number']		= mysqli_real_escape_string($conn, $telephone);
		$fields['Message']		= mysqli_real_escape_string($conn, $comments);
		$fields['admin_read']	= 0;
		
		$error_message = "";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		
		if(!preg_match($email_exp,$email_from)) {
			$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
		}
		  
		$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($string_exp,$name)) {
			$error_message .= 'The  Name you entered does not appear to be valid.<br />';
		}
	 
		if(strlen($comments) < 2) {
			$error_message .= 'The Comments you entered do not appear to be valid.<br />';
		}
		
		if(strlen($error_message) > 0) {
			died($error_message);
		}
		
		$email_message = "Form details below.\n\n";
		
		function clean_string($string) {
		  $bad = array("content-type","bcc:","to:","cc:","href");
		  return str_replace($bad,"",$string);
		}
		
		$email_message .= "Name: ".clean_string($name)."\n";
		$email_message .= "Email: ".clean_string($email_from)."\n";
		$email_message .= "Telephone: ".clean_string($telephone)."\n";
		$email_message .= "Comments: ".clean_string($comments)."\n";
		
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers); 

		
		$sql	= InsertInTable('contact',$fields);
				
		if($conn->query($sql) == true) {
			echo "Your Message Has Been Successfully Sent !";
		}else {
			echo $conn->error;
		}
	}
?>

<?php
	if(isset($_POST['forgotPassword'])) {
		$check	= "SELECT * FROM users WHERE username='".addslashes($_POST['username'])."' OR mobile_number LIKE '%".addslashes($_POST['username'])."'";
		$check_result	= $conn->query($check);
		
		if($check_result->num_rows != 0) {
			$check_row	= $check_result->fetch_array();
			
			$email_to 		= isset($_POST['username']) ? $_POST['username'] : exit("Invalid Email !") ;
			$email_from 	= "no-reply@dhakasolution.com";
			$email_subject 	= "Forgot Your Password!";
				
			$email_message = "Don't worry! We are ready for help.\n\n";
			
			function clean_string($string) {
			  $bad = array("content-type","bcc:","to:","cc:","href");
			  return str_replace($bad,"",$string);
			}
			
			$email_message .= "Your Email Address: ".clean_string($email_to)."\n";
			$email_message .= "Your Password: ".clean_string($check_row['password'])."\n\n";
			$email_message .= "Now go back to <a href='login'> login </a> page and login again ! ";
			
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			if(@mail($email_to, $email_subject, $email_message, $headers)) {
				exit("Password has been sent ! Please Check your Email");
			} else {
				exit('No mail integretted !');
			}
		} else {
			exit("No User Found !");
		}
	}
?>
<?php 
	if(isset($_POST['comment_submit'])) {
		$fields['name']			= $_POST['Name'];
		$fields['email']		= $_POST['Email'];
		$fields['message']		= $_POST['Message'];
		$fields['prid']			= $_POST['prid'];
		$fields['admin_read']	= 0;
		
		$sql	= InsertInTable('product_comments', $fields);
		
		if($conn->query($sql)) {
?>

	<div class="reviews-top">
		<div class="reviews-left">
			<img src="images/man3.png" alt=" " class="img-responsive">
		</div>
		<div class="reviews-right">
			<ul>
				<li><a href="#"><?php echo $fields['name'] ; ?></a></li>
			</ul>
			<p><?php echo $fields['message'] ; ?>.</p>
		</div>
		<div class="clearfix"></div>
	</div>
	
<?php
		} else {
			echo $conn->error;
		}
	}
?>
<!-----------------------------------
-------------- Cart ----------------->
<?php
	if(isset($_POST['add'])) {
		if(isset($_SESSION['prids']) && $_SESSION['prids'] != "") {
			
			//CHECK IF ALREADY ADDED
			$prids		= explode(',', $_SESSION['prids']);
			$quantity	= explode(',', $_SESSION['qty']);
			$size		= explode(',', $_SESSION['size']);
			$color		= explode(',', $_SESSION['color']);
			
				
			$check_prid		= array_search($_POST['prid'],$prids);

				if($check_prid !== false){
				//EXITXTS
					$uniqueKeys = array_unique($prids);
					foreach ($uniqueKeys as $uniqueKey){
						$v = array_keys($prids, $uniqueKey);
						//CHECK DUPLICATE PRID
						if (count($v) > 1) {
							foreach ($v as $key){
								$check_size		= $size[$key];
								$check_color	= $color[$key];
								if($check_color == $_POST['color'] && $check_size == $_POST['size']) {
									$match	= $key;
								}
							}
						} else {
							$check_size		= $size[$check_prid];
							$check_color	= $color[$check_prid];
							
							if($check_color == $_POST['color'] && $check_size == $_POST['size']) {
								$match	= $check_prid;
							}
						}
					} 

					//CHECK IF COLOR AND SIZE MATCH 
					if(isset($match)) {
						$quantity[$match]	= $quantity[$match] + $_POST['qty'];
						$new_qty				= implode(',', $quantity);
						
						$prids	= $_SESSION['prids'];
						$qty	= $new_qty;
						$size	= $_SESSION['size'];
						$color	= $_SESSION['color'];
					} else {
						$prids	= $_SESSION['prids'].','.$_POST['prid'];
						$qty	= $_SESSION['qty'].','.$_POST['qty'];
						$size	= $_SESSION['size'].','.$_POST['size'];
						$color	= $_SESSION['color'].','.$_POST['color'];
					}
				} else {
					//NOT EXITXTS
					$prids	= $_SESSION['prids'].','.$_POST['prid'];
					$qty	= $_SESSION['qty'].','.$_POST['qty'];
					$size	= $_SESSION['size'].','.$_POST['size'];
					$color	= $_SESSION['color'].','.$_POST['color'];
				}
		} else {
			$prids	= $_POST['prid'];
			$qty	= $_POST['qty'];
			$size	= $_POST['size'];
			$color	= $_POST['color'];
		}
		
		echo "Prids: {$prids}\n\r";
		echo "Quantity: {$qty}\n\r";
		echo "Size: {$size}\n\r";
		echo "Color: {$color}\n\r";
		
		$_SESSION['prids']	= "{$prids}";
		$_SESSION['qty']	= "{$qty}";
		$_SESSION['size']	= "{$size}";
		$_SESSION['color']	= "{$color}";
		exit;
	}
?>
<?php 
	if(isset($_POST['update'])) {
		$prid		= isset($_POST['prid']) ? $_POST['prid'] : EXIT;
		$new_qty	= isset($_POST['qty']) ? $_POST['qty'] : EXIT;
		
		$prids		= explode(',', $_SESSION['prids']);
		$quantity	= explode(',', $_SESSION['qty']);
		$size		= explode(',', $_SESSION['size']);
		$color		= explode(',', $_SESSION['color']);
		
		$quantity[$prid]= $new_qty;
		
		$quantity_new 	= implode(',', $quantity);
		
		
		$_SESSION['qty'] 	= $quantity_new;
		exit;
	}

?>
<?php
	if(isset($_POST['delete'])) {
		$prid	= isset($_POST['prid']) ? $_POST['prid'] : EXIT;
		
		$prids		= explode(',', $_SESSION['prids']);
		$quantity	= explode(',', $_SESSION['qty']);
		$size		= explode(',', $_SESSION['size']);
		$color		= explode(',', $_SESSION['color']);
		
		unset($prids[$prid]);
		unset($quantity[$prid]);
		unset($size[$prid]);
		unset($color[$prid]);
		
		$prids_new 		= implode(',', $prids);
		$quantity_new 	= implode(',', $quantity);
		$size_new 		= implode(',', $size);
		$color_new 		= implode(',', $color);
		
		echo "Prids: {$prids_new}\n\r";
		echo "Quantity: {$quantity_new}\n\r";
		echo "Size: {$size_new}\n\r";
		echo "Color: {$color_new}\n\r";
		
		$_SESSION['prids'] 	= $prids_new;
		$_SESSION['qty'] 	= $quantity_new;
		$_SESSION['size'] 	= $size_new;
		$_SESSION['color'] 	= $color_new;
		exit;
	}

?>
<!----------------------------------
--------- // Cart // --------------->

