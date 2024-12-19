<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Payments extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user')) {
			redirect(base_url()."admin/login");
		}
        $this->load->model('payments/backoffice/payments_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }

    public function list_payments() {
        $data['error'] = "";
        $data['class'] = "inquiry";
        $data['userPermission'] = chk_user_permission('payments',['add','edit','delete','list']);
        $payments_count = $this->payments_model->total_payments();
        $payments_count = count($payments_count);
        $link = "admin/payments";
        $returns = adminPaginationCompress($link, $payments_count);
        $data['paymentList'] = $this->payments_model->get_payment_results($returns["limit"], $returns["offset"]);
        
        /*pre($data);
        exit();*/
     
        // echo "<pre>";print_r($data['jobsList']);die;
        $this->layout->view('payments/backoffice/payment-list', '', $data, 'normal');
    }
}