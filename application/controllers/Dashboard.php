<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$loggedInId = $_SESSION['loggedInId'];
		$loggedData = $this->Dashboard_model->getuserbyID($loggedInId);
		$loggedData = $loggedData[0];
		if ($loggedData->role == 'admin') {
			$labid = $loggedData->id;
		} else {
			$labid = $loggedData->user_id;
		}
		$date = date('d-m-Y');

		$testData = $this->Dashboard_model->getTestreportByLabId($labid, $date);

		$total = 0;
		$complete = 0;
		foreach ($testData as $key => $data) {
			$tests = explode(',', $data->testId);
			foreach ($tests as $count => $test) {
				$reportData = $this->Dashboard_model->getReportDataBybillTestID($data->id, $test);
				if(count($reportData)>0){
					$complete++;
				}
				$total++;
			}
		}
		$process = $total - $complete;

		$referDataByGroup =$this->Dashboard_model->referDataByGroup();

		$data = array('loggedData' => $loggedData, 'testData' => $testData, 'total' => $total,'complete'=>$complete,'process'=>$process,'referDataByGroup'=>$referDataByGroup);
		$this->load->view('dashboard/Index.php', $data);
	}
}
