<?php
class Bill_model extends CI_Model
{

    public function getPatient($id)
    {
        $array = array('id' => $id);
        $query = $this->db->select('*')->from('patient')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
    public function getBillById($bill_id)
    {
        $array = array('id' => $bill_id);
        $query = $this->db->select('*')->from('bill')->where($array);
        $query = $this->db->get();
        return $query->result();
    }
    public function getreferedData()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }
    public function patientInfo($id)
    {
        $query = $this->db->select('*')->from('patient')->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAlldepart()
    {
        $query = $this->db->select('*')->from('department');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllDoctor()
    {
        $query = $this->db->select('*')->from('referral');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertBillEntry($billDate, $patient_id, $total, $discount, $grandTotal, $testAmount, $testId, $discountAmount, $final_discount, $advance, $balance, $patientRef, $payment_mode)
    {
        $sth = $this->db->query("INSERT INTO `bill`(`billDate`, `patient_id`, `total`, `discount`, `grandTotal`, `testAmount`, `testId`, `discountAmount`, `final_discount`, `advance`, `balance`, `patientRef`, `payment_mode`,`status`) VALUES ('$billDate','$patient_id','$total','$discount','$grandTotal','$testAmount','$testId','$discountAmount','$final_discount','$advance','$balance','$patientRef','$payment_mode','Pending')");
        return $sth;
    }
    public function updateBillEntry($billDate, $patient_id, $total, $discount, $grandTotal, $testAmount, $testId, $discountAmount, $final_discount, $advance, $balance, $patientRef, $payment_mode, $bill_id)
    {
        $sth = $this->db->query("UPDATE `bill` SET `billDate`='$billDate',`patient_id`='$patient_id',`total`='$total',`discount`='$discount',`grandTotal`='$grandTotal',`testAmount`='$testAmount',`testId`='$testId',`discountAmount`='$discountAmount',`final_discount`='$final_discount',`advance`='$advance',`balance`='$balance',`patientRef`='$patientRef',`payment_mode`='$payment_mode',`status`='Pending' WHERE `id`='$bill_id'");
        return $sth;
    }

    public function getTestByID($id)
    {
        $query = $this->db->select('*')->from('test');
        $query = $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function paymentSettle($balance_received,$payment_mode,$final_discount,$status,$bill_id)
    {
        $sth = $this->db->query("UPDATE `bill` SET `final_discount`='$final_discount',`payment_mode`='$payment_mode',`status`='$status',`received_amount`='$balance_received' WHERE `id`='$bill_id'");
        return $sth;
    }
}
