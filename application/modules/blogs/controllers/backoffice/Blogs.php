<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('blogs/backoffice/blogs_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "blogs";

        $data['blogsList'] = $this->blogs_model->getblogsLists();
        $data['userPermission'] = chk_user_permission('blogs',['add','edit','delete','list']);
        
        $this->layout->view('blogs/backoffice/blogs-list','',$data,'normal');
    }

    public function addblogs()
	{
        $userPermission = chk_user_permission('blogs',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }

		$data['pageTitle'] = 'Add blogs';
        $data['class'] = "blogs";
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('blogs/backoffice/add-edit-blogs','',$data,'normal');
	}

    public function blogsInsert()
	{
        $userPermission = chk_user_permission('blogs',['add','edit']);
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
        $blogs_id = $this->input->post('blogs_id');
        $action = $this->input->post('action');
		$param['blogs_title'] = trim(strip_tags($this->input->post('blogs_title')));
        // $param['blogs_slug'] = setPageSlug(create_url_slug(trim($param['blogs_title'])));
		$param['blogs_status'] = trim(strip_tags($this->input->post('blogs_status')));
        $param['blogs_description'] = $this->input->post('blogs_description');
        $param['metaTitle'] = $this->input->post('metaTitle');
        $param['metaKeyword'] = $this->input->post('metaKeyword');
        $param['metaDescription'] = $this->input->post('metaDescription');


        $this->form_validation->set_rules('blogs_title', 'Title', 'required', ' Title is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/blogs/addblogs');
            }
            else
            {
                redirect(base_url().'admin/blogs/editblogs/'.$blogs_id);

            }

        } else {
            $uploadPath = PPATH."uploads/blogs_images/";    
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name'] = TRUE;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($_FILES['blogs_image']['name'] != ''){                
                
                if($this->upload->do_upload('blogs_image')){
                    if($this->input->post('hiddenblogs_image') != "") {
                        $old_image  = PPATH . 'uploads/blogs_images/' . $this->input->post('hiddenblogs_image');
                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenblogs_image'));
                        $old_resized_image  = PPATH . 'uploads/blogs_images/' . $thumbfileName;
                        unlink($old_image);
                        unlink($old_resized_image);
                    }
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $param['blogs_image'] = $fileData['file_name'];
                }
        }
        
        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
                    $param['blogs_slug'] = setGeneralSlug(create_url_slug(trim($param['blogs_title'])),'blogs','blogs_slug');
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">blogs has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">blogs has not been added!!!</p>';
	            break;

	            case 'edit':
                    $param['blogs_slug']=$this->input->post('blogs_slug');
	                $param['blogs_id'] = $this->input->post('blogs_id');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">blogs has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">blogs has not been updated!!!</p>';
	            break;
	        }
            $getResult = $this->blogs_model->alterBlogsDetails($param, $action);
	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/blogs');
	    }
	}


    public function editblogs($blogs_id){
        $userPermission = chk_user_permission('blogs',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if($blogs_id != ""){
            $data['pageTitle'] = 'Edit blogs';
            $data['class'] = "blogs";
            $data['blogs_details'] = $this->blogs_model->getBlogsSingle($blogs_id);
           
               // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('blogs/backoffice/add-edit-blogs','',$data,'normal');
            
        }
        else {
            redirect(base_url().'admin/blogs');
        }
    }

    public function delete_active_inactive_multiple_blogs()
    {

            $userPermission = chk_user_permission('blogs',['edit', 'delete']);
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
                            $this->blogs_model->delete_multiple_blogs($dataId);
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
                                'blogs_status' => $status
                            );

                            $response[] = $this->blogs_model->update_blogs($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">blogs updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }

    public function delete($blogs_id)
    {
        $userPermission = chk_user_permission('blogs',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->blogs_model->delete_blogs($blogs_id);
        $successMessage = '<p class="success-msg">blogs has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/blogs');
    }

}