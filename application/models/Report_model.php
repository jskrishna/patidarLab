<?php
class Report_model extends CI_Model
{
  
    public function getbillinfo()
    {
        $query = $this->db->select('*')->from('bill')->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getPatientinfo()
    {
        $query = $this->db->select('*')->from('patient');
        $query = $this->db->get();
        return $query->result();
    }
    public function getdepartmentinfo()
    {
        $query = $this->db->select('*')->from('department');
        $query = $this->db->get();
        return $query->result();
    }
    public function getdoctorsinfo() 
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }
    public function gettestinfo()
    {
        $query = $this->db->select('*')->from('test');
        $query = $this->db->get();
        return $query->result();
    }
    public function getunitinfo()
    {
        $query = $this->db->select('*')->from('units');
        $query = $this->db->get();
        return $query->result();
    }
    public function getparameterinfo()
    {
        $query = $this->db->select('*')->from('parameter');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function getpatientinfoByID($id)
    {
        $query = $this->db->select('*')->from('patient')->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getbillinfoByID($id)
    {
        $query = $this->db->select('*')->from('bill')->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getreportDatainfo($id)
    {
        $query = $this->db->select('*')->from('reportdata')->where('bill_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getreferedData()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }

    public function getreportDataByBIllandTestId($bill_id,$test_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id',$bill_id);
        $query = $this->db->where('test_id',$test_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getdoctorinfoByID($id)
    {
        $query = $this->db->select('*')->from('referral')->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insertReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $defult_value_status)
    {
        $sth = $this->db->query("INSERT INTO `reportdata`(`patient_id`, `test_id`, `bill_id`, `parameter_ids`, `input_values`, `defult_value_status`) VALUES ('$patient_id','$test_id','$bill_id','$parameter_ids','$input_values','$defult_value_status')");
        return $sth;
    }
    public function updateReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $defult_value_status,$reportDataid)
    {
        $sth = $this->db->query("UPDATE `reportdata` SET `patient_id`='$patient_id',`test_id`='$test_id',`bill_id`='$bill_id',`parameter_ids`='$parameter_ids',`input_values`='$input_values',`defult_value_status`='$defult_value_status' WHERE `id`= '$reportDataid'");
        return $sth;
    }
    
    public function getTestByID($id)
    {
        $query = $this->db->select('*')->from('test');
        $query = $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getdepartmentByID($id)
    {
        $query = $this->db->select('*')->from('department');
        $query = $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
}
