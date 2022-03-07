<?php

class Bill extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bill_model');
    }

    public function index()
    {
        $loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Bill_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if (isset($_GET['t'])) {
            $patientData = $this->Bill_model->patientInfo($_GET['t']);
            if (empty($patientData)) {
                header('Location:' . BASE_URL . 'dashboard');
            }
            $patientData = $patientData[0];
            $departmentData = $this->Bill_model->getneededDepartment();
            $doctorData = $this->Bill_model->getAllDoctor();
            $referedData = $this->Bill_model->getreferedData();
            $data = array('patientData' => $patientData, 'departmentData' => $departmentData, 'doctorData' => $doctorData, 'referedData' => $referedData,'loggedData'=>$loggedData);
            $this->load->view('bill/index.php', $data);
        } else if (isset($_GET['bill'])) {
            $bill = $_GET['bill'];
            $billData = $this->Bill_model->getBillById($bill);
            if (empty($billData)) {
                header('Location:' . BASE_URL . 'dashboard');
            }
            $patientData = $this->Bill_model->patientInfo($billData[0]->patient_id);
            if (empty($patientData)) {
                header('Location:' . BASE_URL . 'dashboard');
            }
            $patientData = $patientData[0];
            $referedData = $this->Bill_model->getreferedData();
            $departmentData = $this->Bill_model->getneededDepartment();
            $doctorData = $this->Bill_model->getAllDoctor();

            $data = array('patientData' => $patientData, 'departmentData' => $departmentData, 'doctorData' => $doctorData, 'billData' => $billData, 'referedData' => $referedData, 'loggedData'=>$loggedData,'pxthis' => $this);
            $this->load->view('bill/index.php', $data);
        } else {
            header('Location:' . BASE_URL . 'dashboard');
        }
    }
    public function getAllDepartment()
    {
        $sql = $this->Bill_model->getAlldepart();
        echo json_encode($sql);
    }
    public function billEntry()
    {

        $billDate = $this->input->post('billDate');
        $patient_id = $this->input->post('patient_id');
        $total = $this->input->post('total');
        $discount = $this->input->post('discount');
        $grandTotal = $this->input->post('grandTotal');
        $testAmount = json_encode($this->input->post('testAmount'));
        $test = $this->input->post('testId');
        $testId = implode(',', $test);
        $discountAmount = json_encode($this->input->post('discountAmount'));
        $final_discount = $this->input->post('final_discount');
        $advance = $this->input->post('advance');
        $balance = $this->input->post('balance');
        $patientRef = $this->input->post('patientRef');
        $payment_mode = $this->input->post('payment_mode');

        if($payment_mode !='Due'){
            $received_amount = $grandTotal;
            $status = 'Paid';
        }else{
            $received_amount = $advance;
            $status = 'Pending';
        }
        $advance = 0;
        $bill_id = $this->input->post('bill_id');
        if ($bill_id == '') {
            $billEntry = $this->Bill_model->insertBillEntry($billDate, $patient_id, $total, $discount, $grandTotal, $testAmount, $testId, $discountAmount, $final_discount, $advance, $balance, $patientRef, $payment_mode, $received_amount,$status );
        } else {
            $billEntry = $this->Bill_model->updateBillEntry($billDate, $patient_id, $total, $discount, $grandTotal, $testAmount, $testId, $discountAmount, $final_discount, $advance, $balance, $patientRef, $payment_mode, $received_amount,$status,$bill_id);
        }

        if ($billEntry) {
            $resultss = array('success' => 1, 'msg' => 'bill entry successfully.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
        } else {
            $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
        }
    }
    public function edit()
    {

        $loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Bill_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if (isset($_GET['bill'])) {
            $bill = $_GET['bill'];
            $billData = $this->Bill_model->getBillById($bill);
            if (empty($billData)) {
                header('Location:' . BASE_URL . 'dashboard');
            }
            $patientData = $this->Bill_model->patientInfo($billData[0]->patient_id);
            if (empty($patientData)) {
                header('Location:' . BASE_URL . 'dashboard');
            }
            $patientData = $patientData[0];
            $referedData = $this->Bill_model->getreferedData();
            $departmentData = $this->Bill_model->getneededDepartment();
            $doctorData = $this->Bill_model->getAllDoctor();

            $data = array('patientData' => $patientData,'loggedData'=>$loggedData, 'departmentData' => $departmentData, 'doctorData' => $doctorData, 'billData' => $billData, 'referedData' => $referedData, 'pxthis' => $this);
            $this->load->view('bill/edit.php', $data);
        } else {
            header('Location:' . BASE_URL . 'report');
        }
    }

    public function statusUpdate()
    {
        $bill_id = $this->input->post('bill_id');
        $balance_received = $this->input->post('balance_received');
        $payment_mode = $this->input->post('payment_mode');
        $final_discount = $this->input->post('final_discount');

        $previous_amount = $this->input->post('previous_amount');

        $balance = $this->input->post('balance');
        $markaspaid = $this->input->post('markaspaid');

        $received = intval($balance_received)+intval($previous_amount);
        if($markaspaid == 'Yes'){
            $status = 'Paid';
        $discount = intval($balance)-intval($received)-intval($final_discount);
        }else{
            $status = 'Pending';
            $discount = 0;
        }
        if(intval($balance_received)+intval($previous_amount) == intval($balance)-intval($final_discount)){
            $status = 'Paid';
        }

        $resultss =  $this->Bill_model->paymentSettle($received, $payment_mode, $discount, $status, $bill_id);

        if ($resultss) {
            $resultss = array('success' => 1, 'msg' => 'Status update successfully.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
        } else {
            $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
        }
    }
}
