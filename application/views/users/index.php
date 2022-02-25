<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="page-head page-head-border">
            <h2>User Profile</h2>
        </div>
        <div class="patient-add-sec">
            <form method="POST" id="profile-form" name="profile" enctype="multipart/form-data">
                <div class="row">
                    <div id="profile">
								<div class="errorTxt text-danger text-center mb-3"></div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-group col-lg-9">
                                    <label for="username">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username" value="<?php echo $UserData->username; ?>" class="form-control enterAsTab required" placeholder="Enter Full Name" autocomplete="off">
                                    <span class="error">This field is required.</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-9">
                                    <label for="user_logo">User Profile Logo</label>
                                    <input type="file" name="user_logo" id="user_logo" class="form-control enterAsTab" placeholder="Enter user_logo" autocomplete="off">
                               <input type="hidden" name="oldprofile" id="oldprofile" value="<?php echo $UserData->logo; ?>">
                               <?php if($UserData->logo){ ?>
                                <img style="width:150px" src="<?php echo BASE_URL .'public/assets/images/'.$UserData->logo; ?>" alt="">
                               <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-9">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?php echo $UserData->email; ?>" class="form-control enterAsTab" placeholder="Enter Email" autocomplete="off">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-9">
                                    <label for="mobile">mobile</label>
                                    <input type="number" name="mobile" id="mobile" value="<?php echo $UserData->mobile; ?>" class="form-control enterAsTab" placeholder="Enter mobile number" autocomplete="off">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center" id="button">
                                    <button type="button" class="btn btnupdate custom-btn m-auto" data-id="<?php echo $UserData->id; ?>" id="update_profile" value="update_profile">Update Profile</button>
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
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>