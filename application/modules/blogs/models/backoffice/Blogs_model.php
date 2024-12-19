<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class  blogs_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getblogsLists()
    {
        $blogsList=$this->db->get('blogs')->result_array();
        return $blogsList; 
    }

    function alterBlogsDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('blogs', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('blogs_id', $param['blogs_id']);
                $this->db->update('blogs', $param);
                return $this->db->affected_rows();
            break;
        }
    }

    function getBlogsSingle($blogs_id){
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('blogs_id', $blogs_id);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    public function delete_multiple_blogs($id)
    {
                    
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('blogs_id',$id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/blogs_images/".$postquery[0]->blogs_image;
        
        unlink($posturl);
        $this->db->where('blogs_id',$id);
        $this->db->delete('blogs');

    }

    public function update_blogs($data, $blogs_id) {
        $this->db->where('blogs_id', $blogs_id);
        $this->db->update('blogs', $data);
        return $this->db->affected_rows();
    }

    public function delete_blogs($blogs_id)
    {
        $this->db->select('*');
        $this->db->from('blogs');
        $this->db->where('blogs_id',$blogs_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/blogs_images/".$postquery[0]->blogs_image;
        
        unlink($posturl);
        $this->db->where('blogs_id',$blogs_id);
        $this->db->delete('blogs');
    }
}
?>
