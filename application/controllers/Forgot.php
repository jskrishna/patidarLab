<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
if(session_status() === PHP_SESSION_NONE){
session_start();
}
use Mpdf\Tag\Em;
use PhpParser\Node\Expr\Empty_;

class Forgot extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}
	//login 
	public function index()
	{
		$this->load->view('forgot');
	}
	public function verify()
	{
		$number = $this->input->post('number');
		$UserData = $this->Login_model->getUserByNUm($number);

		if (!empty($UserData)) {

			$email_config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_user' => 'polimappertest@gmail.com',
				'smtp_pass' => 'poli@12345',
				'mailtype'  => 'html',
				'starttls'  => true,
				'newline'   => "\r\n"
			);

			$otp = rand(1000, 9999);

			$id = $UserData[0]->id;
			$this->Login_model->updateOtp($otp, $id);

			$this->load->library('email', $email_config);
			$this->email->from('someuser@gmail.com', 'invoice');
			$this->email->to('pradhumanpatidar143@gmail.com');
			$this->email->subject('Invoice');
			$this->email->message('your one time otp is ' . $otp);

			// if ($this->email->send()) {
				// setcookie("ei", $id time()+86400,"/");

			// 	$resultss = array('success' => 1, 'msg' => 'OTP has sent.');
			// 	echo json_encode($resultss);
			// 	exit();
			// } else {
			// 	$resultss = array('success' => 0, 'msg' => 'Error ocured..');
			// 	echo json_encode($resultss);
			// 	exit();
			// }
			$_SESSION['ei'] = $id;
				setcookie("ei", $id, time()+86400,"/");
					$resultss = array('success' => 1, 'msg' => 'OTP has sent.');
				echo json_encode($resultss);
			exit();
			

		} else {
			$resultss = array('success' => 0, 'msg' => 'Mobile number or email does not match with any record.');
			echo json_encode($resultss);
			exit();
		}
	}
	public function verifyOtp()
	{
		$otp = $this->input->post('otp');
		$user_id = $this->input->post('user_id');
		$data = $this->Login_model->verifyotpByid($otp,$user_id);

		if(!empty($data)){
			$resultss = array('success' => 1, 'msg' => 'OTP is verified.');
			echo json_encode($resultss);
			exit();
		}else{
			$resultss = array('success' => 0, 'msg' => 'Invalid OTP.');
			echo json_encode($resultss);
			exit();
		}
	}
	public function resetPass()
	{
		$newpass = $this->input->post('newpass');
		$user_id = $this->input->post('user_id');
		$newpass = md5($newpass);
		$data = $this->Login_model->updatePassword($newpass,$user_id);

		if($data){
			$resultss = array('success' => 1, 'msg' => 'success.');
			echo json_encode($resultss);
			exit();
		}else{
			$resultss = array('success' => 0, 'msg' => 'error ocured.');
			echo json_encode($resultss);
			exit();
		}
	}
}
