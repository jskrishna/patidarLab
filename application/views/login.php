<?php
include_once "./public/assets/includes/header.php";
?>

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
	<div class="login-inr">
		<div class="login-left">
			<div class="login-left-top">
				<a href=""> 
					<img src="./public/assets/images/labify.svg" alt="">
				</a>
			</div>
			<div class="login-left-bottom">
				<p>@<?php echo date('Y') ?> <a href="">Labify</a> All right reserved.</p>
			</div>
		</div>
		<div class="login-right">
			<div class="msg"></div>
			<div class="login-head">
                    <h3 class="login-heading">Login</h3>
                        <p>Welcome back to Labify <br> Please login to your account</p>
                    </div>
			<div class="login-form">
				<form action="JavaScript:void(0)">
					<div class="errorTxt text-danger text-center mb-3"></div>
					<div class="form-group">
						<label class="" for="leadCapFirstName">Username</label>
						<input class="form-control required" placeholder="Enter your username" value="<?php if(isset($_COOKIE['user'])){ echo $_COOKIE['user']; } ?>" id="username" type="text" name="username" />
						<span class='error'>This field is required.</span>
					</div>
					<div class="form-group">
						<label class="" for="leadCapEmail">Password</label>
						<div class="input-group " id="logPassword">
							<input class="form-control required" placeholder="Enter your password" value="<?php if(isset($_COOKIE['pass'])){ echo $_COOKIE['pass']; } ?>" type="password" name="password" id="password">
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
					<div class="from-group from-wrap">
						<div class="check-group">
							<input type="checkbox" class="" id="remember_me" name="remember_me" value="Yes" checked>
							<label for="remember_me">Remember Me</label>
						</div>
					<a href="<?php echo BASE_URL; ?>forgot">Forgot Password</a>
					</div>
					<div class="btn-wrap">
						<button type="submit" id="login_btn" class="btn custom-btn login-btn" value="">Log In</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php
include_once "./public/assets/includes/footer.php";
?>