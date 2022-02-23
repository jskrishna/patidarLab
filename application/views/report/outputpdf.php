<!DOCTYPE html>
<html lang="en">
<meta>

<head>
    <meta charset="utf-8">
    <title>Nextige Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/assets/images/icon.png" />
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/assets/css/global.css">
    <!-- CSS only -->
</head>

<body>
    <section class="login-main">
        <div class="container">
            <div class="row">
                <div id="outputpdfdata" class="invoice" width="100%">
                    <table width="100%" cellspacing="5">

                        <thead>
                            <tr>
                                <th align="left">
                                    <b> Name:</b>
                                </th>
                                <td><?php
                                    echo   $patientData->patientname; ?></td>
                            </tr>
                            <tr>

                                <th align="left">
                                    <b> Patient no:</b>
                                </th>
                                <td>
                                    <?php echo $patientData->patientid; ?>
                                </td>
                            </tr>
                            <tr>
                                <th align="left">
                                    <b> Age/gender:</b>
                                </th>
                                <td>
                                    <?php echo $patientData->age; ?> <?php echo $patientData->age_type; ?> /<?php echo $patientData->gender; ?>
                                </td>
                            </tr>
                            <tr>
                                <th align="left">
                                    <b> refer:</b>
                                </th>
                                <td>
                                    <?php echo $doctorData->referral_name; ?> <?php echo $doctorData->designation; ?>
                                </td>
                            </tr>
                            <tr>
                                <th align="left">
                                    <b>Date</b>
                                </th>
                                <td>
                                    <?php echo  $billData->billDate; ?>
                                </td>
                            </tr>
                            <tr>
                        </thead>
                    </table>
                    <b>
                        <hr>
                    </b>
                    <table width="100%" cellspacing="5">
                        <tbody>
                            <tr>
                                <th>Test Description</th>
                                <th>RESULT</th>
                                <th>Reference Range</th>
                            </tr>
                            <tr>
                                <th>
                                    <?php
                                    foreach ($testIDS as $test) {
                                        foreach ($selecetdtestArray as $tid) {
                                            if ($test == $tid) {

                                                $testData = $this->Report_model->getTestByID($tid);
                                                echo '<h5>' . $testData[0]->test_name . '</h5>';
                                            }
                                        }
                                    }
                                    ?>
                                </th>
                            </tr>
                            <?php
                            foreach ($testIDS as $test) {
                                foreach ($selecetdtestArray as $tid) {
                                    if ($test == $tid) {
                                        $testData = $this->Report_model->getTestByID($tid);
                                        $reportData = $this->Report_model->getreportDataByBIllandTestId($bill_id, $tid);
                                        $reportData = $reportData[0];
                                        $parameter_ids = unserialize($reportData->parameter_ids);
                                        $input_values = unserialize($reportData->input_values);

                                        foreach ($parameter_ids as $index => $paramID) {
                                            $paramData = $this->Report_model->getparameterBYID($tid, $paramID);
                                            $paramData = $paramData[0];
                                            if ($paramData->unit) {
                                                $unitData = $this->Report_model->getunitBYID($paramData->unit);
                                                $unitData = $unitData[0];
                                                // unit working 
                                            } else {
                                            }
                            ?>
                                            <tr>
                                                <td> <?php echo $paramData->name; ?></td>
                                                <td><?php echo $input_values[$index]; ?> </td>
                                                <td><?php if ($paramData->min_value) {
                                                        echo  $paramData->min_value . ' -' . $paramData->max_value;
                                                    } ?> </td>
                                            </tr>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>