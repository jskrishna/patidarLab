<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Report</h2>
            <a class="btn custom-btn patientedit_btn"  href="<?php echo BASE_URL; ?>report">Back</a>
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
                                                <?php echo $patientData->age ?>
                                            </span>
                                        </p>
                                        <p>
                                            <img src="<?php echo BASE_URL ?>public/assets/images/feather-user.svg" alt="">
                                            <span>
                                                <?php echo $patientData->gender ?>
                                            </span>
                                        </p>
                                    </div>
                                    <td>Patient ID: <?php echo $patientData->patientid; ?></td>
                                </div>
                            </div>
                            <div class="name-sec-right">
                                <p>
                                    <?php echo $doctorData->referral_name; ?>
                                </p>
                                <p>
                                    <img src="<?php echo BASE_URL ?>public/assets/images/feather-clock.svg" alt="">
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
                                        <div class="card-body " id="card<?php echo $count ?>">
                                            <form id="postValue<?php echo $test->id; ?>" method="POST" enctype="multipart/form-data">
                                                <table class="table table-bordered sort_value" id="tablelist<?php echo $test->id; ?>">
                                                    <thead>
                                                        <tr class="bg-secondary text-white text-center">
                                                            <th width="10px">S.No</th>
                                                            <th>Test Field</th>
                                                            <th width="40%">Test Value</th>
                                                            <th>Unit</th>
                                                            <th width="190px">Range</th>
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
                                                                        <td class="text-center index"><?php echo $c++; ?></td>
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
                                                                                            <textarea name="options" id="inputValue<?php echo $parameter->id; ?>" class="summernote form-control"><?php echo $parameter->options; ?></textarea>
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
                                                                                        <td><input type="hidden" name="inputValue[]" id="inputValue<?php echo $parameter->id; ?>" value="" class="form-control call form form else">
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
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center">
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
                                                                <input type="button" class="btn btn-primary  btn-action submit_report enterkey" data-testid="<?php echo $test->id; ?>" id="saveReport<?php echo $test->id; ?>" name="card<?php echo $test->id; ?>" value="Save">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
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
    <!-- // patient edit model  -->
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
<?php
include_once "./public/assets/includes/footer.php";
?>