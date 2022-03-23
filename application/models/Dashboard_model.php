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
    public function ChartData($dateCondition,$year,$labid)
    {
        $refer   = array();
        $array   = $this->db->get('referral')->result_array();

        // refer data
        foreach ($array as $key => $each) {
            if ($dateCondition) {
                $referdata = $this->db->where('patientRef', $each['id'])->where('user_id',$labid)->where($dateCondition)->get('bill')->result_array();
            } else {
                $referdata = $this->db->where('patientRef', $each['id'])->where('user_id',$labid)->get('bill')->result_array();
            }
            if (count($referdata) > 0) {
                if (isset($refer[$each['referral_name']])) {
                    $refer[$each['referral_name']][] = $referdata;
                } else {
                    $refer[$each['referral_name']] = $referdata;
                }
            }
        }


        // total income

        if ($dateCondition) {
            $receiveddata  = $this->db->where('user_id',$labid)->where($dateCondition)->get('bill')->result_array();
        } else {
            $receiveddata  = $this->db->where('user_id',$labid)->get('bill')->result_array();
        }
        $received = 0;
        foreach ($receiveddata as $key => $value) {
            $received += intval($value['received_amount']);
        }

        // mothnly income 
        $monthly = array();
        $monthly['Jan'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-01-$year%'")->get()->result();
        $monthly['Feb'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-02-$year%'")->get()->result();
        $monthly['Mar'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-03-$year%'")->get()->result();
        $monthly['Apr'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-04-$year%'")->get()->result();
        $monthly['May'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-05-$year%'")->get()->result();
        $monthly['Jun'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-06-$year%'")->get()->result();
        $monthly['Jul'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-07-$year%'")->get()->result();
        $monthly['Aug'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-08-$year%'")->get()->result();
        $monthly['Sep'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-09-$year%'")->get()->result();
        $monthly['Oct'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-10-$year%'")->get()->result();
        $monthly['Nov'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-11-$year%'")->get()->result();
        $monthly['Dec'] = $this->db->select('SUM(received_amount) AS income')->from('bill')->where('user_id',$labid)->where("billDate LIKE '%-12-$year%'")->get()->result();
        $data = array('received' => $received, 'refer' => $refer, 'monthly' => $monthly);
        return $data;
    }

    public function getTestreportByLabId($labid, $date)
    {
        $query = $this->db->select('*')->from('bill');
        $query = $this->db->where('user_id', $labid);
        $query = $this->db->like('billDate', $date);
        $query = $this->db->get();
        return $query->result();
    }
    public function getReportDataBybillTestID($billid, $test_id)
    {
        $query = $this->db->select('*')->from('reportdata');
        $query = $this->db->where('bill_id', $billid);
        $query = $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $query->result();
    }
}
