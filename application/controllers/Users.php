<?php
if (session_status() === PHP_SESSION_NONE) {
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

        $id = $_SESSION['id'];
        $UserData = $this->Users_model->getuserbyID($id);
        $userdetails = array('UserData' => $UserData[0]);
        $this->load->view('users/index.php', $userdetails);
    }
    public function update()
    {
        if ($_FILES["profilePic"]["name"] == NULL) {
            $logo =$this->input->post('oldprofile'); 
        }else{
            $ext = pathinfo($_FILES["profilePic"]["name"], PATHINFO_EXTENSION);
            $logo = rand() . '.' . $ext;
            $upload = "./public/assets/images/" . $logo;
            move_uploaded_file($_FILES["profilePic"]["tmp_name"],  $upload);
        }

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'profile' => $logo
        );

        if ($this->Users_model->updateData($data)) // call the method from the model
        {
            $resultss = array('success' => 1, 'msg' => 'Update Sucess.');
            echo json_encode($resultss);
        } else {
            $resultss = array('success' => 0, 'msg' => 'something wrong.');
            echo json_encode($resultss);
        }
    }
}
