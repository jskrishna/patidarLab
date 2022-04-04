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
                    <div class="dashbord-box-inr row">
                        <div class="dashboard-box purple-box col-3">
                            <a href="JavaScript:void(0)">
                                <div class="dashbord-content">
                                    <h4>Collection </h4>
                                    <span class="test-count">₹ <?php echo number_format($today_collection, 0, '.', ','); ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box blue-box col-3">
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>Test</h4>
                                    <span class="test-count"><?php echo $total; ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box yellow-box col-3">
                            <a href="<?php echo BASE_URL; ?>report#pending">
                                <div class="dashbord-content">
                                    <h4>In Process</h4>
                                    <span class="test-count"><?php echo $process; ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box green-box col-3">
                            <a href="<?php echo BASE_URL; ?>report#completed">
                                <div class="dashbord-content">
                                    <h4>Completed </h4>
                                    <span class="test-count"><?php echo $complete; ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="dashboard-box green-box col-6">
                            <div>
                                <form action="" method="GET">
                                    <select class="form-control" name="data" id="data" onchange="this.form.submit()">
                                        <option <?php if (isset($_GET['data']) && $_GET['data'] == 'this_month') {
                                                    echo 'selected';
                                                } ?> value="this_month">This Month</option>
                                        <option <?php if (isset($_GET['data']) && $_GET['data'] == 'previous_month') {
                                                    echo 'selected';
                                                } ?> value="previous_month">Previous Month</option>
                                        <option <?php if (isset($_GET['data']) && $_GET['data'] == 'all') {
                                                    echo 'selected';
                                                } ?> value="all">All</option>
                                    </select>
                                </form>
                            </div>
                            <div class="container">
                                <div class="mt-5">
                                    <canvas id="ReferralChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-box green-box col-6">
                            <form action="" method="GET">
                                <select class="form-control" name="y" id="y" onchange="this.form.submit()">
                                    <option <?php if (isset($_GET['y']) && $_GET['y'] == 'this_year') {
                                                echo 'selected';
                                            } ?> value="this_year">This Year</option>
                                    <option <?php if (isset($_GET['y']) && $_GET['y'] == 'previous_year') {
                                                echo 'selected';
                                            } ?> value="previous_year">Previous Year</option>
                                </select>
                            </form>
                            <div class="container">
                                <div class="mt-5">
                                    <canvas id="drawColumnChart"></canvas>
                                </div>
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
<script>
    <?php
    // if (isset($_GET['data'])) {
    //     if ($_GET['data'] == 'previous_month') {
    //         $refertitle = 'Previous Month data of Referral By Dr.';
    //     } else if ($_GET['data'] == 'all') {
    //         $refertitle = 'All data of Referral By Dr.';
    //     } else {
    //         $refertitle = 'This Month data of Referral By Dr.';
    //     }
    // } else {
    //     $refertitle = 'This Month data of Referral By Dr.';
    // }
    // $yeartitle = 'Income Of ' . $year;
    ?>

    // var drawColumnChart = document.getElementById('drawColumnChart');
    // var ReferralChart = document.getElementById('ReferralChart');
    // var chart = new Chart(drawColumnChart, {
    //     type: 'line',
    //     data: {
    //         labels: <?php //echo $months; ?>,
    //         datasets: [{
    //             label: "<?php //echo $yeartitle; ?>",
    //             backgroundColor: 'transparent',
    //             borderColor: '#7526bb',
    //             data: <?php //echo $values; ?>,
    //             lineTension: 0,
    //             pointRadius: 4,
    //             pointBackgroundColor: 'rgba(255,255,255,1)',
    //             pointHoverBackgroundColor: 'rgba(255,255,255,0.6)',
    //             pointHoverRadius: 8,
    //             pointHitRadius: 30,
    //             pointBorderWidth: 2,
    //             pointStyle: 'rectRounded'
    //         }, ]
    //     },

    //     options: {
    //         responsive: true,
    //         legend: {
    //             display: true,
    //             position: 'bottom'
    //         },
    //         tooltips: {
    //             callbacks: {
    //                 title: function(tooltipItem, data) {
    //                     return data['labels'][tooltipItem[0]['index']];
    //                 },
    //                 label: function(tooltipItem, data) {
    //                     return ' ₹ ' + data['datasets'][0]['data'][tooltipItem['index']];
    //                 },
    //                 afterLabel: function(tooltipItem, data) {}
    //             },
    //             backgroundColor: '#000000',
    //             titleFontSize: 12,
    //             bodyFontSize: 18,
    //             displayColors: false
    //         }
    //     }
    // });

    // function getRandomColor() {
    //     var letters = '05836B'.split('');
    //     var color = '#';
    //     for (var i = 0; i < 6; i++) {
    //         color += letters[Math.round(Math.random() * 6)];
    //     }
    //     return color;
    // }

    // var myChart = new Chart(ReferralChart, {
    //     type: 'pie',
    //     data: {
    //         labels: <?php //echo $names; ?>,
    //         datasets: [{
    //             label: '<?php //echo $refertitle; ?>',
    //             data: <?php //echo $refer_count; ?>,
    //             backgroundColor: [
    //                 <?php
    //                 foreach ($ChartData['refer'] as $name => $refer) { ?>
    //                     getRandomColor(),
    //                 <?php //} ?>
    //             ]
    //         }]
    //     },
    //     options: {
    //         title: {
    //             display: true,
    //             text: '<?php //echo $refertitle; ?>',
    //             position: 'bottom'
    //         },
    //         responsive: true,
    //         legend: {
    //             display: true,
    //             position: 'bottom',
    //         },
    //         tooltips: {
    //             callbacks: {
    //                 title: function(tooltipItem, data) {
    //                     return data['labels'][tooltipItem[0]['index']];
    //                 },
    //                 label: function(tooltipItem, data) {
    //                     return 'Refered Total : ' + data['datasets'][0]['data'][tooltipItem['index']];
    //                 },
    //                 afterLabel: function(tooltipItem, data) {}
    //             },
    //             backgroundColor: '#000000',
    //             titleFontSize: 12,
    //             bodyFontSize: 18,
    //             displayColors: false
    //         }
    //     }
    // });
</script>