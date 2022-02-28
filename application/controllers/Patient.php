<?php

use CodeIgniter\HTTP\Response;

class Patient extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Patient_model');
	}

	public function index()
	{
		$pp = $this->Patient_model->patientinfo();
		$px = $this->Patient_model->patientId();
		$referedData = $this->Patient_model->getreferedData();
		$data = array('patientid' => $px[0]->id,'referedData'=>$referedData,'patientData' => $pp);
		$this->load->view('Patient/index', $data);

	}
	public function register_patient()
	{
		if ($this->input->post('title')) {
			$px = $this->Patient_model->patientId();
			$patientId = $px[0]->id+1;
			if(strlen($patientId) > 3){
				$patientId = 'PTD0'.$patientId;
			}else{
				$patientId = 'PTD00'.$patientId;
			}
			$title = $this->input->post('title');
			$patientName = $this->input->post('patientName');
			$mobileNo = $this->input->post('mobileNo');
			$emailId = $this->input->post('emailId');
			$gender = $this->input->post('gender');
			$refered_by = $this->input->post('refered_by');
			$address = $this->input->post('address');
			$age = $this->input->post('age');
			$age_type = $this->input->post('age_type');
			$pin = $this->input->post('pin');

			$registerPatient = $this->Patient_model->registerPatient($patientId, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type);

			if ($registerPatient) {
				$resultss = array('success' => 1, 'msg' => 'Patient registration successfully.', 'redirect_url' => BASE_URL .'bill?t='.$registerPatient);
				
				echo json_encode($resultss);
				exit();
			} else {
				$resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
				echo json_encode($resultss);
				exit();
			}
		} else {
			header("Location:" . BASE_URL);
		}
	}
	public function patientinfo()
	{
		header("Location:" . BASE_URL."patient");
	}

	public function patientEdit()
	{

		$id = $this->input->post('id');
		$patientData = $this->Patient_model->patientEdit($id);
		$patientData = $patientData[0];
		echo json_encode($patientData);
	}
	public function patientUpdate()
	{
		if ($this->input->post('id')) {

			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$patientName = $this->input->post('patientName');
			$mobileNo = $this->input->post('mobileNo');
			$emailId = $this->input->post('emailId');
			$gender = $this->input->post('gender');
			$refered_by = $this->input->post('refered_by');
			$address = $this->input->post('address');
			$age = $this->input->post('age');
			$age_type = $this->input->post('age_type');
			$pin = $this->input->post('pin');

			$UpdatePatient = $this->Patient_model->UpdatePatient($id, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type);

			if ($UpdatePatient) {
				$resultss = array('success' => 1, 'msg' => 'Patient update successfully.', 'redirect_url' => BASE_URL . 'patient/patientInfo');
				echo json_encode($resultss);
				exit();
			} else {
				$resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
				echo json_encode($resultss);
				exit();
			}
		} else {
			header("Location:" . BASE_URL);
		}
	}

	public function patientDelete()
	{
		$id = $_GET['id'];
		$delete = $this->Patient_model->Deletepatient($id);
		if ($delete) {
			$resultss = array('success' => 1, 'msg' => 'Patient delete successfully.', 'redirect_url' => '');
			echo json_encode($resultss);
			header("location:" . BASE_URL . "patient/patientInfo");
			exit();
		} else {
			$resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
			echo json_encode($resultss);
			exit();
		}
	}
	public function searchPatient()
	{
		$search = $_GET['term'];
		if (!empty($search)) {
			$data = $this->Patient_model->patientSearch($search);
			echo json_encode($data);
			exit;
		}
	}
	public function getAutoComplete()
	{
		$search = $_GET['term'];
		if (!empty($search)) {
			$data = $this->Patient_model->patientSearch($search);
			echo json_encode($data);
			exit;
		}
	}
	
	public function add_patient()
	{
		$this->load->view('Patient/add-patient');
	}
	public function patientList()
	{
		
		$patientList = $this->Patient_model->patientinfo();
		$data = '';

		if($patientList){
			foreach($patientList as $patient){
				$data .= '<option value="'.$patient->id.'">'.$patient->patientname.' - '. $patient->patientid.'</option>';
			}
		}
		echo json_encode($data);
			exit;
		# code...
	}
}
