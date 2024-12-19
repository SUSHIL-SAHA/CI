<?php
  if (!defined('BASEPATH')) exit('No direct script access allowed');
  class Testimonial_model extends BaseModel {
    public function testimonial(){
      $testimonial=$this->db->get('testimonial')->result_array();
      return $testimonial; 
    }
    function alterTestimonialDetails($param, $action){
      switch($action){
          case 'add':
              $this->db->insert('testimonial', $param);
              return $this->db->insert_id();
          break;

          case 'edit':
          case 'delete':
              $this->db->where('testimonialid', $param['testimonialid']);
              $this->db->update('testimonial', $param);
              // echo $this->db->last_query();
              return $this->db->affected_rows();
          break;

         
      }
   }
  //  DELETE MODEL

  function delete_testimonial($testimonialid)
    {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('testimonialid',$testimonialid);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/testimonial_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('testimonialid',$testimonialid);
        $this->db->delete('testimonial');
        return $this->db->affected_rows();
    }
    function gettestimonialDetails($testimonialid)
    {
      
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('testimonialid', $testimonialid);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }
    function delete_multiple_testimonial($testimonialid)
    {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('testimonialid',$testimonialid);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/testimonial_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('testimonialid',$testimonialid);
        $this->db->delete('testimonial');

    }
    function updateIsHometestimonial($testimonialid,$data)
    {
        $this->db->where('testimonialid',$testimonialid);
        $this->db->update('testimonial',$data);
        return $this->db->affected_rows();
    }
  }
 ?>