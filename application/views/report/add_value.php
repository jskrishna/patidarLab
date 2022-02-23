<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Report</h2>
            <a class="btn custom-btn patientedit_btn" href="<?php echo BASE_URL; ?>report">Back</a>
        </div>
        <div class="form-row">
            <div class="form-row col-lg-12">
                <input type="hidden" id="admin_value_verify" name="admin_value_verify" value="">
                <input type="hidden" id="admin_verify_id" name="admin_verify_id" value="1393">
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
                                    <input type="hidden" value="<?php echo $patientData->id; ?>" id="patientID" name="patientID">

                                    <input type="hidden" name="bill_id" id="bill_id" value="<?php echo $billData->id; ?>">
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
                                <p><label for="">Patient Create date:</label> <span><?php echo $patientData->created_at; ?></span></p>
                                <p>
                                    <label for="">Referred by:</label>
                                    <span class="text-capitalize"><?php echo $doctorData->referral_name; ?></span>
                                </p>
                            </div>
                            <div class="name-sec-right">
                                <p>
                                    <img src="<?php echo BASE_URL ?>public/assets/images/feather-clock-active.svg" alt="">
                                    <span><?php echo date_format(new DateTime($billData->billDate), "d-M-Y"); ?></span>
                                </p>
                                <p>
                                    <img src="<?php echo BASE_URL ?>public/assets/images/feather-phone-call.svg" alt="">
                                    <span><?php echo $patientData->mobile ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs">
                    <!-- tabs menu  -->
                    <div>
                    <ul class="nav nav-tab" role="tablist">
                        <?php $testIds = explode(',', $billData->testId);
                        $count = 1;
                        foreach ($testIds as $p) {
                            foreach ($testData as $test) {
                                if ($test->id == $p) { ?>
                                    <li class="tab-menu">
                                        <a class="tab-link <?php if ($count == 1) {
                                                                echo 'active';
                                                            } ?>" href="#test<?php echo $test->id ?>" id="card<?php echo $test->id; ?>" role="tab" data-bs-toggle="tab"><?php echo $test->test_name; ?>
                                            <?php
                                            $thisData = $pxthis->Report_model->getreportDataByBIllandTestId($billData->id, $test->id);
                                            if ($thisData) { ?>
                                                <div class="thumb-img img<?php echo $test->id; ?>">
                                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-thumbs-up-active.svg" alt="Report Completed!" width="32" align="right">
                                                </div>
                                            <?php  } else { ?>
                                                <div class="thumb-img img<?php echo $test->id; ?>">
                                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-thumbs-up.svg" alt="Report Completed!" width="32" align="right">
                                                </div>
                                            <?php  } ?>
                                        </a>
                                    </li>
                        <?php   }
                            }
                            $count++;
                        } ?>
                    </ul>
                    </div>
                    <div class="tab-content">
                        <!-- tabs data  -->
                        <?php $testIds = explode(',', $billData->testId);
                        $count = 1;
                        // test ids condtions
                        foreach ($testIds as $p) {
                            foreach ($testData as $test) {
                                if ($test->id == $p) { ?>
                                    <div id="test<?php echo $test->id ?>" class="tab-pane<?php if ($count == 1) {
                                                                                                echo ' active';
                                                                                            } ?>" role="tabpanel">
                                        <form id="postValue<?php echo $test->id; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="c-datatable">
                                                <table class="table report-edit" id="tablelist<?php echo $test->id; ?>">
                                                    <thead>
                                                        <tr class="">
                                                            <!-- <th>
                                                                <div class="tablesorter-header-inner">S.No</div>
                                                            </th> -->
                                                            <th>
                                                                <div class="tablesorter-header-inner" >Test Field</div>
                                                            </th>
                                                            <th>
                                                                <div class="tablesorter-header-inner">Test Value</div>
                                                            </th>
                                                            <th>
                                                                <div class="tablesorter-header-inner">Unit</div>
                                                            </th>
                                                            <th>
                                                                <div class="tablesorter-header-inner">Range</div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $c = 1;
                                                        foreach ($parameterData as $parameter) {
                                                            if ($test->id == $parameter->test_id) {
                                                                if ($parameter->id == '8') { ?>
                                                                    <tr class="reportcnt" id="">
                                                                        <th colspan="5">DIFFERENTIAL COUNT</th>
                                                                    <?php  } ?>
                                                                    <tr class="reportcnt" id="<?php echo $parameter->id; ?>">
                                                                        <!-- <td class="index"><?php //echo $c++; 
                                                                                                ?></td> -->
                                                                        <?php if ($parameter->id == '1' || $parameter->id == '2' || $parameter->id == '4' || $parameter->id == '13') { ?>
                                                                            <td><input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>"><b><?php echo $parameter->name; ?></b></td>

                                                                        <?php } else { ?>
                                                                            <td><input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>"><?php echo $parameter->name; ?></td>
                                                                            <?php }
                                                                        $thisData = $pxthis->Report_model->getreportDataByBIllandTestId($billData->id, $test->id);
                                                                        if ($thisData) {
                                                                            $inputArray = unserialize($thisData[0]->input_values);
                                                                            $parameterArray = unserialize($thisData[0]->parameter_ids);
                                                                            foreach ($parameterArray as $param => $px) {
                                                                                if ($parameter->id == $px) {
                                                                                    // if if if if  field type codntion start
                                                                                    if ($parameter->field_type == 'textarea') { ?>
                                                                                        <td><input type="hidden" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="<?php echo $inputArray[$param]; ?>" class="form-control call form form else">
                                                                                            <textarea name="options" id="inputValue<?php echo $parameter->id; ?>" class="form-control" oninput="auto_grow(this)"><?php echo $parameter->options; ?></textarea>
                                                                                        </td>
                                                                                    <?php  } else if ($parameter->field_type == 'option') { ?>
                                                                                        <td>
                                                                                            <select class="form-control" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>">
                                                                                                <option value="">Select option</option>
                                                                                                <?php foreach (explode(',', $parameter->options) as $option) { ?>
                                                                                                    <option <?php if ($option == $inputArray[$param]) {
                                                                                                                echo 'selected';
                                                                                                            } ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </td>
                                                                                    <?php } else { ?>
                                                                                        <td><input type="text" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="<?php echo $inputArray[$param]; ?>" class="form-control call form form else">
                                                                                    <?php }
                                                                                    // if if if if  field type codntion end
                                                                                }
                                                                            }
                                                                        } else {
                                                                            // if if if if  field type codntion start
                                                                            if ($parameter->field_type == 'textarea') {   ?>
                                                                                        <td ><input type="hidden" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="" class="form-control call form form else">
                                                                                            <textarea name="options" id="inputValue<?php echo $parameter->id; ?>" class="summernote form-control"><?php echo $parameter->options; ?></textarea>
                                                                                        </td>
                                                                                    <?php  } else if ($parameter->field_type == 'option') { ?>
                                                                                        <td>
                                                                                            <select class="form-control" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>">
                                                                                                <option value="">Select option</option>
                                                                                                <?php foreach (explode(',', $parameter->options) as $option) { ?>
                                                                                                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </td>
                                                                                    <?php } else { ?>
                                                                                        <td><input type="text" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="" class="form-control call form form else">
                                                                                    <?php }
                                                                                // if if if if  field type codntion end
                                                                            } ?>
                                                                                        <td>
                                                                                            <?php foreach ($unitData as $unit) {
                                                                                                if ($unit->id == $parameter->unit) {
                                                                                                    echo $unit->unit;
                                                                                                }
                                                                                            } ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <input type="hidden" id="min_range<?php echo $parameter->id; ?>" name="min_range[]" value="<?php echo $parameter->min_value; ?>">
                                                                                                <input type="hidden" id="max_range<?php echo $parameter->id; ?>" name="max_range[]" value="<?php echo $parameter->max_value; ?>">
                                                                                                <?php if ($parameter->min_value != null) {
                                                                                                    echo $parameter->min_value . ' - ' . $parameter->max_value;
                                                                                                } ?>
                                                                                                <div class="checkbox i-checks pull-right check-group">
                                                                                                    <input type="hidden" value="No" name="highlight[]" id="checkValue<?php echo $parameter->id; ?>">
                                                                                                    <input type="checkbox" class="high" id="highlight<?php echo $parameter->id; ?>" value="Yes"><label for="highlight<?php echo $parameter->id; ?>"></label>

                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                    </tr>
                                                            <?php  }
                                                        }
                                                            ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-footer">
                                                <?php
                                                $thisData = $pxthis->Report_model->getreportDataByBIllandTestId($billData->id, $test->id);
                                                if (($thisData)) { ?>
                                                    <input type="hidden" value="<?php echo $thisData[0]->id; ?>" name="reportid" id="reportid<?php echo $test->id; ?>">
                                                <?php
                                                } else { ?>
                                                    <input type="hidden" value="" name="reportid" id="reportid<?php echo $test->id; ?>">

                                                <?php  }
                                                ?>
                                                <input type="hidden" name="defult_value_status" id="defult_value_status" value="0">
                                                <input type="button" class="btn custom-btn btn-action submit_report enterkey" data-testid="<?php echo $test->id; ?>" id="saveReport<?php echo $test->id; ?>" name="card<?php echo $test->id; ?>" value="Save">
                                            </div>
                                        </form>
                                    </div>
                        <?php }
                            }
                            $count++;
                        }
                        ?>
                        <!-- <table class="table" id="approve">
                            <tbody>
                                <tr>
                                    <td><br><button class="btn btn-primary " id="approveAllTest" name="approveAllTest">Approve All Test</button></td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table> -->
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