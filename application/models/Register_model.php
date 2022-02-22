<?php
class Register_model extends CI_Model
{
  
    public function registerData($data){
        extract($data);
        $this->db->insert('users', array('username' => $username, 'password' => $password,'email'=>$email,'mob'=>$mob,'labname'=>$labname,'role'=>$role));
        return true;
    }

    public function checkUniqueEmail($email){
        $array = array('email' => $email);
        $query = $this->db->select('*')->from('users')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
}

