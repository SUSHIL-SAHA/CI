<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('banner/backoffice/banner_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "banner";

        $data['bannerList'] = $this->banner_model->getBannerLists();
        $data['userPermission'] = chk_user_permission('homebanner',['add','edit','delete','list']);
        
        $this->layout->view('banner/backoffice/home-banner-list','',$data,'normal');
    }

    public function addBanner()
	{
        $userPermission = chk_user_permission('homebanner',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }

		$data['pageTitle'] = 'Home Add Banner';
        $data['class'] = "banner";
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('banner/backoffice/add-edit-banner','',$data,'normal');
	}

    public function bannerInsert()
	{
        $userPermission = chk_user_permission('homebanner',['add','edit']);
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
        $banner_id = $this->input->post('bannerId');
        $action = $this->input->post('action');
        $param['BannerTitle'] = $this->security->xss_clean($this->input->post('BannerTitle'));
		// $param['BannerTitle'] = trim(strip_tags($this->input->post('BannerTitle')));
        // $param['BannerDescription'] = strip_tags($this->input->post('BannerDescription'));
		$param['bannerStatus'] = trim(strip_tags($this->input->post('bannerStatus')));

        $this->form_validation->set_rules('BannerTitle', 'Home Banner Title', 'required', 'Home banner Title is required');
        // $this->form_validation->set_rules('BannerDescription', 'Home Banner Description', 'required', 'Home Banner Description is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/banner/addBanner');
            }
            else
            {
                redirect(base_url().'admin/banner/editbanner/'.$banner_id);
            }

        } else {
            $uploadPath = PPATH."uploads/banner_image/";    
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name'] = TRUE;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($_FILES['bannerImage']['name'] != ''){                
                
                if($this->upload->do_upload('bannerImage')){
                    if($this->input->post('hiddenbannerImage') != "") {
                        $old_image  = PPATH . 'uploads/banner_image/' . $this->input->post('hiddenbannerImage');
                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenbannerImage'));
                        $old_resized_image  = PPATH . 'uploads/banner_image/' . $thumbfileName;
                        unlink($old_image);
                        unlink($old_resized_image);
                    }
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $param['bannerImage'] = $fileData['file_name'];
                }
        }
        
        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Banner has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Banner has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['bannerId'] = $this->input->post('bannerId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Banner has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Banner has not been updated!!!</p>';
	            break;
	        }
            $getResult = $this->banner_model->alterBannerDetails($param, $action);
	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/banner/homebanner');
	    }
	}


    public function editbanner($bannerId){
        $userPermission = chk_user_permission('homebanner',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if($bannerId != ""){
            $data['pageTitle'] = 'Edit banner';
            $data['class'] = "banner";
            $data['banner_details'] = $this->banner_model->getbannerSingle($bannerId);
           
               // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('banner/backoffice/add-edit-banner','',$data,'normal');
            
        } else {
            redirect(base_url().'admin/banner/homebanner');
        }
    }

    public function delete_active_inactive_multiple_banner()
    {

            $userPermission = chk_user_permission('homebanner',['edit', 'delete']);
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
                            $this->banner_model->delete_multiple_banner($dataId);
                            $msg = '<p class="success-msg">Home banner image deleted successfully!</p>';
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
                        // $status = ($actionType == 'act') ? '1' : '0';
                        // foreach($dataIds as $dataId){
                        //     $data = array(
                        //         'bannerStatus' => $status
                        //     );
                        //     $response = $this->banner_model->update_banner($data, $dataId);
                        //     if($response){
                        //         $msg = '<p class="success-msg">Home banner updated successfully!</p>';
                        //         $this->session->set_flashdata('success', $msg);
                        //         $status = 1;
                        //     }
                        // }
                        $response=[];
                        $status = ($actionType == 'act') ? '1' : '0';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'bannerStatus' => $status
                            );

                            $response[] = $this->banner_model->update_banner($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Home banner updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }

    public function delete($banner_id)
    {
        $userPermission = chk_user_permission('homebanner',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->banner_model->delete_banner($banner_id);
        $successMessage = '<p class="success-msg">Banner has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/banner/homebanner');
    }

    public function inner_banner_list()
    {
        $data['pageTitle'] = 'Inner banner list';
        $data['class'] = "banner";
        $total_innerbanner = $this->banner_model->total_innerbanner();
        $total_innerbanner = count($total_innerbanner);
        $link = "admin/banner/innerbanner";
        $returns = adminPaginationCompress($link, $total_innerbanner);
        $data['bannerList'] = $this->banner_model->getinnerBannerLists($returns["limit"], $returns["offset"]);
        $data['userPermission'] = chk_user_permission('innerbanner',['add','edit','delete','list']);

        $this->layout->view('banner/backoffice/inner-banner-list','',$data,'normal');
    }

    public function inner_banner_add()
    {
        $userPermission = chk_user_permission('innerbanner',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $data['pageTitle'] = 'Inner banner add';
        $data['class'] = 'banner';
        $data['cms_page'] = $this->banner_model->getcmspage();
        // echo "<pre>";print_r($data['cms_page']);die;
      

        $this->layout->view('banner/backoffice/add-edit-inner-banner','',$data,'normal');
    }


    public function Innerbannerinsert()
	{
        $userPermission = chk_user_permission('innerbanner',['add','edit']);
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
		$param['page_name'] = trim(strip_tags($this->input->post('page_name')));
		$param['bannerStatus'] = trim(strip_tags($this->input->post('bannerStatus')));
        $action = $this->input->post('action');
        $inner_banner_id = $this->input->post('innerbannerId');
		 $this->form_validation->set_rules('page_name', 'Select Page Name', 'required', 'Title is required');
        $this->form_validation->set_rules('bannerStatus', 'Banner Status', 'required', 'Status is required');

        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
            redirect(base_url().'admin/banner/inner-banner-add');
            }
            else
            {
                redirect(base_url().'admin/banner/inner-banner-edit/'.$inner_banner_id);
            }

        } else {

		        $uploadPath = PPATH."uploads/banner_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['innerbannerImage']['name'] != ''){                
		            
		            if($this->upload->do_upload('innerbannerImage')){
		                if($this->input->post('innerhiddenbannerImage') != "") {
		                    $old_image  = PPATH . 'uploads/banner_image/' . $this->input->post('innerhiddenbannerImage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('innerhiddenbannerImage'));
		                    $old_resized_image  = PPATH . 'uploads/banner_image/' . $thumbfileName;
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
	                $successMessage = '<p class="success-msg">Inner banner has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Inner banner has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['innerbannerId'] = $this->input->post('innerbannerId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Inner banner has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Inner banner has not been updated!!!</p>';
	            break;
	        }

	        // print_r($param);die;

            $getResult = $this->banner_model->alterinnerBannerDetails($param, $action);

            // echo $getResult ;die;
           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/banner/innerbanner');
	    }

        public function inner_banner_edit($bannerId)
        {
            $userPermission = chk_user_permission('innerbanner',['edit']);
            if(!$userPermission['edit'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
            $data['pageTitle'] = 'Inner banner edit';
            $data['class'] = "banner";
            $data['cms_page'] = $this->banner_model->getcmspage();
            $data['banner_details'] = $this->banner_model->getinnerbannerSingle($bannerId);
            $this->layout->view('banner/backoffice/add-edit-inner-banner','',$data,'normal');
        }


    public function delete_active_inactive_multiple_inner_banner()
    {

            $userPermission = chk_user_permission('innerbanner',['edit', 'delete']);
            $dataIds = $this->input->post('dataIds');
            $actionType = $this->input->post('actionType');
            //   echo 'okk'.$actionType;die;
            
            $status = 0;
            switch($actionType){
                case 'delete':
                    if(!$userPermission['delete']){
                        $this->session->set_flashdata('error', '<p class="error-msg">'.BLOCK_SECTION_MSG.'</p>');
                        $status = 2;
                    }else{
                        foreach($dataIds as $dataId){
                            $this->banner_model->delete_multiple_innmer_banner($dataId);
                            $msg = '<p class="success-msg">Inner banner image deleted successfully!</p>';
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
                                'bannerStatus' => $status
                            );

                            $response[] = $this->banner_model->update_inner_banner($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Inner Banner updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }

        public function inner_banner_delete($bannerId)
        { 
            $response = $this->banner_model->delete_inner_banner($bannerId);
            $successMessage = '<p class="success-msg">Inner banner has been deleted!!!</p>';
            $this->session->set_flashdata('success', $successMessage);
            redirect(base_url().'admin/banner/innerbanner');

        }
	



    

}

