<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller {

    public function __construct() {
        $this->load->model('login/backoffice/login_model');
        $this->load->library('form_validation');
    }



    public function index() {

        $data['error'] = "";
        $this->load->helper('cookie');
        $data['username'] = get_cookie('mrt_tsk_adm_uname');
        $data['password'] = get_cookie('mrt_tsk_adm_pwd');
	    $this->load->view('login/backoffice/login',$data, false);
    }

    function loginprocess() {
            
            $data = $this->input->post();
            // print_r($data);die;
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['error'] = "";
                $this->load->view('login/backoffice/login', $data);
            } else {
                
                $result = $this->login_model->logincheck();
                $response = $result;
                if ($response['status'] == "success") {
                    redirect(base_url()."admin/dashboard");
                } else {
                    $this->session->set_flashdata('error', 'Error in email or password');
                    $this->load->view('login/backoffice/login',$data);
                }
            }
       
    }

    public function forgotPassword()
    {
       
            $this->load->view('login/backoffice/forgot-password','',$data,'normal');
    }


    public function resetPassword()
    {
       
       $this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email' );
                if($this->form_validation->run() == TRUE) {
                    $email = htmlentities(strip_tags(trim($this->input->post("email"))), ENT_QUOTES);
                    $check = $this->login_model->forgotpassword($email);
                    // echo "<pre>" ; print_r($check);die;
                    if($check['status']=='invalidemail') {
                        $this->session->set_flashdata('error', 'Not a valid user.');
                        redirect(base_url()."admin/forgot-password");  
                    }
                    else{
                        $this->session->set_flashdata('success', 'We have e-mailed your password reset link! to your email address.');
                        redirect(base_url()."admin/forgot-password");  
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please enter a valid email!');  
                    redirect(base_url()."admin/forgot-password");
                }

            


    }
    public function changepassword()
    {
       
            $userid = $this->uri->segment(3);
            $forgotten_password_code = $this->uri->segment(5);
            $this->load->view('login/backoffice/reset-password','',$data,'normal');
      
        
    }

    public function updatepassword()
    {
        $userID = $this->input->post('userID');
        $forgotten_password_code = $this->input->post('forgotten_password_code');
        $new_pass = $this->input->post('new_pass');
        $confirm_pass = $this->input->post('confirm_pass');

           $this->form_validation->set_rules( 'new_pass', 'New Password', 'trim|required' );
           $this->form_validation->set_rules( 'confirm_pass', 'Confirm Password', 'trim|required' );

          if ($this->form_validation->run() == FALSE) {

                    $data['error'] = "";
                    $this->load->view('admin/forgot-password', $data);
                } else {

                    $editArray['password'] = password_hash($this->input->post('confirm_pass'), PASSWORD_DEFAULT);
                    $editArray['id'] = $this->security->xss_clean(trim($userID));
                    $editArray['forgotten_password_code'] = $this->security->xss_clean(trim($forgotten_password_code));
                    $userTableId = $this->login_model->updateuserpassword($editArray);
                    $data = array(
                        'success' => 'Password successfully updated. Please login with new password.'
                      );
                      $this->session->set_flashdata($data);
                      redirect(base_url().'admin/login');

                }

    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect(base_url()."admin/login");
    }

    

	

	

	

	

	

	



}

