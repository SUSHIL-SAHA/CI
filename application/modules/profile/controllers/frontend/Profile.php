<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends MX_Controller {

    public function __construct() {
        $this->load->model('profile_model');
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
            $data['admin_details'] = $this->profile_model->admin_details();
            // echo "<pre>";print_r($data['admin_details']);die;
            // $this->load->view('profile',$data, false);
            $this->layout->view('profile','',$data,'normal');
        }

        
    }


    public function submitUserPic()
    {
        $sess_data = array();
        if(!empty($_FILES['file']['name'])){

           $session_user_data =  $this->session->userdata('user');
            $adminID =  $session_user_data->id;
            
            $uploadPath = PPATH."uploads/profile_pictures/";
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            //Load upload library
            $this->load->library('upload',$config); 
			// File upload
			if($this->upload->do_upload('file')){
				$fileData = $this->upload->data();
				$editArray['user_profile_pic'] = ($fileData) ? $fileData['file_name'] : '';
				$getResult = $this->profile_model->updateAdminDetails($editArray, $adminID);
			}
            
        }
	}

    public function updateuserdetails(){

        if(!$this->session->userdata('user'))
		{
			redirect(VPATH."login/");
		}
        else{

            if($this->input->post('submit') != ''){
            
                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $email = $this->input->post('hidden_email_id');
                // echo $email;die;
                $mobile = $this->input->post('mobile');
    
                
                $this->form_validation->set_rules('fname', 'Name', 'trim|required');
                $this->form_validation->set_rules('mobile', 'Telephone', 'trim|required');
                if($this->form_validation->run() == FALSE)
                {
                    $data = array(
                    'error' => validation_errors(),
                    );
                    $this->session->set_flashdata($data);
                    redirect(VPATH."profile");
                }
                $fname = $this->security->xss_clean(trim($fname));
                $lname = $this->security->xss_clean(trim($lname));
                $editArray['first_name'] = $fname;
                $editArray['last_name'] = $lname;
                $editArray['email'] = $email;
                $editArray['phone'] = $mobile;

                $session_user_data =  $this->session->userdata('user');
                $adminID =  $session_user_data->id;
                $getResult = $this->profile_model->updateAdminDetails($editArray, $adminID,$editdetailsArray);
                $this->session->set_flashdata('success', 'Profile Has Been Updated!!!!');
                    /* ====== Save to session ====== */
                    // $name = $fname.($mname != '' ? ' '.$mname : '').' '.$lname;
                    // $sessionArray = array(
                    //     'name'       => $name,
                    //     'userDisplayNickname' => $editArray['user_firstname']
                    // );
                    // $this->session->set_userdata($sessionArray);
                redirect(VPATH."profile");
                
            }

        }
        
        
    }


    public function update_admin_password()
    {

        if(!$this->session->userdata('user'))
		{
			redirect(VPATH."login/");
		}
        else{

            $old_pass=$this->input->post('old_pass');
            $new_pass=$this->input->post('new_pass');
            $confirm_pass=$this->input->post('confirm_pass');
            $session_user_data =  $this->session->userdata('user');
            $adminID =  $session_user_data->id;
            
            $que=$this->profile_model->getAdminDetails($adminID);
            
            if(password_verify($old_pass,$que['password']) && $new_pass==$confirm_pass)
            {
                $this->profile_model->change_pass($adminID,$new_pass);
                $this->session->set_flashdata('change_password_success', 'Password Changed Successfully!!');
            }
            else if(!password_verify($old_pass,$que['password']))
            {
                // print '<pre>';
                // print_r($que);
                // echo $old_pass.'<br>'.$que['password'];
                // die;
                $this->session->set_flashdata('change_password_error', 'Old Password And Provided Password Does Not Match!!');
            }
            else if($new_pass!=$confirm_pass)
            {
                $this->session->set_flashdata('change_password_error', 'New Password And Confirm Password Does Not Match!!');
            }
            redirect(VPATH."profile");  

        }
            

	}

}

