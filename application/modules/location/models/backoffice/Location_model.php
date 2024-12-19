<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }


    function alterlocationsDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('locations', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('locations_id', $param['locations_id']);
                $this->db->update('locations', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function alterSuburbDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('suburb', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('suburb_id', $param['suburb_id']);
                $this->db->update('suburb', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function getlocationsLists($limit="", $start=""){
        $this->db->select('S.*,SC.suburb_title');
        $this->db->from('locations AS S');
        $this->db->join('suburb SC', 'S.suburb = SC.suburb_id', 'LEFT');
        $this->db->order_by('S.locations_id','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_locations()
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->order_by('locations_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getsuburbLists($limit="", $start="")
    {
        $this->db->select('S.*');
        $this->db->from('suburb AS S');
        // $this->db->join('suburb_category SC', 'S.category_id = SC.categoryId', 'LEFT');
        $this->db->order_by('S.suburb_id','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_suburb()
    {
        $this->db->select('*');
        $this->db->from('suburb');
        $this->db->order_by('suburb_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getMainCategois()
    {
        $this->db->select('SC.*');
        $this->db->from('suburb AS SC');
        $this->db->where('SC.parent_category',0);
        $this->db->order_by('SC.suburb_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getparentcategory($categoryId)
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->where('categoryId', $categoryId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    function getalllocationsDetails($locations_id)
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where('locations_id', $locations_id);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }

    function getsuburb($suburb_id)
    {
        $this->db->select('*');
        $this->db->from('suburb');
        $this->db->where('suburb_id', $suburb_id);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }

    function delete_multiple_locations($locations_id)
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where('locations_id',$locations_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/locations_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('locations_id',$locations_id);
        $this->db->delete('locations');

    }

    function update_locations($data,$locations_id)
    {
        $this->db->where('locations_id',$locations_id);
        $this->db->update('locations',$data);
        return $this->db->affected_rows();
    }

    function delete_locations($locations_id)
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where('locations_id',$locations_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/locations_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('locations_id',$locations_id);
        $this->db->delete('locations');
        return $this->db->affected_rows();
    }

    function delete_suburb_service($suburb_id)
    {
        $this->db->select('*');
        $this->db->from('suburb');
        $this->db->where('suburb_id',$suburb_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/suburb_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('suburb_id',$suburb_id);
        $this->db->delete('suburb');
    }

    function delete_multiple_suburb_category($suburb_id)
    {
        $this->db->select('*');
        $this->db->from('suburb');
        $this->db->where('suburb_id',$suburb_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/suburb_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('suburb_id',$suburb_id);
        $this->db->delete('suburb');
        return $this->db->affected_rows();
    }

    function update_suburb_category($data,$suburb_id)
    {
        $this->db->where('suburb_id',$suburb_id);
        $this->db->update('suburb',$data);
        return $this->db->affected_rows();
    }

    function getlocationsdetails()
    {
        $this->db->select('SC.*');
        $this->db->from('suburb AS SC');
        // $this->db->where('SC.parent_category',0);
        $this->db->where('SC.suburb_status','1');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result();
        return $Array;
    }

    function getparentcategorylists($categoryId)
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->where('parent_category', $categoryId);
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }
    
    function updateIsHomeCategory($categoryId,$data)
    {
        $this->db->where('categoryId',$categoryId);
        $this->db->update('service_category',$data);
        return $this->db->affected_rows();
    }

    function getServicegalleryimageDetails($serviceId)
    {
        $this->db->select('*');
        $this->db->from('service_image_gallery');
        $this->db->where('serviceId', $serviceId);
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }


    function total_service_inquiry()
    {
        $this->db->select('*');
        $this->db->from('service_inquiry');
        $this->db->order_by('service_inquiry_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }


    function get_service_inquiry($limit="", $start="")
    {
        $this->db->select('SI.*');
        $this->db->from('service_inquiry AS SI');
        $this->db->order_by('SI.service_inquiry_id','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function get_service_inquiry_details($id)
    {
        $this->db->select('SID.*');
        $this->db->from('service_inquiry AS SID');
        $this->db->where('SID.service_inquiry_id', $id);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->row();
        return $Array;
    }

    function delete_multiple_service_inquiry($id)
    {
        $this->db->where('service_inquiry_id', $id);
        $this->db->delete('service_inquiry');
    }

    function updateIsHomeservice($serviceId,$data)
    {
        $this->db->where('serviceId',$serviceId);
        $this->db->update('service',$data);
        return $this->db->affected_rows();
    }
    
    function get_category_details()
    {
        $this->db->select('SC.*');
        $this->db->from('suburb_category AS SC');
        // $this->db->where('SC.parent_category',0);
        $this->db->where('SC.category_status','1');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result();
        return $Array;
    }

   

    function total_suburb_category()
    {
        $this->db->select('*');
        $this->db->from('suburb_category');
        $this->db->order_by('categoryId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    function getSuburbCategoryLists($limit="", $start="")
    {
        $this->db->select('SC.*');
        $this->db->from('suburb_category AS SC');
        $this->db->order_by('SC.categoryId','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    function alterCategoryDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('suburb_category', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('categoryId', $param['categoryId']);
                $this->db->update('suburb_category', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }
    function getcategory($categoryId)
    {
        $this->db->select('*');
        $this->db->from('suburb_category');
        $this->db->where('categoryId', $categoryId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }
    function delete_category($categoryId)
    {
        $this->db->select('*');
        $this->db->from('suburb_category');
        $this->db->where('categoryId',$categoryId);
        $postquery = $this->db->get()->result(); 
        $this->db->where('categoryId',$categoryId);
        $this->db->delete('suburb_category');
    }

    function delete_multiple_category($categoryId)
    {
        $this->db->select('*');
        $this->db->from('suburb_category');
        $this->db->where('categoryId',$categoryId);
        $postquery = $this->db->get()->result(); 
        $this->db->where('categoryId',$categoryId);
        $this->db->delete('suburb_category');
        return $this->db->affected_rows();
    }
    function suburb_category($data,$categoryId)
    {
        $this->db->where('categoryId',$categoryId);
        $this->db->update('suburb_category',$data);
        return $this->db->affected_rows();
    }


}
