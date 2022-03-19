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
    public function getuserbyID($id)
    {
        $array = array('id' => $id);
        $query = $this->db->select('*')->from('users')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
    public function referDataByGroup()
    {
        $sth = $this->db->query("SELECT * FROM `patient` GROUP BY `refered_by`");
        return $sth;
    }
    
    public function getTestreportByLabId($labid,$date)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id',$labid);
        $query = $this->db->like('billDate',$date);
        $query = $this->db->get();
        return $query->result();
    }
    public function getReportDataBybillTestID($billid, $test_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id',$billid);
        $query = $this->db->where('test_id',$test_id);
        $query = $this->db->get();
        return $query->result();
    }



}
