<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class  faq_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getfaqLists()
    {
        $faqList=$this->db->get('faq')->result_array();
        return $faqList; 
    }

    function alterfaqDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('faq', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('faq_id', $param['faq_id']);
                $this->db->update('faq', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function getfaqSingle($faq_id){
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq_id', $faq_id);
        $Query = $this->db->get();
        $Array = $Query->row_array();
        return $Array;
    }

    public function delete_faq($faq_id)
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq_id',$faq_id);
        $postquery = $this->db->get()->result(); 
        $this->db->where('faq_id',$faq_id);
        $this->db->delete('faq');
    }

    public function delete_multiple_faq($id)
    {
                    
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq_id',$id);
        $postquery = $this->db->get()->result(); 
        $this->db->where('faq_id',$id);
        $this->db->delete('faq');

    }

    public function update_faq($data, $faq_id) 
    {
        $this->db->where('faq_id', $faq_id);
        $this->db->update('faq', $data);
        return $this->db->affected_rows();
    }


}
?>
