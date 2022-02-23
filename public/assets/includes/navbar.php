<div class="layoutSidenav">
    <div class="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-header">
                <a href="/">
                    <img src="<?php echo BASE_URL ?>public/assets/images/logo.svg" alt="logo">
                </a>
            </div>
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <ul>
                        <li>
                            <?php
                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            ?>
                            <a class="nav-links <?php if (strpos($actual_link, "dashboard") !== false) {
                                                    echo "nav-active";
                                                } ?>" href="<?php echo BASE_URL; ?>dashboard">
                                <div class="nav-link-icon">
                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-home.svg" alt="">
                                </div>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="nav-links <?php if (strpos($actual_link, "patient") !== false) {
                                                                            echo "nav-active";
                                                                        } ?>" href="<?php echo BASE_URL; ?>patient">
                                <div class="nav-link-icon">
                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-users.svg" alt="">
                                </div>
                                Patients
                            </a>
                        </li>
                        <li>
                            <a class="nav-links <?php if (strpos($actual_link, "bill") !== false) {
                                                                                echo "nav-active";
                                                                            } ?>" href="<?php echo BASE_URL; ?>bill">
                                <div class="nav-link-icon">
                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-home.svg" alt="">
                                </div>
                                Billing
                            </a>
                        </li>
                        <li>
                            <a class="nav-links <?php if (strpos($actual_link, "report") !== false) {
                                                                                echo "nav-active";
                                                                            } ?>" href="<?php echo BASE_URL; ?>report">
                                <div class="nav-link-icon">
                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-home.svg" alt="">
                                </div>
                                Report
                            </a>
                        </li>
                        <hr/>
                        <li>
                            <a class="nav-links <?php if (strpos($actual_link, "report") !== false) {
                                                                                echo "nav-active";
                                                                            } ?>" href="<?php echo BASE_URL; ?>report">
                                <div class="nav-link-icon">
                                    <img src="<?php echo BASE_URL ?>public/assets/images/icon-home.svg" alt="">
                                </div>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <a href="<?php //echo BASE_URL; ?>Logout" class="btn custom-btn">Logout</a>
                </div>
            </div>
        </nav>
    </div>