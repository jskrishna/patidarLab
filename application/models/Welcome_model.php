<?php
class Welcome_model extends CI_Model {
    public function getuser()
    {
            $query =$this->db->select('*')->from('users');
             $query = $this->db->get();         
             return $query->result();   
    }
}
