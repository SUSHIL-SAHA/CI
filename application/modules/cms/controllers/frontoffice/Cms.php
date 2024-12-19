<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends MX_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('cms/frontoffice/Cms_model');
        // $this->load->helper(array('form'));
			
        // /* Load form validation library */ 
        // Load paypal library 
        $this->load->library(array('form_validation', 'paypal_lib'));
         
       
    }
    public function index(){
        $pageSlug = 'home';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];
        
        $data['home_service_data']=$this->Cms_model->home_service_data();
        $data['home_testimonial_data']=$this->Cms_model->home_testimonial_data();
        $data['product_category_data']=$this->Cms_model->product_category_data();
        $data['cartItemDetails'] = $this->session-> userdata('cart_item');
       
        // print_r( $data['home_service_data']); exit;
        $this->layout->template('cms/frontoffice/home','', $data);
    }
    public function product($id){
        $getProductData = $this->Cms_model->product_data($id);
        $getCartData = $this->session->userdata('cart_item');
        $newProductData = [];
        /*pre($getCartData);
        exit();*/
        foreach ($getProductData as $gKey => $gpVal) {
            $getProductData[$gKey]['added_to_cart'] = 0;
            $getProductData[$gKey]['selected_qty'] = 0;
            if(isset($getCartData[$gpVal['productId']])){
                $getProductData[$gKey]['added_to_cart'] = 1;
                $getProductData[$gKey]['selected_qty'] = $getCartData[$gpVal['productId']]['qty'];
            }
            // pre($getCartData[$gpVal['productId']]);
        }
        // pre($this->session->userdata('cart_item'));
        header('Content-Type: application/json');
        echo json_encode($getProductData);
    }
    public function get_cart_data(){
        header('Content-Type: application/json');
        echo json_encode($this->session->userdata('cart_item'));
    }
    public function singel_product($id){
        $cart = [];
        if($this->session->has_userdata('cart_item'))
        {
            $cart = $this->session->userdata('cart_item');
        }
        
        $single_product=$this->Cms_model->singel_product($id)[0];
        if(isset($cart[$id])){
            if($this->input->get('action_type') == 'decr'){
                $cart[$id]['qty'] -= $this->input->get('qty')??1;
                if($cart[$id]['qty'] == 0){
                    unset($cart[$id]);
                }
            } else {
                $cart[$id]['qty'] += $this->input->get('qty')??1;
            }

        } elseif($this->input->get('action_type') == 'incr') {
            $cart[$single_product['productId']] = [
                'title'=>$single_product['product_title'],
                'image'=>$single_product['image'],
                'qty'=>1
            ];
        }
        
        $this->session->set_userdata('cart_item',$cart);
        header('Content-Type: application/json');
        echo json_encode($cart);
    }

    public function remove_cart_data($id)
    {
        $cart = [];
        if($this->session->has_userdata('cart_item'))
        {
            $cart = $this->session->userdata('cart_item');
        }
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        
        $this->session->set_userdata('cart_item',$cart);
        echo json_encode(['msg'=>'remove from cart']);
    }
    public function remove_all_cart_data()
    {
        $cart = [];
        if($this->session->has_userdata('cart_item'))
        {
            $cart = $this->session->unset_userdata('cart_item');
        }
        $this->session->set_userdata('cart_item',$cart);
        echo json_encode(['msg'=>'remove all product from cart']);
    }

    public function aboutus(){
        // $url= current_url(true);
        // $pageSlug =basename(parse_url($url, PHP_URL_PATH));
        $pageSlug = 'about-us';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];

        $data['cms_pages_data']= $this->Cms_model->cms_pages_data();
        $data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['service_data']=$this->Cms_model->service_data();
        $data['testimonial_data']=$this->Cms_model->testimonial_data();
        $data['vehicle_details'] = $this->Cms_model->getVehicleDetails();
        // $data['service_category_service_details_data']=$this->Cms_model->service_category_service_details_data();
        $this->layout->show('cms/frontoffice/aboutus','', $data);
    }
    public function faq(){
        // $url= current_url(true);
        // $pageSlug =basename(parse_url($url, PHP_URL_PATH));
        $pageSlug = 'faq';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];


        // $data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['faq_data']=$this->Cms_model->faq_data();
        $this->layout->show('cms/frontoffice/faq','', $data);
    }
    public function contact(){
        // $url= current_url(true);
        // $pageSlug =basename(parse_url($url, PHP_URL_PATH));
        $pageSlug = 'contact-us';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];

        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $this->layout->show('cms/frontoffice/contact','', $data);
    } 
    public function testimonials(){
        // $url= current_url(true);
        // $pageSlug =basename(parse_url($url, PHP_URL_PATH));
        $pageSlug = 'testimonials';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];


        $data['testimonial_data']=$this->Cms_model->testimonial_data();
        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $this->layout->show('cms/frontoffice/testimonials','', $data);
    }
    public function blogs(){
        // $url= current_url(true);
        // $pageSlug =basename(parse_url($url, PHP_URL_PATH));
        $pageSlug = 'blogs';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];


        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['allblogs_data']=$this->Cms_model->allblogs_data();
        $this->layout->show('cms/frontoffice/blogs','', $data);
    }
    public function location($category_slug){
        $pageSlug ='location';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];


        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['location_category_data']=$this->Cms_model->location_category_data($category_slug);
        // print_r($data['location_category_data']); exit;
        $data['suburb_data']=$this->Cms_model->suburb_data($data['location_category_data'][0]['suburb_id']);
        if($data['location_category_data']){
            $this->layout->show('cms/frontoffice/location','', $data);
        }else{
            redirect(base_url().'error');
        } 
    }
    public function calculator(){
        $pageSlug ='calculator';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        $data['metaTitle'] = $pageContentData['metaTitle'];
        $data['metaKeyword'] = $pageContentData['metaKeyword'];
        $data['metaDescription'] = $pageContentData['metaDescription'];


        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();       
        // $data['home_service_category_data']=$this->Cms_model->home_service_category_data();
        $data['product_category_data']=$this->Cms_model->product_category_data();
        $data['cartItemDetails'] = $this->session-> userdata('cart_item');
        $this->layout->show('cms/frontoffice/calculator','', $data);
    }
    public function thank_you(){
        $this->layout->show('cms/frontoffice/thank_you','', $data);
    }
    public function error(){
        $this->output->set_status_header('404');
        $this->layout->show('cms/frontoffice/404error','', $data);
    }
    public function inner_blogs($blogs_slug){
        $data['inner_blogs_data']=$this->Cms_model->inner_blogs_data($blogs_slug);
        $data['other_blogs_data']=$this->Cms_model->other_blogs_data($blogs_slug);
        $data['metaTitle'] = $data['inner_blogs_data'][0]['metaTitle'];
        $data['metaKeyword'] = $data['inner_blogs_data'][0]['metaKeyword'];
        $data['metaDescription'] = $data['inner_blogs_data'][0]['metaDescription'];
        if($data['inner_blogs_data']){
            $this->layout->show('cms/frontoffice/inner_blogs','', $data);
        }else{
            redirect(base_url().'error');
        }
        
    }
    public function service_details($slug){
        $pageSlug = 'service-details';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']);
        
        $data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['testimonial_data']=$this->Cms_model->testimonial_data();
        $data['other_service_data']=$this->Cms_model->other_service_data($slug);
        $data['service_details_data']=$this->Cms_model->Allservice_details_data($slug);
        $data['metaTitle'] = $data['service_details_data'][0]['metaTitle'];
        $data['metaKeyword'] = $data['service_details_data'][0]['metaKeyword'];
        $data['metaDescription'] = $data['service_details_data'][0]['metaDescription'];
        //print_r($data['service_details_data']); exit;
        if($data['service_details_data']){
            $this->layout->show('cms/frontoffice/service_details','', $data);
        }else{
            redirect(base_url().'error');
        }  
    }
    public function location_details($suburb_slug,$locations_slug){
        $pageSlug ='location-details';
        $pageContentData = $this->Cms_model->getPageContentData($pageSlug);
        $data['pageTitle']=$pageContentData['pageTitle'];
        $data['pageExtraFields']   = $this->Cms_model->getPageExtraFields($pageContentData['pageID']); 
        
        //$data['cms_metadata_data']=$this->Cms_model->cms_metadata_data();
        $data['location_details_data']=$this->Cms_model->location_details_data($locations_slug);
        $data['metaTitle'] = $data['location_details_data'][0]['metaTitle'];
        $data['metaKeyword'] = $data['location_details_data'][0]['metaKeyword'];
        $data['metaDescription'] = $data['location_details_data'][0]['metaDescription'];
        $suburbid= $data['location_details_data'][0]['suburb'];
        $data['other_location_data']=$this->Cms_model->other_location_data($locations_slug,$suburbid);
        //   print_r($data['other_location_data']); exit;
        $data['service_data']=$this->Cms_model->service_data();
        if($data['location_details_data']){
            $this->layout->show('cms/frontoffice/location_details','', $data);
        }else{
            redirect(base_url().'error');
        }
    }
    
    public function form(){
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $ph_no=$this->input->post('phone');
        $address=$this->input->post('address');
        $message=$this->input->post('message');
        $new_token = $this->security->get_csrf_hash();
        if ($name == '')
        {
            $flag = 0;
            $msg .= "<p>Please enter name</p>";
        }
        if ($email == '')
        {
            $flag = 0;
            $msg .= "<p>Please enter email</p>";
        }
        if ($ph_no == '')
        {
            $flag = 0;
            $msg .= "<p>Please enter phone no.</p>";
        }
        if ($address == '')
        {
            $flag = 0;
            $msg .= "<p>Please enter address</p>";
        }
        if ($message == '')
        {
            $flag = 0;
            $msg .= "<p>Please enter message</p>";
        }

        else{
        $param['name']=$name;
        $param['email']=$email;
        $param['ph_no']=$ph_no;
        $param['address']=$address;
        $param['message']=$message;
        $config = array(
            'protocol' => PROTOCOL,
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'charset' => 'utf-8',
            'smtp_crypto' => SMTPSECURE,
            'smtp_timeout' => '5',
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASSWORD,
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        ); 
        $mailbody = '<table align="center" style="vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600"><tbody><tr><td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 20px; padding-bottom: 20px;" width="596"><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Name: '.$name.'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Email: '.$email.'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Mobile no.: '.$ph_no.'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Address: '.$address.'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00; word-wrap: break-word; max-width: 500px;">Message:<p style="display: block;margin: 0;font-size: 14px;background: #eaf1fb;padding: 14px;">'.$message.'</p></div><div style="font-size: 15px; line-height: 24px; font-weight: 400; text-decoration: none; color: #000000;"></div><div style="font-size: 20px; font-weight: 600; text-decoration: none; color: #5d6d00;line-height: 30px;"></div></td></tr></tbody></table>';

        $emailmessage = prepare_email_template_body($mailbody);
        //print_r($message); exit;

        $this->load->library('email', $config);

        $this->email->from(EMAIL_FROM, COMPANY_NAME);
         
        $this->email->to('subhadipp295@gmail.com');                
        $this->email->set_mailtype('html');
        $this->email->subject('Contact Us');
        $this->email->message($emailmessage);          
    
        if ($this->email->send()) {
            $getResult = $this->Cms_model->form_data_insert($param);
            $flag = 1;
            $msg = 'Thank You. Your message submitted successfully.';
            $req = base_url('contact-us/thank-you');
        } 
        else 
        {
            $flag = 0;
            $msg = 'Something wrong! Please try again.';
            $req = '';
        }
    }
    echo json_encode(array('flag' => $flag, 'msg' => $msg,'req' => $req,'new_token'=>$new_token));
    exit();
    }
    public function service_insert(){ 

        $cartItemDetails = $this->session->userdata('cart_item');
        $new_token = $this->security->get_csrf_hash();
        if ($cartItemDetails == '')
        {
            $flag = 0;
            $msg .= "<p>Please add product</p>";
        } else{
            $param['name']=$this->input->post('name');
            $param['surname']=$this->input->post('surname');
            $param['email']=$this->input->post('email');
            $param['phone']=$this->input->post('phone');
            $param['service_date']=$this->input->post('user_date');
            $param['service_time']=$this->input->post('user_time');
            // if($this->input->post('hiddenvehicle') != '')
            $param['vehicleId'] = $this->input->post('hiddenvehicle');
            $param['help_loading_unloading']=$this->input->post('help_loading_unloading');
            $param['need_hours']=$this->input->post('need_hours');
            $param['service']=$this->input->post('hiddenservice');
            $param['packing_services']=$this->input->post('packing_services');
            $param['packing_materials']=$this->input->post('packing_materials');
            $param['pickup_address_number']=$this->input->post('pickup_address_number');
            $param['pickup_address_street']=$this->input->post('pickup_address_street');
            $param['pickup_address_city']=$this->input->post('pickup_address_city');
            $param['pickup_address_postcode']=$this->input->post('pickup_address_postcode');
            $param['pickup_address_floor']=$this->input->post('pickup_address_floor');
            $param['pickup_address_lift_available']=$this->input->post('pickup_address_lift_available');
            $param['pickup_address_parking_space']=$this->input->post('pickup_address_parking_space');
            $param['pickup_address_movers']=$this->input->post('pickup_address_movers');

            $param['via_address_number']=$this->input->post('via_address_number');
            $param['via_address_street']=$this->input->post('via_address_street');
            $param['via_address_city']=$this->input->post('via_address_city');
            $param['via_address_postcode']=$this->input->post('via_address_postcode');
            $param['via_address_floor']=$this->input->post('via_address_floor');
            $param['via_address_lift_available']=$this->input->post('via_address_lift_available');
            $param['via_address_parking_space']=$this->input->post('via_address_parking_space');
            // $param['via_address_message']=$this->input->post('via_address_message' );

            $param['dropoff_address_number']=$this->input->post('dropoff_address_number');
            $param['dropoff_address_street']=$this->input->post('dropoff_address_street');
            $param['dropoff_address_city']=$this->input->post('dropoff_address_city');
            $param['dropoff_address_postcode']=$this->input->post('dropoff_address_postcode');
            $param['dropoff_address_floor']=$this->input->post('dropoff_address_floor');
            $param['dropoff_address_lift_available']=$this->input->post('dropoff_address_lift_available');
            $param['dropoff_address_parking_space']=$this->input->post('dropoff_address_parking_space');
            $param['dropoff_address_movers']=$this->input->post('dropoff_address_movers');

            $config = array(
                'protocol' => PROTOCOL,
                'smtp_host' => SMTP_HOST,
                'smtp_port' => SMTP_PORT,
                'charset' => 'utf-8',
                'smtp_crypto' => SMTPSECURE,
                'smtp_timeout' => '5',
                'smtp_user' => SMTP_USER,
                'smtp_pass' => SMTP_PASSWORD,
                'wordwrap' => TRUE,
                'newline' => "\r\n"
            ); 
            $mailbody = '<table align="center" style="vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600"><tbody><tr><td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 20px; padding-bottom: 20px;" width="596"><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Name: '.$param['name'].'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Email: '.$param['email'].'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Mobile no.: '.$param['phone'].'</div><div style="font-size: 16px; line-height: 24px; font-weight: 400; text-decoration: none; color: #5d6d00;">Preferred date: '.$param['service_date'].'</div><div style="font-size: 15px; line-height: 24px; font-weight: 400; text-decoration: none; color: #000000;"></div><div style="font-size: 20px; font-weight: 600; text-decoration: none; color: #5d6d00;line-height: 30px;"></div></td></tr></tbody></table>';
    
            $message = prepare_email_template_body($mailbody);
    
            $this->load->library('email', $config);
    
            $this->email->from(EMAIL_FROM, COMPANY_NAME);
             
            $this->email->to('subhadipp295@gmail.com');                
            $this->email->set_mailtype('html');
            $this->email->subject('book service');
            $this->email->message($message); 
            if ($this->email->send()) {
                $service_inquiry_data=$this->db->insert('service_inquiry',$param);
                $insert_id = $this->db->insert_id();
                //echo $insert_id;
                // $cartItemDetails = $this->session-> userdata('cart_item');
                //echo "<pre>"; print_r($cartItemDetails); exit;
                foreach($cartItemDetails as $row) {
                    $data['product_title']= $row['title'];
                    $data['product_image']=$row['image'];
                    $data['product_qty']=$row['qty'];
                    $data['service_inquire_id']= $insert_id;
                    $getResult=$this->db->insert('service_inquire_product',$data);
                }
                if($getResult != 0){
                    $this->session->unset_userdata('cart_item');
                }
                $flag = 1;
                $msg = 'Thank You. Your message submitted successfully.';
                $req = base_url('inquiry-form/thank-you');
            }else 
            {
                $flag = 0;
                $msg = 'Something wrong! Please try again.';
                $req = base_url('calculator');
            }        
        
        }
        echo json_encode(array('flag' => $flag, 'msg' => $msg,'req' => $req,'new_token' =>$new_token));
        exit();
        
    }
    public function inquiry_form(){
        $data['vehicle_details'] = $this->Cms_model->getVehicleDetails();
        $data['service_data']=$this->Cms_model->service_data();
        $data['cartItemDetails'] = $this->session->userdata('cart_item');
        // $data['service_category_service_details_data']=$this->Cms_model->service_category_service_details_data();
        $this->layout->show('cms/frontoffice/inquiry-form','', $data);
    }

    public function payment_page($paymentID){
        $getOrderWithQuotationDetails = $this->Cms_model->getOrderWithQuotationDetails(base64_decode($paymentID));
        if(!empty($getOrderWithQuotationDetails)){
            $data['orderDetails'] = $getOrderWithQuotationDetails;
            $getOrderItems = $this->Cms_model->getOrderItems($getOrderWithQuotationDetails->service_inquiry_id);
            $data['getOrderItems'] = $getOrderItems;
            $this->load->view('cms/frontoffice/payment_area', $data);
        } else {
            redirect(base_url());
        }
    }

    public function pay_via(){
        $orderNumber = $this->input->post('order_number');
        $paymentType = $this->input->post('payment_type');

        switch($paymentType){
            case 'paypal':

                // Set variables for paypal form 
                $returnURL = base_url().'paypal_success'; //payment success url 
                $cancelURL = base_url().'paypal_cancel?ordNum='.$orderNumber; //payment cancel url 
                $notifyURL = base_url().'paypal_ipn'; //ipn url 


                $getOrderWithQuotationDetails = $this->Cms_model->getOrderWithQuotationDetails($orderNumber);
                $getOrderItems = $this->Cms_model->getOrderItems($getOrderWithQuotationDetails->service_inquiry_id);


                // Add fields to paypal form 
                $this->paypal_lib->add_field('return', $returnURL); 
                $this->paypal_lib->add_field('cancel_return', $cancelURL); 
                $this->paypal_lib->add_field('notify_url', $notifyURL); 
                $this->paypal_lib->add_field('custom', $orderNumber);
                foreach ($getOrderItems as $goKey => $goValue) {
                    $this->paypal_lib->add_field('item_name_'.($goKey+1), $goValue['product_title']);  
                    $this->paypal_lib->add_field('quantity_'.($goKey+1), $goValue['product_qty']); 
                }
                $this->paypal_lib->add_field('amount', $getOrderWithQuotationDetails->quoted_price);

                

                // Render paypal form 
                $this->paypal_lib->paypal_auto_form(); 
            break;
        }
    }

    public function paypal_ipn(){ 
        // Retrieve transaction data from PayPal IPN POST 
        // $paypalInfo = $this->input->post(); 

        $paypalInfo = file_get_contents('php://input');

        $mailBody = 'test json '.json_encode($paypalInfo, true);

        $config = array(
                'protocol' => PROTOCOL,
                'smtp_host' => SMTP_HOST,
                'smtp_port' => SMTP_PORT,
                'charset' => 'utf-8',
                'smtp_crypto' => SMTPSECURE,
                'smtp_timeout' => '5',
                'smtp_user' => SMTP_USER,
                'smtp_pass' => SMTP_PASSWORD,
                'wordwrap' => TRUE,
                'newline' => "\r\n"
        ); 

        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->from('noreplyeclick@gmail.com');
        $this->email->to('eclick.souravdas@gmail.com'); // $serviceinquirydetails->email
        $this->email->subject('Order Number IPN');
        $this->email->message($mailBody);
        $this->email->send();
    }


    public function paypal_success(){
        $getPaypalObject = $this->input->get();
        if(!empty($getPaypalObject)){
            $getOrderID = $getPaypalObject['custom'];

            $insData = [];
            $insData['order_id'] = $getOrderID;
            $insData['payer_email'] = $getPaypalObject['payer_email'];
            $insData['payment_gateway'] = 'paypal';
            $insData['amount_paid'] = round($getPaypalObject['amt']);
            $insData['payer_details'] = serialize($getPaypalObject);
            $insData['payment_status'] = '1';

            // Insert Data

            $this->Cms_model->insertPayment($insData);

            // Update the payment

            $this->Cms_model->updatePaymentStatus($getOrderID, 'Y');

            $this->load->view('cms/frontoffice/payment_success_area', $data);
        }
    } 

    public function paypal_cancel(){
        $getOrderID = $this->input->get('ordNum');
        $this->Cms_model->updatePaymentStatus($getOrderID, 'R');
        $this->load->view('cms/frontoffice/payment_cancel_area', $data);
    }
 
}
