<?php
check_session();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?= $title??'' ?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/vendors/styles/style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
		.logo-xxi{
			font-family: 'Bebas Neue', cursive;
			font-size: 40px;
		}
	</style>

	<script src="static/js/bootstrap.min.js"></script>
    <script src="/static/js/sweetalert2.js"></script>

	<script src="/api?count=visitor&js=source"></script>
</head>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="/vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
		</div>
		<div class="header-right">

			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="/static/images/user.png" alt="">
						</span>
						<span class="user-name"><?= $_SESSION['nama'] ?? 'Guest'; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="#" onclick="logout_app();return false"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="./">
				<div class="logo-xxi row" style="margin-left:0px">
					<img src="/static/images/svg.svg" style="width: 40px">
					<?= $app_name??'' ?>
				</div>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="./" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="./pembelian" class="dropdown-toggle no-arrow">
							<span class="micon fi-thumbnails"></span><span class="mtext">Pembelian</span>
						</a>
					</li>
					<li class="dropdown">
						<a onclick="logout_app();return false" type="button" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-logout"></span><span class="mtext">Logout</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
