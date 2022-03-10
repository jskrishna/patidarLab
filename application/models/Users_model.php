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
    public function getAllUser($id)
    {
        $query = $this->db->select('*')->from('users')->where('user_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function pathologistData($labid)
    {
        $query = $this->db->select('*')->from('doctors')->where('user_id',$labid);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateData($fullname,$username, $email, $mobile, $logo, $user_id)
    {
        $sth = $this->db->query("UPDATE `users` SET `fullname`='$fullname',`username`='$username',`email`='$email',`mobile`='$mobile',`logo`='$logo' WHERE `id`= '$user_id'");
        return $sth;
    }
    public function updatePathData($pathologist, $path_designation, $path_mobile, $path_email, $path_address, $sign, $path_id)
    {
        $sth = $this->db->query("UPDATE `doctors` SET `name`='$pathologist',`mobile`='$path_mobile',`email`='$path_email',`address`='$path_address',`sign`='$sign',`designation`='$path_designation' WHERE `id`='$path_id'");
        return $sth;
    }

    public function AddPathData($pathologist, $path_designation, $path_mobile, $path_email, $path_address, $sign, $labid)
    {
        $sth = $this->db->query("INSERT INTO `doctors`(`user_id`, `title`, `name`, `mobile`, `email`, `address`, `sign`, `designation`) VALUES ('$labid','Dr','$pathologist','$path_mobile','$path_email','$path_address','$sign','$path_designation')");
        return $sth;
    }

    public function referralData($labid)
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->where('id !=', '1');
        $query = $this->db->where('user_id=',$labid);
        $query = $this->db->get();
        return $query->result();
    }
    public function UpdatePassword($newpass, $user_id)
    {
        $sth = $this->db->query("UPDATE `users` SET `password`='$newpass' WHERE `id`= '$user_id'");
        return $sth;
    }
    public function updateLayoutImg($lab_logo, $letter_pad, $id)
    {
        $sth = $this->db->query("UPDATE `users` SET `lab_logo`='$lab_logo',`letter_pad`='$letter_pad' WHERE `id`= '$id'");
        $sth = $this->db->query("UPDATE `users` SET `lab_logo`='$lab_logo',`letter_pad`='$letter_pad' WHERE `user_id`='$id'");
        return $sth;
    }

    public function storeUserData($fullname, $username, $email, $mobile, $role, $password, $loggedInId)
    {
        $sth = $this->db->query("INSERT INTO `users`(`username`, `fullname`, `email`, `mobile`, `password`, `role`, `user_id`) VALUES ('$username','$fullname','$email','$mobile','$password','$role','$loggedInId')");
        return $sth;
    }

    public function updateUserData($fullname, $username, $email, $mobile, $role, $password, $loggedInId, $userid)
    {
        $sth = $this->db->query("UPDATE `users` SET `fullname`='$fullname',`username`='$username',`email`='$email',`mobile`='$mobile',`role`='$role',`password`='$password',`user_id`='$loggedInId' WHERE `id`= '$userid'");
        return $sth;
    }
}
