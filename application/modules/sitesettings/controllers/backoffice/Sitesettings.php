<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sitesettings extends MX_Controller {

    protected $userPermission = [];
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        
        $this->userPermission = chk_user_permission('sitesettings',['edit']);
        $this->load->model('sitesettings/backoffice/sitesettings_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function index() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        
        $data['error'] = "";
        $data['class'] = 'sitesettings';
        $data['siteSettings'] = $this->sitesettings_model->getSiteSettings();
        $data['getCurrency'] = $this->sitesettings_model->getCurrencies();
        $data['userPermission'] = $this->userPermission;
        //echo "<pre>";print_r($data['userPermission']);die;
        // $this->load->view('profile',$data, false);
        $this->layout->view('sitesettings/backoffice/sitesettings','',$data,'normal');
        

        
    }

    public function siteSettingsAction(){
        echo 2;
        if(!$this->userPermission['edit'])
        {
            $this->session->set_flashdata('error', $this->errorMessage);
            redirect(base_url().'admin/dashboard');
        }
		$searchArr['site_title'] = $this->security->xss_clean($this->input->post('site_title'));
		//$searchArr['currency'] = $this->security->xss_clean($this->input->post('currency'));
		//$searchArr['paypal_email'] = $this->security->xss_clean($this->input->post('paypal_email'));
		//$searchArr['paypal_mode'] = $this->security->xss_clean($this->input->post('paypal_mode'));
		$searchArr['helpline_no'] = $this->security->xss_clean($this->input->post('helpline_no'));
        $searchArr['another_helpline_no'] = $this->security->xss_clean($this->input->post('another_helpline_no'));
		$searchArr['helpline_email_address'] = $this->security->xss_clean($this->input->post('helpline_email_address'));
		$searchArr['address'] = $this->security->xss_clean($this->input->post('address'));
        // $searchArr['operating_hours'] = $this->security->xss_clean($this->input->post('operating_hours'));
        // $searchArr['Other_Information'] = $this->security->xss_clean($this->input->post('Other_Information'));
        // $searchArr['short_text'] = $this->security->xss_clean($this->input->post('short_text'));
		$searchArr['facebook_link'] = $this->security->xss_clean($this->input->post('facebook_link'));
		$searchArr['twitter_link'] = $this->security->xss_clean($this->input->post('twitter_link'));
		$searchArr['instagram_link'] = $this->security->xss_clean($this->input->post('instagram_link'));
		//$searchArr['youtube_link'] = $this->security->xss_clean($this->input->post('youtube_link'));
		$searchArr['linkedin_link'] = $this->security->xss_clean($this->input->post('linkedin_link'));
		$searchArr['about_site'] = $this->security->xss_clean($this->input->post('about_site'));


        $uploadPath = PPATH."uploads/sitesettings_image/";    
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;

        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($_FILES['logo_image']['name'] != ''){                
            
            if($this->upload->do_upload('logo_image')){
            
                // Uploaded file data
                $fileData = $this->upload->data();
                $searchArr['logo_image'] = $fileData['file_name'];
            }
        }

		$this->db->update('site_settings', $searchArr);
        $successMessage = 'Site Settings Info has been updated!';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/sitesettings');
	}

}
?>