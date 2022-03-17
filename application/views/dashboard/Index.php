<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <?php
        if ($loggedData->role == 'staff') {
            header('Location:' . BASE_URL . 'report');
        }
        if ($loggedData->role == 'superadmin') {
            header('Location:' . BASE_URL . 'admin');
        }
        ?>
        <div class="dashbord-content-main">
            <div class="dashbord-content-inr">
                <div class="dashbord-box-main">
                    <h3>Today's <b class="color-green">Report</b></h3>
                    <div class="dashbord-box-inr">
                        <div class="dashboard-box blue-box">
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>Total Test</h4>
                                    <span class="test-count"><?php echo $total; ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box yellow-box">
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>In Process Test</h4>
                                    <span class="test-count"><?php echo $process; ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box green-box">
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>Completed Test </h4>
                                    <span class="test-count"><?php echo $complete; ?></span>
                                </div>
                            </a>
                            <?php
                            $obj  = 'a:22:{i:0;s:0:"";i:1;a:1:{i:136;s:1:"+";}i:2;a:1:{i:136;s:1:"+";}i:3;a:1:{i:136;s:1:"+";}i:4;a:1:{i:136;s:1:"+";}i:5;a:1:{i:136;s:1:"+";}i:6;a:1:{i:137;s:1:"-";}i:7;a:1:{i:137;s:1:"-";}i:8;a:1:{i:137;s:1:"-";}i:9;a:1:{i:137;s:1:"-";}i:10;a:1:{i:137;s:1:"-";}i:11;a:1:{i:138;s:1:"+";}i:12;a:1:{i:138;s:1:"+";}i:13;a:1:{i:138;s:1:"+";}i:14;a:1:{i:138;s:1:"+";}i:15;a:1:{i:138;s:1:"+";}i:16;a:1:{i:139;s:1:"-";}i:17;a:1:{i:139;s:1:"-";}i:18;a:1:{i:139;s:1:"-";}i:19;a:1:{i:139;s:1:"-";}i:20;a:1:{i:139;s:1:"-";}i:21;s:4:"impr";}';
                           
                            // foreach (unserialize($obj) as $key => $obj) {
                            //     if (is_array($obj)) {
                            //         echo $key.'- ';
                            //             print_r($obj);
                                     
                            //     } else {
                            //         echo $key.'- '.$obj;
                            //     }

                            //     echo '<br><br>';
                            // }
                           
                            $json = unserialize($obj);
                            print_r($json);
                            // for ($i=1; $i <=5 ; $i++) { 
                            // print_r($json[$i][136]);
                            // # code...
                            // }
                            ?>
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
<script>
    localStorage.setItem('activetab', 1);
</script>