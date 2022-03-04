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
    public function getUserByNUm($value)
    {
        $query = $this->db->select('*')->from('users');
        $query = $this->db->where('mobile',$value);
        $query = $this->db->or_where('email',$value);
        $query = $this->db->get();
        return $query->result();
    }
    public function updateOtp($otp,$id)
    {
        $sth = $this->db->query("UPDATE `users` SET `verified`='$otp' WHERE `id`='$id'");
        return $sth;
    }

    public function verifyotpByid($otp,$id)
    {
        $query = $this->db->select('*')->from('users');
        $query = $this->db->where('verified',$otp);
        $query = $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function updatePassword($newpass,$user_id)
    {
        $sth = $this->db->query("UPDATE `users` SET `password`='$newpass' WHERE `id`='$user_id'");
        return $sth;
    }

}
