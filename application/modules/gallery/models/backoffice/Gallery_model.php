<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class  gallery_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getGalleryLists(){
        $this->db->select('BNR.*');
        $this->db->from('gallery AS BNR');
        $this->db->where('BNR.isDeleted', '0');
        $this->db->group_by('BNR.galleryId');
        $this->db->order_by('BNR.galleryId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function alterGalleryDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('gallery', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('galleryId', $param['galleryId']);
                $this->db->update('gallery', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function getgallerySingle($galleryId){
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('galleryId', $galleryId);
        $this->db->where('isDeleted', '0');
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    public function delete_multiple_gallery_banner($id)
    {
                    
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('galleryId',$id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/gallery_image/".$postquery[0]->galleryImage;
        
        unlink($posturl);
        $this->db->where('galleryId',$id);
        $this->db->delete('gallery');

    }

    public function update_gallery($data, $galleryId) {
        $this->db->where('galleryId', $galleryId);
        $this->db->update('gallery', $data);
        return $this->db->affected_rows();
    }

    public function delete_gallery($gallery_id)
    {
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('galleryId',$gallery_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/gallery_image/".$postquery[0]->galleryImage;
        
        unlink($posturl);
        $this->db->where('galleryId',$gallery_id);
        $this->db->delete('gallery');
    }
}
?>
