<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Adminusers extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $this->load->library('session');
        $this->load->model('adminusers/backoffice/adminusers_model');
        $this->load->library(array('form_validation'));
        if(module_permissions('adminusers'))
		{
		}else{
			$errorMessage = 'You have no permission to visit this page.';
			$this->session->set_flashdata('error', $errorMessage);
        	redirect(base_url().'admin/dashboard');
		}

    }
    public function index() {
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        else{
            $data['error'] = "";
            $data['class'] = 'adminusers';
            $data['users'] = $this->adminusers_model->getUser();

            $this->layout->view('adminusers/backoffice/adminusers','',$data,'normal');
        }
    }

    public function UsersRole(){
        $data['pageTitle'] = 'Add Admin User';
        $data['class'] = 'adminusers';
        $roles = $this->adminusers_model->getRole();
        $data['roles'] = $roles;
        $this->layout->view('adminusers/backoffice/adminusersrole','',$data,'normal');
    }

    public function addUsersAction(){
        
        $allrecord = $this->input->post();

        $param['username'] = trim(strip_tags($allrecord['UserName']));
        $param['email'] = trim(strip_tags($allrecord['UserEmail']));

        if($allrecord['action']=='add'){
            $is_unique =  '|is_unique[users.email]';
        } else {
            $userId = $allrecord['userId'];
            $is_unique =  '|edit_unique[users.email.'.$userId.']';
        }

        $this->form_validation->set_rules('UserName', 'Username', 'required', 'Name is required');
        $this->form_validation->set_rules('UserEmail', 'Email', 'trim|required|valid_email'.$is_unique, 'Please enter a valid email address.');
        $this->form_validation->set_rules('Role', 'Role', 'required', 'Role is required');
        $this->form_validation->set_rules('UserPhone', 'Phone', 'required', 'Phone is required');
        if($allrecord['action']=='add')
        {
            $this->form_validation->set_rules('UserPassword', 'Password', 'required', 'Password is required');
            $this->form_validation->set_rules('UserConfirmPassword', 'Confirm Password', 'required|matches[UserPassword]', 'Password and confirm password are not same');
        }
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
              'error' => validation_errors()
            );
            $this->session->set_flashdata($data);
            if($allrecord['action']=='add'){
                redirect(base_url().'admin/adminusers/adduser');
            }else{
                redirect(base_url().'admin/adminusers/edituser/'.$allrecord['userId']);
            }
        }
        if($allrecord['action'] == 'edit' && $allrecord['checkchangepass'] == 'Y'){
            $param['password'] = getHashedPassword($allrecord['UserPassword']);
        }elseif($allrecord['action'] == 'add'){
            $param['password'] = getHashedPassword($allrecord['UserPassword']);
        }        

        $param['phone'] = $allrecord['UserPhone'];
        $param['active'] = $allrecord['userStatus'];
        $param['role'] = $allrecord['Role'];
        $param['user_type'] = 'SUBADMIN';
        if($allrecord['action'] == 'add')
        {
            $param['created_on'] = time();
        }
        if($allrecord['action'] == 'edit')
        {
            $param['id'] = $allrecord['userId'];
        }        
        $this->adminusers_model->addUser($param,$allrecord['action']);
        if($allrecord['action'] == 'add')
        {
            $successMessage = 'User added successfully';
        }elseif($allrecord['action'] == 'edit')
        {
            $successMessage = 'User updated successfully';
        }
        
        $this->session->set_flashdata('success', $successMessage);
        
        redirect(base_url().'admin/adminusers');
    }

    public function user_exists($str)
	{
		if ($this->adminusers_model->checkExistingUser($str))
		{
			$this->form_validation->set_message('user_exists', 'Please enter an alternate email address, or login with your existing email.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

    public function addUsersRole()
	{
		$data['pageTitle'] = 'Add Admin User';
        $data['class'] = 'adminusers';
        //$permissions = $this->config->item('permission');
        //print '<pre>';
        //print_r($permissions);
        //$innerpages = $this->config->item('innerpages');
        //print '<pre>';
        //print_r($innerpages);
        $permissionsArr = $this->adminusers_model->getBaseRole();
        if(is_array($permissionsArr) && count($permissionsArr)>0)
        {
            foreach($permissionsArr as $k=>$v)
            {
                $permiossionFinalArray[$v['module_id']] = $v;
            }
        }

        if(is_array($permiossionFinalArray) && count($permiossionFinalArray)>0)
        {
            foreach($permiossionFinalArray as $k=>$val)
            {
                if($val['parent_module']>0)
                {
                    $parentModule = $permiossionFinalArray[$val['parent_module']];
                    $innerpages[$parentModule['permalink']] [$val['permalink']] = $val['module_name'];
                }else{
                    $permissions[$val['permalink']] = $val['permission'];
                    $moduledetails[$val['permalink']] = $val['module_name'];
                }
            }
        }
        //print '<pre>';
        //print_r($innerpages);
        //die;

        if(is_array($permissions) && count($permissions) >0)
        {
            foreach($permissions as $k=>$v)
            {
                if($v == 'REQUIRE')
                {
                    //$moduledetails = $this->config->item('module_name');
                    $requiredpermissions[$k] = array(
                        'modulename'=>$moduledetails[$k]
                    );
                    $requiredpermissions[$k]['checked'] = '';
                    $requiredpermissions[$k]['add'] = '';
                    $requiredpermissions[$k]['edit'] = '';
                    $requiredpermissions[$k]['delete'] = '';
                    $requiredpermissions[$k]['list'] = '';
                    if(is_array($innerpages[$k]) && count($innerpages[$k])>0)
                    {
                        foreach($innerpages[$k] as $subk=>$subv)
                        {
                            $innerpages[$k][$subk] = [
                                'modulename'=>$subv,
                                'checked'=>'',
                                'add'=>'',
                                'edit'=>'',
                                'delete'=>'',
                                'list'=>'',
                            ];
                        }

                        $requiredpermissions[$k]['inner'] = $innerpages[$k];
                    }
                }
            }
            $data['userpermissions'] = $requiredpermissions;

        }
        $data['generatedpassword'] = $this->generatepasswordsuggestion(8);
        $this->layout->view('adminusers/backoffice/add-edit-users-role','',$data,'normal');
	}
    public function alterUsersRole($id)
	{
		$data['pageTitle'] = 'Add Admin User';
        $data['class'] = 'adminusers';
        //$permissions = $this->config->item('permission');
        //$innerpages = $this->config->item('innerpages');
        $roles = $this->adminusers_model->getRole($id);
        $roles[0]['permission'] = json_decode($roles[0]['permission'],true);
        $permissionsArr = $this->adminusers_model->getBaseRole();
        
        if(is_array($permissionsArr) && count($permissionsArr)>0)
        {
            foreach($permissionsArr as $k=>$v)
            {
                $permiossionFinalArray[$v['module_id']] = $v;
            }
        }

        if(is_array($permiossionFinalArray) && count($permiossionFinalArray)>0)
        {
            foreach($permiossionFinalArray as $k=>$val)
            {
                if($val['parent_module']>0)
                {
                    $parentModule = $permiossionFinalArray[$val['parent_module']];
                    $innerpages[$parentModule['permalink']] [$val['permalink']] = $val['module_name'];
                }else{
                    $permissions[$val['permalink']] = $val['permission'];
                    $moduledetails[$val['permalink']] = $val['module_name'];
                }
            }
        }

        if(is_array($permissions) && count($permissions) >0)
        {
            foreach($permissions as $k=>$v)
            {
                if($v == 'REQUIRE')
                {
                    //$moduledetails = $this->config->item('module_name');
                    $requiredpermissions[$k] = array(
                        'modulename'=>$moduledetails[$k]
                    );
                    //if(!is_array($roles[0]['permission'][$k]))
                    $requiredpermissions[$k]['checked'] = $roles[0]['permission'][$k]['checked'];
                    $requiredpermissions[$k]['add'] = $roles[0]['permission'][$k]['add'];
                    $requiredpermissions[$k]['edit'] = $roles[0]['permission'][$k]['edit'];
                    $requiredpermissions[$k]['delete'] = $roles[0]['permission'][$k]['delete'];
                    $requiredpermissions[$k]['list'] = $roles[0]['permission'][$k]['list'];

                    if(is_array($innerpages[$k]) && count($innerpages[$k])>0)
                    {
                        foreach($innerpages[$k] as $subk=>$subv)
                        {
                            $innerpages[$k][$subk] = [
                                'modulename'=>$subv,
                                'checked'=>$roles[0]['permission'][$k]['inner'][$subk]['checked'],
                                'add'=>$roles[0]['permission'][$k]['inner'][$subk]['add'],
                                'edit'=>$roles[0]['permission'][$k]['inner'][$subk]['edit'],
                                'delete'=>$roles[0]['permission'][$k]['inner'][$subk]['delete'],
                                'list'=>$roles[0]['permission'][$k]['inner'][$subk]['list'],
                            ];
                        }
                        $requiredpermissions[$k]['inner'] = $innerpages[$k];
                    }
                }
            }
            
            $data['userpermissions'] = $requiredpermissions;

        }
        
        $data['role_name'] = $roles[0]['role_name'];
        $data['role_id'] = $roles[0]['id'];
        $data['status'] = $roles[0]['status'];
        
        //$data['generatedpassword'] = $this->generatepasswordsuggestion(8);
        $this->layout->view('adminusers/backoffice/add-edit-users-role','',$data,'normal');
	}
    public function addUsers()
	{
		$data['pageTitle'] = 'Add Admin User';
        $data['class'] = 'adminusers';
        $data['Roles'] = $this->adminusers_model->getRole(null,1);
        
        $data['generatedpassword'] = $this->generatepasswordsuggestion(8);
        $this->layout->view('adminusers/backoffice/add-edit-users','',$data,'normal');
	}

    public function editUsers($id)
	{
        
		$data['pageTitle'] = 'Edit Admin User';
        $data['class'] = 'adminusers';
        $data['Roles'] = $this->adminusers_model->getRole(null,1);
        $data['users'] = $this->adminusers_model->getUser($id);
        $data['id'] = $id;
        
        $data['generatedpassword'] = $this->generatepasswordsuggestion(8);
        $this->layout->view('adminusers/backoffice/add-edit-users','',$data,'normal');
	}

    public function deleteUser($id)
    {
        $this->adminusers_model->deleteUser($id);
        $successMessage = 'User deleted successfully!';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/adminusers');
    }

    public function addrole(){
        if(!$this->session->userdata('user'))
		{
			redirect(base_url()."admin/login");
		}
        $RoleId = $this->input->post('roleid');
        $RoleName = $this->input->post('RoleName');
        $RoleStatus = $this->input->post('status');
        $action = $this->input->post('action');
        
        $mainpermission = $this->input->post('mainpermission');
        $addpermission = $this->input->post('mainpermission');

        // print '<pre>';
        // print_r($mainpermission);
        // print_r($mainpermission);
        //$permissions = $this->config->item('permission');
        //$innerpages = $this->config->item('innerpages');
        $roles = $this->adminusers_model->getRole($id);
        $roles[0]['permission'] = json_decode($roles[0]['permission'],true);
        $permissionsArr = $this->adminusers_model->getBaseRole();
        
        if(is_array($permissionsArr) && count($permissionsArr)>0)
        {
            foreach($permissionsArr as $k=>$v)
            {
                $permiossionFinalArray[$v['module_id']] = $v;
            }
        }

        if(is_array($permiossionFinalArray) && count($permiossionFinalArray)>0)
        {
            foreach($permiossionFinalArray as $k=>$val)
            {
                if($val['parent_module']>0)
                {
                    $parentModule = $permiossionFinalArray[$val['parent_module']];
                    $innerpages[$parentModule['permalink']] [$val['permalink']] = $val['module_name'];
                }else{
                    $permissions[$val['permalink']] = $val['permission'];
                    $moduledetails[$val['permalink']] = $val['module_name'];
                }
            }
        }
        if(is_array($permissions) && count($permissions) >0)
        {
            foreach($permissions as $k=>$v)
            {
                if($v == 'REQUIRE')
                {
                    // $moduledetails = $this->config->item('module_name');
                    // $requiredpermissions[$k] = array(
                    //     'modulename'=>$moduledetails[$k]
                    // );
                    $mainpermissionmodified = [];
                    if(is_array($innerpages[$k]) && count($innerpages[$k])>0)
                    {
                    }
                    else
                    {
                        $requiredpermissions[$k]['checked'] = $mainpermission[$k];
                        $requiredpermissions[$k]['add'] = $this->input->post('add_'.$k);
                        $requiredpermissions[$k]['edit'] = $this->input->post('edit_'.$k);
                        $requiredpermissions[$k]['delete'] = $this->input->post('delete_'.$k);
                        $requiredpermissions[$k]['list'] = $this->input->post('list_'.$k);
                    }
                    if(is_array($innerpages[$k]) && count($innerpages[$k])>0)
                    {
                        foreach($innerpages[$k] as $subk=>$subv)
                        {
                            $innerpages[$k][$subk] = [
                                'checked'=> $mainpermission[$k]['sub'][$subk],
                                'add'=>$this->input->post('add_'.$k.'_'.$subk),
                                'edit'=>$this->input->post('edit_'.$k.'_'.$subk),
                                'delete'=>$this->input->post('delete_'.$k.'_'.$subk),
                                'list'=>$this->input->post('list_'.$k.'_'.$subk)
                            ];
                        }
                        $requiredpermissions[$k]['inner'] = $innerpages[$k];
                    }
                }
            }
        }
        
        
        // if(is_array($mainpermission) && count($mainpermission)>0)
        // {
        //     foreach($mainpermission as $k=>$v)
        //     {
        //         if($v == 'on')
        //         {
        //             $mainpermissionmodified[$k] = ['checked'=>'on'];
        //         }
        //     }
        // }
        // print '<pre>';
        // print_r($mainpermissionmodified);
        // die;
        $this->form_validation->set_rules('RoleName', 'Role Name', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
            'error' => validation_errors(),
            );
            $this->session->set_flashdata($data);

            if($action=="add")
            {
                redirect(base_url().'admin/adminusers/userrole');
            }
            else
            {
                redirect(base_url().'admin/adminusers/userrole/'.$pageID);
            }
        }
        $param = [];
        $param['id'] = $RoleId;
        $param['role_name'] = $RoleName;
        $param['status'] = $RoleStatus;
        
        $param['permission'] = json_encode($requiredpermissions);
        
        $this->adminusers_model->alterRole($param,$action);
        ($action == 'add')? $successMessage = 'Role has been added.': $successMessage = 'Role has been edited.'
        ;
        $this->session->set_flashdata('success', $successMessage);
        
        redirect(base_url().'admin/adminusers/userrole');
    }

    public function massalterUsersRole(){
        $checkval= $this->input->post('check');
        $multiple_type= $this->input->post('multiple_type');
        
        if(is_array($checkval) && count($checkval)>0)
        {
            foreach($checkval as $chk=>$chv)
            {
                $param = [];
                $param['id'] = $chv;
                if($multiple_type == 'act')
                {
                    $param['status'] = 1;
                }elseif($multiple_type == 'inact')
                {
                    $param['status'] = 0;
                }
                $this->adminusers_model->alterRole($param,'edit');
            }
        }
        $param = [
            
        ];
       echo json_encode($param);
    }

    public function deleteRole($id)
    {
        $this->adminusers_model->deleteRole($id);
        $successMessage = 'Role deleted successfully!';
        $this->session->set_flashdata('success', $successMessage);
        redirect(base_url().'admin/adminusers/userrole');
    }

    public function passwordsuggestionuser()
    {
        $data['autopass'] = $this->generatepasswordsuggestion(8);
        $data['csrf'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function passwordsuggestionuseraction(){
        print '<pre>';
        print_r($_REQUEST);
        die;
    }

    



    protected function generatepasswordsuggestion($len){
    
        //define character libraries - remove ambiguous characters like iIl|1 0oO
        $sets = array();
        $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        $sets[] = '23456789';
        $sets[]  = '~!@#$%^&*(){}[],./?';

        $password = '';

        //append a character from each set - gets first 4 characters
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
        }

        //use all characters to fill up to $len
        while(strlen($password) < $len) {
            //get a random set
            $randomSet = $sets[array_rand($sets)];
            
            //add a random char from the random set
            $password .= $randomSet[array_rand(str_split($randomSet))]; 
        }

        //shuffle the password string before returning!
        return str_shuffle($password);
    }

    public function delete_active_inactive_multiple_user()
    {
        $userPermission = chk_user_permission('adminusers',['edit','delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
            switch($actionType){
                case 'delete':
                  
                        foreach($dataIds as $dataId){
                            $this->adminusers_model->deleteUser($dataId);
                            $msg = '<p class="success-msg">User deleted successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    
                    break;
                case 'act':
                case 'inact':
                        $response=[];
                        $status = ($actionType == 'act') ? '1' : '0';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'active' => $status
                            );

                            $response[] = $this->adminusers_model->multiple_user_update($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">User updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    } 

    public function delete_active_inactive_multiple_user_role()
    {
        $userPermission = chk_user_permission('adminusers',['edit','delete']);
        $dataIds = $this->input->post('dataIds');
        $actionType = $this->input->post('actionType');
        $status = 0;
            switch($actionType){
                case 'delete':
                  
                        foreach($dataIds as $dataId){
                            $this->adminusers_model->deleteRole($dataId);
                            $msg = '<p class="success-msg">User role deleted successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    
                    break;
                case 'act':
                case 'inact':
                        $response=[];
                        $status = ($actionType == 'act') ? '1' : '0';
                        foreach($dataIds as $dataId){
                            $data = array(
                                'status' => $status
                            );

                            $response[] = $this->adminusers_model->multiple_user_update_role($data, $dataId);
                            
                        }
                        if(!in_array(0,$response)){
                            $msg = '<p class="success-msg">User role updated successfully!</p>';
                            $this->session->set_flashdata('success', $msg);
                            $status = 1;
                        }
                    break;
            }
            echo json_encode(array('status'=>$status));
            exit();
    }

}
?>