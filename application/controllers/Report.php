<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function index()
    {
        $loggedInId = $_SESSION['loggedInId'];
        $testData = $this->Report_model->gettestinfo();
        $departmentData = $this->Report_model->getdepartmentinfo();
        $doctorsData = $this->Report_model->getdoctorsinfo();
        $loggedData = $this->Report_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if ($loggedData->role == 'admin') {
            $labid = $loggedData->id;
        } else {
            $labid = $loggedData->user_id;
        }
        $reportData = $this->Report_model->getbillinfo($labid);
        $patientData = $this->Report_model->getPatientinfo($labid);

        $data = array('reportData' => $reportData, 'loggedData' => $loggedData, 'patientData' => $patientData, 'testData' => $testData, 'departmentData' => $departmentData, 'doctorsData' => $doctorsData, 'pxthis' => $this);
        $this->load->view('report/index.php', $data);
    }
    public function add_value($id)
    {
        $loggedInId = $_SESSION['loggedInId'];
        $loggedData = $this->Report_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];

        $billData = $this->Report_model->getbillinfoByID($id);
        $referedData = $this->Report_model->getreferedData();
        $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);
        $doctorData = $this->Report_model->getdoctorinfoByID($billData[0]->patientRef);
        $testData = $this->Report_model->gettestinfo();
        $parameterData = $this->Report_model->getparameterinfo();
        $unitData = $this->Report_model->getunitinfo();
        $reportData = $this->Report_model->getreportDatainfo($id);

        $data = array('reportData' => $reportData, 'loggedData' => $loggedData, 'patientData' => $patientData[0], 'referedData' => $referedData, 'unitData' => $unitData, 'billData' => $billData[0], 'testData' => $testData, 'doctorData' => $doctorData[0], 'parameterData' => $parameterData, 'pxthis' => $this);
        $this->load->view('report/add_value.php', $data);
    }

    public function saveReportvalue()
    {
        $parameter_id = $this->input->post('parameter_id');
        $inputValue = $this->input->post('inputValue');
        $highlight = $this->input->post('highlight');

        if (isset($parameter_id)) {

            $parameter_ids = serialize($parameter_id);
            $input_values = serialize($inputValue);
            $highlights = serialize($highlight);

            $patient_id = $this->input->post('patientID');
            $test_id = $this->input->post('testId');
            $bill_id = $this->input->post('billId');
            $defult_value_status = $this->input->post('defult_value_status');
            $reportDataid = $this->input->post('reportDataid');
            if ($reportDataid == '') {
                $insertData = $this->Report_model->insertReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $highlights, $defult_value_status);
            } else {
                $insertData = $this->Report_model->updateReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $highlights, $defult_value_status, $reportDataid);
            }

            if ($insertData) {
                $resultss = array('success' => 1, 'msg' => 'success', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            } else {
                $resultss = array('success' => 0, 'msg' => 'something wrong');
                echo json_encode($resultss);
                exit();
            }
        } else {
            $resultss = array('success' => 0, 'msg' => 'No parameter found.');
            echo json_encode($resultss);
            exit();
        }
    }
    public function bill_settle()
    {
        $id = $this->input->post('id');
        $billData = $this->Report_model->getbillinfoByID($id);
        $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);

        $billData = $billData[0];
        $patientData = $patientData[0];
        $date = date_format(new DateTime($billData->billDate), 'd-M-Y');
        $balance = intval($billData->total) - intval($billData->received_amount) - intval($billData->final_discount);
        $discount = intval($billData->final_discount) + intval($billData->discount);
        $advance = intval($billData->advance);
        $final_discount = intval($billData->final_discount);

        $advancepri = intval($billData->received_amount);
        $data = "<div class='page-head'><h2 id='billname'>" . $patientData->title . ' ' . $patientData->patientname . ' (' . ($patientData->patientid) . ')' . "</h2><button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'><img src='" . BASE_URL . "/public/assets/images/remove.svg.' alt=''>
        </button>
    </div><div class='modal-body'>
                    <div class='row'>
                        <div class='form-group col-lg-6'>Bill No <b>: 00$billData->id <input type='hidden' name='bill_id' id='bill_id' value='$billData->id'></b></div>
                        <div class='form-group col-lg-6 text-right'>Bill Date : <b class='font-weight-bold bill_settle_date'>$date</b></div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-12'>
                        <div class='c-datatable pd-0'>                      
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th>Total Amount</th>
                                    <th>Discount</th>
                                    <th>Advance</th>
                                    <th>Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>₹ $billData->total </td>
                                    <td>₹ $discount </td>
                                    <td>₹ $advancepri </td>
                                    <td style='color:#dc3545'><b>₹ $balance</b> </td>
                                </tr>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                    <div class='form-group '>
                    <label >Receive Amount (₹)</label>
                    <input type='hidden' value='$advancepri' name='previous_amount' id='previous_amount'>
                    <input type='number' placeholder='Enter Received Amount' min='0' max='$balance' name='balance_received' id='balance_received' class='form-control' value=>
                    </div>
                    <div class='form-group'>
                            <label>Payment Mode</label>
                            <div class='radio-wrap'>
                                <span class='radio-group'>
                                    <input type='radio' id='payment_cash' name='payment_mode' value='Cash' checked>
                                    <label for='payment_cash'>
                                        <span>
                                        Cash 
                                        </span>
                                    </label>
                                </span>
                                <span class='radio-group'>
                                    <input type='radio' id='payment_upi' name='payment_mode' value='UPI'>
                                   <label for='payment_upi'>
                                       <span>
                                   UPI 
                                   </span>
                                </label>
                                </span>
                            </div>
                            <input type='hidden' name='add_discount' id='add_discount' value=''>
                            <input type='hidden' name='balance' id='balance' value='$billData->total'>
                            <input type='hidden' name='final_discount' id='final_discount' value='$final_discount'>
                            </div>
                            <div class='form-group'>
                            <div class='check-group'>
                            <input type='checkbox' name='markaspaid' id='markaspaid' value='Yes'>
                                                    <label for='markaspaid'>Mark as Paid</label>
                                                </div>
                            </div>
                    </div>
                    <div class='modal-footer'>
                        <div class='col-lg-3'><button class='btn custom-btn btnupdate btn-block' id='postValue'>Pay</button></div>
                    </div>";
        echo $data;
    }

    public function orderReport($id)
    {
        if ($id) {
            $loggedInId = $_SESSION['loggedInId'];
            $loggedData = $this->Report_model->getuserbyID($loggedInId);
            $loggedData = $loggedData[0];

            $billData = $this->Report_model->getbillinfoByID($id);
            $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);
            $doctorsData = $this->Report_model->getdoctorinfoByID($patientData[0]->refered_by);
            $data = array('billData' => $billData[0], 'loggedData' => $loggedData, 'patientData' => $patientData[0], 'doctorsData' => $doctorsData[0], 'pxthis' => $this);
            $this->load->view('report/orderReport.php', $data);
        } else {
            header('location:' . BASE_URL . 'report');
        }
    }
    public function paid_details()
    {

        $bill_id = $this->input->post('id');
        $billData = $this->Report_model->getbillinfoByID($bill_id);
        $billData = $billData[0];

        $patient_id = $billData->patient_id;
        $patientData = $this->Report_model->getpatientinfoByID($patient_id);
        $patientData = $patientData[0];

        $referData = $this->Report_model->getdoctorinfoByID($patientData->refered_by);
        $referData = $referData[0];

        $testIDS = explode(',', $billData->testId);
        date_default_timezone_set('Asia/Kolkata');
        $tabledata = "<div class='page-head'><h2 id='billname'>" . $patientData->title .  $patientData->patientname . ' (' . ($patientData->patientid) . ')' . "</h2><button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'><img src='" . BASE_URL . "/public/assets/images/remove.svg.' alt=''>
        </button>
    </div><div class='modal-body'>
    <div class='row'>
                        <div class='form-group col-lg-6'>Bill No <b>" . '00' . ($patientData->id) . "</b></div>
                        <div class='form-group col-lg-6 text-right'>Bill Date : <b class='font-weight-bold '>" . (date("d-M-Y h:i:s")) . "</b></div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-12'>
                        <div class='c-datatable'>
                    <table width='100%' class='table'>
        <thead>
            <tr>
             <th>S.no</th>
             <th>Test Name</th>
            <th>Test price</th>
           </tr>
        </thead><tbody>";
        $total = 0;

        foreach ($testIDS as $key => $tid) {

            $testData = $this->Report_model->getTestByID($tid);
            $testName =  $testData[0]->test_name;
            $price =  $testData[0]->amount;
            $total += $testData[0]->amount;
            $tabledata .= "<tr>
                            <td>" . ($key + 1) . "</td>
                            <td>" . ($testName) . "</td>
                            <td>" . ($price) . ".00</td>
                        </tr>";
        }

        $tabledata .= "<tr>
        <td></td>
                        <td>Total</td>
                        <td><b>" . ($total) . ".00</b></td>
                    </tr>
                    <tr>
                    <td></td>
                        <td>Total Paid (Rs.) </td>
                        <td><b>" . ($billData->received_amount) . ".00</b></td>
                    </tr>
                    <tr>
                    <td></td>
                        <td>Total Discount (Rs.) </td>
                        <td><b>" . ($billData->final_discount) . ".00</b></td>
                    </tr>
                    <tr>
                    <td></td>
                        <td>Remaining Amount (Rs.) </td>
                        <td><b>" . ($total - $billData->final_discount - $billData->received_amount) . ".00</b></td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div></div>
                    <div class='modal-footer'>
                    <a target='_blank'  href='invoice/index/" . $billData->id . "' class='btn custom-btn btnupdate'>Print
                </a>
                    </div>";

        echo $tabledata;
    }
    public function authoriseStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $bill_id = $this->input->post('bill_id');
        if ($status == '') {
            $status = null;
            $msg = 'Unauthorised.';
        } else {
            $msg = 'Authorised.';
        }

        $check = $this->Report_model->getReportByTestId($id, $bill_id);
        if (!empty($check)) {
            $authoriseStatus = $this->Report_model->changeauthoriseStatus($id, $bill_id, $status);
            if ($authoriseStatus) {
                $resultss = array('success' => 1, 'msg' => $msg);
                echo json_encode($resultss);
                exit();
            } else {
                $resultss = array('success' => 0, 'msg' => 'Something went wrong.');
                echo json_encode($resultss);
                exit();
            }
        } else {
            $resultss = array('success' => 0, 'msg' => 'No data found for this test.');
            echo json_encode($resultss);
            exit();
        }
    }
    public function getServerSide()
    {

        $limit = $this->input->get('length');
        $offset = $this->input->get('start');

        $loggedInId = $_SESSION['loggedInId'];
        $testData = $this->Report_model->gettestinfo();
        $doctorsData = $this->Report_model->getdoctorsinfo();
        $loggedData = $this->Report_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if ($loggedData->role == 'admin') {
            $labid = $loggedData->id;
        } else {
            $labid = $loggedData->user_id;
        }
        $search = $this->input->get('search');

        $search = $search['value'];

        if (empty($search) || $search == 'completed' || $search == 'pending') {
            $patientData = $this->Report_model->getPatientinfo($labid);
            $totalFiltered = $this->Report_model->getInfoTotal($labid);
            $totalFiltered = count($totalFiltered);

            if($search == 'completed' || $search == 'pending'){
                $limit = -1;
                $offset = 0;
            }

            $posts = $this->Report_model->getPatientbillINFO($limit, $offset, $labid);
        } else {
            $patientData = $this->Report_model->getPatientinfowithSearch($labid, $search);
            $Ids = [];
            foreach ($patientData as $data) {
                $Ids[] = $data->id;
            }
            if (empty($Ids)) {
                $Ids[] = 0;
            }
            $totalFiltered = $this->Report_model->getInfoTotalAndpatientID($labid, $Ids);
            $totalFiltered = count($totalFiltered);
            $posts = $this->Report_model->getPatientbillINFOwithSearch($limit, $offset, $labid, $Ids);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                foreach ($patientData as $patient) {
                    if ($patient->id == $post->patient_id) {

                        $name = '<div class="ava-r">
                   <span>' . "$patient->patientname" . '</span>
                     <div>' . ($patient->gender[0]) . ' / ' . ($patient->age) . ' ' . ($patient->age_type) . '</div>
                </div>';

                        $ymd = date_format(new DateTime($post->billDate), "Ymd");
                        $dmy = date_format(new DateTime($post->billDate), "d-M-Y");
                        $hia = date_format(new DateTime($post->billDate), "h:i A");

                        $testIDs = explode(',', $post->testId);
                        $printed = '';
                        $pending = '';
                        $filed = '';
                        $authorized = '';
                        $dCount = $pCount = $rCount = 0;
                        foreach ($testIDs as $id) {
                            $testData = $this->Report_model->getTestByID($id);
                            $reportValues = $this->Report_model->getreportDataByBIllandTestId($post->id, $id);
                            if (count($reportValues) > 0 && $reportValues[0]->status == 'authorised' && $reportValues[0]->printed > 0) {
                                $printed .= '<label>' . $testData[0]->test_name . '</label>';
                                $dCount += 1;
                            } else if (count($reportValues) > 0 && $reportValues[0]->status == 'authorised') {

                                $authorized .= '<label>' . $testData[0]->test_name . '</label>';
                                $rCount += 1;
                            } else if (count($reportValues) > 0) {

                                $filed .= '<label>' . $testData[0]->test_name . '</label>';
                                $rCount += 1;
                            } else {
                                $pending .=  '<label>' . $testData[0]->test_name . '</label>';
                                $pCount += 1;
                            }
                            $reportValues = null;
                        }

                        if ($post->status == 'Paid') {
                            $am = '<span class="pay-received">Received - ₹ ' . intval($post->received_amount);
                            '</span>';
                        } else {
                            $am = '<span class="pay-paid">Total - ₹ ' . intval($post->total);
                            '</span>
        <span class="pay-due">Due - ₹ ' . intval($post->total) . '-' . intval($post->received_amount) . '-' . intval($post->final_discount);
                            '</span>';
                        }
                        $amount = $am;

                        foreach ($doctorsData as $doc) {
                            if ($doc->id == $post->patientRef) {
                                $ref =  isset($doc->title) ? $doc->title : '';
                                $ref .= ' ' . $doc->referral_name;
                            }
                        }

                        $status = '<span class="test-process test-success">' . $printed . '</span><span class="test-process test-authorised text-danger">' . $authorized . '
                    </span><span class="test-process text-primary">' . $filed . '</span><span class="test-process test-pending">' . $pending . '</span>';
                        $testIDs = explode(',', $post->testId);
                        $reportcount = $this->Report_model->getReportByBillAndPatientId($post->id, $post->patient_id);

                        $reportStatus =  count($testIDs) == count($reportcount) ? 'completed' : 'pending';

                        $payment = ($post->status == 'Pending') ? '<button data-toggle="tooltip" data-placement="top" title="Pay Bill" class="patientedit-btn bill_settle btn-pay" data-status="Pending" data-id="' . ($post->id) . '" value="' . ($post->id) . '" id="status' . ($post->id) . '" data-bs-toggle="modal" data-bs-target="#bill_settlement">
                    Pay</button>' : '<span class="bill_paid bill_settle btn-paid" data-status="Paid" data-id="' . ($post->id) . '" value="' . ($post->id) . '" id="status' . ($post->id) . '">
                    Paid
                </span>';

                        $print = ' <a data-toggle="tooltip" data-placement="top" title="Print Invoice" target="_blank" href="printinvoice/index/' . ($post->id) . '" class="btn btn-sml btnupdate print-invoice-btn" data-id="' . ($post->id) . '" data-bs-toggle="modal" data-bs-target="#printReport">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                    <defs>
                        <clipPath id="a">
                            <path d="M14.5,18h-9a2,2,0,0,1-2-2H2.637A2.655,2.655,0,0,1,0,13.333V6.667A2.655,2.655,0,0,1,2.637,4H4V2A1.924,1.924,0,0,1,5.833,0h8.334A1.924,1.924,0,0,1,16,2V4h1.363A2.655,2.655,0,0,1,20,6.667v6.665A2.655,2.655,0,0,1,17.363,16H16.5A2,2,0,0,1,14.5,18Zm-9-6v4h9l0-4ZM6.014,2,6.007,4H14V2Z" transform="translate(2 3)" fill="#223345" />
                        </clipPath>
                    </defs>
                    <path d="M14.5,18h-9a2,2,0,0,1-2-2H2.637A2.655,2.655,0,0,1,0,13.333V6.667A2.655,2.655,0,0,1,2.637,4H4V2A1.924,1.924,0,0,1,5.833,0h8.334A1.924,1.924,0,0,1,16,2V4h1.363A2.655,2.655,0,0,1,20,6.667v6.665A2.655,2.655,0,0,1,17.363,16H16.5A2,2,0,0,1,14.5,18Zm-9-6v4h9l0-4ZM6.014,2,6.007,4H14V2Z" transform="translate(2 3)" fill="#223345" />
                </svg>
            </a>';

                        $liOne = ($loggedData->role != 'staff') ? '<li>
                        <a data-toggle="tooltip" data-placement="top" title="Edit Report" href="report/add_value/' . ($post->id) . '" class="btn btn-sml patientedit-btn btnupdate">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                    <clipPath id="a">
                                        <path d="M1,16a1,1,0,0,1-1-1.091l.379-4.17A1.972,1.972,0,0,1,.952,9.524l5.579-5.58L5.293,2.705A1,1,0,1,1,6.707,1.292L7.945,2.53l2-2A1.818,1.818,0,0,1,11.243,0a2,2,0,0,1,1.42.6L15.4,3.335a2,2,0,0,1,.6,1.42A1.814,1.814,0,0,1,15.47,6.05l-2,2,1.238,1.239a1,1,0,1,1-1.414,1.414L12.054,9.466l-5.58,5.579a1.969,1.969,0,0,1-1.212.571l-4.171.379C1.063,16,1.034,16,1,16ZM7.945,5.358h0l-5.579,5.58,5.485-.088,2.79-2.8-2.7-2.7Z" transform="translate(4 4.002)" fill="#223345" />
                                    </clipPath>
                                </defs>
                                <path d="M1,16a1,1,0,0,1-1-1.091l.379-4.17A1.972,1.972,0,0,1,.952,9.524l5.579-5.58L5.293,2.705A1,1,0,1,1,6.707,1.292L7.945,2.53l2-2A1.818,1.818,0,0,1,11.243,0a2,2,0,0,1,1.42.6L15.4,3.335a2,2,0,0,1,.6,1.42A1.814,1.814,0,0,1,15.47,6.05l-2,2,1.238,1.239a1,1,0,1,1-1.414,1.414L12.054,9.466l-5.58,5.579a1.969,1.969,0,0,1-1.212.571l-4.171.379C1.063,16,1.034,16,1,16ZM7.945,5.358h0l-5.579,5.58,5.485-.088,2.79-2.8-2.7-2.7Z" transform="translate(4 4.002)" fill="#223345" />
                            </svg>
                        </a>
                    </li>' : '';

                        $linTwo = ($loggedData->role != 'staff') ? '<li><a data-toggle="tooltip" data-placement="top" title="View Test" href="bill?bill=' . ($post->id) . '" class="btn btn-sml btnupdate btn-report">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                    <defs>
                        <clipPath id="a">
                            <path d="M10.025,14C4.163,14,.756,8.585.132,7.5a1.009,1.009,0,0,1,0-1C.987,5.015,4.205.146,9.729,0c.1,0,.2,0,.294,0,5.813,0,9.221,5.418,9.846,6.5a1.014,1.014,0,0,1,0,1c-.855,1.489-4.073,6.358-9.6,6.5ZM10,3.5A3.5,3.5,0,1,0,13.5,7,3.5,3.5,0,0,0,10,3.5Zm0,5A1.5,1.5,0,1,1,11.5,7,1.5,1.5,0,0,1,10,8.5Z" transform="translate(2 4.998)" fill="#223345" />
                        </clipPath>
                    </defs>
                    <path d="M10.025,14C4.163,14,.756,8.585.132,7.5a1.009,1.009,0,0,1,0-1C.987,5.015,4.205.146,9.729,0c.1,0,.2,0,.294,0,5.813,0,9.221,5.418,9.846,6.5a1.014,1.014,0,0,1,0,1c-.855,1.489-4.073,6.358-9.6,6.5ZM10,3.5A3.5,3.5,0,1,0,13.5,7,3.5,3.5,0,0,0,10,3.5Zm0,5A1.5,1.5,0,1,1,11.5,7,1.5,1.5,0,0,1,10,8.5Z" transform="translate(2 4.998)" fill="#223345" />
                </svg>
            </a></li>' : '';

                        $lithree = '<li>
                            <a data-toggle="tooltip" data-placement="top" title="Print Report" href="report/orderReport/' . ($post->id) . '" class="btn btn-sml btn-print">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24">
                                    <defs>
                                        <clipPath id="a">
                                            <path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345" />
                                        </clipPath>
                                    </defs>
                                    <path d="M3,20a3,3,0,0,1-3-3V5A3,3,0,0,1,3,2V5A2,2,0,0,0,5,7h8a2,2,0,0,0,2-2V2a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3ZM5,6A1,1,0,0,1,4,5V1A1,1,0,0,1,5,0h8a1,1,0,0,1,1,1V5a1,1,0,0,1-1,1Z" transform="translate(3 2)" fill="#223345" />
                                </svg>
                            </a>
                        </li>';


                        $action = '<ul class="action-list">' . ($liOne . $linTwo . $lithree) . '</ul>';

                        $nestedData['id'] = $post->id;
                        $nestedData['name'] = $name;
                        $nestedData['reportdate'] = '<span class="nowwrap-text"><p style="display: none;">' . "$ymd" . '</p>' . "$dmy" . '<br>' . "$hia" . '</span>';
                        $nestedData['amount'] = $amount;
                        $nestedData['referral'] = $ref;
                        $nestedData['test_status'] = $status;
                        $nestedData['report_status'] = $reportStatus;
                        $nestedData['payment'] = $payment;
                        $nestedData['print'] = $print;
                        $nestedData['action'] = $action;
                        $data[] = $nestedData;
                    }
                }
            }
        }

        if ($search == 'completed' || $search == 'pending') {
            $obj = $data;
            $data = [];
            $searchField = "report_status";
            $searchVal = $search;

            for ($i = 0; $i < count($obj); $i++) {
                if ($obj[$i][$searchField] == $searchVal) {
                    $data[] = $obj[$i];
                }
            }
            $totalFiltered = count($data);
        }

        $json_data = array(
            "draw"            => intval($this->input->get('draw')),
            "recordsTotal"    => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
