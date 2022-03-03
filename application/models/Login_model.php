<?php
class Login_model extends CI_Model
{
  
    public function getlogininfo($username, $pass)
    {
        $array = array('username' => $username, 'password' => $pass);
        $query = $this->db->select('*')->from('users')->where($array);
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
