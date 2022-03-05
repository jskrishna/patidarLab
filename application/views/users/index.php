<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr profile-page">
        <div class="report-sec">
            <div class="c-datatable px-0 py-0">
                <div class="form-row">
                    <div class="col-lg-12">
                        <ul class="report-filter tabs">
                            <li class="filter-item all-r active" id="1" data-tab="tab-1">Profile</li>
                            <li class="filter-item pending-r" id="2" data-tab="tab-2">Doctors</li>
                            <li class="filter-item complete-r" id="3" data-tab="tab-3">Lab Management</li>
                            <li class="filter-item complete-r" id="4" data-tab="tab-4">Role Management</li>
                        </ul>

                    </div>
                    <div class="profile-info">
                        <div id="tab-1" class="tab-content active">
                            <div class="docter-sec">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="page-head page-head-border">
                                            <h2>Profile</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <form method="POST" id="profile-form" name="profile" enctype="multipart/form-data">
                                            <div class="row">
                                                <div id="profile">
                                                    <div class="errorTxt text-danger text-center mb-3"></div>
                                                    <div class="form-row">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="username">Full Name<span class="text-danger">*</span></label>
                                                                <input type="text" name="username" id="username" value="<?php echo $UserData->username; ?>" class="form-control enterAsTab required" placeholder="Enter Full Name" autocomplete="off">
                                                                <span class="error">This field is required.</span>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="username">User Name<span class="text-danger">*</span></label>
                                                                <input type="text" name="usname" id="usname" value="<?php echo $UserData->username; ?>" class="form-control enterAsTab required" autocomplete="off">
                                                                <span class="error">This field is required.</span>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row">
                                                            <div class="form-group file-type col-lg-6">
                                                                <label for="user_logo">User Profile Logo</label>
                                                                <input type="file" name="user_logo" id="user_logo" class="form-control enterAsTab" placeholder="Enter user_logo" autocomplete="off">
                                                                <input type="hidden" name="oldprofile" id="oldprofile" value="<?php //echo $UserData->logo; 
                                                                                                                                ?>">
                                                            </div>
                                                            <div class="form-group file-type-img col-lg-6">
                                                                <label for="user_logo"></label>
                                                                <?php //if ($UserData->logo) { 
                                                                ?>
                                                                    <img src="<?php //echo BASE_URL . 'public/assets/images/' . $UserData->logo; 
                                                                                ?>" alt="">
                                                                <?php //} 
                                                                ?>
                                                            </div>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="email">Email</label>
                                                                <input type="text" name="email" id="email" value="<?php echo $UserData->email; ?>" class="form-control enterAsTab" placeholder="Enter Email" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="mobile">Mobile</label>
                                                                <input type="number" name="mobile" id="mobile" value="<?php echo $UserData->mobile; ?>" class="form-control enterAsTab" placeholder="Enter mobile number" autocomplete="off">

                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-12" id="button">
                                                                <button type="button" class="btn btnupdate custom-btn" data-id="<?php echo $UserData->id; ?>" id="update_profile" value="update_profile">Update Profile</button>
                                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $UserData->id; ?>">
                                                            </div>
                                                        </div>
                                                        <div style="display: none;">
                                                            <input type="reset" value="reset" id="update-profile-form-reset">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="page-head page-head-border">
                                            <h2>Password</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <form method="POST" id="password-form" name="profile" enctype="multipart/form-data">
                                            <div class="row">
                                                <div id="password">
                                                    <div class="errorTxt text-danger text-center mb-3"></div>
                                                    <div class="form-row">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="currentpass">Current Password</label>
                                                                <input type="password" name="currentpass" id="currentpass" value="" class="form-control enterAsTab required" placeholder="Enter Current Password" autocomplete="off">
                                                                <span class="error">This field is required.</span>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="newpass">New Password</label>
                                                                <input type="password" name="newpass" id="newpass" value="" class="form-control enterAsTab required" placeholder="Enter New Password" autocomplete="off">
                                                                <span class="error">This field is required.</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-12" id="button">
                                                                <button type="button" class="btn btnupdate custom-btn" data-id="<?php echo $UserData->id; ?>" id="update_password" value="update_password">Update Password</button>
                                                                <input type="hidden" name="passuser_id" id="passuser_id" value="<?php echo $UserData->id; ?>">
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
                        <div id="tab-2" class="tab-content">
                            <div class="docter-sec">
                                <div class="page-head page-head-border">
                                    <h2>Doctors</h2>
                                    <button class="btn custom-btn patientedit_btn doc-model-btn" data-bs-toggle="modal" data-id="" data-title="Add Doctor" data-bs-target="#adddoctor">Add Doctor</button>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12">
                                        <table width="100%" class="table dt-responsives">
                                            <thead>
                                                <tr role="row" class="tablesorter-headerRow">
                                                    <th data-column="1" class="">
                                                        <div class="tablesorter-header-inner">Name</div>
                                                    </th>
                                                    <th data-column="2" class="">
                                                        <div class="tablesorter-header-inner"> Commission</div>
                                                    </th>
                                                    <th data-column="3" class="">
                                                        <div class="tablesorter-header-inner">Designation</div>
                                                    </th>
                                                    <th data-column="4" class="">
                                                        <div class="tablesorter-header-inner">Address</div>
                                                    </th>
                                                    <th data-column="5" class="">
                                                        <div class="tablesorter-header-inner">Mobile No.</div>
                                                    </th>
                                                    <th data-column="6" class="">
                                                        <div class="tablesorter-header-inner">Action</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($referralData as $ref) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-avator">
                                                                <div class="ava-l">
                                                                    <div class="patient-short-name">
                                                                        <?php $name = explode(' ', $ref->referral_name);
                                                                        $name = array_filter($name);
                                                                        foreach ($name as $n) {
                                                                            echo $n[0];
                                                                        } ?> </div>
                                                                </div>
                                                                <div class="ava-r">
                                                                    <span><?php echo $ref->title . ' ' . $ref->referral_name; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $ref->commission; ?>%</td>
                                                        <td><?php echo $ref->designation;  ?></td>
                                                        <td><?php echo $ref->address;  ?></td>
                                                        <td><?php echo $ref->mobile_no;  ?></td>
                                                        <td> <button data-toggle="tooltip" data-placement="top" title="" data-bs-target="#adddoctor" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sml patientedit-btn doc-model-btn" namse="doctoredit" data-id="<?php echo $ref->id;  ?>" value="<?php echo $ref->id;  ?>" data-title="Edit Doctor" data-bs-original-title="Edit Doctor">
                                                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M1,15.978a1,1,0,0,1-1-1.09l.379-4.17A1.975,1.975,0,0,1,.953,9.5l9-9A1.8,1.8,0,0,1,11.238,0a2.028,2.028,0,0,1,1.427.577L15.4,3.315a1.927,1.927,0,0,1,.069,2.715l-9,9a1.971,1.971,0,0,1-1.214.568l-4.17.38C1.064,15.977,1.034,15.978,1,15.978ZM11.272,2.012h0L9.324,3.962l2.695,2.695,1.948-1.949L11.272,2.012Z" transform="translate(4 4.022)" fill="#223345"></path></clipPath></defs><path d="M1,15.978a1,1,0,0,1-1-1.09l.379-4.17A1.975,1.975,0,0,1,.953,9.5l9-9A1.8,1.8,0,0,1,11.238,0a2.028,2.028,0,0,1,1.427.577L15.4,3.315a1.927,1.927,0,0,1,.069,2.715l-9,9a1.971,1.971,0,0,1-1.214.568l-4.17.38C1.064,15.977,1.034,15.978,1,15.978ZM11.272,2.012h0L9.324,3.962l2.695,2.695,1.948-1.949L11.272,2.012Z" transform="translate(4 4.022)" fill="#223345"></path></svg>
                                                            </button></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-content">
                            <div class="docter-sec">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="page-head page-head-border">
                                            <h2>Layout Setting</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <form method="POST" id="update_layout-form" name="profile" action="<?php echo BASE_URL; ?>Users/updateLayout" enctype="multipart/form-data">
                                            <div class="row">
                                                <div id="layout">
                                                    <div class="errorTxt text-danger text-center mb-3"></div>
                                                    <div class="form-row">
                                                        <div class="row">
                                                            <div class="form-group file-type col-lg-12 mb-0">
                                                                <label for="lab_logo">Lab Logo</label>
                                                               <label for="lab_logo" class="file-type-input">
                                                                   <img src="<?php echo BASE_URL  ?>public/assets/images/upload.svg" alt="">
                                                                   <span>Upload your Logo here..</span>
                                                               </label>
                                                               <input type="file" name="lab_logo" id="lab_logo" class="form-control enterAsTab" placeholder="Enter lab_logo" autocomplete="off">
                                                                <input type="hidden" name="old_lab_logo" id="old_lab_logo" value="<?php echo $UserData->lab_logo; ?>">
                                                            </div>
                                                            <div class="form-group file-type-img col-lg-12">
                                                                <label for="lab_logo"></label>
                                                                <?php if ($UserData->lab_logo) { ?>
                                                                    <img src="<?php echo BASE_URL . 'public/assets/images/' . $UserData->lab_logo; ?>" alt="">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="form-group file-type col-lg-12 mb-0">
                                                                <label for="letter_pad">Letter head</label>
                                                                <label for="lab_logo" class="file-type-input">
                                                                <img src="<?php echo BASE_URL  ?>public/assets/images/upload.svg" alt=""> 
                                                                   <span>Upload your Letter head here..</span>
                                                               </label>
                                                                <input type="file" name="letter_pad" id="letter_pad" class="form-control enterAsTab" placeholder="Enter letter_pad" autocomplete="off">
                                                                <input type="hidden" name="old_letter_pad" id="old_letter_pad" value="<?php echo $UserData->letter_pad; ?>">
                                                            </div>
                                                            <div class="form-group file-type-img col-lg-12">
                                                                <label for="letter_pad"></label>
                                                                <?php if ($UserData->letter_pad) { ?>
                                                                    <img src="<?php echo BASE_URL . 'public/assets/images/' . $UserData->letter_pad; ?>" alt="">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-12" id="button">
                                                                <input type="submit" class="btn btnupdate custom-btn" data-id="<?php echo $UserData->id; ?>" id="update_layout" value="Update Layout">
                                                                <input type="hidden" name="layout_id" id="layout_id" value="<?php echo $UserData->id; ?>">
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
                        <div id="tab-4" class="tab-content">
                            <div class="docter-sec">
                                <div class="page-head page-head-border">
                                    <h2>Role Manage</h2>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12">

                                        <table width="100%" class="table dt-responsives">
                                            <thead>
                                                <tr role="row" class="tablesorter-headerRow">
                                                    <th data-column="1" class="">
                                                        <div class="tablesorter-header-inner">Name</div>
                                                    </th>
                                                    <th data-column="2" class="">
                                                        <div class="tablesorter-header-inner"> Mobile</div>
                                                    </th>
                                                    <th data-column="3" class="">
                                                        <div class="tablesorter-header-inner">Email</div>
                                                    </th>
                                                    <th data-column="4" class="">
                                                        <div class="tablesorter-header-inner">Role</div>
                                                    </th>
                                                    <th data-column="6" class="">
                                                        <div class="tablesorter-header-inner">Action</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                foreach ($AllUserData as $data) { ?>

                                                    <tr>
                                                        <td>
                                                            <div class="patient-avator">
                                                                <div class="ava-l">
                                                                    <div class="patient-short-name">
                                                                        <?php $name = explode(' ', $data->username);
                                                                        $name = array_filter($name);
                                                                        foreach ($name as $n) {
                                                                            echo $n[0];
                                                                        } ?> </div>
                                                                </div>
                                                                <div class="ava-r">
                                                                    <span><?php echo $data->username; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $data->mobile; ?></td>
                                                        <td><?php echo $data->email;  ?></td>
                                                        <td><?php echo $data->role;  ?></td>
                                                        <td>
                                                            <!-- <button data-toggle="tooltip" data-placement="top" title="" data-bs-target="#adddoctor" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sml patientedit-btn doc-model-btn" namse="doctoredit" data-id="<?php echo $ref->id;  ?>" value="<?php echo $ref->id;  ?>" data-title="Edit Doctor" data-bs-original-title="Edit Doctor"> -->
                                                            <img src="http://localhost/patidarLab/public/assets/images/icon-edit.svg" alt="">
                                                            <!-- </button> -->
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
                </div>
            </div>
        </div>
        <div class="c-modal modal right fade" id="adddoctor" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="page-head">
                        <h2 id="doc-title">Add Doctor</h2>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?php echo BASE_URL ?>public/assets/images/remove.svg" alt="">
                        </button>
                    </div>
                    <div class="modals-body">
                        <div class="row">
                            <div id="add_doctor">
                                <span class="errorTxt"></span>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="dname">Full Name<span class="text-danger">*</span></label>
                                        <input type="hidden" id="did" name="did" value="">
                                        <input type="text" name="dname" id="dname" class="form-control required" placeholder="Enter Doctor Name">
                                        <span class="error">This field is required.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="designation">Designation<span class="text-danger">*</span></label>
                                        <input type="text" name="designation" id="designation" class="form-control required" placeholder="Enter Designation">
                                        <span class="error">This field is required.</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="dmobile">Contact Number
                                        </label>
                                        <input type="number" name="dmobile" id="dmobile" class="form-control number_only" onkeypress="if(this.value.length==10)return false;" placeholder="Mobile Number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="daddress">Address</label>
                                        <textarea type="text" name="daddress" id="daddress" class="form-control" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="commission">Commission %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="commission" id="commission" class="form-control number_only required" placeholder="Percantage" autocomplete="off">
                                        <span class="error">This field is required.</span>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 text-center">
                            <input type="button" class="btn btnupdate custom-btn m-auto" id="addDoctor" value="Save">
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