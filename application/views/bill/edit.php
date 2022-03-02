<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <script>
            var test = Array();
        </script>
        <div class="page-head page-head-border">
            <h2>Bill Edit</h2>
            <a class="btn custom-btn patientedit_btn" href="<?php echo BASE_URL; ?>report">Back</a>
        </div>
        <div class="tests-sec">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="report-list-head">
                        <div class="patient-name-sec">
                            <div class="name-sec-inr">
                                <div class="name-sec-left">
                                    <div class="name-icon">
                                        <h3>
                                            <?php $name = explode(' ', $patientData->patientname);
                                            foreach ($name as $n) {
                                                echo $n[0];
                                            } ?>
                                        </h3>
                                    </div>
                                    <div class="patient-name">
                                        <input type="hidden" value="<?php echo $patientData->id; ?>" id="editpatientid" name="editpatientid">
                                        <h3><?php echo $patientData->title . '. ' . $patientData->patientname ?></h3>
                                        <div class="patient-dtl">
                                            <p>
                                                <img src="<?php echo BASE_URL ?>public/assets/images/feather-calendar.svg" alt="">
                                                <span>
                                                    <?php echo $patientData->age . ' ' . $patientData->age_type; ?>
                                                </span>
                                            </p>
                                            <p>
                                                <img src="<?php echo BASE_URL ?>public/assets/images/feather-user.svg" alt="">
                                                <span>
                                                    <?php echo $patientData->gender ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="name-sec-center">
                                    <p>
                                        <label for="">Patient ID:</label><span><?php echo $patientData->patientid; ?></span>
                                    </p>
                                    <p><label for="">Bill:</label> <span><?php echo date_format(new DateTime($billData[0]->billDate), "d-m-Y"); ?></span></p>
                                    <p>
                                        <label for="">Referred by:</label>
                                        <input type="hidden" name="patientRefId" id="patientRefId" value="<?php echo $patientData->refered_by; ?>" class="form-control">
                                        <?php foreach ($doctorData as $doctor) {
                                            if ($doctor->id == $patientData->refered_by) {
                                        ?>
                                                <span class="text-capitalize"><?php echo $doctor->referral_name; ?></span>
                                                <!-- <input type="text" name="patientRef" id="patientRef" class="form-control ui-autocomplete-input" value="<?php //echo $doctor->referral_name; ?>" autocomplete="off"> -->
                                        <?php }
                                        } ?>
                                    </p>
                                </div>
                                <div class="name-sec-right">
                                    <!-- <p class="edit-bill-d">
                                        <img src="<?php //echo BASE_URL ?>public/assets/images/feather-clock-active.svg" alt="">
                                        <span><?php //echo date_format(new DateTime($billData[0]->billDate), "d-m-Y"); ?></span>
                                        <input type="hidden" name="billDate" id="billDate" class="form-control" value="<?php //echo date_format(new DateTime($billData[0]->billDate), "Y-m-d"); ?>" onkeydown="return false">
                                        <input type="hidden" name="time" id="time" class="form-control" value="<?php //echo date_format(new DateTime($billData[0]->billDate), "H:i:s"); ?>">
                                    </p> -->
                                    <?php if ($patientData->mobile) { ?>
                                        <p>
                                            <img src="<?php echo BASE_URL ?>public/assets/images/feather-phone-call.svg" alt="">
                                            <span><?php echo $patientData->mobile ?></span>
                                        </p>
                                    <?php  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form onsubmit="return false">
                        <div id="main" class="fixed-save">
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="test">Test Name <span class="text-danger">*</span></label>
                                    <input type="text" name="test" class="form-control tab_inp ui-autocomplete-input" id="test" tabindex="0" autocomplete="off">
                                    <input type="hidden" name="test_id" class="form-control" id="test_id">
                                </div>
                                <div class="form-group  col-lg-3">
                                    <label for="departments">Department <span class="text-danger">*</span></label>
                                    <select name="departments" id="departments" class="form-control">
                                        <option selected>Select Department</option>
                                        <?php foreach ($departmentData as $department) { ?>
                                            <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input type="hidden" id="nameTest" name="nameTest">
                                <input type="hidden" name="test_amount" id="test_amount" class="form-control prc number_only">
                                <div class="col-lg-2" style="display: none;">
                                    <button type="button" name="add_list" id="add_list" class="btn custom-btn add-billing " value="Add" disabled="disabled">Add</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="c-datatable">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Test Name</th>
                                                    <th>Price (₹)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="testRequest">
                                                <?php
                                                $testIds = explode(',', $billData[0]->testId);
                                                $discountAmounts = json_decode($billData[0]->discountAmount);
                                                foreach ($testIds as $param => $test) {
                                                    $testData =  $pxthis->Bill_model->getTestByID($test);
                                                    $testData = $testData[0]; ?>
                                                    <script>
                                                        test.push(<?php echo $test; ?>);
                                                    </script>
                                                    <tr>
                                                        <td><?php echo $testData->test_name; ?></td>
                                                        <input type='hidden' name='testId[]' id='testId' value="<?php echo $testData->id; ?>" class='form-control testId' readonly>
                                                        <td>
                                                            <!-- <input type='text' name='testAmount[]' id='testAmount' value=<?php //echo intval($testData->amount); 
                                                                                                                                ?> class='form-control testAmount' readonly> -->
                                                            <span id="testAmount"><?php echo intval($testData->amount); ?></span>

                                                        </td>
                                                        <input type='hidden' name='discountAmount[]' id='discountAmount' value=<?php echo $discountAmounts[$param]; ?> class='form-control testAmount' readonly>
                                                        <td><a href='#' class='remove_this btn btn-danger'>X</a></td>
                                                    </tr>
                                                <?php  }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="1">Total</td>
                                                    <td colspan="2"><input type="hidden" name="total" id="total" class="form-control" readonly="" value="<?php echo intval($billData[0]->total); ?>">
                                                        <input type="hidden" name="discount" id="discount" class="form-control" value="<?php echo intval($billData[0]->final_discount); ?>" readonly="">
                                                        <span id="final_total"><?php echo intval($billData[0]->total); ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">
                                                        <div class="flex-w">Final Discount &nbsp;&nbsp;<input type="hidden" name="final_discount_type" id="final_discount_type" value="Amount" checked="checked">
                                                            ₹ &nbsp; &nbsp;
                                                            <div class="form-group">
                                                                <input type="number" name="f_discount" id="f_discount" value="<?php echo intval($billData[0]->final_discount); ?>" tabindex="1" class="form-control-sm number_only tab_inp">
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td colspan="2">
                                                        <span id="final_discount"><?php echo intval($billData[0]->final_discount); ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Grand Total</th>
                                                    <th colspan="2">
                                                        <span id="grand_total"><?php echo intval($billData[0]->balance); ?></span>
                                                    </th>
                                                </tr>
                                                <input type="hidden" name="paid" id="paid" value="0" class="form-control number_only tab_inp" tabindex="6">
                                                <input type="hidden" name="balance" id="balance" class="form-control" readonly="" value="<?php echo intval($billData[0]->balance); ?>">
                                                <tr>
                                                    <th colspan="1">Payment Mode
                                                        <span class="text-danger">*</span>
                                                    </th>
                                                    <th colspan="2">
                                                        <select name="payment_mode" id="payment_mode" tabindex="7" class="form-control tab_inp">
                                                            <option <?php if ($billData[0]->payment_mode == 'Due') {
                                                                        echo 'selected';
                                                                    } ?> value="Due">Due </option>
                                                            <option <?php if ($billData[0]->payment_mode == 'Cash') {
                                                                        echo 'selected';
                                                                    } ?> value="Cash">Cash</option>
                                                            <option <?php if ($billData[0]->payment_mode == 'PhonePe') {
                                                                        echo 'selected';
                                                                    } ?> value="PhonePe">PhonePe UPI</option>
                                                        </select>
                                                        <div class="radio-wrap">
                                                            <span class="radio-group">
                                                                <input type="radio" id="payment_due" name="payment_mode" value="Due" checked> <label for="payment_due">Due </label>
                                                            </span>
                                                            <span class="radio-group">
                                                                <input type="radio" id="payment_cash" name="payment_mode" value="Cash"> <label for="payment_cash">Cash </label>
                                                            </span>
                                                            <span class="radio-group">
                                                                <input type="radio" id="payment_upi" name="payment_mode" value="PhonePe"> <label for="payment_upi">PhonePe UPI </label>
                                                            </span>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="form-footer test_save">
                                        <input type="hidden" id="bill_id" name="bill_id" value="<?php echo $billData[0]->id; ?>">
                                        <button name="test_save" type="button" tabindex="8" id="test_save" class=" btn custom-btn btn-action tab_inp">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="c-modal modal center fade" id="selectTest">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="page-head">
                    <h2 id="exampleModalLabel">Select Test</h2>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
                    </button>
                </div>
                <form id="test_selected">
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn custom-btn btnupdate" id="bottom" onclick="selectTest()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>