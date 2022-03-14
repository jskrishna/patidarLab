<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Register extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
    }

    public function index()
    {
        if ($this->input->post('username')) {
            $n = $this->input->post('username');
            $e = $this->input->post('email');
            $p = $this->input->post('password');
            $mobile_no = $this->input->post('mobile_no');
            $labname = $this->input->post('name');
            $p = md5($p);

            $checkEmail = $this->Register_model->checkUniqueEmail($e);

           if(count($checkEmail)>0){
            $resultss = array('success' => 0, 'msg' => 'This email address is already being used.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
           }else{

            $data = array(
                'username' => $n,
                'email' => $e,
                'password' => $p,
                'mob' => $mobile_no,
                'labname' => $labname,
                'role'=> 'user'
            );

            $insert = $this->Register_model->registerData($data);

            if ($insert) {
                $resultss = array('success' => 1, 'msg' => 'Signup successfully.', 'redirect_url' => BASE_URL);
                echo json_encode($resultss);
                exit();
            } else {
                $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            }
           }

        } else {
           header("Location:".BASE_URL);
        }
    }
}
