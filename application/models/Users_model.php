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
    public function updateData($data)
    {
        extract($data);
        $id = $_SESSION['id'];
        $this->db->where('id', $id);
        $this->db->update('users', array('name' => $name, 'email' => $email,'profile'=>$profile));
        return true;
    }
}
