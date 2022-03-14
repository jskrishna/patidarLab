<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr bg-gray">
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
                                        <?php
                                        if ($loggedData->role == 'staff') {
                                            header('Location:' . BASE_URL . 'report');
                                        }
                                        $editer = 0;
                                        $name = explode(' ', $patientData->patientname);
                                        $name = array_filter($name);
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
                            <div class="name-sec-center bill-add-d">
                                <p>
                                    <label for="">Patient ID:</label><span><?php echo $patientData->patientid; ?></span>
                                </p>
                                <p><label for="">Bill:</label> <span><?php echo date_format(new DateTime($billData->billDate), "d-M-Y"); ?></span></p>
                                <p>
                                    <label for="">Referred by:</label>
                                    <span class="text-capitalize"><?php echo $doctorData->title . ' ' . $doctorData->referral_name; ?></span>
                                </p>
                            </div>
                            <a href="<?php echo BASE_URL ?>report" class="btn custom-btn"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="tabs fixed-save">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <?php $testIds = explode(',', $billData->testId);
                        $count = 1;
                        foreach ($testIds as $p) {
                        ?>
                            <div class="accordion-item">
                                <?php
                                foreach ($testData as $test) {
                                    if ($test->id == $p) { ?>
                                        <h2 class="accordion-header" id="panelsStayOpen-<?php echo $test->id ?>">
                                            <div class="authorise-sec print-option">
                                                <div class="check-group">
                                                    <?php
                                                    $thisData = $pxthis->Report_model->getreportDataByBIllandTestId($billData->id, $test->id);
                                                    if ($thisData && $thisData[0]->status == 'authorised') { ?>
                                                        <input type="checkbox" class="" id="authorise<?php echo $test->id ?>" name="authorise" value="Yes" checked>
                                                        <label data-testname="<?php echo $test->test_name; ?>" data-status="" data-id="<?php echo $test->id ?>" for="authorise<?php echo $test->id ?>"><span>Authorised</span></label>
                                                    <?php } else { ?>
                                                        <input type="checkbox" class="" id="authorise<?php echo $test->id ?>" name="authorise" value="Yes">
                                                        <label data-testname="<?php echo $test->test_name; ?>" data-status="authorised" data-id="<?php echo $test->id ?>" for="authorise<?php echo $test->id ?>"><span>Authorised</span></label>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $test->id ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $test->id ?>">
                                                <span><?php echo $test->test_name; ?>
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
                                                </span>
                                            </button>
                                        </h2>
                                    <?php   }
                                    $count++;
                                    $testIds = explode(',', $billData->testId);
                                    $count = 1;
                                    // test ids condtions
                                    if ($test->id == $p) { ?>
                                        <div id="panelsStayOpen-collapse<?php echo $test->id ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?php echo $test->id ?>">
                                            <div class="accordion-body">
                                                <div id="test<?php echo $test->id ?>" class="tab-pane<?php if ($count == 1) {
                                                                                                            echo ' active';
                                                                                                        } ?>" role="tabpanel">
                                                    <form id="postValue<?php echo $test->id; ?>" method="POST" enctype="multipart/form-data">

                                                        <table class="table report-edit" id="tablelist<?php echo $test->id; ?>">
                                                            <!-- <thead>
                                                                    <tr class="">
                                                                        <th>
                                                                            <div class="tablesorter-header-inner">Test Field</div>
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
                                                                </thead> -->
                                                            <tbody>
                                                                <?php $c = 1;
                                                                foreach ($parameterData as $parameter) {
                                                                    if ($test->id == $parameter->test_id) {
                                                                        if ($parameter->id == '8') { ?>
                                                                            <tr class="reportcnt" id="">
                                                                                <th colspan="5">DIFFERENTIAL COUNT</th>
                                                                            <?php  } ?>
                                                                            <tr class="reportcnt" id="<?php echo $parameter->id; ?>">
                                                                                <?php if ($parameter->field_type !== 'textarea') { ?>
                                                                                    <?php if ($parameter->id == '1' || $parameter->id == '2' || $parameter->id == '4' || $parameter->id == '13') { ?>
                                                                                        <td><input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>"><b><?php echo $parameter->name; ?></b></td>
                                                                                    <?php } else { ?>
                                                                                        <td><input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>"><?php echo $parameter->name; ?></td>
                                                                                    <?php }
                                                                                }

                                                                                if ($parameter->field_type == 'textarea') {
                                                                                    if ($parameter->id == '1' || $parameter->id == '2' || $parameter->id == '4' || $parameter->id == '13') { ?>
                                                                                        <input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>">
                                                                                    <?php } else { ?>
                                                                                        <input type="hidden" id="parameter_id<?php echo $parameter->id; ?>" name="parameter_id[]" value="<?php echo $parameter->id; ?>">
                                                                                        <?php }
                                                                                }
                                                                                $thisData = $pxthis->Report_model->getreportDataByBIllandTestId($billData->id, $test->id);
                                                                                if ($thisData) {
                                                                                    $inputArray = unserialize($thisData[0]->input_values);
                                                                                    $parameterArray = unserialize($thisData[0]->parameter_ids);
                                                                                    $highlights = unserialize($thisData[0]->highlights);
                                                                                    foreach ($parameterArray as $param => $px) {
                                                                                        if ($parameter->id == $px) {
                                                                                            // if if if if  field type codntion start
                                                                                            if ($parameter->field_type == 'textarea') { ?>
                                                                                                <td colspan="4">
                                                                                                    <!-- <input type="hidden" name="inputValue[]" id="inputValue<?php // echo $parameter->id; 
                                                                                                                                                                ?>" value="<?php //echo $inputArray[$param]; 
                                                                                                                                                                            ?>" class="form-control call form form else"> -->
                                                                                                    <?php echo $parameter->name; ?>
                                                                                                    <textarea name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" class=" form-control summernote<?php echo $editer; ?>"><?php echo $inputArray[$param]; ?></textarea>
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
                                                                                                <td><input type="text" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="<?php echo $inputArray[$param]; ?>" class="form-control call form form else"></td>
                                                                                            <?php } ?>
                                                                                            <!-- // if if if if  field type codntion end -->
                                                                                            <?php
                                                                                            if ($parameter->field_type == 'textarea') { ?>

                                                                                            <?php  } else { ?>
                                                                                                <td class="text-t-inherit">
                                                                                                    <?php foreach ($unitData as $unit) {
                                                                                                        if ($unit->id == $parameter->unit) {
                                                                                                            echo $unit->unit;
                                                                                                        }
                                                                                                    } ?>
                                                                                                    <span id="alert<?php echo $parameter->id; ?>" class="alert_id pull-right"></span>
                                                                                                </td>
                                                                                            <?php } ?>

                                                                                            <td style="<?php if ($parameter->field_type == 'textarea') {
                                                                                                            echo 'display:none;';
                                                                                                        } ?>">
                                                                                                <div class="approv-check">
                                                                                                    <?php

                                                                                                    if ($patientData->gender == 'Male' && $parameter->male_min_value != null) {
                                                                                                        $min = $parameter->male_min_value;
                                                                                                        $max = $parameter->male_max_value;
                                                                                                    } else if ($patientData->gender == 'Female' && $parameter->female_min_value != null) {
                                                                                                        $min = $parameter->female_min_value;
                                                                                                        $max = $parameter->female_max_value;
                                                                                                    } else if ($patientData->gender != 'Male' && $patientData->gender != 'Female' && $parameter->child_min_value != null) {
                                                                                                        $min = $parameter->child_min_value;
                                                                                                        $max = $parameter->child_max_value;
                                                                                                    } else {
                                                                                                        $min = $parameter->min_value;
                                                                                                        $max = $parameter->max_value;
                                                                                                    }

                                                                                                    ?>
                                                                                                    <input type="hidden" id="min_range<?php echo $parameter->id; ?>" name="min_range[]" value="<?php echo $min; ?>">
                                                                                                    <input type="hidden" id="max_range<?php echo $parameter->id; ?>" name="max_range[]" value="<?php echo $max; ?>">
                                                                                                    <?php if ($parameter->min_value != null) {
                                                                                                    ?><span><?php echo $parameter->min_value . ' - ' . $parameter->max_value . '<br>'; ?></span> <?php
                                                                                                                                                                                                }
                                                                                                                                                                                                if ($parameter->male_min_value != null) {
                                                                                                                                                                                                    echo 'Male -> ' . $parameter->male_min_value . ' - ' . $parameter->male_max_value . '<br>';
                                                                                                                                                                                                }
                                                                                                                                                                                                if ($parameter->female_min_value != null) {
                                                                                                                                                                                                    echo 'Female -> ' . $parameter->female_min_value . ' - ' . $parameter->female_max_value . '<br>';
                                                                                                                                                                                                }
                                                                                                                                                                                                if ($parameter->child_min_value != null) {
                                                                                                                                                                                                    echo 'Child -> ' . $parameter->child_min_value . ' - ' . $parameter->child_max_value;
                                                                                                                                                                                                }

                                                                                                                                                                                                    ?>
                                                                                                    <div class="checkbox i-checks pull-right check-group">
                                                                                                        <?php
                                                                                                        if (!empty($highlights)) { ?>
                                                                                                            <input type="hidden" value="<?php echo $highlights[$param]; ?>" name="highlight[]" id="checkValue<?php echo $parameter->id; ?>">
                                                                                                            <input type="checkbox" class="high" id="highlight<?php echo $parameter->id; ?>" <?php if ($highlights[$param] == 'Yes') {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } ?> value="Yes"><label for="highlight<?php echo $parameter->id; ?>"></label>

                                                                                                        <?php } else { ?>
                                                                                                            <input type="hidden" value="No" name="highlight[]" id="checkValue<?php echo $parameter->id; ?>">
                                                                                                            <input type="checkbox" class="high" id="highlight<?php echo $parameter->id; ?>" value="Yes"><label for="highlight<?php echo $parameter->id; ?>"></label>

                                                                                                        <?php }
                                                                                                        ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        <?php  }
                                                                                    }
                                                                                } else {
                                                                                    // if if if if  field type codntion start
                                                                                    if ($parameter->field_type == 'textarea') {   ?>
                                                                                        <td colspan="4">
                                                                                            <!-- <input type="hidden" name="inputValue[]" id="inputValue<?php //echo $parameter->id; 
                                                                                                                                                        ?>" value="" class="form-control call form form else"> -->
                                                                                            <?php echo $parameter->name; ?>
                                                                                            <textarea name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" class="form-control summernote<?php echo $editer; ?>"><?php echo $parameter->options; ?></textarea>
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
                                                                                        <td><input type="text" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="<?php echo $parameter->default_value; ?>" class="form-control call form form else"></td>
                                                                                    <?php }
                                                                                    ?>
                                                                                    <!-- // if if if if  field type codntion end -->
                                                                                    <?php
                                                                                    if ($parameter->field_type == 'textarea') { ?>

                                                                                    <?php  } else { ?>
                                                                                        <td class="text-t-inherit">
                                                                                            <?php foreach ($unitData as $unit) {
                                                                                                if ($unit->id == $parameter->unit) {
                                                                                                    echo $unit->unit;
                                                                                                }
                                                                                            } ?>
                                                                                            <span id="alert<?php echo $parameter->id; ?>" class="alert_id pull-right"></span>

                                                                                        </td>
                                                                                    <?php } ?>
                                                                                    <td style="<?php if ($parameter->field_type == 'textarea') {
                                                                                                    echo 'display:none;';
                                                                                                } ?>">

                                                                                        <div class="approv-check">
                                                                                            <?php

                                                                                            if ($patientData->gender == 'Male' && $parameter->male_min_value != null) {
                                                                                                $min = $parameter->male_min_value;
                                                                                                $max = $parameter->male_max_value;
                                                                                            } else if ($patientData->gender == 'Female' && $parameter->female_min_value != null) {
                                                                                                $min = $parameter->female_min_value;
                                                                                                $max = $parameter->female_max_value;
                                                                                            } else if ($patientData->gender != 'Male' && $patientData->gender != 'Female' && $parameter->child_min_value != null) {
                                                                                                $min = $parameter->child_min_value;
                                                                                                $max = $parameter->child_max_value;
                                                                                            } else {
                                                                                                $min = $parameter->min_value;
                                                                                                $max = $parameter->max_value;
                                                                                            }

                                                                                            ?>
                                                                                            <input type="hidden" id="min_range<?php echo $parameter->id; ?>" name="min_range[]" value="<?php echo $min; ?>">
                                                                                            <input type="hidden" id="max_range<?php echo $parameter->id; ?>" name="max_range[]" value="<?php echo $max; ?>">
                                                                                            <?php if ($parameter->min_value != null) {
                                                                                            ?><span><?php echo $parameter->min_value . ' - ' . $parameter->max_value; ?></span> <?php

                                                                                                                                                                            }
                                                                                                                                                                            if ($parameter->male_min_value != null) {
                                                                                                                                                                                echo 'Male -> ' . $parameter->male_min_value . ' - ' . $parameter->male_max_value . '<br>';
                                                                                                                                                                            }
                                                                                                                                                                            if ($parameter->female_min_value != null) {
                                                                                                                                                                                echo 'Female -> ' . $parameter->female_min_value . ' - ' . $parameter->female_max_value . '<br>';
                                                                                                                                                                            }
                                                                                                                                                                            if ($parameter->child_min_value != null) {
                                                                                                                                                                                echo 'Child -> ' . $parameter->child_min_value . ' - ' . $parameter->child_max_value;
                                                                                                                                                                            }
                                                                                                                                                                                ?>
                                                                                            <div class="checkbox i-checks pull-right check-group">
                                                                                                <input type="hidden" value="No" name="highlight[]" id="checkValue<?php echo $parameter->id; ?>">
                                                                                                <input type="checkbox" class="high" id="highlight<?php echo $parameter->id; ?>" value="Yes"><label for="highlight<?php echo $parameter->id; ?>"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                <?php } ?>

                                                                            </tr>
                                                                    <?php
                                                                        if ($parameter->field_type == 'textarea') {
                                                                            $editer++;
                                                                        }
                                                                    }
                                                                }
                                                                    ?>
                                                                    
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                        <td colspan="4">
                                                                            <div class="save-report">
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
                                                                                <input type="button" class="bill_settle review-btn save-parameter submit_report enterkey" data-testid="<?php echo $test->id; ?>" id="saveReport<?php echo $test->id; ?>" data-testname="<?php echo $test->test_name; ?>" name="card<?php echo $test->id; ?>" value="Save">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                            </tfoot>
                                                        </table>

                                                        <div class="form-footer" style='display:none'>
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
                                                            <input type="button" class="btn custom-btn save-parameter submit_report enterkey" data-testid="<?php echo $test->id; ?>" id="saveReport<?php echo $test->id; ?>" data-testname="<?php echo $test->test_name; ?>" name="card<?php echo $test->id; ?>" value="Save">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                }
                                $count++;
                                ?>
                            </div>
                            <hr>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class=" form-footer">
                    <button onclick="history.back();" class="btn custom-btn">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>