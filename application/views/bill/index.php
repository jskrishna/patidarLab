<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
            <script>
            var test = Array();
        </script>
        <div class="billing-sec">
            <div class="row">
                <div class="col-lg-12">
                    <form onsubmit="return false">
                        <?php if (isset($patientData)) { ?>
                            <div class="report-list-head pt-0">
                                <div class="patient-name-sec">
                                    <div class="name-sec-inr">
                                        <div class="name-sec-left">
                                            <div class="name-icon">
                                                <h3>
                                                    <?php $name = explode(' ', $patientData->patientname);
                                                        $name = array_filter($name);
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
                                        <div class="name-sec-center bill-add-d">
                                            <p>
                                                <label for="">Patient ID:</label><span><?php echo $patientData->patientid; ?></span>
                                            </p>
                                            <p><label for="">Bill:</label> <span id="bdate"></span>
                                            <input type="hidden" readonly name="billDate" id="billDate" class="form-control" value="" onkeydown="return false">
                                                <input type="hidden" name="time" id="time" class="form-control" value="">
                                        </p>
                                            <p>
                                                <label for="">Referred By:</label>
                                                <?php foreach ($doctorData as $doctor) {
                                                    if ($doctor->id == $patientData->refered_by) {
                                                ?>
                                                        <span class="text-capitalize">Dr. <?php echo $doctor->referral_name; ?></span>
                                                        <!-- <input type="text" name="patientRef" id="patientRef" class="form-control ui-autocomplete-input" value="<?php echo $doctor->referral_name; ?>" autocomplete="off"> -->
                                                <?php }
                                                } ?>
                                                <input type="hidden" name="patientRefId" id="patientRefId" value="<?php echo $patientData->refered_by; ?>" class="form-control">
                                                <input type="hidden" name="editpatientid" id="editpatientid" value="<?php echo $patientData->id; ?>">
                                            </p>
                                        </div>
                                        <?php if (isset($patientData)) { ?>
                <button class="btn custom-btn patientedit_btn" data-bs-toggle="modal" data-id="<?php echo $patientData->id; ?>" data-bs-target="#patientEdit"> Edit Patient</button>
            <?php } ?>
                                        <!-- <div class="name-sec-right"> -->
                                        <?php if(isset($billData)){  ?>
                                        <input type="hidden" name="billDate" id="billDate" class="form-control" value="<?php echo date_format(new DateTime($billData[0]->billDate), "Y-m-d"); ?>" onkeydown="return false">
                                        <input type="hidden" name="time" id="time" class="form-control" value="<?php echo date_format(new DateTime($billData[0]->billDate), "H:i:s"); ?>">
                                        <?php }else{ ?>
                                                <input type="hidden" readonly name="billDate" id="billDate" class="form-control" value="" onkeydown="return false">
                                                <input type="hidden" name="time" id="time" class="form-control" value="">
                                            <?php } ?>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($patientData)) { ?>
                            <div id="main" class="fixed-save">
                                <input type="hidden" id="nameTest" name="nameTest">
                                <input type="hidden" name="test_amount" id="test_amount" class="form-control prc number_only">
                                <div class="col-lg-2" style="display: none;">
                                    <button type="button" name="add_list" id="add_list" class="btn custom-btn add-billing " value="Add" disabled="disabled">Add</button>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="c-datatable">
                                            <div class="row normal-input">
                                                <div class="form-group col-lg-8">
                                                    <label for="test">Test Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="test" class="form-control tab_inp ui-autocomplete-input" placeholder="Add Test...." id="test" tabindex="0" autocomplete="off">
                                                    <input type="hidden" name="test_id" class="form-control" id="test_id">
                                                    <input type="hidden" name="department_id" class="form-control" id="department_id">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="departments">Department <span class="text-danger">*</span></label>
                                                    <select name="departments" id="departments" class="form-control">
                                                        <option selected>Select Department</option>
                                                        <?php foreach ($departmentData as $department) { ?>
                                                            <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <table class="table bill-edit">
                                                <thead>
                                                    <tr>
                                                        <th>Test Name</th>
                                                        <th width="125px">Price (₹)</th>
                                                        <th width="50px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="testRequest">
                                                    <?php if(isset($billData)){ 
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
                                                            <input type='hidden' name='testAmount[]' id='testAmount' value=<?php echo intval($testData->amount); ?> class='form-control testAmount' readonly>
                                                            <span id="testAmount"><?php echo intval($testData->amount); ?></span>

                                                        </td>
                                                        <input type='hidden' name='discountAmount[]' id='discountAmount' value=<?php echo $discountAmounts[$param]; ?> class='form-control testAmount' readonly>
                                                        <td><a href='Javascript:void(0)' class='remove_this'>
                                                            <img src='<?php echo BASE_URL ?>public/assets/images/cross.svg' alt=''></a></td>
                                                    </tr>
                                                <?php  } } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <?php if(isset($billData)){  ?>
                                        <div class="form-footer test_save">
                                            <input type="hidden" id="bill_id" name="bill_id" value="<?php if(isset($billData)){ echo intval($billData[0]->id); }else{ echo '';} ?>">
                                            <th colspan="4" class="text-center">
                                                <button name="test_save" type="button" tabindex="8" id="test_save" class="btn custom-btn btn-action tab_inp">Save</button>
                                            </th>
                                        </div>
                                        <?php } else { ?>
                                            <div class="form-footer test_save" style="display: none;">
                                            <input type="hidden" id="bill_id" name="bill_id" value="<?php if(isset($billData)){ echo intval($billData[0]->id); }else{ echo '';} ?>">
                                            <th colspan="4" class="text-center">
                                                <button name="test_save" type="button" tabindex="8" id="test_save" class="btn custom-btn btn-action tab_inp">Save</button>
                                            </th>
                                        </div>
                                            <?php } ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="c-datatable">
                                            <ul>
                                                <li>
                                                    <span class="small-heading">Payment</span>
                                                    <div class="radio-wrap">
                                                        <span class="radio-group">
                                                            <input type="radio" id="payment_due" name="payment_mode" value="Due" checked>
                                                            <label for="payment_due">
                                                                <span>
                                                                Due 
                                                                </span>
                                                            </label>
                                                        </span>
                                                        <span class="radio-group">
                                                            <input type="radio" id="payment_cash" name="payment_mode" value="Cash">
                                                            <label for="payment_cash">
                                                                <span>
                                                                Cash 
                                                                </span>
                                                            </label>
                                                        </span>
                                                        <span class="radio-group">
                                                            <input type="radio" id="payment_upi" name="payment_mode" value="PhonePe">
                                                           <label for="payment_upi">
                                                               <span>
                                                           UPI 
                                                           </span>
                                                        </label>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="c-datatable">
                                            <ul class="checkout-wrap">
                                                <li>
                                                    <span>Total</span>
                                                    <div class="grand_total">
                                                        <input type="hidden" name="total" id="total" class="form-control" readonly="" value="<?php if(isset($billData)){ echo intval($billData[0]->total); }else{echo '0';} ?>">
                                                        <input type="hidden" name="discount" id="discount" class="form-control" value="<?php if(isset($billData)){ echo intval($billData[0]->final_discount); }else{ echo '0';} ?>" readonly="">
                                                            ₹
                                                        <span id="final_total"><?php if(isset($billData)){ echo intval($billData[0]->total); }else{ echo '0';} ?></span>
                                                    </div>
                                                </li>
                                                <li class="advance-li">
                                                    <span>Advance</span>
                                                    <div>
                                                      <input type="number" name="advance" id="advance" value="<?php if(isset($billData)){ echo intval($billData[0]->advance); }else{ echo '0';} ?>" tabindex="1" class="form-control-sm number_only tab_inp">
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>Discount</span>
                                                    <div>
                                                        <input type="hidden" name="final_discount_type" id="final_discount_type" value="Amount" checked="checked">
                                                        <input type="hidden" name="final_discount" id="final_discount" value="<?php if(isset($billData)){ echo intval($billData[0]->final_discount); }else{ echo '0';} ?>">
                                                        <input type="number" name="f_discount" id="f_discount" value="<?php if(isset($billData)){ echo intval($billData[0]->final_discount); }else{ echo '0';} ?>" tabindex="1" class="form-control-sm number_only tab_inp">
                                                    </div>
                                                </li>
                                                <li>
                                                    <span class="remain-li-span">Remaining Amount</span>
                                                    <div>
                                                    <input type="hidden" name="paid" id="paid" value="0" class="form-control number_only tab_inp" tabindex="6">
                                                    <input type="hidden" name="balance" id="balance" class="form-control" readonly="" value="<?php if(isset($billData)){ echo intval($billData[0]->balance); }else{ echo '0';} ?>">
                                                        <span class="grand_total">₹</span>
                                                        <span id="grand_total" class="grand_total"><?php if(isset($billData)){ echo intval($billData[0]->balance); }else{ echo '0';} ?></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    </form>
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
                            <button type="button" class="btn custom-btn btnupdate" id="bottom">Submit</button>
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