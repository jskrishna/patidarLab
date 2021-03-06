<?php
class Patient_model extends CI_Model
{

    public function patientId()
    {
        $query = $this->db->select('*')->from('patient')->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function registerPatient($patientId, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type,$labid)
    {
        $sth = $this->db->query("INSERT INTO `patient`(`user_id`,`patientid`, `title`, `patientname`, `mobile`, `email`, `gender`, `refered_by`,`address`,`pin`, `age`, `age_type`) VALUES ('$labid','$patientId','$title','$patientName','$mobileNo','$emailId','$gender','$refered_by','$address','$pin','$age','$age_type')");
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function UpdatePatient($id, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type)
    {
        $sth = $this->db->query("UPDATE `patient` SET `title`='$title',`patientname`='$patientName',`mobile`='$mobileNo',`email`='$emailId',`gender`='$gender',`refered_by`='$refered_by',`address`='$address',`pin`='$pin',`age`='$age',`age_type`='$age_type' WHERE `id`='$id'");
        return $sth;
    }

    public function patientinfo($labid)
    {
        $query = $this->db->select('*')->from('patient')->where('user_id',$labid)->order_by('id', 'desc');
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
    public function getreferedData()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }
    public function getreferedDataByID($id)
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function patientEdit($id)
    {
        $query = $this->db->select('*')->from('patient')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function Deletepatient($id)
    {
        $sth = $this->db->query("DELETE FROM `patient` WHERE `id`='$id'");
        return $sth;
    }
    public function Deletebill($id)
    {
        $sth = $this->db->query("DELETE FROM `bill` WHERE `patient_id`='$id'");
        return $sth;
    }
    public function DeleteReport($id)
    {
        $sth = $this->db->query("DELETE FROM `reportdata` WHERE `patient_id`='$id'");
        return $sth;
    }
    public function patientSearch($search,$labid)
    {
        $query = $this->db->select('*')->from('patient');
        $query = $this->db->where('user_id',$labid);
        $query = $this->db->like('patientname',$search);
        // $query = $this->db->or_like('email',$search);
        // $query = $this->db->or_like('mobile',$search);
        // $query = $this->db->or_like('patientid',$search);
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
    public function getTestByID($id)
    {
        $query = $this->db->select('*')->from('test');
        $query = $this->db->where('id', $id);
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

    public function getbillinfoByID($pid)
    {
        $query = $this->db->select('*')->from('bill')->where('patient_id', $pid)->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

}

