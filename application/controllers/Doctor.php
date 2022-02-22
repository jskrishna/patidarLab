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
        // if (isset($_GET['t'])) {
        //     $patientData = $this->Doctor_model->patientInfo($_GET['t']);
        //     $patientData = $patientData[0];
        //     $departmentData = $this->Doctor_model->getAlldepart();
        //     $data = array('patientData' => $patientData, 'departmentData' => $departmentData);
        //     $this->load->view('Doctor/index', $data);
        // } else {
        //     $departmentData = $this->Doctor_model->getAlldepart();
        //     $data = array('departmentData' => $departmentData);
        //     $this->load->view('Doctor/index', $data);
        // }
    }
    public function getAutocompleteDoctor()
    {
        $sql = $this->Doctor_model->getAllDoctor();
        echo json_encode($sql);
    }
}
