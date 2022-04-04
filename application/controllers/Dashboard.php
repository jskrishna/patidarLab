<?php
if (session_status() === PHP_SESSION_NONE) {
	ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
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

		$today_collection = 0;
		foreach ($testData as $key => $value) {
			$today_collection += $value->received_amount;
		}

		$total = 0;
		$complete = 0;
		foreach ($testData as $key => $data) {
			$tests = explode(',', $data->testId);
			foreach ($tests as $count => $test) {
				$reportData = $this->Dashboard_model->getReportDataBybillTestID($data->id, $test);
				if (count($reportData) > 0 && $reportData[0]->printed > 0 && $reportData[0]->status == 'authorised') {
					$complete++;
				}
				$total++;
			}
		}
	
		$process = $total - $complete;
	
		if ($this->input->get('data')) {
			$get = $this->input->get('data');
			if ($get == 'previous_month') {
				$first_date = date('Y-m-d 00:00:00', strtotime('first day of last month'));
				$last_date = date('Y-m-d 23:59:59', strtotime('last day of last month'));
				$dateCondition = "created_at BETWEEN '$first_date' AND '$last_date' ";
			} else if ($get == 'this_month') {
				$month_year = date('Y-m-');
				$dateCondition = "created_at LIKE '%$month_year%'";
			} else if ($get == 'all') {
				$dateCondition = false;
			}
		} else {
			$month_year = date('Y-m-');
			$dateCondition = "created_at LIKE '%$month_year%'";
		}

		if ($this->input->get('y')) {
			$yy = $this->input->get('y');
			if ($yy == 'previous_year') {
				$year = date('Y');
				$year = intval($year) - 1;
			} else {
				$year = date('Y');
			}
		} else {
			$year = date('Y');
		}


		$ChartData = $this->Dashboard_model->ChartData($dateCondition, $year, $labid);

		$values = '[';
		$months = '[';
		foreach ($ChartData['monthly'] as $month => $Income) {
			$values .= $Income[0]->income ? $Income[0]->income : 0;
			$values .= ',';

			$months .= "'$month'";
			$months .= ',';
		}
		$values .= ']';
		$months .= ']';

		$names = '[';
		$refer_count = '[';
		foreach ($ChartData['refer'] as $name => $refer) {
			$refer_count .= count($refer);
			$refer_count .= ',';
			$names .= "'$name'";
			$names .= ',';
		}
		$names .= ']';
		$refer_count .= ']';

		$data = array('names'=>$names,'refer_count'=>$refer_count,'months'=>$months,'values'=>$values,'today_collection' => $today_collection, 'loggedData' => $loggedData, 'testData' => $testData, 'total' => $total, 'complete' => $complete, 'process' => $process, 'ChartData' => $ChartData, 'year' => $year);
		$this->load->view('dashboard/Index.php', $data);
	}
}
