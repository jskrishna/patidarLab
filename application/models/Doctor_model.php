<?php
class Doctor_model extends CI_Model
{
  
    public function getAllDoctor()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }
}
