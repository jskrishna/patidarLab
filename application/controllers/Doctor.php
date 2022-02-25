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
}
