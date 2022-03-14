<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Welcome extends CI_Controller
{
	function __construct() {
        parent::__construct();

        $this->load->model('Welcome_model');
    }
	public function index()
	{
		$UserData = $this->Welcome_model->getuser();
		$userdetails = array('UserData' => $UserData[0]);
		$this->load->view('welcome_message.php', $userdetails);
	}
}
