<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller {

    public function __construct() {
        $this->load->model('login/frontend/login_model');
        $this->load->library('form_validation');

    }



    public function index() {

        $data['error'] = "";
        $this->load->helper('cookie');
        $data['username'] = get_cookie('mrt_tsk_adm_uname');
        $data['password'] = get_cookie('mrt_tsk_adm_pwd');
	    
        //$this->load->view('login',$data, false);
    }

    public function forgotPassword()
    {
    
        $this->layout->template('login/frontend/forgot-password','',$data,'normal');
    }

    public function resetPassword()
    {
       
       $this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email' );
                if($this->form_validation->run() == TRUE) {
                    $email = htmlentities(strip_tags(trim($this->input->post("email"))), ENT_QUOTES);
                    $check = $this->login_model->forgotpassword($email);
                    if ($check) {
                        $this->session->set_flashdata('success', 'Please check your mail to change the password.');  
                    } else {
                        $this->session->set_flashdata('error', 'Not a valid user.');  
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please enter a valid email!');  
                }


    }

    public function changepassword()
    {
        echo "okk";
    }



   
    
	

	

	

	

	

	



}

