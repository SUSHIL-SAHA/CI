<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seo_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    public function check_seo_default()
    {
        $this->db->select('*');
        $query = $this->db->get_where("seo_default", array("id" =>'1'));
        $result = $query->row();
        return $result;
    }

    public function defaultdata($params)
    {
        $this->db->where('id',1);
        $this->db->update('seo_default',$params);
    }

    public function check_seo_home()
    {
        $this->db->select('*');
        $query = $this->db->get_where("seo_home_metadata", array("id" =>'1'));
        $result = $query->row();
        return $result;
    }

    public function homeseotdata($params)
    {
        $this->db->where('id',1);
        $this->db->update('seo_home_metadata',$params);
    }

     function alterSeoDetails($param, $action){
      
        switch($action){
            case 'add':
                $this->db->insert('title_and_meta', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
                $this->db->where('id', $param['id']);
                $this->db->update('title_and_meta', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function get_all_title_mete($limit="", $start="")
    {
        $this->db->select('*');
        $this->db->from('title_and_meta');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }

    public function delete_multiple_seo($id)
    {
                    
        // $this->db->select('*');
        // $this->db->from('title_and_meta');
        // $this->db->where('id',$id);
        // $postquery = $this->db->get()->result(); 
        // $posturl = PPATH."uploads/ogImage/".$postquery[0]->ogImage;
        
        // unlink($posturl);
        $this->db->where('id',$id);
        $this->db->delete('title_and_meta');

    }

    public function update_seo($data, $bannerId) {
        $this->db->where('id', $bannerId);
        return $this->db->update('title_and_meta', $data);
        //echo $this->db->last_query(); die;
    }

    public function get_title_mete($id)
    {
        $this->db->select('*');
        $this->db->from('title_and_meta');
        $this->db->where('id',$id);
        $postquery = $this->db->get()->result(); 

        return $postquery;
    }

    function total_title_meta()
    {
        $this->db->select('*');
        $this->db->from('title_and_meta');
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }




  


}
