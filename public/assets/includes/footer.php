</main>
<div class="c-modal modal right fade" id="patientEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<div class="row">
							<div class="form-group col-lg-6">
								<label for="mobileNo">Contact Number
								</label>
								<input type="number" name="mobileNo" id="mobileNo" class="form-control number_only" onkeypress="if(this.value.length==10)return false;" placeholder="Mobile Number" autocomplete="off">
							</div>
							<div class="form-group col-lg-6">
								<label for="pin">Pin Code
								</label>
								<input type="number" name="pin" id="pin" class="form-control number_only" onkeypress="if(this.value.length==6)return false;" placeholder="Pincode">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12">
								<label for="address">Address</label>
								<textarea type="text" name="address" id="address" class="form-control" placeholder="Address"></textarea>
							</div>
						</div>
						<div class="row" id="ref_detail">
							<div class="form-group col-lg-12">
								<label for="patientRef">Referred By<span class="text-danger">*</span></label>
								<input type="hidden" id="refered_by_name" value="" name="refered_by_name" class="ui-autocomplete-input required">
								<select name="patientRef" id="patientRef" class="form-control search-input">
									<option>Select Refered By </option>
								</select>
								<span class="error">This field is required.</span>
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-lg-12 text-center">
					<input type="button" class="btn btnupdate custom-btn m-auto" id="gotoBilling" value="Update">
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/dataTables.bootstrap.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/dataTables.responsive.js"></script> -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script type="text/javascript">
	$(document).ready(function() {

		$('#login_btn').click(function() {
			var $btn = $(this);

			var submit_form = true;
			$('.login-form .required').each(function() {
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

			var username = $("#username").val();
			var password = $("#password").val();
			var loginurl = '<?php echo BASE_URL; ?>login';
			if (submit_form) {
				$.ajax({
					type: "POST",
					dataType: "json",
					url: loginurl,
					data: {
						"username": username,
						"password": password
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
							location.href = res.redirect_url;
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


		var test = Array();
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

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})

		//calculation
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
				rewpoint += Number(this.value) * Number(rew);
			});

			$("input[name^=testExpanses]").each(function() {
				totalTestExpanses = Number(totalTestExpanses) + Number(this.value);
			});
			var grandTotal = total - discount;
			$("#total").val(total);
			$("#discount").val(discount);
			$("#final_total").val(grandTotal);

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
			console.log(final_discount);

			var gTotal = Number(grandTotal) - Number(final_discount);
			var finAmount = Number(gTotal);
			var finaAmount;
			finaAmount = Number(gTotal);
		
				$("#total").val(finAmount);
			$("#grand_total").val(finAmount);
			if ('NO' == 'YES' && '' == 'ENABLED') {
				$("#advance").val(finAmount);
			}
			var paid = $("#paid").val();
			var advance_paid = Number(advance) + Number(paid)
			$("#advance").attr('max', finaAmount);
			var balance = finaAmount.toFixed(2);
			if ('NO' == 'YES') {
				$("#balance").val(0);
			} else {
				$("#balance").val(balance);
			}

			if (final_discount > grandTotal) {
				$(".test_save").hide();
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
				$(".test_save").hide();
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
					$(".test_save").hide();
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
			var submit_form = true;
			$('#new_patient .required').each(function() {
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
							alert('Something went wrong.');
						}

					}
				});
			}
		});
		//patient edit 
		$("#gotoBilling").click(function() {
			var submit_form = true;
			$('#edit_patient .required').each(function() {
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
							alert('Something went wrong.');

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
					$('#' + res.age_type).addClass("btn-primary").removeClass("btn-secondary");
				}
			});
		});

		//patient delete 
		$('.btn-delete').on('click', function() {
			var url = $(this).data("url");
			var title = $(this).data("title");
			$('#confirmdeletepatient').attr("href", url);
			$('#delete_model_msg').html("Are you sure you want to delete " + title + "?");
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
						alert('Something went wrong.');
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
alert('Something went wrong.');
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
			if ($("#search_patient_id").val() == '') {
			} else {
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

		var today = year + "-" + month + "-" + day;
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

		// in bill patient update 
		$("#gotoBillingEdit").click(function() {
			if ($("#title_patientEdit").val() == '') {
				$('#title_patientEdit').css("border", "1px solid red");
				$('#title_patientEdit').focus();
				return false
			} else {
				$('#title_patientEdit').css("border", "1px solid lightgray");
			}
			if ($("#patientNameEdit").val() == '') {
				$('#patientNameEdit').css("border", "1px solid red");
				$('#patientNameEdit').focus();
				return false
			} else {
				$('#patientNameEdit').css("border", "1px solid lightgray");
			}
			if ($("#ageEdit").val() == '') {
				$('#ageEdit').css("border", "1px solid red");
				$('#ageEdit').focus();
				return false
			} else {
				$('#ageEdit').css("border", "1px solid lightgray");
			}

			$("#errorText").hide();
			var id = $("#patientIdEdit").val();
			var title = $("#title_patientEdit").val();
			var patientName = $("#patientNameEdit").val();
			var mobileNo = $("#mobileNoEdit").val();
			var alternateMobileNo = $("#alternateMobileNoEdit").val();
			var emailId = $("#emailIdEdit").val();
			var gender = $("#genderEdit").val();
			var refered_by = $("#refered_byEdit").val();
			var area = $("#areaEdit").val();
			var city = $("#cityEdit").val();
			var pin = $("#pinEdit").val();
			var age = $("#ageEdit").val();
			var age_type = $("#age_type").val();
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL; ?>patient/patientUpdate",
				dataType: "json",
				data: {
					"id": id,
					"title": title,
					"patientName": patientName,
					"mobileNo": mobileNo,
					"alternateMobileNo": alternateMobileNo,
					"emailId": emailId,
					"gender": gender,
					"refered_by": refered_by,
					"area": area,
					"city": city,
					"pin": pin,
					"age": age,
					"age_type": age_type
				},
				success: function(res) {
					$('#patient_name').html(title + '. ' + patientName + ' (' + gender.charAt(0) + ' - ' + age + ' )<br>Patient No : ' + $('#patientIdaEdit').html());
					$(".modal .close").click();
				}
			});
		});

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

			var test_count = 0;
			var testId = $("#test_id").val();
			var test_in = $.inArray(testId, test);
			if (test_in >= 0 || test_count > 0) {
			alert("You selected test was already added kindly add other test");

			} else {
				test.push(testId);
				$("#add_list").attr("disabled", "disabled");
				var departmentId = $("#department_id").val();
				var testAmount = $("#test_amount").val();
				var discountAmount = 0;
				var discountAmount1 = 0;
				var nameTest = $("#nameTest").val();
				$("#testRequest").append("<tr><td>" + nameTest + "<input type='hidden' name='testId[]' id='testId' value=" + testId + " class='form-control testId' readonly></td><td><input type='text' name='testAmount[]' id='testAmount' value=" + testAmount + " class='form-control testAmount' readonly><input type='hidden' name='discount_value[]' id='discount_value' value='" + discountAmount1 + "'><input type='hidden' name='discountAmount[]' id='discountAmount' value=" + discountAmount + " class='form-control testAmount' readonly></td><td><a href='#' class='remove_this btn btn-danger'>X</a></td></tr>");
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
			$("#bottom").attr('disabled', 'disabled');
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
			$("#grand_total").val('');
			$("#advance").val('');
		});

		$("#f_discount").keyup(function() {
			discount();
			calculation();
			var final_total = $("#final_total").val();
			var f_discount = $("#f_discount").val();
			var final_discount = f_discount;

			if (Number(final_discount) > Number(final_total)) {
				alert("The discount amount is higher than the test amount...");
				$(".test_save").hide();
				$("#test_clear").hide();
			} else {
				if ($.trim($('#grand_total').val()))
					$("#test_save").show("disabled", "disabled");
				$("#test_clear").show("disabled", "disabled");
			}
		});

		//test bill save
		$("#test_save").click(function(e) {

			if ($("#billDate").val() == '') {
				$("#billDate").css("border", "1px solid red");
				$("#billDate").focus();
				alert('Something is missing.');
				return false;
			} else {
				$("#billDate").css("border", "1px solid lightgray");
			}

			if ($("#test_id").val() != '') {
				alert('Something went wrong.');

			} else {
				if ($("#payment_mode").val() == '') {
					$("#payment_mode").css("border", "1px solid red");
					$("#payment_mode").focus();
					return false;
				} else {
					$("#payment_mode").css("border", "1px solid lightgray");
				}

				if (!$.trim($('#grand_total').val())) {
					alert('Please enter test names.');

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
				var total = $("#final_total").val();
				var discount = $("#discount").val();
				var grandTotal = $("#grand_total").val();
				var final_discount = $("#final_discount").val();
				var reason_discount = $("#reason_discount").val();
				if (final_discount == '') {
					final_discount = 0;
				}
				var discount_type = $("input[name='discount_type']:checked").val();
				var final_discount_type = $("input[name='final_discount_type']").val();
				var f_discount = $("#f_discount").val();
				var advance = 0;
				var persons = $("#persons").val();
				var balance = $("#balance").val();
				var patientRef = $("#patientRefId").val();
				var referralhospital = $("#refhospitalId option:selected").val();
				var referralHos = $('#hospital_id').val();
				var max_total = $("#max_total").val();
				var payment_mode = $("#payment_mode").val();
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
					alert('Please Select test first.');

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
						"discount": discount,
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

		// btn-action
		$(".btn-action").click(function() {
			var id = (this.id);
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
					console.log(res);
					$(".img" + test_id).html('<img src="<?php echo BASE_URL ?>public/assets/images/icon-thumbs-up-active.svg" alt="Report Completed!" width="32" align="right">');
				},
				error: function(err) {
					console.dir(err);
				}
			});
		});

		$("body").on('click', '.bill_settle', function() {
			var id = $(this).data("id");
			$.ajax({
				type: "POST",
				url: '<?php echo BASE_URL; ?>report/bill_settle',
				data: {
					"id": id
				},
				success: function(res) {
					$("#bill_settlement .modal-content").html(res);
				}
			});
		});

		$("body").on('click', '#postValue', function() {
			if ($("#payment_mode").val() == '') {
				$("#payment_mode").css("border", "1px solid red");
				$("#payment_mode").focus();
				return false;
			}
			$("#add_balance").attr("disabled", "disabled");
			var bill_id = $("#bill_id").val();
			var balance = $("#balance").val();
			var final_discount = $("#final_discount").val();

			var balance_received = $("#balance_received").val();
			if (balance_received == 0) {
				alert('invalid amount');

			} else {
				var add_discount = $("input[name='add_discount']:checked").val();
				var max_total = $("#max_total").val();
				var payment_mode = $("#payment_mode").val();
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
						"final_discount": final_discount
					},
					success: function(res) {
						if(res.success == 1){
							location.reload();
						}else{
							alert(res.msg);
						}
						$('.close ').click();
					},
					error: function(err) {
						alert(err);
					}
				});
			}
		});

		$('.select label').click(function() {
			if ($('#select_all').is(':checked')) {
				$('.chkbox').prop('checked', false);
				$('#submit_report').attr('disabled', 'disabled');
			} else {
				$('.chkbox').prop('checked', true);
				$('#submit_report').removeAttr('disabled', 'disabled');
			}
		});

		$('.single-select label').click(function() {
			if ($(this).find('.chkbox').is(':checked')) {
				$(this).prop('checked', false);
				$('#submit_report').attr('disabled', 'disabled');
			} else {
				$(this).find('.chkbox').prop('checked', true);
				$('#submit_report').removeAttr('disabled', 'disabled');
			}
		})
		// review btn 
		$("body").on('click', '.review-btn', function() {

			var val = $(this).data('id');
			$("#test" + val).prop("checked", true);
			$('#submit_report').removeAttr('disabled', 'disabled');
			$("#report").submit();

		});

		// submit report
		$("#submit_report").click(function() {
			$("#report").submit();
		});
	});

	$(".report-filter li").on('click', function() {
		$(".report-filter li").removeClass('active');
		$(this).addClass('active');
	});


	$('#update_profile').click(function() {
		var submit_form = true;
		$('#profile .required').each(function() {
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
						$(".errorTxt").removeClass("text-success");
						$(".errorTxt").addClass("text-danger");
						$(".errorTxt").html(res.msg);
						alert('Something went wrong');
					} else {
						$(".errorTxt").removeClass("text-danger");
						$(".errorTxt").addClass("text-success");
						$(".errorTxt").html(res.msg);
						
					}
				}

			});
		}
		return false;
	});
	// onload select 

	onloadSelect();

	function onloadSelect() {
		$.ajax({
			type: "POST",
			url: '<?php echo BASE_URL; ?>Patient/patientList',
			dataType: "json",
			success: function(res) {
				$('#searchPatientId').append(res);
			},
			error: function(err) {
				alert('Something went wrong');
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
				alert('Something went wrong');
			}
		});

	}
	$('#searchPatientId,#patientRef, #patientRefAdd').select2({
    // width: '100%', 
    multiple: true,
    maximumSelectionLength: 1,
    placeholder: "Select or Search Here",   
});

	// $("#patientRef").select2();
	// $("#patientRefAdd").select2();

	$('#searchPatientId').on('change', function() {
		var id = this.value;
		$('#search_patient_id').val(id);
		$('#searchPatient').click();
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
	$(".call").keyup(function(){
		
		var id=(this.id);
		var id=id.substring(10,200);
		var actual_value=$(this).val();
		var min_range=$("#min_range"+id).val();
		var max_range=$("#max_range"+id).val();
		if(min_range!='' || max_range!=''){
			if(Number(actual_value) > Number(max_range) || Number(actual_value) < Number(min_range)){
				$(this).css("border","1px solid red");
				$("#highlight"+id).prop('checked',true);
				$("#checkValue"+id).val('Yes');
			}
			else{
				$(this).css("border","1px solid lightgray");
				$("#highlight"+id).prop('checked',false);
				$("#checkValue"+id).val('No');
			}
		}
	});

	$(".high").click(function(){
		var id=(this.id);
		var id=id.substring(9,20);
		if($("#highlight"+id).prop('checked')==true){
			$("#checkValue"+id).val('Yes');
			$("#inputValue"+id).css("border","1px solid red");
		}
		else if($("#highlight"+id).prop('checked')==false){
			$("#checkValue"+id).val('No');
			$("#inputValue"+id).css("border","1px solid lightgray");
		}

	});
</script>
</body>

</html>