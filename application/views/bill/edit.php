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
            <form onsubmit="return false">
                <div id="main">
                        <div class="row">
                            <div class="col-lg-2 image">
                                <iframe scrolling="no" style="border: 0px;" id="barcode" src="https://niglabs.com/barcodeSample.php?code=<?php echo $_GET['bill']; ?>" border="0" width="300" height="50"></iframe>
                            </div>
                        </div>
                            <div class="row">
                            <div class="form-group col-lg-3">
                               <label for="">
                               Patient Name
                               </label>                               
                                <span id="patient_name" class="font-weight-bold">
                                    <?php echo $patientData->title . '. ' . $patientData->patientname . ' (' . $patientData->gender[0] . ' - ' . $patientData->age . ')'; ?>
                                    <br>
                                    <?php echo "Patient No : " . $patientData->patientid; ?>
                                </span>
                                <input type="hidden" name="editpatientid" id="editpatientid" value="<?php echo $patientData->id; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-lg-3 "><i>Referral Details <span class="text-danger">*</span>
                                    <span class="text-danger" id="checkValue"></span><br></i>
                                <?php foreach ($doctorData as $doctor) {
                                    if ($doctor->id == $patientData->refered_by) {
                                ?>
                                        <input type="text" name="patientRef" id="patientRef" class="form-control ui-autocomplete-input" value="<?php echo $doctor->referral_name; ?>" autocomplete="off">
                                <?php }
                                } ?>
                                <input type="hidden" name="patientRefId" id="patientRefId" value="<?php echo $patientData->refered_by; ?>" class="form-control" >
                                <label id="patient_ref" class="text-danger"></label>
                            </div>
                            <div class="form-group col-lg-3">
                                <i>Bill Date <span class="text-danger">*</span><br></i>
                                <input type="date" name="billDate" id="billDate" class="form-control" value="<?php echo date_format(new DateTime($billData[0]->billDate), "Y-m-d"); ?>" onkeydown="return false">
                                <input type="hidden" name="time" id="time" class="form-control" value="<?php echo date_format(new DateTime($billData[0]->billDate), "H:i:s"); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4"><i>Test Name <span class="text-danger">*</span></i>
                                <input type="text" name="test" class="form-control tab_inp ui-autocomplete-input" id="test" tabindex="0" autocomplete="off">
                                <input type="hidden" name="test_id" class="form-control" id="test_id">

                            </div>
                            <div class="form-group  col-lg-3">
                                <i>Department</i><span class="text-danger">*</span>
                                <select name="departments" id="departments" class="form-control">
                                    <option selected>Select Department</option>
                                    <?php foreach ($departmentData as $department) { ?>
                                        <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                            <div class="col-lg-2">
                                <i>Amount <span class="text-danger">*</span>
                                </i>₹<input type="hidden" id="nameTest" name="nameTest">
                                <input type="number" name="test_amount" id="test_amount" class="form-control prc number_only" readonly="">
                                <input type="hidden" name="test_amount1" id="test_amount1">
                            </div>
                            <div class="col-lg-1">
                                <i>Discount</i> ₹

                                <input type="number" name="discount_amount" id="discount_amount" class="form-control prc number_only">
                            </div>
                            <div class="col-lg-1"><br>
                                <input type="radio" name="discount_type" id="discount_type" value="Percentage"> % &nbsp;
                                <input type="radio" name="discount_type" id="discount_type" value="Amount" checked="checked"> ₹
                            </div>
                            <div class="col-lg-1">
                                <i><br></i>
                                <input type="button" name="add_list" id="add_list" class="btn custom-btn btn-success " value="Add" disabled="disabled">
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
                                   
                                    <?php
                                    $testIds = explode(',',$billData[0]->testId);
                                    $discountAmounts =json_decode($billData[0]->discountAmount);
                                  
                                    foreach($testIds as $param => $test) {

                                       $testData =  $pxthis->Bill_model->getTestByID($test); 
                                       $testData = $testData[0]; ?>
                            <script>test.push(<?php echo $test; ?>);</script>
                                    <tr>
                                        <td><?php echo $testData->test_name; ?></td>

                                       <td><input type='text' name='testId[]' id='testId' value="<?php echo $testData->id; ?>" class='form-control testId' readonly></td>

                                       <td><input type='text' name='testAmount[]' id='testAmount' value=<?php echo intval($testData->amount); ?> class='form-control testAmount' readonly></td>
                                       <td><input type='text' name='discountAmount[]' id='discountAmount' value=<?php echo $discountAmounts[$param]; ?> class='form-control testAmount' readonly></td>
                                       <td><a href='#' class='remove_this btn btn-danger'>X</a></td>
                                    </tr>

                                  <?php  }                                
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="1">Total</th>
                                            <th class="text-right">₹</th>
                                            <th><input type="text" name="total" id="total" class="form-control" readonly="" value="<?php echo intval($billData[0]->total); ?>"></th>
                                            <th><input type="text" name="discount" id="discount" class="form-control" value="<?php echo intval($billData[0]->discount); ?>" readonly="">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Final Total</th>
                                            <th class="text-right">₹</th>
                                            <th colspan="2"><input type="text" name="final_total" id="final_total" class="form-control" value="<?php echo intval($billData[0]->grandTotal); ?>" readonly=""></th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Final Discount &nbsp;&nbsp;<input type="radio" name="final_discount_type" id="final_discount_type" value="Percentage"> % &nbsp;
                                            <input type="radio" name="final_discount_type" id="final_discount_type" value="Amount" checked="checked"> ₹ &nbsp;&nbsp; 
                                            <input type="number" name="f_discount" id="f_discount" value="<?php echo intval($billData[0]->final_discount); ?>" tabindex="1" class="form-control-sm number_only tab_inp"></th>
                                            <th class="text-right">₹</th>
                                            <th colspan="2"><input type="text" name="final_discount" value="<?php echo intval($billData[0]->final_discount); ?>" id="final_discount" class="form-control" readonly=""></th>
                                        </tr>
                                        <input type="hidden" name="reason_otp" id="reason_otp" value="verified">

                                        <tr id="doctor_info">
                                            <th colspan="1">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                <input type="hidden" name="testInfo[]" id="testInfo" value="X Ray"><i>X Ray (₹)</i><input type="text" name="doctorInfo[]" id="doctorInfo" class="form-control tab_inp" tabindex="2" value="0">
                                                            </th>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </th>

                                            <input type="hidden" name="reward1" id="reward1" class="form-control" value="">
                                            <input type="hidden" name="reward" id="reward" class="form-control" value="" readonly="readonly">
                                        </tr>
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
                                            <th colspan="2"><input type="text" name="grand_total" id="grand_total" class="form-control" value="<?php echo intval($billData[0]->balance); ?>" readonly="">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Advance Amount</th>
                                            <th class="text-right">₹</th>
                                            <th colspan="2"><input type="number" name="advance" id="advance" value="<?php echo intval($billData[0]->advance); ?>" class="form-control number_only tab_inp" tabindex="6">
                                                <input type="hidden" name="like" id="like" value="">
                                            </th>
                                        </tr>

                                        <input type="hidden" name="paid" id="paid" value="0" class="form-control number_only tab_inp" tabindex="6">
                                        <tr>
                                            <th colspan="1">Balance Amount </th>
                                            <th class="text-right">₹</th>
                                            <th colspan="2">
                                                <input type="text" name="balance" id="balance" class="form-control" readonly="" value="<?php echo intval($billData[0]->balance)-intval($billData[0]->advance); ?>">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Payment Mode
                                                <span class="text-danger">*</span>
                                            </th>
                                            <th class="text-right"></th>
                                            <th colspan="2">
                                                <select name="payment_mode" id="payment_mode" tabindex="7" class="form-control tab_inp">
                                                    <option <?php if($billData[0]->payment_mode == 'Due'){ echo 'selected'; }?> value="Due">Due </option>
                                                    <option <?php if($billData[0]->payment_mode == 'Credit'){ echo 'selected'; }?> value="Credit">Credit </option>
                                                    <option <?php if($billData[0]->payment_mode == 'Cash'){ echo 'selected'; }?> value="Cash">Cash</option>
                                                    <option <?php if($billData[0]->payment_mode == 'Card'){ echo 'selected'; }?> value="Card">Card</option>
                                                    <option <?php if($billData[0]->payment_mode == 'Net Banking'){ echo 'selected'; }?> value="Net Banking">Net Banking</option>
                                                    <option <?php if($billData[0]->payment_mode == 'Google Pay'){ echo 'selected'; }?> value="Google Pay">Google Pay</option>
                                                    <option <?php if($billData[0]->payment_mode == 'PhonePe'){ echo 'selected'; }?> value="PhonePe">PhonePe</option>
                                                    <option <?php if($billData[0]->payment_mode == 'PAYTM'){ echo 'selected'; }?> value="PAYTM">PAYTM</option>
                                                    <option <?php if($billData[0]->payment_mode == 'Amazon Pay'){ echo 'selected'; }?> value="Amazon Pay">Amazon Pay</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <input type="hidden" id="bill_id" name="bill_id" value="<?php echo $billData[0]->id; ?>">
                                            <th colspan="4" class="text-center">
                                                <button name="test_save" type="button" tabindex="8" id="test_save" class=" btn btn-success text-white font-weight-bolder tab_inp" style="display: none;">Save</button>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>
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
                                <button type="button" class="btn custom-btn btnupdate" id="bottom" onclick="selectTest()">Submit</button>
                                <button type="button" class="btn custom-btn btn-danger" data-bs-dismiss="modal">Close</button>
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