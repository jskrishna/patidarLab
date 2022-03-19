<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Test List</h2>
            <a class="btn custom-btn" href="#" data-bs-toggle="modal" data-bs-target="#testAdd">
                Add New Test
            </a>
        </div>
        <div class="tests-sec">
            <div class="form-row">
                <div class="col-lg-12">
                <div class="c-datatable">
                    <table class="table dt-responsives" role="grid">
                        <thead>
                            <tr role="row" class="tablesorter-headerRow">
                                <th data-column="0">
                                    <div class="tablesorter-header-inner">S.No</div>
                                </th>
                                <th data-column="1">
                                    <div class="tablesorter-header-inner">Test Name</div>
                                </th>
                                <th data-column="2">
                                    <div class="tablesorter-header-inner">Department</div>
                                </th>
                                <th data-column="3">
                                    <div class="tablesorter-header-inner">Price</div>
                                </th>
                                <th data-column="4">
                                    <div class="tablesorter-header-inner">Status</div>
                                </th>
                                <th data-column="5">
                                    <div class="tablesorter-header-inner">Action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="test_list" aria-live="polite" aria-relevant="all">
                            <?php $count = 1;
                            foreach ($Alltest as $test) { ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $test->test_name; ?></td>
                                    <?php foreach ($Alldepartment as $department) {
                                        if ($department->id == $test->department) {
                                    ?>
                                            <td><?php echo $department->department; ?></td>
                                    <?php }
                                    } ?>
                                    <td>₹<?php echo $test->amount; ?></td>
                                    <td><i class="<?php if ($test->status == 'ENABLED') {
                                                        echo 'text-success';
                                                    } else {
                                                        echo 'text-danger';
                                                    } ?>"><?php echo $test->status; ?> </i></td>
                                    <td>
                                            <button data-id="<?php echo $test->id; ?>" data-bs-target="#edittestmodel" class="btn btn-sml patientedit-btn test_edit" name="test_edit" data-bs-toggle="modal" value="<?php echo $test->id; ?>">
                                                <img src="<?php echo BASE_URL ?>public/assets/images/pencil.svg" alt="">
                                                </button>
                                        </td>
                                </tr>
                            <?php } ?>

                    </table>
                </div>
            </div>
        </div>
        <div id="edittestmodel" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Test</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-lg-12"><span>Department</span><input type="hidden" name="edittestid" id="edittestid" class="form-control">
                                <input type="hidden" name="branch_id" id="branch_id" class="form-control"><select name="EditDepartmentId" id="EditDepartmentId" class="form-control">
                                    <?php foreach ($Alldepartment as $department) { ?>
                                        <option value="<?php echo $department->id ?>"><?php echo $department->department ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12"><span>Test Name</span><input type="text" name="EditTestName" class="form-control" id="EditTestName"><input type="hidden" name="editTestId" class="form-control" id="editTestId"><input type="hidden" name="editGroupId" class="form-control" id="editGroupId"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12"><span>Test Amount </span><input type="number" name="EditTestAmount" class="form-control" id="EditTestAmount"></div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12"><span>Test Status</span><select name="editTestStatus" id="editTestStatus" class="form-control">
                                    <option value="ENABLED">ENABLED</option>
                                    <option value="DISABLED">DISABLED</option>
                                </select></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="testUpdate">Submit</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="testAdd" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-body" style=" border: 3px solid #D5D8DC; ">
                        <div class="row">
                            <div class="col-lg-12">
                                <span>
                                    <h4 class="text-primary font-weight-bold">Add New Test<button type="button" class="close text-danger font-weight-bold" data-bs-dismiss="modal">×</button></h4>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <span>Department</span><select name="departmentID" id="departmentID" class="form-control">
                                    <?php foreach ($Alldepartment as $department) { ?>
                                        <option value="<?php echo $department->id ?>"><?php echo $department->department ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12">
                                <span>Test Name</span>
                                <input type="text" name="testName" id="testName" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12">
                                <span>Test Amount</span>
                                <input type="number" name="testAmount" id="test_amount" class="form-control " pattern="[0-9]+">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12">
                                <span>Test Status</span>
                                <select name="testStatus" id="testStatus" class="form-control">
                                    <option value="ENABLED">ENABLED</option>
                                    <option value="DISABLED">DISABLED</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="saveTest">Submit</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>