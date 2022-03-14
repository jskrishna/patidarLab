<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        $id = $_SESSION['loggedInId'];
        if(!isset($id)){
            header('location:' . BASE_URL . 'login');
        }
        $UserData = $this->Users_model->getuserbyID($id);

        $getAllUser = $this->Users_model->getAllUser($id);
        if($UserData[0]->role == 'admin'){
            $labid = $UserData[0]->id;
        }else{
            $labid = $UserData[0]->user_id;
        }
        $pathologistData = $this->Users_model->pathologistData($labid);
        $referralData = $this->Users_model->referralData($labid);
        $pathologistData = !empty($pathologistData)? $pathologistData[0]: $pathologistData;
        $userdetails = array('UserData' => $UserData[0], 'loggedData' => $UserData[0], 'pathologistData' => $pathologistData, 'referralData' => $referralData, 'AllUserData' => $getAllUser);
        $this->load->view('users/index.php', $userdetails);
    }

    public function getUser($id)
    {
        $UserData = $this->Users_model->getuserbyID($id);
        $UserData = $UserData[0];
        echo json_encode($UserData);
    }

    public function update()
    {
        $username = $this->input->post('username');
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $user_id = $this->input->post('user_id');

        if ($_FILES["user_logo"]["name"] == NULL) {
            $logo = $this->input->post('oldprofile');
        } else {
            $ext = pathinfo($_FILES["user_logo"]["name"], PATHINFO_EXTENSION);
            $logo = rand() . '.' . $ext;
            move_uploaded_file($_FILES["user_logo"]["tmp_name"], "./public/assets/images/" . $logo);
        }

        if ($this->Users_model->updateData($fullname,$username, $email, $mobile, $logo, $user_id)) {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);
        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }

    public function updatePathologist()
    {
        $pathologist = $this->input->post('pathologist');
        $path_designation = $this->input->post('path_designation');
        $path_mobile = $this->input->post('path_mobile');
        $path_email = $this->input->post('path_email');
        $path_address = $this->input->post('path_address');
        $path_id = $this->input->post('pathologist_id');
        $labid = $_SESSION['loggedInId'];

        if ($_FILES["signature"]["name"] == NULL) {
            $sign = $this->input->post('old_signature');
        } else {
            $ext = pathinfo($_FILES["signature"]["name"], PATHINFO_EXTENSION);
            $sign = rand() . '.' . $ext;
            move_uploaded_file($_FILES["signature"]["tmp_name"], "./public/assets/images/" . $sign);
        }

        if($path_id == ''){
            $Add = $this->Users_model->AddPathData($pathologist, $path_designation, $path_mobile, $path_email, $path_address, $sign, $labid);

            if ($Add) {
                $resultss = array('success' => 1, 'msg' => 'Added Sucess.');
                echo json_encode($resultss);
                header('location:' . BASE_URL . 'users');
            } else {
                $resultss = array('success' => 0, 'msg' => 'something wrong.');
                echo json_encode($resultss);
            }
        }else{
            $update = $this->Users_model->updatePathData($pathologist, $path_designation, $path_mobile, $path_email, $path_address, $sign, $path_id);
            if ($update) {
                $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
                echo json_encode($resultss);
                header('location:' . BASE_URL . 'users');
            } else {
                $resultss = array('success' => 0, 'msg' => 'something wrong.');
                echo json_encode($resultss);
            }
        }
       
    }


    public function updatePass()
    {
        $currentpass =  $this->input->post('currentpass');
        $currentpass = md5($currentpass);
        $newpass =  $this->input->post('newpass');
        $user_id = $this->input->post('user_id');
        $newpass = md5($newpass);

        $currentData = $this->Users_model->getuserbyID($user_id);
        $currentData = $currentData[0];
        if ($currentData->password == $currentpass) {
            $updateData = $this->Users_model->UpdatePassword($newpass, $user_id);
            if ($updateData) {
                $resultss = array('success' => 1, 'msg' => 'Password Updated Successfully.');
                echo json_encode($resultss);
            } else {
                $resultss = array('success' => 0, 'msg' => 'something wrong.');
                echo json_encode($resultss);
            }
        } else {
            $resultss = array('success' => 0, 'msg' => 'Current Password Does Not Match.');
            echo json_encode($resultss);
        }
    }
    public function updateLayout()
    {

        $id = $this->input->post('layout_id');
        if ($_FILES["lab_logo"]["name"] == NULL) {
            $lab_logo = $this->input->post('old_lab_logo');
        } else {
            $ext = pathinfo($_FILES["lab_logo"]["name"], PATHINFO_EXTENSION);
            $lab_logo = rand() . '.' . $ext;
            move_uploaded_file($_FILES["lab_logo"]["tmp_name"], "./public/assets/images/" . $lab_logo);
        }

        if ($_FILES["letter_pad"]["name"] == NULL) {
            $letter_pad = $this->input->post('old_letter_pad');
        } else {
            $ext = pathinfo($_FILES["letter_pad"]["name"], PATHINFO_EXTENSION);
            $letter_pad = rand() . '.' . $ext;
            move_uploaded_file($_FILES["letter_pad"]["tmp_name"], "./public/assets/images/" . $letter_pad);
        }

        if ($this->Users_model->updateLayoutImg($lab_logo, $letter_pad, $id)) {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);
            header('location:' . BASE_URL . 'users');
        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }
    public function store()
    {
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $role = $this->input->post('role');
        $password = $this->input->post('password');
        $password = md5($password);
        $userid = $this->input->post('userid');
        $loggedInId = $_SESSION['loggedInId'];
        if (isset($loggedInId)) {
            if ($userid == '') {
                $data = $this->Users_model->storeUserData($fullname, $username, $email, $mobile, $role, $password, $loggedInId);
            } else {
                $data = $this->Users_model->updateUserData($fullname, $username, $email, $mobile, $role, $password, $loggedInId, $userid);
            }
        }else{
            $data = false;
        }
        if ($data) {
            $resultss = array('success' => 1, 'msg' => 'Saved.', 'redirect_url' => BASE_URL);
            echo json_encode($resultss);
            exit();
        } else {
            $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
            echo json_encode($resultss);
            exit();
        }
    }
}
