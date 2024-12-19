<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payments_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function total_payments()
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->order_by('payment_created_on','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    public function get_payment_results($limit="", $start=""){
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->order_by('payment_created_on','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

}