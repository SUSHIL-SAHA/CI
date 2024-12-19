<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class  inquiry_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
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
        $this->db->select('SI.*, QS.id AS quotation_id, QS.payment_made');
        $this->db->from('service_inquiry AS SI');
        $this->db->join('quotations_send AS QS', 'QS.service_enquiry_id = SI.service_inquiry_id', 'left');
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
        // $this->db->select('SI.*,SIP.*');
        // $this->db->from('service_inquiry AS SI');
        // $this->db->where('SI.service_inquiry_id', $id);
        // $this->db->join('service_inquire_product SIP', 'SI.service_inquiry_id = SIP.service_inquire_id', 'LEFT');
        
        // $this->db->order_by('SI.service_inquiry_id','desc');
        // $Query = $this->db->get();
        // // echo $this->db->last_query();
        // $Array = $Query->result_array();
        // return $Array;
    }
    
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

    function getQuotationDetails($serviceInquiryID){
        $this->db->select('*');
        $this->db->from('quotations_send');
        $this->db->where('service_enquiry_id', $serviceInquiryID);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Object = $Query->row();
        return $Object;
    }

}