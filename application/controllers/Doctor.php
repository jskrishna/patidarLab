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
        $loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Doctor_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if($loggedData->role =='admin'){
            $labid = $loggedData->id;
        }else{
            $labid = $loggedData->user_id;
        }
        $sql = $this->Doctor_model->getAllDoctor($labid);
        echo json_encode($sql);
    }
    public function referedList()
	{
		$loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Doctor_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if($loggedData->role =='admin'){
            $labid = $loggedData->id;
        }else{
            $labid = $loggedData->user_id;
        }

		$referedList = $this->Doctor_model->getAllDoctor($labid);
		$data = '';

		if($referedList){
			foreach($referedList as $ref){
				$data .= '<option value="'.$ref->id.'">'.$ref->referral_name. ($ref->designation ? ' ('. $ref->designation.') ':""). '</option>';
			}
		}
		echo json_encode($data);
			exit;
		# code...
	}
    public function store()
    {
        $name = $this->input->post('dname');
        $designation = $this->input->post('designation');
        $dmobile = $this->input->post('dmobile');
        $daddress = $this->input->post('daddress');
        $commission = $this->input->post('commission');
        $loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Doctor_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];
        if($loggedData->role =='admin'){
            $labid = $loggedData->id;
        }else{
            $labid = $loggedData->user_id;
        }

        $did = $this->input->post('did');
        if($did == ''){
        $data = $this->Doctor_model->storeDocData($name,$designation,$dmobile,$daddress,$commission,$labid);
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
        $id = $this->input->post('id');
        $DocData = $this->Doctor_model->getDocById($id);
		$DocData = $DocData[0];
		echo json_encode($DocData);
        
    }
    
}
