<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Communication_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }




    public function check_contact_setting($admin_id)
    {
        $this->db->select('*');
        $query = $this->db->get_where("communication_setting", array("created_by" =>$admin_id));
        $result = $query->row();
        return $result;
    }

    function altercontentDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('communication_content', $param);
                /* echo $this->db->last_query();
                exit(); */
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('id', $param['id']);
                $this->db->update('communication_content', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }


    function get_content_details()
    {
        $this->db->select('*');
        $this->db->from('communication_content');
        $query=$this->db->get();
        $results = $query->result();
        return $results;

    }

    public function delete_multiple_content($id)
    {     
        $this->db->where('id',$id);
        $this->db->delete('contact_mail');
    }

    public function update_content_status($data, $bannerId) {
        $this->db->where('id', $bannerId);
        return $this->db->update('communication_content', $data);
        //echo $this->db->last_query(); die;
    }

    public function get_content_details_by_id($id)
    {
        $this->db->select('*');
        $query = $this->db->get_where("communication_content", array("id" =>$id));
        $result = $query->row();
        return $result;
    }

    public function get_contact_mail()
    {
        $this->db->select('*');
        $this->db->from('contact_mail');
        $this->db->order_by('id','desc');
        $query=$this->db->get();
        $results = $query->result();
        return $results;
    }

    public function total_contact_mail()
    {
        $this->db->select('*');
        $this->db->from('contact_mail');
        $this->db->order_by('id','desc');
        $query=$this->db->get();
        $results = $query->result();
        return $results;
    }

    public function get_contact_mail_by_id($id)
    {
        

        $this->db->select('*');
        $query = $this->db->get_where("contact_mail ", array("id" =>$id));
        $result = $query->row();
        return $result;
    }

    public function is_viewed($id)
    {
        $data=array('status'=>'Read');
        $this->db->where('id',$id);
        $this->db->update('contact_mail',$data);
    }

    public function delete_multiple_mail($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('contact_mail');
    }

    public function update_mail_status($data, $bannerId) {
        $this->db->where('id', $bannerId);
        return $this->db->update('contact_mail', $data);
        //echo $this->db->last_query(); die;
    }

    public function mailfilter($name_email,$status)
    {
        if($status!='')
        {
            $partSql = "and CM.status='".$status."'";
        }
        if($name_email!='')
        {
            $partSql = " and (CM.name like '%".$name_email."%' OR CM.email like '%".$name_email."%')";
        }
        
         

         $q = "select CM.* from contact_mail as CM
         where 1 ".$partSql."";
        
           

            $query = $this->db->query($q);  
            // echo   $query;done;
            $results = $query->result();
            return $results;

            
    }


}
