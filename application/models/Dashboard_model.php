<?php

use Faker\Core\Number;

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
    $refer   = array();
    $array   = $this->db->get('referral')->result_array();
    foreach( $array as $key=>$each ){
        $referdata = $this->db->where('patientRef', $each['id'])->get('bill')->result_array();  
        if(count($referdata)>0){
            if(isset($refer[$each['referral_name']])){
                $refer[$each['referral_name']][] = $referdata;

            }else{
                $refer[$each['referral_name']] = $referdata;
            }
        }
    }

    $receiveddata  = $this->db->get('bill')->result_array();
    $received = 0;
      foreach ($receiveddata as $key => $value) {
         $received += intval($value['received_amount']);
      }
    
	$data = array('received' => $received, 'refer' => $refer);

    return $data;
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
