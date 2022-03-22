<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
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
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		$pp = $this->Patient_model->patientinfo($labid);
		$referedData = $this->Patient_model->getreferedData();
		$data = array('referedData' => $referedData, 'loggedData' => $loggedData, 'patientData' => $pp);
		$this->load->view('Patient/index', $data);
	}
	public function info($id)
	{
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		$patientData = $this->Patient_model->patientEdit($id);
		$patientData = $patientData[0];
		$doctorData = $this->Patient_model->getreferedDataByID($patientData->refered_by);

		$data = array('loggedData' => $loggedData, 'patientData' => $patientData, 'doctorData' => $doctorData[0]);
		$this->load->view('Patient/patient-single', $data);
	}

	public function register_patient()
	{
		if ($this->input->post('title')) {
			$px = $this->Patient_model->patientId();
			if (!empty($px)) {

				$string = $px[0]->patientid;
				$patientId = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
				$patientId = $patientId + 1;
			} else {
				$patientId = 1;
			}


			$loggedInId = $_SESSION['loggedInId'];
			$loggedData = $this->Patient_model->getuserbyID($loggedInId);
			$loggedData = $loggedData[0];
			if ($loggedData->role == 'admin') {
				$labid = $loggedData->id;
				$labdata = $this->Patient_model->getuserbyID($labid);
			} else {
				$labid = $loggedData->user_id;
				$labdata = $this->Patient_model->getuserbyID($labid);
			}

			$labdata = $labdata[0];

			$labname = explode(' ', $labdata->fullname);
			$labname = array_filter($labname);
			$nCount = 0;
			$generateID = '';
			foreach ($labname as $n) {
				if ($nCount == 0 || $nCount == 1) {
					$generateID .= $n[0];
				}
				$nCount++;
			}

			if (strlen($patientId) > 3) {
				$patientId = strtoupper($generateID) . 'ID0' . $patientId;
			} else {
				$patientId = strtoupper($generateID) . 'ID00' . $patientId;
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

			$loggedInId = $_SESSION['loggedInId'];
			$loggedData = $this->Patient_model->getuserbyID($loggedInId);
			$loggedData = $loggedData[0];
			if ($loggedData->role == 'admin') {
				$labid = $loggedData->id;
			} else {
				$labid = $loggedData->user_id;
			}

			$registerPatient = $this->Patient_model->registerPatient($patientId, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type, $labid);

			if ($registerPatient) {
				$resultss = array('success' => 1, 'msg' => 'Patient registration successfully.', 'redirect_url' => BASE_URL . 'bill?t=' . $registerPatient);

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
		header("Location:" . BASE_URL . "patient");
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
		$deletebill = $this->Patient_model->Deletebill($id);
		$deletereport = $this->Patient_model->DeleteReport($id);
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
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}

		if (!empty($search)) {
			$data = $this->Patient_model->patientSearch($search, $labid);
			echo json_encode($data);
			exit;
		}
	}
	public function getAutoComplete()
	{
		$search = $_GET['term'];
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		if (!empty($search)) {
			$data = $this->Patient_model->patientSearch($search, $labid);
			echo json_encode($data);
			exit;
		}
	}

	public function add_patient()
	{
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		$data = array('loggedData' => $loggedData);
		$this->load->view('Patient/add-patient', $data);
	}
	public function patientList()
	{
		if(isset($_SESSION['loggedInId'])){
		$loggedInId = $_SESSION['loggedInId'];
		$patientList = $this->Patient_model->patientinfo($loggedInId);
		$data = '';

		if ($patientList) {
			foreach ($patientList as $patient) {
				$data .= '<option value="' . $patient->id . '">' . $patient->patientname . ' - ' . $patient->patientid . '</option>';
			}
		}
		echo json_encode($data);
		exit;
	}
	}
}
