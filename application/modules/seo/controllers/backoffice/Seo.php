<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Seo extends MX_Controller {
    // protected $userPermission = [];
    public function __construct() {

        if(!$this->session->userdata('user'))
        {
            redirect(base_url()."admin/login");
        }

        // $this->userPermission = chk_user_permission('seo',['add','edit','delete','list']);
        $this->load->model('seo/backoffice/seo_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function default_home() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'seo';
             $data['seo_default_details'] = $this->seo_model->check_seo_default();
             $data['seo_home_details'] = $this->seo_model->check_seo_home();
             $data['userPermission'] = chk_user_permission('default-home', ['add', 'edit', 'delete', 'list']);
            $this->layout->view('seo/backoffice/home-default','',$data,'normal');
        }
    }

    public function update_default_home()
    {
        // echo "okk";
        $defaultmetadata['pageTitleText'] = $this->input->post('pageTitleText');
        $defaultmetadata['metaRobotsIndex'] = $this->input->post('metaRobotsIndex');
        $defaultmetadata['metaRobotsFollow'] = $this->input->post('metaRobotsFollow');
        $defaultmetadata['metaTag'] = $this->input->post('metaTag');
        $defaultmetadata['metaDescription'] = $this->input->post('metaDescription');



        $sameCheck = $this->input->post('sameCheck');

        // echo $sameCheck;die;

        

        $homemetadata['homePageTitleText'] = $this->input->post('homePageTitleText');
        $homemetadata['homeMetaRobotsIndex'] = $this->input->post('homeMetaRobotsIndex');
        $homemetadata['homeMetaRobotsFollow'] = $this->input->post('homeMetaRobotsFollow');
        $homemetadata['homeMetaTag'] = $this->input->post('homeMetaTag');
        $homemetadata['homeMetaDescription'] = $this->input->post('homeMetaDescription');

        $default_result = $this->seo_model->check_seo_default();

        if($default_result!='')
        {
            $this->seo_model->defaultdata($defaultmetadata);
        }
        else
        {
            $this->db->insert('seo_default',$defaultmetadata);
        }

        if($sameCheck =='Yes')
        {

             $homemetadata['homePageTitleText']=$defaultmetadata['pageTitleText'];
             $homemetadata['homeMetaRobotsIndex']=$defaultmetadata['metaRobotsIndex'];
             $homemetadata['homeMetaRobotsFollow']=$defaultmetadata['metaRobotsFollow'];
             $homemetadata['homeMetaTag']=$defaultmetadata['metaTag'];
             $homemetadata['homeMetaDescription']=$defaultmetadata['metaDescription'];

            $home_result = $this->seo_model->check_seo_home();

            if($home_result!='')
            {
                $this->seo_model->homeseotdata($homemetadata);
            }
            else
            {
                $this->db->insert('seo_home_metadata',$homemetadata);
            }
        }
        else
        {
            $home_result = $this->seo_model->check_seo_home();

            if($home_result!='')
            {
                $this->seo_model->homeseotdata($homemetadata);
            }
            else
            {
                $this->db->insert('seo_home_metadata',$homemetadata);
            }

        }

        
        $this->session->set_flashdata('success', 'Data updated successfully.');
        redirect(base_url().'admin/seo/default-home');

        


    }

    public function title_meta()
    {
        if(!$this->session->userdata('user'))
        {
            redirect(base_url()."admin/login");
        }
        else{
            $data['error'] = "";
            $data['class'] = 'seo';

            $total_title_count = $this->seo_model->total_title_meta();
            $total_title_count = count($total_title_count);
            $link = "admin/seo/title-meta";
            $returns = adminPaginationCompress($link, $total_title_count);

             $data['title_mete_details'] = $this->seo_model->get_all_title_mete($returns["limit"], $returns["offset"]);
             $data['userPermission'] = chk_user_permission('title-meta', ['add', 'edit', 'delete', 'list']);
             
               // echo "<pre>";print_r($data['title_mete_details']);die;
            $this->layout->view('seo/backoffice/title-meta','',$data,'normal');
        }
    }

    public function title_meta_add()
    {
        // echo "okk";
        $userPermission = chk_user_permission('title-meta',['add']);
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
            $data['class'] = 'seo';
             $data['seo_default_details'] = $this->seo_model->check_seo_default();
             $data['seo_home_details'] = $this->seo_model->check_seo_home();
              // echo "<pre>";print_r($data['seo_default_details']);die;
            $this->layout->view('seo/backoffice/title-meta-add','',$data,'normal');
        }
    }

    public function title_meta_insert()
    {

        $userPermission = chk_user_permission('title-meta',['add','edit']);
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


        $this->form_validation->set_rules('titleandMetaUrl', 'Title and meta url', 'required', 'Title and meta url');
        $this->form_validation->set_rules('pageTitleText', 'Page Title', 'required', 'Page Title');
        $id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
                // echo "okk";die;
                redirect(base_url().'admin/seo/title-meta-add');
            }
            else
            {
                redirect(base_url().'admin/seo/title-meta-add/'.$id);
            
            }
        }

        $param['titleandMetaUrl'] = $this->input->post('titleandMetaUrl');
        $param['pageTitleText'] = $this->input->post('pageTitleText');
        $param['metaTag'] = $this->input->post('metaTag');
        $param['metaDescription'] = $this->input->post('metaDescription');
        $param['canonicalUrl'] = $this->input->post('canonicalUrl');
        $param['metaRobotsIndex'] = $this->input->post('metaRobotsIndex');
        $param['metaRobotsFollow'] = $this->input->post('metaRobotsFollow');
        // $ogImage = $this->input->post('ogImage');



        $uploadPath = PPATH."uploads/ogImage/";    
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name'] = TRUE;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($_FILES['ogImage']['name'] != ''){                
                
                if($this->upload->do_upload('ogImage')){
                    if($this->input->post('hiddenogImage') != "") {
                        $old_image  = PPATH . 'uploads/ogImage/' . $this->input->post('hiddenogImage');
                        $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenogImage'));
                        $old_resized_image  = PPATH . 'uploads/ogImage/' . $thumbfileName;
                        unlink($old_image);
                        unlink($old_resized_image);
                    }
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $param['ogImage'] = $fileData['file_name'];
                }
        }
            switch($action){
                case 'add':
                    $param['addedOn']=date('Y-m-d H:i:s');
                    $successMessage = '<p class="success-msg">Title & Meta has been added!!!</p>';
                    $errorMessage = '<p class="error-msg">Title & Meta has not been added!!!</p>';
                break;

                case 'edit':
                    
                    $param['id'] = $this->input->post('id');
                    $param['modifiedOn'] = date('Y-m-d H:i:s');
                    $successMessage = '<p class="success-msg">Title & Meta has been updated!!!</p>';
                    $errorMessage = '<p class="error-msg">Title & Meta has not been updated!!!</p>';
                break;
            }
            $getResult = $this->seo_model->alterSeoDetails($param, $action);
            if($getResult != 0){
                $this->session->set_flashdata('success', $successMessage);
            } else {
                $this->session->set_flashdata('error', $errorMessage);
            }

            redirect(base_url().'admin/seo/title-meta');


        
    }

    public function multiple_delete_active_inactive()
    {

        $userPermission = chk_user_permission('title-meta',['delete','edit']);
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
                        $this->seo_model->delete_multiple_seo($dataId);
                        $msg = '<p class="success-msg">Meta title deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status'=>$status));
        exit();
    }

    public function title_meta_edit($id)
    {

        $userPermission = chk_user_permission('title-meta',['edit']);
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
            $data['class'] = 'seo';
             $data['title_mete_details'] = $this->seo_model->get_title_mete($id);
             
                // echo "<pre>";print_r($data['title_mete_details']);die;
            $this->layout->view('seo/backoffice/title-meta-add','',$data,'normal');
        }
    }

    public function search_meta_title()
    {
        // echo "okk";

       $searchText = $this->input->post('searchText');
       $searchRobots = $this->input->post('searchRobots');
       $searchRobotsarr = explode(',', $searchRobots);
         // print_r($searchRobotsarr); die;
       // echo $searchRobotsarr[0];

                $partSql = '';

                if($searchText!="")
                {

                      $partSql .= "and MT.titleandMetaUrl='".$searchText."'"; 
                }

                if($searchRobotsarr[0]!="")
                {
                   $partSql .= "and (MT.metaRobotsIndex='".trim($searchRobotsarr[0])."' AND MT.metaRobotsFollow='".trim($searchRobotsarr[1])."')";
                }

                $q = "select MT.* from title_and_meta as MT
                 where 1 ".$partSql."";

                  // echo $q;die;
                 $query = $this->db->query($q);  
                     // echo   $query;die;
                $results = $query->result();


             $data['searchText'] = $searchText;
             $data['searchRobots'] = $searchRobots;
             $data['title_mete_details'] = $results;
             $this->layout->view('seo/backoffice/title-meta','',$data,'normal');

        
    }

}
?>

