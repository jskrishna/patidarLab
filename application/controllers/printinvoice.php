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

        $testIDS = explode(',', $billData->testId);

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetTitle('Invoice-' . $patientData->patientid);
        $mpdf->SetDefaultFont('Roboto');
        $mpdf->SetAuthor('Patidar Diagnostic');
        $mpdf->SetCreator('Px');
        date_default_timezone_set('Asia/Kolkata');
        $tabledata = "<main>
        <h3>Receipt</h3><hr>
        <table width='100%' cellspacing='5'>
            <thead>
                <tr>
                <td> Name :</td>
                <th>" . ($patientData->title.' '.$patientData->patientname) .' ( '.($patientData->patientid).' )'. "</th>
                </tr>
                <tr>
                <td> Gender / Age :</td>
                <th>" . ($patientData->gender).' / '.($patientData->age).($patientData->age_type). "</th>
                </tr>
                <tr>
                <td> Receipt No :</td>
                <th>" .'00'. ($patientData->id) . "</th>
                </tr>
                <tr>
                <td> Referral :</td>
                <th>" . ($referData->referral_name) . "</th>
                </tr>
                <tr>
                <td>Date & Time :</td>
                <th>" . (date("d-M-Y h:i:s")) . "</th>
                </tr>
            </thead>
        </table><hr><table width='100%'  >
        <thead>
            <tr>
             <th>S.no</th>
             <th>Test Name</th>
            <th>Test price</th>
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
                                        <td>" . ($key+1) . "</td>
                                    <td>" . ($testName) . "</td>
                                <td>" . ($price) . ".00</td>
                            </tr>";
        }
       
        $tabledata .= "
                    <tr>
                        <td style='text-align:center' colspan='2'>Total</td>
                    <td><b>" . ($total) . ".00</b></td>
                        </tr>
                        <tr>
                        <td colspan='2'>Total Paid (Rs.) </td>
                    <td><b>" . ($billData->received_amount) . ".00</b></td>
                    </tr>
                    <tr>
                    <td colspan='2'>Total Discount (Rs.) </td>
                    <td><b>" . ($billData->final_discount) . ".00</b></td>
                    </tr>
                    <tr>
                    <td colspan='2'>Total Amount (Rs.) </td>
                    <td><b>" . ($total - $billData->final_discount - $billData->received_amount) . ".00</b></td>
                    </tr>
                                ";

                                $number = $total - $billData->final_discount - $billData->received_amount;
                            $no = floor($number);
                            $point = round($number - $no, 2) * 100;
                            $hundred = null;
                            $digits_1 = strlen($no);
                            $i = 0;
                            $str = array();
                            $words = array('0' => '', '1' => 'one', '2' => 'two',
                                '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                '13' => 'thirteen', '14' => 'fourteen',
                                '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                                '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                '60' => 'sixty', '70' => 'seventy',
                                '80' => 'eighty', '90' => 'ninety');
                            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                            while ($i < $digits_1) {
                                $divider = ($i == 2) ? 10 : 100;
                                $number = floor($no % $divider);
                                $no = floor($no / $divider);
                                $i += ($divider == 10) ? 1 : 2;
                                if ($number) {
                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                    $str [] = ($number < 21) ? $words[$number] .
                                        " " . $digits[$counter] . $plural . " " . $hundred
                                        :
                                        $words[floor($number / 10) * 10]
                                        . " " . $words[$number % 10] . " "
                                        . $digits[$counter] . $plural . " " . $hundred;
                                } else $str[] = null;
                            }
                            $str = array_reverse($str);
                            $result = implode('', $str);
                            if($result == ''){
                            $result = 'Zero';
                            }
                            $points = ($point) ?
                                "." . $words[$point / 10] . " " . 
                                    $words[$point = $point % 10] : '';
                                    $tabledata .= "<tr>
                                    <td colspan='3'>Payable Amount (in words) : ".( $result)." Rupees only</td>
                                    </tr>";
                            


        $mpdf->WriteHTML($tabledata);
        $footer = "</tbody></table><table width='100%' cellspacing='5'>
                                <tfoot>
                                    <tr >
                                        <td style='height:30px'  colspan='3'>Signature<br><b>Patidar Diagnostic</b></td>
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