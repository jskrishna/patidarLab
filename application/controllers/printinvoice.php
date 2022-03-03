<!-- /*
* Author: onlinecode
* start tcpdfexample.php file
* Location: ./application/controllers/tcpdfexample.php
*/ -->
<?php class printinvoice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Outputpdf_model');
    }

    function index($bill_id)
    {
        $billData = $this->Outputpdf_model->getbillinfoByID($bill_id);
        $billData = $billData[0];

        $patient_id = $billData->patient_id;
        $patientData = $this->Outputpdf_model->getpatientinfoByID($patient_id);
        $patientData = $patientData[0];

        $referData = $this->Outputpdf_model->getdoctorinfoByID($patientData->refered_by);
        $referData = $referData[0];
        $headerImage = BASE_URL.'public/assets/images/Letter_pad.png';

        $testIDS = explode(',', $billData->testId);
        require_once 'vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();
        $print_header =  $this->input->post('print_header');
        // if (isset($print_header) && $print_header == 'Yes') {
            $mpdf->SetDefaultBodyCSS('background', "url('" . $headerImage . "')");
            $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
        // }
        // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);


        $mpdf->SetTitle('Invoice-' . $patientData->patientid);
        $mpdf->SetDefaultFont('Roboto');
        $mpdf->SetAuthor('Patidar Diagnostic');
        $mpdf->SetCreator('Px');
        date_default_timezone_set('Asia/Kolkata');
        $tabledata = "<style>
        td, th {
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 11px !important;
    font-size: 13px;
        }
        .table {
            border-collapse:collapse;
            border:1px solid #e0e0e0;
        }
        .table td, .table th, .table tbody td, .table tbody th {
            padding:5px 10px;
            font-size:12px;
        }
        </style><main>
        <table width='100%' cellspacing='5' border:'0'>
                    <thead>
                        <tr>
                        <td style='height:100px;border:0;' colspan='2'></td>
                        </tr>
                        </thead>
                        </table>
        <h3 style='margin:0;margin-bottom:20px;text-align:center;'>Bill Receipt</h3>
        <table width='100%' cellspacing='5' class='table'>
            <thead>
            <tr>
            <td> Receipt No :</td>
            <th style='text-align:left;'>" . '00' . ($patientData->id) . "</th>
            <td style=''>Date & Time :</td>
            <th style='text-align:left;'>" . (date("d-M-Y h:i:s")) . "</th>
            </tr>
            <tr>
            <td> Name :</td>
            <th style='text-align:left;'>" . ($patientData->title . ' ' . $patientData->patientname) . "</th>          
            <td>Patient ID :</td>
            <th style='text-align:left;'>"  . ($patientData->patientid) .  "</th>
            </tr>
            <tr>
            <td> Gender / Age :</td>
                <th style='text-align:left;'>" . ($patientData->gender[0]) . ' / ' . ($patientData->age) . ($patientData->age_type) . "</th>
                <td> Referral :</td>
                <th style='text-align:left; text-transform:capitalize'>" . ($referData->referral_name) . "</th>
            </tr>
            </thead>
        </table><table width='100%' class='table' style='margin-top:15px;'>
        <thead>
            <tr>
             <th style='text-align:left;'>S.no</th>
             <th style='text-align:left;'>Test Name</th>
            <th style='text-align:right;'>Test price</th>
           </tr>
        </thead><tbody>";
        $total = 0;

        foreach ($testIDS as $key => $tid) {

            $testData = $this->Outputpdf_model->getTestByID($tid);
            $testName =  $testData[0]->test_name;
            $price =  $testData[0]->amount;
            $total += $testData[0]->amount;
            // header
            $tabledata .= "
                                    <tr>
                                        <td>" . ($key + 1) . "</td>
                                    <td>" . ($testName) . "</td>
                                <td style='text-align:right;'>" . ($price) . ".00</td>
                            </tr>";
        }

        $tabledata .= "
                    <tr>
                        <td colspan='2'>Total</td>
                    <td style='text-align:right;'><b>" . ($total) . ".00</b></td>
                        </tr>
                    <tr>
                    <td colspan='2'>Total Discount (₹) </td>
                    <td style='text-align:right;'><b>" . ($billData->final_discount) . ".00</b></td>
                    </tr>
                    <tr>
                        <td colspan='2'>Total Paid (₹) </td>
                    <td style='text-align:right;'><b>" . ($billData->received_amount) . ".00</b></td>
                    </tr>";

        $number = $total - $billData->final_discount - $billData->received_amount;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        if ($result == '') {
            $result = 'Zero';
        }
        $points = ($point) ?
            "." . $words[$point / 10] . " " .
            $words[$point = $point % 10] : '';
        $tabledata .= "<tr>
                                    <td colspan='3'>Payable Amount (In words) : <b style='text-transform:uppercase;'>" . ($result) . " Rupees only</b></td>
                                    </tr>";



        $mpdf->WriteHTML($tabledata);
        $footer = "</tbody></table><table width='100%' cellspacing='5'>
                                <tfoot>
                                <tr>
                                <td style='height:40px;border:0;'></td>
                                </tr>
                                    <tr>
                                    <td style='width:65%;border:0;'></td>
                                        <td style='height:30px;text-align:center;border:0'  colspan='3'>Signature<br><b>Patidar Diagnostic</b></td>
                                    </tr>
                                </tfoot>
                                </table>
                    </main>";
        $mpdf->WriteHTML($footer);

        $mpdf->Output(); // opens in browser
        // $mpdf->Output('invoice-'.$patientData->patientid.'.pdf','D'); // it downloads the file into the user system, with give name
    }
}
?>