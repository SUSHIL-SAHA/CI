<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('gallery/backoffice/gallery_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "gallery";

        $data['galleryList'] = $this->gallery_model->getGalleryLists();
        $data['userPermission'] = chk_user_permission('gallery',['add','edit','delete','list']);
        
        $this->layout->view('gallery/backoffice/home-gallery-list','',$data,'normal');
    }

    public function addgallery()
	{
        $userPermission = chk_user_permission('gallery',['add']);
        if(!$userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }

		$data['pageTitle'] = 'Home Add  gallery';
        $data['class'] = "gallery";
        // $getPoliticians_details['Politicians_details'] = $this->admin_blog_model->getPoliticians();
         // echo "<pre>";print_r($getPoliticians_details['Politicians_details']);die;
      

        $this->layout->view('gallery/backoffice/add-edit-gallery','',$data,'normal');
	}

    public function galleryInsert()
	{
        $userPermission = chk_user_permission('gallery',['add','edit']);
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
        $gallery_id = $this->input->post('galleryId');
        $action = $this->input->post('action');
		$param['video_link'] = trim(strip_tags($this->input->post('video_link')));
		$param['galleryStatus'] = trim(strip_tags($this->input->post('galleryStatus')));

        $this->form_validation->set_rules('video_link', 'Title', 'required', ' Title is required');
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/gallery/addgallery');
            }
            else
            {
                redirect(base_url().'admin/gallery/editgallery/'.$gallery_id);

            }

        } else {
            $uploadPath = PPATH."uploads/gallery_image/";    
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name'] = TRUE;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($_FILES['galleryImage']['name'] != ''){                
                
                if($this->upload->do_upload('galleryImage')){
                    if($this->input->post('hiddengalleryImage') != "") {
                        $old_image  = PPATH . 'uploads/gallery_image/' . $this->input->post('hiddengalleryImage');
                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddengalleryImage'));
                        $old_resized_image  = PPATH . 'uploads/gallery_image/' . $thumbfileName;
                        unlink($old_image);
                        unlink($old_resized_image);
                    }
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $param['galleryImage'] = $fileData['file_name'];
                }
        }
        
        $action = $this->input->post('action');
	        switch($action){
	            case 'add':
	               	$param['addedOn']=date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Gallery_banner has been added!!!</p>';
	                $errorMessage = '<p class="error-msg">Gallery_banner has not been added!!!</p>';
	            break;

	            case 'edit':
                    
	                $param['galleryId'] = $this->input->post('galleryId');
	                $param['modifiedOn'] = date('Y-m-d H:i:s');
	                $successMessage = '<p class="success-msg">Gallery_banner has been updated!!!</p>';
	                $errorMessage = '<p class="error-msg">Gallery_banner has not been updated!!!</p>';
	            break;
	        }
            $getResult = $this->gallery_model->alterGalleryDetails($param, $action);
	        if($getResult != 0){
	            $this->session->set_flashdata('success', $successMessage);
	        } else {
	            $this->session->set_flashdata('error', $errorMessage);
	        }

	        redirect(base_url().'admin/gallery');
	    }
	}


    public function editgallery($galleryId){
        $userPermission = chk_user_permission('gallery',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        if($galleryId != ""){
            $data['pageTitle'] = 'Edit gallery';
            $data['class'] = "gallery";
            $data['gallery_details'] = $this->gallery_model->getgallerySingle($galleryId);
           
               // echo "<pre>";print_r($getBannerDetails['banner_details']);die;
            $this->layout->view('gallery/backoffice/add-edit-gallery','',$data,'normal');
            
        }
        else {
            redirect(base_url().'admin/gallery');
        }
    }

    public function delete_active_inactive_multiple_gallery_banner()
    {

            $userPermission = chk_user_permission('gallery',['edit', 'delete']);
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
                            $this->gallery_model->delete_multiple_gallery_banner($dataId);
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
                                'galleryStatus' => $status
                            );

                            $response[] = $this->gallery_model->update_gallery($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Home gallery updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }

    public function delete($gallery_id)
    {
        $userPermission = chk_user_permission('gallery',['delete']);
        if(!$userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $response = $this->gallery_model->delete_gallery($gallery_id);
        $successMessage = '<p class="success-msg">Gallery_banner has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/gallery');
    }

}