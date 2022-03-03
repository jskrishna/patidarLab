<?php
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Dashboard_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
		$data = array('loggedData' => $loggedData);
		$this->load->view('dashboard/Index.php', $data);
	}
}
