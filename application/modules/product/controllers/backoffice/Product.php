<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Product extends MX_Controller {

    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('product/backoffice/product_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['userPermission'] = chk_user_permission('allproduct',['add','edit','delete','list']);
            $data['error'] = "";
            $data['class'] = 'product';
            $product_details_count = $this->product_model->total_product();
            $product_details_count = count($product_details_count);
            $link = "admin/product/allproduct";
            $returns = adminPaginationCompress($link, $product_details_count);
            $data['product_details'] = $this->product_model->getproductLists($returns["limit"], $returns["offset"]);
           
            // echo "<pre>";print_r($data['product_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('product/backoffice/product-list','',$data,'normal');
        }

        
    }

    public function  product_add()
    {
        $userPermission = chk_user_permission('allproduct',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'product';
            $data['category_details'] = $this->product_model->getcategorydetails();
            // echo "<pre>" ; print_r($data['category_details']);die;
            $this->layout->view('product/backoffice/add-edit-product','',$data,'normal');
        }


    }

    public function productInsert()
    {
        $userPermission = chk_user_permission('allproduct',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $param['product_title'] = trim(strip_tags($this->input->post('product_title')));
        $param['product_slug'] = setPageSlug(create_url_slug(trim($param['product_title'])));
        $param['product_status'] = trim(strip_tags($this->input->post('product_status')));
        $param['category_id'] = trim(strip_tags($this->input->post('category_id')));
        $action = $this->input->post('action');
        $productId = $this->input->post('productId');
		$this->form_validation->set_rules('product_title', 'Title Name', 'required', 'Title is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/product/product-add');
                }
                else{
                    redirect(base_url().'admin/product/product-edit/'.$productId);
                }
            
        } else {

		        $uploadPath = PPATH."uploads/product_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['image']['name'] != ''){                
		            
		            if($this->upload->do_upload('image')){
		                if($this->input->post('hiddenimage') != "") {
		                    $old_image  = PPATH . 'uploads/product_image/' . $this->input->post('hiddenimage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenimage'));
		                    $old_resized_image  = PPATH . 'uploads/product_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['image'] = $fileData['file_name'];
		            }
                }


	            }

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Product has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Product has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['productId'] = $this->input->post('productId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Product has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Product has not been updated!!!</p>';
	            break;
	        }

	       
            $getResult = $this->product_model->alterProductDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/product/allproduct');
    }

    public function product_edit($productId)
    {
        $userPermission = chk_user_permission('allproduct',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'product';
            $data['product_details'] = $this->product_model->getProductDetails($productId);
            $data['category_details'] = $this->product_model->getcategorydetails();
            $this->layout->view('product/backoffice/add-edit-product','',$data,'normal');
        }
    }
    function product_delete($productId)
    {
        $userPermission = chk_user_permission('allproduct',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->product_model->delete_product($productId);
        $successMessage = '<p class="success-msg">Product has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/product/allproduct');
    }

    public function delete_active_inactive_multiple_product()
    {
        $userPermission = chk_user_permission('allproduct',['edit','delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
            switch($actionType){
                case 'delete':
                    if(!$userPermission['delete']){
                        $this->session->set_flashdata('error', '<p class="error-msg">'.BLOCK_SECTION_MSG.'</p>');
                        $status = 2;
                    }else{
                        foreach($dataIds as $dataId){
                            $this->product_model->delete_multiple_product($dataId);
                            $msg = '<p class="success-msg">Product deleted successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
                case 'act':
                case 'inact':
                    if(!$userPermission['edit']){
                        $this->session->set_flashdata('error', '<p class="error-msg">'.BLOCK_SECTION_MSG.'</p>');
                        $status = 2;
                    }else{
                        $response=[];
                        $status = ($actionType == 'act') ? '1' : '0';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'product_status' => $status
                            );
                            $response[] = $this->product_model->update_product($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Product updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();
    }



    function category_list()
    {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'product';
            $category_details_count = $this->product_model->total_category();
            $category_details_count = count($category_details_count);
            $link = "admin/product/productcategory";
            $returns = adminPaginationCompress($link, $category_details_count);
            $data['category_details'] = $this->product_model->getcategoryLists($returns["limit"], $returns["offset"]);
            //   echo "<pre>";print_r($data['category_details']);die;
            $data['userPermission'] = chk_user_permission('productcategory',['add','edit','delete','list']);
            $this->layout->view('product/backoffice/product-category-list','',$data,'normal');
        }
    }

    function category_add()
    {
        $userPermission = chk_user_permission('productcategory',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'product';
            // $data['main_category_details'] = $this->product_model->getMainCategois();
            // echo "<pre>";print_r($data['main_category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('product/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function categoryInsert()
    {
        $userPermission = chk_user_permission('productcategory',['add','edit']);
        $action = $this->input->post('action');
        if($action=='add')
        {
            
            if(!$userPermission['add'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }else{
            if(!$userPermission['edit'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }
        $param['category_title'] = trim(strip_tags($this->input->post('categoryName')));
        $param['category_slug'] = setPageSlug(create_url_slug(trim($param['category_title'])));
        $param['category_status'] = trim(strip_tags($this->input->post('categoryStatus')));
        $action = $this->input->post('action');
        $categoryId = $this->input->post('categoryId');
		$this->form_validation->set_rules('categoryName', 'Category Name', 'required', 'Category is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/product/category-add');
                }
                else{
                    redirect(base_url().'admin/product/product-category-edit/'.$category_id);
                }
                    
        } else {

		        $uploadPath = PPATH."uploads/category_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        // if($_FILES['categoryImage']['name'] != ''){                
		            
		        //     if($this->upload->do_upload('categoryImage')){
		        //         if($this->input->post('hiddencategoryImage') != "") {
		        //             $old_image  = PPATH . 'uploads/category_image/' . $this->input->post('hiddencategoryImage');
		        //             $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddencategoryImage'));
		        //             $old_resized_image  = PPATH . 'uploads/category_image/' . $thumbfileName;
		        //             unlink($old_image);
		        //             unlink($old_resized_image);
		        //         }
		        //         // Uploaded file data
		        //         $fileData = $this->upload->data();
		        //        	$param['image'] = $fileData['file_name'];
		        //     }
                // }
	    }

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Category has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Category has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['categoryId'] = $this->input->post('categoryId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Category has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Category has not been updated!!!</p>';
	            break;
	        }

	       
            $getResult = $this->product_model->alterCategoryDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/product/productcategory');
    }

    function product_category_edit($categoryId)
    {
        $userPermission = chk_user_permission('productcategory',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'product';
            $data['category_details'] = $this->product_model->getcategory($categoryId);
            $this->layout->view('product/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function product_category_delete($id)
    {
        $userPermission = chk_user_permission('productcategory',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->product_model->delete_category_product($id);
        $successMessage = '<p class="success-msg">product category has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/product/productcategory');
    }

    public function delete_active_inactive_multiple_category()
    {

        $userPermission = chk_user_permission('productcategory',['edit','delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
            switch($actionType){
                case 'delete':
                    if(!$userPermission['delete']){
                        $this->session->set_flashdata('error', '<p class="error-msg">'.BLOCK_SECTION_MSG.'</p>');
                        $status = 2;
                    }else{
                        foreach($dataIds as $dataId){
                            $this->product_model->delete_multiple_product_category($dataId);
                            $msg = '<p class="success-msg">Product category deleted successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
                case 'act':
                case 'inact':
                    if(!$userPermission['edit']){
                        $this->session->set_flashdata('error', '<p class="error-msg">'.BLOCK_SECTION_MSG.'</p>');
                        $status = 2;
                    }else{

                        $response=[];
                        $status = ($actionType == 'act') ? '1' : '0';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'category_status' => $status
                            );
                            $response[] = $this->product_model->update_product_category($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Product category updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();

        
    }
}

