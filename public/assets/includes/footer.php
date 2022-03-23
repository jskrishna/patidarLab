</main>
<div class="c-modal modal right fade" id="patientEdit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="page-head">
				<h2>Edit Patient </h2>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
				</button>
			</div>
			<div class="modals-body">
				<div class="row">
					<div id="edit_patient">
						<div class="row">
							<div class="form-group col-lg-3">
								<label for="title">Title<span class="text-danger">*</span>
								</label>
								<select name="title" id="title" class="form-control title_div">
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Miss">Miss</option>
									<option value="New Born">New Born</option>
									<option value="Baby">Baby</option>
								</select>
							</div>
							<div class="form-group col-lg-9">
								<input type="hidden" name="patientID" id="patientID" class="form-control" placeholder="Full Name">
								<label for="patientName">Full Name<span class="text-danger">*</span></label>
								<input type="text" name="patientName" id="patientName" class="form-control required" placeholder="Full Name">
								<span class="error">This field is required.</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-3">
								<label for="age">Age<span class="text-danger">*</span></label>
								<input type="text" name="age" onkeypress="if(this.value.length==6)return false;" id="age" class="form-control required" placeholder="Age" autocomplete="off">
								<span class="error">This field is required.</span>

							</div>
							<div class="form-group col-lg-4">
								<input type="hidden" name="age_type" id="age_type" class="age_type-input" value="Y">
								<label for="Y">Age Type<span class="text-danger">*</span></label>
								<div class="btn-group btn-block age_type_div">
									<button type="button" class="btn btn-primary age-type " id="Y">Y</button>
									<button type="button" class="btn btn-secondary age-type" id="M">M</button>
									<button type="button" class="btn btn-secondary age-type" id="D">D</button>
								</div>
							</div>
							<div class="form-group col-lg-5">
								<label for="Male">Gender<span class="text-danger">*</span></label>
								<input type="hidden" name="gender" id="gender" class="gender">
								<div class="btn-group btn-block gender_type_div">
									<button type="button" class="btn btn-primary btn-process " data-value="Male" id="Male">Male</button>
									<button type="button" class="btn btn-secondary btn-process" data-value="Female" id="Female">Female</button>
								</div>
							</div>
						</div>
						<div class="row" id="ref_detail">
							<div class="form-group col-lg-6">
								<label for="patientRef">Referred By<span class="text-danger">*</span></label>
								<input type="hidden" id="refered_by_name" value="" name="refered_by_name" class="ui-autocomplete-input required">
								<select name="patientRef" id="patientRef" class="form-control">
									<option>Select Refered By </option>
								</select>
								<span class="error">This field is required.</span>
							</div>
							<div class="form-group col-lg-6">
								<label for="mobileNo">Contact Number
								</label>
								<input type="number" name="mobileNo" id="mobileNo" class="form-control number_only" onkeypress="if(this.value.length==10)return false;" placeholder="Mobile Number" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12">
								<label for="address">Address</label>
								<textarea type="text" name="address" id="address" class="form-control" placeholder="Address"></textarea>
							</div>
						</div>

						<hr>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-lg-12 text-center">
					<div class="row">
						<div class="col-lg-6">
							<input type="button" class="btn btnupdate btn-block custom-btn" id="gotoBilling" value="Update">
						</div>
						<?php if ($loggedData->role == 'admin') { ?>

							<div class="col-lg-6">
								<button data-bs-toggle="modal" data-title="" data-bs-target="#myDeletemodel" data-url="" id="patientdelete" class="btn btn-delete btn-block custom-btn btn-danger" value="">
									Delete
								</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //delete Patient  -->
<div id="myDeletemodel" class="c-modal modal center fade" tabindex="-1" data-backdrop="static" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="page-head">
				<h2>Confirm</h2>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="form-row">
						<div id="delete_model_msg" class="form-group col-lg-12 text-center">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="d-flex">
					<a id="confirmdeletepatient" href="" class="custom-btn btn-danger">Confirm</a>
					<button data-bs-dismiss="modal" class="btn custom-btn">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/assets/css/richtext.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/assets/css/rte_theme_default.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/bootstrap.bundle.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/dataTables.bootstrap.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/dataTables.responsive.js"></script> -->

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

<script src="<?php echo BASE_URL; ?>public/assets/js/select2.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/assets/js/rte.js"></script>
<script>
	var serverSideUrl = "<?php echo BASE_URL; ?>report/getServerSide";
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/custom.js"></script>
<!-- JavaScript Bundle with Popper -->
<?php
if (isset($editer)) {
	for ($i = 0; $i < $editer; $i++) {  ?>
		<script>
			new RichTextEditor(".summernote" + <?php echo $i; ?>, {
				pasteMode: "PasteText",
				toolbarSettings: {
					items: ['BackgroundColor']
				},
				formatter: null
			});
		</script>
<?php }
}
?>
<script type="text/javascript">
	var submit_form = true;
	function validationCheck(target) {
		submit_form = true;
		$(target + ' .required').each(function() {
			if ($(this).val() == "" && !$(this).val()) {
				$(this).focus();
				$(this).parent('.form-group').addClass('error');
				$(this).siblings('.error').show();
				submit_form = false;
			} else {
				$(this).siblings('.error').hide();
				$(this).parent('.form-group').removeClass('error');
			}
		});
	}

	$('#login_btn').click(function() {
		var $btn = $(this);
		validationCheck('.login-form');
		var username = $("#username").val();
		var password = $("#password").val();
		var remember_me = $('#remember_me').is(':checked');
		var loginurl = '<?php echo BASE_URL; ?>login';
		if (submit_form) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: loginurl,
				data: {
					"username": username,
					"password": password,
					"remember_me": remember_me,
				},
				success: function(res) {
					if (res.success == 0) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html(res.msg);
					} else {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').removeClass('toast-error');
					$('#basicToast').addClass('toast-success');
					$('.toast-body').html(res.msg);
						location.href = res.redirect_url;
					}
				}

			});
		}
		return false;
	});


	<?php
	// dont remove
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (strpos($actual_link, "login") == false) { ?>

		$(document).ready(function() {

			$('#addDoctor').click(function() {
				var $btn = $(this);
				validationCheck('#add_doctor');
				var dname = $("#dname").val();
				var designation = $("#designation").val();
				var dmobile = $("#dmobile").val();
				var daddress = $("#daddress").val();
				var commission = $("#commission").val();
				var did = $("#did").val();

				var storeUrl = '<?php echo BASE_URL; ?>Doctor/store';
				if (submit_form) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: storeUrl,
						data: {
							"dname": dname,
							"designation": designation,
							"dmobile": dmobile,
							"daddress": daddress,
							"commission": commission,
							'did': did
						},
						success: function(res) {
							if (res.success == 0) {
								$(".errorTxt").removeClass("text-success");
								$(".errorTxt").addClass("text-danger");
								$(".errorTxt").html(res.msg);
							} else {
								$(".errorTxt").removeClass("text-danger");
								$(".errorTxt").addClass("text-success");
								$(".errorTxt").html(res.msg);
								location.reload();
							}
						}

					});
				}
				return false;
			});

			$('#update_password').click(function() {
				var $btn = $(this);
				$("#password-form .errorTxt").html('');
				validationCheck('#password-form');
				var currentpass = $("#currentpass").val();
				var newpass = $("#newpass").val();
				var user_id = $("#passuser_id").val();
				var updatepasseUrl = '<?php echo BASE_URL; ?>Users/updatePass';
				if (submit_form) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: updatepasseUrl,
						data: {
							"currentpass": currentpass,
							"newpass": newpass,
							"user_id": user_id,
						},
						success: function(res) {
							if (res.success == 0) {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').removeClass('toast-error');
								$('#basicToast').addClass('toast-success');
								$('.toast-body').html(res.msg);
								location.reload();
							}
						}

					});
				}
				return false;
			});
			$('#verify').click(function() {
				var $btn = $(this);
				validationCheck('#forgot-form');
				var number = $("#number").val();
				var verifyurl = '<?php echo BASE_URL; ?>Forgot/verify';
				if (submit_form) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: verifyurl,
						data: {
							"number": number,
						},
						success: function(res) {
							if (res.success == 0) {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').removeClass('toast-error');
								$('#basicToast').addClass('toast-success');
								$('.toast-body').html(res.msg);

								$('#otp-form').show();
								$('.forgot-page .login-heading').html('Verify OTP');
								$('#forgot-form').hide();
								var ei = '<?php if (isset($_SESSION['ei'])) {
												echo $_SESSION['ei'];
											} ?>';
								$('#ei').val(ei);
							}
						}

					});
				}
				return false;
			});

			$('#verifyotp').click(function() {
				var $btn = $(this);
				validationCheck('#otp-form');
				var otp = $("#otp").val();
				var user_id = $("#ei").val();
				var otpverify = '<?php echo BASE_URL; ?>Forgot/verifyOtp';
				if (submit_form) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: otpverify,
						data: {
							"otp": otp,
							"user_id": user_id,
						},
						success: function(res) {
							if (res.success == 0) {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').removeClass('toast-error');
								$('#basicToast').addClass('toast-success');
								$('.toast-body').html(res.msg);
								$('#otp-form').hide();
								$('.forgot-page .login-heading').html('Set New Password');
								$('#reset-pass-form').show();
							}
						}

					});
				}
				return false;
			});

			$('#resetpass').click(function() {
				var $btn = $(this);
				validationCheck('#reset-pass-from');

				if ($('#newpass').val() != $('#cnewpass').val()) {
					submit_form = false;
					$(".forgot-page .errorTxt").removeClass("text-success");
					$(".forgot-page .errorTxt").addClass("text-danger");
					$(".forgot-page .errorTxt").html('Password does not match.');
				}
				var newpass = $("#newpass").val();
				var user_id = $("#ei").val();
				var resetpassurl = '<?php echo BASE_URL; ?>Forgot/resetPass';
				if (submit_form) {
					$.ajax({
						type: "POST",
						dataType: "json",
						url: resetpassurl,
						data: {
							"newpass": newpass,
							"user_id": user_id,
						},
						success: function(res) {
							if (res.success == 0) {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').removeClass('toast-error');
								$('#basicToast').addClass('toast-success');
								$('.toast-body').html(res.msg);
								location.href = '<?php echo BASE_URL; ?>login';
							}
						}
					});
				}
				return false;
			});

			function isEmail(email) {
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return regex.test(email);
			}
			$("#email_id").blur(function() {
				if (isEmail($("#email_id").val()) == false) {
					$("#email_id").addClass("errorCall");

					$("#email_id").val('');
					$("#email_id").attr('placeholder', 'Please Enter Valid Email ID');

				} else {
					$("#email_id").css("border", "1px solid #ccc");
				}
			});

			var id = 1;
			var total_persons = 0;

			function phonenumber(inputtxt) {
				var phoneno = /^\+?([6-9]{1})\)?([0-9]{4})?([0-9]{5})$/;
				if ((inputtxt.match(phoneno))) {
					return true;
				} else {
					return false;
				}
			}

			$(function() {
				$('[data-toggle="tooltip"]').tooltip({
					container: 'body'
				});
			})

			//calculation fun
			function calculation() {
				var total = 0;
				var totalTestExpanses = 0;
				var rew = 0;
				var rewamountupdate = 0;
				var rewardpoint = 0;
				rewardpoint = Number(rewardpoint);
				var rewpoint = 0;
				var discount = 0;
				$("input[name^=testAmount]").each(function() {
					total = Number(total) + Number(this.value);
				});

				$("input[name^=testExpanses]").each(function() {
					totalTestExpanses = Number(totalTestExpanses) + Number(this.value);
				});
				var grandTotal = total - discount;
				$("#total").val(total);
				$("#discount").val(discount);
				$("#final_total").html(grandTotal);

				var f_discount = $("#f_discount").val();
				$("#final_discount").val(f_discount);
				var final_discount = f_discount;
				var advance = $("#advance").val();
				if (advance == '') {
					var advance = 0;
				}
				var outside = $("#outside").val();
				var homevisiting = $("#homevisiting").val();
				var rewardAmount = $("#reward").val();
				var gTotal = Number(grandTotal) - Number(final_discount);
				var finaAmount;
				finAmount = Number(gTotal) - Number(advance);
				$("#total").val(finAmount);
				$("#grand_total").html(finAmount);
				if ('NO' == 'YES' && '' == 'ENABLED') {
					$("#advance").val(finAmount);
				}
				var paid = $("#paid").val();
				var advance_paid = Number(advance) + Number(paid)
				$("#advance").attr('max', finAmount);
				var balance = finAmount.toFixed(2);
				if ('NO' == 'YES') {
					$("#balance").val(0);
				} else {
					$("#balance").val(balance);
				}
				if (final_discount > grandTotal) {

					$("#test_clear").hide();
					$("#f_discount").css("border", "1px solid red");
					return false;
				} else {
					$(".test_save").show();
					$("#test_clear").show();
					$("#f_discount").css("border", "1px solid lightgray");

				}
				// discount()
				if (total > 0) {
					$(".test_save").show();
					$("#test_clear").show();
				} else {

					$("#test_clear").hide();
				}

			}
			//discount
			function discount() {
				var discount = $('#discount').val();
				var final_discount = $("#final_discount").val();
				if (final_discount = '') {
					final_discount = 0;
				}
				var total = Number(discount) + Number(final_discount);
				if (total > 0) {
					$("#verification").show();
					// $(".test_save").hide();
					$("#test_clear").hide();
					$("#send_otp").removeAttr("disabled", "disabled");
					$("#reason_discount").focus();
				} else {
					$("#verification").hide();
					$(".test_save").show();
					$("#test_clear").show();
					$("#send_otp").attr("disabled", "disabled");
				}

			}

			$('.age-type').click(function() {
				$(".age-type").removeClass("btn-primary");
				$(".age-type").addClass("btn-secondary");
				$(this).addClass("btn-primary");
				$(this).removeClass("btn-secondary");
				var id = (this.id);
				var type = id;
				$("#age_type").val(type);
			});


			$("#title").on('change', function() {
				var title = $("#title").val();
				if (title == 'Mr' || title == 'Master') {
					$("#gender").val('Male');
					$(".btn-process").removeClass("btn-primary");
					$(".btn-process").addClass("btn-secondary");
					$("#Male").addClass("btn-primary");
					$("#Male").removeClass("btn-secondary");
				} else if (title == 'Ms' || title == 'Mrs' || title == 'Miss' || title == 'Selvi' || title == 'Kumari') {
					$("#gender").val('Female');
					$(".btn-process").removeClass("btn-primary");
					$(".btn-process").addClass("btn-secondary");
					$("#Female").addClass("btn-primary");
					$("#Female").removeClass("btn-secondary");
				} else if (title == 'Smt') {
					$("#Others").click();
				}

			});
			$('.error').hide();

			// on change title
			$('.title_div').on('change', function(e) {
				if (this.value == 'Mr' || this.value == 'Master' || this.value == 'Baby' || this.value == 'New Born') {
					$('#MaleAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#FemaleAdd').addClass(' btn-secondary').removeClass(' btn-primary');
					$('.gender').val('Male');
				} else {
					$('#FemaleAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#MaleAdd').addClass(' btn-secondary').removeClass(' btn-primary');
					$('.gender').val('Female');
				}
				$('.age-type').removeClass(' btn-primary');
				$('.age-type').addClass(' btn-secondary');
				if (this.value == 'New Born') {
					$('.age_type-input').val('D');
					$('#DAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#D').addClass(' btn-primary').removeClass(' btn-secondary');

				} else if (this.value == 'Mr' || this.value == 'Mrs' || this.value == 'Miss') {
					$('.age_type-input').val('Y');
					$('#YAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#Y').addClass(' btn-primary').removeClass(' btn-secondary');
				} else {
					$('.age_type-input').val('M');
					$('#MAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#M').addClass(' btn-primary').removeClass(' btn-secondary');
				}
			});

			//gender btn click
			$('body').on('click', '.btn-process', function() {
				var gender = $(this).data('value');
				$('.gender').val(gender);
				if (gender == 'Male') {
					$('#MaleAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#FemaleAdd').addClass(' btn-secondary').removeClass(' btn-primary');
					$('#Male').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#Female').addClass(' btn-secondary').removeClass(' btn-primary');
					$('.title_div').val('Mr').change();
				} else {
					$('#FemaleAdd').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#MaleAdd').addClass(' btn-secondary').removeClass(' btn-primary');
					$('#Female').addClass(' btn-primary').removeClass(' btn-secondary');
					$('#Male').addClass(' btn-secondary').removeClass(' btn-primary');
					$('.title_div').val('Mrs').change();
				}
			});

			// register 
			$('body').on('click', '#patient_save', function() {
				validationCheck('#new_patient');

				$("#errorText").hide();
				var title = $("#titleAdd").val();
				var patientName = $("#patientNameAdd").val();
				var mobileNo = $("#mobileNoAdd").val();
				var emailId = $("#emailIdAdd").val();
				var age = $("#ageAdd").val();
				var gender = $('#genderAdd').val();
				var refered_by = $("#refered_by_nameAdd").val();
				var address = $("#addressAdd").val();
				var age_type = $("#age_typeAdd").val();
				var pin = $("#pinAdd").val();
				var registerpurl = '<?php echo BASE_URL; ?>patient/register_patient';
				if (submit_form) {
					$('.error').hide();
					$.ajax({
						type: "POST",
						url: registerpurl,
						dataType: "json",
						data: {
							"title": title,
							"patientName": patientName,
							"mobileNo": mobileNo,
							"emailId": emailId,
							"gender": gender,
							"refered_by": refered_by,
							"address": address,
							"age": age,
							"age_type": age_type,
							'pin': pin
						},
						success: function(res) {
							$('#patientresetbtn').click();
							if (res.success == 1) {
								location.href = res.redirect_url;
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html('Something went wrong.');
							}

						}
					});
				}
			});
			//patient edit 
			$("#gotoBilling").click(function() {
				validationCheck('#edit_patient');
				$("#errorText").hide();

				var title = $("#title").val();
				var patientName = $("#patientName").val();
				var mobileNo = $("#mobileNo").val();
				var emailId = $("#emailId").val();
				var gender = $("#gender").val();
				var refered_by = $("#refered_by_name").val();
				var address = $("#address").val();
				var pin = $("#pin").val();
				var age = $("#age").val();
				var id = $('#patientID').val();
				var age_type = $("#age_type").val();
				var updateUrl = '<?php echo BASE_URL; ?>patient/patientUpdate';
				if (submit_form) {
					$.ajax({
						type: "POST",
						url: updateUrl,
						dataType: "json",
						data: {
							"id": id,
							"title": title,
							"patientName": patientName,
							"mobileNo": mobileNo,
							"emailId": emailId,
							"gender": gender,
							"refered_by": refered_by,
							"address": address,
							"pin": pin,
							"age": age,
							"age_type": age_type,
						},
						success: function(res) {
							if (res.success == 1) {

								$(".modal .close").click();
								location.reload();
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html('Something went wrong.');

							}
						}
					});
				}
			});

			$('body').on('click', '.patientedit_btn', function() {
				var id = $(this).data("id");
				var editpurl = '<?php echo BASE_URL; ?>patient/patientEdit';

				$.ajax({
					type: "POST",
					url: editpurl,
					dataType: "json",
					data: {
						"id": id
					},
					success: function(res) {
						$('#patientID').val(res.id);
						$('#title').val(res.title).change();
						$('#patientName').val(res.patientname);
						$('#mobileNo').val(res.mobile);
						$('#age').val(res.age);
						$('#age_type').val(res.age_type);
						$('#gender').val(res.gender);
						$('#refered_by_name').val(res.refered_by);
						$('#patientRef').val(res.refered_by).change();
						$('#address').val(res.address);
						$('#pin').val(res.pin);
						$("#emailId").val(res.email);
						$('.btn-delete').data('title', res.patientname);
						$('.btn-delete').data('url', "patient/patientDelete?id=" + res.id);
						$('.btn-delete').val(res.id);
						$('#' + res.age_type).addClass("btn-primary").removeClass("btn-secondary");
					}
				});
			});

			//patient delete 
			$('.btn-delete').on('click', function() {
				var url = $(this).data("url");
				var title = $(this).data("title");
				$('#confirmdeletepatient').attr("href", url);
				$('#delete_model_msg').html("Are you sure you want to delete? " + '<br> <span>' + title + "</span>");
			});

			//add test
			$("#saveTest").on('click', function() {
				$("#saveTest").attr("disabled", "disabled");
				if ($("#departmentID").val() == '') {
					$("#departmentID").css('border', '1px solid red');
					$("#departmentID").focus();
					$("#saveTest").removeAttr("disabled", "disabled");
					return false;

				} else {
					$("#departmentID").css('border', '1px solid lightgray');
				}
				if ($("#testName").val() == '') {
					$("#testName").css('border', '1px solid red');
					$("#testName").focus();
					$("#saveTest").removeAttr("disabled", "disabled");
					return false;
				} else {
					$("#testName").css('border', '1px solid lightgray');
				}

				if ($("#test_amount").val() == '') {
					$("#test_amount").css('border', '1px solid red');
					$("#test_amount").focus();
					$("#saveTest").removeAttr("disabled", "disabled");
					return false;
				} else {
					$("#test_amount").css('border', '1px solid lightgray');
				}

				var department = $("#departmentID").val();
				var testName = $("#testName").val();
				var test_amount = $("#test_amount").val();
				var test_status = $("#testStatus").val();
				var testAddUrl = '<?php echo BASE_URL; ?>test/addTest';

				$.ajax({
					type: "POST",
					url: testAddUrl,
					dataType: "json",
					data: {
						"department": department,
						"testName": testName,
						"test_amount": test_amount,
						"test_status": test_status,
					},
					success: function(res) {
						if (res.success == 1) {
							location.reload();
						} else {
							new bootstrap.Toast(document.querySelector('#basicToast')).show();
							$('#basicToast').addClass('toast-error');
							$('#basicToast').removeClass('toast-success');
							$('.toast-body').html('Something went wrong.');
						}
					}
				});
			});

			// /test edit 
			$(".test_edit").click(function() {
				var id = $(this).data("id");
				var editpurl = '<?php echo BASE_URL; ?>test/testEdit';
				$.ajax({
					type: "POST",
					url: editpurl,
					dataType: "json",
					data: {
						"id": id
					},
					success: function(res) {
						$("#edittestid").val(res.id);
						$("#EditDepartmentId").val(res.department).change();
						$("#EditTestName").val(res.test_name);
						$("#EditTestAmount").val(res.amount);
						$("#editTestStatus").val(res.status).change();
					}
				});
			});

			// test update 
			$("#testUpdate").click(function() {
				if ($("#EditTestName").val() == '') {
					$("#EditTestName").css('border', '1px solid red');
					$("#EditTestName").focus();
					return false;
				} else {
					$("#EditTestName").css('border', '1px solid lightgray');
				}

				if ($("#EditTestAmount").val() == '') {
					$("#EditTestAmount").css('border', '1px solid red');
					$("#EditTestAmount").focus();
					return false;
				} else {
					$("#EditTestAmount").css('border', '1px solid lightgray');
				}
				var department = $("#EditDepartmentId").val();
				var testName = $("#EditTestName").val();
				var id = $("#edittestid").val();
				var test_amount = $("#EditTestAmount").val();
				var edit_test_status = $("#editTestStatus").val();
				var updateTestUrl = '<?php echo BASE_URL; ?>test/updateTest';

				$.ajax({
					type: "POST",
					url: updateTestUrl,
					dataType: "json",
					data: {
						"department": department,
						"testName": testName,
						"id": id,
						"test_amount": test_amount,
						"edit_test_status": edit_test_status,
					},
					success: function(res) {
						if (res.success == 1) {
							location.reload();
						} else {
							new bootstrap.Toast(document.querySelector('#basicToast')).show();
							$('#basicToast').addClass('toast-error');
							$('#basicToast').removeClass('toast-success');
							$('.toast-body').html('Something went wrong.');
						}
					}
				});
			});

			//   ul click funtion 
			$('body').on('click', 'ul.listitems li', function(e) {
				var patientId = $(this).data('id');
				var patientName = $(this).data('name');
				$('#search_patient_id').val(patientId);
				$('#searchPatientId').val(patientName);
			});

			// go funtion
			$("#searchPatient").click(function() {
				if ($("#search_patient_id").val() == '') {} else {
					var search_patient = $("#search_patient_id").val();
					location.href = '<?php echo BASE_URL ?>bill?t=' + search_patient;
				}
			});

			//current date/time
			let output = new Date();
			let month = output.getMonth() + 1;
			let day = output.getDate();
			let year = output.getFullYear();

			if (month <= 9) {
				month = '0' + month;
			}
			if (day <= 9) {
				day = '0' + day;
			}

			var today = day + "-" + month + "-" + year;
			var time = output.getHours() + ":" + output.getMinutes() + ":" + output.getSeconds();
			$(".bill-add-d #billDate").val(today);
			$(".bill-add-d #time").val(time);

			$('.bill-add-d #bdate').html(today);

			//autocomplete
			$('#test').keypress(function() {

				$('#test').autocomplete({
					source: "<?php echo BASE_URL; ?>test/getAutoComplete",
					minLength: 1,
					max: 10,
					scroll: true,
					autoFocus: true,
					select: function(event, ui) {
						event.preventDefault();
						$('#test').val(ui.item.test_name);
						$('#test_id').val(ui.item.id);
						$('#department_id').val(ui.item.department);
						$('#test_amount').val(ui.item.amount);
						$('#nameTest').val(ui.item.test_name);
						$('#add_list').attr('disabled', false);
						$('#test_expanses').val(ui.item.id);
						$("#add_list").click();
					}
				}).data('ui-autocomplete')._renderItem = function(ul, item) {
					return $("<li class='ui-autocomplete-row'></li>")
						.data("item.autocomplete", item)
						.append(item.test_name + ' - Rs. ' + item.amount)
						.appendTo(ul);
				};
			});

			// in bill patient edit
			$(".btn-edit").click(function() {
				$("#ref_detail").hide();
				var patient_id = $("#editpatientid").val();
				var url = "<?php echo BASE_URL; ?>patient/patientEdit";
				$.ajax({
					type: 'POST',
					url: url,
					dataType: 'json',
					data: {
						"id": patient_id
					},
					success: function(res) {
						$("#patientIdaEdit").html(res.patientid);
						$("#patientIdEdit").val(res.id);
						$('#title_patientEdit').val(res.title).change();
						$("#patientNameEdit").val(res.patientname);
						$("#mobileNoEdit").val(res.mobile);
						$("#alternateMobileNoEdit").val(res.alternatemobile);
						$("#emailIdEdit").val(res.email);
						$("#ageEdit").val(res.age);
						$("#genderEdit").val(res.gender);
						$("#refered_byEdit").val(res.refered_by);
						$("#areaEdit").val(res.area);
						$("#cityEdit").val(res.city);
						$("#pinEdit").val(res.pin);
						$(".age-type").removeClass("btn-primary");
						$(".age-type").addClass("btn-secondary");
						$("#" + res.age_type).addClass("btn-primary");
						$("#" + res.age_type).removeClass("btn-secondary");
						$("#age_type").val(res.age_type);
						$(".btn-process-Edit").removeClass("btn-primary");
						$(".btn-process-Edit").addClass("btn-secondary");
						$("#" + res.gender + "Edit").addClass("btn-primary");
						$("#" + res.gender + "Edit").removeClass("btn-secondary");
					}
				});
			});
			// validationCheck('#edit_patient');

			//add test list
			$("#add_list").click(function() {
				if ($("#test_id").val() == '') {
					$("#test").css("border", "1px solid red");
					$("#test_amount").focus();
					return false;
				} else {
					$("#test").css("border", "1px solid lightgray");
				}
				if ($("#test_amount").val() == '') {
					$("#test_amount").css("border", "1px solid red");
					$("#test_amount").focus();
					return false;
				} else {
					$("#test_amount").css("border", "1px solid lightgray");
				}
				var testId = $("#test_id").val();
				testId = parseInt(testId);
				var test_in = jQuery.inArray(testId, test);
				if (test_in != -1) {

					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					var testname = $('#nameTest').val();
					$('.toast-body').html('You already selected ' + testname);
					$('#test,#test_id,#department_id,#test_amount,#nameTest').val('');
				} else {
					test.push(testId);
					$("#add_list").attr("disabled", "disabled");
					var departmentId = $("#department_id").val();
					var testAmount = $("#test_amount").val();
					var discountAmount = 0;
					var discountAmount1 = 0;
					var nameTest = $("#nameTest").val();
					$("#testRequest").append("<tr><td>" + nameTest + "<input type='hidden' name='testId[]' id='testId' value=" + testId + " class='form-control testId' readonly></td><td><input class='testAmount' type='text' name='testAmount[]' id='testAmount' value=" + testAmount + " class='form-control testAmount' readonly> <input type='hidden' name='discount_value[]' id='discount_value' value='" + discountAmount1 + "'><input type='hidden' name='discountAmount[]' id='discountAmount' value=" + discountAmount + " class='form-control testAmount' readonly></td><td><a href='javascript:void(0)' class='remove_this'><img src='<?php echo BASE_URL ?>public/assets/images/cross.svg' alt=''></a></td></tr>");
					$("#test_id").val('');
					$("#test_amount").val('');
					$("#test_expanses").val('');
					$("#nameTest").val('');
					$("#test").val('');
					calculation();
					discount();
				}
			});

			$("#testRequest").on('click', '.remove_this', function() {
				var v = $(this).closest('tr').find("#testId").val();
				test = $.grep(test, function(value) {
					return value != v;
				});
				$(this).closest('tr').remove();
				calculation();
			});

			// department on change
			$("#departments").on('change', function() {
				var department = $("#departments").val();
				$("#bottom").removeAttr('disabled', 'disabled');
				$.ajax({
					type: "POST",
					url: "<?php echo BASE_URL; ?>test/selectTest",
					dataType: "json",
					data: {
						"department": department,
						"test": test
					},
					success: function(res) {
						$("#selectTest").modal('show');
						$("#selectTest .modal-body").html(res);
					}
				});
			});

			$("body").on('click', '#bottom', function() {
				var temp = Array();
				$(".check_list").each(function() {
					if ($(this).is(':checked')) {
						var checked = ($(this).val());

						var Stest = $.inArray(checked, test);
						if (Stest <= 0) {
							test.push(checked);
							temp.push(checked);
						}
					}
				});

				if (temp.length == 0) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('Please Select test first.');
				}

				$.ajax({
					type: "POST",
					url: "<?php echo BASE_URL; ?>test/testSubmit",
					dataType: "json",
					data: {
						"temp": temp
					},
					success: function(res) {
						if (res) {
							$("#testRequest").append(res);
						}
						calculation();
						$("#selectTest").modal('hide');
						$("#test_id").val('');
						$("#test_amount").val('');
						$("#nameTest").val('');
						$("#departments").val('').change();
						$("#test").val('');
					}
				});
			});

			// press enter test save 
			$('#test_save').keypress(function(event) {
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if (keycode == '13') {
					$('#test_save').click();
				}
			});

			//test clear
			$("#test_clear").on('click', function() {
				test = [];
				$("#testRequest").empty();
				$("#balance").val('');
				$("#grand_total").html(0);
				$("#advance").val('');
			});

			$("#f_discount").keyup(function() {
				discount();
				calculation();
				var advance = $('#advance').val();
				var final_total = $("#final_total").html();
				var f_discount = $("#f_discount").val();
				var final_discount = f_discount;
				var total = Number(final_total) - Number(advance);

				if (Number(final_discount) > Number(total)) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('The discount amount is higher than the Total amount.');
					$(".test_save").hide();
					$("#test_clear").hide();
				} else {
					if ($.trim($('#grand_total').html()))
						$("#test_save").show("disabled", "disabled");
					$("#test_clear").show("disabled", "disabled");
				}
			});
			$("#advance").keyup(function() {
				discount();
				calculation();
				var advance = $('#advance').val();
				var final_total = $("#final_total").html();
				var f_discount = $("#f_discount").val();
				var final_discount = f_discount;

				var total = Number(final_total) - Number(f_discount);

				if (Number(advance) > Number(total)) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('The Advance amount is higher than the Total amount.');
					$(".test_save").hide();
					$("#test_clear").hide();
				} else {
					if ($.trim($('#grand_total').html()))
						$("#test_save").show("disabled", "disabled");
					$("#test_clear").show("disabled", "disabled");
				}
			});

			//test bill save
			$("#test_save").click(function(e) {

				if ($("#billDate").val() == '') {
					$("#billDate").css("border", "1px solid red");
					$("#billDate").focus();
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('Something went wrong.');
					return false;
				} else {
					$("#billDate").css("border", "1px solid lightgray");
				}

				if ($("#test_id").val() != '') {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('Something went wrong.');

				} else {

					if (!$.trim($('#grand_total').html())) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html('Enter test name.');

						return false;
					}

					$(".test_save").hide();
					$("#test_clear").hide();
					var bill_id = $("#bill_id").val();
					var billDate = $("#billDate").val();
					var time = $("#time").val();
					if ("DISABLED" == 'ENABLED') {
						billDate = billDate;
					} else {
						billDate = billDate.concat(" " + time);
					}
					var patient_id = $("#editpatientid").val();
					var total = $("#final_total").html();
					var discount = $("#discount").val();
					var grandTotal = $("#grand_total").html();
					var final_discount = $("#final_discount").val();
					var reason_discount = $("#reason_discount").val();
					if (final_discount == '') {
						final_discount = 0;
					}
					var discount_type = $("input[name='discount_type']:checked").val();
					var final_discount_type = $("input[name='final_discount_type']").val();
					var f_discount = $("#f_discount").val();
					var advance = $("#advance").val();
					var persons = $("#persons").val();
					var balance = $("#balance").val();
					var patientRef = $("#patientRefId").val();
					var referralhospital = $("#refhospitalId option:selected").val();
					var referralHos = $('#hospital_id').val();
					var max_total = $("#max_total").val();
					var payment_mode = $("input[name='payment_mode']:checked").val();
					var testAmount = Array();
					var testId = Array();
					var discountAmount = Array();
					var departmentId = Array();
					var testInfo = Array();
					var doctorInfo = Array();
					var discount_value = Array();
					var specimen_test_wise = Array();
					var test_expanses = Array();
					$("input[name^=testAmount]").each(function() {
						testAmount.push(this.value);
					});
					$("input[name^=testExpanses]").each(function() {
						test_expanses.push(this.value);
					});
					$("input[name^=testId]").each(function() {
						testId.push(this.value);
					});
					$("input[name^=discountAmount]").each(function() {
						discountAmount.push(this.value);
					});
					$("input[name^=departmentId]").each(function() {
						departmentId.push(this.value);
					});
					$("input[name^=testInfo]").each(function() {
						testInfo.push(this.value);
					});
					$("input[name^=doctorInfo]").each(function() {
						doctorInfo.push(this.value);
					});
					$("input[name^=discount_value]").each(function() {
						discount_value.push(this.value);
					});

					var url = '<?php echo BASE_URL; ?>bill/billEntry';

					if (testId.length === 0) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html('Please Select test first.');
						return false;
					}
					$.ajax({
						type: "POST",
						url: url,
						dataType: "json",
						data: {
							"bill_id": bill_id,
							"billDate": billDate,
							"patient_id": patient_id,
							"total": total,
							"discount": 0,
							"grandTotal": grandTotal,
							"testAmount": testAmount,
							"testId": testId,
							"discountAmount": discountAmount,
							"final_discount": final_discount,
							"advance": advance,
							"balance": balance,
							"patientRef": patientRef,
							"payment_mode": payment_mode
						},
						success: function(res) {
							location.href = '<?php echo BASE_URL ?>report';
						}
					});
				}
			});

			// subit rport btn
			$('.submit_report').show();

			// on fill value 
			$(".call").keyup(function() {
				var id = (this.id);
				var id = id.substring(10, 200);
				var actual_value = $(this).val();
				var min_range = $("#min_range" + id).val();
				var max_range = $("#max_range" + id).val();
				if (min_range != '' || max_range != '') {
					if (Number(actual_value) > Number(max_range) || Number(actual_value) < Number(min_range)) {
						$(this).css("border", "1px solid red");
						$("#highlight" + id).prop('checked', true);
						$("#checkValue" + id).val('Yes');
					} else {
						$(this).css("border", "1px solid lightgray");
						$("#highlight" + id).prop('checked', false);
						$("#checkValue" + id).val('No');
					}
				}
			});

			// save-parameter
			$(".save-parameter").click(function() {
				var id = (this.id);
				var testname = $(this).data('testname');
				var test_id = id.substring(10, 200);
				var position1 = (this.name);
				if ($(".card-link").last().attr('id') == position1) {
					var position = 'Yes';
				} else {
					var position2 = position1.substring(4, 20);

					var position = Number(position2) + Number(1);
				}
				var formData = new FormData($("#postValue" + test_id)[0]);
				formData.append('testId', $(this).data('testid'));
				formData.append('reportDataid', $('#reportid' + test_id).val());
				formData.append('patientID', $('#patientID').val());
				formData.append('billId', $('#bill_id').val());
				$.ajax({
					type: "POST",
					url: '<?php echo BASE_URL; ?>report/saveReportvalue',
					dataType: "json",
					data: formData,
					processData: false,
					contentType: false,
					success: function(res) {

						if (res.success == 1) {

							new bootstrap.Toast(document.querySelector('#basicToast')).show();
							$('#basicToast').addClass('toast-success');
							$('#basicToast').removeClass('toast-error');
							$('.toast-body').html(testname + ' saved.');
							$(".img" + test_id).html('<img src="<?php echo BASE_URL ?>public/assets/images/icon-thumbs-up-active.svg" alt="Report Completed!" width="32" align="right">');

							if ($('#' + position1).parent().next().is('li')) {} else {
								// location.href = '<?php //echo BASE_URL; 
													?>report';
							}

							var href = $('#' + position1).parent().next().children().attr('href');
							var thishref = $('#' + position1).attr('href');

							$('#' + position1).parent().next().children().addClass('active');
							$(href).addClass('active');
							$(thishref).removeClass('active');
							$('#' + position1).removeClass('active');
						} else {
							new bootstrap.Toast(document.querySelector('#basicToast')).show();
							$('#basicToast').addClass('toast-error');
							$('#basicToast').removeClass('toast-success');
							$('.toast-body').html(res.msg);
						}
					},
					error: function(err) {
						console.dir(err);
					}
				});
			});

			$("body").on('click', '.bill_settle', function() {
				var id = $(this).data("id");
				var status = $(this).data('status');
				if (status == 'Pending') {
					var url = '<?php echo BASE_URL; ?>report/bill_settle';
				} else {
					var url = '<?php echo BASE_URL; ?>report/paid_details';
				}
				$.ajax({
					type: "POST",
					url: url,
					data: {
						"id": id
					},
					success: function(res) {
						if (status == 'Pending') {
							$("#bill_settlement .modal-content").html(res);
						} else {
							$("#bill_paid .modal-content").html(res);
						}

					}
				});
			});

			// pay model
			$("body").on('click', '#postValue', function() {

				$("#add_balance").attr("disabled", "disabled");
				var bill_id = $("#bill_id").val();
				var balance = $("#balance").val();
				var final_discount = $("#final_discount").val();
				var previous_amount = $('#previous_amount').val();
				var balance_received = $("#balance_received").val();
				var markaspaid = $("input[name='markaspaid']:checked").val();

				if (balance_received == 0) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('invalid amount.');
				} else {
					var add_discount = $("input[name='add_discount']:checked").val();
					var max_total = $("#max_total").val();
					var payment_mode = $("input[name='payment_mode']:checked").val();
					var totalBalance = balance - balance_received;
					if (totalBalance == 0 || add_discount == 'Yes') {
						var permission = true;
					} else {
						var permission = false;
					}
					$.ajax({
						type: "POST",
						url: '<?php echo BASE_URL; ?>bill/statusUpdate',
						dataType: "json",
						data: {
							"bill_id": bill_id,
							"balance_received": balance_received,
							"payment_mode": payment_mode,
							'permission': permission,
							'balance': balance,
							"final_discount": final_discount,
							"previous_amount": previous_amount,
							'markaspaid': markaspaid
						},
						success: function(res) {
							if (res.success == 1) {
								location.reload();
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							}
							$('.close ').click();
						},
						error: function(err) {
							new bootstrap.Toast(document.querySelector('#basicToast')).show();
							$('#basicToast').addClass('toast-error');
							$('#basicToast').removeClass('toast-success');
							$('.toast-body').html(err);
						}
					});
				}
			});

			$('.select label').click(function() {
				if ($('#select_all').is(':checked')) {
					$('.chkbox').prop('checked', false);
					$('#submit_report').attr('disabled', 'disabled');
					$("#testArea tr").removeClass('checked');
				} else {
					$('.chkbox').prop('checked', true);
					$("#testArea tr").addClass('checked');
					$('#submit_report').removeAttr('disabled', 'disabled');
				}
			});

			// review btn 
			$("body").on('click', '.review-btn', function() {
				var val = $(this).data('id');
				$("#test" + val).prop("checked", true);
				$("#department" + val).prop("checked", true);
				$('#submit_report').removeAttr('disabled', 'disabled');
				$("#report").submit();

			});

			// submit report
			$("#submit_report").click(function() {
				$("#report").submit();
			});

			$('#update_profile').click(function() {
				validationCheck('#profile');
				var formData = new FormData($('#profile-form')[0]);
				var updateurl = '<?php echo BASE_URL; ?>Users/update';
				if (submit_form) {
					$.ajax({
						type: "POST",
						url: updateurl,
						processData: false,
						contentType: false,
						data: formData,
						success: function(res) {
							if (res.success == 0) {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').addClass('toast-error');
								$('#basicToast').removeClass('toast-success');
								$('.toast-body').html(res.msg);
							} else {
								new bootstrap.Toast(document.querySelector('#basicToast')).show();
								$('#basicToast').removeClass('toast-error');
								$('#basicToast').addClass('toast-success');
								$('.toast-body').html(res.msg);
								location.reload();
							}
						}
					});
				}
				return false;
			});
			// onload select 
			<?php
        if(isset($_SESSION['loggedInId'])){
			?>
			onloadSelect();
			<?php 
		}
			?>

			function onloadSelect() {
				$.ajax({
					type: "POST",
					url: '<?php echo BASE_URL; ?>Patient/patientList',
					dataType: "json",
					success: function(res) {
						$('#searchPatientId').append(res);
					},
					error: function(err) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html('Something went wrong.');
					}
				});

				$.ajax({
					type: "POST",
					url: '<?php echo BASE_URL; ?>Doctor/referedList',
					dataType: "json",
					success: function(res) {
						$('#patientRef').append(res);
						$('#patientRefAdd').append(res);
					},
					error: function(err) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html('Something went wrong.');
					}
				});
			}

			// select 2 js
			$('#patientRefAdd').select2();
			$(document).on('select2:open', () => {
				document.querySelector('.select2-search__field').focus();
			});

			$("#patientRef").select2({
				dropdownParent: $('#patientEdit')
			});

			$('#patientRef').on('change', function() {
				var id = this.value;
				$('#refered_by_name').val(id);
			});
			$('#patientRefAdd').on('change', function() {
				var id = this.value;
				$('#refered_by_nameAdd').val(id);
			});

			// highlight 
			$(".call").keyup(function() {
				var id = (this.id);
				var id = id.substring(10, 200);
				var actual_value = $(this).val();
				var min_range = $("#min_range" + id).val();
				var max_range = $("#max_range" + id).val();
				if (min_range != '' || max_range != '') {
					if (Number(actual_value) > Number(max_range) || Number(actual_value) < Number(min_range)) {
						$(this).css("border", "1px solid red");
						$("#highlight" + id).prop('checked', true);
						$("#checkValue" + id).val('Yes');
					} else {
						$(this).css("border", "1px solid lightgray");
						$("#highlight" + id).prop('checked', false);
						$("#checkValue" + id).val('No');
					}
				}
			});

			$(".high").click(function() {
				var id = (this.id);
				var id = id.substring(9, 20);
				if ($("#highlight" + id).prop('checked') == true) {
					$("#checkValue" + id).val('Yes');
					$("#inputValue" + id).css("border", "1px solid red");
				} else if ($("#highlight" + id).prop('checked') == false) {
					$("#checkValue" + id).val('No');
					$("#inputValue" + id).css("border", "1px solid lightgray");
				}
			});

			$('#searchPatientId').keypress(function() {
				$('#searchPatientId').autocomplete({
					source: "<?php echo BASE_URL; ?>patient/searchPatient",
					minLength: 1,
					max: 10,
					scroll: true,
					autoFocus: true,
					select: function(event, ui) {
						event.preventDefault();
						$('#search_patient_id').val(ui.item.id);
						$('#searchPatientId').val(ui.item.patientname);
						$('#searchPatient').click();
					}
				}).data('ui-autocomplete')._renderItem = function(ul, item) {
					return $("<li class='ui-autocomplete-row'></li>")
						.data("item.autocomplete", item)
						.append(item.patientname + ' - ' + item.patientid)
						.appendTo(ul);
				};
			})

			$('ul.tabs li').click(function() {
				var tab_id = $(this).attr('data-tab');
				$('ul.tabs li').removeClass('active');
				$('.tab-content').removeClass('active');
				$(this).addClass('active');
				$("#" + tab_id).addClass('active');
			})

			$("body").on('click', '.tabs li', function() {
				var tabid = $(this).attr('id');
				localStorage.setItem('activetab', tabid);
			})

			if (localStorage.getItem('activetab')) {
				var id = localStorage.getItem('activetab');
				$('#' + id).click();
			}

			$("body").on('click', '.doc-model-btn', function() {
				var model_title = $(this).data('title');
				$('#doc-title').html(model_title);
				var did = $(this).data('id');
				$('#did').val(did);
				$("#dname,#designation,#dmobile,#daddress,#commission").val('');
				if (did != '') {
					var url = "<?php echo BASE_URL; ?>Doctor/editDetails";
					$.ajax({
						type: 'POST',
						url: url,
						dataType: 'json',
						data: {
							"id": did
						},
						success: function(res) {
							$("#did").val(res.id);
							$("#dname").val(res.referral_name);
							$('#designation').val(res.designation);
							$("#dmobile").val(res.mobile_no);
							$("#daddress").val(res.address);
							$("#commission").val(res.commission);
						}
					});
				}
			})

		});

		$("body").on('click', '.print-invoice-btn', function() {
			var id = $(this).data('id');
			$('#printinvoiceid').val(id);
		});

		$("body").on('click', '.radio-group', function() {
			if ($("input[name='invoice_type']:checked").val() == '3') {
				$('#withHeader').click();
			}
			if ($("input[name='payment_mode']:checked").val() != 'Due') {
				$('#advance').val('0');
				$('#advance').keyup();
				$('.advance-li').hide();
				$('.remain-li-span').html('Total Amount');
			} else {
				$('.advance-li').show();
				$('.remain-li-span').html('Remaining Amount');
			}
		});

		var format = $("input[name='invoice_type']:checked").val();

		$('body').on('click', '#withHeader', function() {
			var id = $("#printinvoiceid").val();
			var format = $("input[name='invoice_type']:checked").val();
			var url = '<?php echo BASE_URL; ?>invoice/index/' + id + '?format=' + format + '&header=true';
			window.open(url, '_blank');
			$(".modal .close").click();
			location.reload();
		});

		$('body').on('click', '#withoutHeader', function() {
			var id = $("#printinvoiceid").val();
			var format = $("input[name='invoice_type']:checked").val();
			var url = '<?php echo BASE_URL; ?>invoice/index/' + id + '?format=' + format + '&header=false';
			window.open(url, '_blank');
			$(".modal .close").click();
			location.reload();
		});

		$('body').on('click', '.authorise-sec label', function() {
			var id = $(this).data('id');
			var status = $(this).data('status');
			if (status == 'authorised') {
				$(this).data('status', '');
			} else {
				$(this).data('status', 'authorised');
			}
			var testname = $(this).data('testname');
			var bill_id = $('#bill_id').val();
			var url = "<?php echo BASE_URL; ?>Report/authoriseStatus";
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: {
					"id": id,
					"bill_id": bill_id,
					"status": status,
				},
				success: function(res) {
					if (res.success == 1) {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-success');
						$('#basicToast').removeClass('toast-error');
						$('.toast-body').html(testname + ' ' + res.msg);
					} else {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html(testname + ' ' + res.msg);
					}
				},
				error: function(err) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html('Something went wrong.');
				}
			});
		});

		function readURL(input, id) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$(id).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#letter_pad").change(function() {
			readURL(this, '#img_letter');
		});
		$("#lab_logo").change(function() {
			readURL(this, '#img_lablogo');
		});
		$("#fav_icon").change(function() {
			readURL(this, '#img_fav_icon');
		});

		$("#signature").change(function() {
			readURL(this, '#img_sign');
		});

		// input value funtions
		$('body').on('keyup', '#inputValue13,#inputValue14', function() {
			var total = $('#inputValue13').val();
			var Direct = $('#inputValue14').val();
			var Indirect = (Number(total) - Number(Direct)).toFixed(2);
			$('#inputValue15').val(Indirect);
		});

		function alertValue(id, numid) {
			var value_8 = $('#inputValue9').val();
			var value_9 = $('#inputValue10').val();
			var value_10 = $('#inputValue109').val();
			var value_11 = $('#inputValue110').val();

			Totalvalue = Number(value_8) + Number(value_9) + Number(value_10) + Number(value_11);
			alertid = "#alert" + numid;
			if (Totalvalue > 100) {
				$(alertid).css("color", "#dc3545").css("font-weight", "Bold");
				$(".btn-approve").hide();
				new bootstrap.Toast(document.querySelector('#basicToast')).show();
				$('#basicToast').addClass('toast-error');
				$('#basicToast').removeClass('toast-success');
				$('.toast-body').html('The combination percentage must below 100.');
			} else {
				$(alertid).css("color", "#05836b").css("font-weight", "Bold");
				$(".btn-approve").show();
			}
			$(".alert_id").css('display', 'none');
			$(alertid).css('display', 'inline-block').html(
				Number.parseInt(Totalvalue)
			);
		}

		$("#inputValue9").blur(function() {
			alertValue('#inputValue9', 9);
		});
		$("#inputValue10").blur(function() {
			alertValue('#inputValue10', 10);
		});
		$("#inputValue109").blur(function() {
			alertValue('#inputValue109', 109);
		});
		$("#inputValue110").blur(function() {
			alertValue('#inputValue110', 110);
		});

		$('body').on('keyup', '#user_fullname', function() {
			var value = $(this).val().replace(/[^a-z0-9\s]/gi, '_').replace(/[_\s]/g, '_')
			$('#user_username').val(value.toLowerCase());
		});


		$('#adduserbtn').click(function() {
			var $btn = $(this);
			validationCheck('#add_user');
			var fullname = $("#user_fullname").val();
			var username = $("#user_username").val();
			var email = $("#user_email").val();
			var mobile = $("#user_mobile").val();
			var role = $("#user_role").val();
			var password = $("#user_password").val();
			var userid = $("#user_userid").val();
			if (userid == '') {
				userid = "";
			}
			var storeUrl = '<?php echo BASE_URL; ?>Users/store';
			if (submit_form) {
				$.ajax({
					type: "POST",
					dataType: "json",
					url: storeUrl,
					data: {
						"fullname": fullname,
						"username": username,
						"email": email,
						"mobile": mobile,
						"role": role,
						'password': password,
						'userid': userid
					},
					success: function(res) {
						if (res.success == 0) {
							$("#add_user .errorTxt").removeClass("text-success");
							$("#add_user .errorTxt").addClass("text-danger");
							$("#add_user .errorTxt").html(res.msg);
						} else {
							$("#add_user .errorTxt").removeClass("text-danger");
							$("#add_user .errorTxt").addClass("text-success");
							$("#add_user .errorTxt").html(res.msg);
							location.reload();
						}
					}

				});
			}
			return false;
		});

		$('body').on('click', '.user-model-btn', function() {

			if ($(this).data('id') != '') {
				var id = $(this).data('id');
				$('#user-model-title').val('Edit User');
				$('#adduserbtn').val('Update');
				$('#user-pass-field').html('Update Password<span class="text-danger">*</span>')
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '<?php echo BASE_URL; ?>Users/getUser/' + id,
					success: function(res) {

						var fullname = $("#user_fullname").val(res.fullname);
						var username = $("#user_username").val(res.username);
						var email = $("#user_email").val(res.email);
						var mobile = $("#user_mobile").val(res.mobile);
						var role = $("#user_role").val(res.role).change();
						var password = $("#user_password").val('');
						var userid = $("#user_userid").val(res.id);
					},
					error: function() {
						new bootstrap.Toast(document.querySelector('#basicToast')).show();
						$('#basicToast').addClass('toast-error');
						$('#basicToast').removeClass('toast-success');
						$('.toast-body').html('something went wrong.');
					}

				});
			} else {
				$('#user-model-title').val('Add User');
				$('#adduserbtn').val('Save');
				$('#user-pass-field').html('User Password<span class="text-danger">*</span>')
			}
		});

		$('#imageInput').on('change', function() {
			$input = $(this);
			if ($input.val().length > 0) {
				fileReader = new FileReader();
				fileReader.onload = function(data) {
					$('.image-preview').attr('src', data.target.result);
				}
				fileReader.readAsDataURL($input.prop('files')[0]);
				$('.image-button').css('display', 'none');
				$('.image-preview').css('display', 'block');
				$('.change-image').css('display', 'block');
			}
		});

		$('.change-image').on('click', function() {
			$control = $(this);
			$('#imageInput').val('');
			$preview = $('.image-preview');
			$preview.attr('src', '');
			$preview.css('display', 'none');
			$control.css('display', 'none');
			$('.image-button').css('display', 'block');
		});

		function checkvalide() {
			var submit = false;
			$('#password-form .required').each(function() {
				if ($(this).val() == "" && !$(this).val()) {
					$(this).focus();
					$(this).parent('.form-group').addClass('error');
					$(this).siblings('.error').show();
					submit = false;
				} else {
					$(this).siblings('.error').hide();
					$(this).parent('.form-group').removeClass('error');
					submit = true;
				}
			});
			return submit;
		}
		//mvc  mch  mchc
		$('body').on('keyup', '#inputValue1,#inputValue2,#inputValue3', function() {
			var rbc = $('#inputValue2').val();
			var pvc = $('#inputValue3').val();
			var Hb = $('#inputValue1').val();
			var hct = $('#inputValue3').val();
			var mcv = Number(pvc) * 10 / Number(rbc);
			var mchc = Number(Hb) * 100 / Number(hct);
			var mch = Number(Hb) * 10 / Number(rbc);
			$('#inputValue6').val(mch.toFixed(2));
			$('#inputValue7').val(mchc.toFixed(2));
			$('#inputValue5').val(mcv.toFixed(2));
		});

		// lipid calculation cho
		$('body').on('keyup', '#inputValue54', function() {
			var Cholesterol = $('#inputValue54').val();
			var Triglycerides = $('#inputValue55').val();
			var HDL = $('#inputValue56').val();
			var LDL = $('#inputValue57').val();
			var VLDL = $('#inputValue58').val();
			$('#inputValue57').val(($('#inputValue54').val() - $('#inputValue56').val() - $('#inputValue58').val()).toFixed(2));
			$('#inputValue59').val(($('#inputValue57').val() / $('#inputValue56').val()).toFixed(2));
			$('#inputValue60').val((($('#inputValue54').val()) / ($('#inputValue56').val())).toFixed(2));
		});

		$('body').on('keyup', '#inputValue55', function() {
			var Cholesterol = $('#inputValue54').val();
			var Triglycerides = $('#inputValue55').val();
			var HDL = $('#inputValue56').val();
			var LDL = $('#inputValue57').val();
			var VLDL = $('#inputValue58').val();
			$('#inputValue58').val(($('#inputValue55').val() / 5).toFixed(2));
			$('#inputValue57').val(($('#inputValue54').val() - $('#inputValue56').val() - $('#inputValue58').val()).toFixed(2));
		});
		$('body').on('keyup', '#inputValue56', function() {
			var Cholesterol = $('#inputValue54').val();
			var Triglycerides = $('#inputValue55').val();
			var HDL = $('#inputValue56').val();
			var LDL = $('#inputValue57').val();
			var VLDL = $('#inputValue58').val();
			$('#inputValue57').val(($('#inputValue54').val() - $('#inputValue56').val() - $('#inputValue58').val()).toFixed(2));
			$('#inputValue59').val(($('#inputValue57').val() / $('#inputValue56').val()).toFixed(2));
			$('#inputValue60').val((($('#inputValue54').val()) / ($('#inputValue56').val())).toFixed(2));
		});

		$('body').on('keyup', '.listInputClass', function() {
			var id = $(this).data('id');
			var thisvalue = '';
			$(".listInput" + id).each(function() {
				thisvalue += this.value + ',';
			});
			var lastIndex = thisvalue.lastIndexOf(",");
			thisvalue = thisvalue.substring(0, lastIndex);
			$("#inputValue" + id).val(thisvalue);
		});

		$('body').on('click', '.whatsapp_click', function() {
			$("#patient_mobile_no").removeAttr('style');
			var api = $(this).data("url");
			var pid = $(this).data("pid");
			$('#shareUrl').val(api);
			$.ajax({
				type: "GET",
				url: '<?php echo BASE_URL ?>Report/getpatientinfoByID/' + pid,
				success: function(res) {
					res = JSON.parse(res);
					$('#patient_mobile_no').val(res.mobile);
				},
				error: function(request, status, error) {
					new bootstrap.Toast(document.querySelector('#basicToast')).show();
					$('#basicToast').addClass('toast-error');
					$('#basicToast').removeClass('toast-success');
					$('.toast-body').html(request.responseText);
				}
			});
			$("#patient_mobile_no").focus();
		});

		$('#share_whatsapp_no').on('click', function() {
			if ($("#patient_mobile_no").val() == '') {
				$("#patient_mobile_no").css("border", "1px solid red");
				$("#patient_mobile_no").focus();
				return false;
			} else {
				$("#patient_mobile_no").css("border", "1px solid lightgray");
			}
			var patient_mobile_no = $('#patient_mobile_no').val();
			$('#whatsapp_popup').modal('toggle');
			var link = encodeURI('Your Test Report at <?php if(isset($_SESSION['BASE_TITILE'])){ echo $_SESSION['BASE_TITILE']; }else{ echo BASE_TITILE; } ?> is ready. Please Collect it ') + encodeURIComponent($('#shareUrl').val());
			console.log($('#shareUrl').val());
			window.open("https://wa.me/91" + patient_mobile_no + "?text=" + link);
		});
		// dont remove
	<?php } ?>
</script>

<div id="basicToast" class="toast align-items-center text-white border-0" role="alert" data-bs-animation="true" data-bs-delay="3000" aria-live="assertive" aria-atomic="true">
	<div class="d-flex">
		<div class="toast-body">
			Hello, This is a warning message.
		</div>
		<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-bs-label="Close"></button>
	</div>
</div>
</body>

</html>