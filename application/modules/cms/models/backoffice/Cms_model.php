<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getCMSPageLists($limit="", $start=""){
        $this->db->select('C.pageID,C.pageName,C.pageSlug,C.pageStatus,C.pageStatus, C.pageTitle,C.modifiedOn,C.addedOn,C.swap');
        $this->db->from('cms_pages C');
        $this->db->where('isDeleted', '0');
        $this->db->limit($limit, $start);
        $this->db->order_by("swap", "asc");
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }

    function getCMSPage(){
        $this->db->select('C.pageID,C.pageName,C.pageSlug,C.pageStatus,C.pageStatus, C.pageTitle,C.modifiedOn,C.addedOn,C.swap');
        $this->db->from('cms_pages C');
        $this->db->where('isDeleted', '0');
        // $this->db->limit($limit, $start);
        $this->db->order_by("swap", "asc");
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }

    function total_cmspage(){
        $this->db->select('C.pageID,C.pageName,C.pageSlug,C.pageStatus,C.pageStatus, C.pageTitle,C.modifiedOn,C.addedOn,C.swap');
        $this->db->from('cms_pages C');
        $this->db->where('isDeleted', '0');
        $this->db->order_by("swap", "asc");
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }

    function alterCMSPages($param, $action){
        //  echo "<pre>"; print_r($param);die;
     
        switch ($action) {
            case 'add':
                # code...
                $this->db->insert('cms_pages', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
                // echo $param['pageID']; exit;
                $this->db->where('pageID', $param['pageID']);
                $this->db->update('cms_pages',$param);
                //  echo $this->db->affected_rows();die;
                // return $this->db->affected_rows();
                return 1;
            case 'delete':
                # code...
                $this->db->where('pageID', $param['pageID']);
               $this->db->delete('cms_pages');
                return $this->db->affected_rows();
            break;
            
            default:
                # code...
                break;
        }
    } 
    function alterCustomField($param, $action){
        switch ($action) {
            case 'add':
                # code...
                $this->db->insert('cms_metadata', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
                $this->db->where('id', $param['id']);
                unset($param['id']);
                $this->db->update('cms_metadata', $param);
                //echo $this->db->affected_rows();
                return $this->db->affected_rows();
            case 'delete':
                # code...
                $this->db->where('id', $param['id']);
               $this->db->delete('cms_metadata');
                return $this->db->affected_rows();
            break;
            
            default:
                # code...
                break;
        }
    } 

    function getAllCustomFields($limit="", $start=""){
        $this->db->select('cm.*, cp.pageName');
        $this->db->from('cms_metadata cm');
        $this->db->join('cms_pages cp', 'cp.pageID = cm.page_id');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }
    
    function total_CustomFields(){
        $this->db->select('cm.*, cp.pageName');
        $this->db->from('cms_metadata cm');
        $this->db->join('cms_pages cp', 'cp.pageID = cm.page_id');
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }
    function getPageExtraFields($pageID){
        $this->db->select('cm.*');
        $this->db->from('cms_metadata cm');
        $this->db->where('page_id', $pageID);
        $this->db->where('status', 'active');
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }

    function get_page_cms_extra_fields($pageID){
        $this->db->select('CMD.page_id, CMD.field_title, CMD.meta_key, CMD.field_type, CMD.meta_value');
        $this->db->from('cms_metadata AS CMD');
        $this->db->where('CMD.page_id', $pageID);
        // $this->db->where('CMD.isDeleted', '0');
        $Query = $this->db->get();
        $result = $Query->result_array();
        return $result;
    }

    function save_page_cms_extra_data($postData){
        if($postData['page_id'] != ''){
            foreach($postData as $key => $data){
                if($key != 'page_id'){
                    $sql = 'UPDATE cms_metadata
                    SET meta_value = "'.$data.'"
                    WHERE meta_key = "'.$key.'" and page_id='.$postData['page_id'];
                    $this->db->query($sql);
                }
            }
        }
        return $this->db->affected_rows();
    }


    function deleteCmsFeaturedImage($pageId){
        $data['page_feature_image'] = '';
        $this->db->where('page_id', $pageId);
        $this->db->update('cms_pages', $data);

        return $this->db->affected_rows();
    }

    function deleteCmsOtherImage($pageId, $fieldKey){
        $data['meta_value'] = '';
        $this->db->where('page_id', $pageId);
        $this->db->where('meta_key', $fieldKey);
        $this->db->update('cms_metadata', $data);

        return $this->db->affected_rows();
    }
    
    function getCustomFieldDetails($customFieldID){
        $this->db->select('*');
        $this->db->from('cms_metadata');
        $this->db->where('id', $customFieldID);
        $Query = $this->db->get();
        $result = $Query->row_array();
        return $result;
    }
    
    function getCMSPageDetails($pageID){
        $this->db->select('*');
        $this->db->from('cms_pages');
        $this->db->where('pageID', $pageID);
        $this->db->where('isDeleted', '0');
        $Query = $this->db->get();
        $result = $Query->row_array();
        return $result;
    }

    public function delete_multiple_page($pageID)
    {
         $this->db->where('pageID',$pageID);
        $this->db->delete('cms_pages');
     }

     public function delete_multiple_field($field_id)
    {
         $this->db->where('id',$field_id);
        $this->db->delete('cms_metadata');
     }


     public function update_multiple_field($data, $field_id) {
        $this->db->where('id ', $field_id );
        $this->db->update('cms_metadata', $data);
        return $this->db->affected_rows();
        //echo $this->db->last_query(); die;
    }

    public function update_page($data, $pageID ) {
        $this->db->where('pageID ', $pageID );
        $this->db->update('cms_pages', $data);
        return $this->db->affected_rows();
    }
    
    

}
