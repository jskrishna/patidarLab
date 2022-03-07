<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="patient-sec">
        <div class="report-list-head">
                    <div class="patient-name-sec">
                        <div class="name-sec-inr">
                            <div class="name-sec-left">
                                <div class="name-icon">
                                    <h3>
                                        <?php
                                        $editer = 0;
                                        $name = explode(' ', $patientData->patientname);
                                        $name = array_filter($name);
                                        foreach ($name as $n) {
                                            echo $n[0];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="patient-name">
                                    <input type="hidden" value="<?php echo $patientData->id; ?>" id="patientID" name="patientID">
                                    <input type="hidden" name="bill_id" id="bill_id" value="<?php //echo $billData->id; ?>">
                                    <h3><?php echo $patientData->title . '. ' . $patientData->patientname ?></h3>
                                    <div class="patient-dtl">
                                        <p>
                                            <img src="<?php echo BASE_URL ?>public/assets/images/feather-calendar.svg" alt="">
                                            <span>
                                                <?php echo $patientData->age . ' ' . $patientData->age_type; ?>
                                            </span>
                                        </p>
                                        <p>
                                            <img src="<?php echo BASE_URL ?>public/assets/images/feather-user.svg" alt="">
                                            <span>
                                                <?php echo $patientData->gender ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="name-sec-center bill-add-d">
                                <p>
                                    <label for="">Patient ID:</label><span><?php echo $patientData->patientid; ?></span>
                                </p>
                                <p><label for="">Bill:</label> <span><?php // echo date_format(new DateTime($billData->billDate), "d-M-Y"); ?></span></p>
                                <p>
                                    <label for="">Referred by:</label>
                                    <span class="text-capitalize"><?php echo $doctorData->title . ' ' . $doctorData->referral_name; ?></span>
                                </p>
                            </div>
                            <a href="<?php echo BASE_URL ?>patient" class="btn custom-btn"> Back</a>
                        </div>
                    </div>
                </div>
            <div class="form-row">
                <div class="col-lg-12">
                </div>
            </div>
        </div>
    </div>
</div>