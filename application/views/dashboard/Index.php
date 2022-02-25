<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
    <div class="page-head page-head-border">
            <h2>Dashboard</h2>
            <!-- <a class="btn custom-btn" href="#" data-bs-target="#patientAdd" data-bs-toggle="modal" data-bs-dismiss="modal">
                Add Patient
            </a> -->
        </div>
        <div class="dashbord-content-main">
            <div class="dashbord-content-inr">
                <div class="dashbord-box-main">
                    <h3>Today's <b class="color-green">Report</b></h3>
                    <div class="dashbord-box-inr">
                        <div class="dashboard-box blue-box">
                            <a href="#">
                                <div class="dashbord-content">
                                    <h4>Total Test</h4>
                                    <span class="test-count">40</span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box yellow-box">
                            <a href="#">
                                <div class="dashbord-content">
                                    <h4>In Process Test</h4>
                                    <span class="test-count">5</span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box green-box">
                            <a href="#">
                                <div class="dashbord-content">
                                    <h4>Completed Test </h4>
                                    <span class="test-count">23</span>
                                </div>
                            </a>
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