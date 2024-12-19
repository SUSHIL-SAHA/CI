<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class banner_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getBannerLists(){
        $this->db->select('BNR.*');
        $this->db->from('banner AS BNR');
        $this->db->where('BNR.isDeleted', '0');
        $this->db->group_by('BNR.bannerId');
        $this->db->order_by('BNR.bannerId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function alterBannerDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('banner', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('bannerId', $param['bannerId']);
                $this->db->update('banner', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function getbannerSingle($bannerId){
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('bannerId', $bannerId);
        $this->db->where('isDeleted', '0');
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    public function delete_multiple_banner($id)
    {
                    
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('bannerId',$id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/banner_image/".$postquery[0]->bannerImage;
        
        unlink($posturl);
        $this->db->where('bannerId',$id);
        $this->db->delete('banner');

    }

    public function update_banner($data, $bannerId) {
        $this->db->where('bannerId', $bannerId);
        $this->db->update('banner', $data);
        return $this->db->affected_rows();
    }

    public function delete_banner($banner_id)
    {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('bannerId',$banner_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/banner_image/".$postquery[0]->bannerImage;
        
        unlink($posturl);
        $this->db->where('bannerId',$banner_id);
        $this->db->delete('banner');

    }

    public function getcmspage()
    {
        $this->db->select('*');
        $this->db->from('cms_pages');
        $this->db->where('isDeleted', '0');
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }

    function alterinnerBannerDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('inner_banner', $param);
                /* echo $this->db->last_query();
                exit(); */
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('innerbannerId', $param['innerbannerId']);
                $this->db->update('inner_banner', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function getinnerBannerLists($limit="", $start=""){
        $this->db->select('BNR.*');
        $this->db->from('inner_banner AS BNR');
        $this->db->where('BNR.isDeleted','0');
        $this->db->limit($limit, $start);
        $this->db->order_by('BNR.innerbannerId','desc');
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_innerbanner(){
        $this->db->select('BNR.*');
        $this->db->from('inner_banner AS BNR');
        $this->db->where('BNR.isDeleted','0');
        $this->db->order_by('BNR.innerbannerId','desc');
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

    function getinnerbannerSingle($innerbannerId){
        $this->db->select('*');
        $this->db->from('inner_banner');
        $this->db->where('innerbannerId', $innerbannerId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    function delete_multiple_innmer_banner($innerbannerId)
    {
        $this->db->select('*');
        $this->db->from('inner_banner');
        $this->db->where('innerbannerId',$innerbannerId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/banner_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('innerbannerId',$innerbannerId);
        $this->db->delete('inner_banner');

    }

    function update_inner_banner($data,$innerbannerId)
    {
        $this->db->where('innerbannerId', $innerbannerId);
        $this->db->update('inner_banner', $data);
        return $this->db->affected_rows();

    }

    function delete_inner_banner($innerbannerId)
    {
        $this->db->select('*');
        $this->db->from('inner_banner');
        $this->db->where('innerbannerId',$innerbannerId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/banner_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('innerbannerId',$innerbannerId);
        $this->db->delete('inner_banner');
    }


  


}
?>
