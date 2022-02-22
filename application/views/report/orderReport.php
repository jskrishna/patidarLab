<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
    <div class="page-head page-head-border">
            <h2>Reports</h2>
            <a class="btn custom-btn" href="<?php echo BASE_URL .'report'?>">All Report</a>
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
                                        <?php $name = explode(' ',$patientData->patientname);
                                    foreach($name as $n){
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
                                </div>
                            </div>
                            <div class="name-sec-right">
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
            <form method="POST" action="<?php echo BASE_URL; ?>report/outputpdf" target="_blank" id="report">
                <table class="table table-bordered table-striped" id="tablelist">
                    <thead>
                        <tr style="display: none;">
                            <th colspan="3">
                                <div class="form-row">
                                    <div class="col-lg-2">
                                        <i>Font Size </i> <select name="font_size" id="font_size" class="form-control">
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option selected="selected" value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <i>font style</i> <select name="fontstyle" class="form-control">
                                            <option selected="selected" value="times">Times Roman</option>
                                            <option value="courier">Courier</option>
                                            <option value="helvetica">Helvetica</option>
                                            <option value="dejavusans">Dejavusans</option>
                                            <option value="Merlin">Merlin</option>
                                            <option value="comic">Comic</option>
                                            <option value="BLKCHCRY"> Black Chancery</option>
                                            <option value="bookmanoldstyle"> Bookman Old Style</option>
                                            <option value="verdana">Verdana</option>
                                            <option value="serifa">SerifaBT</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <i>Letter Space</i> <select name="cell_padding" class="form-control">
                                            <option selected="selected" value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        Paper Size : <select id="select_paper_size" name="paper_size" class="form-control">
                                            <option value="A4">A4</option>&gt;
                                            <option value="A4-L">A4(Landscape)</option>&gt;
                                            <option value="A5">A5</option>&gt;
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                Border </div>
                                            <div class="col-lg-4">: <input type="checkbox" name="field_border" id="field_border" value="YES"> Yes </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                Collapse </div>
                                            <div class="col-lg-4"> : <input type="checkbox" name="collapse" id="collapse" value="YES"> Yes </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                Checked By </div>
                                            <div class="col-lg-4">: <input checked="checked" type="checkbox" name="checked_by" id="checked_by" value="YES"> Yes</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <select name="letter_pad_custom" id="letter_pad_custom" class="form-control" style="display:none">
                                        <option value="letter_pad1" selected="selected">Letter Pad1</option>
                                        <option value="letter_pad2">Letter Pad2</option>
                                        <option value="letter_pad3">Letter Pad3</option>
                                    </select>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6 mt-4">
                                                <input type="button" class="btn btn-primary btn-sm select" id="select_all" value="Select All">
                                                <input type="button" class="btn btn-sm btn-primary deselect" id="deselect_All" value="Deselect All">
                                            </div>
                                            <div class="col-lg-7"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                            </th>
                            <th class="align-top"><span class="text-right"><input type="checkbox" name="print_header" id="print_header" value="Yes"> Print Report With Header</span>
                                <br>
                                <span class="text-right"><input type="checkbox" name="barcode" id="barcode" value="Yes" checked="true"> Print Barcode </span><br>
                                <span class="text-right"><input type="checkbox" checked="checked" name="qr_code" id="qr_code" value="Yes"> Qr Code </span><br>
                            </th>
                        </tr>
                    </thead>

                    <?php $testIds = explode(',', $billData->testId); ?>
                    <tbody id="testArea" class="ui-sortable">
  <input type="hidden" value="<?php echo $patientData->id; ?>" id="patientID" name="patientID">
                            <input type="hidden" value="<?php echo $billData->id; ?>" id="bill_id" name="bill_id">
                        <?php foreach ($testIds as $test) {

                        $testData = $pxthis->Report_model->getTestByID($test);
                        $testData = $testData[0]; ?>

                        <tr class="reportcnt" id="<?php echo $testData->id; ?>">
                            <td>
                                <input type="checkbox" onclick="myFunction(<?php echo $testData->id; ?>)" value="<?php echo $testData->id; ?>" class="chkbox" id="test<?php echo $testData->id; ?>" name="test_id[]">
                       </td>
                            <td><b><?php
                             $departData = $pxthis->Report_model->getdepartmentByID($testData->department);
                             $departData = $departData[0];
                             echo $departData->department;
                             ?></b></td>
                            <td><b><?php echo $testData->test_name; ?></b>
                        <input type="hidden" value="<?php echo $billData->id; ?>" id="bill_id" name="bill_id">
                        </td>
                            <td>
                                <button type="button" class="btn btnupdate submit_report review-btn" data-id="<?php echo $testData->id; ?>" id="sub<?php echo $testData->id; ?>">Review</button>
                            </td>
                        </tr>
                        <?php  } ?>
                    </tbody>

                    <tfoot id="tfoot">
                        <tr>
                            <td colspan="4">
                                <div class="col-lg-6">
                                    <div class="col-lg-6 mt-4">
                                        <input type="button" class="btn btn-primary btn-sm select" id="select_all" value="Select All">
                                    </div>
                                    <div class="col-lg-6 mt-4">
                                        <input type="button" class="btn btn-sm btn-primary deselect" id="deselect_All" value="Deselect All">
                                    </div>
                                </div>
                                <input type="hidden" name="payment_status1" id="payment_status1" value="<?php echo $billData->status; ?>">
                                <input type="hidden" name="count1" id="count1" value="1">
                                <input type="hidden" name="bill_total" id="bill_total" value="<?php echo intval($billData->balance)- intval($billData->advance); ?>">
                                <input type="hidden" name="total_credit" id="total_credit" value="<?php echo intval($billData->received_amount); ?>">
                            </td>
                        </tr>
                    </tfoot>
                </table>
               
            </form>
                </div>
            </div>
        </div>
            <div class="form-group col-lg-11 text-right">
                    <div class="col-lg-6 mt-4">
                        <input type="submit" class="btn btn-primary" id="submit_report" value="Submit" disabled="disabled">
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
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>