<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Reports</h2>
        </div>
        <div class="reports-sec">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="report-list-head">
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
                                    <p><label for="">Bill:</label> <span><?php echo date_format(new DateTime($billData->billDate), "d-M-Y"); ?></span></p>
                                    <p>
                                        <label for="">Referred By:</label>
                                        <span class="text-capitalize"><?php echo $doctorsData->referral_name; ?></span>
                                    </p>
                                </div>
                                <a class="btn custom-btn" href="<?php echo BASE_URL . 'report' ?>">All Reports</a>
                                <!-- <div class="name-sec-right"> -->
                                <!-- <p>
                                        <img src="<?php //echo BASE_URL 
                                                    ?>public/assets/images/feather-clock-active.svg" alt="">
                                        <span><?php //echo date_format(new DateTime($billData->billDate), "d-M-Y"); 
                                                ?></span>
                                    </p>
                                    <?php //if ($patientData->mobile) { 
                                    ?>
                                        <p>
                                            <img src="<?php //echo BASE_URL 
                                                        ?>public/assets/images/feather-phone-call.svg" alt="">
                                            <span><?php //echo $patientData->mobile 
                                                    ?></span>
                                        </p>
                                    <?php  //} 
                                    ?> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="<?php echo BASE_URL; ?>Outputpdf/index" target="_blank" id="report">
                        <div class="c-datatable fixed-save">
                                            <div class="print-option">
                                                <div class="check-group">
                                                    <input type="checkbox" class="" id="print_header" name="print_header" value="Yes" checked>
                                                    <label for="print_header">Print Report With Header</label>
                                                </div>
                                                <div class="check-group">
                                                    <input type="checkbox" class="" id="collapse" name="collapse" value="Yes">
                                                    <label for="collapse">Collapse pdf</label>
                                                </div>
                                            </div>
                            <table class="table report-edit" id="tablelist">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="check-group select">
                                                <input type="checkbox" class="" id="select_all" name="select_all">
                                                <label for="select_all"></label>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="tablesorter-header-inner">Department</div>
                                        </th>
                                        <th>
                                            <div class="tablesorter-header-inner">Test</div>
                                        </th>
                                        <th>
                                            <div class="tablesorter-header-inner">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <?php $testIds = explode(',', $billData->testId);
                                $btn = false;
                                ?>
                                <tbody id="testArea" class="ui-sortable">
                                    <?php foreach ($testIds as $test) {
                                        $checkData = $this->Report_model->getreportDataByBIllandTestId($billData->id, $test);
                                        if (!empty($checkData)) {
                                            $btn = true;
                                            $testData = $pxthis->Report_model->getTestByID($test);
                                            $testData = $testData[0];
                                            $departData = $pxthis->Report_model->getdepartmentByID($testData->department);
                                            $departData = $departData[0];

                                    ?>
                                            <tr class="reportcnt" id="<?php echo $testData->id; ?>">
                                                <td>
                                                    <div class="check-group single-select">
                                                        <input type="checkbox" value="<?php echo $testData->id; ?>" onclick="myFunction('test<?php echo $testData->id; ?>')" class="chkbox" id="test<?php echo $testData->id; ?>" name="test_id[]">
                                                        <label for="test<?php echo $testData->id; ?>"></label>
                                                        <input type="checkbox" class="chkbox" id="department<?php echo $testData->id; ?>" value="<?php echo $departData->id; ?>" name="department[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $departData->department;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $testData->test_name; ?>
                                                    <input type="hidden" value="<?php echo $billData->id; ?>" id="bill_id" name="bill_id">
                                                    <input type="hidden" value="<?php echo $patientData->id; ?>" id="patientID" name="patientID">
                                                </td>
                                                <td>
                                                    <button type="button" class="btnupdate review-btn bill_settle" data-id="<?php echo $testData->id; ?>" id="sub<?php echo $testData->id; ?>">Review</button>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                    <input type="hidden" name="payment_status1" id="payment_status1" value="<?php echo $billData->status; ?>">
                                    <input type="hidden" name="count1" id="count1" value="1">
                                    <input type="hidden" name="bill_total" id="bill_total" value="<?php echo intval($billData->balance) - intval($billData->advance); ?>">
                                    <input type="hidden" name="total_credit" id="total_credit" value="<?php echo intval($billData->received_amount); ?>">
                                </tbody>
                            </table>
                        </div>
                        <div class="form-footer">
                            <?php if ($btn) { ?>
                                <input type="submit" class="btn custom-btn" id="submit_report" value="Submit" disabled="disabled">

                            <?php } ?>
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
<script>
    var check = [];

    function myFunction(val) {
        var val1 = val.substring(4, 10);
        if ($("#" + val).prop("checked") == true) {
            check.push(val);

        } else if ($("#" + val).prop("checked") == false) {
            check = $.grep(check, function(a) {
                return a != val;
            })

        }
        var count = check.length;
        if (count > 0) {
            $('#submit_report').removeAttr('disabled', 'disabled');
        } else {
            $('#submit_report').attr('disabled', 'disabled');
        }
        if ($("#" + val).prop("checked") == true) {

            console.log("Checkbox is checked.");
            $('#department' + val1).prop('checked', true);
        } else if ($("#" + val).prop("checked") == false) {

            console.log("Checkbox is unchecked.");
            $('#department' + val1).prop('checked', false);
        }
    }
</script>