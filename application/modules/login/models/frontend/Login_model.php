<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

   
    public function forgotpassword($email) {
        
        $response = array();
        $this->db->select('id');
        $query = $this->db->get_where("users", array("email" => $email));
        $result = $query->row();
        // echo "<pre>"; print_r($result);die;
        // echo $result->id;die;
        if ($result) {

            $response['status'] = "success";
           
            $forgotten_password_code = md5(rand(0000, 9999));
            $forgotten_password_time = date('Y-m-d H:i:s', strtotime(+30 . 'minute'));
            $data = array(
                'forgotten_password_code' => $forgotten_password_code,
                'forgotten_password_time'=>$forgotten_password_time
            );
            $this->db->update('users', $data, array("email" => $email));
            $activation_url='<a href="'.base_url().'user/changepassword/'.$result->id.'/verify/'.$forgotten_password_code.'">Activate account</a>';
            $site_settings = site_settings();
            // echo "<pre>"; print_r($site_settings);die;
            $this->load->library('email');
            // echo ADMIN_EMAIL;exit;
            $this->email->from($site_settings->helpline_email_address, 'Admin');
            $this->email->to($email);
            $this->email->subject('Reset your password');
            $this->email->message('Hi , There was a request to change your password!

            If you did not make this request then please ignore this email.
            
            Otherwise, please click this link to change your passwor:' . $activation_url);

            $this->email->send();

            $response['status'] = "success";
            
        } else {
            $response['status'] = "error";
        }
        return $response;

        
    }


}
