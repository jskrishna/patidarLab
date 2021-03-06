<?php
class Outputpdf_model extends CI_Model
{

    public function getbillinfo()
    {
        $query = $this->db->select('*')->from('bill')->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getUrlByKey($key)
    {
        $query = $this->db->select('url')->from('pdf')->where('key', $key);
        $query = $this->db->get();
        return $query->result();
    }
    public function getPatientinfo()
    {
        $query = $this->db->select('*')->from('patient')->order_by('id', 'DESC');
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
    public function getPathologistInfo($id)
    {
        $query = $this->db->select('*')->from('doctors')->where('user_id', $id);
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
        $query = $this->db->select('*')->from('patient')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getbillinfoByID($id)
    {
        $query = $this->db->select('*')->from('bill')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getReportByBill($bill_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $bill_id);
        $query = $this->db->where('status', 'authorised');
        $query = $this->db->where('printed >',0);
        $query = $this->db->get();
        return $query->result();
    }
    public function getreportDatainfo($id)
    {
        $query = $this->db->select('*')->from('reportdata')->where('bill_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getreferedData()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }

    public function getreportDataByBIllandTestId($bill_id, $test_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $bill_id);
        $query = $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPrintCount($bill_id, $test_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $bill_id);
        $query = $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function UpdatePrintedCount($bill_id, $test_id, $count)
    {
        $sth = $this->db->query("UPDATE `reportdata` SET `printed`='$count' WHERE `bill_id`= '$bill_id' AND `test_id`='$test_id'");
        return $sth;
    }
    public function updateReportStatus($reportStatus, $bill_id)
    {
        $sth = $this->db->query("UPDATE `bill` SET `report_status`='$reportStatus' WHERE `id`= '$bill_id'");
        return $sth;
    }

    public function getReportByBillAndPatientId($bill_id, $patient_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $bill_id);
        $query = $this->db->where('patient_id', $patient_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getdoctorinfoByID($id)
    {
        $query = $this->db->select('*')->from('referral')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getuserbyID($id)
    {
        $array = array('id' => $id);
        $query = $this->db->select('*')->from('users')->where($array);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $defult_value_status)
    {
        $sth = $this->db->query("INSERT INTO `reportdata`(`patient_id`, `test_id`, `bill_id`, `parameter_ids`, `input_values`) VALUES ('$patient_id','$test_id','$bill_id','$parameter_ids','$input_values')");
        return $sth;
    }
    public function updateReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $defult_value_status, $reportDataid)
    {
        $sth = $this->db->query("UPDATE `reportdata` SET `patient_id`='$patient_id',`test_id`='$test_id',`bill_id`='$bill_id',`parameter_ids`='$parameter_ids',`input_values`='$input_values' WHERE `id`= '$reportDataid'");
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

    public function getparameterBYID($test_id, $pid)
    {
        $query = $this->db->select('*')->from('parameter');
        $query = $this->db->where('id', $pid);
        $query = $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getunitBYID($id)
    {
        $query = $this->db->select('*')->from('units');
        $query = $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
