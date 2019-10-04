<?php
	session_start();
	include "config.php";
	require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $base; ?>" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo get_title(); ?></title>
	
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/prettyPhoto.css" rel="stylesheet">
  <link href="css/price-range.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/modified.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="menu/styles.css">
	<link rel="stylesheet" href="css/flexslider.css">

	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="menu/script.js"></script>
</head>

<body>
	<div class="page-alert" data-close="pageAlert"><div class="alertClose" data-close="pageAlert">&times;</div><div class="alert-text"></div></div>
	<header id="header">
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">						
						<div class="header-right">
							<ul class="list-unstyled list-inline">
								<li><a href="order-history"><i class="fa fa-truck" aria-hidden="true"></i>Order Track </a></li>
								<?php if(!isset($_COOKIE['clt'])){ ?>
								<li><a href="register" class="reorsign"><i class="fa fa-user"></i>Register</a> or <a href="login/<?php echo restyle_url($_SERVER['REQUEST_URI']); ?>" class="reorsign">Sign In</a></li>
								<?php } else { ?>
								<li><a href="my-account" class="reorsign"><i class="fa fa-user"></i>My Account</a></li>
								<li><a href="logout" class="reorsign"><i class="fa fa-sign-out"></i>Sign Out</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 hidden-sm hidden-xs"></div>
				</div>
			</div>
		</div>
		
		<div class="site-branding-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">					
						<div class="col-md-3 col-sm-4 col-xs-12 "> 
							<div class="logo">
							   <a href="<?php echo $base; ?>"><img src="images/logo.png"></a>
							</div>	
							<div class="manue dropdown mainmenu  cacaallpaje">				
								<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle " href="#">
									<i class="fa fa-list-ul" aria-hidden="true"></i>
								</a>
								<ul class="nav navbar-nav  dropdown-menu">								
									<?php 
										include "menu.php";
									?>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-5 hidden-sm hidden-xs"> 
							<div class="charcebox">
								<form action="search" method="post" class="fotm1">	
									<li>
										<input type="text" placeholder="Search here" id="name" name="search" class="input-text">
									</li>
									<li>
										<input type="submit" value="" class="subs">
										<i class="fa fa-search subsi" aria-hidden="true"></i>
									</li>
								</form>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12 "> 
							<ul class="wishlistall">
								<li><a href="wishlists" title="My Wishlists"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
								<li><i class="fa fa-exchange" aria-hidden="true"></i></li>
								<li><a href="cart" title="View Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="cart_total"><?php echo cart_total(); ?></span></a></li>
								<li class="hidden-md hidden-lg"><a href="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="undefined-sticky-wrapper" class="sticky-wrapper">
			<div class="mainmenu-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-4 col-xs-12 "style=""> 
							<div id='cssmenu'>
								<ul class="nav navbar-nav navbar-left">
									<li class='active'><a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle " href='index.html'>ALL CATEGORIES</a>
										<ul class="nav navbar-nav  dropdown-menu">								
											<?php 
												include "menu.php";
											?>
										</ul>
									</li>
									<li><a href="index"><i class="fa fa-home"></i> Home</a></li>
									<?php
										$sec_menu_i		= 1;
										$result_main	=get_browse_menu();
										while($row_menu = $result_main->fetch_array()) {
									?>
									<li><a href="products/<?php echo restyle_url($row_menu['main']); ?>/all"> <?php echo htmlspecialchars($row_menu['main']); ?></a></li>
									<?php if($sec_menu_i == 5){ ?>
									<li class="has-sub"><a href=""> <i class="fa fa-bars"></i> </a>
										<ul>
									<?php } ?>
									<?php if($sec_menu_i == $result_main->num_rows && $sec_menu_i >= 5){ ?>
										</ul>
									</li>
									<?php } ?>
									<?php
											$sec_menu_i++;
										}
										mysqli_free_result($result_main);
									?>
								</ul>
							</div>					
						</div>
					</div>					
				</div>
			</div>		
		</div>
	</header>