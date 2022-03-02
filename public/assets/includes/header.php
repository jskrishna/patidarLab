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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<!-- CSS only -->
</head>
<body>
	<header class="main-header">
		<div class="container-fluid">
			<div class="row">
				<div class="header-inr">
					<div class="header-left col-3">
						<a class="btn custom-btn add-btn-patient" href="<?php echo BASE_URL . 'patient' ?>/add_patient">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M8.5 11C10.7091 11 12.5 9.20914 12.5 7C12.5 4.79086 10.7091 3 8.5 3C6.29086 3 4.5 4.79086 4.5 7C4.5 9.20914 6.29086 11 8.5 11Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M20 8V14" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M23 11H17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
							Add Patient
						</a>
					</div>
					<div class="header-add-p col-5">
						<input type="hidden" name="search_patient_id" id="search_patient_id">
						<input type="text" name="searchPatientId" id="searchPatientId" placeholder="Search by Patient Name / Mobile Number" class="search__field txt_stle form-control ui-autocomplete-input" autocomplete="off">
						<input type="hidden" name="searchPatient" id="searchPatient" class="btn btnupdate font-weight-bolder btn-primary" value="Go">
					</div>
					<div class="header-right col-3">
						<a href="<?php echo BASE_URL; ?>users" class="header-right-w">
							<div class="current-u-avtr">
								PX
							</div>
							<span>Current User</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</header>
	<main>