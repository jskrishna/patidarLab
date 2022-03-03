<?php

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function index()
    {
        $reportData = $this->Report_model->getbillinfo();
        $patientData = $this->Report_model->getPatientinfo();
        $testData = $this->Report_model->gettestinfo();
        $departmentData = $this->Report_model->getdepartmentinfo();
        $doctorsData = $this->Report_model->getdoctorsinfo();

        $data = array('reportData' => $reportData, 'patientData' => $patientData, 'testData' => $testData, 'departmentData' => $departmentData, 'doctorsData' => $doctorsData, 'pxthis' => $this);
        $this->load->view('report/index.php', $data);
    }
    public function add_value($id)
    {
        $billData = $this->Report_model->getbillinfoByID($id);
        $referedData = $this->Report_model->getreferedData();
        $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);
        $doctorData = $this->Report_model->getdoctorinfoByID($billData[0]->patientRef);
        $testData = $this->Report_model->gettestinfo();
        $parameterData = $this->Report_model->getparameterinfo();
        $unitData = $this->Report_model->getunitinfo();
        $reportData = $this->Report_model->getreportDatainfo($id);

        $data = array('reportData' => $reportData, 'patientData' => $patientData[0], 'referedData' => $referedData, 'unitData' => $unitData, 'billData' => $billData[0], 'testData' => $testData, 'doctorData' => $doctorData[0], 'parameterData' => $parameterData, 'pxthis' => $this);
        $this->load->view('report/add_value.php', $data);
    }

    public function saveReportvalue()
    {
        $parameter_id = $this->input->post('parameter_id');
        $inputValue = $this->input->post('inputValue');
        $highlight = $this->input->post('highlight');

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
    }
    public function bill_settle()
    {
        $id = $this->input->post('id');
        $billData = $this->Report_model->getbillinfoByID($id);
        $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);

        $billData = $billData[0];
        $patientData = $patientData[0];
        $date = date_format(new DateTime($billData->billDate), 'd-M-Y');
        $balance = intval($billData->balance) - intval($billData->advance);
        $discount = intval($billData->final_discount) + intval($billData->discount);
        $final_discount = intval($billData->final_discount);

        $data = "<div class='page-head'><h2 id='billname'>".$patientData->title.  $patientData->patientname . ' (' . ($patientData->patientid) . ')'."</h2><button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'><img src='".BASE_URL."/public/assets/images/remove.svg.' alt=''>
        </button>
    </div><div class='modal-body'>
                    <div class='row'>
                        <div class='form-group col-lg-6'>Bill No <b>: 00$billData->id <input type='hidden' name='bill_id' id='bill_id' value='$billData->id'></b></div>
                        <div class='form-group col-lg-6 text-right'>Bill Date : <b class='font-weight-bold bill_settle_date'>$date</b></div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-12'>
                        <div class='c-datatable'>
                        
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th>Bill Amount</th>
                                    <th>Discount</th>
                                    <th>Payable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>$billData->total</td>
                                    <td>$discount</td>
                                    <td>$billData->balance</td>
                                </tr>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                    <div class='form-row'>
                            <span class='small-heading'>Payment Mode</span>
                            <div class='radio-wrap'>
                                <span class='radio-group'>
                                    <input type='radio' id='payment_due' name='payment_mode' value='Due' checked>
                                    <label for='payment_due'>
                                        <span>
                                        Due 
                                        </span>
                                    </label>
                                </span>
                                <span class='radio-group'>
                                    <input type='radio' id='payment_cash' name='payment_mode' value='Cash'>
                                    <label for='payment_cash'>
                                        <span>
                                        Cash 
                                        </span>
                                    </label>
                                </span>
                                <span class='radio-group'>
                                    <input type='radio' id='payment_upi' name='payment_mode' value='PhonePe'>
                                   <label for='payment_upi'>
                                       <span>
                                   UPI 
                                   </span>
                                </label>
                                </span>
                            </div>
                            <input type='hidden' placeholder='Enter received amount' name='balance_received' id='balance_received' class='form-control' value='$balance'>
                            <input type='hidden' name='add_discount' id='add_discount' value=''>
                    </div>
                    </div>
                    <div class='modal-footer'>
                        <div class='col-lg-2'><button class='btn custom-btn btnupdate btn-block' id='postValue'>Pay</button></div>
                    </div>";
        echo $data;
    }

    public function orderReport($id)
    {
        if ($id) {

            $billData = $this->Report_model->getbillinfoByID($id);
            $patientData = $this->Report_model->getpatientinfoByID($billData[0]->patient_id);
            $doctorsData = $this->Report_model->getdoctorinfoByID($patientData[0]->refered_by);
            $data = array('billData' => $billData[0], 'patientData' => $patientData[0], 'doctorsData' => $doctorsData[0], 'pxthis' => $this);
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
        $tabledata = "<div class='page-head'><h2 id='billname'>".$patientData->title.  $patientData->patientname . ' (' . ($patientData->patientid) . ')'."</h2><button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'><img src='".BASE_URL."/public/assets/images/remove.svg.' alt=''>
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
                    <a target='_blank'  href='printinvoice/index/".$billData->id."' class='btn custom-btn btnupdate'>Print
                </a>
                    </div>";

        echo $tabledata;
    }
}
