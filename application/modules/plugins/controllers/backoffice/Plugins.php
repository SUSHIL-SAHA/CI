<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Plugins extends MX_Controller
{
    //protected $userPermission;
    //protected $errorMessage = 'You have no permission to visit this page.';
    public function __construct()
    {
        if (!$this->session->userdata('user')) {
            redirect(base_url() . "admin/login");
        }
        $this->load->model('plugins/backoffice/plugins_model');
        $this->load->library(array('form_validation', "upload"));
        $this->load->library('image_lib');
    }
    public function index()
    {
        $data['error'] = "";
        $data['class'] = "plugins";
        $data['userPermission'] = chk_user_permission('plugins', ['add', 'edit', 'delete', 'list']);
        $data['pluginsList'] = $this->plugins_model->getpluginsLists();
        // echo "<pre>";print_r($data['pluginsList']);die;
        $this->layout->view('plugins/backoffice/plugins-list', '', $data, 'normal');
    }

    public function create_plugin()
    {
        $userPermission = chk_user_permission('plugins', ['add']);
        if (!$userPermission['add']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }
        $data['pageTitle'] = 'Add plugins';
        $data['class'] = "plugins";
        $data['pluginsList'] = $this->plugins_model->getpluginsLists();
        $this->layout->view('plugins/backoffice/add-edit-plugins', '', $data, 'normal');
    }

    public function insert_plugin()
    {
        $userPermission = chk_user_permission('plugins', ['add', 'edit']);
        $action = $this->input->post('action');
        if ($action == 'add') {
            if (!$userPermission['add']) {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url() . 'admin/dashboard');
            }
        } else {
            if (!$userPermission['edit']) {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url() . 'admin/dashboard');
            }
        }
        $module_id = $this->input->post('module_id');
        $parent_module = $this->input->post('parent_module');
        $module_name = $this->input->post('module_name');
        $permalink = create_url_slug(trim($module_name));
        $font_awesome = $this->input->post('font_awesome');
        $sort = $this->input->post('sort');
        $this->form_validation->set_rules('module_name', 'Module Name', 'required', 'Module Name is required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if ($action == 'add') {
                redirect(base_url() . 'admin/plugins/create-plugin');
            } else {
                redirect(base_url() . 'admin/plugins/edit-plugin/' . $module_id);
            }
        } else {

            if ($parent_module) {
                $data = array(
                    'core_module' => '0',
                    'module_name' => $module_name,
                    'parent_module' => $parent_module,
                    'permission' => 'REQUIRE',
                    'permalink' => $permalink,
                    'fontawesome' => $font_awesome,
                    'sort' => $sort,
                    'status' => '1',
                    'create_date' => date('y-m-d')
                );

                if ($action == 'add') {
                    $this->db->insert('modules', $data);
                    $msg = '<p class="success-msg">Module created successfully!</p>';
                    $this->session->set_flashdata('success', $msg);
                } else {
                    $this->db->where('module_id', $module_id);
                    $this->db->update('modules', $data);
                    $msg = '<p class="success-msg">Module updated successfully!</p>';
                    $this->session->set_flashdata('success', $msg);
                }
            } else {

                $data = array(
                    'core_module' => '0',
                    'module_name' => $module_name,
                    'parent_module' => '0',
                    'permission' => 'REQUIRE',
                    'permalink' => $permalink,
                    'fontawesome' => $font_awesome,
                    'sort' => $sort,
                    'status' => '1',
                    'create_date' => date('y-m-d')
                );

                if ($action == 'add') {
                    $this->db->insert('modules', $data);
                    $insert_id = $this->db->insert_id();
                    if ($insert_id) {
                        $parent_module_name = $module_name.' List';
                        $parent_permalink = create_url_slug(trim($parent_module_name));
                        $parent_data = array(
                            'core_module' => '0',
                            'module_name' => $parent_module_name,
                            'parent_module' => $insert_id,
                            'permission' => 'REQUIRE',
                            'permalink' => $parent_permalink,
                            'fontawesome' => 'fa fa-list',
                            'sort' => $sort,
                            'status' => '1',
                            'create_date' => date('y-m-d')
                        );

                        $this->db->insert('modules', $parent_data);
                    // ========= Create directory =============
                    $module_folder = APPPATH . "modules/";
                    if (!file_exists($module_folder . $permalink)) {
                        mkdir($module_folder . $permalink . '/config', 0777, true);
                        mkdir($module_folder . $permalink . '/controllers/backoffice', 0777, true);
                        mkdir($module_folder . $permalink . '/models/backoffice', 0777, true);
                        mkdir($module_folder . $permalink . '/views/backoffice', 0777, true);
                    }
                    // ========= End directory =============
                    // ========= Create File ============= 
                    $route = "";
                    $route.= '$route["admin/' . $permalink . '/'.$parent_permalink.'"] = "' . $permalink . '/backoffice/' . $permalink . '";';
                    $route.= '$route["admin/' . $permalink . '/add"] = "' . $permalink . '/backoffice/' . $permalink . '/add_view";';
                    $route_content = "<?php\n" . $route . "\n  ?>\n";
                    $route_fp = fopen($module_folder . $permalink . "/config/" . $permalink . "_routes.php", "wb");
                    fwrite($route_fp, $route_content);
                    fclose($route_fp);

                    $conroller_name = ucfirst($permalink);
                    $controller_content = '<?php
                          if (!defined("BASEPATH")) exit("No direct script access allowed");
                          class ' . $conroller_name . ' extends MX_Controller {
                            public function index()
                            {
                                $data["error"] = "";
                                $data["class"] = "' . $permalink . '";
                                $data["userPermission"] = chk_user_permission("' . $parent_permalink . '", ["add", "edit", "delete", "list"]);
                                $this->layout->view("' . $permalink . '/backoffice/' . $permalink . '-list", "", $data, "normal");
                            }

                            public function add_view()
                            {
                                $data["error"] = "";
                                $data["class"] = "' . $permalink . '";
                                $data["userPermission"] = chk_user_permission("' . $permalink . '", ["add", "edit", "delete", "list"]);
                                $this->layout->view("' . $permalink . '/backoffice/' . $permalink . '-add-edit", "", $data, "normal");
                            }
                        }
                        ?>';
                    $conroller_fp = fopen($module_folder . $permalink . "/controllers/backoffice/" . $conroller_name . ".php", "wb");
                    fwrite($conroller_fp, $controller_content);
                    fclose($conroller_fp);

                    $model_name = ucfirst($permalink);
                    $model_content = "<?php\n  if (!defined('BASEPATH')) exit('No direct script access allowed');\n
                    class " . $model_name . "_model extends BaseModel {\n  }\n ?>";
                    $model_fp = fopen($module_folder . $permalink . "/models/backoffice/" . $model_name . "_model.php", "wb");
                    fwrite($model_fp, $model_content);
                    fclose($model_fp);

                    $view_name = ucfirst($permalink);
                    $page_variable_name = $permalink . '_details';
                    $view_content = '
                        <div class="content-wrapper"><div class="container-fluid">
                        <!-- Breadcrumbs-->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                            <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">' . $module_name . ' Lists</li>
                        </ol>
                        <?php $error = $this->session->flashdata("error");if($error) { ?>
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata("error"); ?>                    
                        </div>
                        <?php 
                        } 
                        $success = $this->session->flashdata("success");
                        if($success) { 
                        ?>
                         <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata("success"); ?>
                    </div>
                        <?php 
                        } 
                        ?>
                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                        <i class="fa fa-table"></i> '.$module_name.' Lists
                        <?php
                            if($userPermission["add"]){
                                ?>
                            <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/'.$permalink.'/add"><i class="fa fa-plus"></i> Add New '.$module_name.' </a> 
                            <?php
                            }
                            ?>
                        
                        </div>
                      
                        <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <?php
                            if($userPermission["list"]){
                            ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <?php
                            if($userPermission["edit"] || $userPermission["delete"]){
                                ?>
                            <div class="bottom-select">
                            <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="service/delete-active-inactive-multiple-service">
                                        <option value="">Select</option>
                                        <?php
                            if($userPermission["edit"]){
                                ?>
                                        <option value="act">Active</option>
                                        <option value="inact">Inactive</option>
                                        <?php
                            }
                            if($userPermission["delete"]){
                            ?>
                                        <option value="delete">Delete</option>
                                        <?php
                            }
                            ?>
                        </select>
                        </div>
                        <?php
                            }
                            ?>
                            <tr>
                                <th><input type="checkbox" id="checkAll" name="checkAll"></th>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Added / Modified Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                //print_r($page_variable_name);
                                if(!empty($page_variable_name)){
                                $i=0;
                                foreach($page_variable_name as $row){
                                    $i++;
                                ?>
                                <tr id="blog-<?php echo base64_encode($row["id"]);?>">
                                <td><input type="checkbox" id="check" name="check" value="<?php echo $row["id"]; ?>"></td>
                                <td><?php echo $i ;?></td>
                                <td> 
                                <?php
                                    echo $row["name"];
                                ?>
                                </td>
                               
                                <td><?php echo ($row["modifiedOn"] != "") ? date("d F Y H:i:s", strtotime($row["modifiedOn"])) : date("d F Y H:i:s", strtotime($row["addedOn"]));?></td>
                                <td><?php echo ($row["status"] == 1) ? "Active" : "Inactive";?></td>
                                <td>
                                <?php
                            if($userPermission["edit"]){
                                ?>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url()."admin/service/service-edit/".$row["id"]; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <?php
                            }
                            if($userPermission["delete"]){
                            ?>
                                    

                                    <a class="btn btn-sm btn-danger deleteRow deleteBlog" href="javascript:void(0);" data-delete-href="<?php echo base_url()."admin/service/service-delete/".$row["id"]; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                                    <?php }
                            ?>    
                                    
                                </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    ?>
                                <tr id="emptyBlog">
                                <td colspan="6" class="text-center">No records found</td>
                                </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                            </table>
                            <?php
                            if($userPermission["edit"] || $userPermission["delete"]){
                                ?>
                            <div class="bottom-select">
                            <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="service/delete-active-inactive-multiple-service">
                                        <option value="">Select</option>
                                        <?php
                            if($userPermission["edit"]){
                                ?>
                                        <option value="act">Active</option>
                                        <option value="inact">Inactive</option>
                                        <?php
                            }
                            if($userPermission["delete"]){
                            ?>
                                        <option value="delete">Delete</option>
                                        <?php
                            }
                            ?>
                            </select> 
                            </div>
                            <?php
                            }
                            }
                            ?>
                        </div>
                        </div>
                       
                    </div>
                    <!-- /tables-->
                    </div>
                    <!-- /container-fluid-->
                    </div>

                    <div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this '.$module_name.'</h4>
                        </div>
                        <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
                        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                        </div>
                    </div>
                    </div>
                    </div>


                         ';
                    $view_fp = fopen($module_folder . $permalink . "/views/backoffice/" . $view_name . "-list.php", "wb");
                    fwrite($view_fp, $view_content);
                    fclose($view_fp);

                    $add_view_name = ucfirst($permalink);
                    $add_view_content = '
                    <?php
                    $name = "";
                    $status = "";
                    $headingText = "Add '.$module_name.'";
                    $action = "add";
                    $'.$permalink.'Id = "";


                    if (isset($'.$permalink.'_details)) {
                    $name = $'.$permalink.'_details["name"];
                    $status = $'.$permalink.'_details["status"];
                    $headingText = "Edit '.$module_name.'";
                    $action = "edit";
                    $'.$permalink.'Id = $'.$permalink.'_details["id"];
                    }
                    ?>
                    <div class="content-wrapper">
                    <div class="container-fluid">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="<?php echo base_url(); ?>admin/' . $permalink . '/'.$parent_permalink.'">'.$module_name.'</a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo $headingText; ?></li>
                      </ol>
                      <div class="box_general padding_bottom">
                        <?php
                        $error = $this->session->flashdata("error");
                        if ($error) {
                        ?>
                          <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata("error"); ?>
                          </div>
                        <?php
                        }
                  
                        $success = $this->session->flashdata("success");
                        if ($success) {
                        ?>
                          <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata("success"); ?>
                          </div>
                        <?php
                        }
                        ?>
                  
                        <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                              <div class="header_box version_2">
                                <h2><i class="fa fa-plus"></i><?php echo $headingText; ?></h2>
                                <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/' . $permalink . '/'.$parent_permalink.'"><i class="fa fa-level-up"></i> Back to list</a>
                              </div><!-- /.box-header -->
                              <!-- form start -->
                              <br clear="all">
                              <?php $this->load->helper("form"); ?>
                              <form role="form" id="AddEdit'.$permalink.'Id" action="<?php echo base_url(); ?>admin/service/serviceInsert" method="post" role="form" enctype="multipart/form-data">
                                <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <div class="box-body">
                                  <div class="row">
                  
                                    <div class="col-md-6 blog-name">
                                      <div class="form-group">
                                        <label for="blogName">Name <span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name">
                                      </div>
                                    </div>
                  
                  
                  
                                    <div class="col-md-6 blog-slug">
                                      <div class="form-group">
                                        <label for="blogCategory">Status</label>
                                        <label for="status"><input type="radio" name="status" value="1" <?php if($status == "" || $status == "1"){ echo "checked"; } ?>>Active</label>
                                        <label for="status"><input type="radio" name="status" value="0" <?php if($status == "0"){ echo "checked"; } ?>> Inactive</label>
                                      </div>
                                    </div>
                  
                                  </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                  <input type="hidden" name="action" value="<?php echo $action; ?>">
                                  <?php if ($'.$permalink.'Id != "") { ?>
                                    <input type="hidden" name="'.$permalink.'Id" value="<?php echo $'.$permalink.'Id; ?>">
                                  <?php } ?>
                                  <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                                  <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/'.$permalink.'/'.$parent_permalink.'">Cancel</a>
                                  <p><span style="color:red">*</span> fields are mandatory.</p>
                                </div>
                              </form>
                            </div>
                          </div>
                     
                  
                        
                        </div>
                  
                      </div>
                    </div>
                  </div>
                  ';
                    $add_view_fp = fopen($module_folder . $permalink . "/views/backoffice/" . $add_view_name . "-add-edit.php", "wb");
                    fwrite($add_view_fp, $add_view_content);
                    fclose($add_view_fp);




                    // ========= End File =============

                    $msg = '<p class="success-msg">Module created successfully!</p>';
                    $this->session->set_flashdata('success', $msg);
                    } else {
                        $msg = '<p class="error-msg">Module not created!</p>';
                        $this->session->set_flashdata('error', $msg);
                    }
                } else {

                    $this->db->where('module_id', $module_id);
                    $this->db->update('modules', $data);
                    $msg = '<p class="success-msg">Module updated successfully!</p>';
                    $this->session->set_flashdata('success', $msg);
                }
            }
        }

        redirect(base_url() . 'admin/plugins');
    }


    public function edit_plugin($module_id)
    {
        $userPermission = chk_user_permission('plugins', ['edit']);
        if (!$userPermission['edit']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }
        if ($module_id != "") {
            $data['pageTitle'] = 'Edit plugins';
            $data['class'] = "plugins";
            $data['pluginsList'] = $this->plugins_model->getpluginsLists();
            $data['plugins_details'] = $this->plugins_model->getpluginsSingle($module_id);
            // echo "<pre>";print_r($getpluginsDetails['plugins_details']);die;
            $this->layout->view('plugins/backoffice/add-edit-plugins', '', $data, 'normal');
        } else {
            redirect(base_url() . 'admin/plugins/homeplugins');
        }
    }

    public function delete_active_inactive_multiple_plugins()
    {

        $userPermission = chk_user_permission('plugins', ['edit', 'delete']);
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
                        $this->plugins_model->delete_multiple_plugins($dataId);
                        $msg = '<p class="success-msg">Module deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
            case 'act':
            case 'inact':
                if (!$userPermission['edit']) {
                    $this->session->set_flashdata('error', '<p class="error-msg">' . BLOCK_SECTION_MSG . '</p>');
                    $status = 2;
                } else {
                    $response = [];
                    $status = ($actionType == 'act') ? '1' : '0';
                    foreach ($dataIds as $dataId) {
                        $data = array(
                            'status' => $status
                        );

                        $response[] = $this->plugins_model->update_plugins($data, $dataId);
                    }
                    if (!in_array(0, $response)) {
                        $msg = '<p class="success-msg">Module updated successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status' => $status));
        exit();
    }

    public function delete($plugins_id)
    {
        $userPermission = chk_user_permission('homeplugins', ['delete']);
        if (!$userPermission['delete']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }
        $response = $this->plugins_model->delete_plugins($plugins_id);
        $successMessage = '<p class="success-msg">plugins has been deleted!!!</p>';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url() . 'admin/plugins/homeplugins');
    }

    public function sub_plugin_list($module_id)
    {
        $userPermission = chk_user_permission('plugins', ['edit']);
        if (!$userPermission['edit']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }
        if ($module_id != "") {
            $data['pageTitle'] = 'Edit plugins';
            $data['class'] = "plugins";
            $data['userPermission'] = chk_user_permission('plugins', ['add', 'edit', 'delete', 'list']);
            // $data['pluginsList'] = $this->plugins_model->getpluginsLists();
            $data['plugins_details'] = $this->plugins_model->getpluginsSingle($module_id);
            $data['sub_plugins'] = $this->plugins_model->get_sub_plugin($module_id);
            // echo "<pre>";print_r($data['plugins_details']);die;
            $this->layout->view('plugins/backoffice/sub-plugins-list', '', $data, 'normal');
        } else {
            redirect(base_url() . 'admin/plugins/homeplugins');
        }
    }

    public function create_sub_plugin($module_id)
    {
        $userPermission = chk_user_permission('plugins', ['edit']);
        if (!$userPermission['edit']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }

        $data['pageTitle'] = 'Edit plugins';
        $data['class'] = "plugins";
        $data['pluginsList'] = $this->plugins_model->getpluginsLists();
        // $data['plugins_details'] = $this->plugins_model->getpluginsSingle($module_id);
        $data['main_module_details'] = $this->plugins_model->getpluginsSingle($module_id);
        // echo "<pre>";print_r($getpluginsDetails['plugins_details']);die;
        $this->layout->view('plugins/backoffice/add-edit-sub-plugins', '', $data, 'normal');
    }

    public function edit_sub_plugin($module_id)
    {
        $userPermission = chk_user_permission('plugins', ['edit']);
        if (!$userPermission['edit']) {
            $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url() . 'admin/dashboard');
        }
        if ($module_id != "") {
            $data['pageTitle'] = 'Edit plugins';
            $data['class'] = "plugins";
            $data['pluginsList'] = $this->plugins_model->getpluginsLists();
            $data['plugins_details'] = $this->plugins_model->getpluginsSingle($module_id);
            $data['main_module_details'] = $this->plugins_model->getpluginsSingle($data['plugins_details']['parent_module']);
            // echo "<pre>";print_r($getpluginsDetails['plugins_details']);die;
            $this->layout->view('plugins/backoffice/add-edit-sub-plugins', '', $data, 'normal');
        } else {
            redirect(base_url() . 'admin/plugins/homeplugins');
        }
    }

    public function insert_sub_plugin()
    {
        $userPermission = chk_user_permission('plugins', ['add', 'edit']);
        $action = $this->input->post('action');
        if ($action == 'add') {
            if (!$userPermission['add']) {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url() . 'admin/dashboard');
            }
        } else {
            if (!$userPermission['edit']) {
                $this->session->set_flashdata('error', BLOCK_SECTION_MSG);
                redirect(base_url() . 'admin/dashboard');
            }
        }
        $module_id = $this->input->post('module_id');
        $main_module_id = $this->input->post('main_module_id');

        $parent_module = $this->input->post('parent_module');
        $module_name = $this->input->post('module_name');
        $permalink = setPageSlug(create_url_slug(trim($module_name)));
        $font_awesome = $this->input->post('font_awesome');
        $sort = $this->input->post('sort');
        $this->form_validation->set_rules('module_name', 'Module Name', 'required', 'Module Name is required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if ($action == 'add') {
                redirect(base_url() . 'admin/plugins/create-plugin');
            } else {
                redirect(base_url() . 'admin/plugins/edit-sub-plugin/' . $module_id);
            }
        } else {

            $data = array(
                'core_module' => '0',
                'module_name' => $module_name,
                'parent_module' => $parent_module,
                'permission' => 'REQUIRE',
                'permalink' => $permalink,
                'fontawesome' => $font_awesome,
                'sort' => $sort,
                'status' => '1',
                'create_date' => date('y-m-d')
            );

            if ($action == 'add') {
                $this->db->insert('modules', $data);
                $msg = '<p class="success-msg">Module created successfully!</p>';
                $this->session->set_flashdata('success', $msg);
            } else {
                $this->db->where('module_id', $module_id);
                $this->db->update('modules', $data);
                $msg = '<p class="success-msg">Module updated successfully!</p>';
                $this->session->set_flashdata('success', $msg);
            }
        }
        redirect(base_url() . 'admin/plugins/sub-plugin-list/' . $parent_module);
    }

    public function delete_active_inactive_multiple_sub_plugins()
    {
        $userPermission = chk_user_permission('plugins', ['edit', 'delete']);
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
                        $this->plugins_model->delete_multiple_plugins($dataId);
                        $msg = '<p class="success-msg">Module deleted successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
            case 'act':
            case 'inact':
                if (!$userPermission['edit']) {
                    $this->session->set_flashdata('error', '<p class="error-msg">' . BLOCK_SECTION_MSG . '</p>');
                    $status = 2;
                } else {
                    $response = [];
                    $status = ($actionType == 'act') ? '1' : '0';
                    foreach ($dataIds as $dataId) {
                        $data = array(
                            'status' => $status
                        );

                        $response[] = $this->plugins_model->update_plugins($data, $dataId);
                    }
                    if (!in_array(0, $response)) {
                        $msg = '<p class="success-msg">Module updated successfully!</p>';
                        $this->session->set_flashdata('success', $msg);
                        $status = 1;
                    }
                }
                break;
        }
        echo json_encode(array('status' => $status));
        exit();
    }
}
