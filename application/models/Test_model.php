<?php
class Test_model extends CI_Model
{

    public function getAlltest()
    {
        $query = $this->db->select('*')->from('test')->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllunit()
    {
        $query = $this->db->select('*')->from('units');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAlldepartment()
    {
        $query = $this->db->select('*')->from('department');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function addtest($department,$testName,$test_amount,$test_status)
    {
        $sth = $this->db->query("INSERT INTO `test`(`department`, `test_name`, `amount`, `status`) VALUES ('$department','$testName','$test_amount','$test_status')");
        return $sth;
    }
    public function getuserbyID($id)
    {
        $array = array('id' => $id);
        $query = $this->db->select('*')->from('users')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
    public function testEdit($id)
    {
        $query = $this->db->select('*')->from('test')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function testUpdate($department, $testName, $test_amount, $edit_test_status,$id)
    {
        $query = $this->db->query("UPDATE `test` SET `department`='$department',`test_name`='$testName',`amount`='$test_amount',`status`='$edit_test_status' WHERE `id`='$id'");
        return $query;
    }
    public function testSearch($search)
    {
        $array_Ids= array(1,2,3,4,5);
        $query = $this->db->select('*')->from('test');
        $query = $this->db->where_in('department', $array_Ids);
        $query = $this->db->like('test_name',$search);
        $query = $this->db->get();
        return $query->result();
    }
    public function getTestByDepartment($department)
    {
        $query = $this->db->select('*')->from('test')->where('department', $department);
        $query = $this->db->get();
        return $query->result();
    }

    public function testWhereIn($temp)
    {
        $query = $this->db->select('*')->from('test');
        $query= $this->db->where_in('id',explode(",",$temp));
        $query = $this->db->get();
        return $query->result();
    }

}
