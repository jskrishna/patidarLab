<!DOCTYPE html>
<html lang="en">
<meta>

<head>
	<meta charset="utf-8">
	<title>Nextige Lab</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/assets/images/icon.png" />

	<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>public/assets/css/global.css">

	<!-- CSS only -->
</head>

<body>
	<header class="main-header">
		<div class="container-fluid">
			<div class="header-inr">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="header-logo">
							<a href="/">
								<img src="<?php echo BASE_URL ?>public/assets/images/logo.svg" alt="logo">
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="header-right">
							<button type="button" class="user-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								Px
							</button>
							<ul class="dropdown-menu" aria-labelledby="userDropdown">
								<li>
									<a href="#" class="">
										<img src="<?php echo BASE_URL ?>public/assets/images/icon-user-circle.svg" alt="logo">
										<span>Profile</span>
									</a>
								</li>
								<li>
									<a href="<?php echo BASE_URL; ?>Logout" class="">
										<img src="<?php echo BASE_URL ?>public/assets/images/icon-signout.svg" alt="logo">
										<span>Logout</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main>