<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Testimonial extends MX_Controller {
    protected $userPermission = [];
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('testimonial/backoffice/testimonial_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }

    public function index() {
        $data["error"] = "";
        $data["class"] = "testimonial";
        $data["userPermission"] = chk_user_permission("testimonial", ["add", "edit", "delete", "list"]);
        $testimonial = $this->testimonial_model->testimonial();
        $data['testimonial']=$testimonial;
        $this->layout->view("testimonial/backoffice/Testimonial-list", "", $data, "normal");
        
    }

    
    public function Testimonial_add()
    {
        $userPermission = chk_user_permission('testimonial',['add']);
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
            $data['class'] = 'testimonial';
            // $data['category_details'] = $this->testimonial_model->getcategorydetails();
            // echo "<pre>" ; print_r($data['category_details']);die;
            $this->layout->view('testimonial/backoffice/Testimonial-add-edit','',$data,'normal');
        }
    }

    public function testimonialInsert()
    {
        $userPermission = chk_user_permission('testimonial',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $param['testimonial_name'] = trim(strip_tags($this->input->post('testimonial_name')));
        $param['dept'] = trim(strip_tags($this->input->post('dept')));
		$param['testimonial_description'] = $this->input->post('testimonial_description');
        $param['rating'] = $this->input->post('rating');
        // print_r($param['stars']); die;
        $action = $this->input->post('action');
        $testimonialid = $this->input->post('testimonialid');
		$this->form_validation->set_rules('testimonial_name', 'testimonial_name', 'required', 'name is required');
        $this->form_validation->set_rules('rating', 'Rating', 'required', 'Rating fild is required');
		$this->form_validation->set_rules('dept', 'Dept', 'required', 'Dept is required');
        $this->form_validation->set_rules('testimonial_description', 'testimonial_description', 'required', 'Description is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
                if($action=='add')
                {
                    redirect(base_url().'admin/testimonial/add');
                }
                else{
                    redirect(base_url().'admin/testimonial/testimonial-edit/'.$testimonialid);
                }
            
        } else {

		        $uploadPath = PPATH."uploads/testimonial_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if($_FILES['image']['name'] != ''){                
		            
		            if($this->upload->do_upload('image')){
		                if($this->input->post('hiddenimage') != "") {
		                    $old_image  = PPATH . 'uploads/testimonial_image/' . $this->input->post('hiddenimage');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenimage'));
		                    $old_resized_image  = PPATH . 'uploads/testimonial_image/' . $thumbfileName;
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
                    date_default_timezone_set('Asia/Kolkata');
	               	$param['addedOn']=date('Y-m-d h:i:sa');
	                $successMessage = '<p class="success-msg">Testimonial has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Testimonial has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['testimonialid'] = $this->input->post('testimonialid');
                    date_default_timezone_set('Asia/Kolkata');
	                $param['modifiedOn'] = date('Y-m-d h:i:sa');
	                $successMessage = '<p class="success-msg">Testimonial has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Testimonial has not been updated!!!</p>';
	            break;
	        }
            // print_r($param); exit;
            $getResult = $this->testimonial_model->alterTestimonialDetails($param, $action);

           
            

	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/testimonial');
    }

    // SERVICE DELETE
    function testimonial_delete($testimonialid)
    {
        $userPermission = chk_user_permission('testimonial',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->testimonial_model->delete_testimonial($testimonialid);
        $successMessage = '<p class="success-msg">Testimonial has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/testimonial');
    }

//ed
    public function testimonial_edit($testimonialid)
    {
        $userPermission = chk_user_permission('testimonial',['edit']);
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
            $data['class'] = 'testimonial';
            $data['testimonial'] = $this->testimonial_model->gettestimonialDetails($testimonialid);
            $this->layout->view('testimonial/backoffice/Testimonial-add-edit','',$data,'normal');
        }
    }
    public function delete_active_inactive_multiple_testimonial()
    {
        
        $userPermission = chk_user_permission('allservice',['delete']);
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
                            // $this->service_model->delete_multiple_service($testimonialid[$i]);
                            $this->testimonial_model->delete_multiple_testimonial($dataId);
                            $msg = '<p class="success-msg">Testimonial deleted successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;           
            }
            echo json_encode(array('status'=>$status));
            exit();
    }
    public function is_home_featured_testimonial()
    {
        $status = 0;
        $testimonialid = $this->input->post('testimonialid');
        // echo  $testimonialid; exit;
        $is_home_value = $this->input->post('is_home_value');
        $data = array('is_home' => $is_home_value);
        $is_home = $this->testimonial_model->updateIsHometestimonial($testimonialid,$data);
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