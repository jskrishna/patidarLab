<?php
class Dashboard_model extends CI_Model
{

    public function getuser()
    {
        $query = $this->db->select('*')->from('users');
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_data()
    {
        $query = $this->db->select('*')->from('que');
        $query = $this->db->get();
        return $query->result();
    }
}
