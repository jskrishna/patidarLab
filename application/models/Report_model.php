<?php
class Report_model extends CI_Model
{

    public function getbillinfo($labid)
    {
        $query = $this->db->select('*')->from('bill')->where('user_id', $labid)->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPatientinfo($labid)
    {
        $query = $this->db->select('*')->from('patient')->where('user_id', $labid)->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getPatientinfowithSearch($labid, $search)
    {
        $query = $this->db->select('*')->from('patient')->where('user_id', $labid)->like('patientname', $search)->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPatientbillINFO($limit, $offset, $user_id)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id', $user_id);
        $query = $this->db->where("created_at >= DATE(NOW()) - INTERVAL 7 DAY");
        $query = $this->db->offset($offset);
        if ($limit != '-1') {
            $query = $this->db->limit($limit);
        }
        $query = $this->db->order_by('billDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getPatientbillINFOwithSearch($limit, $offset, $user_id, $Ids, $dateSearch)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id', $user_id);
        $query = $this->db->where_in('patient_id', $Ids);
        if ($dateSearch != null) {
            $query = $this->db->where("$dateSearch");
        }
        $query = $this->db->offset($offset);
        if ($limit != '-1') {
            $query = $this->db->limit($limit);
        }
        $query = $this->db->order_by('billDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getInfoTotal($user_id)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id', $user_id);
        $query = $this->db->where("created_at >= DATE(NOW()) - INTERVAL 7 DAY");
        $query = $this->db->get();
        return $query->result();
    }
    public function getInfoTotalAndpatientID($user_id, $Ids, $dateSearch)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id', $user_id);
        $query = $this->db->where_in('patient_id', $Ids);
        if ($dateSearch != null) {
            $query = $this->db->where("$dateSearch");
        }
        $query = $this->db->order_by('billDate', 'DESC');
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
    public function getreportDatainfo($id)
    {
        $query = $this->db->select('*')->from('reportdata')->where('bill_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function checkKey($bill_id)
    {
        $query = $this->db->select('*')->from('pdf')->where('bill_id', $bill_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function insertKey($bill_id,$key,$url)
    {
        $sth = $this->db->query("INSERT INTO `pdf`(`key`, `bill_id`, `url`) VALUES ('$key','$bill_id','$url')");
        return $sth;
    }

    public function updateKey($bill_id,$url)
    {
        $sth = $this->db->query("UPDATE `pdf` SET `url`='$url' WHERE `bill_id`='$bill_id'");
        return $sth;
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

    public function getReportByBillAndPatientId($bill_id, $patient_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $bill_id);
        $query = $this->db->where('patient_id', $patient_id);
        $query = $this->db->where('status', 'authorised');
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

    public function insertReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $highlights, $defult_value_status)
    {
        $sth = $this->db->query("INSERT INTO `reportdata`(`patient_id`, `test_id`, `bill_id`, `parameter_ids`, `input_values`,`highlights`) VALUES ('$patient_id','$test_id','$bill_id','$parameter_ids','$input_values','$highlights')");
        return $sth;
    }
    public function updateReportData($patient_id, $test_id, $bill_id, $parameter_ids, $input_values, $highlights, $defult_value_status, $reportDataid)
    {
        $sth = $this->db->query("UPDATE `reportdata` SET `patient_id`='$patient_id',`test_id`='$test_id',`bill_id`='$bill_id',`parameter_ids`='$parameter_ids',`input_values`='$input_values',`highlights`='$highlights' WHERE `id`= '$reportDataid'");
        return $sth;
    }

    public function changeauthoriseStatus($id, $bill_id, $status)
    {
        $sth = $this->db->query("UPDATE `reportdata` SET `status`='$status' WHERE `test_id`= '$id' AND `bill_id`='$bill_id'");
        return $sth;
    }

    public function updateReportStatus($reportStatus, $bill_id)
    {
        $sth = $this->db->query("UPDATE `bill` SET `report_status`='$reportStatus' WHERE `id`= '$bill_id'");
        return $sth;
    }

    public function getTestByID($id)
    {
        $query = $this->db->select('*')->from('test');
        $query = $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getReportByTestId($id, $bill_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('test_id', $id);
        $query = $this->db->where('bill_id', $bill_id);
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
