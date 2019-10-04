<?php
	$base = "http://localhost/m3nzcart/";
	$companyName	= "Menz Cart";
	$currency = "Taka";
	$EmailToSend	= "cse.ifat17@gmail.com";
	$uri_parts 		= explode('?', $_SERVER['REQUEST_URI'], 2);
	$self_url			= 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
	$min_prid		= "100100";
	$GoogleMapApi	= 'AIzaSyCM2ZcxLK4zaOcu8UCvyYxkFYP2j0a48_4';
	$product_page_limit	= 15; 
	
	$servername   = "";
	$username 	= "root";
	$password 	= '';
	$dbname 	= "menzcart";
//connection
$conn = new mysqli($servername, $username, $password, $dbname);
//check
if($conn->connect_error) {
	die("connection failed !" .  $conn->connect_error);
}
?>