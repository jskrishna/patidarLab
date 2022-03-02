<!-- /*
* Author: onlinecode
* start tcpdfexample.php file
* Location: ./application/controllers/tcpdfexample.php
*/ -->
<?php class Outputpdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Outputpdf_model');
    }
    function index()
    {
        // post data 
        $bill_id = $this->input->post('bill_id');
        $test_id = $this->input->post('test_id');
        $patientID = $this->input->post('patientID');
        $patientData = $this->Outputpdf_model->getpatientinfoByID($patientID);
        $patientData = $patientData[0];
        $doctorData = $this->Outputpdf_model->getdoctorinfoByID($patientData->refered_by);
        $doctorData = $doctorData[0];
        $billData = $this->Outputpdf_model->getbillinfoByID($bill_id);
        $billData = $billData[0];
        $tests = implode(',', $test_id);
        $testIDS = explode(',', $billData->testId);
        $selecetdtestArray = explode(',', $tests);
        $signImage = BASE_URL . 'public/assets/images/sign.jpeg';
        $headerImage = BASE_URL . 'public/assets/images/Letter_pad.png';
        require_once 'vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();
        $print_header =  $this->input->post('print_header');
        if (isset($print_header) && $print_header == 'Yes') {
            $mpdf->SetDefaultBodyCSS('background', "url('" . $headerImage . "')");
            $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
        }
        $mpdf->SetTitle('report-' . $patientData->patientid);
        $mpdf->SetDefaultFont('Roboto');
        $mpdf->SetProtection(array('print', 'print-highres'), '', md5(time()), 128);
        $mpdf->SetAuthor('Patidar Diagnostic');
        $mpdf->SetCreator('Px');
        date_default_timezone_set('Asia/Kolkata');
        foreach ($selecetdtestArray as $key => $tid) {
            $testData = $this->Outputpdf_model->getTestByID($tid);
            $departData = $this->Outputpdf_model->getdepartmentByID($testData[0]->department);
            $testName =  $testData[0]->test_name;
            $departName =  $departData[0]->department;

            // header
            $tabledata = "<main>
                            <table width='100%' cellspacing='5'>
                                <thead>
                                    <tr>
                                    <td style='height:100px' colspan='2'></td>
                                    </tr>
                                    <tr>
                                    <td> Name :</td>
                                    <th style='text-align:left;text-transform:capitalize;'>" . ($patientData->patientname) . "</th>
                                    </tr>
                                    <tr>
                                    <td> Patient no :</td>
                                    <th style='text-align:left;'>" . ($patientData->patientid) . "</th>
                                    </tr>
                                    <tr>
                                    <td> Age/gender :</td>
                                    <th style='text-align:left;text-transform:capitalize;'>" . ($patientData->age . ' ' . $patientData->age_type . ' / ' . $patientData->gender) . "</th>
                                    </tr>
                                    <tr>
                                    <td> Refered By :</td>
                                    <th style='text-align:left;text-transform:capitalize;'>" . ($doctorData->referral_name) . "</th>
                                    </tr>
                                    <tr>
                                    <td>Reporting Date :</td>
                                    <th style='text-align:left;text-transform:capitalize;'>" . (date_format(new DateTime($billData->billDate), "d-M-Y h:i:s")) . "</th>
                                    </tr>
                                    <tr>
                                    <td>Report Printed on :</td>
                                    <th style='text-align:left;text-transform:capitalize;'>" . (date("d-M-Y h:i:s")) . "</th>
                                    </tr>
                                </thead>
                            </table><hr>
                            <table width='100%' cellspacing='5'>
                                <thead>
                                    <tr>
                                     <th colspan='3'><h3>" . ($departName) . "</h3></th>
                                    </tr>
                                    <tr>
                                    <th colspan='3'></th>
                                   </tr>
                                    <tr>
                                     <th style='text-align:left;'>Test Description</th>
                                     <th style='text-align:left;'>RESULT</th>
                                     <th style='text-align:left;'>Reference Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan'3'><b>" . ($testName) . "</b></td>
                                    </tr>";
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
                    $minmaxunit = $paramData->min_value . ' - ' . $paramData->max_value . ' ' . $unit;
                } else {
                    $minmaxunit = '';
                }
                $paramName = $paramData->name;
                if ($paramData->field_type == 'textarea') {
                    $value = $paramData->options;
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
                $tabledata .= "<tr>
                                            <td>" . ($paramName) . "</td>
                                            <td>" . ($start) . "" . ($value) . "" . ($end) . " </td>
                                            <td>" . ($minmaxunit) . "</td>
                                        </tr>";
            }

            $tabledata .= '</tbody>
                        </table>';
            $mpdf->defaultfooterline = 0;

            $mpdf->SetFooter("<table style='margin-bottom:80px; width:100%' cellspacing='5' >
            <tfoot align='center'>
              
            <tr>
                <td style='text-align:center;' >Checked By <br> <b>Technologist</b></td>
                <td style='text-align:center;' >
                <img style='height:60px;width:135px; margin-bottom:5px;' src='" . ($signImage) . "'>
                <p style='text-align:center;'>Dr.R.K.Tiwari,M.D. <br>
                Regd No.2511 <br>
                Consultant Pathologist
                </p>
                </td>
                </tr>
            </tfoot>
            </table>");

            $mpdf->AddPage();
            $mpdf->WriteHTML($tabledata);
        }

        $footer = "<table width='100%' cellspacing='5'>
                                <tfoot>
                                    <tr>
                                        <th style='height:30px'  colspan='3'>**** END OF REPORT ****</th>
                                    </tr>
                                </tfoot>
                                </table>
                    </main>";
        $mpdf->WriteHTML($footer);

        $mpdf->Output(); // opens in browser
        // $mpdf->Output('report-'.$patientData->patientid.'.pdf','D'); // it downloads the file into the user system, with give name
    }
}
?>