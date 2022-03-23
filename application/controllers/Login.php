<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
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
			$remember_me = $this->input->post('remember_me');
			
			if($remember_me === 'true'){
				setcookie("user", $e, time()+86400*30,"/");
				setcookie("pass", $p, time()+86400*30,"/");
			}else{
				setcookie("user", '', time()-1000,"/");
				setcookie("pass", '', time()-1000,"/");
			}
			$password = $this->input->post('password');
			$p = md5($p);
		$UserData = $this->Login_model->getlogininfo($e, $p);
		$row = $UserData;
			if ($row) {
				$row = $row[0];
				setcookie("USERNAME", $e, time()+86400,"/");
				setcookie("PASSWORD", $password, time()+86400,"/");
				setcookie("loggedIn", true, time()+86400,"/");
				setcookie("loggedInId", $row->id, time()+86400,"/");
				$_SESSION['loggedIn'] = true;
				$_SESSION['loggedInId'] = $row->id;
				$_SESSION['email'] = $row->email;
				$_SESSION['id'] = $row->id;
				$_SESSION['BASE_TITILE'] = $row->labname;

				if($row->role == 'superadmin'){
					$resultss = array('success' => 1, 'msg' => 'You are successfully logged in.','redirect_url' => BASE_URL.'Admin/dashboard');
				}else{
				$resultss = array('success' => 1, 'msg' => 'You are successfully logged in.','redirect_url' => BASE_URL.'patient');
				}
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
