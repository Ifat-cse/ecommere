<?php
	$ref_page	= isset($_GET['ref_page']) ? $_GET['ref_page'] : 'index';
	
	if (!isset($_COOKIE['clt'])) {
		header('Location:'.$ref_page);	
	} else {
		setcookie('clt','user',time()-24*60*60,"/");
		header('Location:'.$ref_page);
	}
?>