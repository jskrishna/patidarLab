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
                            <a href="<?php echo BASE_URL; ?>report">
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
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>In Process</h4>
                                    <span class="test-count"><?php echo $process; ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box green-box col-3">
                            <a href="<?php echo BASE_URL; ?>report">
                                <div class="dashbord-content">
                                    <h4>Completed </h4>
                                    <span class="test-count"><?php echo $complete; ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
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
                                    <div id="ReferralChart" style="height: 600px; width: 100%"></div>
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
                                    <div id="drawColumnChart" style="height: 600px; width: 100%"></div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    <?php
    if (isset($_GET['data'])) {
        if ($_GET['data'] == 'previous_month') {
            $refertitle = 'Previous Month data of Referral By Dr.';
        } else if ($_GET['data'] == 'all') {
            $refertitle = 'All data of Referral By Dr.';
        } else {
            $refertitle = 'This Month data of Referral By Dr.';
        }
    } else {
        $refertitle = 'This Month data of Referral By Dr.';
    }
    $yeartitle = 'Income Of ' . $year;
    ?>

    google.charts.load('visualization', "1", {
        packages: ['corechart', 'bar']

    });
    google.charts.setOnLoadCallback(drawReferralChart);
    // Pie Chart
    function drawReferralChart() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Products Count'],
            <?php
            foreach ($ChartData['refer'] as $name => $refer) {
                echo "['" . $name . "'," . count($refer) . "],";
            }
            ?>
        ]);

        var Referralview = new google.visualization.DataView(data);
        Referralview.setColumns([0, 1, {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        }, ]);

        var options = {
            title: '<?php echo $refertitle; ?>',
            curveType: 'function',
            is3D: true,
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('ReferralChart'));
        chart.draw(Referralview, options);
    }

    google.setOnLoadCallback(drawColumnChart);

    function drawColumnChart() {
        var data = google.visualization.arrayToDataTable([
            ['Months', '<?php echo $yeartitle; ?>'],
            <?php
            foreach ($ChartData['monthly'] as $month => $Income) {
                echo "['" . $month . "'," . intval($Income[0]->income) . "],";
            }
            ?>
        ]);

        // Use view to show annotation
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        }, ]);

        var options = {
            title: 'Income (in rupess)',
            curveType: 'function',

            width: 600,
            height: 400,
            legend: {
                position: "bottom"
            },
            colors: ['#05836B']
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.LineChart(document.getElementById('drawColumnChart'));
        chart.draw(view, options);
    }
</script>