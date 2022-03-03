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

        $id = 1;
        $UserData = $this->Users_model->getuserbyID($id);
        $referralData = $this->Users_model->referralData();
        $userdetails = array('UserData' => $UserData[0],'referralData'=>$referralData);
        $this->load->view('users/index.php', $userdetails);
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
    public function updatePass()
    {
        
    }
}
