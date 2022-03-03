
	<?php
	// if(session_status() === PHP_SESSION_NONE){
		// session_start();
	// }
	// if (isset($_SESSION['loggedIn']) && isset($_SESSION['loggedInId'])) {
		// header('Location:' . BASE_URL . 'dashboard');
	// } 
	if (isset($_COOKIE['loggedIn']) && isset($_COOKIE['loggedInId'])) {
		header('Location:' . BASE_URL . 'dashboard');
	}
	include_once "./public/assets/includes/header.php";
	?>
	<style>
		header {
			display: none;
		}

		.main-header+main {
			margin-top: 0;
		}
	</style>
		<section class="login-main">
			<div class="container">
				<div class="row">
					<div class="login-inr">
						<div class="msg"></div>
						<div class="login-header">
							<a href="/">
								<img src="./public/assets/images/logo.svg" alt="logo">
							</a>
						</div>
						<div class="login-form">
							<form action="JavaScript:void(0)">
								<h4>Login</h4>
								<div class="errorTxt text-danger text-center mb-3"></div>
								<div class="form-group">
									<label class="" for="leadCapFirstName">Username or Email</label>
									<input class="form-control required" id="username" type="text" name="username" />
									<span class='error'>This field is required.</span>
								</div>
								<div class="form-group">
									<label class="" for="leadCapEmail">Password</label>
									<div class="input-group " id="logPassword">
										<input class="form-control required" type="password" name="password" id="password">
									<span class='error'>This field is required.</span>

										<!-- <div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">
												<div class="input-group-addon">
													<a href="#" id='pshLog'><i class="fa fa-eye"></i></a>
												</div>
											</span>
										</div> -->
									</div>
								</div>
								<div class="btn-wrap">
									<button type="submit" id="login_btn" class="btn custom-btn" value="">Log In</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
	include_once "./public/assets/includes/footer.php";
	?>