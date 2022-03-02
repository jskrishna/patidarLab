<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Reports</h2>
            <a class="btn custom-btn" href="<?php echo BASE_URL . 'report' ?>">All Report</a>
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
                                <div class="name-sec-center">
                                    <p>
                                        <label for="">Patient ID:</label><span><?php echo $patientData->patientid; ?></span>
                                    </p>
                                    <!-- <p><label for="">Patient Create:</label> <span><?php //echo $patientData->created_at; ?></span></p> -->
                                    <p>
                                        <label for="">Referred By:</label>
                                        <span class="text-capitalize"><?php echo $doctorsData->referral_name; ?></span>
                                    </p>
                                </div>
                                <div class="name-sec-right">
                                    <p>
                                        <img src="<?php echo BASE_URL ?>public/assets/images/feather-clock-active.svg" alt="">
                                        <span><?php echo date_format(new DateTime($billData->billDate), "d-M-Y"); ?></span>
                                    </p>
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
                    <form method="POST" action="<?php echo BASE_URL; ?>Outputpdf/index" target="_blank" id="report">
                        <div class="c-datatable fixed-save">
                            <table class="table report-edit" id="tablelist">
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
                                                        <!-- <div class="col-lg-4"> : <input type="checkbox" name="collapse" id="collapse" value="YES"> Yes </div> -->
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
                                                            <!-- <input type="button" class="btn btn-primary btn-sm select" id="select_all" value="Select All">
                                                            <input type="button" class="btn btn-sm btn-primary deselect" id="deselect_All" value="Deselect All"> -->
                                                        </div>
                                                        <div class="col-lg-7"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="align-top">
                                            <!-- <span class="text-right"><input type="checkbox" name="print_header" id="print_header" value="Yes"> Print Report With Header</span> -->
                                            <br>
                                            <span class="text-right"><input type="checkbox" name="barcode" id="barcode" value="Yes" checked="true"> Print Barcode </span><br>
                                            <span class="text-right"><input type="checkbox" checked="checked" name="qr_code" id="qr_code" value="Yes"> Qr Code </span><br>
                                        </th>
                                    </tr>
                                    <tr class="border-0">
                                        <th colspan="4">
                                            <div class="check-group">
                                                <input type="checkbox" class="" id="print_header" name="print_header" value="Yes" checked>
                                                <label for="print_header">Print Report With Header</label>
                                            </div>
                                            <div class="check-group">
                                                <input type="checkbox" class="" id="collapse" name="collapse" value="Yes">
                                                <label for="collapse">Collapse pdf</label>
                                            </div>
                                    </th>
                                    </tr>
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
                            <?php if($btn){ ?>
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
    var check=[];
			function myFunction(val){
			var val1=val.substring(4,10);
			if($("#"+val).prop("checked") == true){
				check.push(val);

			}
			else if($("#"+val).prop("checked") == false){
				check=$.grep(check, function(a){
				return a !=val;
				})

			}
				var count=check.length;
			if(count>0){
			$('#submit_report').removeAttr('disabled','disabled');
			}
			else{
			$('#submit_report').attr('disabled','disabled');
			}
			if($("#"+val).prop("checked") == true){

				console.log("Checkbox is checked." );
					$('#department'+val1).prop('checked', true);
				}
				else if($("#"+val). prop("checked") == false){

				console.log("Checkbox is unchecked." );
				$('#department'+val1).prop('checked', false);
				}
			}
</script>