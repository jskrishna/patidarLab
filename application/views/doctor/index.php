<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12"><br>
                </div>
            </div>
            <label id="errorTxt" class="text-success"></label>
            <form method="POST" name="patient">
                <div class="form-row main_page">
                    <div class="form-group col-lg-8">
                        <div class="row new">
                            <div class="form-group col-lg-6 font-weight-bold">
                                Registration
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="text-bottom font-weight-bold idArea">Patient No: <lable id="patientIda" class="font-weight-bold">00<?php echo $patientid+1; ?></lable></label>
                                <input type="hidden" name="patientId" id="patientId" readonly="" value="00<?php echo $patientid+1; ?>">
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3"><label class="btn border btn-block npId" style="display: none;"><a id="npId" class="text-primary">New Patient</a></label><label class="btn border btn-block spId"><a class="text-primary" id="spId">Search Patient</a></label></div>
                        </div>
                        <div class="row " id="search_patient" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <div class="form-group col-lg-10"><input type="hidden" name="patient" id="patient">
                                        <input type="text" name="patientSearchId" id="patientSearchId" class="form-control patient ui-autocomplete-input" placeholder="Search Patient" autocomplete="off">
                                    </div>
                                    <div class=" form-group col-lg-2"><input type="button" id="patient_id" class="btn btnupdate" value="Search" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <div id="new_patient">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <select name="patientCome" id="patientCome" class="form-control invisible" style="display: none;">
                                        <option>Direct</option>
                                        <option>Indirect</option>
                                    </select>
                                </div>
                                <input type="hidden" name="manual_id" id="manual_id" placeholder="Manual Patient ID" class="form-control" value="0">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-2">
                                    <select name="title" id="title" class="form-control">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Master">Master</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Selvi">Selvi</option>
                                        <option value="B/O">B/O</option>
                                        <option value="Smt">Smt</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Kumari">Kumari</option>
                                        <option value="Baby or Just Born(B/O)">Baby or Just Born(B/O)</option>
                                        <option value="Baby">Baby</option>

                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="hidden" name="patientID" id="patientID" class="form-control" placeholder="Full Name"><input type="text" name="patientName" id="patientName" class="form-control enterAsTab ui-autocomplete-input" placeholder="Full Name" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-4 "><input type="hidden" name="gender" id="gender" value="Male">
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-primary btn-process " id="Male">Male</button>
                                        <button type="button" class="btn btn-secondary btn-process" id="Female">Female</button>
                                        <button type="button" class="btn btn-secondary btn-process" id="Others">Others</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+91</span>
                                        </div><input type="number" name="mobileNo" id="mobileNo" class="form-control number_only enterAsTab ui-autocomplete-input" onkeypress="if(this.value.length==10) return false;" placeholder="Mobile Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+91</span>
                                        </div><input type="number" name="alternateMobileNo" id="alternateMobileNo" class="form-control number_only enterAsTab ui-autocomplete-input" onkeypress="if(this.value.length==10) return false;" placeholder="Alternate Mobile Number" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Age</span>
                                        </div><input type="text" name="age" id="age" class="form-control enterAsTab" autocomplete="off" onkeypress="if(this.value.length==6)return false;">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 "><input type="hidden" name="age_type" id="age_type" value="Y">
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-primary age-type " id="Y">Y</button>
                                        <button type="button" class="btn btn-secondary age-type" id="M">M</button>
                                        <button type="button" class="btn btn-secondary age-type" id="D">D</button>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">Referred By</span>
                                        </div>
                                        <input type="hidden" name="refered_by" id="refered_by" value="1">
                                        <input type="text" name="refered_by_name" id="refered_by_name" class="form-control txtOnly enterAsTab ui-autocomplete-input" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn" id="btn-referred" type="button"><img src="images/kindpng_1120914.png" width="30"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Email ID</span>
                                        </div><input type="text" name="emailId" id="emailId" class="form-control enterAsTab" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Area
                                            </span>
                                        </div>
                                        <input type="text" name="area" id="area" class="form-control enterAsTab">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">City</span>
                                        </div><input type="text" name="city" id="city" class="form-control enterAsTab">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Pincode</span>
                                        </div><input type="number" name="pin" id="pin" rel="Pin" class="form-control enterAsTab number_only" onkeypress="if(this.value.length==6)return false;">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 text-center" id="button"><input type="button" class="btn btnupdate tn-save btn-block" id="patient_save" value="Register"></div>
                                <input type="reset" style="display: none;" name="reset" id="patientresetbtn">

                            </div>
                            <div class="form-row">
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class="modal fade" id="mycamera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="myModalLabel">Take Picture</h3>
                        <button type="button" class="close" id="closepic" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="my_camera"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button class="btn btn-primary" onclick="javascript:capture_picture();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <a href="#addReferel" data-toggle="modal" data-target="#addReferel" class="btn btn-primary btn-alert fade">Add Referral</a>
        <div class="modal fade" id="addReferel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Add Referral
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </h5>
                                </div>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home" id="referralInfo">Referral Information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="container tab-pane active">
                                    <form id="referral_add">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12"><br><label id="errorTxt" class="text-danger"></label></div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-3"> <input type="hidden" name="rtype" id="rtype" value="REFERRAL">
                                                    <select name="ref_title" class="form-control" id="ref_title">
                                                        <option value="">Select Title</option>
                                                        <option>Mr</option>
                                                        <option>Mrs</option>
                                                        <option>Miss</option>
                                                        <option>Dr</option>
                                                        <option>Prof</option>
                                                        <option>Lab</option>
                                                        <option>Hospital</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-9">
                                                    <input type="text" name="referral_name" id="referral_name" class="form-control" placeholder="Referral Name">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                +91</span>
                                                        </div>
                                                        <input type="number" onkeypress="if(this.value.length==10) return false;" name="mobile_no" maxlength="10" id="mobile_no" class="form-control number_only" placeholder="Mobile Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Email</span>
                                                        </div>
                                                        <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Email ID">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" name="rcity" id="rcity" class="form-control" placeholder="City">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="number" name="rpincode" id="rpincode" maxlength="6" class="form-control number_only" onkeypress="if(this.value.length==6) return false;" placeholder="Pincode">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of Birth" onfocus="(this.type='date')">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <input type="text" name="doa" id="doa" class="form-control" placeholder="Date of Anniversary" onfocus="(this.type='date')">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <input type="text" name="organization" id="organization" class="form-control" placeholder="Organization">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12 text-right">
                                                    <input type="button" id="referral_save" class="btn btnupdate" value="Save">
                                                </div>  
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
</body>
<footer>
    <?php
    include_once "./public/assets/includes/footer.php";
    ?>
</footer>