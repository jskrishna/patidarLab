<!DOCTYPE html>
<html lang="en">
<meta>

<head>
	<meta charset="utf-8">
	<title>Nextige Lab</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/assets/images/icon.png" />
	<link rel="stylesheet" href="<?php echo BASE_URL ?>public/assets/css/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>public/assets/css/global.css">
	<!-- CSS only -->
</head>

<body>
<?php  if (isset($loggedData) && $loggedData->role != 'superadmin') { ?>

	<?php
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (strpos($actual_link, "login") == false) { ?>


		<header class="main-header">
			<div class="container-fluid">
				<div class="row">
					<div class="header-inr">

						<div class="header-add-p">
							<div class="add-patient">
								<a class="btn custom-btn add-btn-patient" href="<?php echo BASE_URL . 'patient' ?>/add_patient">

									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
										<defs>
											<clipPath id="a">
												<path d="M1,18a1,1,0,0,1-1-1,7,7,0,1,1,14,0,1,1,0,0,1-1,1ZM3,4A4,4,0,1,1,7,8,4,4,0,0,1,3,4ZM15,6V5H14a1,1,0,1,1,0-2h1V2a1,1,0,0,1,2,0V3h1a1,1,0,0,1,0,2H17V6a1,1,0,1,1-2,0Z" transform="translate(3 3)" fill="#223345" />
											</clipPath>
										</defs>
										<path d="M1,18a1,1,0,0,1-1-1,7,7,0,1,1,14,0,1,1,0,0,1-1,1ZM3,4A4,4,0,1,1,7,8,4,4,0,0,1,3,4ZM15,6V5H14a1,1,0,1,1,0-2h1V2a1,1,0,0,1,2,0V3h1a1,1,0,0,1,0,2H17V6a1,1,0,1,1-2,0Z" transform="translate(3 3)" fill="#223345" />
									</svg>
									Add Patient
								</a>
							</div>
							<div class="search-top">
								<input type="hidden" name="search_patient_id" id="search_patient_id">
								<input type="text" name="searchPatientId" id="searchPatientId" placeholder="Search by Patient Name / Mobile Number / PTID" class="search__field txt_stle form-control ui-autocomplete-input" autocomplete="off">
								<input type="hidden" name="searchPatient" id="searchPatient" class="btn btnupdate font-weight-bolder btn-primary" value="Go">
							</div>
						</div>
						<div class="header-right">
							<a href="<?php echo BASE_URL; ?>users" class="header-right-w">
								<div class="current-u-avtr nav-avtar"><?php
																		if (isset($loggedData)) {
																			$name = explode(' ', $loggedData->fullname);
																			$name = array_filter($name);
																			foreach ($name as $n) {
																				echo $n[0];
																			}
																		} ?>
								</div>
								<span id="nav-name"><?php if (isset($loggedData)) {
														echo $loggedData->fullname;
													} ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</header>
	<?php }
}
	?>
	<main>
		<script>
		
		</script>