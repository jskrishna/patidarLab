<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="patient-sec">
        <div class="report-list-head">
                    <div class="patient-name-sec">
                        <div class="name-sec-inr">
                            <div class="name-sec-left">
                                <div class="name-icon">
                                    <h3>
                                        <?php
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
                                    <h3><?php echo $patientData->title . '. ' . ucwords($patientData->patientname); ?></h3>
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
                                <p><label for="">Registration:</label> <span><?php echo date_format(new DateTime($patientData->created_at), "d-M-Y"); ?></span></p>
                                <p>
                                    <label for="">Referred by:</label>
                                    <span class="text-capitalize"><?php echo $doctorData->title . ' ' . $doctorData->referral_name; ?></span>
                                </p>
                            </div>
                            <a href="<?php echo BASE_URL ?>patient" class="btn custom-btn"> Back</a>
                        </div>
                    </div>
                </div>
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="c-datatable">
                    <table width="100%" class="table patient-single-table" role="grid">
                            <thead>
                                <tr role="row" class="tablesorter-headerRow">
                                     <th style="width:35px">
                                        <div class="tablesorter-header-inner">S.No.</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Billing On</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Total Test</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Total</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($billData as $key => $data){ 
                                      $loggedInId = $_SESSION['loggedInId'];
                                    
                                    $testIds = explode(',', $data->testId);
                                    $wp = false;
                                    $urlAttr = '&b=' . $data->id . '&p=' . $patientData->id . '&ph=Y';
                                    foreach ($testIds as $test) {
                                        $checkData = $thismodel->Patient_model->getreportDataByBIllandTestId($data->id, $test);
                                        if (!empty($checkData)) {
                                            $wp = true;
                                            $testData = $thismodel->Patient_model->getTestByID($test);
                                            $testData = $testData[0];
                                            $urlAttr .= '&t%5B%5D=' . $test . '&d%5B%5D=' . $testData->department;
                                        }
                                    }
            
                                    $keyUrl = (BASE_URL) . 'Pdf?l=' . ($loggedInId) . ($urlAttr);
                                    $key = md5($data->id);
                                    $bid = $data->id;
                                    $checkKey = $thismodel->Patient_model->checkKey($bid);
            
                                    if ($wp) {
                                        if (!empty($checkKey)) {
                                            $thismodel->Patient_model->updateKey($bid, $keyUrl);
                                        } else {
                                            $thismodel->Patient_model->insertKey($bid, $key, $keyUrl);
                                        }
                                        $pdf = '<ul class="action-list"><li>
                                        <a data-toggle="tooltip" data-placement="top" target="_blank" title="Print Report" href="' . (BASE_URL) . 'Pdf?key=' . ($key) . '" class="btn btn-sml btn-print">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                                                <defs>
                                                    <clipPath id="a">
                                                        <path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345" />
                                                    </clipPath>
                                                </defs>
                                                <path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345" />
                                            </svg>
                                        </a>
                                    </li></ul>';
                                    }else{
                                        $pdf = '';
                                    }
                                    ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php 
                                    echo  date_format(new DateTime($data->billDate), "d-M-Y");
                                    echo '<br>';
                                    echo  date_format(new DateTime($data->billDate), "h:i A");
                                        ?>
                                    </td>
                                    <td><?php echo count(explode(',', $data->testId)); ?></td>
                                    <td>₹ <?php echo $data->total; ?></td>
                                    <td><?php print_r($pdf); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>