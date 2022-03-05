<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="report-sec">
            <div class="c-datatable px-0 py-0">
                <div class="form-row">
                    <div class="col-lg-12">
                        <ul class="report-filter tabs">
                            <li class="filter-item all-r active" data-value="">All Reports</li>
                            <li class="filter-item pending-r" data-value="pending">Pending</li>
                            <li class="filter-item complete-r" data-value="completed">Completed</li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <table class="table dt-responsive" role="grid">
                            <thead>
                                <tr role="row" class="tablesorter-headerRow">
                                     <th>
                                        <div class="tablesorter-header-inner">No.</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Name</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Report Date</div>
                                    </th>
                                    <th class="" style="display:none">
                                        <div class="tablesorter-header-inner">Id</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Amount</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Referral</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Test</div>
                                    </th>
                                    <th style="display: none;">
                                        <div class="tablesorter-header-inner">Report Status</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Payment Status</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Print Invoice</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Actions</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($reportData as $report) { ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td>
                                            <div class="patient-avator">
                                                <?php foreach ($patientData as $patient) {
                                                    if ($patient->id == $report->patient_id) {
                                                        $name = explode(' ', $patient->patientname);
                                                        $name = array_filter($name);
                                                        foreach ($name as $n) {
                                                            // echo $n[0];
                                                        }
                                                ?>
                                                        <div class="ava-r">
                                                            <span><?php echo $patient->patientname; ?></span>
                                                            <div>
                                                                <?php echo $patient->gender[0]; ?> / <?php echo $patient->age . ' ' . $patient->age_type;
                                                                                                    }
                                                                                                } ?>
                                                            </div>
                                                        </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="nowwrap-text">
                                                <p style="display: none;"><?php echo date_format(new DateTime($report->billDate), "Ymd"); ?></p>
                                                <?php echo date_format(new DateTime($report->billDate), "d-M-Y"); ?>
                                            </span>
                                        </td>
                                        <td style="display:none"><?php echo $patient->patientid; ?></td>
                                        <td>
                                            ₹ <?php echo  intval($report->balance) - intval($report->advance); ?>
                                        </td>
                                        <?php foreach ($doctorsData as $doc) {
                                            if ($doc->id == $report->patientRef) {
                                        ?>
                                                <td class=""><?php echo $doc->referral_name; ?></td>
                                        <?php }
                                        } ?>
                                        <td>
                                            <?php
                                            $testIDs = explode(',', $report->testId);
                                            $done = '';
                                            $pending = '';
                                            $dCount = $pCount = 0;
                                            foreach ($testIDs as $id) {
                                                $testData = $pxthis->Report_model->getTestByID($id);
                                                $reportValues = $pxthis->Report_model->getreportDataByBIllandTestId($report->id, $id);
                                                if (count($reportValues) > 0) {
                                                    $done .= '<label>' . $testData[0]->test_name . '</label>';
                                                    $dCount += 1;
                                                } else {
                                                    $pending .=  '<label>' . $testData[0]->test_name . '</label>';
                                                    $pCount += 1;
                                                }
                                                $reportValues = null;
                                            }
                                            ?>
                                            
                                            <span class="test-process test-success">
                                                <?php echo $done ?>
                                                
                                            </span>
                                            <span class="test-process test-pending">
                                                <?php echo $pending ?>
                                                
                                            </span>

                                            <div class="test-counts" style="display: none;">
                                                <?php if ($pending) { ?>
                                                    <button data-container="body" class="bill_settle btn-pay" data-toggle="tooltip" data-bs-html="true" data-placement="top" title="<?php echo $pending ?>">Pending <?php echo $pCount ?></button>
                                                <?php }
                                                if ($done) { ?>
                                                    <button data-container="body" class="bill_settle btn-paid" href="javascript:void(0)" data-bs-html="true" data-toggle="tooltip" data-placement="top" title="<?php echo $done ?>">Done <?php echo $dCount ?></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td style="display: none;">
                                            <?php
                                            $testIDs = explode(',', $report->testId);
                                            $reportcount = $pxthis->Report_model->getReportByBillAndPatientId($report->id, $report->patient_id);
                                            if (count($testIDs) == count($reportcount)) {
                                                echo 'completed';
                                            } else {
                                                echo 'pending';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($report->status == 'Pending') { ?>
                                                <button data-toggle="tooltip" data-placement="top" title="Pay Bill" class="patientedit-btn bill_settle btn-pay" data-status="Pending" data-id="<?php echo $report->id; ?>" value="<?php echo $report->id; ?>" id="status<?php echo $report->id; ?>" data-bs-toggle="modal" data-bs-target="#bill_settlement">
                                                    Pay
                                                </button>
                                            <?php   } else { ?>
                                                <span class="bill_paid bill_settle btn-paid" data-status="Paid" data-id="<?php echo $report->id; ?>" value="<?php echo $report->id; ?>" id="status<?php echo $report->id; ?>">
                                                    Paid
                                                </span>
                                            <?php  }; ?>
                                        </td>
                                        <td>
                                            <a data-toggle="tooltip" data-placement="top" title="Print Invoice" target="_blank" href="printinvoice/index/<?php echo $report->id; ?>" class="btn btn-sml btnupdate print-invoice-btn" data-id="<?php echo $report->id; ?>" data-bs-toggle="modal" data-bs-target="#printReport">
                                                
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M14.5,18h-9a2,2,0,0,1-2-2H2.637A2.655,2.655,0,0,1,0,13.333V6.667A2.655,2.655,0,0,1,2.637,4H4V2A1.924,1.924,0,0,1,5.833,0h8.334A1.924,1.924,0,0,1,16,2V4h1.363A2.655,2.655,0,0,1,20,6.667v6.665A2.655,2.655,0,0,1,17.363,16H16.5A2,2,0,0,1,14.5,18Zm-9-6v4h9l0-4ZM6.014,2,6.007,4H14V2Z" transform="translate(2 3)" fill="#223345"/></clipPath></defs><path d="M14.5,18h-9a2,2,0,0,1-2-2H2.637A2.655,2.655,0,0,1,0,13.333V6.667A2.655,2.655,0,0,1,2.637,4H4V2A1.924,1.924,0,0,1,5.833,0h8.334A1.924,1.924,0,0,1,16,2V4h1.363A2.655,2.655,0,0,1,20,6.667v6.665A2.655,2.655,0,0,1,17.363,16H16.5A2,2,0,0,1,14.5,18Zm-9-6v4h9l0-4ZM6.014,2,6.007,4H14V2Z" transform="translate(2 3)" fill="#223345"/></svg>
                                            </a>
                                        </td>
                                        <td>
                                            <ul class="action-list">
                                                <li>
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit Report" href="report/add_value/<?php echo $report->id; ?>" class="btn btn-sml patientedit-btn btnupdate">
                                                        

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M1,16a1,1,0,0,1-1-1.091l.379-4.17A1.972,1.972,0,0,1,.952,9.524l5.579-5.58L5.293,2.705A1,1,0,1,1,6.707,1.292L7.945,2.53l2-2A1.818,1.818,0,0,1,11.243,0a2,2,0,0,1,1.42.6L15.4,3.335a2,2,0,0,1,.6,1.42A1.814,1.814,0,0,1,15.47,6.05l-2,2,1.238,1.239a1,1,0,1,1-1.414,1.414L12.054,9.466l-5.58,5.579a1.969,1.969,0,0,1-1.212.571l-4.171.379C1.063,16,1.034,16,1,16ZM7.945,5.358h0l-5.579,5.58,5.485-.088,2.79-2.8-2.7-2.7Z" transform="translate(4 4.002)" fill="#223345"/></clipPath></defs><path d="M1,16a1,1,0,0,1-1-1.091l.379-4.17A1.972,1.972,0,0,1,.952,9.524l5.579-5.58L5.293,2.705A1,1,0,1,1,6.707,1.292L7.945,2.53l2-2A1.818,1.818,0,0,1,11.243,0a2,2,0,0,1,1.42.6L15.4,3.335a2,2,0,0,1,.6,1.42A1.814,1.814,0,0,1,15.47,6.05l-2,2,1.238,1.239a1,1,0,1,1-1.414,1.414L12.054,9.466l-5.58,5.579a1.969,1.969,0,0,1-1.212.571l-4.171.379C1.063,16,1.034,16,1,16ZM7.945,5.358h0l-5.579,5.58,5.485-.088,2.79-2.8-2.7-2.7Z" transform="translate(4 4.002)" fill="#223345"/></svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <?php foreach ($patientData as $patient) {
                                                        if ($patient->id == $report->patient_id) {
                                                    ?>
                                                            <a data-toggle="tooltip" data-placement="top" title="View Test" href="bill?bill=<?php echo $report->id; ?>" class="btn btn-sml btnupdate btn-report">
                                                                

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M10.025,14C4.163,14,.756,8.585.132,7.5a1.009,1.009,0,0,1,0-1C.987,5.015,4.205.146,9.729,0c.1,0,.2,0,.294,0,5.813,0,9.221,5.418,9.846,6.5a1.014,1.014,0,0,1,0,1c-.855,1.489-4.073,6.358-9.6,6.5ZM10,3.5A3.5,3.5,0,1,0,13.5,7,3.5,3.5,0,0,0,10,3.5Zm0,5A1.5,1.5,0,1,1,11.5,7,1.5,1.5,0,0,1,10,8.5Z" transform="translate(2 4.998)" fill="#223345"/></clipPath></defs><path d="M10.025,14C4.163,14,.756,8.585.132,7.5a1.009,1.009,0,0,1,0-1C.987,5.015,4.205.146,9.729,0c.1,0,.2,0,.294,0,5.813,0,9.221,5.418,9.846,6.5a1.014,1.014,0,0,1,0,1c-.855,1.489-4.073,6.358-9.6,6.5ZM10,3.5A3.5,3.5,0,1,0,13.5,7,3.5,3.5,0,0,0,10,3.5Zm0,5A1.5,1.5,0,1,1,11.5,7,1.5,1.5,0,0,1,10,8.5Z" transform="translate(2 4.998)" fill="#223345"/></svg>
                                                            </a>
                                                    <?php }
                                                    } ?>
                                                </li>
                                                <li>
                                                    <a data-toggle="tooltip" data-placement="top" title="Print Report" href="report/orderReport/<?php echo $report->id; ?>" class="btn btn-sml btn-print">
                                                        

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345"/></clipPath></defs><path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345"/></svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //payment model  -->
    <div class="c-modal modal center fade" id="bill_settlement" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="c-modal modal center fade" id="bill_paid" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="c-modal modal center fade" id="printReport" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="page-head">
                    <h2>Select Report Type</h2>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label>Select Invoice Format</label>
                    <div class="radio-wrap">
                        <span class="radio-group">
                            <input type="radio" id="a4" name="invoice_type" value="A4" checked>
                            <label for="a4">
                                <span>
                                A4 PDF
                                </span>
                            </label>
                        </span>
                        <span class="radio-group">
                            <input type="radio" id="3inch" name="invoice_type" value="3" >
                            <label for="3inch">
                                <span>
                                3 Inch
                                </span>
                            </label>
                        </span>
                        <input type="hidden" value="" id="printinvoiceid">
                    </div>
                    </div>
                    <div class="form-group"> 
                    <label>Print Invoice With</label>
                   <div class="d-flex">
                   <button class="btn custom-btn btnupdate" id="withHeader">Header</button>
                    <button class="btn custom-btn btnupdate mx-2" id="withoutHeader">Without Header</button>
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