<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Service extends MX_Controller {

    public function __construct() {
        if(!$this->session->userdata('user')) {
			redirect(base_url()."admin/login");
		}
        $this->load->model('service/backoffice/service_model');
        $this->load->library(array('form_validation', 'upload', 'image_lib'));

    }
    public function index() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['userPermission'] = chk_user_permission('allservice',['add','edit','delete','list']);
            $data['error'] = "";
            $data['class'] = 'service';
            $service_details_count = $this->service_model->total_service();
            $service_details_count = count($service_details_count);
            $link = "admin/service/allservice";
            $returns = adminPaginationCompress($link, $service_details_count);
            $data['service_details'] = $this->service_model->getserviceLists($returns["limit"], $returns["offset"]);
           
            // echo "<pre>";print_r($data['service_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('service/backoffice/service-list','',$data,'normal');
        }

        
    }

    public function service_add()
    {
        $userPermission = chk_user_permission('allservice',['add']);
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
            $data['class'] = 'service';
            $data['category_details'] = $this->service_model->getcategorydetails();
            // echo "<pre>" ; print_r($data['category_details']);die;
            $this->layout->view('service/backoffice/add-edit-service','',$data,'normal');
        }


    }

    public function get_parent_category()
    {
        $status = 0;
        $category_id = $this->input->post('category_id');
        $parrent_category = $this->service_model->getparentcategorylists($category_id);
        $csrf_token = $this->security->get_csrf_hash();
        if(count($parrent_category) > 0)
        {
            $status = 1;
        }
        else{
            $status = 1;
        }

        echo json_encode(array('status'=>$status,'parrent_category'=>$parrent_category,'csrf_token'=>$csrf_token));
        exit();
    }

    public function is_home_service()
    {
        $status = 0;
        $categoryId = $this->input->post('categoryId');
        $is_home_value = $this->input->post('is_home_value');
        $data = array('is_home' => $is_home_value);
        $is_home = $this->service_model->updateIsHomeCategory($categoryId,$data);
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

    public function serviceInsert()
    {
        $userPermission = chk_user_permission('allservice',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $param['service_title'] = trim(strip_tags($this->input->post('ServiceTitle')));
        
		$param['ServiceShortDescription'] = $this->input->post('ServiceShortDescription');
        // $param['ServicePrice'] = $this->input->post('ServicePrice');
        $param['show_other_Service'] = $this->input->post('show_other_Service');
        $param['service_description'] = $this->input->post('ServiceDescription');
        $param['ServiceOtherTitle'] = $this->input->post('ServiceOtherTitle');
        $param['ServiceOtherDescription'] = $this->input->post('ServiceOtherDescription');
        $param['ServiceOtherTitle2'] = $this->input->post('ServiceOtherTitle2');
        $param['ServiceOtherDescription2'] = $this->input->post('ServiceOtherDescription2');
        $param['service_status'] = trim(strip_tags($this->input->post('serviceStatus')));
        $param['category'] = trim(strip_tags($this->input->post('category')));
        $param['parent_category'] = trim(strip_tags($this->input->post('parent_category')));
        $param['metaTitle'] = $this->input->post('metaTitle');
        $param['metaKeyword'] = $this->input->post('metaKeyword');
        $param['metaDescription'] = $this->input->post('metaDescription');

        $action = $this->input->post('action');
        $service_id = $this->input->post('serviceId');
		$this->form_validation->set_rules('ServiceTitle', 'Title Name', 'required', 'Title is required');
        $this->form_validation->set_rules('ServiceDescription', 'Service Description', 'required', 'Description is required');
        $this->form_validation->set_rules('ServiceShortDescription', 'Service Short Description', 'required', 'Short description is required');
        $this->form_validation->set_rules('category', 'Category', 'required', 'Category is required');
        // $this->form_validation->set_rules('ServicePrice', 'Service Price', 'required', 'Price is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/service/service-add');
                }
                else{
                    redirect(base_url().'admin/service/service-edit/'.$service_id);
                }
            
        } else {

		        $uploadPath = PPATH."uploads/service_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['serviceImage']['name'] != ''){                
		            
		            if($this->upload->do_upload('serviceImage')){
		                if($this->input->post('hiddenserviceImage') != "") {
		                    $old_image  = PPATH . 'uploads/service_image/' . $this->input->post('hiddenserviceImage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenserviceImage'));
		                    $old_resized_image  = PPATH . 'uploads/service_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['image'] = $fileData['file_name'];
		            }
                }

                if($_FILES['service_icon']['name'] != ''){                
		            
		            if($this->upload->do_upload('service_icon')){
		                if($this->input->post('hiddenservice_icon') != "") {
		                    $old_image  = PPATH . 'uploads/service_image/' . $this->input->post('hiddenservice_icon');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenservice_icon'));
		                    $old_resized_image  = PPATH . 'uploads/service_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['service_icon'] = $fileData['file_name'];
		            }
                }
                if($_FILES['ServiceOtherImage']['name'] != ''){                
		            
		            if($this->upload->do_upload('ServiceOtherImage')){
		                if($this->input->post('hiddenServiceOtherImage') != "") {
		                    $old_image  = PPATH . 'uploads/service_image/' . $this->input->post('hiddenServiceOtherImage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenServiceOtherImage'));
		                    $old_resized_image  = PPATH . 'uploads/service_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['ServiceOtherImage'] = $fileData['file_name'];
		            }
                }


	            }

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
                    $param['service_slug'] = setGeneralSlug(create_url_slug(trim($param['service_title'])), 'service', 'service_slug');
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Service has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Service has not been added!!!</p>';
	            break;

	            case 'edit':
                    $param['service_slug'] = $this->input->post('service_slug');
	                $param['serviceId'] = $this->input->post('serviceId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Service has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Service has not been updated!!!</p>';
	            break;
	        }

	       
            $getResult = $this->service_model->alterServiceDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/service/allservice');
    }

    public function service_edit($serviceId)
    {
        $userPermission = chk_user_permission('allservice',['edit']);
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
            $data['class'] = 'service';
            $data['service_details'] = $this->service_model->getServiceDetails($serviceId);
            $data['category_details'] = $this->service_model->getcategorydetails();
            //$data['parent_categoris'] = $this->service_model->getparentcategorylists($data['service_details']['category']);
            $data['service_gallery_image_details'] = $this->service_model->getServicegalleryimageDetails($serviceId);
            // echo "<pre>";print_r($data['service_gallery_image_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('service/backoffice/add-edit-service','',$data,'normal');
        }
    }

    public function delete_active_inactive_multiple_service()
    {
        $userPermission = chk_user_permission('allservice',['edit','delete']);
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
                            $this->service_model->delete_multiple_service($dataId);
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
                                'service_status' => $status
                            );
                            $response[] = $this->service_model->update_service($data, $dataId);
                            
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

    function service_delete($serviceId)
    {
        $userPermission = chk_user_permission('allservice',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->service_model->delete_service($serviceId);
        $successMessage = '<p class="success-msg">Service has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/service/allservice');
    }

    function category_list()
    {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'service';
            $category_details_count = $this->service_model->total_category();
            $category_details_count = count($category_details_count);
            $link = "admin/service/servicecategory";
            $returns = adminPaginationCompress($link, $category_details_count);
            $data['category_details'] = $this->service_model->getcategoryLists($returns["limit"], $returns["offset"]);
            //   echo "<pre>";print_r($data['category_details']);die;
            $data['userPermission'] = chk_user_permission('servicecategory',['add','edit','delete','list']);
            $this->layout->view('service/backoffice/service-category-list','',$data,'normal');
        }
    }

    function category_add()
    {
        $userPermission = chk_user_permission('servicecategory',['add']);
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
            $data['class'] = 'service';
            $data['main_category_details'] = $this->service_model->getMainCategois();
            // echo "<pre>";print_r($data['main_category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('service/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function categoryInsert()
    {
        $userPermission = chk_user_permission('servicecategory',['add','edit']);
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
        $param['sort'] = $this->input->post('sort');
		// $param['category_description'] = trim(strip_tags($this->input->post('categoryDescription')));
        $param['category_status'] = trim(strip_tags($this->input->post('categoryStatus')));
        $action = $this->input->post('action');
        $category_id = $this->input->post('categoryId');
        // $param['parent_category'] = $this->input->post('parent_category');

		$this->form_validation->set_rules('categoryName', 'Category Name', 'required', 'Category is required');
        //$this->form_validation->set_rules('categoryDescription', 'Category Description', 'required', 'Category Description is required');
        // $this->form_validation->set_rules('serviceImage', 'Service Image', 'required', 'Image is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/service/category-add');
                }
                else{
                    redirect(base_url().'admin/service/service-category-edit/'.$category_id);
                }
                    
        } else {

		        $uploadPath = PPATH."uploads/category_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['categoryImage']['name'] != ''){                
		            
		            if($this->upload->do_upload('categoryImage')){
		                if($this->input->post('hiddencategoryImage') != "") {
		                    $old_image  = PPATH . 'uploads/category_image/' . $this->input->post('hiddencategoryImage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddencategoryImage'));
		                    $old_resized_image  = PPATH . 'uploads/category_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['image'] = $fileData['file_name'];
		            }
                }

                if($_FILES['bannerImage']['name'] != ''){                
		            
		            if($this->upload->do_upload('bannerImage')){
		                if($this->input->post('hiddenbannerImage') != "") {
		                    $old_image  = PPATH . 'uploads/category_image/' . $this->input->post('hiddenbannerImage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenbannerImage'));
		                    $old_resized_image  = PPATH . 'uploads/category_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['bannerImage'] = $fileData['file_name'];
		            }
                }
	    }

	        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
                    $param['category_slug'] = setGeneralSlug(create_url_slug(trim($param['category_title'])),'service_category','category_slug');
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

	       
            $getResult = $this->service_model->alterCategoryDetails($param, $action);

           
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/service/servicecategory');
    }

    function service_category_edit($categoryId)
    {
        $userPermission = chk_user_permission('servicecategory',['edit']);
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
            $data['class'] = 'service';
            $data['category_details'] = $this->service_model->getcategory($categoryId);
            // $data['main_category_details'] = $this->service_model->getMainCategois();
            //  echo "<pre>";print_r($data['category_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('service/backoffice/add-edit-category','',$data,'normal');
        }
    }


    function service_category_delete($id)
    {
        $userPermission = chk_user_permission('servicecategory',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->service_model->delete_category_service($id);
        $successMessage = '<p class="success-msg">Service category has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/service/servicecategory');
    }

    public function delete_active_inactive_multiple_category()
    {

        $userPermission = chk_user_permission('servicecategory',['edit','delete']);
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
                            $this->service_model->delete_multiple_service_category($dataId);
                            $msg = '<p class="success-msg">Service category deleted successfully!</p>';
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
                            $response[] = $this->service_model->update_service_category($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Service category updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }

            echo json_encode(array('status'=>$status));
            exit();

        
    }

    public function servicegalleryInsert()
    {
                $param['ServiceDetailsTitle'] = trim(strip_tags($this->input->post('ServiceDetailsTitle')));
		        $param['ServiceDetailsDescription'] = $this->input->post('ServiceDetailsDescription');
                $serviceId = $this->input->post('serviceId');
                $uploadPath = PPATH."uploads/service_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);
		        if($_FILES['service_gallery_image']['name'] != ''){                
		            
		            if($this->upload->do_upload('service_gallery_image')){
		                $fileData = $this->upload->data();
		               	$param['image'] = $fileData['file_name'];
		            }
                }

            $service_image_data = array(
                                        'service_gallery_image'=>$param['image'],
                                        'ServiceDetailsDescription'=>$param['ServiceDetailsDescription'],
                                        'ServiceDetailsTitle'=>$param['ServiceDetailsTitle'],
                                        'serviceId'=>$serviceId,
                                        'created_on'=>date('Y-m-d')
                                    );
            $this->db->insert('service_image_gallery',$service_image_data);
            redirect(base_url().'admin/service/service-edit/'.$serviceId);                         
    }

    public function service_gallery_image_delete($service_gallery_image_id,$serviceId)
    {
        $this->db->select('*');
        $this->db->from('service_image_gallery');
        $this->db->where('service_gallery_image_id',$service_gallery_image_id);
        $postquery = $this->db->get()->result(); 
        $posturl = PPATH."uploads/service_image/".$postquery[0]->service_gallery_image;
        unlink($posturl);
        $this->db->where('service_gallery_image_id',$service_gallery_image_id);
        $this->db->delete('service_image_gallery');

        redirect(base_url().'admin/service/service-edit/'.$serviceId);
    }

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
    //     $data['service_inquire_product_details']= $this->service_model->service_inquire_product_details($id);
    //     $data['vehicleDetails']= $this->service_model->getVehicleDetails();
    //     $data['userPermission'] = chk_user_permission('service-inquiry', ['add', 'edit', 'delete', 'list']);
    //     // echo "<pre>";print_r($data['service_inquire_product_details']);die;
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
    public function vehicle_inquiry()
    {
        $data['error'] = "";
        $data['class'] = "service";
        $data['userPermission'] = chk_user_permission('vehicle-inquiry',['add','edit','delete','list']);
        $service_inquiry_count = $this->service_model->total_vehicle_inquiry();
        $service_inquiry_count = count($service_inquiry_count);
        $link = "admin/service/service-inquiry";
        $returns = adminPaginationCompress($link, $service_inquiry_count);
        $data['serviceinquirylist'] = $this->service_model->get_vehicle_inquiry($returns["limit"], $returns["offset"]);
     
        // echo "<pre>";print_r($data['jobsList']);die;
        $this->layout->view('service/backoffice/vehicle-inquiry-list', '', $data, 'normal');
    }
    public function vehicle_inquiry_details($id)
    {
        $data['error'] = "";
        $data['class'] = "service";
        $data['vehicleinquirydetails'] = $this->service_model->get_vehicle_inquiry_details($id);
        $data['userPermission'] = chk_user_permission('vehicle-inquiry', ['add', 'edit', 'delete', 'list']);
        // echo "<pre>";print_r($data['jobsList']);die;
        $this->layout->view('service/backoffice/vehicle-inquiry-details', '', $data, 'normal');
    }
    public function delete_active_inactive_multiple_vehicle_inquiry()
    {
        $userPermission = chk_user_permission('vehicle-inquiry', ['delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
        switch ($actionType) {
            case 'delete':
                if (!$userPermission['delete']) {
                    $this->session->set_flashdata('error', '<p class="error-msg">' . BLOCK_SECTION_MSG . '</p>');
                    $status = 2;
                } else {
                    foreach ($dataIds as $dataId) {
                        $this->service_model->delete_multiple_vehicle_inquiry($dataId);
                        $msg = '<p class="success-msg"> Vehicle inquiry deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status' => $status));
        exit();
    }
    public function delete_vehicle_inquiry($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('book_vehicle');

        $msg = '<p class="success-msg">Vehicle inquiry deleted successfully!</p>';
        $this->session->set_flashdata('success', $msg);
        redirect(base_url().'admin/service/vehicle-inquiry');
    }


    public function sand_email($id)
    {
        $serviceinquirydetails = $this->service_model->get_service_inquiry_details($id);
        $service_inquire_product_details= $this->service_model->service_inquire_product_details($id);
        $config = array(

            'protocol' => PROTOCOL,
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'charset' => 'utf-8',
            'smtp_crypto' => SMTPSECURE,
            'smtp_timeout' => '5',
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASSWORD,
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        );  
        $this->load->library('email', $config);
        $this->email->from('noreplyeclick@gmail.com');
        $this->email->to($serviceinquirydetails->email);
        $this->email->subject('');
        $body = [ 
            'name' => $serviceinquirydetails->name,
        ];
        // $this->email->Body = $htmlMessage;
        // $body = $this->load->view('service/backoffice/email', '', $serviceinquirydetails, $service_inquire_product_details, 'normal');
        $this->email->message($body);
        $this->email->send();
        redirect(base_url().'admin/service/service-inquiry');
    } 

    public function sendQuotation(){
        $retData = $data = [];
        $retData['resp'] = 0;
        $retData['msg'] = '';
        $inquiryID = $this->input->post('hidden_inquiry_id');
        $vehicleId = $this->input->post('vehicleId');
        $quoted_price = $this->input->post('quoted_price');

        $sendOn = date('Y-m-d H:i:s');

        $prefix = 'LS-';
        $invoiceNumber = $prefix . str_pad($inquiryID, 3, '0', STR_PAD_LEFT);
        $orderNumber = $prefix . str_pad($inquiryID, 6, '0', STR_PAD_LEFT);

        // Update Enquiry Details
        $insertArr['service_enquiry_id'] = $inquiryID;
        $insertArr['quoted_price'] = $quoted_price;
        $insertArr['order_number'] = $orderNumber;
        $insertArr['invoice_number'] = $invoiceNumber;
        $insertArr['updated_vehicle_id'] = $vehicleId;
        $insertArr['send_on'] = $sendOn;

        $insertData = $this->service_model->insertQuotation($insertArr);

        // exit();

        


        $getInquiryDetails = $this->service_model->get_service_inquiry_details($inquiryID);
        $getInquiryProductDetails = $this->service_model->service_inquire_product_details($inquiryID);
        $vehicleDetails = $this->service_model->getSingleVehicleDetails($vehicleId);
        $quotedPrice = $quoted_price;
        $order_number = $orderNumber;
        $invoice_number = $invoiceNumber;
        $invoice_send_on = $sendOn;

        // $htmlDataForPDF = $this->layout->view('service/backoffice/inquiry_pdf_invoice', '',  $data, '');
        $htmlDataForPDF = '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>LN Services</title>
            </head>
            <body style="background-color: #d4d4d7;">
                <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0;margin: 0 auto;border: none;outline: none;">
                    <tbody>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                    <tr>
                                        <td><img src="'.base_url(). '"uploads/sitesettings_image/"'.$hfData['logo_image'].'" alt="Infynity" style="max-width: 100%;"></td>
                                        
                                        <td colspan="2" style="text-align: right; margin-top: 0; font-weight: 700; font-size: 40px;line-height: 44px; position: relative; color: #717171;"><strong>INVOICE</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice No: #'.$invoice_number.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice Date: '.date('jS F, Y', strtotime($invoice_send_on)).'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right;  font-size: 18px;font-weight: 600; color: #343434;"><strong>Order No: '.$order_number.'</strong>  </td>
                                    </tr>
                                </table>
                            </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0;">
                                    <table style="border-spacing: 0; margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                        <tr>
                                            <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 28%;"><strong>Bill To</strong></td>
                                            <td style="width: 45%;"></td>
                                            <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 22%;"><strong>Ship To</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br>
                                            <strong>Pickup Address: </strong>'.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br>
                                            <strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'
                                            <br>
                                            '.$getInquiryDetails->email.'<br>
                                            '.$getInquiryDetails->phone.'<br>
                                            Vin</td>
                                            <td style="width: 16%;"></td>
                                            <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br>
                                            <strong>Pickup Address: </strong> '.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'
                                            <br>
                                            <strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'
                                            <br>
                                            '.$getInquiryDetails->email.'<br>
                                            '.$getInquiryDetails->phone.'<br>
                                            Vin</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0;">
                                    <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 30px 0px 0; border-spacing: 0; border-collapse: separate;">
                                        <tr>
                                            <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                                            <td style="padding: 16px 12px; font-weight: 700; width: 60%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                                            <td style="padding: 16px 12px; font-weight: 700; width: 25%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                                        </tr>';
                                        foreach ( $getInquiryProductDetails as $giKey => $giValue ) {
                    $htmlDataForPDF .= '<tr>
                                            <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> <?php echo sprintf("%02d", ($giKey+1)); ?></strong></td>
                                            <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">
                                                <div class="service_details_card" role="alert">
                                                    <figure>
                                                        <img src="'.base_url().'/uploads/product_image/'.$giValue['product_image'].'">
                                                    </figure>
                                                    <span>'.$giValue['product_title'].'</span>
                                                </div>
                                            </td>
                                            <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">'.$giValue['product_qty'].'</td>
                                        </tr>';
                                                
                                            }
                   $htmlDataForPDF .= '<tr>
                                            <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", (count($getInquiryProductDetails))).'</strong></td>
                                            <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">Vehicle Choosen: <strong>'.$vehicleDetails->vehicle_name.'</strong><figure><img src="'.base_url().'uploads/vehicle_image/'.$vehicleDetails->vehicle_image.'"></figure></td>
                                            <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">01</td>
                                        </tr>
                                        <tr>
                                            <td style="background: #fff; padding: 0; margin: 0;"></td>
                                            <td style="background: #fff; padding: 0; margin: 0;"></td>
                                            <td style="background: #fff; padding: 0; margin: 0;"></td>
                                            <td style="font-size: 13px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #000;color: #fff;text-align: center;border-right: 3px solid #fff;">Total:</td>
                                            <td style="font-size: 14px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #717171;color: #fff;text-align: center;border-left: 3px solid #fff;"><strong>'.$quotedPrice.'</strong></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <tr>
                            <td style="padding: 0; margin: 0; background: #fff;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0px 0px 20px; border-spacing: 0; border-collapse: separate; width: 100%; ">
                                    <tr>
                                        <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'assets/admin/img/mail.png" alt="806-655-5500">'.$row['helpline_email_address'].'</td>
                                        <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'assets/admin/img/web.png" alt="806-655-5500">www.lnservices.Com</td>
                                        <td style=" width: 18%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'assets/admin/img/call.png" alt="806-655-5500">'.$row['helpline_no'].'</td>
                                        <td style=" width: 36%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'assets/admin/img/location.png" alt="address">'.$row['address'].'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center;padding-top: 30px;"><strong>THANK YOU FOR YOUR BUSINESS</strong> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin: 0 auto; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0; border-spacing: 0; border-collapse: separate; width: 800x;">
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <img src="'.base_url().'assets/admin/img/bottomStrip.png" alt="" style="max-width: 100%; padding-bottom: 10px">
                        </td>
                    </tr>
                </table>
            </body>
        </html>';

        $pdfFolder = 'quotation_pdfs/';

        $mpdf = new \Mpdf\Mpdf();
        $filename = $invoiceNumber.'_quotation.pdf';
        $uploadsTo = "./uploads/".$pdfFolder.$filename;
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($htmlDataForPDF);
        $mpdf->Output($uploadsTo, "F");

        // Add as email Body

        $htmlDataForBody = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>LN Services</title>
        </head>
            <body style="background-color: #d4d4d7;">
                <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0; margin: 0 auto; border: none; outline: none;">
                    <tbody>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                    <tr>
                                        <td><img src="'.base_url(). '"uploads/sitesettings_image/"'.$hfData['logo_image'].'" alt="Infynity" style="max-width: 100%;"></td>
                                        
                                        <td colspan="2" style="text-align: right; margin-top: 0; font-weight: 700; font-size: 40px;line-height: 44px; position: relative; color: #717171;"><strong>INVOICE</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice No: #'.$invoice_number.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice Date: '.date('jS F, Y', strtotime($invoice_send_on)).'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right;  font-size: 18px;font-weight: 600; color: #343434;"><strong>Order No: '.$order_number.'</strong>  </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="border-spacing: 0; margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                    <tr>
                                        <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 28%;"><strong>Bill To</strong></td>
                                        <td style="width: 45%;"></td>
                                        <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 22%;"><strong>Ship To</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br>
                                        <strong>Pickup Address: </strong>'.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br>
                                        <strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'
                                        <br>
                                        '.$getInquiryDetails->email.'<br>
                                        '.$getInquiryDetails->phone.'<br>
                                        Vin</td>
                                        <td style="width: 16%;"></td>
                                        <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br>
                                        <strong>Pickup Address: </strong> '.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'
                                        <br>
                                        <strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'
                                        <br>
                                        '.$getInquiryDetails->email.'<br>
                                        '.$getInquiryDetails->phone.'<br>
                                        Vin</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 30px 0px 0; border-spacing: 0; border-collapse: separate;">
                                    <tr>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 60%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 25%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                                    </tr>';
                                    foreach ( $getInquiryProductDetails as $giKey => $giValue ) {
                $htmlDataForBody .= '<tr>
                                        <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> <?php echo sprintf("%02d", ($giKey+1)); ?></strong></td>
                                        <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">
                                            <div class="service_details_card" role="alert">
                                                <figure>
                                                    <img src="'.base_url().'/uploads/product_image/'.$giValue['product_image'].'">
                                                </figure>
                                                <span>'.$giValue['product_title'].'</span>
                                            </div>
                                        </td>
                                        <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">'.$giValue['product_qty'].'</td>
                                    </tr>';
                                    }
                $htmlDataForBody .= '<tr>
                                        <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", (count($getInquiryProductDetails))).'</strong></td>
                                        <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">Vehicle Choosen: <strong>'.$vehicleDetails->vehicle_name.'</strong><figure><img src="'.base_url().'/uploads/vehicle_image/'.$vehicleDetails->vehicle_image.'"></figure></td>
                                        <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">01</td>
                                    </tr>
                                    <tr>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="font-size: 13px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #000;color: #fff;text-align: center;border-right: 3px solid #fff;">Total:</td>
                                        <td style="font-size: 14px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #717171;color: #fff;text-align: center;border-left: 3px solid #fff;"><strong>'.$quotedPrice.'</strong></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0; background: #fff;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0px 0px 20px; border-spacing: 0; border-collapse: separate; width: 100%; ">
                                    <tr>
                                        <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'/assets/admin/img/mail.png" alt="806-655-5500">'.$row['helpline_email_address'].'</td>
                                        <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'/assets/admin/img/web.png" alt="806-655-5500">www.lnservices.Com</td>
                                        <td style=" width: 18%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'/assets/admin/img/call.png" alt="806-655-5500">'.$row['helpline_no'].'</td>
                                        <td style=" width: 36%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="'.base_url().'/assets/admin/img/location.png" alt="address">'.$row['address'].'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center;padding-top: 30px;"><strong>THANK YOU FOR YOUR BUSINESS</strong> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin: 0 auto; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0; border-spacing: 0; border-collapse: separate; width: 800px;">
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <img src="'.base_url().'/assets/admin/img/bottomStrip.png" alt="" style="max-width: 100%; padding-bottom: 10px">
                        </td>
                    </tr>
                </table>
            </body>
        </html>';
        $config = array(
            'protocol' => PROTOCOL,
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'charset' => 'utf-8',
            'smtp_crypto' => SMTPSECURE,
            'smtp_timeout' => '5',
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASSWORD,
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        );  
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->from('noreplyeclick@gmail.com');
        $this->email->to('eclick.souravdas@gmail.com'); // $serviceinquirydetails->email
        $this->email->subject('Quotation for your order #'.$orderNumber.' On LN Services');
        $this->email->attach($uploadsTo);
        $this->email->message($htmlDataForBody);
        if($this->email->send()){
            $retData['resp'] = 1;
            $retData['msg'] = 'Invoice has been sent to customer';
        }

        /*echo json_encode($retData);
        exit();*/
    }

    public function testPDF(){
        $mpdf = new \Mpdf\Mpdf();
        $filename = time()."_order.pdf";
        $html = '<table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0; border-spacing: 0; border-collapse: separate; width: 660px;">
            <tr>
                <td style="padding: 16px 12px; font-weight: 700; width: 5%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                <td style="padding: 16px 12px; font-weight: 700; width: 40%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Price</td>
                <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">total</td>
            </tr>
        </table>';
        $mpdf->WriteHTML($html);
        $mpdf->Output("./uploads/".$filename, "I");

    }
    

}

