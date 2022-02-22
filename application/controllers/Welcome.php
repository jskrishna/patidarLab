<?php

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
