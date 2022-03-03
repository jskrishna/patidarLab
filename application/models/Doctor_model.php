<?php
class Doctor_model extends CI_Model
{
  
    public function getAllDoctor()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }
    public function storeDocData($name,$designation,$dmobile,$daddress,$commission)
    {
        $query = $this->db->query("INSERT INTO `referral`(`title`, `referral_name`, `commission`, `mobile_no`, `address`,`designation`) VALUES ('Dr','$name','$commission','$dmobile','$daddress','$designation')");
        return $query;
    }

    public function updateDocData($name,$designation,$dmobile,$daddress,$commission,$did)
    {
        $query = $this->db->query("UPDATE `referral` SET `referral_name`='$name',`commission`='$commission',`mobile_no`='$dmobile',`address`='$daddress',`designation`='$designation' WHERE `id`='$did'");
        return $query;
    }

    public function getDocById($id)
    {
        $query = $this->db->select('*')->from('referral')->where('id',$id);
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
}
