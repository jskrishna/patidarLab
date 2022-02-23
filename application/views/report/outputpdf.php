<!DOCTYPE html>
<html lang="en">
<meta>

<head>
    <meta charset="utf-8">
    <title>Nextige Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/assets/images/icon.png" />
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/assets/css/global.css">
    <!-- CSS only -->
</head>

<body>
    <section id="data" class="login-main">
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
            <div id="customers" class="row">
                <table id="example" class="sfc_table">
                    <thead class="innerHeader">
                        <tr>
                            <th align="left">
                                <b> Name:</b>
                            </th>
                            <td colspan="2"><?php
                                echo   $patientData->patientname; ?></td>
                        </tr>
                        <tr>
                            <th align="left">
                                <b> Patient no:</b>
                            </th>
                            <td colspan="2">
                                <?php echo $patientData->patientid; ?>
                            </td>
                        </tr>
                        <tr>
                            <th align="left">
                                <b> Age/gender:</b>
                            </th>
                            <td colspan="2">
                                <?php echo $patientData->age; ?> <?php echo $patientData->age_type; ?> /<?php echo $patientData->gender; ?>
                            </td>
                        </tr>
                        <tr>
                            <th align="left">
                                <b> refer:</b>
                            </th>
                            <td colspan="2">
                                <?php echo $doctorData->referral_name; ?> <?php echo $doctorData->designation; ?>
                            </td>
                        </tr>
                        <tr>
                            <th align="left">
                                <b>Date</b>
                            </th>
                            <td colspan="2">
                                <?php echo  $billData->billDate; ?>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($testIDS as $test) {
                                foreach ($selecetdtestArray as $tid) {
                                    if ($test == $tid) {
                                        $testData = $this->Report_model->getTestByID($tid);
                                        $testData =  $testData[0];
                                        $depId = $testData->department;
                                    }
                                }
                            }

                            $departData = $this->Report_model->getdepartmentByID($depId);
                            $departData = $departData[0];
                            ?>
                            <th colspan="3">
                                <div class="text-center">
                                    <h4><?php echo $departData->department; ?></h4>
                                </div>

                            </th>
                        </tr>
                        <tr>
                            <th>Test Description</th>
                            <th>RESULT</th>
                            <th>Reference Range</th>
                        </tr>
                        <tr>
                            <th colspan="3">
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
                              
                            ?>
                        </tbody>
                    </table>
                </div>
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
                                            $unit = $unitData->unit;
                                        } else {
                                            $unit = null;
                                        }


                        ?>
                                        <tr>
                                            <td> <?php echo $paramData->name; ?></td>
                                            <td><?php echo $input_values[$index] . ' ' . $unit; ?> </td>
                                            <td><?php if ($paramData->min_value) {
                                                    echo  $paramData->min_value . ' -' . $paramData->max_value . ' ' . $unit;
                                                } ?> </td>
                                        </tr>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">**** END OF REPORT ****</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id="bypassme"></div>
    </section>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script>

function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }, margins);
}

    $('#ignore').click(function(e) {
        e.preventDefault();
        demoFromHTML();
    });

    $('#ignore').click();
</script>

</html>