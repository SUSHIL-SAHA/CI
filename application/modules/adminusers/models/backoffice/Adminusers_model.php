<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminusers_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    function getSiteSettings(){
        $this->db->select("*");
        $this->db->from('site_settings');
        //$this->db->where('site_id', $siteID);
        $Query = $this->db->get();
        $Array = $Query->row_array();
        return $Array;
    }

    function getCurrencies($currencyId = 0){
        $this->db->select("id, country, currency, code, symbol", FALSE);
        $this->db->from('currencies');
        if($currencyId>0)
        {
            $this->db->where('id', $currencyId);
        }
        $Query = $this->db->get();
        $Array = $Query->result_array();
        return $Array;
    }

    function alterRole($param, $action)
    {
        switch ($action) {
            case 'add':
                # code...
                $this->db->insert('role', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
                $this->db->where('id', $param['id']);
                unset($param['id']);
                $this->db->update('role', $param);
                //echo $this->db->affected_rows();
                return $this->db->affected_rows();
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

    function getRole($id=null,$status=null){
        
        if($id>0)
        {
            $this->db->select("id, role_name,permission, status", FALSE);
            $this->db->from('role');
            $this->db->where('ID', $id);
        }else{
            $this->db->select("id, role_name, status", FALSE);
            if($status)
            {
                $this->db->where('status', $status);
            }
            $this->db->from('role');
        }

        $Query = $this->db->get();
        return $Array = $Query->result_array();
    }

    function addUser($param,$action='add')
    {
        if($action == 'add')
        {
            $this->db->insert('users', $param);
            return $this->db->insert_id();
        }elseif($action == 'edit')
        {
            $this->db->where('id', $param['id']);
            unset($param['id']);
            $this->db->update('users', $param);
            return $this->db->affected_rows();
        }
        
        return ;
    }
    function getUser($id=null){
        $this->db->select("users.id, users.username, users.email,users.active,users.phone,users.role,role.role_name", FALSE);
        $this->db->where('user_type', 'SUBADMIN');
        if($id>0)
        {
            $this->db->where('users.id', $id);
        }
        $this->db->from('users');
        $this->db->join('role', 'role.id = users.role', 'LEFT');
        $Query = $this->db->get();
        return $Array = $Query->result_array();
    }

    function deleteUser($id=null)
    {
        $this->db->where('id',$id);
        $this->db->delete('users');
    }    

    function getBaseRole(){
        $this->db->select("*", FALSE);
        $this->db->from('modules');
        $this->db->where('permission', 'REQUIRE');
        $Query = $this->db->get();
        return $Array = $Query->result_array();
    }
    function checkExistingUser($email)
    {
        $this->db->select('BaseTbl.id', FALSE);
        $this->db->from(TABLE_PREFIX.'users as BaseTbl', FALSE);
        $this->db->where('BaseTbl.email', $email);
        $query = $this->db->get();        
        $user = $query->row();
        if(!empty($user)){
            return $user;
        } else {
            return null;
        }
    }
    function deleteRole($id=null)
    {
        $this->db->where('id',$id);
        $this->db->delete('role');

        $data['role'] = 0;
        $this->db->where('role', $id);
        $this->db->update('users', $data);
    } 

    function multiple_user_update($data, $field_id)
    {
        $this->db->where('id', $field_id );
        $this->db->update('users', $data);
        return $this->db->affected_rows();
    }

    function multiple_user_update_role($data, $field_id)
    {
        $this->db->where('id', $field_id );
        $this->db->update('role', $data);
        return $this->db->affected_rows();
    }

}
