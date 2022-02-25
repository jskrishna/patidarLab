<!-- /*
* Author: onlinecode
* start tcpdfexample.php file
* Location: ./application/controllers/tcpdfexample.php
*/ -->
<?php class tcpdfexample extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('Outputpdf_model');

    }

    function index()
    {
        // coder for CodeIgniter TCPDF Integration
        $tcpdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // Set Title
        $tcpdf->SetTitle('Report');
        // Set Header Margin
        $tcpdf->SetHeaderMargin(60);
        // Set Top Margin
        $tcpdf->SetTopMargin(60);
        // set Footer Margin
        $tcpdf->setFooterMargin(60);
        // Set Auto Page Break
        $tcpdf->SetAutoPageBreak(true);
        // Set Author
        $tcpdf->SetAuthor('Px');
        $tcpdf->SetCreator('Patidar Diagnostic');
        // Set Display Mode
        // $tcpdf->SetDisplayMode('real', 'default');
        $tcpdf->SetDisplayMode('fullpage');
        $tcpdf->AddPage();
     
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
        $selecetdtestArray = explode(',',$tests);

        $html = "<table width='100%' cellspacing='5'>
        <thead>
            <tr>
                <th align='left'>
                    <b> Name:</b>
                </th>
                <td>".$patientData->patientname."</td>
            </tr>
            <tr>

                <th align='left'>
                    <b> Patient no:</b>
                </th>
                <td>
                    ".$patientData->patientid."
                </td>
            </tr>
            <tr>
                <th align='left'>
                    <b> Age/gender:</b>
                </th>
                <td>
                    ".$patientData->age."
                </td>
            </tr>
            <tr>
                <th align='left'>
                    <b> refer:</b>
                </th>
                <td>
                    ".$doctorData->referral_name."
                </td>
            </tr>
            <tr>
                <th align='left'>
                    <b>Date</b>
                </th>
                <td>
                    ".$billData->billDate."
                </td>
            </tr>
            <tr>
        </thead>
    </table>
        
        <table width='100%' cellspacing='5'>
                                <tbody>
                                    <tr>
                                        <th>Test Description</th>
                                        <th>RESULT</th>
                                        <th>Reference Range</th>
                                    </tr>
                                    <tr>
                                    <td>Px</td>
                                    <td>120</td>
                                    <td>100-150</td>
                                </tr>
                                    </tbody></table>";
       
        $tcpdf->WriteHTML($html);
        ob_end_clean();
        
        // Set Output and file name
        $tcpdf->Output('Report.pdf', 'I');
        // $tcpdf->Output('Report.pdf', 'D');
    }
    public function advancetcpdf_example()
    {
        // coder for CodeIgniter TCPDF Integration
        // make new advance pdf document
        $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        $tcpdf->SetAuthor('Muhammad Saqlain Arif');
        $tcpdf->SetTitle('TCPDF Example 001');
        $tcpdf->SetSubject('TCPDF Tutorial');
        $tcpdf->SetKeywords('TCPDF, PDF, example, test, guide');

        //set default header information

        $tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 65, 256), array(0, 65, 127));
        $tcpdf->setFooterData(array(0, 65, 0), array(0, 65, 127));

        //set header  textual styles
        $tcpdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //set footer textual styles
        $tcpdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        //set default monospaced textual style
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set default margins
        $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // Set Header Margin
        $tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        // Set Footer Margin
        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto for page breaks
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image for scale factor
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // it is optional :: set some language-dependent strings
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            // optional
            require_once(dirname(__FILE__) . '/lang/eng.php');
            // optional
            $tcpdf->setLanguageArray($l);
        }

        // set default font for subsetting mode
        $tcpdf->setFontSubsetting(true);

        // Set textual style
        // dejavusans is an UTF-8 Unicode textual style, on the off chance that you just need to
        // print standard ASCII roasts, you can utilize center text styles like
        // helvetica or times to lessen record estimate.
        $tcpdf->SetFont('dejavusans', '', 14, '', true);

        // Add a new page
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->AddPage();

        // set text shadow for effect
        $tcpdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 197, 198), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // /Set some substance to print

        $set_html = <<<EOD
 
 
<h1>Welcome to <a href='http://www.tcpdf.org' style='text-decoration:none;background-color:#CC0001;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF Example</span>&nbsp;</a>!</h1>
 
<i>This is the principal case of TCPDF library.</i>
 
 
This content is printed utilizing the <i>writeHTMLCell()</i> strategy however you can likewise utilize: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.
 
 
 
Please check the source code documentation and different cases for further information.
 
 
EOD;

        //Print content utilizing writeHTMLCell()
        $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
        ob_end_clean();
        // Close and yield PDF record
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->Output('tcpdfexample-onlinecode.pdf', 'I');
        // successfully created CodeIgniter TCPDF Integration
    }
}
/* end tcpdfexample.php file for CodeIgniter TCPDF Integration */
?>