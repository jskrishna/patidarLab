<?php

class Doctor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Doctor_model');
    }

    public function index()
    {
      
    }
    public function getAutocompleteDoctor()
    {
        $sql = $this->Doctor_model->getAllDoctor();
        echo json_encode($sql);
    }
    public function referedList()
	{
		
		$referedList = $this->Doctor_model->getAllDoctor();
		$data = '';

		if($referedList){
			foreach($referedList as $ref){
				$data .= '<option value="'.$ref->id.'">'.$ref->referral_name.' '. $ref->designation.'</option>';
			}
		}
		echo json_encode($data);
			exit;
		# code...
	}
    public function store()
    {
        $name = $_POST['dname'];
        $designation = $_POST['designation'];
        $dmobile = $_POST['dmobile'];
        $daddress = $_POST['daddress'];
        $commission = $_POST['commission'];
        $did = $_POST['did'];
        if($did == ''){
        $data = $this->Doctor_model->storeDocData($name,$designation,$dmobile,$daddress,$commission);
        }else{
		$data = $this->Doctor_model->updateDocData($name,$designation,$dmobile,$daddress,$commission,$did);
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
    public function editDetails()
    {
        $id = $_POST['id'];
        $DocData = $this->Doctor_model->getDocById($id);
		$DocData = $DocData[0];
		echo json_encode($DocData);
        
    }
}
