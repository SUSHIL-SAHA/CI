<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class  benefits_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getbenefitsLists()
    {
        $benefitsList=$this->db->get('benefits')->result_array();
        return $benefitsList; 
    }

    function alterbenefitsDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('benefits', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('benefits_id', $param['benefits_id']);
                $this->db->update('benefits', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function getbenefitsSingle($benefits_id){
        $this->db->select('*');
        $this->db->from('benefits');
        $this->db->where('benefits_id', $benefits_id);
        $Query = $this->db->get();
        $Array = $Query->row_array();
        return $Array;
    }

    public function delete_benefits($benefits_id)
    {
        $this->db->where('benefits_id',$benefits_id);
        $this->db->delete('benefits');
    }

    public function delete_multiple_benefits($id)
    {
                    
        $this->db->select('*');
        $this->db->from('benefits');
        $this->db->where('benefits_id',$id);
        $postquery = $this->db->get()->result(); 
        $this->db->where('benefits_id',$id);
        $this->db->delete('benefits');

    }

    public function update_benefits($data, $benefits_id) 
    {
        $this->db->where('benefits_id', $benefits_id);
        $this->db->update('benefits', $data);
        return $this->db->affected_rows();
    }


}
?>
