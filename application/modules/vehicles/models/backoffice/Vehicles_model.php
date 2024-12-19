<?php
  if (!defined('BASEPATH')) exit('No direct script access allowed');
  class Vehicles_model extends BaseModel {
    public function __construct() {
      return parent::__construct();
    }
    
    function getVehicleLists() {
      $vehicleList = $this->db->get('vehicles')->result_array();
      return $vehicleList; 
    }

    function alterVehiclesDetails($param, $action){
      switch($action){
        case 'add':
          $this->db->insert('vehicles', $param);
          return $this->db->insert_id();
        break;
        case 'edit':
        case 'delete':
          $this->db->where('id', $param['id']);
          $this->db->update('vehicles', $param);
          // echo $this->db->last_query();
          return $this->db->affected_rows();
        break;
      }
    }

    function getVehicleDetails($vehicleId){
      $this->db->select('*');
      $this->db->from('vehicles');
      $this->db->where('id', $vehicleId);
      $Query = $this->db->get();

      //echo $this->db->last_query();
      $Array = $Query->row_array();
      return $Array;
    }

    function deleteVehicle($vehiclesId) {
      $this->db->select('*');
      $this->db->from('vehicles');
      $this->db->where('id',$vehiclesId);
      $postquery = $this->db->get()->row(); 
      $posturl = PPATH."uploads/vehicle_image/".$postquery->image;
      unlink($posturl);
      $this->db->where('id',$vehiclesId);
      $this->db->delete('vehicles');
      return $this->db->affected_rows();
    }
  }
 ?>