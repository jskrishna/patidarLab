<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
    session_start();
}

use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class Pdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Outputpdf_model');
    }
    function index()
    {
        // post data 
        $key = $this->input->get('key');
        if (isset($key)) {
            $getUrlByKey = $this->Outputpdf_model->getUrlByKey($key);
            if(empty($getUrlByKey)){
                echo '<h2>Invalid or Unavailable key</h2>';
                die();
            }
?>
            <script>
                location.href = '<?php echo $getUrlByKey[0]->url; ?>';
            </script>
<?php
            die();
        } else {

            $bill_id = $this->input->get('b');
            $test_id = $this->input->get('t');
            $department = $this->input->get('d');
            $patientID = $this->input->get('p');
            if (!isset($patientID)) {
                header('location:' . BASE_URL . 'login');
            }
            $patientData = $this->Outputpdf_model->getpatientinfoByID($patientID);
            $patientData = $patientData[0];
            $doctorData = $this->Outputpdf_model->getdoctorinfoByID($patientData->refered_by);
            $doctorData = $doctorData[0];
            $billData = $this->Outputpdf_model->getbillinfoByID($bill_id);
            $billData = $billData[0];
            $tests = implode(',', $test_id);
            $departments = implode(',', $department);
            $testIDS = explode(',', $billData->testId);
            $selecetdtestArray = explode(',', $tests);

            foreach ($selecetdtestArray as $selecetdId) {
                $getPrintCount = $this->Outputpdf_model->getPrintCount($bill_id, $selecetdId);
                $getPrintCount = $getPrintCount[0];
                $count = intval($getPrintCount->printed) + 1;
                $this->Outputpdf_model->UpdatePrintedCount($bill_id, $selecetdId, $count);
            }

            $billData = $this->Outputpdf_model->getbillinfoByID($bill_id);
            $billData = $billData[0];
            $testIDS = explode(',', $billData->testId);
            // Authorised
            $reportcount = $this->Outputpdf_model->getReportByBill($bill_id);
            $reportStatus =  count($testIDS) == count($reportcount) ? 'completed' : 'pending';
            $this->Outputpdf_model->updateReportStatus($reportStatus, $bill_id);
            $departmentArray = explode(',', $departments);

            $loggedInId = $this->input->get('l');
            $getuserbyID =  $this->Outputpdf_model->getuserbyID($loggedInId);
            $getuserbyID = $getuserbyID[0];

            if ($getuserbyID->role == 'admin') {
                $labid = $getuserbyID->id;
            } else {
                $labid = $getuserbyID->user_id;
            }
            $getPathologistInfo =  $this->Outputpdf_model->getPathologistInfo($labid);
            $getPathologistInfo = $getPathologistInfo[0];

            $signImage = BASE_URL . 'public/assets/images/' . $getPathologistInfo->sign;

            $headerImage = BASE_URL . 'public/assets/images/' . $getuserbyID->letter_pad;
            require_once 'vendor/autoload.php';
            $mpdfConfig = array(
                'mode' => 'utf-8',
                'format' => 'A4',
                'default_font' => 'freesans',
                'margin_header' => 13,     // 30mm not pixel
                'margin_footer' => 10,     // 10mm
                'orientation' => 'P',
                'margin_top' => 70,
                'margin_bottom' => 60,
                'default_font_size' => 11,
            );

            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $qrCode = new QrCode($actual_link);
            $output = new Output\Svg();
            $svg = $output->output($qrCode, 112, 'white', 'black');
            $svg = str_replace('<?xml version="1.0"?>', '', $svg);

            $mpdf = new \Mpdf\Mpdf($mpdfConfig);
            $print_header =  $this->input->get('ph');
            if (isset($print_header) && $print_header == 'Y') {
                $mpdf->SetDefaultBodyCSS('background', "url('" . $headerImage . "')");
                $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
            }
            $reportname = $patientData->title.'.'.str_replace(' ','-',ucwords($patientData->patientname));

            $mpdf->SetTitle($reportname . '-' . $patientData->patientid);
            // $mpdf->SetDefaultFont('Inter');
            date_default_timezone_set('Asia/Kolkata');

            $collapse =  $this->input->get('c');

            $bill_number = 1000+$bill_id +date_format(new DateTime($billData->billDate), "h") ;

            $mpdf->SetHeader("<table width='100%' cellspacing='0' cellpadding='0'>
        <thead>
        <tr>
        <td style='height:95px' colspan='2'></td>
        </tr>
        <tr>
        <td style=''> Name</td>
        <th style='text-align:left;'><span style='text-transform:capitalize;'> : " . ($patientData->patientname) . "</span></th>
        <td style='width:117px; min-width:117px;'> Sample collection</td>
        <th style='text-align:left;'> : " . (date_format(new DateTime($billData->billDate), "d-M-Y h:i:s")) . "</th>
        <td rowspan='4' style='text-align:right;'>" . ($svg) . "</td>
        </tr>
        <tr>
        <td style=''> Age/Gender </td>
        <th style='text-align:left;text-transform:capitalize;'> : " . ($patientData->age . ' ' . $patientData->age_type . ' / ' . $patientData->gender) . "</th>
        <td style='width:117px; min-width:117px;'> Report </td>
        <th style='text-align:left;text-transform:capitalize;'> : " . (date_format(new DateTime($billData->billDate), "d-M-Y h:i:s")) . "</th>     
        </tr>
        <tr>
        <td style=''> Refered By </td>
        <th style='text-align:left;text-transform:capitalize;'> : "  . ($doctorData->title) . ' ' . ($doctorData->referral_name) . "</th>
        <td style='width:117px; min-width:117px;'>Report Printed</td>
        <th style='text-align:left;text-transform:capitalize;'> : " . (date("d-M-Y h:i:s")) . "</th>
        </tr>
        <tr>
        <td style=''> Patient No. </td>
        <th style='text-align:left;'> : "  . ($patientData->patientid) . "</th>
        <td style='width:117px; min-width:117px;'>Bill No</td>
        <th style='text-align:left;text-transform:capitalize;'> : " . ($bill_number) . "</th>
        </tr>
    </thead>
    </table>");

            if (isset($collapse) && $collapse == 'Y') {
                $departmentarray_unique = array_unique($departmentArray);
                foreach ($departmentarray_unique as $p => $departmentId) {
                    $departData = $this->Outputpdf_model->getdepartmentByID($departmentId);
                    $departName = $departData[0]->department;
                    $tabledata = "<main>
            <table  width='100%' cellspacing='3'>
                <thead>
                    <tr>
                     <th colspan='3'><h3>" . ($departName) . "</h3></th>
                    </tr>
                    <tr>
                    <th colspan='3'></th>
                   </tr>
                    <tr>
                     <th style='text-align:left;width:330px'>Test Description</th>
                     <th style='text-align:left;'>RESULT</th>
                     <th style='text-align:left;'>Reference Range</th>
                    </tr>
                </thead>
                <tbody>";

                    $arkey = array_keys($departmentArray, $departmentId);
                    foreach ($arkey as $key) {


                        $testData = $this->Outputpdf_model->getTestByID($selecetdtestArray[$key]);
                        $testName = $testData[0]->test_name;

                        $tabledata .= "<tr><td colspan'3'><b>" . ($testName) . "</b></td></tr>";

                        // parameter 
                        $reportData = $this->Outputpdf_model->getreportDataByBIllandTestId($bill_id, $selecetdtestArray[$key]);
                        $reportData = $reportData[0];
                        $parameter_ids = unserialize($reportData->parameter_ids);
                        $input_values = unserialize($reportData->input_values);
                        $highlights = unserialize($reportData->highlights);

                        foreach ($parameter_ids as $index => $paramID) {
                            $paramData = $this->Outputpdf_model->getparameterBYID($selecetdtestArray[$key], $paramID);
                            $paramData = $paramData[0];
                            if ($paramData->unit) {
                                $unitData = $this->Outputpdf_model->getunitBYID($paramData->unit);
                                $unitData = $unitData[0];
                                $unit = $unitData->unit;
                            } else {
                                $unit = null;
                            }

                            if ($paramData->max_value) {
                                $minmaxunit = $paramData->min_value . ' - ' . $paramData->max_value;
                            } else {
                                $minmaxunit = '';
                            }

                            if ($paramData->field_type == 'textarea' || $paramData->field_type == 'listHeading' || $paramData->field_type == 'listInput') {
                                $minmaxunit = '';
                            } else {
                              
                                $minmaxunit = "<td>" . ($minmaxunit) . "</td>";
                            }
                            $paramName = $paramData->name;

                            if ($paramData->field_type == 'textarea') {
                                $value = $input_values[$index];
                            } else if ($paramData->field_type == 'listHeading') {
                                $value = '<table class="serum-list" style="width:100%;text-align:center"><tr>';
                                foreach (explode(', ', $paramData->options) as $option) {
                                    $value .= '<td><b>' . $option . '</b></td>';
                                }
                                $value .= '</tr></table>';
                            } else if ($paramData->field_type == 'listInput') {
                                $value = '<table class="serum-list" style="width:100%;text-align:center"><tr>';
                                foreach (explode(',', $input_values[$index]) as $option) {
                                $val = $option != '_' ? $option : ' ';
                                    $value .= '<td>' . $val . '</td>';
                                }
                                $value .= '</tr></table>';
                            } else {
                                $value = $input_values[$index] . ' ' . $unit;
                            }
                            $start = '';
                            $end = '';
                            if (!empty($highlights)) {
                                if ($highlights[$index] == 'Yes') {
                                    $start = '<b>';
                                    $end = '</b>';
                                }
                            }
                            if ($paramData->id == '9') {
                                $tabledata .= "<tr>
                            <td><b>DIFFERENTIAL COUNT</b></td>
                            <td></td>
                            <td></td>
                        </tr>";
                            } elseif ($paramData->id == '22') {
                                $tabledata .= "<tr>
                            <td><b>PHYSICAL EXAMINATION</b></td>
                            <td></td>
                            <td></td>
                        </tr>";
                            } elseif ($paramData->id == '29') {
                                $tabledata .= "<tr>
                            <td><b>CHEMICAL EXAMINATION</b></td>
                            <td></td>
                            <td></td>
                        </tr>";
                            } elseif ($paramData->id == '35') {
                                $tabledata .= "<tr>
                            <td><b>MICROSCOPIC EXAMINATION</b></td>
                            <td></td>
                            <td></td>
                        </tr>";
                            }

                            if ($paramData->field_type == 'textarea' || $paramData->field_type == 'listHeading' || $paramData->field_type == 'listInput') {
                                $value = "<td colspan='2'>" . ($start) . "" . ($value) . "" . ($end) . "</td>";
                            } else {
                                $value = "<td>" . ($start) . "" . ($value) . "" . ($end) . "</td>";
                            }

                            $tabledata .= "<tr><td>" . ($paramName) . "</td>" . ($value) . "" . ($minmaxunit) . "</tr>";
                        }
                    }
                    $tabledata .= '</tbody>
            </table><hr>';
                    $mpdf->defaultfooterline = 0;
                    $mpdf->SetFooter("<table style='table-layout:fixed; margin-bottom:80px; width:100%' cellspacing='0' >
                    <tfoot align='center'>                 
                    <tr>
                        <td style='font-size:13px;max-width:70%;
                        width:70%; text-align:left;' >Checked By <br> <b>Technologist</b></td>
                        <td style='text-align:center'>
                        <img style='height:60px;margin-bottom:5px;' src='" . ($signImage) . "'/>
                            <p style='font-size:13px'>" . ($getPathologistInfo->title . '.' . $getPathologistInfo->name) . ' ' . ($getPathologistInfo->designation) . "
                            </p>
                        </td>
                        </tr>
                    </tfoot>
                    </table>");
                    $mpdf->WriteHTML($tabledata);
                }
            } else {
                foreach ($selecetdtestArray as $key => $tid) {
                    $testData = $this->Outputpdf_model->getTestByID($tid);
                    $departData = $this->Outputpdf_model->getdepartmentByID($departmentArray[$key]);
                    $testName =  $testData[0]->test_name;
                    $departName =  $departData[0]->department;

                    $tabledata = "
                <main>
                <table width='100%' cellspacing='5'>
                    <thead>
                        <tr>
                         <th colspan='3'><h3>" . ($departName) . "</h3></th>
                        </tr>
                        <tr>
                        <th colspan='3'></th>
                       </tr>
                        <tr>
                         <th style='text-align:left;width:330px'>Test Description</th>
                         <th style='text-align:left;'>RESULT</th>
                         <th style='text-align:left;'>Reference Range</th>
                        </tr>
                    </thead>
                    <tbody>";

                    $tabledata .= "<tr><td colspan'3'><b>" . ($testName) . "</b></td></tr>";

                    $testData = $this->Outputpdf_model->getTestByID($tid);
                    $reportData = $this->Outputpdf_model->getreportDataByBIllandTestId($bill_id, $tid);
                    $reportData = $reportData[0];
                    $parameter_ids = unserialize($reportData->parameter_ids);
                    $input_values = unserialize($reportData->input_values);
                    $highlights = unserialize($reportData->highlights);

                    foreach ($parameter_ids as $index => $paramID) {
                        $paramData = $this->Outputpdf_model->getparameterBYID($tid, $paramID);
                        $paramData = $paramData[0];
                        if ($paramData->unit) {
                            $unitData = $this->Outputpdf_model->getunitBYID($paramData->unit);
                            $unitData = $unitData[0];
                            // unit working 
                            $unit = $unitData->unit;
                        } else {
                            $unit = null;
                        }

                        if ($paramData->max_value) {
                            $minmaxunit = $paramData->min_value . ' - ' . $paramData->max_value;
                        } else {
                            $minmaxunit = '';
                        }

                        if ($paramData->field_type == 'textarea' || $paramData->field_type == 'listHeading' || $paramData->field_type == 'listInput') {
                            $minmaxunit = '';
                        } else {
                            $minmaxunit = "<td>" . ($minmaxunit) . "</td>";
                        }
                        $paramName = $paramData->name;

                        if ($paramData->field_type == 'textarea') {
                            $value = $input_values[$index];
                        } else if ($paramData->field_type == 'listHeading') {
                            $value = '<table class="serum-list" style="width:100%;text-align:center"><tr>';
                            foreach (explode(', ', $paramData->options) as $option) {
                                $value .= '<td><b>' . $option . '</b></td>';
                            }
                            $value .= '</tr></table>';
                        } else if ($paramData->field_type == 'listInput') {
                            $value = '<table class="serum-list" style="width:100%;text-align:center"><tr>';
                            foreach (explode(',', $input_values[$index]) as $option) {
                                $val = $option != '_' ? $option : ' ';
                                $value .= '<td>' . $val . '</td>';
                            }
                            $value .= '</tr></table>';
                        } else {
                            $value = $input_values[$index] . ' ' . $unit;
                        }
                        $start = '';
                        $end = '';
                        if (!empty($highlights)) {
                            if ($highlights[$index] == 'Yes') {
                                $start = '<b>';
                                $end = '</b>';
                            }
                        }
                        if ($paramData->id == '9') {
                            $tabledata .= "<tr>
                        <td><b>DIFFERENTIAL COUNT</b></td>
                        <td></td>
                        <td></td>
                    </tr>";
                        } elseif ($paramData->id == '22') {
                            $tabledata .= "<tr>
                        <td><b>PHYSICAL EXAMINATION</b></td>
                        <td></td>
                        <td></td>
                    </tr>";
                        } elseif ($paramData->id == '29') {
                            $tabledata .= "<tr>
                        <td><b>CHEMICAL EXAMINATION</b></td>
                        <td></td>
                        <td></td>
                    </tr>";
                        } elseif ($paramData->id == '35') {
                            $tabledata .= "<tr>
                        <td><b>MICROSCOPIC EXAMINATION</b></td>
                        <td></td>
                        <td></td>
                    </tr>";
                        }

                        if ($paramData->field_type == 'textarea' || $paramData->field_type == 'listHeading' || $paramData->field_type == 'listInput') {
                            $value = "<td colspan='2'>" . ($start) . "" . ($value) . "" . ($end) . "</td>";
                        } else {
                            $value = "<td>" . ($start) . "" . ($value) . "" . ($end) . "</td>";
                        }

                        $tabledata .= "<tr><td>" . ($paramName) . "</td>" . ($value) . "" . ($minmaxunit) . "</tr>";
                    }

                    $tabledata .= '</tbody>
                            </table><hr>';
                    $mpdf->defaultfooterline = 0;

                    $mpdf->SetFooter("<table style='table-layout:fixed; margin-bottom:80px; width:100%' cellspacing='0' >
                <tfoot align='center'>                 
                <tr>
                    <td style='font-size:13px;max-width:70%;
                    width:70%; text-align:left;' >Checked By <br> <b>Technologist</b></td>
                    <td style='text-align:center'>
                    <img style='height:60px;margin-bottom:5px;' src='" . ($signImage) . "'/>
                        <p style='font-size:13px'>" . ($getPathologistInfo->title . '.' . $getPathologistInfo->name) . ' ' . ($getPathologistInfo->designation) . "
                        </p>
                    </td>
                    </tr>
                </tfoot>
                </table>");

                    $mpdf->AddPage();
                    $mpdf->WriteHTML($tabledata);
                }
            }
            $footer = "<table width='100%' cellspacing='5'>
                                <tfoot>
                                    <tr>
                                        <th style='height:20px'  colspan='3'>**** END OF REPORT ****</th>
                                    </tr>
                                </tfoot>
                                </table>
                    </main>";
            $mpdf->WriteHTML($footer);
            $mpdf->Output($reportname.'-'.$patientData->patientid.'.pdf','I'); // opens in browser
            // $mpdf->Output($reportname.'-'.$patientData->patientid.'.pdf','D'); // it downloads the file into the user system, with give name
        }
    }
}
