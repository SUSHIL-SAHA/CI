<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends MX_Controller {
    protected $userPermission = [];
    public function __construct() {

        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->userPermission = chk_user_permission('pages',['add','edit','delete','list']);
        $this->load->model('cms/backoffice/cms_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        $data['error'] = "";
        $data['class'] = "cms";
        $total_cmspage = $this->cms_model->total_cmspage();
        $total_cmspage = count($total_cmspage);
        $link = "admin/cms/pages";
        $returns = adminPaginationCompress($link, $total_cmspage);
        $data['cmsList'] = $this->cms_model->getCMSPageLists($returns["limit"], $returns["offset"]);
        $data['userPermission'] = $this->userPermission;
        $this->layout->view('cms/backoffice/admin-list-cms-pages','',$data,'normal');
    }

    public function add()
    {
        if(!$this->userPermission['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $data['error'] = "";
        $data['class'] = "cms";
        $data['cmsList'] = $this->cms_model->getCMSPageLists();
        
        $this->layout->view('cms/backoffice/admin-add-edit-cms-pages','',$data,'normal');
        
    }

    public function alterCMSPages(){
        $action = $this->input->post('action');
        if($action=='add')
        {
            if(!$this->userPermission['add'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }else{
            if(!$this->userPermission['edit'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }
        $pageName = $this->input->post('pageName');
        $pageTitle = $this->input->post('pageTitle');
        $pageContent =  $this->input->post('pageContent',FALSE);
        $pageStatus = $this->input->post('pageStatus');
        // $showInMenu = $this->input->post('showInMenu');
        // $showInSection = $this->input->post('showInSection');
        $pageID = $this->input->post('pageID');


        $this->form_validation->set_rules('pageTitle', 'Page Title', 'trim|required');
        $this->form_validation->set_rules('pageStatus', 'Page Status', 'trim|required');
        // $this->form_validation->set_rules('showInMenu', 'show In Menu', 'trim|required');
        // $this->form_validation->set_rules('showInSection', 'Show In Section', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
            'error' => validation_errors(),
            );
            $this->session->set_flashdata($data);

            if($action=="add")
            {
                redirect(base_url().'admin/cms/add');
            }
            else
            {
                redirect(base_url().'admin/cms/EditCMSPages/'.$pageID);
            }
            
        }
        $metaTitle = $this->input->post('metaTitle');
        $metaKeyword = $this->input->post('metaKeyword');
        $metaDescription = $this->input->post('metaDescription');

            $uploadPath = PPATH."uploads/cms_page_images/";      
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'mp4|3gp|gif|jpg|png|jpeg|pdf';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

        $pageExtraFields = $this->cms_model->get_page_cms_extra_fields($pageID);
        
            if($pageExtraFields){
                $postExtraData = array();
                $postExtraData['page_id'] = $pageID;
                foreach($pageExtraFields as $extraField){
                    $field_key = $extraField['meta_key'];
                    switch($extraField['field_type']){
                        case 'textinput':
                            $postExtraData[$field_key] = $this->input->post($field_key);
                        break;
                        case 'textarea':
                            $postExtraData[$field_key] = addslashes($this->input->post($field_key));
                        break;
                        case 'image':
                            $postExtraData[$field_key] = '';
                            
                            if($_FILES[$field_key]['name'] != ''){  
                           
                                if($this->upload->do_upload($field_key)){
                                    
                                    if($this->input->post('hidden_'.$field_key) != "") {
                                        $old_image  = PPATH . 'uploads/cms_page_images/' . $this->input->post('hidden_'.$field_key);
                                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hidden_'.$field_key));
                                        $old_resized_image  = PPATH . 'uploads/cms_page_images/' . $thumbfileName;
                                        unlink($old_image);
                                        unlink($old_resized_image);
                                    }
                                    // Uploaded file data
                                    $fileData = $this->upload->data();
                                    $postExtraData[$field_key] = $fileData['file_name'];
                                  
                                }

                                
                            }
                            else{
                                $postExtraData[$field_key] = $this->input->post('hidden_'.$field_key);
                            }
                        break;
                        case 'file':
                            $postExtraData[$field_key] = '';
                            
                            if($_FILES[$field_key]['name'] != ''){  
                           
                                if($this->upload->do_upload($field_key)){
                                    
                                    if($this->input->post('hiddenfile_'.$field_key) != "") {
                                        $old_file  = PPATH . 'uploads/cms_page_images/' . $this->input->post('hiddenfile_'.$field_key);
                                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenfile_'.$field_key));
                                        $old_resized_file  = PPATH . 'uploads/cms_page_images/' . $thumbfileName;
                                        unlink($old_file);
                                        unlink($old_resized_file);
                                    }
                                    // Uploaded file data
                                    $fileData = $this->upload->data();
                                    $postExtraData[$field_key] = $fileData['file_name'];
                                  
                                }

                                
                            }
                            else{
                                $postExtraData[$field_key] = $this->input->post('hiddenfile_'.$field_key);
                            }
                        break;
                    }
                }

                 $resultExtraData = $this->cms_model->save_page_cms_extra_data($postExtraData);
                //  echo $resultExtraData; exit;
            }
        


        $param = [];

        $param['pageName'] = $pageName;
        $param['pageTitle'] = $pageTitle;
        $param['pageContent'] = $pageContent;
        $param['pageStatus'] = $pageStatus;
        // $param['showInMenu'] = $showInMenu;
        // $param['showInSection'] = $showInSection;
        $param['metaTitle'] = $metaTitle;
        $param['metaKeyword'] = $metaKeyword;
        $param['metaDescription'] = $metaDescription;

        switch ($action) {
            case 'add':
                # code...
                $pageSlug = setPageSlug(create_url_slug(trim($param['pageTitle'])));
                $add_restaurant_owner['cms_slug']=$pageSlug;
                $param['pageSlug'] = $pageSlug;
                $getPageUpdate = $this->cms_model->alterCMSPages($param, 'add');
                $page_url = $pageSlug;
                $data = array(
                        'titleandMetaUrl'=>$page_url
                );
                $this->db->insert('title_and_meta',$data);
                $successMessage = 'Page has been created.';
                $errorMessage = 'Page can not be created.';

            break;

            case 'edit':
                //echo 'here';
                # code...
                // echo $data; die;
                // $pageSlug = create_url_slug(trim($param['pageName']));
                // $param['pageSlug'] = $pageSlug;
                $param['pageID'] = $this->input->post('pageID');
                // print_r( $param['pageID']); exit;
                $getPageUpdate = $this->cms_model->alterCMSPages($param, 'edit');
                // echo $getPageUpdate; exit;
                $page_url = $pageSlug;
                $data = array(
                        'titleandMetaUrl'=>$page_url
                );
                $this->db->insert('title_and_meta',$data);
                $successMessage = 'Page has been updated.';
                $errorMessage = 'Page can not be updated.';
            break;
            
            default:
                # code...
            break;
        }
        if($getPageUpdate != 0){ 
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
         redirect(base_url().'admin/cms/pages');
       
        
    }


    public function deleteCmsImage(){
        
            $pageId = $this->input->post('pageId');
            $fieldKey = $this->input->post('fieldKey');
            $status = 0;
            $msg = '';
            if($pageId != ''){
                // if($fieldKey == 'featured'){
                //     $getResult = $this->admin_model->deleteCmsFeaturedImage($pageId);
                // }else{
                    $getResult = $this->cms_model->deleteCmsOtherImage($pageId, $fieldKey);
                // }
                if($getResult){
                    $pageImage = $this->input->post('pageImage');
                    $thumbfileName = str_ireplace('.', '_resized.', $pageImage);
                    unlink(PPATH."uploads/cms_page_images/".$pageImage);
                    unlink(PPATH."uploads/cms_page_images/".$thumbfileName);
                    $status = 1;
                    $msg = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Image successfully deleted!
                            </div>';  
                }else {
                    $msg = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Image deletion failed!
                            </div>';  
                }
            }else{
                $msg = '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Access denied!
                        </div>';
            }
      
        echo json_encode(array('status' => $status, 'msg' => $msg));
        exit();
    }

    public function addEditCMSPages($pageID = '') {
        if(!$this->userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $getCMSDetails = [];
        $data['pageTitle'] = 'Edit CMS Pages';

        if($pageID != ''){
            $getCMSDetails = $this->cms_model->getCMSPageDetails($pageID);
        }
        $pageSlug    = $getCMSDetails['pageSlug'];
        $data['class'] = 'cms';
        $data['getPageDetails'] = $getCMSDetails;     
        $data['getPageExtraFields'] = $this->cms_model->getPageExtraFields($pageID);
        $this->layout->view('cms/backoffice/admin-add-edit-cms-pages','',$data,'normal');
        
        
    }

    public function delete($pageID)
    {
        if(!$this->userPermission['delete'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $successMessage = 'Page has been deleted.';
        $errorMessage = 'Page can not be deleted.';
        if($pageID != '') {
            $param['isDeleted'] = '1';
            $param['pageID'] = $pageID;
            $getPageUpdate = $this->cms_model->alterCMSPages($param, 'delete');

            $successMessage = 'Page has been deleted.';
            $errorMessage = 'Page can not be deleted.';

            if($getPageUpdate != 0){ 
                $this->session->set_flashdata('success', $successMessage);
            } else {
                $this->session->set_flashdata('error', $errorMessage);
            }
        } else {
           $this->session->set_flashdata('error', $errorMessage); 
        }

        redirect(base_url().'admin/cms/pages');
    }

    public function delete_active_inactive_multiple_page()
    {
        $userPermission = chk_user_permission('pages',['edit','delete']);
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
                            $this->cms_model->delete_multiple_page($dataId);
                            $msg = '<p class="success-msg">CMS Page deleted successfully!</p>';
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
                                'pageStatus' => $status
                            );
                            $response[] = $this->cms_model->update_page($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">CMS page updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }


    public function delete_active_inactive_multiple_custom_field()
    {
        $userPermission = chk_user_permission('custom-fields',['edit','delete']);
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
                            $this->cms_model->delete_multiple_field($dataId);
                            $msg = '<p class="success-msg">Custom field deleted successfully!</p>';
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
                        $status = ($actionType == 'act') ? 'active' : 'inactive';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'status' => $status
                            );
                            $response[] = $this->cms_model->update_multiple_field($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">Custom field updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();


        // $field_id=$this->input->post('field_id');
        // $multiple_type=$this->input->post('multiple_type');
        // if($multiple_type=='delete')
        // {
        //     if(!$this->userPermission['delete'])
        //     {
        //         $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
        //         redirect(base_url().'admin/dashboard');
        //     }
        // }elseif($multiple_type=='act' || $multiple_type=='inact')
        // {
        //     if(!$this->userPermission['edit'])
        //     {
        //         $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
        //         redirect(base_url().'admin/dashboard');
        //     }
        // }
        // for($i=0;$i<count($field_id);$i++)
        // {
        //     if($multiple_type=='delete')
        //     {
        //         $this->cms_model->delete_multiple_field($field_id[$i]);
        //         $msg="Custom field deleted successfully!";
        //     }

        //     if($multiple_type=='act')
        //     {
        //         $data = array(
        //             'status' => 'active'
        //         );
        //         $response = $this->cms_model->update_multiple_field($data, $field_id[$i]);

        //         if($response)
        //         {
        //             $msg="Custom field updated successfully!";
        //         }
        //     }

        //     if($multiple_type=='inact')
        //     {
        //         $data = array(
        //             'status' => 'inactive'
        //         );
        //         $response = $this->cms_model->update_multiple_field($data, $field_id[$i]);
        //         if($response)
        //         {
        //             $msg="Custom field updated successfully!";
        //         }
        //     }
        // }
    }

    public function deleteCustomField($field_id)
    {
        $this->db->where('id',$field_id);
        $this->db->delete('cms_metadata');

        redirect(base_url().'admin/cms/custom-fields');
    }



    /* == Custom Fields functions starts == */
    public function customFields(){
        $data['error'] = "";
        $data['class'] = "cms";
        $total_CustomFields = $this->cms_model->total_CustomFields();
        $total_CustomFields = count($total_CustomFields);
        $link = "admin/cms/custom-fields";
        $returns = adminPaginationCompress($link, $total_CustomFields);
        $data['customFields'] = $this->cms_model->getAllCustomFields($returns["limit"], $returns["offset"]);
        $data['userPermission'] = chk_user_permission('custom-fields',['add','edit','delete','list']);
        $this->layout->view('cms/backoffice/listExtraFields','',$data,'normal');
        
    }
    public function addCustomField()
    {
        $data['userPermission'] = chk_user_permission('custom-fields',['add','edit','delete','list']);
        if(!$data['userPermission']['add'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $data['error'] = "";
        $data['class'] = "cms";
        $data['cmsList'] = $this->cms_model->getCMSPage();
        $this->layout->view('cms/backoffice/addEditPageExtraField','',$data,'normal');
        
    }

    public function alterCustomField(){       
        $action = $this->input->post('action');
        $data['userPermission'] = chk_user_permission('custom-fields',['add','edit','delete','list']);
        if($action=='add')
        {
            if(!$data['userPermission']['add'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }else{
            if(!$data['userPermission']['edit'])
            {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url().'admin/dashboard');
            }
        }
        $fieldID = ($this->input->post('fieldID')) ? $this->input->post('fieldID') : '';
        $fieldTitle = $this->input->post('fieldTitle');
        $fieldType = $this->input->post('fieldType');
        $fieldStatus = $this->input->post('fieldStatus');
        $pageID = $this->input->post('pageID');

        $this->form_validation->set_rules('pageID', 'Select Page', 'trim|required');
        $this->form_validation->set_rules('fieldTitle', 'Field Title', 'trim|required');
        $this->form_validation->set_rules('fieldType', 'Field Type', 'trim|required');
        $this->form_validation->set_rules('fieldStatus', 'Field Status', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'error' => validation_errors(),
            );
            $this->session->set_flashdata($data);

            if($action=="add")
            {
                redirect(base_url().'admin/cms/add-custom-field');
            }
            else
            {
                redirect(base_url().'admin/cms/edit-custom-field/'.$fieldID);
            }
            
        }

        $meta_key = '';
        $param = [];
        $param['page_id'] = $pageID;
        $param['field_title'] = $fieldTitle;
        $param['field_type'] = $fieldType;
        $param['added_on'] = date('Y-m-d H:i:s');
        $param['status'] = $fieldStatus;

        switch ($action) {
            case 'add':
                # code...
                $param['meta_key'] = str_replace('-', '_', create_url_slug(trim($fieldTitle)));
                $getFieldUpdate = $this->cms_model->alterCustomField($param, 'add');
                $successMessage = 'Custom field has been created.';
                $errorMessage = 'Custom field can not be created.';

            break;

            case 'edit':
                # code...                
                $param['id'] = $fieldID;
                $getFieldUpdate = $this->cms_model->alterCustomField($param, 'edit');
                $successMessage = 'Custom field has been updated.';
                $errorMessage = 'Custom field can not be updated.';
            break;
            
            default:
                # code...
            break;
        }
        if($getFieldUpdate != 0){ 
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect(base_url().'admin/cms/custom-fields');
       
        
    }
    
    public function EditCustomField($customFieldID = '') {
        $data['userPermission'] = chk_user_permission('custom-fields',['add','edit','delete','list']);
        if(!$data['userPermission']['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $getCFDetails = [];
        $data['pageTitle'] = 'Edit Custom Field';

        if($customFieldID != ''){
            $getCFDetails = $this->cms_model->getCustomFieldDetails($customFieldID);
        }
        //$pageSlug    = $getCMSDetails['pageSlug'];
        //$data['class'] = 'cms';
        $data['customFieldDetails'] = $getCFDetails;     
        $data['cmsList'] = $this->cms_model->getCMSPage();
        $this->layout->view('cms/backoffice/addEditPageExtraField','',$data,'normal');
        
    }
    /* == Custom Fields functions ends == */
}

