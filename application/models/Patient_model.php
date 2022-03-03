<?php
class Patient_model extends CI_Model
{

    public function patientId()
    {
        $query = $this->db->select('*')->from('patient')->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function registerPatient($patientId, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type)
    {
        $sth = $this->db->query("INSERT INTO `patient`(`patientid`, `title`, `patientname`, `mobile`, `email`, `gender`, `refered_by`,`address`,`pin`, `age`, `age_type`) VALUES ('$patientId','$title','$patientName','$mobileNo','$emailId','$gender','$refered_by','$address','$pin','$age','$age_type')");
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function UpdatePatient($id, $title, $patientName, $mobileNo, $emailId, $gender, $refered_by, $address, $pin, $age, $age_type)
    {
        $sth = $this->db->query("UPDATE `patient` SET `title`='$title',`patientname`='$patientName',`mobile`='$mobileNo',`email`='$emailId',`gender`='$gender',`refered_by`='$refered_by',`address`='$address',`pin`='$pin',`age`='$age',`age_type`='$age_type' WHERE `id`='$id'");
        return $sth;
    }

    public function patientinfo()
    {
        $query = $this->db->select('*')->from('patient')->order_by('id', 'desc');
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
    public function patientSearch($search)
    {
        $query = $this->db->select('*')->from('patient');
        $query = $this->db->like('patientname',$search);
        $query = $this->db->or_like('email',$search);
        $query = $this->db->or_like('mobile',$search);
        $query = $this->db->get();
        return $query->result();
    }

}

