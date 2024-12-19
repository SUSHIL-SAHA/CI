<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends BaseModel {

    public function __construct() 
    {
        parent::__construct();
    }
    public function cms_pages_data(){
        $cms_pages_data=$this->db->where('pageStatus',1)->get('cms_pages')->result_array();
        return $cms_pages_data;
    }
    public function cms_metadata_data(){
        $cms_metadata_data=$this->db->where('status',1)->get('cms_metadata')->result_array();
        return $cms_metadata_data;
    }
    public function home_testimonial_data(){
        $home_testimonial_data=$this->db->where('is_home',1)->get('testimonial')->result_array();
        return $home_testimonial_data;
    }
    public function testimonial_data(){
        $testimonial_data=$this->db->get('testimonial')->result_array();
        return $testimonial_data;
    }
    public function faq_data(){
        $faq_data=$this->db->where('faq_status',1)->get('faq')->result_array();
        return $faq_data;
    }
    public function home_service_data(){
        $home_service_data=$this->db->where('is_home',1)->where('service_status',1)->get('service')->result_array();
        return $home_service_data;
    }
    public function service_data(){
        $service_data=$this->db->where('service_status',1)->get('service')->result_array();
        return $service_data;
    }
    public function other_service_data($slug){
        $other_service_data=$this->db->where('service_slug !=', $slug)->where('service_status',1)->get('service')->result_array();
        return $other_service_data;
    }
    public function service_category_data(){
        $service_category_data=$this->db->where('category_status',1)->get('service_category')->result_array();
        return $service_category_data;
    }  
    public function suburb_category_data(){
        $suburb_category_data=$this->db->where('category_status',1)->get('suburb_category')->result_array();
        return $suburb_category_data;
    }      
    public function location_category_data($category_slug)
    {
        $location_category_data=$this->db->where('suburb_slug', $category_slug)->where('suburb_status', 1)->get('suburb')->result_array();
        //echo $this->db->last_query(); exit;
        return $location_category_data;
    }

    public function other_location_data($locations_slug,$suburbid){
        // $other_location_data=$this->db->where('locations_slug !=', $locations_slug)->where('suburb',$suburbid)->get('locations')->result_array();
        // return $other_location_data;

        $this->db->select('L.*,S.suburb_title,S.suburb_slug');
        $this->db->from('locations AS L');
        $this->db->join('suburb S', 'L.suburb = S.suburb_id', 'LEFT');
        $this->db->where('L.locations_slug!=', $locations_slug);
        $this->db->where('L.suburb',$suburbid);
        $this->db->order_by('L.locations_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    public function getPageContentData($pageSlug)
    {
        $this->db->select('CMS.pageName, CMS.pageID, CMS.pageSlug, CMS.pageTitle, CMS.pageContent, CMS.pageFeatureImage, CMS.metaTitle, CMS.metaKeyword, CMS.metaDescription');
        $this->db->from('cms_pages AS CMS');
        $this->db->where('CMS.pageSlug', $pageSlug);
        $this->db->where('CMS.isDeleted', '0');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    function getPageExtraFields($pageId){
        $this->db->select('CMD.meta_key, CMD.meta_value');
        $this->db->from('cms_metadata AS CMD');
        $this->db->where('CMD.page_id', $pageId);
        $query = $this->db->get();
        $extraFields = $query->result_array();
        $result = array();
        if($extraFields){
            foreach($extraFields as $extraField){
                $result[$extraField['meta_key']] = $extraField['meta_value'];
            }
        }
        return $result;
    } 
    public function form_data_insert($param){
        $data=$this->db->insert('contact_mail',$param);
        return $data;
    }
    public function allblogs_data(){
        $allblogs_data=$this->db->where('blogs_status',1)->order_by('modifiedOn', 'desc')->get('blogs')->result_array();
        return $allblogs_data;
    }
    public function inner_blogs_data($blogs_slug)
    {
        $inner_blogs_data=$this->db->where('blogs_slug', $blogs_slug)->where('blogs_status', 1)->get('blogs')->result_array();
        //echo $this->db->last_query(); exit;
        return $inner_blogs_data;
    }
    public function other_blogs_data($blogs_slug)
    {
        $other_blogs_data=$this->db->where('blogs_slug !=',$blogs_slug)->where('blogs_status',1)->order_by('modifiedOn', 'desc')->get('blogs')->result_array();
        return $other_blogs_data;
    }
    public function Allservice_details_data($slug){
        $this->db->select('S.*');
        $this->db->from('service AS S');
        $this->db->where('S.service_slug', $slug);
        $this->db->order_by('S.serviceId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    public function suburb_data($categoryId)
    {
        $this->db->select('S.*,SC.suburb_title,SC.suburb_slug');
        $this->db->from('locations AS S');
        $this->db->join('suburb SC', 'S.suburb = SC.suburb_id', 'LEFT');
        $this->db->where('S.suburb', $categoryId);
        $this->db->order_by('S.suburb','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    public function location_data($suburb_id)
    {
        $location_data=$this->db->where('suburb', $suburb_id)->get('locations')->result_array();
        //echo $this->db->last_query(); exit;
        return $location_data;
    }
    public function location_details_data($locations_slug)
    {
        $this->db->select('L.*,S.suburb_title,S.suburb_slug');
        $this->db->from('locations AS L');
        $this->db->join('suburb S', 'L.suburb = S.suburb_id', 'LEFT');
        $this->db->where('L.locations_slug', $locations_slug);
        $this->db->order_by('L.locations_id','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }
    
    public function product_category_data(){
        $product_category_data=$this->db->where('category_status',1)->get('product_category')->result_array();
        return $product_category_data;
    }
    public function product_data($categoryId){
        $product_data=$this->db->where('category_id',$categoryId)->get('product')->result_array();
        return $product_data;
    }
    public function singel_product($id){
        $singel_product=$this->db->where('productId',$id)->get('product')->result_array();
        return $singel_product;
    }
    public function vehicle_insert($param){
        $data=$this->db->insert('book_vehicle',$param);
        return $data;
    }
 

    // Sourav Das
    public function getAllAvailableVehicles(){
        $getAllVehicles = $this->db->get('product')->result_array();
        return $getAllVehicles ;
    }

    // Sourav Das
    public function getVehicleDetails(){
        $getAllVehicles = $this->db->where('vehicle_status', '1')->get('vehicles')->result_array();
        return $getAllVehicles;
    }

    // Payment Model for service - Sourav Das
    public function getOrderWithQuotationDetails($serviceID){
        $this->db->select('SI.*, QS.quoted_price, QS.order_number, QS.invoice_number, QS.payment_made, VN1.vehicle_name as desired_vehicle, VN2.vehicle_name as updated_vehicle');
        $this->db->from('service_inquiry AS SI');
        $this->db->join('quotations_send AS QS', 'QS.service_enquiry_id = SI.service_inquiry_id', 'LEFT');
        $this->db->join('vehicles AS VN1', 'VN1.id = SI.vehicleId', 'LEFT');
        $this->db->join('vehicles AS VN2', 'VN2.id = QS.updated_vehicle_id', 'LEFT');
        $this->db->where('QS.order_number', $serviceID);
        $this->db->where('VN1.vehicle_status', '1');
        $Query = $this->db->get();
        $Array = $Query->row();
        return $Array;
    }

    public function getOrderItems($serviceInquiryID){
        $this->db->select('product_title, product_qty');
        $this->db->from('service_inquire_product');
        $this->db->where('service_inquire_id', $serviceInquiryID);
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

    
    public function insertPayment($param){
        $data = $this->db->insert('payments',$param);
        return $data;
    }

    public function updatePaymentStatus($getOrderID, $paymentStatus){
        $this->db->set('payment_made', $paymentStatus);
        $this->db->where('order_number', $getOrderID);
        $this->db->update('quotations_send'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }
}
