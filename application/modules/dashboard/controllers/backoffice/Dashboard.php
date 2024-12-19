<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('dashboard/backoffice/dashboard_model');
		if(!$this->session->userdata('user')) {
			redirect(base_url()."admin/login");
		}
		if(!module_permissions('dashboard')) {
			$errorMessage = 'You have no permission to visit this page.';
			$this->session->set_flashdata('error', $errorMessage);
        	redirect(base_url().'admin/adminusers/userrole');
		}
    }
	public function index() {
		if(!$this->session->userdata('user')) {
			redirect(base_url()."admin/login");
		} else {
			$user=$this->session->userdata('user');
			$data['noOfQuotations'] = $this->dashboard_model->getNoofQuotations();
			$data['noOfPayments'] = $this->dashboard_model->getNoofPayments();
			$this->layout->view('dashboard/backoffice/dashboard', '', $data, 'normal');
		}
	}
}

?>

