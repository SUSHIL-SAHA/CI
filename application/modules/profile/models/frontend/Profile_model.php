<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    public function admin_details()
    {
        $this->db->select('*');
        $query = $this->db->get_where("users", array("id" =>'1'));
        $result = $query->row();

        return $result;
    }

    function updateAdminDetails($editArray, $adminID,$detailsArr = array()){
        if(is_array($editArray) && count($editArray)>0)
        {
            $this->db->where('id', $adminID);
            $this->db->update('users', $editArray);
        }
        
        // if(is_array($detailsArr) && count($detailsArr)>0)
        // {
        //     $this->db->where('id', $adminID);
        //     $this->db->update(TABLE_PREFIX.'user_details', $detailsArr);
        // }
        return $this->db->affected_rows();
    }

    function getAdminDetails($adminID){
        $this->db->select('USRM.*');
        $this->db->from('users AS USRM');
        $this->db->where('USRM.id', $adminID);
        $Query = $this->db->get();
        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;
    }

    function change_pass($adminID,$new_pass)
    {
        $this->db->where('id', $adminID);
        $editArray=array('password'=>password_hash($new_pass, PASSWORD_DEFAULT));
        $this->db->update('users', $editArray);
    }

  


}
