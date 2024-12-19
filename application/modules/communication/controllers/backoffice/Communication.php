<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Communication extends MX_Controller {

    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('communication/backoffice/communication_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');

    }
    public function setting() {

        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $session_user_data =  $this->session->userdata('user');
            $adminID =  $session_user_data->id;
            $data['userPermission'] = chk_user_permission('communicationsettings',['edit']);
            $data['error'] = "";
            $data['class'] = 'communication';
            $data['setting_details'] = $this->communication_model->check_contact_setting($adminID);
            // echo "<pre>"; print_r($data['setting_details']);die;
            $this->layout->view('communication/backoffice/setting','',$data,'normal');
        }

        
    }

    public function settinginsert()
    {
        $userPermission = chk_user_permission('communicationsettings',['edit']);
        if(!$userPermission['edit'])
        {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }
        $contact_form = $this->input->post('contact_form');
       
        $form_heading = $this->input->post('form_heading');
        $success_msg = $this->input->post('success_msg');
        $google_recaptcha_on = $this->input->post('google_recaptcha_on');
        $google_map_on = $this->input->post('google_map_on');
        $site_key = $this->input->post('site_key');
        $secret_key = $this->input->post('secret_key');
        $contact_address = $this->input->post('contact_address');
        $email_subject = $this->input->post('email_subject');
        $email_template = $this->input->post('email_template');
        $to_mail = $this->input->post('to_mail');
        $cc_mail = $this->input->post('cc_mail');
        $bcc_mail = $this->input->post('bcc_mail');
        $no_reply_email = $this->input->post('no_reply_email');
        $contact_setting_id = $this->input->post('contact_setting_id');
        $session_user_data =  $this->session->userdata('user');
        $adminID =  $session_user_data->id;
        $result = $this->communication_model->check_contact_setting($adminID);

        $data = array(
            'created_by'=>$adminID,
            'contact_form'=>$contact_form,
            'form_heading'=>$form_heading,
            'success_msg'=>$success_msg,
            'google_recaptcha_on'=>$google_recaptcha_on,
            'google_map_on'=>$google_map_on,
            'site_key'=>$site_key,
            'secret_key'=>$secret_key,
            'contact_address'=>$contact_address,
            'email_subject'=>$email_subject,
            'email_template'=>$email_template,
            'to_mail'=>$to_mail,
            'cc_mail'=>$cc_mail,
            'bcc_mail'=>$bcc_mail,
            'no_reply_email'=>$no_reply_email
        );

        if($result!="")
        {
            $this->db->where('created_by',$adminID);
            $this->db->update('communication_setting',$data);
            $successMessage = '<p class="success-msg">Data updated successfully.</p>';
            $this->session->set_flashdata('success', $successMessage);
            redirect(base_url().'admin/communication/communicationsettings');
        }
        else
        {
            $this->db->insert('communication_setting',$data);
            $successMessage = '<p class="success-msg">Data updated successfully.</p>';
            $this->session->set_flashdata('success', $successMessage);
            redirect(base_url().'admin/communication/communicationsettings');
        }
    }

    public function content()
    {
        

        $data['pageTitle'] = 'Content';
        $data['class'] = 'communication';
        $data['content_details'] = $this->communication_model->get_content_details();
          // echo "<pre>";print_r($data['content_details']);die;
      

        $this->layout->view('communication/backoffice/content','',$data,'normal');
    }

    public function content_add()
    {
        $data['pageTitle'] = 'Content';
        $data['class'] = 'communication';
        // $data['cms_page'] = $this->banner_model->getcmspage();
        // echo "<pre>";print_r($data['cms_page']);die;
      

        $this->layout->view('communication/backoffice/add-edit-content','',$data,'normal');
    }

    public function contentinsert()
    {
        $param['for_page'] = $this->input->post('for_page');
        $param['heading'] = $this->input->post('heading');
        $param['display_heading'] = $this->input->post('display_heading');
        $param['sub_heading'] = $this->input->post('sub_heading');
        $param['status'] = $this->input->post('status');
        $param['display_priority'] = $this->input->post('display_priority');
        $param['description'] = $this->input->post('description');
        $action = $this->input->post('action');
        $content_id = $this->input->post('content_id');


        $this->form_validation->set_rules('for_page', 'Select Page Name', 'required');
        $this->form_validation->set_rules('heading', 'Heading', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($action=='add')
            {
            redirect(base_url().'admin/communication/content-add');
            }
            else
            {
                redirect(base_url().'admin/banner/inner-banner-edit/'.$content_id);
            }

        }
        else
        {
            switch($action){
                case 'add':
                    $param['addedOn']=date('Y-m-d H:i:s');
                    $successMessage = '<p class="success-msg">Data updated successfully.</p>';
                    $errorMessage = '<p class="error-msg">Data updated not successfully.</p>';
                break;

                case 'edit':
                    
                    $param['id'] = $this->input->post('content_id');
                    $param['modifiedOn'] = date('Y-m-d H:i:s');
                    $successMessage = '<p class="success-msg">Data updated successfully.</p>';
                    $errorMessage = '<p class="error-msg">Data updated not successfully.</p>';
                break;
            }
        }

        $getResult = $this->communication_model->altercontentDetails($param, $action);

        if($getResult != 0){
                $this->session->set_flashdata('success', $successMessage);
            } else {
                $this->session->set_flashdata('error', $errorMessage);
            }

            redirect(base_url().'admin/communication/content');


        
    }

    public function communication_active_inactive()
    {
        $userPermission = chk_user_permission('contact-mail', ['edit', 'delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
        switch ($actionType) {
            case 'delete':
                if (!$userPermission['delete']) {
                    $this->session->set_flashdata('error', '<p class="error-msg">' . BLOCK_SECTION_MSG . '</p>');
                    $status = 2;
                } else {
                    foreach ($dataIds as $dataId) {
                        $this->communication_model->delete_multiple_content($dataId);
                        $msg = '<p class="success-msg">Mail content deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status' => $status));
        exit();
    }

    public function content_edit($id)
    {
         $data['pageTitle'] = 'Content';
         $data['class'] = 'communication';
         $data['content_details'] = $this->communication_model->get_content_details_by_id($id);
         // echo "<pre>";print_r($data['content_details']);die;
         $this->layout->view('communication/backoffice/add-edit-content','',$data,'normal');
    }

    public function contact_mail()
    {

        $data['pageTitle'] = 'Contact Mail';
        $data['class'] = 'communication';
        $total_contact_mail = $this->communication_model->total_contact_mail();
        $total_contact_mail = count($total_contact_mail);
        $link = "admin/communication/contact-mail";
        $returns = adminPaginationCompress($link, $total_contact_mail);
        $data['mail_details'] = $this->communication_model->get_contact_mail($returns["limit"], $returns["offset"]);
          // echo "<pre>";print_r($data['content_details']);die;
        $this->layout->view('communication/backoffice/contact-mail','',$data,'normal');
    }

    public function mail_view($id)
    {
        // echo "okk";

        $data['pageTitle'] = 'Contact-mail';
         $data['class'] = 'communication';
         $data['mail_details'] = $this->communication_model->get_contact_mail_by_id($id);
         $result = $this->communication_model->is_viewed($id);
          // echo "<pre>";print_r($data['mail_details']);die;
         $this->layout->view('communication/backoffice/view-mail-content','',$data,'normal');


    }

    public function contact_read_unread()
    {
        $banner_id=$this->input->post('contact_mail_id');
        $multiple_type=$this->input->post('multiple_type');

        for($i=0;$i<count($banner_id);$i++)
        {
            if($multiple_type=='del')
            {
                $this->communication_model->delete_multiple_mail($banner_id[$i]);
                $msg="Mail deleted successfully!";
            }

            if($multiple_type=='Read')
            {
                $data = array(
                    'status' => 'Read'
                );
                $response = $this->communication_model->update_mail_status($data, $banner_id[$i]);

                if($response)
                {
                    $msg="Mail status updated successfully!";
                }
            }

            if($multiple_type=='Unread')
            {
                $data = array(
                    'status' => 'Unread'
                );
                $response = $this->communication_model->update_mail_status($data, $banner_id[$i]);
                if($response)
                {
                    $msg="Mail status updated successfully!";
                }
            }
        }
    }

    public function mailfilter()
    {
        $name_email = $this->input->get('name_email');
        $status  = $this->input->get('status');
        $data['pageTitle'] = 'Contact Mail';
        $data['class'] = 'communication';
        $data['name_email']=$name_email;
        $data['status']=$status;

        $data['mail_details'] = $this->communication_model->mailfilter($name_email, $status);
         // echo "<pre>";print_r($data['mail_details']);die;
      

        $this->layout->view('communication/backoffice/contact-mail','',$data,'normal');

        

    } 
}