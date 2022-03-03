<?php
class Users_model extends CI_Model
{

    public function getuserbyID($id)
    {
        $array = array('id' => $id);
        $query = $this->db->select('*')->from('users')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllUser()
    {
        $query = $this->db->select('*')->from('users')->where('id !=',1);
        $query = $this->db->get();
        return $query->result();
    }
    public function updateData($username,$email,$mobile,$logo,$user_id)
    {
        $sth = $this->db->query("UPDATE `users` SET `username`='$username',`email`='$email',`mobile`='$mobile',`logo`='$logo' WHERE `id`= '$user_id'");
        return $sth;
    }
    
    public function referralData()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->where('id !=','1');
        $query = $this->db->get();
        return $query->result();
    }
    public function UpdatePassword($newpass,$user_id)
    {
        $sth = $this->db->query("UPDATE `users` SET `password`='$newpass' WHERE `id`= '$user_id'");
        return $sth;
    }
    public function updateLayoutImg($lab_logo,$letter_pad,$id)
    {
        $sth = $this->db->query("UPDATE `users` SET `lab_logo`='$lab_logo',`letter_pad`='$letter_pad' WHERE `id`= '$id'");
        return $sth;
    }


    

}
