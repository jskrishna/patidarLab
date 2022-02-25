<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Patient List</h2>
            <!-- <a class="btn custom-btn" href="#" data-bs-target="#patientAdd" data-bs-toggle="modal" data-bs-dismiss="modal">
                Add Patient
            </a> -->
        </div>
        <div class="patient-sec">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="c-datatable">
                        <table width="100%" class="table dt-responsive">
                            <thead>
                                <tr role="row" class="tablesorter-headerRow">
                                    <!-- <th data-column="1" class="" style="width:50px;">
                                        <div class="tablesorter-header-inner">No.</div>
                                    </th> -->

                                    <th data-column="2" class="">
                                        <div class="tablesorter-header-inner">Name</div>
                                    </th>
                                    <th data-column="3" class="">
                                        <div class="tablesorter-header-inner"> Registered On</div>
                                    </th>
                                    <th data-column="1" class="">
                                        <div class="tablesorter-header-inner">Id</div>
                                    </th>
                                    <th data-column="3" class="">
                                        <div class="tablesorter-header-inner"> Referred By</div>
                                    </th>
                                    <th data-column="4" class="">
                                        <div class="tablesorter-header-inner">Mobile No.</div>
                                    </th>
                                    <th data-column="5" class="">
                                        <div class="tablesorter-header-inner">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($patientData as $data) { ?>
                                    <tr role="row">
                                        <!-- <td style="width:50px;"><?php //echo $count++ 
                                                                        ?></td> -->

                                        <td>
                                            <div class="patient-avator">
                                                <div class="ava-l">
                                                    <div class="patient-short-name">
                                                        <?php $name = explode(' ', $data->patientname);
                                                        $name = array_filter($name);
                                                        foreach ($name as $n) {
                                                            echo $n[0];
                                                        } ?> </div>
                                                </div>
                                                <div class="ava-r">
                                                    <span><?php echo $data->patientname; ?></span>
                                                    <div>
                                                        <?php echo $data->gender[0]; ?> / <?php echo $data->age . ' ' . $data->age_type; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="reg-span date">
                                            <p style="display: none;"><?php echo date_format(new DateTime($data->created_at), "Ymd"); ?></p>

                                                <span class="nowwrap-text"><?php echo date_format(new DateTime($data->created_at), "d/m/Y"); ?></span>
                                                <?php //echo date_format(new DateTime($data->created_at), "h:i A"); 
                                                ?>
                                            </span>

                                        </td>
                                        <td><?php echo $data->patientid; ?></td>
                                        <?php foreach ($referedData as $doc) {
                                            if ($data->refered_by == $doc->id) {
                                        ?>
                                                <td class=""><?php echo $doc->referral_name; ?></td>
                                        <?php }
                                        } ?>
                                        <td>
                                            <?php echo $data->mobile; ?>
                                        </td>
                                        <td>
                                            <ul class="action-list">
                                                <li>
                                                    <button data-bs-target="#patientEdit" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sml patientedit_btn patientedit-btn" namse="test_edit" data-id="<?php echo $data->id; ?>" value="<?php echo $data->id; ?>">
                                                        <img src="<?php echo BASE_URL ?>public/assets/images/icon-edit.svg" alt="">
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="<?php echo BASE_URL ?>bill?t=<?php echo $data->id; ?>" class="btn btn-sml btn-billing">
                                                        <img src="<?php echo BASE_URL ?>public/assets/images/billing.svg" alt="">
                                                    </a>
                                                </li>
                                            </ul>


                                            <!-- <button data-bs-toggle="modal" data-title="<?php //echo $data->patientname; 
                                                                                            ?>" data-bs-target="#myDeletemodel" data-url="patient/patientDelete?id=<?php //echo $data->id; 
                                                                                                                                                                    ?>" id="patientdelete" class="btn btn-sml btn-delete" value="<?php //echo $data->id; 
                                                                                                                                                                                                                                                                    ?>">
                                                <img src="<?php //echo BASE_URL 
                                                            ?>public/assets/images/trash.svg" alt="">
                                            </button> -->

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="printReport" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Select Report Type</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <span id="reportOption"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myDeletemodel" class="modal" tabindex="-1" data-backdrop="static" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Patient</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-row">
                                <div id="delete_model_msg" class="form-group col-lg-12">Are you sure you want to delete this patient?</div>
                                <div class="form-group col-lg-6 text-center"><a id="confirmdeletepatient" href=""><button class="btn btn-danger">Confirm</button></a></div>
                                <div class="col-lg-6 text-center"><button data-bs-dismiss="model" class="btn btn-primary">Cancel</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="layoutRightSide">

</div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>