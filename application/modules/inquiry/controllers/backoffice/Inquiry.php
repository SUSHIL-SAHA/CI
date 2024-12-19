<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class inquiry extends MX_Controller {
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->model('inquiry/backoffice/inquiry_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');
        $this->load->library("pagination");
    }
    public function service_inquiry()
    {
        // $data['error'] = "";
        // $data['class'] = "inquiry";
        // $data['userPermission'] = chk_user_permission('service-inquiry',['add','edit','delete','list']);
        // $service_inquiry_count = $this->inquiry_model->total_service_inquiry();
        // $service_inquiry_count = count($service_inquiry_count);
        // $link = "admin/service-inquiry";
        // $returns = adminPaginationCompress($link, $service_inquiry_count);
        // $data['serviceinquirylist'] = $this->inquiry_model->get_service_inquiry($returns["limit"], $returns["offset"]);
        
        /*pre($data);
        exit();*/
     
        // echo "<pre>";print_r($data['jobsList']);die;

        $page = 0;

        $data['error'] = "";
        $data['class'] = "inquiry"; 
        $data['userPermission'] = chk_user_permission('service-inquiry',['add','edit','delete','list']);

        $param = $this->input->get();
        $param = $this->security->xss_clean($param);

        if(isset($param['page'])&&$param['page']!='')
        {
            $page=$param['page'];
        }
        

        $param=array_map('trim',$param);

        $data['page'] = $page;
        $catId = $data['categoryDetails']['id'];
        $service_inquiry_count = $this->inquiry_model->total_service_inquiry();
        $config = array();
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['use_page_numbers'] = TRUE;
        $config["base_url"]         = base_url().'admin/service-inquiry';
        $config["total_rows"]       = count($service_inquiry_count);
        $config["per_page"]         = 10;
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Previous';

        $this->pagination->initialize($config);
        if($page!=0) {

            $page = ($page*$config["per_page"])-$config["per_page"];
        }
        $data['param'] = $param;
        $data['total_rows'] = $config["total_rows"];
        $data['total_pages'] = round($config["total_rows"] / $config["per_page"]);
        $data["per_page"]         = 10;
        $data['serviceinquirylist']     = $this->inquiry_model->get_service_inquiry($config["per_page"], $page);

        $this->layout->view('inquiry/backoffice/service-inquiry-list', '', $data, 'normal');
    }

    public function service_inquiry_details($id)
    {
        $data['error'] = "";
        $data['class'] = "inquiry";
        $data['serviceinquirydetails'] = $this->inquiry_model->get_service_inquiry_details($id);
        $data['service_inquire_product_details']= $this->inquiry_model->service_inquire_product_details($id);
        $data['quotationdetails'] = $this->inquiry_model->getQuotationDetails($id);
        $data['vehicleDetails']= $this->inquiry_model->getVehicleDetails();
        $data['userPermission'] = chk_user_permission('service-inquiry', ['add', 'edit', 'delete', 'list']);
        // echo "<pre>";print_r($data['service_inquire_product_details']);die;
        $this->layout->view('inquiry/backoffice/service-inquiry-details', '', $data, 'normal');
    }

    public function delete_active_inactive_multiple_service_inquiry()
    {
        $userPermission = chk_user_permission('service-inquiry', ['delete']);
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
                        $this->inquiry_model->delete_multiple_service_inquiry($dataId);
                        $msg = '<p class="success-msg"> Service inquiry deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status' => $status));
        exit();
    }

    public function delete_service_inquiry($id)
    {
        $this->db->where('service_inquiry_id', $id);
        $this->db->delete('service_inquiry');

        $msg = '<p class="success-msg">Service inquiry deleted successfully!</p>';
        $this->session->set_flashdata('success', $msg);
        redirect(base_url().'admin/service/service-inquiry');
    }
    
    public function sendQuotation(){
        $data = $retData = [];
        $resp = 0;
        $retData['resp'] = 0;
        $retData['msg'] = '';
        $inquiryID = $this->input->post('hidden_inquiry_id');
        $vehicleId = $this->input->post('vehicleId');
        $quoted_price = $this->input->post('quoted_price');

        $sendOn = date('Y-m-d H:i:s');

        $prefix = ID_PREFIX;
        $invoiceNumber = $prefix . str_pad($inquiryID, 3, '0', STR_PAD_LEFT);
        $orderNumber = $prefix . str_pad($inquiryID, 6, '0', STR_PAD_LEFT);

        // Update Enquiry Details
        $insertArr['service_enquiry_id'] = $inquiryID;
        $insertArr['quoted_price'] = $quoted_price;
        $insertArr['order_number'] = $orderNumber;
        $insertArr['invoice_number'] = $invoiceNumber;
        $insertArr['updated_vehicle_id'] = $vehicleId;
        $insertArr['send_on'] = $sendOn;

        $insertData = $this->inquiry_model->insertQuotation($insertArr);

        // exit();
        
        $getInquiryDetails = $this->inquiry_model->get_service_inquiry_details($inquiryID);
        $getInquiryProductDetails = $this->inquiry_model->service_inquire_product_details($inquiryID);
        $vehicleDetails = $this->inquiry_model->getSingleVehicleDetails($vehicleId);
        $quotedPrice = $quoted_price;
        $order_number = $orderNumber;
        $invoice_number = $invoiceNumber;
        $invoice_send_on = $sendOn;

        // $htmlDataForPDF = $this->layout->view('service/backoffice/inquiry_pdf_invoice', '',  $data, '');
        $htmlDataForPDF = '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>LN Services</title>
            </head>
            <body style="background-color: #d4d4d7;">
                <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0;margin: 0 auto;border: none;outline: none;">
                    <tbody>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                    <tr>
                                        <td><img src="uploads/sitesettings_image/'.site_settings_data('logo_image').'" alt="Infynity" style="max-width: 100%;"></td>
                                        <td colspan="2" style="text-align: right; margin-top: 0; font-weight: 700; font-size: 40px;line-height: 44px; position: relative; color: #717171;"><strong>INVOICE</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice No: #'.$invoice_number.'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right; font-size: 13px;">Invoice Date: '.date('jS F, Y', strtotime($invoice_send_on)).'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right;  font-size: 18px;font-weight: 600; color: #343434;"><strong>Order No: '.$order_number.'</strong>  </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="border-spacing: 0; margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                    <tr>
                                        <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 28%;"><strong>Bill To</strong></td>
                                        <td style="width: 45%;"></td>
                                        <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 22%;"><strong>Ship To</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br><strong>Pickup Address: </strong>'.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br><strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'<br>'.$getInquiryDetails->email.'<br>'.$getInquiryDetails->phone.'<br>
                                        Vin</td>
                                        <td style="width: 16%;"></td>
                                        <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br><strong>Pickup Address: </strong> '.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br><strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'<br>'.$getInquiryDetails->email.'<br>'.$getInquiryDetails->phone.'<br>
                                        Vin</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 30px 0px 0; border-spacing: 0; border-collapse: separate;">
                                    <tr>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 5%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 40%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Price</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                                        <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">total</td>
                                    </tr>';
                        foreach ( $getInquiryProductDetails as $giKey => $giValue ) {
                            $htmlDataForPDF .= '<tr>
                                                    <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", ($giKey+1)).'</strong></td>
                                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;"><br/>'.$giValue['product_title'].'</td>
                                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">'.$giValue['product_qty'].'</td>
                                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                                </tr>';
                        }
                        $htmlDataForPDF .= '<tr>
                                                <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", (count($getInquiryProductDetails)+1)).'</strong></td>
                                                <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px; background: #fff;">Vehicle Choosen: <strong>'.$vehicleDetails->vehicle_name.'</strong></td>
                                                <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                                <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">1</td>
                                                <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                            </tr>
                                    <tr>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="background: #fff; padding: 0; margin: 0;"></td>
                                        <td style="font-size: 13px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #000;color: #fff;text-align: center;border-right: 3px solid #fff;">Total:</td>
                                        <td style="font-size: 14px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #717171;color: #fff;text-align: center;border-left: 3px solid #fff;"><strong>$'.$quotedPrice.'</strong></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0; margin: 0; background: #fff;">
                                <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0px 0px 20px; border-spacing: 0; border-collapse: separate; width: 100%; ">
                                    <tr>
                                        <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/mail.png" alt="806-655-5500">'.site_settings_data('helpline_email_address').'</td>
                                        <td style=" width: 18%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/web.png" alt="806-655-5500">www.lnservices.Com</td>
                                        <td style=" width: 15%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/call.png" alt="'.site_settings_data('helpline_no').'">'.site_settings_data('helpline_no').'</td>
                                        <td style=" width: 45%; padding: 0; margin: 0; background: #fff; "><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/location.png" alt="address">'.site_settings_data('address').'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center;padding-top: 30px;"><strong>THANK YOU FOR YOUR BUSINESS</strong> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';

        $pdfFolder = 'quotation_pdfs/';

        $mpdf = new \Mpdf\Mpdf();
        $filename = $invoiceNumber.'_quotation.pdf';
        $uploadsTo = "./uploads/".$pdfFolder.$filename;
        // $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($htmlDataForPDF);
        $mpdf->Output($uploadsTo, "F");

        // Add as email Body

        $htmlDataForBody = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>L & N Services</title>
            </head>
                <body style="background-color: #d4d4d7;">
                    <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0; margin: 0 auto; border: none; outline: none;">
                        <tbody>
                            <tr>
                                <td style="padding: 0; margin: 0;">
                                    <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                        <tr>
                                            <td style="text-align: left;"><img src="'.base_url(). 'uploads/sitesettings_image/'.site_settings_data('logo_image').'" alt="L & N Services" style="max-width: 50%;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left;">
                                    <p style="font-size:15px;">Hello '.$getInquiryDetails->name.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left;">
                                    <p style="font-size:15px;">Your enquiry quotation number is '.$order_number.'</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left;">
                                    <p style="font-size:15px;">Please check the invoice attached as well. Your total quotation amount will be <strong>$'.$quotedPrice.'</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left;">
                                    <p style="font-size:15px;">Please click on the below button for payment.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left;">
                                    <p style="font-size:15px;"><a href="'.base_url().'pay_order/'.base64_encode($order_number).'" style="
                                    background-color: #FF6F02;
                                    padding: 10px;
                                    border-radius: 5px;
                                    text-decoration: none;
                                    color: #fff;
                                ">Accept & Pay</a></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; margin: 0; text-align: left; background: #fff;">
                                    <h3 style="font-size: 20px; color:#000;">L & N Services</h3></br>
                                    <p style="font-weight:400; font-size:15px;">'.site_settings_data('address').'<br>H.No: '.site_settings_data('helpline_no').'<br>www.landnservices.Com</p>
                                </td>
                                <td><img src="'.base_url(). 'uploads/sitesettings_image/'.site_settings_data('logo_image').'" alt="L & N Services" style="max-width: 100%;"></td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>';
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
        $this->email->to($getInquiryDetails->email); // $serviceinquirydetails->email 'eclick.souravdas@gmail.com' $getInquiryDetails->email
        $this->email->subject('Quotation for your order #'.$orderNumber.' On LN Services');
        $this->email->attach($uploadsTo);
        $this->email->message($htmlDataForBody);
        if($this->email->send()){
            $retData['resp'] = 1;
            $retData['msg'] = 'Invoice #'.$orderNumber.' has been sent to customer';
            $this->session->set_flashdata('success', $retData['msg']);
        }
        echo json_encode($retData);
        exit();
    }

    public function testPDF(){
        $mpdf = new \Mpdf\Mpdf();
        // $mpdf->showImageErrors = true;
        $filename = time()."_order.pdf";
        $getInquiryDetails = $this->inquiry_model->get_service_inquiry_details('93');
        $getInquiryProductDetails = $this->inquiry_model->service_inquire_product_details('93');
        $vehicleDetails = $this->inquiry_model->getSingleVehicleDetails('3');
        $quotedPrice = '4500';
        $order_number = 'LN-12345678';
        $invoice_number = 'LN-12345678';
        $invoice_send_on = date('Y-m-d H:i:s');
        $html = '<body style="background-color: #d4d4d7;">
            <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0;margin: 0 auto;border: none;outline: none;">
                <tbody>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                <tr>
                                    <td><img src="uploads/sitesettings_image/'.site_settings_data('logo_image').'" alt="Infynity" style="max-width: 100%;"></td>
                                    <td colspan="2" style="text-align: right; margin-top: 0; font-weight: 700; font-size: 40px;line-height: 44px; position: relative; color: #717171;"><strong>INVOICE</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td style="text-align: right; font-size: 13px;">Invoice No: #'.$invoice_number.'</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td style="text-align: right; font-size: 13px;">Invoice Date: '.date('jS F, Y', strtotime($invoice_send_on)).'</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td style="text-align: right;  font-size: 18px;font-weight: 600; color: #343434;"><strong>Order No: '.$order_number.'</strong>  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <table style="border-spacing: 0; margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                <tr>
                                    <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 28%;"><strong>Bill To</strong></td>
                                    <td style="width: 45%;"></td>
                                    <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 22%;"><strong>Ship To</strong></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br><strong>Pickup Address: </strong>'.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br><strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'<br>'.$getInquiryDetails->email.'<br>'.$getInquiryDetails->phone.'<br>
                                    Vin</td>
                                    <td style="width: 16%;"></td>
                                    <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;">'.$getInquiryDetails->name.'<br><strong>Pickup Address: </strong> '.$getInquiryDetails->pickup_address_floor.' Floor, '.$getInquiryDetails->pickup_address.'<br><strong>Drop-off Address: </strong> '.$getInquiryDetails->dropoff_address_floor.' Floor, '.$getInquiryDetails->dropoff_address.'<br>'.$getInquiryDetails->email.'<br>'.$getInquiryDetails->phone.'<br>
                                    Vin</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 30px 0px 0; border-spacing: 0; border-collapse: separate;">
                                <tr>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 5%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 40%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Price</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 20%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">total</td>
                                </tr>';
                                    foreach ( $getInquiryProductDetails as $giKey => $giValue ) {
                        $html .= '<tr>
                                    <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", ($giKey+1)).'</strong></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;"><br/>'.$giValue['product_title'].'</td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">'.$giValue['product_qty'].'</td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                </tr>';
                                            
                                    }
                        $html .= '<tr>
                                    <td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> '.sprintf("%02d", (count($getInquiryProductDetails)+1)).'</strong></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px; background: #fff;">Vehicle Choosen: <strong>'.$vehicleDetails->vehicle_name.'</strong></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">1</td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <p><a href="'.base_url().'pay_order/'.base64_encode().'">Click Here</a> to make the payment. Ignore if already paid.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="font-size: 13px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #000;color: #fff;text-align: center;border-right: 3px solid #fff;">Total:</td>
                                    <td style="font-size: 14px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #717171;color: #fff;text-align: center;border-left: 3px solid #fff;"><strong>'.$quotedPrice.'</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0; background: #fff;">
                            <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0px 0px 20px; border-spacing: 0; border-collapse: separate; width: 100%; ">
                                <tr>
                                    <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/mail.png" alt="806-655-5500">'.site_settings_data('helpline_email_address').'</td>
                                    <td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/web.png" alt="806-655-5500">www.lnservices.Com</td>
                                    <td style=" width: 18%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/call.png" alt="806-655-5500">'.site_settings_data('helpline_no').'</td>
                                    <td style=" width: 36%; padding: 0; margin: 0; background: #fff; display: flex; align-items: center; column-gap: 10px;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="assets/admin/img/location.png" alt="address">'.'<p>'.site_settings_data('address').'</p>'.'</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center;padding-top: 30px;"><strong>THANK YOU FOR YOUR BUSINESS</strong> </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>';
        /*echo $html;
        exit();*/
        // $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);
        $mpdf->Output("./uploads/".$filename, "I");
    }
}