<?php
    if (!defined("BASEPATH")) exit("No direct script access allowed");
    class Vehicles extends MX_Controller {
        public function __construct() {
            parent::__construct();
            if(!$this->session->userdata('user')) {
                redirect(base_url()."admin/login");
            }
            $this->load->model('vehicles/backoffice/Vehicles_model');
            // /* Load form validation library */ 
            $this->load->library(array('form_validation', "upload"));
            $this->load->library('image_lib');
        }
        public function index() {
            
        }

        public function listVehicles(){
            $data["error"] = "";
            $data["class"] = "vehicles";
            $data["userPermission"] = chk_user_permission("vehicles-list", ["add", "edit", "delete", "list"]);
            $data["vehicleList"] = $this->Vehicles_model->getVehicleLists();
            $this->layout->view("vehicles/backoffice/vehicles-list", "", $data, "normal");
        }

        public function add_view() {
            $data["error"] = "";
            $data["class"] = "vehicles";
            $data["userPermission"] = chk_user_permission("vehicles", ["add", "edit", "delete", "list"]);
            $this->layout->view("vehicles/backoffice/vehicles-add-edit", "", $data, "normal");
        }

        public function edit_view($vehicleId) {
            $data["error"] = "";
            $data["class"] = "vehicles";
            $data['vehicles_details'] = $this->Vehicles_model->getVehicleDetails($vehicleId);
            $data["userPermission"] = chk_user_permission("vehicles", ["add", "edit", "delete", "list"]);
            $this->layout->view("vehicles/backoffice/vehicles-add-edit", "", $data, "normal");
        }

        public function alter_vehicle(){
            $param['vehicle_name'] = trim(strip_tags($this->input->post('vehicle_name')));
            $param['vehicle_status'] = $this->input->post('vehicle_status');
            $param['show_in_front'] = $this->input->post('show_in_front');
            $param['vehicle_content'] = $this->input->post('vehicle_content');

            $action = $this->input->post('action');
            $vehicleId = $this->input->post('vehicleId');
            $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required');
            $this->form_validation->set_rules('vehicle_status', 'Vehicle Status', 'required');
            $this->form_validation->set_rules('show_in_front', 'Show In Frontend', 'required');
            $this->form_validation->set_rules('vehicle_content', 'Vehicle Content', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                  'error' => validation_errors()
                );
                $this->session->set_flashdata($data);
                if($action == 'add') {
                    redirect(base_url().'admin/vehicles/add');
                } else {
                    redirect(base_url().'admin/vehicles/edit/'.$vehicleId);
                }
            } else {
                // Upload Vehicle Image Configuration
                $uploadPath = PPATH."uploads/vehicle_image/";    
		        $config['upload_path'] = $uploadPath;
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['encrypt_name'] = TRUE;

                // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

                if($_FILES['vehicle_image']['name'] != ''){
                    if($this->upload->do_upload('vehicle_image')){
		                if($this->input->post('hiddenvehicle_image') != "") {
		                    $old_image  = PPATH . 'uploads/vehicle_image/' . $this->input->post('hiddenvehicle_image');
		                    $thumbfileName = str_ireplace('.', '_resized.', $this->input->post('hiddenvehicle_image'));
		                    $old_resized_image  = PPATH . 'uploads/vehicle_image/' . $thumbfileName;
		                    unlink($old_image);
		                    unlink($old_resized_image);
		                }
		                // Uploaded file data
		                $fileData = $this->upload->data();
		               	$param['vehicle_image'] = $fileData['file_name'];
		            }
                }

                $action = $this->input->post('action');
                switch($action){
                    case 'add':
                        $param['vehicle_slug'] = setGeneralSlug(create_url_slug(trim($param['vehicle_name'])), 'vehicles', 'vehicle_slug');
                        $param['addedOn'] = date('Y-m-d H:i:s');
                        $successMessage = '<p class="success-msg">Vehicle has been added!!!</p>';
                        $errorMessage = '<p class="error-msg">Vehicle has not been added!!!</p>';
                    break;

                    case 'edit':
                        $param['id'] = $this->input->post('vehicleId');
                        $param['modifiedOn'] = date('Y-m-d H:i:s');
                        $successMessage = '<p class="success-msg">Vehicle has been updated!!!</p>';
                        $errorMessage = '<p class="error-msg">Vehicle has not been updated!!!</p>';
                    break;
                }

                $getResult = $this->Vehicles_model->alterVehiclesDetails($param, $action);

                if($getResult != 0){
                    $this->session->set_flashdata('success', $successMessage);
                } else {
                    $this->session->set_flashdata('error', $errorMessage);
                }
    
                redirect(base_url().'admin/vehicles/vehicles-list');
            }
        }

        public function deleteVehicle($vehicleId){
            $response = $this->Vehicles_model->deleteVehicle($vehicleId);
            $successMessage = '<p class="success-msg">Vehicle has been deleted!!!</p>';
            $this->session->set_flashdata('success', $successMessage);
            redirect(base_url().'admin/vehicles/vehicles-list');
        }
    }
?>