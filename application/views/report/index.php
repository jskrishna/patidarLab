<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="report-sec">
            <div class="c-datatable px-0 py-0">
                <div class="form-row">
                    <div class="col-lg-12">
                        <ul id="report-filter" class="report-filter tabs">
                            <li class="filter-item all-r active" data-value="">All Reports</li>
                            <li class="filter-item pending-r" data-value="pending">Pending</li>
                            <li class="filter-item complete-r" data-value="completed">Completed</li>
                        </ul>
                    </div>
                    <div class="col-lg-12 mat-4">
                        <div class="instruction-label">
                            <ul>
                                <label>Test Status: </label>
                                <li class="registered"> Registered</li>
                                <li class="tested">Tested</li>
                                <li class="final">Final </li>
                                <li class="print">Print</li>
                            </ul>
                        </div>
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
                                        <div class="tablesorter-header-inner">Report On</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Amount</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Referral</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Test Status</div>
                                    </th>
                                    <th>
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
                                <input type="radio" id="3inch" name="invoice_type" value="3">
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
                            <button class="btn custom-btn btnupdate" id="withoutHeader">Without Header</button>
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
    <script>localStorage.setItem('activetab', 1); </script>
