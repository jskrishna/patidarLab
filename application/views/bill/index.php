<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Billing</h2>
            <?php if (isset($patientData)) { ?>
                <button class="btn custom-btn patientedit_btn" data-bs-toggle="modal" data-id="<?php echo $patientData->id; ?>" data-bs-target="#patientEdit"> Edit Patient</button>
            <?php } ?>
        </div>
        <div class="billing-sec">
            <div class="row">
                <div class="col-lg-12">
                    <form onsubmit="return false">
                        <div id="search" style="<?php if (isset($_GET['t'])) {
                                                    echo 'display:none;';
                                                } ?>">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Select Patient <span class="text-danger">*</span></label>
                                    <input type="hidden" name="search_patient_id" id="search_patient_id">
                                    <input type="text" name="searchPatientId" id="searchPatientId" placeholder="Search by Patient Name / Mobile Number" class="search__field txt_stle form-control ui-autocomplete-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 text-center">
                                    <input type="button" name="searchPatient" id="searchPatient" class="btn custom-btn btnupdate font-weight-bolder btn-primary" value="Go">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($patientData)) { ?>
                            <div id="main" style="<?php if (!isset($_GET['t'])) {
                                                        echo 'display:none;';
                                                    } ?>">
                                <!-- <div class="row">
                                    <div class="form-group col-lg-2 barcode">
                                        <iframe scrolling="no" style="border: 0px;" id="barcode" src="https://niglabs.com/barcodeSample.php?code=<?php echo $_GET['t']; ?>" border="0" width="300" height="50"></iframe>
                                    </div>
                                </div> -->
                       
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="patient_name">Patient Name</label>
                                        <span id="patient_name" class="font-weight-bold">
                                            <?php echo $patientData->title . '. ' . $patientData->patientname . ' (' . $patientData->gender[0] . ' - ' . $patientData->age . ')'; ?>
                                            <br>
                                            <?php echo "Patient No : " . $patientData->patientid; ?>
                                        </span>
                                        <input type="hidden" name="editpatientid" id="editpatientid" value="<?php echo $patientData->id; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 ">
                                        <label for="patientRef">Referral Details <span class="text-danger">*</span></label>
                                        <?php foreach ($doctorData as $doctor) {
                                            if ($doctor->id == $patientData->refered_by) {
                                        ?>
                                                <input type="text" name="patientRef" id="patientRef" class="form-control ui-autocomplete-input" value="<?php echo $doctor->referral_name; ?>" autocomplete="off">
                                        <?php }
                                        } ?>
                                        <input type="hidden" name="patientRefId" id="patientRefId" value="<?php echo $patientData->refered_by; ?>" class="form-control">
                                        <label id="patient_ref" class="text-danger"></label>
                                    </div>
                                    <div class="form-group col-lg-6 billadd">
                                        <label for="billDate">Bill Date <span class="text-danger">*</span></label>
                                        <input type="date" name="billDate" id="billDate" class="form-control" value="2022-01-25" onkeydown="return false">
                                        <input type="hidden" name="time" id="time" class="form-control" value="16:19:55">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="billDate">Test Name <span class="text-danger">*</span></label>
                                        <input type="text" name="test" class="form-control tab_inp ui-autocomplete-input" id="test" tabindex="0" autocomplete="off">
                                        <input type="hidden" name="test_id" class="form-control" id="test_id">
                                        <input type="hidden" name="group_code" class="form-control" id="group_code">
                                        <input type="hidden" name="group_id" class="form-control" id="group_id">
                                        <input type="hidden" name="department_id" class="form-control" id="department_id">
                                        <input type="hidden" name="test_specimen" class="form-control" id="test_specimen">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="departments">Department <span class="text-danger">*</span></label>
                                        <select name="departments" id="departments" class="form-control">
                                            <option selected>Select Department</option>
                                            <?php foreach ($departmentData as $department) { ?>
                                                <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="test_amount">Amount <span class="text-danger">*</span></label>
                                        <input type="hidden" id="nameTest" name="nameTest">
                                        <input type="number" name="test_amount" id="test_amount" class="form-control prc number_only" readonly="">
                                        <input type="hidden" name="test_amount1" id="test_amount1">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="discount_amount">Discount</label>
                                        <input type="number" name="discount_amount" id="discount_amount" class="form-control prc number_only">
                                    </div>
                                    <div class="col-lg-2"><br>
                                        <input type="radio" name="discount_type" id="discount_type" value="Percentage"> % &nbsp;
                                        <input type="radio" name="discount_type" id="discount_type" value="Amount" checked="checked"> ₹
                                    </div>
                                    <div class="col-lg-2">
                                        <label></label>
                                        <button type="button" name="add_list" id="add_list" class="btn custom-btn add-billing " value="Add" disabled="disabled">Add</button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Test Name</th>
                                                    <th width="125px">Test ID</th>
                                                    <th width="125px">Price (₹)</th>
                                                    <th width="125px">Discount (₹)</th>
                                                    <th width="50px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="testRequest">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="1">Total</th>
                                                    <th class="text-right">₹</th>
                                                    <th><input type="text" name="total" id="total" class="form-control" readonly="" value=""></th>
                                                    <th><input type="text" name="discount" id="discount" class="form-control" value="0" readonly="">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Final Total</th>
                                                    <th class="text-right">₹</th>
                                                    <th colspan="2"><input type="text" name="final_total" id="final_total" class="form-control" value="0" readonly=""></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Final Discount &nbsp;&nbsp;<input type="radio" name="final_discount_type" id="final_discount_type" value="Percentage"> % &nbsp;<input type="radio" name="final_discount_type" id="final_discount_type" value="Amount" checked="checked"> ₹ &nbsp;&nbsp; <input type="number" name="f_discount" id="f_discount" value="" tabindex="1" class="form-control-sm number_only tab_inp"></th>
                                                    <th class="text-right">₹</th>
                                                    <th colspan="2"><input type="text" name="final_discount" value="" id="final_discount" class="form-control" readonly=""></th>
                                                </tr>
                                                <input type="hidden" name="reason_otp" id="reason_otp" value="verified">
                                                <input type="hidden" name="testInfo[]" id="testInfo" value="X Ray"><input type="hidden" name="doctorInfo[]" id="doctorInfo" class="form-control tab_inp" tabindex="2" value="0">
                                                <input type="hidden" name="reward1" id="reward1" class="form-control" value="">
                                                <input type="hidden" name="reward" id="reward" class="form-control" value="" readonly="readonly">
                                                <tr class="bill_amount_only" style="display:none">
                                                    <th colspan="1">Number of Persons</th>
                                                    <th class="text-right"></th>
                                                    <th colspan="2"><input type="number" name="persons" id="persons" class="form-control number_only" onkeypress="if(this.value.length==4) return false;">
                                                    </th>
                                                </tr>
                                                <input type="hidden" name="rewardSaveAmount" id="rewardSaveAmount" class="form-control" value="">
                                                <input type="hidden" name="point" id="point" value="0">
                                                <input type="hidden" name="rewardpoint" id="points" value="">
                                                <input type="hidden" name="rewamount" id="rewamount" value="">
                                                <input type="hidden" name="rewamountupdate" id="rewamountupdate" value="">
                                                <tr>
                                                    <th colspan="1">Grand Total</th>
                                                    <th class="text-right">₹</th>
                                                    <th colspan="2"><input type="text" name="grand_total" id="grand_total" class="form-control" value="" readonly="">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Advance Amount</th>
                                                    <th class="text-right">₹</th>
                                                    <th colspan="2"><input type="number" name="advance" id="advance" value="" class="form-control number_only tab_inp" tabindex="6">
                                                        <input type="hidden" name="like" id="like" value="">
                                                    </th>
                                                </tr>
                                                <input type="hidden" name="paid" id="paid" value="0" class="form-control number_only tab_inp" tabindex="6">
                                                <tr>
                                                    <th colspan="1">Balance Amount </th>
                                                    <th class="text-right">₹</th>
                                                    <th colspan="2">
                                                        <input type="text" name="balance" id="balance" class="form-control" readonly="" value="">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Payment Mode
                                                        <span class="text-danger">*</span>
                                                    </th>
                                                    <th class="text-right"></th>
                                                    <th colspan="2">
                                                        <select name="payment_mode" id="payment_mode" tabindex="7" class="form-control tab_inp">
                                                            <option value="Due">Due </option>
                                                            <option value="Credit">Credit </option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                            <option value="Net Banking">Net Banking</option>
                                                            <option value="Google Pay">Google Pay</option>
                                                            <option value="PhonePe">PhonePe</option>
                                                            <option value="PAYTM">PAYTM</option>
                                                            <option value="Amazon Pay">Amazon Pay</option>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr class="test_save" style="display: none;">
                                                    <input type="hidden" id="bill_id" name="bill_id" value="">
                                                    <th colspan="4" class="text-center">
                                                        <button name="test_save" type="button" tabindex="8" id="test_save" class=" btn btn-success text-white font-weight-bolder tab_inp">Save</button>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="selectTest">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Test</h5>
                                </div>
                                <div class="col-lg-4 text-right">

                                    <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="test_selected">
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn custom-btn btnupdate" id="bottom">Submit</button>
                            <button type="button" class="btn custom-btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                            <div id="new_patient">
                                <div class="row">
                                    <div class="form-group col-lg-2">
                                        <label for="fieldName">Title<span class="text-danger">*</span>
                                        </label>
                                        <select name="title" id="title" class="form-control">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="New Born">New Born</option>
                                            <option value="Baby">Baby</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-10">
                                        <input type="hidden" name="patientID" id="patientID" class="form-control" placeholder="Full Name">
                                        <label class="fieldName">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" name="patientName" id="patientName" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="fieldName">Age</label>
                                        <input type="text" name="age" onkeypress="if(this.value.length==6)return false;" id="age" class="form-control" placeholder="Age" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <input type="hidden" name="age_type" id="age_type" value="Y">
                                        <label class="fieldName">Age Type</label>
                                        <div class="btn-group btn-block">
                                            <button type="button" class="btn btn-primary age-type " id="Y">Y</button>
                                            <button type="button" class="btn btn-secondary age-type" id="M">M</button>
                                            <button type="button" class="btn btn-secondary age-type" id="D">D</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="refered_by_name">Gender</label>
                                        <input type="hidden" name="gender" id="gender">
                                        <div class="btn-group btn-block">
                                            <button type="button" class="btn btn-primary btn-process " id="Male">Male</button>
                                            <button type="button" class="btn btn-secondary btn-process" id="Female">Female</button>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="fieldName">Contact Number
                                        </label>
                                        <input type="number" name="mobileNo" id="mobileNo" class="form-control number_only" onkeypress="if(this.value.length==10)return false;" placeholder="Mobile Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="fieldName">Email
                                        </label>
                                        <input type="text" name="emailId" id="emailId" class="form-control" placeholder="Email ID" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="pin">Zip Code
                                        </label>
                                        <input type="number" name="pin" id="pin" class="form-control number_only" onkeypress="if(this.value.length==6)return false;" placeholder="Pincode">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="address">Address</label>
                                    <div class="form-group col-lg-12">
                                        <textarea type="text" name="address" id="address" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="row" id="ref_detail">
                                    <label for="refered_by_name">Referred By</label>
                                    <div class="form-group col-lg-12">
                                        <select name="refered_by_name" id="refered_by_name" class="form-control">
                                            <?php foreach ($referedData as $data) { ?>
                                                <option <?php if ($data->id == 1) {
                                                            echo 'selected';
                                                        } ?> value="<?php echo $data->id; ?>"><?php echo $data->referral_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 text-center">
                            <input type="button" class="btn btnupdate custom-btn" id="gotoBilling" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>