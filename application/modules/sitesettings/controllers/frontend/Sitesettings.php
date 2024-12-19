<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sitesettings extends MX_Controller {

    public function __construct() {
        $this->load->model('sitesettings_model');
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
            $data['class'] = 'site-setting';
            $data['siteSettings'] = $this->sitesettings_model->getSiteSettings();
            $data['getCurrency'] = $this->sitesettings_model->getCurrencies();
            // echo "<pre>";print_r($data['admin_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('sitesettings','',$data,'normal');
        }

        
    }

    public function siteSettingsAction(){
		$searchArr['site_title'] = $this->security->xss_clean($this->input->post('site_title'));
		$searchArr['currency'] = $this->security->xss_clean($this->input->post('currency'));
		$searchArr['paypal_email'] = $this->security->xss_clean($this->input->post('paypal_email'));
		$searchArr['helpline_no'] = $this->security->xss_clean($this->input->post('helpline_no'));
		$searchArr['helpline_email_address'] = $this->security->xss_clean($this->input->post('helpline_email_address'));
		$searchArr['address'] = $this->security->xss_clean($this->input->post('address'));
		$searchArr['facebook_link'] = $this->security->xss_clean($this->input->post('facebook_link'));
		$searchArr['twitter_link'] = $this->security->xss_clean($this->input->post('twitter_link'));
		$searchArr['instagram_link'] = $this->security->xss_clean($this->input->post('instagram_link'));
		$searchArr['youtube_link'] = $this->security->xss_clean($this->input->post('youtube_link'));
		$searchArr['about_site'] = $this->security->xss_clean($this->input->post('about_site'));

		$this->db->update('site_settings', $searchArr);
        $successMessage = 'Site Settings Info has been updated!';
        $this->session->set_flashdata('success', $successMessage);
        redirect(VPATH.'sitesettings');
	}

}
?>