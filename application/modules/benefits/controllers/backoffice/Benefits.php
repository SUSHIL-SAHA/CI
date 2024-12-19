<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class benefits extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('benefits/backoffice/benefits_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "benefits";

        $data['benefitsList'] = $this->benefits_model->getbenefitsLists();
        $data['userPermission'] = chk_user_permission('benefits',['add','edit','delete','list']);
        
        $this->layout->view('benefits/backoffice/home-benefits-list','',$data,'normal');
    }

    public function addbenefits()
	{
        $userPermission = chk_user_permission('benefits',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }

		$data['pageTitle'] = 'Home Add  benefits';
        $data['class'] = "benefits";
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('benefits/backoffice/add-edit-benefits','',$data,'normal');
	}

    public function benefitsInsert()
	{
        $userPermission = chk_user_permission('benefits',['add','edit']);
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
        $benefits_id = $this->input->post('benefits_id');
        $action = $this->input->post('action');
		$param['benefits_title'] = trim(strip_tags($this->input->post('benefits_title')));
        $param['benefits_description'] = trim(strip_tags($this->input->post('benefits_description')));
        // echo $param['benefits_description']; exit;
		$param['benefits_status'] = trim(strip_tags($this->input->post('benefits_status')));

        $this->form_validation->set_rules('benefits_title', 'Title', 'required', 'Title is required');
        $this->form_validation->set_rules('benefits_description', 'Description', 'required', 'Description is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/benefits/addbenefits');
            }
            else
            {
                redirect(base_url().'admin/benefits/editbenefits/'.$benefits_id);

            }

        } else {
        
            $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Benefits has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Benefits has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['benefits_id'] = $this->input->post('benefits_id');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Benefits has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Benefits has not been updated!!!</p>';
	            break;
	        }
            $getResult = $this->benefits_model->alterbenefitsDetails($param, $action);
            // print_r($param); exit;
	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/benefits');
	    }
	}


    public function editbenefits($benefits_id){
       // echo $benefits_id; exit;
        $userPermission = chk_user_permission('benefits',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if($benefits_id != ""){
            $data['pageTitle'] = 'Edit benefits';
            $data['class'] = "benefits";
            $data['benefits_details'] = $this->benefits_model->getbenefitsSingle($benefits_id);
           
            // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('benefits/backoffice/add-edit-benefits','',$data,'normal');
            
        } else {
            redirect(base_url().'admin/benefits');
        }
    }
    public function delete($benefits_id)
    {
        $userPermission = chk_user_permission('benefits',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->benefits_model->delete_benefits($benefits_id);
        $successMessage = '<p class="success-msg">Benefits has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/benefits');
    }

    public function delete_active_inactive_multiple_benefits()
    {

            $userPermission = chk_user_permission('benefits',['edit', 'delete']);
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
                            $this->benefits_model->delete_multiple_benefits($dataId);
                            $msg = '<p class="success-msg">benefits deleted successfully!</p>';
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
                                'benefits_status' => $status
                            );

                            $response[] = $this->benefits_model->update_benefits($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">benefits updated successfully!</p>';
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