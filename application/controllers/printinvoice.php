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
        if(!isset($bill_id)){
            header('location:' . BASE_URL . 'login');
        }
        $billData = $this->Outputpdf_model->getbillinfoByID($bill_id);
        $billData = $billData[0];

        $patient_id = $billData->patient_id;
        $patientData = $this->Outputpdf_model->getpatientinfoByID($patient_id);
        $patientData = $patientData[0];

        $referData = $this->Outputpdf_model->getdoctorinfoByID($patientData->refered_by);
        $referData = $referData[0];
        $headerImage = BASE_URL . 'public/assets/images/Letter_pad.png';

        $testIDS = explode(',', $billData->testId);
        require_once 'vendor/autoload.php';

        $format = $_GET['format'];

        if ($format == '3') {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [75, 190],
                'default_font' => 'dejavusans',
                'margin_header' => 0,
                'margin_footer' => 0,
                'default_font_size' => 9,
                'margin_bottom' => 0,
                'margin_top' => 10,
                'margin_left' => 2,
                'margin_right' => 2,
            ]);
        } else {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'default_font' => 'dejavusans',
            ]);

            $header =  $_GET['header'];
            if (isset($header) && $header == 'true') {
                $mpdf->SetDefaultBodyCSS('background', "url('" . $headerImage . "')");
                $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
            }
        }

        $mpdf->SetTitle('Invoice-' . $patientData->patientid);
        date_default_timezone_set('Asia/Kolkata');

        if ($format == '3') {
            $tabledata = "<style>
            td, th {
                border-bottom: 0;
                padding: 3px 5px !important;
                white-space:nowrap;
            }
            .table {
                border-collapse:collapse;
                border:0;
            }
            .table td, .table th, .table tbody td, .table tbody th {
                padding:3px 5px;
            }
            </style>";
            $tabledata .= " <table width='100%' cellspacing='2' class='table'>
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
            <td>ID :</td>
            <th style='text-align:left;'>"  . ($patientData->patientid) .  "</th>
            </tr>
            <tr>
            <td> Gender / Age :</td>
                <th style='text-align:left;'>" . ($patientData->gender[0]) . ' / ' . ($patientData->age) . ($patientData->age_type) . "</th>
                <td> Referral Dr :</td>
                <th style='text-align:left; text-transform:capitalize'>" . ($referData->referral_name) . "</th>
            </tr>
            </thead>
        </table>";
        } else {
            $tabledata = "<style>
        td, th {
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 11px !important;
            font-size: 12px;
        }
        .table {
            border-collapse:collapse;
            border:1px solid #e0e0e0;
        }
        .table td, .table th, .table tbody td, .table tbody th {
            padding:3px 7px;
            font-size:12px;
        }
        </style>";
            $tabledata .= "
        <main>
        <table width='100%' cellspacing='2' border:'0'>
                    <thead>
                        <tr>
                        <td style='height:100px;border:0;' colspan='2'></td>
                        </tr>
                        </thead>
                        </table>
        <h3 style='margin:0;margin-bottom:20px;text-align:center;'>Bill Receipt</h3>
        <table width='100%' cellspacing='2' class='table' style='font-size:18px;'>
            <thead>
            <tr>
            <td> Name : <b style='text-transform:capitalize'>" . ($patientData->title . ' ' . $patientData->patientname) . "</b></td>          
            <td> Receipt No :<b>" . '00' . ($patientData->id) . "</b></td>        
            </tr>
            <tr>
            <td style=''>Date & Time : <b>" . (date("d-M-Y h:i:s")) . "</b></td>         
            <td> Gender / Age : <b>" . ($patientData->gender[0]) . ' / ' . ($patientData->age) . ($patientData->age_type) . "</b></td>
            </tr>
            <tr>
            <td>ID : <b>"  . ($patientData->patientid) .  "</b></td>
                <td> Referral Dr : <b>" . ($referData->referral_name) . "</b></td>
            </tr>
            </thead>
        </table>";
        }

        $tabledata .= " <table width='100%' class='table' style='margin-top:15px;'>
        <thead>
            <tr>
             <th style='text-align:left; width:30px;' >S.no</th>
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
                                        <td style='width:30px;'>" . ($key + 1) . "</td>
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
        $footer = "</tbody></table><table class='table' width='100%' cellspacing='5'>
                                <tfoot>
                                <tr>
                                <td style='height:30px;border:0;'></td>
                                </tr>
                                    <tr>
                                    <td style='width:65%;border:0;'></td>
                                        <td style='text-align:center;border:0;font-size:11px'  colspan='3'>Signature<br><b>Patidar Diagnostic</b></td>
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