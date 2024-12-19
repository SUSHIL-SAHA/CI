<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plugins_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getpluginsLists(){
        $this->db->select('M.*');
        $this->db->from('modules AS M');
        $this->db->where('M.core_module', '0');
        $this->db->where('M.parent_module', '0');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getsubmodule($module_id)
    {
        $this->db->select('M.*');
        $this->db->from('modules AS M');
        $this->db->where('M.parent_module',$module_id);
        $Query = $this->db->get();
        $Array = $Query->result();
        return $Array;
    }

    function delete_multiple_plugins($module_id)
    {

        $this->db->select('M.*');
        $this->db->from('modules AS M');
        $this->db->where('M.module_id',$module_id);
        $postquery = $this->db->get()->result(); 
        $permalink = $postquery[0]->permalink;
        $module_folder = APPPATH."modules/".$permalink;

        $this->rrmdir($module_folder);
        $this->db->where('module_id',$module_id);
        $this->db->delete('modules');

        $this->db->where('parent_module',$module_id);
        $this->db->delete('modules');

        
    }

    function rrmdir($dir) {

        if (is_dir($dir)) {
     
          $objects = scandir($dir);
     
          foreach ($objects as $object) {
     
            if ($object != "." && $object != "..") {
     
              if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
     
            }
     
          }
     
          reset($objects);
     
          rmdir($dir);
     
        }
     
    }

    function update_plugins($data,$module_id)
    {
        $this->db->where('module_id',$module_id);
        $this->db->update('modules',$data);
        return $this->db->affected_rows();
    }

    function getpluginsSingle($module_id)
    {
        $this->db->select('M.*');
        $this->db->from('modules AS M');
        $this->db->where('M.module_id',$module_id);
        $Query = $this->db->get();
        $Array = $Query->row_array();
        return $Array;
    }

    function get_sub_plugin($module_id)
    {
        $this->db->select('M.*');
        $this->db->from('modules AS M');
        $this->db->where('M.parent_module',$module_id);
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

   


}
