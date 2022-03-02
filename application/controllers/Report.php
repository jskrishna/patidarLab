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

        $data = "<div class='modal-body'><div class='container'>
                    <div class='form-row'>
                        <div class='form-group col-lg-12'>
                            <h5 id='billname'>$patientData->patientname</h5>
                            <button type='button' class='close text-danger font-weight-bold' data-bs-dismiss='modal'>×</button>
                        </div>
                    </div>
                    <div class='form-row '>
                        <div class='form-group col-lg-1'>Bill No</div>
                        <div class='form-group col-lg-2 '>:00$billData->id <input type='hidden' name='bill_id' id='bill_id' value='$billData->id'></div>
                        <div class='form-group col-lg-5'></div>
                        <div class='form-group col-lg-2 text-right'>Bill Date</div>
                        <div class='form-group col-lg-2'>: <span class='font-weight-bold bill_settle_date'>$date</span></div>
                    </div>

                    <div class='form-row'>
                        <div class='form-group col-lg-12'>
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
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date &amp; Time</th>
                                        <th>Description</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>$billData->billDate</td>
                                        <td>Total Bill Amount</td>
                                        <td class='text-right'>$billData->balance</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan='5'>Total Paid (₹)</th>
                                        <th colspan='2' class='text-right'>$billData->advance</th>
                                        <th></th>
                                    </tr>

                                    <tr>
                                        <th colspan='5'>Balance Amount (₹)</th>
                                        <th colspan='2' class='text-right'><input type='hidden' name='balance' id='balance' value='$balance'>$balance</th>
                                        <input type='hidden' name='final_discount' id='final_discount' value='$final_discount'>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-2'>Payment Mode</div>
                        <div class='form-group col-lg-4'><select name='payment_mode' id='payment_mode' class='form-control'>
                                <option value=''>Select Payment Mode </option>
                                <option value='Cash'>Cash</option>
                                <option value='PhonePe'>PhonePe UPI</option>
                            </select></div>
                        <div class='form-group col-lg-3'>Balance Received (₹)</div>
                        <div class='form-group col-lg-3'><input type='text' placeholder='Enter received amount' name='balance_received' id='balance_received' class='form-control' value=''></div>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-10'><label for='add_discount'>Can i add the remaining amount in discount?</label><input type='checkbox' name='add_discount' id='add_discount' value='Yes'></div>
                        <div class='col-lg-2'><button class='btn btnupdate btn-block' id='postValue'>Pay</button></div>
                    </div>
                </div>
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
        $tabledata = "<div class='modal-body'><div class='container'>
        <div class='form-row'>
                        <div class='form-group col-lg-12'>
                        <h3>Receipt</h3>
                            <button type='button' class='close text-danger font-weight-bold' data-bs-dismiss='modal'>×</button>
                        </div>
                    </div><hr>
        <table width='100%' cellspacing='5'>
            <thead>
                <tr>
                <td> Name :</td>
                <th>" . ($patientData->title . ' ' . $patientData->patientname) . ' ( ' . ($patientData->patientid) . ' )' . "</th>
                </tr>
                <tr>
                <td> Gender / Age :</td>
                <th>" . ($patientData->gender) . ' / ' . ($patientData->age) . ($patientData->age_type) . "</th>
                </tr>
                <tr>
                <td> Receipt No :</td>
                <th>" . '00' . ($patientData->id) . "</th>
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
                        <td colspan='2'>Remaining Amount (Rs.) </td>
                        <td><b>" . ($total - $billData->final_discount - $billData->received_amount) . ".00</b></td>
                    </tr>
                    </tbody>
                    </table>
                    </div></div>";

        echo $tabledata;
    }
}
