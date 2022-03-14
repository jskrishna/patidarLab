<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Admin extends CI_Controller
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
		$data = array('loggedData' => $loggedData);
        $this->load->view('Admin/Dashboard.php',$data);
	}

	public function dashboard()
	{
        $loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		$data = array('loggedData' => $loggedData);
        $this->load->view('Admin/Dashboard.php',$data);
	}
	public function department()
	{
        $loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		$data = array('loggedData' => $loggedData);
        $this->load->view('Admin/Department.php',$data);
	}
    public function test()
	{
        $loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Patient_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		$data = array('loggedData' => $loggedData);
        $this->load->view('Admin/Test.php',$data);
	}

}
