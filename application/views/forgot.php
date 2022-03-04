<?php
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
<section class="login-main forgot-page">
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
				<h3 class="login-heading">Forgot Password</h3>
			</div>
			<div class="errorTxt text-danger text-center mb-3"></div>
			<!--  input mobile or email -->
			<div class="login-form">
				<form id="forgot-form" action="JavaScript:void(0)">
					<div class="form-group">
						<label class="leadCapFirstName" for="number">Mobile Number or Email Address</label>
						<input class="form-control required" placeholder="Enter your Number or Email Address" value="" id="number" type="text" name="number" />
						<span class='error'>This field is required.</span>
					</div>
					<div class="from-group from-wrap">
					<a href="<?php echo BASE_URL; ?>login">Login here</a>
					</div>
					<div class="btn-wrap">
						<button type="submit" id="verify" class="btn custom-btn login-btn" value="">Verify</button>
					</div>
				</form>
			</div>
			<!--  verfy otp -->
			<div class="login-form">
				<form id="otp-form" style="display: none;" action="JavaScript:void(0)">
					<div class="form-group">
						<label class="leadCapFirstName" for="otp">OTP</label>
						<input class="form-control required" placeholder="Enter OTP here" value="" id="otp" type="number" name="otp" />
						<span class='error'>This field is required.</span>
						<input type="hidden" name="ei" id="ei" value="<?php if(isset($_COOKIE['ei'])){ echo $_COOKIE['ei']; } ?>">
					</div>
					<div class="from-group from-wrap">
					<a href="<?php echo BASE_URL; ?>login">Login here</a>
					</div>
					<div class="btn-wrap">
						<button type="submit" id="verifyotp" class="btn custom-btn login-btn" value="">Verify OTP</button>
					</div>
				</form>
			</div>
			<!-- reset pass  -->
				<div class="login-form">
				<form id="reset-pass-form" style="display: none;" action="JavaScript:void(0)">
					<div class="form-group">
						<label class="leadCapFirstName" for="newpass">New Password</label>
						<input class="form-control required" placeholder="Enter New Password" value="" id="newpass" type="password" name="newpass" />
						<span class='error'>This field is required.</span>
					</div>
					<div class="form-group">
						<label class="leadCapFirstName" for="cnewpass">Confirm Password</label>
						<input class="form-control required" placeholder="Confirm New Password" value="" id="cnewpass" type="password" name="cnewpass" />
						<span class='error'>This field is required.</span>
					</div>
					<div class="from-group from-wrap">
					<a href="<?php echo BASE_URL; ?>login">Login here</a>
					</div>
					<div class="btn-wrap">
						<button type="submit" id="resetpass" class="btn custom-btn login-btn" value="">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php
include_once "./public/assets/includes/footer.php";
?>