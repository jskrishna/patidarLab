<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <!-- <div class="page-head page-head-border">
            <h2>Add Patient</h2>
            <a class="btn custom-btn" href="<?php echo BASE_URL . 'patient' ?>">
                All Patient
            </a>
        </div> -->
        <div class="patient-add-sec">
            <form method="POST" name="patient">
                <div class="row">
                    <div id="new_patient">
                        <div class="form-row">
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="titleAdd">Title<span class="text-danger">*</span></label>
                                    <select name="title" id="titleAdd" class="title_div form-control">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Master">Master</option>
                                        <option value="New Born">New Born</option>
                                        <option value="Baby">Baby</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-9">
                                    <label for="patientNameAdd">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" name="patientName" id="patientNameAdd" value="" class="form-control enterAsTab ui-autocomplete-input required" placeholder="Full Name" autocomplete="off">
                                    <span class="error">This field is required.</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="ageAdd">Age<span class="text-danger">*</span></label>
                                    <input type="number" name="age" id="ageAdd" value="" class="form-control enterAsTab required" autocomplete="off" onkeypress="if(this.value.length==6)return false;">
                                    <span class="error">This field is required.</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="age_typeAdd">Age Type<span class="text-danger">*</span></label>
                                    <input type="hidden" name="age_type" id="age_typeAdd" class="age_type-input" value="Y">
                                    <div class="btn-group btn-block age_type_div">
                                        <button type="button" class="btn btn-primary age-type " id="YAdd">Y</button>
                                        <button type="button" class="btn btn-secondary age-type" id="MAdd">M</button>
                                        <button type="button" class="btn btn-secondary age-type" id="DAdd">D</button>
                                    </div>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="Male">Gender<span class="text-danger">*</span></label>
                                    <input type="hidden" name="gender" id="genderAdd" class="gender gender-input" value="Male">
                                    <div class="btn-group btn-block gender_type_div">
                                        <button type="button" class="btn btn-primary btn-process " data-value="Male" id="MaleAdd">Male</button>
                                        <button type="button" class="btn btn-secondary btn-process" data-value="Female" id="FemaleAdd">Female</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="form-group col-lg-6">
                                            <label for="emailIdAdd">Email</label>
                                            <input type="text" name="emailId" id="emailIdAdd" class="form-control enterAsTab" autocomplete="off" placeholder="Email ID">
                                        </div> -->
                                <div class="form-group col-lg-6">
                                    <label for="mobileNoAdd">Contact Number</label>
                                    <input type="number" name="mobileNo" id="mobileNoAdd" class="form-control number_only enterAsTab ui-autocomplete-input" onkeypress="if(this.value.length==10) return false;" placeholder="Mobile Number" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="pinAdd">Pin Code</label>
                                    <input type="number" name="pin" id="pinAdd" value="457773" rel="Pin" class="form-control enterAsTab number_only" onkeypress="if(this.value.length==6)return false;">
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
                                    <label for="refered_by_nameAdd">Referred Dr<span class="text-danger">*</span></label>
                                    <?php
                                    ?>
                                    <input type="hidden" id="refered_by_nameAdd" value="" name="refered_by_name" class="required ui-autocomplete-input">
                                    <select name="patientRef" id="patientRefAdd" class="form-control">
                                    <option>Select Refered By </option>
                                    </select>
                                    <span class='error'>This field is required.</span>
                                    <?php
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center" id="button">
                                    <button type="button" class="btn btnupdate custom-btn m-auto" id="patient_save" value="Add Patient">Add Patient</button>
                                </div>
                            </div>
                            <div style="display: none;">
                            <input type="reset" value="reset" id="add-from-reset">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>