<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class faq extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('faq/backoffice/faq_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "faq";

        $data['faqList'] = $this->faq_model->getfaqLists();
        $data['userPermission'] = chk_user_permission('faq',['add','edit','delete','list']);
        
        $this->layout->view('faq/backoffice/home-faq-list','',$data,'normal');
    }

    public function addfaq()
	{
        $userPermission = chk_user_permission('faq',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }

		$data['pageTitle'] = 'Home Add  faq';
        $data['class'] = "faq";
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('faq/backoffice/add-edit-faq','',$data,'normal');
	}

    public function faqInsert()
	{
        $userPermission = chk_user_permission('faq',['add','edit']);
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
        $faq_id = $this->input->post('faq_id');
        $action = $this->input->post('action');
		$param['faq_question'] = trim(strip_tags($this->input->post('faq_question')));
        $param['faq_answer'] = trim(strip_tags($this->input->post('faq_answer')));
		$param['faq_status'] = trim(strip_tags($this->input->post('faq_status')));

        $this->form_validation->set_rules('faq_question', 'Question', 'required', 'Question is required');
        $this->form_validation->set_rules('faq_answer', 'Answer', 'required', 'Answer is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/faq/addfaq');
            }
            else
            {
                redirect(base_url().'admin/faq/editfaq/'.$faq_id);

            }

        } else {
        
            $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">FAQ has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">FAQ has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['faq_id'] = $this->input->post('faq_id');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">FAQ has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">FAQ has not been updated!!!</p>';
	            break;
	        }
            $getResult = $this->faq_model->alterfaqDetails($param, $action);
	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/faq');
	    }
	}


    public function editfaq($faq_id){
        $userPermission = chk_user_permission('faq',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if($faq_id != ""){
            $data['pageTitle'] = 'Edit faq';
            $data['class'] = "faq";
            $data['faq_details'] = $this->faq_model->getfaqSingle($faq_id);
           
               // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('faq/backoffice/add-edit-faq','',$data,'normal');
            
        } else {
            redirect(base_url().'admin/faq');
        }
    }
    public function delete($faq_id)
    {
        $userPermission = chk_user_permission('faq',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->faq_model->delete_faq($faq_id);
        $successMessage = '<p class="success-msg">faq has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/faq');
    }

    public function delete_active_inactive_multiple_faq()
    {

            $userPermission = chk_user_permission('faq',['edit', 'delete']);
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
                            $this->faq_model->delete_multiple_faq($dataId);
                            $msg = '<p class="success-msg">Home gallery image deleted successfully!</p>';
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
                                'faq_status' => $status
                            );

                            $response[] = $this->faq_model->update_faq($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">FAQ updated successfully!</p>';
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