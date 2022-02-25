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

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDefaultBodyCSS('background', "url('https://niglabs.com/uploads/customerLogo/934_Letter_pad.jpg')");
        $mpdf->SetDefaultBodyCSS('background-image-resize', 6);

foreach ($testIDS as $test) {
    foreach ($selecetdtestArray as $key => $tid) {
        if ($test == $tid) {

                    $testData = $this->Outputpdf_model->getTestByID($tid);
                    $testName =  $testData[0]->test_name;


                    // header
                    $tabledata = "<main ><table width='100%' cellspacing='5'><thead><tr><td style='height:140px' colspan='2'></td></tr><tr><th align='left'><b> Name:</b></th>
            <td>" . ($patientData->patientname) . "</td>
            </tr><tr><th align='left'><b> Patient no:</b></th>
            <td>" . ($patientData->patientid) . "</td>
            </tr><tr><th align='left'><b> Age/gender:</b></th>
            <td>" . ($patientData->age) . "</td>
            </tr><tr><th align='left'><b> refer:</b></th>
            <td>" . ($doctorData->referral_name) . "</td>
            </tr><tr><th align='left'><b>Date</b></th>
            <td>" . ($billData->billDate) . "</td></tr></thead></table><hr>";


                    // test name
                    $tabledata .= '<table width="100%" cellspacing="5" ><thead><tr><th colspan="3"><h3>' . ($testName) . '</h3></th></tr><tr><th>Test Description</th><th>RESULT</th><th>Reference Range</th></tr></thead><tbody >';

                    foreach ($testIDS as $test) {
                        foreach ($selecetdtestArray as $tid) {
                            if ($test == $tid) {

                                $testData = $this->Outputpdf_model->getTestByID($tid);
                                $reportData = $this->Outputpdf_model->getreportDataByBIllandTestId($bill_id, $tid);
                                $reportData = $reportData[0];
                                $parameter_ids = unserialize($reportData->parameter_ids);
                                $input_values = unserialize($reportData->input_values);

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
                                    $tabledata .= "<tr>
                        <td> " . ($paramData->name) . "</td>
                        <td>" . ($input_values[$index] . ' ' . $unit) . " </td>
                        <td>" . ($minmaxunit) . " </td>
                     </tr>";
                                }
                            }
                        }
                    }

                    $tabledata .= '</tbody></table>';
                    $tabledata .= "<table width='100%' cellspacing='5'><tfoot><tr><th style='height:100px'  colspan='3'>**** END OF REPORT ****</th></tr></tfoot></table></main>";
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($tabledata);
                }
        
    }
}
     
       
        $mpdf->Output(); // opens in browser
        //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    }
}
?>