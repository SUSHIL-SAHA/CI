<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }


    function alterProductDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('product', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('productId', $param['productId']);
                $this->db->update('product', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function alterCategoryDetails($param, $action){
        switch($action){
            case 'add':
                $this->db->insert('product_category', $param);
                return $this->db->insert_id();
            break;

            case 'edit':
            case 'delete':
                $this->db->where('categoryId', $param['categoryId']);
                $this->db->update('product_category', $param);
                // echo $this->db->last_query();
                return $this->db->affected_rows();
            break;

           
        }
    }

    function getproductLists($limit="", $start=""){
        $this->db->select('P.*,PC.category_title');
        $this->db->from('product AS P');
        $this->db->join('product_category PC', 'P.category_id = PC.categoryId', 'LEFT');
        $this->db->order_by('P.productId','desc');
        $this->db->limit($limit, $start);
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function total_product()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('productId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getcategoryLists($limit="", $start="")
    {
        $this->db->select('SC.*');
        $this->db->from('product_category AS SC');
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
        $this->db->from('product_category');
        $this->db->order_by('categoryId','desc');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result_array();
        return $Array;
    }

    function getProductDetails($productId)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('productId', $productId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }

    function getcategory($categoryId)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('categoryId', $categoryId);
        $Query = $this->db->get();

        //echo $this->db->last_query();
        $Array = $Query->row_array();
        return $Array;

    }
    function delete_product($productId)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('productId',$productId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/product_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('productId',$productId);
        $this->db->delete('product');
        return $this->db->affected_rows();
    }

    function delete_multiple_product($productId)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('productId',$productId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/product_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('productId',$productId);
        $this->db->delete('product');
    }

    function update_product($data,$productId)
    {
        $this->db->where('productId',$productId);
        $this->db->update('product',$data);
        return $this->db->affected_rows();
    }

    function delete_category_product($categoryId)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('categoryId',$categoryId);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/category_image/".$postquery[0]->image;
        
        unlink($posturl);
        $this->db->where('categoryId',$categoryId);
        $this->db->delete('product_category');
    }

    function delete_multiple_product_category($category_Id)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('categoryId',$category_Id);
        $this->db->delete('product_category');
        return $this->db->affected_rows();
    }

    function update_product_category($data,$categoryId)
    {
        $this->db->where('categoryId',$categoryId);
        $this->db->update('product_category',$data);
        return $this->db->affected_rows();
    }

    function getcategorydetails()
    {
        $this->db->select('SC.*');
        $this->db->from('product_category AS SC');
        // $this->db->where('SC.parent_category',0);
        $this->db->where('SC.category_status','1');
        $Query = $this->db->get();
        // echo $this->db->last_query();
        $Array = $Query->result();
        return $Array;
    }
    
}
