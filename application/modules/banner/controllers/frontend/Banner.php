<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends MX_Controller {

    public function __construct() {
        $this->load->model('banner_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {

        if(!$this->session->userdata('user'))
		{
			redirect(VPATH."login/");
		}
        else{
            $data['error'] = "";
            $data['class'] = "Banner-calss";
            $data['bannerList'] = $this->banner_model->getBannerLists();
            //  echo "<pre>";print_r($data['bannerList']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('home-banner-list','',$data,'normal');
        }
    }

    public function addBanner()
	{
		$data['pageTitle'] = 'Home Add Banner';
        $data['class'] = 'Banner-calss';
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('add-edit-banner','',$data,'normal');
	}

    public function bannerInsert()
	{

        $banner_id = $this->input->post('bannerId');
        $action = $this->input->post('action');
		$param['BannerTitle'] = trim(strip_tags($this->input->post('BannerTitle')));
		$param['bannerStatus'] = trim(strip_tags($this->input->post('bannerStatus')));

        $this->form_validation->set_rules('BannerTitle', 'Home Banner Title', 'required', 'Home banner Title is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(VPATH.'banner/addBanner');
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

	        redirect(VPATH.'banner');
	    }
	}


    public function editbanner($bannerId){
        if($bannerId != ""){
            $data['pageTitle'] = 'Edit banner';
            $data['class'] = 'Banner-calss';
            $data['banner_details'] = $this->banner_model->getbannerSingle($bannerId);
           
               // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('add-edit-banner','',$data,'normal');
            
        } else {
            redirect(VPATH.'banner');
        }
    }

    public function delete_active_inactive_multiple_banner()
    {
        $banner_id=$this->input->post('banner_id');
        $multiple_type=$this->input->post('multiple_type');

        for($i=0;$i<count($banner_id);$i++)
        {
            if($multiple_type=='delete')
            {
                $this->banner_model->delete_multiple_banner($banner_id[$i]);
                $msg="Banner image deleted successfully!";
            }

            if($multiple_type=='act')
            {
                $data = array(
                    'bannerStatus' => '1'
                );
                $response = $this->banner_model->update_banner($data, $banner_id[$i]);

                if($response)
                {
                    $msg="Banner image updated successfully!";
                }
            }

            if($multiple_type=='inact')
            {
                $data = array(
                    'bannerStatus' => '0'
                );
                $response = $this->banner_model->update_banner($data, $banner_id[$i]);
                if($response)
                {
                    $msg="Banner image updated successfully!";
                }
            }
        }
    }

    public function delete($banner_id)
    {
      
        $response = $this->banner_model->delete_banner($banner_id);
        $successMessage = '<p class="success-msg">Banner has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(VPATH.'banner');
    }

    public function inner_banner_list()
    {
        $data['pageTitle'] = 'Inner banner list';
        $data['class'] = 'Banner-calss';
        $data['bannerList'] = $this->banner_model->getinnerBannerLists();
      

        $this->layout->view('inner-banner-list','',$data,'normal');
    }

    public function inner_banner_add()
    {
        $data['pageTitle'] = 'Inner banner add';
        $data['class'] = 'Banner-calss';
        $data['cms_page'] = $this->banner_model->getcmspage();
        // echo "<pre>";print_r($data['cms_page']);die;
      

        $this->layout->view('add-edit-inner-banner','',$data,'normal');
    }


    public function Innerbannerinsert()
	{
		$param['page_name'] = trim(strip_tags($this->input->post('page_name')));
		$param['bannerStatus'] = trim(strip_tags($this->input->post('bannerStatus')));

		 $this->form_validation->set_rules('page_name', 'Select Page Name', 'required', 'Title is required');
        $this->form_validation->set_rules('bannerStatus', 'Banner Status', 'required', 'Status is required');

        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);

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

	        redirect(VPATH.'banner/inner_banner_list');
	    }

        public function inner_banner_edit($bannerId)
        {
            $data['pageTitle'] = 'Inner banner add';
            $data['class'] = 'Banner-calss';
            $data['cms_page'] = $this->banner_model->getcmspage();
            $data['banner_details'] = $this->banner_model->getinnerbannerSingle($bannerId);
            $this->layout->view('add-edit-inner-banner','',$data,'normal');
        }


        public function delete_active_inactive_multiple_inner_banner()
        {
                $banner_id=$this->input->post('banner_id');
                $multiple_type=$this->input->post('multiple_type');

                for($i=0;$i<count($banner_id);$i++)
                {
                    if($multiple_type=='delete')
                    {
                        $this->banner_model->delete_multiple_innmer_banner($banner_id[$i]);
                        $msg="Inner banner image deleted successfully!";
                    }

                    if($multiple_type=='act')
                    {
                        $data = array(
                            'bannerStatus' => '1'
                        );
                        $response = $this->banner_model->update_inner_banner($data, $banner_id[$i]);

                        if($response)
                        {
                            $msg="Inner banner image image updated successfully!";
                        }
                    }

                    if($multiple_type=='inact')
                    {
                        $data = array(
                            'bannerStatus' => '0'
                        );
                        $response = $this->banner_model->update_inner_banner($data, $banner_id[$i]);
                        if($response)
                        {
                            $msg="Inner banner image image updated successfully!";
                        }
                    }
                }
        }

        public function inner_banner_delete($bannerId)
        { 
            $response = $this->banner_model->delete_inner_banner($bannerId);
            $successMessage = '<p class="success-msg">Inner banner has been deleted!!!</p>';
            $this->session->set_flashdata('success', $successMessage);
            redirect(VPATH.'banner/inner_banner_list');

        }
	



    

}

