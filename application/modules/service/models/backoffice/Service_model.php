<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }


    function alterServiceDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('service', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('serviceId', $param['serviceId']);
                $this->db->update('service', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function alterCategoryDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('service_category', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('categoryId', $param['categoryId']);
                $this->db->update('service_category', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function getserviceLists($limit="", $start=""){
        $this->db->select('S.*,SC.category_title');
        $this->db->from('service AS S');
        $this->db->join('service_category SC', 'S.category = SC.categoryId', 'LEFT');
        $this->db->order_by('S.serviceId','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_service()
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->order_by('serviceId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getcategoryLists($limit="", $start="")
    {
        $this->db->select('SC.*');
        $this->db->from('service_category AS SC');
        $this->db->order_by('SC.categoryId','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_category()
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->order_by('categoryId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getMainCategois()
    {
        $this->db->select('SC.*');
        $this->db->from('service_category AS SC');
        $this->db->where('SC.parent_category',0);
        $this->db->order_by('SC.categoryId','desc');
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

    function getServiceDetails($serviceId)
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('serviceId', $serviceId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }

    function getcategory($categoryId)
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->where('categoryId', $categoryId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }

    function delete_multiple_service($serviceId)
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('serviceId',$serviceId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/service_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('serviceId',$serviceId);
        $this->db->delete('service');

    }

    function update_service($data,$serviceId)
    {
        $this->db->where('serviceId',$serviceId);
        $this->db->update('service',$data);
        return $this->db->affected_rows();
    }

    function delete_service($serviceId)
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('serviceId',$serviceId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/service_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('serviceId',$serviceId);
        $this->db->delete('service');
        return $this->db->affected_rows();
    }

    function delete_category_service($categoryId)
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->where('categoryId',$categoryId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/category_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('categoryId',$categoryId);
        $this->db->delete('service_category');
    }

    function delete_multiple_service_category($categoryId)
    {
        $this->db->select('*');
        $this->db->from('service_category');
        $this->db->where('categoryId',$categoryId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/category_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('categoryId',$categoryId);
        $this->db->delete('service_category');
        return $this->db->affected_rows();
    }

    function update_service_category($data,$categoryId)
    {
        $this->db->where('categoryId',$categoryId);
        $this->db->update('service_category',$data);
        return $this->db->affected_rows();
    }

    function getcategorydetails()
    {
        $this->db->select('SC.*');
        $this->db->from('service_category AS SC');
        // $this->db->where('SC.parent_category',0);
        $this->db->where('SC.category_status','1');
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


    // function total_service_inquiry()
    // {
    //     $this->db->select('*');
    //     $this->db->from('service_inquiry');
    //     $this->db->order_by('service_inquiry_id','desc');
    //     $Query = $this->db->get();
    //     // echo $this->db->last_query();
    //     $Array = $Query->result_array();
    //     return $Array;
    // }


    // function get_service_inquiry($limit="", $start="")
    // {
    //     $this->db->select('SI.*');
    //     $this->db->from('service_inquiry AS SI');
    //     $this->db->order_by('SI.service_inquiry_id','desc');
    //     $this->db->limit($limit, $start);
    //     $Query = $this->db->get();
    //     // echo $this->db->last_query();
    //     $Array = $Query->result_array();
    //     return $Array;
    // }

    // function get_service_inquiry_details($id)
    // {
    //     $this->db->select('SID.*');
    //     $this->db->from('service_inquiry AS SID');
    //     $this->db->where('SID.service_inquiry_id', $id);
    //     $Query = $this->db->get();
    //     // echo $this->db->last_query();
    //     $Array = $Query->row();
    //     return $Array;
    //     // $this->db->select('SI.*,SIP.*');
    //     // $this->db->from('service_inquiry AS SI');
    //     // $this->db->where('SI.service_inquiry_id', $id);
    //     // $this->db->join('service_inquire_product SIP', 'SI.service_inquiry_id = SIP.service_inquire_id', 'LEFT');
        
    //     // $this->db->order_by('SI.service_inquiry_id','desc');
    //     // $Query = $this->db->get();
    //     // // echo $this->db->last_query();
    //     // $Array = $Query->result_array();
    //     // return $Array;
    // }
    
    function service_inquire_product_details($id)
    {
        $service_inquire_product_details=$this->db->where('service_inquire_id',$id)->get('service_inquire_product')->result_array();
        return $service_inquire_product_details;
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


    function total_vehicle_inquiry()
    {
        $this->db->select('*');
        $this->db->from('book_vehicle');
        $this->db->order_by('id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    function get_vehicle_inquiry($limit="", $start="")
    {
        $this->db->select('SI.*');
        $this->db->from('book_vehicle AS SI');
        $this->db->order_by('SI.id','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    function get_vehicle_inquiry_details($id)
    {
        $this->db->select('SID.*');
        $this->db->from('book_vehicle AS SID');
        $this->db->where('SID.id', $id);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->row();
        return $Array;
    }
    function delete_multiple_vehicle_inquiry($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('book_vehicle');
    }

    function getVehicleDetails(){
        $getAllVehicles = $this->db->where('vehicle_status', '1')->get('vehicles')->result_array();
        return $getAllVehicles;
    }

    function insertQuotation($insData){
        $this->db->insert('quotations_send', $insData);
        return $this->db->insert_id();
    }

    function getQuoteEnquiryDetails($inquiryID){
        $this->db->select('SI.*, QT.id AS quote_id, VH.vehicle_name, VH.vehicle_image');
        $this->db->from('service_inquiry AS SI');
        $this->db->join('quotations_send AS QT', 'SI.service_inquiry_id = QT.id', 'LEFT');
        $this->db->join('vehicles AS VH', 'VH.id = QT.updated_vehicle_id', 'LEFT');
        $this->db->where('SI.service_inquiry_id', $inquiryID);
        $Query = $this->db->get();
        $Object = $Query->row();
        return $Object;
    }

    function getSingleVehicleDetails($vehicleId){
        $this->db->select('*');
        $this->db->from('vehicles');
        $this->db->where('id', $vehicleId);
        $Query = $this->db->get();
  
        //echo $this->db->last_query();
        $Array = $Query->row();
        return $Array;
      }

   


   


}
