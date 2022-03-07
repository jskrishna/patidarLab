<?php
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        $id = $_COOKIE['loggedInId'];
        $UserData = $this->Users_model->getuserbyID($id);
        $referralData = $this->Users_model->referralData();
        $getAllUser = $this->Users_model->getAllUser();
        $pathologistData = $this->Users_model->pathologistData();
        $userdetails = array('UserData' => $UserData[0],'loggedData'=>$UserData[0],'pathologistData'=>$pathologistData[0],'referralData'=>$referralData,'AllUserData'=>$getAllUser);
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
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $user_id = $_POST['user_id'];

        if ($_FILES["user_logo"]["name"] == NULL) {
            $logo = $_POST['oldprofile'];
        } else {
            $ext = pathinfo($_FILES["user_logo"]["name"], PATHINFO_EXTENSION);
            $logo = rand() . '.' . $ext;
            move_uploaded_file($_FILES["user_logo"]["tmp_name"], "./public/assets/images/" . $logo);
        }

        if ($this->Users_model->updateData($username,$email,$mobile,$logo,$user_id)) {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);
        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }

    public function updatePathologist()
    {
        $pathologist = $_POST['pathologist'];
        $path_designation = $_POST['path_designation'];
        $path_mobile = $_POST['path_mobile'];
        $path_email = $_POST['path_email'];
        $path_address = $_POST['path_address'];
        $path_id = $_POST['pathologist_id'];

        if ($_FILES["signature"]["name"] == NULL) {
            $sign = $_POST['old_signature'];
        } else {
            $ext = pathinfo($_FILES["signature"]["name"], PATHINFO_EXTENSION);
            $sign = rand() . '.' . $ext;
            move_uploaded_file($_FILES["signature"]["tmp_name"], "./public/assets/images/" . $sign);
        }

        if ($this->Users_model->updatePathData($pathologist,$path_designation,$path_mobile,$path_email,$path_address,$sign,$path_id)) {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);
            header('location:' . BASE_URL.'users');

        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }

    
    public function updatePass()
    {
        $currentpass =  $_POST['currentpass'];
        $currentpass = md5($currentpass);
        $newpass =  $_POST['newpass'];
        $user_id = $_POST['user_id'];
        $newpass = md5($newpass);

        $currentData = $this->Users_model->getuserbyID($user_id);
        $currentData = $currentData[0];
        if($currentData->password == $currentpass){
            $updateData = $this->Users_model->UpdatePassword($newpass,$user_id);
            if ($updateData) {
                $resultss = array('success' => 1, 'msg' => 'Password Updated Successfully.');
                echo json_encode($resultss);
            } else {
                $resultss = array('success' => 0, 'msg' => 'something wrong.');
                echo json_encode($resultss);
            }
        }else{
            $resultss = array('success' => 0, 'msg' => 'Current Password Does Not Match.');
            echo json_encode($resultss);
        }

    }
    public function updateLayout()
    {

        $id = $_POST['layout_id'];

        if ($_FILES["lab_logo"]["name"] == NULL) {
            $lab_logo = $_POST['old_lab_logo'];
        } else {
            $ext = pathinfo($_FILES["lab_logo"]["name"], PATHINFO_EXTENSION);
            $lab_logo = rand() . '.' . $ext;
            move_uploaded_file($_FILES["lab_logo"]["tmp_name"], "./public/assets/images/" . $lab_logo);
        }

        if ($_FILES["letter_pad"]["name"] == NULL) {
            $letter_pad = $_POST['old_letter_pad'];
        } else {
            $ext = pathinfo($_FILES["letter_pad"]["name"], PATHINFO_EXTENSION);
            $letter_pad = rand() . '.' . $ext;
            move_uploaded_file($_FILES["letter_pad"]["tmp_name"], "./public/assets/images/" . $letter_pad);
        }

        if ($this->Users_model->updateLayoutImg($lab_logo,$letter_pad,$id)) {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);  
            header('location:' . BASE_URL.'users');

        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }
}
