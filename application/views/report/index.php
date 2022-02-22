<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Reports</h2>
        </div>
        <div class="report-sec">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="c-datatable">
                        <table class="table dt-responsive" role="grid">
                            <thead>
                                <tr role="row" class="tablesorter-headerRow">
                                    <th data-column="2">
                                        <div class="tablesorter-header-inner">Name</div>
                                    </th>
                                    <th data-column="1">
                                        <div class="tablesorter-header-inner">Report Date</div>
                                    </th>
                                    <th data-column="1" class="">
                                        <div class="tablesorter-header-inner">Id</div>
                                    </th>
                                    <th data-column="3">
                                        <div class="tablesorter-header-inner">Amount (₹)</div>
                                    </th>
                                    <th data-column="4">
                                        <div class="tablesorter-header-inner">Referral</div>
                                    </th>
                                    <th data-column="5">
                                        <div class="tablesorter-header-inner">Test Name</div>
                                    </th>
                                    <th data-column="6">
                                        <div class="tablesorter-header-inner">Payment Status</div>
                                    </th>
                                    <th data-column="9">
                                        <div class="tablesorter-header-inner">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($reportData as $report) { ?>
                                    <tr>
                                        <td>
                                            <div class="patient-avator">
                                                <div class="ava-l">
                                                    <div class="patient-short-name">
                                                        <?php foreach ($patientData as $patient) {
                                                            if ($patient->id == $report->patient_id) {
                                                                $name = explode(' ', $patient->patientname);
                                                                foreach ($name as $n) {
                                                                    echo $n[0];
                                                                }
                                                         ?> </div>
                                                </div>
                                                <div class="ava-r">
                                                    <span><?php echo $patient->patientname; ?></span>
                                                    <div>
                                                        <?php echo $patient->gender[0]; ?> / <?php echo $patient->age . ' '. $patient->age_type; } }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="nowwrap-text">
                                            <?php echo date_format(new DateTime($report->billDate), "d-M-Y"); ?>
                                            </span>
                                        </td>
                                        <td><?php echo $patient->patientid; ?></td>
                                        <td>
                                            <b>₹ </b><?php echo  intval($report->balance) - intval($report->advance); ?>
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

                                            foreach ($testIDs as $id) {
                                                $testData = $pxthis->Report_model->getTestByID($id);
                                                $reportValues = $pxthis->Report_model->getreportDataByBIllandTestId($report->id, $id);
                                                if (count($reportValues) > 0) { ?>
                                                    <span class="test-name test-success">
                                                        <label><?php echo $testData[0]->test_name ?></label></span>
                                                <?php } else { ?>
                                                    <span class="test-name text-pending">
                                                        <label><?php echo $testData[0]->test_name ?></label></span>
                                            <?php }
                                                $reportValues = null;
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php if ($report->status == 'Pending') { ?>
                                                <button class="patientedit-btn bill_settle btn-pay" data-status="Pending" data-id="<?php echo $report->id; ?>" value="<?php echo $report->id; ?>" id="status<?php echo $report->id; ?>" data-bs-toggle="modal" data-bs-target="#bill_settlement">
                                                    Pay
                                                </button>

                                            <?php   } else { ?>
                                                <div class="bill_settle" disabled data-status="Paid" data-id="<?php echo $report->id; ?>" value="<?php echo $report->id; ?>" id="status<?php echo $report->id; ?>">
                                                    Paid
                                                </div>

                                            <?php  }; ?>
                                        </td>
                                        <td>
                                            <ul class="action-list">
                                                <li>
                                                    <a href="report/add_value/<?php echo $report->id; ?>" class="btn btn-sml patientedit-btn btnupdate">
                                                        <img src="<?php echo BASE_URL ?>public/assets/images/icon-edit.svg" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <?php foreach ($patientData as $patient) {
                                                        if ($patient->id == $report->patient_id) {
                                                    ?>
                                                            <a href="bill/edit?bill=<?php echo $report->id; ?>" class="btn btn-sml btnupdate btn-report">
                                                                <img src="<?php echo BASE_URL ?>public/assets/images/billing.svg" alt="">
                                                            </a>
                                                    <?php }
                                                    } ?>
                                                </li>
                                                <li>
                                                    <a href="report/orderReport/<?php echo $report->id; ?>" class="btn btn-sml btn-print">
                                                        <img src="<?php echo BASE_URL ?>public/assets/images/icon-report.svg" alt="">
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
        <!-- //payment model  -->
        <div class="modal fade" id="bill_settlement" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>