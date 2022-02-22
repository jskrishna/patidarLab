<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>Patient List</h2>
            <a class="btn custom-btn" href="#" data-bs-target="#patientAdd" data-bs-toggle="modal" data-bs-dismiss="modal">
                Add Patient
            </a>
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
                                                    <?php $name = explode(' ',$data->patientname);
                                    foreach($name as $n){
                                        echo $n[0];
                                    } ?>         </div>
                                                </div>
                                                <div class="ava-r">
                                                    <span><?php echo $data->patientname; ?></span>
                                                    <div>
                                                        <?php echo $data->gender[0]; ?> / <?php echo $data->age. ' '. $data->age_type; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="reg-span date">
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
                                    <div class="form-group col-lg-3">
                                        <label for="title">Title<span class="text-danger">*</span>
                                        </label>
                                        <select name="title" id="title" class="form-control">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="New Born">New Born</option>
                                            <option value="Baby">Baby</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-9">
                                        <input type="hidden" name="patientID" id="patientID" class="form-control" placeholder="Full Name">
                                        <label for="patientName">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" name="patientName" id="patientName" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="age">Age</label>
                                        <input type="text" name="age" onkeypress="if(this.value.length==6)return false;" id="age" class="form-control" placeholder="Age" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <input type="hidden" name="age_type" id="age_type" value="Y">
                                        <label for="Y">Age Type</label>
                                        <div class="btn-group btn-block">
                                            <button type="button" class="btn btn-primary age-type " id="Y">Y</button>
                                            <button type="button" class="btn btn-secondary age-type" id="M">M</button>
                                            <button type="button" class="btn btn-secondary age-type" id="D">D</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="Male">Gender</label>
                                        <input type="hidden" name="gender" id="gender">
                                        <div class="btn-group btn-block">
                                            <button type="button" class="btn btn-primary btn-process " id="Male">Male</button>
                                            <button type="button" class="btn btn-secondary btn-process" id="Female">Female</button>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="mobileNo">Contact Number
                                        </label>
                                        <input type="number" name="mobileNo" id="mobileNo" class="form-control number_only" onkeypress="if(this.value.length==10)return false;" placeholder="Mobile Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="emailId">Email
                                        </label>
                                        <input type="text" name="emailId" id="emailId" class="form-control" placeholder="Email ID" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="pin">Pip Code
                                        </label>
                                        <input type="number" name="pin" id="pin" class="form-control number_only" onkeypress="if(this.value.length==6)return false;" placeholder="Pincode">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="address">Address</label>
                                        <textarea type="text" name="address" id="address" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="row" id="ref_detail">
                                    <div class="form-group col-lg-12">
                                        <label for="patientRef">Referred By</label>
                                        <?php foreach ($referedData as $data) {
                                            if ($data->id == 1) { ?>
                                                <input type="hidden" id="refered_by_name" value="<?php echo $data->id; ?>" name="refered_by_name" class="ui-autocomplete-input">
                                                <input type="text" name="patientRef" placeholder="Search Dr..." id="patientRef" value="<?php echo $data->referral_name; ?>" class="form-control search-input">
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 text-center">
                            <input type="button" class="btn btnupdate custom-btn m-auto" id="gotoBilling" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // add model  -->
        <div class="c-modal modal right fade" id="patientAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="page-head">
                        <h2>Add New Patient</h2>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" name="patient">
                                <div class="form-row main_page">
                                    <div class="form-group">
                                        <div class="row">
                                            <div id="new_patient">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-lg-3">
                                                            <label for="titleAdd">Title</label>
                                                            <select name="title" id="titleAdd" class="form-control">
                                                                <option value="Mr">Mr</option>
                                                                <option value="Mrs">Mrs</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="New Born">New Born</option>
                                                                <option value="Baby">Baby</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-9">
                                                            <label for="patientNameAdd">Full Name</label>
                                                            <input type="text" name="patientName" id="patientNameAdd" class="form-control enterAsTab ui-autocomplete-input" placeholder="Full Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4">
                                                            <label for="ageAdd">Age</label>
                                                            <input type="number" name="age" id="ageAdd" class="form-control enterAsTab" autocomplete="off" onkeypress="if(this.value.length==6)return false;">
                                                        </div>
                                                        <div class="form-group col-lg-8">
                                                            <label for="age_typeAdd">Age Type</label>
                                                            <input type="hidden" name="age_type" id="age_typeAdd" value="Y">
                                                            <div class="btn-group btn-block">
                                                                <button type="button" class="btn btn-primary age-type " id="Y">Y</button>
                                                                <button type="button" class="btn btn-secondary age-type" id="M">M</button>
                                                                <button type="button" class="btn btn-secondary age-type" id="D">D</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-4"><input type="hidden" name="gender" id="genderAdd" value="Male">
                                                            <label for="genderselect">Gender</label>
                                                            <select name="" id="genderselect" class="form-control">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-lg-8">
                                                            <label for="mobileNoAdd">Contact Number</label>
                                                            <input type="number" name="mobileNo" id="mobileNoAdd" class="form-control number_only enterAsTab ui-autocomplete-input" onkeypress="if(this.value.length==10) return false;" placeholder="Mobile Number" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6">
                                                            <label for="emailIdAdd">Email</label>
                                                            <input type="text" name="emailId" id="emailIdAdd" class="form-control enterAsTab" autocomplete="off" placeholder="Email ID">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="pinAdd">Pin Code</label>
                                                            <input type="number" name="pin" id="pinAdd" rel="Pin" class="form-control enterAsTab number_only" onkeypress="if(this.value.length==6)return false;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="addressAdd">Address</label>
                                                            <textarea type="text" name="address" id="addressAdd" class="form-control enterAsTab"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="refered_by_nameAdd">Referred Dr</label>
                                                            <?php foreach ($referedData as $data) {
                                                                if ($data->id == 1) { ?>
                                                                    <input type="hidden" id="refered_by_nameAdd" value="<?php echo $data->id; ?>" name="refered_by_name" class="ui-autocomplete-input">
                                                                    <input type="text" name="patientRef" placeholder="Search Dr..." id="patientRefAdd" value="" class="form-control search-input">
                                                            <?php }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12 text-center" id="button">
                                                            <button type="button" class="btn btnupdate custom-btn m-auto" id="patient_save" value="Add Patient">Add Patient</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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