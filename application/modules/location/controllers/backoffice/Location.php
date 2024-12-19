<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Location extends MX_Controller {

    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('location/backoffice/location_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['userPermission'] = chk_user_permission('locations',['add','edit','delete','list']);
            $data['error'] = "";
            $data['class'] = 'location';
            $locations_details_count = $this->location_model->total_locations();
            $locations_details_count = count($locations_details_count); 
            $link = "admin/location/locations";
            $returns = adminPaginationCompress($link, $locations_details_count);
            $data['locations_details'] = $this->location_model->getlocationsLists($returns["limit"], $returns["offset"]);
           
            // echo "<pre>";print_r($data['service_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('location/backoffice/locations-list','',$data,'normal');
        }

        
    }

    public function locations_add()
    {
        $userPermission = chk_user_permission('locations',['add']);
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
            $data['class'] = 'location';
            $data['suburb_details'] = $this->location_model->getlocationsdetails();
            // echo "<pre>" ; print_r($data['category_details']);die;
            $this->layout->view('location/backoffice/add-edit-locations','',$data,'normal');
        }


    }

    // public function get_parent_category()
    // {
    //     $status = 0;
    //     $category_id = $this->input->post('category_id');
    //     $parrent_category = $this->service_model->getparentcategorylists($category_id);
    //     $csrf_token = $this->security->get_csrf_hash();
    //     if(count($parrent_category) > 0)
    //     {
    //         $status = 1;
    //     }
    //     else{
    //         $status = 1;
    //     }

    //     echo json_encode(array('status'=>$status,'parrent_category'=>$parrent_category,'csrf_token'=>$csrf_token));
    //     exit();
    // }

    // public function is_home_service()
    // {
    //     $status = 0;
    //     $categoryId = $this->input->post('categoryId');
    //     $is_home_value = $this->input->post('is_home_value');
    //     $data = array('is_home' => $is_home_value);
    //     $is_home = $this->service_model->updateIsHomeCategory($categoryId,$data);
    //     $csrf_token = $this->security->get_csrf_hash();
    //     if($is_home > 0)
    //     {
    //         $status = 1;
    //     }
    //     else{
    //         $status = 1;
    //     }

    //     echo json_encode(array('status'=>$status,'csrf_token'=>$csrf_token));
    //     exit();
    // }

    public function locationsInsert()
    {
        $userPermission = chk_user_permission('locations',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $param['locations_title'] = trim(strip_tags($this->input->post('locations_title')));
        $param['locations_manu'] = trim(strip_tags($this->input->post('locations_manu')));
        // $param['locations_slug'] = setPageSlug(create_url_slug(trim($param['locations_title'])));
		// $param['ServiceShortDescription'] = $this->input->post('ServiceShortDescription');
        $param['map_link'] = $this->input->post('map_link');
        $param['locations_description'] = $this->input->post('locations_description');
        $param['location_description1'] = $this->input->post('location_description1');
        $param['location_description2'] = $this->input->post('location_description2');
        $param['location_description3'] = $this->input->post('location_description3');
        $param['location_description4'] = $this->input->post('location_description4');
        $param['locations_status'] = trim(strip_tags($this->input->post('locations_status')));
        $param['suburb'] = trim(strip_tags($this->input->post('suburb')));
        // $param['parent_category'] = trim(strip_tags($this->input->post('parent_category')));

        $param['metaTitle'] = $this->input->post('metaTitle');
        $param['metaKeyword'] = $this->input->post('metaKeyword');
        $param['metaDescription'] = $this->input->post('metaDescription');

        $action = $this->input->post('action');
        $locations_id = $this->input->post('serviceId');
		$this->form_validation->set_rules('locations_title', 'Title Name', 'required', 'Title is required');
		$this->form_validation->set_rules('locations_manu', 'Manu Name', 'required', 'Manu is required');
        $this->form_validation->set_rules('locations_description', 'locations description', 'required', 'Description is required');
        // $this->form_validation->set_rules('ServiceShortDescription', 'Service Short Description', 'required', 'Short description is required');
        $this->form_validation->set_rules('suburb', 'Suburb', 'required', 'Suburb is required');
        // $this->form_validation->set_rules('map_link', 'Service Price', 'required', 'Price is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/location/locations-add');
                }
                else{
                    redirect(base_url().'admin/location/locations-edit/'.$locations_id);
                }
            
        } else {

		        $uploadPath = PPATH."uploads/locations_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

                if($_FILES['logo_image']['name'] != ''){                
		            
		            if($this->upload->do_upload('logo_image')){
		                if($this->input->post('hiddenlogo_image') != "") {
		                    $old_image  = PPATH . 'uploads/locations_image/' . $this->input->post('hiddenlogo_image');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenlogo_image'));
		                    $old_resized_image  = PPATH . 'uploads/locations_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['logo_image'] = $fileData['file_name'];
		            }
                }

		        if($_FILES['image']['name'] != ''){                
		            
		            if($this->upload->do_upload('image')){
		                if($this->input->post('hiddenimage') != "") {
		                    $old_image  = PPATH . 'uploads/locations_image/' . $this->input->post('hiddenimage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenimage'));
		                    $old_resized_image  = PPATH . 'uploads/locations_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['image'] = $fileData['file_name'];
		            }
                }

                if($_FILES['image2']['name'] != ''){                
		            
		            if($this->upload->do_upload('image2')){
		                if($this->input->post('hiddenimage2') != "") {
		                    $old_image  = PPATH . 'uploads/service_image/' . $this->input->post('hiddenimage2');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenimage2'));
		                    $old_resized_image  = PPATH . 'uploads/service_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['image2'] = $fileData['file_name'];
		            }
                }


	            }

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
                    $param['locations_slug'] = setGeneralSlug(create_url_slug(trim($param['locations_title'])),'locations','locations_slug');
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Service has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Service has not been added!!!</p>';
	            break;

	            case 'edit':
                    $param['locations_slug'] = $this->input->post('locations_slug');
	                $param['locations_id'] = $this->input->post('locations_id');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Service has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Service has not been updated!!!</p>';
	            break;
	        }

	       
            $getResult = $this->location_model->alterlocationsDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/location/locations');
    }

    public function locations_edit($locations_id)
    {
        $userPermission = chk_user_permission('locations',['edit']);
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
            $data['class'] = 'location';
            $data['locations_details'] = $this->location_model->getalllocationsDetails($locations_id);
            $data['suburb_details'] = $this->location_model->getlocationsdetails();
            //$data['parent_categoris'] = $this->service_model->getparentcategorylists($data['service_details']['category']);
            // $data['service_gallery_image_details'] = $this->service_model->getServicegalleryimageDetails($serviceId);
            // echo "<pre>";print_r($data['service_gallery_image_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('location/backoffice/add-edit-locations','',$data,'normal');
        }
    }

    public function delete_active_inactive_multiple_locations()
    {
        $userPermission = chk_user_permission('locations',['edit','delete']);
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
                            // $this->service_model->delete_multiple_service($serviceId[$i]);
                            $this->location_model->delete_multiple_locations($dataId);
                            $msg = '<p class="success-msg">Service deleted successfully!</p>';
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
                                'locations_status' => $status
                            );
                            $response[] = $this->location_model->update_locations($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Service updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();
    }

    function locations_delete($locations_id)
    {
        $userPermission = chk_user_permission('locations',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->location_model->delete_locations($locations_id);
        $successMessage = '<p class="success-msg">locations has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/location/locations');
    }

    function suburb_list()
    {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'location';
            $suburb_details_count = $this->location_model->total_suburb();
            $suburb_details_count = count($suburb_details_count);
            $link = "admin/location/suburb";
            $returns = adminPaginationCompress($link, $suburb_details_count);
            $data['suburb_details'] = $this->location_model->getsuburbLists($returns["limit"], $returns["offset"]);
            // echo "<pre>";print_r($data['suburb_details']);die;
            $data['userPermission'] = chk_user_permission('suburb',['add','edit','delete','list']);
            $this->layout->view('location/backoffice/suburb_list','',$data,'normal');
        }
    }

    function suburb_add()
    {
        $userPermission = chk_user_permission('suburb',['add']);
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
            $data['class'] = 'location';
            $data['main_category_details'] = $this->location_model->getMainCategois();
            $data['get_category_details'] = $this->location_model->get_category_details();
            // echo "<pre>";print_r($data['get_category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('location/backoffice/add-edit-suburb','',$data,'normal');
        }
    }


    function suburbInsert()
    {
        $userPermission = chk_user_permission('suburb',['add','edit']);
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
        $param['suburb_title'] = trim(strip_tags($this->input->post('suburb_title')));
        // $param['category_id'] = $this->input->post('category_id');
        $param['suburb_status'] = trim(strip_tags($this->input->post('suburb_status')));
        $action = $this->input->post('action');
        $suburb_id = $this->input->post('suburb_id');
        // $param['parent_category'] = $this->input->post('parent_category');

		$this->form_validation->set_rules('suburb_title', 'suburb Name', 'required', 'suburb is required');
        //$this->form_validation->set_rules('categoryDescription', 'Category Description', 'required', 'Category Description is required');
        // $this->form_validation->set_rules('serviceImage', 'Service Image', 'required', 'Image is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/location/suburb-add');
                }
                else{
                    redirect(base_url().'admin/location/suburb-edit/'.$suburb_id );
                }
                    
        } else {

		        $uploadPath = PPATH."uploads/suburb_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['image']['name'] != ''){                
		            
		            if($this->upload->do_upload('image')){
		                if($this->input->post('hiddenimage') != "") {
		                    $old_image  = PPATH . 'uploads/suburb_image/' . $this->input->post('hiddenimage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenimage'));
		                    $old_resized_image  = PPATH . 'uploads/suburb_image/' . $thumbfileName;
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
                    $param['suburb_slug'] = setGeneralSlug(create_url_slug(trim($param['suburb_title'])),'suburb','suburb_title');
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">suburb has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">suburb has not been added!!!</p>';
	            break;

	            case 'edit':
                    // $param['suburb_slug'] = setGeneralSlug(create_url_slug(trim($param['suburb_title'])),'suburb','suburb_title');
	                $param['suburb_id'] = $this->input->post('suburb_id');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">suburb has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">suburb has not been updated!!!</p>';
	            break;
	        }

	       
            $getResult = $this->location_model->alterSuburbDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/location/suburb');
    }

    function suburb_edit($suburb_id)
    {
        $userPermission = chk_user_permission('suburb',['edit']);
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
            $data['class'] = 'location';
            $data['suburb_details'] = $this->location_model->getsuburb($suburb_id);
            $data['get_category_details'] = $this->location_model->get_category_details();
            // $data['main_category_details'] = $this->service_model->getMainCategois();
            //  echo "<pre>";print_r($data['category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('location/backoffice/add-edit-suburb','',$data,'normal');
        }
    }


    function suburb_delete($id)
    {
        $userPermission = chk_user_permission('suburb',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->location_model->delete_suburb_service($id);
        $successMessage = '<p class="success-msg">suburb has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/location/suburb');
    }

    public function delete_active_inactive_multiple_suburb()
    {

        $userPermission = chk_user_permission('suburb',['edit','delete']);
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
                            // $this->service_model->delete_multiple_service($serviceId[$i]);
                            $this->location_model->delete_multiple_suburb_category($dataId);
                            $msg = '<p class="success-msg">Suburb deleted successfully!</p>';
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
                                'suburb_status' => $status
                            );
                            $response[] = $this->location_model->update_suburb_category($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">suburb updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();

        
    }

    function suburb_category()
    {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'location';
            $suburb_category_details_count = $this->location_model->total_suburb_category();
            $suburb_category_details_count = count($suburb_category_details_count);
            $link = "admin/location/suburb";
            $returns = adminPaginationCompress($link, $suburb_category_details_count);
            $data['suburb_category_details'] = $this->location_model->getSuburbCategoryLists($returns["limit"], $returns["offset"]);
            // echo "<pre>";print_r($data['suburb_details']);die;
            $data['userPermission'] = chk_user_permission('suburb-category',['add','edit','delete','list']);
            $this->layout->view('location/backoffice/suburb-category-list','',$data,'normal');
        }
    }
    function category_add()
    {
        $userPermission = chk_user_permission('suburb-category',['add']);
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
            $data['class'] = 'location';
            $data['main_category_details'] = $this->location_model->getMainCategois();
            // echo "<pre>";print_r($data['main_category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('location/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function categoryInsert()
    {
        $userPermission = chk_user_permission('suburb-category',['add','edit']);
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
        $param['category_status'] = trim(strip_tags($this->input->post('categoryStatus')));
        $action = $this->input->post('action');
        $category_id = $this->input->post('categoryId');

		$this->form_validation->set_rules('categoryName', 'Category Name', 'required', 'Category is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/location/category-add');
                }
                else{
                    redirect(base_url().'admin/service/service-category-edit/'.$category_id);
                }
                    
        } else {}

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
                    $param['category_slug'] = setGeneralSlug(create_url_slug(trim($param['category_title'])),'suburb_category','category_slug');
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

	       
            $getResult = $this->location_model->alterCategoryDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/location/suburb-category');
    }

    function category_edit($categoryId)
    {
        $userPermission = chk_user_permission('suburb-category',['edit']);
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
            $data['class'] = 'location';
            $data['category_details'] = $this->location_model->getcategory($categoryId);
            $this->layout->view('location/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function category_delete($id)
    {
        $userPermission = chk_user_permission('suburb-category',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->location_model->delete_category($id);
        $successMessage = '<p class="success-msg">Suburb Category has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/location/suburb-category');
    }

    public function delete_active_inactive_multiple_category()
    {

        $userPermission = chk_user_permission('suburb-category',['edit','delete']);
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
                            // $this->service_model->delete_multiple_service($serviceId[$i]);
                            $this->location_model->delete_multiple_category($dataId);
                            $msg = '<p class="success-msg">Category deleted successfully!</p>';
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
                            $response[] = $this->location_model->suburb_category($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">category updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();

        
    }

    // public function servicegalleryInsert()
    // {
    //             $param['ServiceDetailsTitle'] = trim(strip_tags($this->input->post('ServiceDetailsTitle')));
	// 	        $param['ServiceDetailsDescription'] = $this->input->post('ServiceDetailsDescription');
    //             $serviceId = $this->input->post('serviceId');
    //             $uploadPath = PPATH."uploads/service_image/";    
	// 	        $config['upload_path'] = $uploadPath;
	// 	        $config['allowed_types'] = 'jpg|jpeg|png';
	// 	        $config['encrypt_name'] = TRUE;

	// 	        // Load and initialize upload library
	// 	        $this->load->library('upload', $config);
	// 	        $this->upload->initialize($config);
	// 	        if($_FILES['service_gallery_image']['name'] != ''){                
		            
	// 	            if($this->upload->do_upload('service_gallery_image')){
	// 	                $fileData = $this->upload->data();
	// 	               	$param['image'] = $fileData['file_name'];
	// 	            }
    //             }

    //         $service_image_data = array(
    //                                     'service_gallery_image'=>$param['image'],
    //                                     'ServiceDetailsDescription'=>$param['ServiceDetailsDescription'],
    //                                     'ServiceDetailsTitle'=>$param['ServiceDetailsTitle'],
    //                                     'serviceId'=>$serviceId,
    //                                     'created_on'=>date('Y-m-d')
    //                                 );
    //         $this->db->insert('service_image_gallery',$service_image_data);
    //         redirect(base_url().'admin/location/locations-edit/'.$serviceId);                         
    // }

    // public function service_gallery_image_delete($service_gallery_image_id,$serviceId)
    // {
    //     $this->db->select('*');
    //     $this->db->from('service_image_gallery');
    //     $this->db->where('service_gallery_image_id',$service_gallery_image_id);
    //     $postquery = $this->db->get()->result(); 
    //     $posturl = PPATH."uploads/service_image/".$postquery[0]->service_gallery_image;
    //     unlink($posturl);
    //     $this->db->where('service_gallery_image_id',$service_gallery_image_id);
    //     $this->db->delete('service_image_gallery');

    //     redirect(base_url().'admin/location/locations-edit/'.$serviceId);
    // }

    // public function service_inquiry()
    // {
    //     $data['error'] = "";
    //     $data['class'] = "service";
    //     $data['userPermission'] = chk_user_permission('service-inquiry',['add','edit','delete','list']);
    //     $service_inquiry_count = $this->service_model->total_service_inquiry();
    //     $service_inquiry_count = count($service_inquiry_count);
    //     $link = "admin/service/service-inquiry";
    //     $returns = adminPaginationCompress($link, $service_inquiry_count);
    //     $data['serviceinquirylist'] = $this->service_model->get_service_inquiry($returns["limit"], $returns["offset"]);
     
    //     // echo "<pre>";print_r($data['jobsList']);die;
    //     $this->layout->view('service/backoffice/service-inquiry-list', '', $data, 'normal');
    // }

    // public function service_inquiry_details($id)
    // {
    //     $data['error'] = "";
    //     $data['class'] = "service";
    //     $data['serviceinquirydetails'] = $this->service_model->get_service_inquiry_details($id);
    //     $data['userPermission'] = chk_user_permission('service-inquiry', ['add', 'edit', 'delete', 'list']);
    //     // echo "<pre>";print_r($data['jobsList']);die;
    //     $this->layout->view('service/backoffice/service-inquiry-details', '', $data, 'normal');
    // }

    // public function delete_active_inactive_multiple_service_inquiry()
    // {
    //     $userPermission = chk_user_permission('service-inquiry', ['delete']);
    //     $dataIds = $this->input->post('dataIds');
    //     $actionType = $this->input->post('actionType');
    //     $status = 0;
    //     switch ($actionType) {
    //         case 'delete':
    //             if (!$userPermission['delete']) {
    //                 $this->session->set_flashdata('error', '<p class="error-msg">' . BLOCK_SECTION_MSG . '</p>');
    //                 $status = 2;
    //             } else {
    //                 foreach ($dataIds as $dataId) {
    //                     $this->service_model->delete_multiple_service_inquiry($dataId);
    //                     $msg = '<p class="success-msg"> Service inquiry deleted successfully!</p>';
    //                     $this->session->set_flashdata('success', $msg);
    //                     $status = 1;
    //                 }
    //             }
    //             break;
    //     }
    //     echo json_encode(array('status' => $status));
    //     exit();
    // }

    // public function delete_service_inquiry($id)
    // {
    //     $this->db->where('service_inquiry_id', $id);
    //     $this->db->delete('service_inquiry');

    //     $msg = '<p class="success-msg">Service inquiry deleted successfully!</p>';
    //     $this->session->set_flashdata('success', $msg);
    //     redirect(base_url().'admin/service/service-inquiry');
    // }

    public function is_home_featured_service()
    {
        $status = 0;
        $serviceId = $this->input->post('serviceId');
        $is_home_value = $this->input->post('is_home_value');
        $data = array('is_home' => $is_home_value);
        $is_home = $this->service_model->updateIsHomeservice($serviceId,$data);
        $csrf_token = $this->security->get_csrf_hash();
        if($is_home > 0)
        {
            $status = 1;
        }
        else{
            $status = 1;
        }

        echo json_encode(array('status'=>$status,'csrf_token'=>$csrf_token));
        exit();
    }


    

}

