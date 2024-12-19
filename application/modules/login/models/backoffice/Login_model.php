<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends BaseModel {

    public function __construct() {
        return parent::__construct();
    }

    public function logincheck() {
        $username = htmlentities(strip_tags(trim($this->input->post("email"))), ENT_QUOTES);
        $password = $this->input->post("password");
        $response = array();

        $this->db->select('id, username, email,password,role,user_type');
        
        $where = "email='$username' AND active=1 and (user_type='ADMIN' || user_type='SUBADMIN')";
        //$query = $this->db->get_where("users", array("email" => $username,"active"=>1, ));
        $query = $this->db->where($where);
        $this->db->from('users');
        $Query = $this->db->get();
        $result = $Query->result_array();

        //echo "<pre>";print_r($result);die;
        if(is_array($result[0]))
        {
            if(password_verify($password , $result[0]['password']))
            {
                 
                $response['status'] = "success";
                $this->session->set_userdata('user', $result);
            }
            else
            {
               $response['status'] = "error";
            }
        }
        else
        {
            // echo "last";die;
		     $response['status'] = "error";
        }
         

        
        return $response;
    }

    public function forgotpassword($email) {
        
        $response = array();
        $this->db->select('id');
        $query = $this->db->get_where("users", array("email" => $email));
        $result = $query->row();
        //  echo "<pre>"; print_r($result);die;
        // echo $result->id;die;
        if ($result) {
            
            
           
            $forgotten_password_code = md5(rand(0000, 9999));
            $forgotten_password_time = date('Y-m-d H:i:s', strtotime(+30 . 'minute'));
            $data = array(
                'forgotten_password_code' => $forgotten_password_code,
                'forgotten_password_time'=>$forgotten_password_time
            );
            $this->db->update('users', $data, array("email" => $email));
            $activation_url='<a href="'.base_url().'admin/changepassword/'.$result->id.'/verify/'.$forgotten_password_code.'">Reset Password</a>';
            $site_settings = site_settings();
            // echo "<pre>"; print_r($site_settings);die;
            $user_to = $email;
            $subject = 'Reset your password';
            $user_message = 'Hi , 
            There was a request to change your password! If you did not make this request then please ignore this email.
            Otherwise, please click this link to change your passwor:' . $activation_url;
            $sendEmail = sendEmail($user_to, $subject, $user_message);
            echo $sendEmail;
            $response['status'] = "success";
            
        } else {
            // echo 'i am here'; die;
            $response['status'] = "invalidemail";
        }
        return $response;

        
    }


    function updateuserpassword($editArray){
        $this->db->select('BaseTbl.id', FALSE);
        $this->db->from('users as BaseTbl', FALSE);
        $this->db->where('BaseTbl.id', $editArray['id']);
        $this->db->where('BaseTbl.forgotten_password_code', $editArray['forgotten_password_code']);
        
        $query = $this->db->get();        
        $user = $query->row();
        if(!empty($user)){
            $this->db->set('forgotten_password_code', '');
            $this->db->set('password', $editArray['password']);
            $this->db->where('id', $user->id);
            $this->db->update('users');
            //$user->passwordResetCode = $randomstring;
            return $user;
        } else {
            return array();
        }
    }


}
