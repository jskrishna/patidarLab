<?php
class Login extends CI_Controller
{	
	function __construct() {
	parent::__construct();
	$this->load->model('Login_model');
}
//login 
	public function index()
	{

		if ($this->input->post('username')) {
			$e = $this->input->post('username');
			$p = $this->input->post('password');
			$p = md5($p);
		$UserData = $this->Login_model->getlogininfo($e, $p);
		$row = $UserData;
			if ($row) {
				setcookie("USERNAME", $e, time()+86400*30,"/");
				setcookie("PASSWORD", $p, time()+86400*30,"/");
				$row = $row[0];
				$_SESSION['loggedIn'] = $row->id;
				$_SESSION['email'] = $row->email;
				$_SESSION['id'] = $row->id;

				$resultss = array('success' => 1, 'msg' => 'You are successfully logged in.','redirect_url' => BASE_URL.'patient/patientInfo');
				echo json_encode($resultss);
				exit();
			} else {
				$resultss = array('success' => 0, 'msg' => 'Wrong username or password.', 'redirect_url' => '');
				echo json_encode($resultss);
				exit();
			}
		} else {
			$this->load->view('login');
		}
	}
	public function Logout()
	{
		$this->load->view('login');
	}

}
