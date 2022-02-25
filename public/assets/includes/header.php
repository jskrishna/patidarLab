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
					<div class="header-left">
						<a class="btn custom-btn border-btn" href="<?php echo BASE_URL . 'patient' ?>/add_patient">
							<img src="<?php echo BASE_URL ?>public/assets/images/icon-user.svg" alt="">
							Add Patient
						</a>
					</div>
					<div class="header-add-p">
						<input type="hidden" name="search_patient_id" id="search_patient_id">
						<select name="searchPatientId" class="search__field txt_stle form-control" id="searchPatientId">
						<option >Select or Search Patient</option>
					</select>
						<input type="hidden" name="searchPatient" id="searchPatient" class="btn custom-btn btnupdate font-weight-bolder btn-primary" value="Go">
					</div>
					<div class="header-right">
						<a href="" class="header-right-w">
							<div class="current-u-avtr">
								PX
							</div>
							<span>Current User</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main>