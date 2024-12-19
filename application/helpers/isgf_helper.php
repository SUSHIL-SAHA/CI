<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}
/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}
if(!function_exists('sendEmail')){
    function sendEmail($to, $subject, $message, $attachment = '', $unsubscribe =false,$type =false){
        // echo $unsubscribe;die;
        $CI = &get_instance();
		//$CI->load->library('email');
		$CI->load->library('phpmailer_lib');
        // PHPMailer object
		$mail = $CI->phpmailer_lib->load();
		
        $CI->db->select("s.*", FALSE);
        $CI->db->from('site_settings s');
        $CI->db->where('id', 1);
        $Query = $CI->db->get();
		$Array = $Query->row_array();
		
		$mail->isSMTP();
        $mail->Host     = SMTP_HOST;
        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure =  SMTPSECURE;
        $mail->Port     = SMTP_PORT;

        
        $mail->setFrom($Array['helpline_email_address'], 'Skeleton CI');
        $mail->addAddress($to);
        
        // Add cc or bcc 
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        if($unsubscribe == true)
        {

            // die('okk');
            $unsubscribe_link='<div>Do you want to unsubscribe <a href="'.base_url().'unsubscribe-reason/?email='.$to.'&type='.$type.'">Click Here</a></div>';
        }
        
        $htmlMessage = '<body style="margin: 0 0 0 0; padding: 0 0 0 0; background-color: #eee;">
                            <div style="width:600px; margin: 0 auto; padding:10px; background-color: #fff; font: normal 18px arial;">
                                <table style="width: 100%;" border:="0"; cellspacing="0";>
                                    <thead style="padding: 0 0 0 0; margin: 0 0 0 0;">
                                    <tr style="padding: 0 0 0 0; margin: 0 0 0 0;">
                                        <td style="padding: 0 0 0 0; margin: 0 0 0 0;">
                                        <table style="width: 100%; background-color: #fff; padding: 0 0px 10px; margin: 0 0 0 0;" border:="0"; cellspacing="0";>
                                            <tr style="padding: 0 0 0 0; margin: 0 0 0 0;">
                                                <td style=" margin: 10px 0 0 0; padding: 0 0; text-align:left; display:block;">
                                                    <a href="'.base_url().'" target="_blank"><img src="'.base_url().'assets/front/image/logo.png" width="201" height="71"></a>
                                                </td>
                                                <td style=" margin: 0 0; padding: 0 0; font: normal 15px arial; text-align:right;">
                                                    <div style="padding:0 0 0 0; margin: 0 0 3px 0; display:block;">'.$Array['address'].'</div>
                                                    <div style="padding:0 0 0 0; margin: 0 0 3px 0; display:block;">
                                                    <a href="tel:'.$Array['helpline_no'].'" style="color:#000; text-decoration: none;">'.$Array['helpline_no'].'</a>
                                                    </div>
                                                    <div style="padding:0 0 0 0; margin: 0 0 3px 0;">
                                                    <a href="mailto:'.$Array['helpline_email_address'].'" target="_blank" style=" color:#000; text-decoration: none;">'.$Array['helpline_email_address'].'</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody style="padding: 0 0 0 0; margin: 0 0 0 0;">
                                        <tr style=" padding: 0 0 0 0; margin: 0 0 0 0;">
                                            <table style="width: 100%; padding: 0 0; margin: 0 0 0 0;" border:="0"; cellspacing="0";>
                                            <tr colspan="2">
                                                <td>
                                                <div style="min-height: 200px; padding: 30px; background-color: #f4f4f4;">
                                                    <div style="padding:0 0 0 0; margin: 0 0 0 0;">
                                                        '.$message.'<br>'.$unsubscribe_link.'
                                                        

                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            </table>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <table style="width: 100%; background-color: #fff; padding: 0 0px; margin: 0 0 0 0;" border:="0"; cellspacing="0";>
                                            <tr style=" padding: 0 0 0 0; margin: 0 0 0 0;">
                                                <td style=" margin: 0 0; padding: 10px 0; font: normal 14px arial; width: 60%; display: inline-block;">Copyright &copy;'.COMPANY_NAME .date('Y').'</td>
                                                <td style=" margin: 0 0; padding: 10px 0; font:normal 16px arial; width: 39%; display: inline-block; text-align: right;">
                                                    <a href="'.$Array['twitter_link'].'" target="_blank" style="text-decoration: none;"><img src="'.base_url().'assets/front/image/twitter_icon.png" style=" width:30px; text-align: center; display: inline-block; padding:0; margin: 0 0; border-radius: 50%;">
                                                    </a>
                                                    <a href="'.$Array['facebook_link'].'" target="_blank" style="text-decoration: none;"><img src="'.base_url().'assets/front/image/facebook_icon.png" style=" width:30px; text-align: center; display: inline-block; padding:0; margin: 0 0; border-radius: 50%;">
                                                    </a>
                                                    <a href="'.$Array['instagram_link'].'" target="_blank" style="text-decoration: none;"><img src="'.base_url().'assets/front/image/instagram_icon.png" style=" width:30px; text-align: center; display: inline-block; padding:0; margin: 0 0; border-radius: 50%;">
                                                    </a>
                                                    <a href="'.$Array['youtube_link'].'" target="_blank" style="text-decoration: none;"><img src="'.base_url().'assets/front/image/youtube_icon.png" style=" width:30px; text-align: center; display: inline-block; padding:0; margin: 0 0; border-radius: 50%;">
                                                    </a>    
                                                </td>
                                            </tr>
                                        </table>
                                    </tfoot>
                                </table>
                            </div>
                        </body>';

        
		$mail->Body = $htmlMessage;
		// Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            echo '<br>Host->'.SMTP_HOST.': User->'.SMTP_USER.': Pass->'.SMTP_PASSWORD.': port->'.SMTP_PORT.': from->'.$Array['helpline_email_address'].': to->'.$to.': secure->'.SMTPSECURE;
            die;
        }else{
            return true;
        }
        return $retStatus;
    }
}
if(!function_exists('setPageSlug')){
    function setPageSlug($slug){
        $CI = &get_instance();
        $CI->db->select("COUNT(*) AS NumHits");
        $CI->db->from("cms_pages");
        $CI->db->like('pageSlug', $slug, 'after');
        $CI->db->where('isDeleted', '0');
        // $getQuery = $CI->db->query("SELECT COUNT(*) AS NumHits FROM ".TABLE_PREFIX."categories WHERE cat_slug  LIKE '$slug%'");
        $getQuery = $CI->db->get();
        $row = $getQuery->row_array();
        $numHits = $row['NumHits'];
        // echo ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
        return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
    }
}
if(!function_exists('setGeneralSlug')){
    function setGeneralSlug($slug, $table, $colName){
        $CI = &get_instance();
        $CI->db->select("COUNT(*) AS NumHits");
        $CI->db->from($table);
        $CI->db->like($colName, $slug, 'after');
        // $CI->db->where('isDeleted', '0');
        // $getQuery = $CI->db->query("SELECT COUNT(*) AS NumHits FROM ".TABLE_PREFIX."categories WHERE cat_slug  LIKE '$slug%'");
        $getQuery = $CI->db->get();
        $row = $getQuery->row_array();
        $numHits = $row['NumHits'];
        // echo ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
        return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
    }
}

if(!function_exists('create_url_slug')){
    function create_url_slug($url){
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $url = trim(preg_replace('/[^a-z0-9]+/', '-', $url), '-');

        return $url;
    }
}

if(!function_exists('create_permalink')){
	function create_permalink($value){
		# Prep string with some basic normalization
		$value = strtolower($value);
		$value = strip_tags($value);
		$value = stripslashes($value);
		$value = html_entity_decode($value);

		# Remove quotes (can't, etc.)
		$value = str_replace('\'', '', $value);

		# Replace non-alpha numeric with hyphens
		$value = trim(preg_replace('/[^a-z0-9]+/', '_', $value), '_');

		return $value;
	}
}
if(!function_exists('setBlogSlug')){
    function setBlogSlug($slug){
        $CI = &get_instance();
        $CI->db->select("COUNT(*) AS NumHits");
        $CI->db->from(TABLE_PREFIX."blogs");
        $CI->db->like('blogSlug', $slug, 'after');
        // $getQuery = $CI->db->query("SELECT COUNT(*) AS NumHits FROM ".TABLE_PREFIX."categories WHERE cat_slug  LIKE '$slug%'");
        $getQuery = $CI->db->get();
        $row = $getQuery->row_array();
        $numHits = $row['NumHits'];
        // echo ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
        return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
    }
}

if ( ! function_exists('site_settings'))
{
    function site_settings()
    {
        $CI =& get_instance();
        return $CI->db->select('*')->get('site_settings')->row();
    }
}

if ( ! function_exists('module_permissions'))
{
    function module_permissions($moduleParam=null,$individualPermission = 'all')
    {
        //echo $individualPermission;die;
        $CI =& get_instance();
        $loggedinUser = $CI->session->userdata('user');
        $role = $loggedinUser[0]['role'];
        if($role > 0)
        {
            $permission = $CI->db->select('*')
            ->where('id',$role)
            ->where('status',1)
            ->get('role')
            ->row();

            $module = $CI->db->select('*')
            ->where('permalink',$moduleParam)
            ->get('modules')
            ->row();
        }
        if($module->permission == 'ALL')
        {
            return true;
        }elseif($module->permission == 'ADMIN')
        {
            
            if($module->permission == $loggedinUser[0]['user_type'])
            {
                return true;
            }
            else
            {
                return false;
            }
        }else{
            $userPermission = json_decode($permission->permission,true);
            if(is_array($userPermission) && count($userPermission)>0)
            {
                foreach($userPermission as $k=>$v)
                {
                    if(is_array($v['inner']) && count($v['inner'])>0)
                    {
                        foreach($v['inner'] as $innerk=>$innerv)
                        {
                            $userPermission[$innerk] = $innerv;
                        }
                    }
                }
                foreach($userPermission as $key=>$val)
                {
                    $permalink = $val['permalink'];
                    if($key == $moduleParam && 
                        (
                            $val['checked'] == 'on' && 
                            (
                                (
                                    $individualPermission == 'all' && (
                                        $val['add'] == 'on' || 
                                        $val['edit'] == 'on' ||
                                        $val['delete'] == 'on' ||
                                        $val['list'] == 'on'
                                    )
                                ) ||
                                (
                                    $val[$individualPermission] == 'on'
                                )
                            )
                        )
                    )
                    {
                        return true;
                        break;
                    }
                }
            }
            
        }
        return false;
    }
}

if ( ! function_exists('admin_menu'))
{
    function admin_menu()
    {
        $CI =& get_instance();
        $loggedinUser = $CI->session->userdata('user');
        // print '<pre>';
        // print_r($loggedinUser);
        // user_type
        // die;
        $role = $loggedinUser[0]['role'];
        
        if($role > 0)
        {
            $permission = $CI->db->select('*')
            ->where('id',$role)
            ->where('status',1)
            ->get('role')
            ->row();
            $permissionArr = json_decode($permission->permission,true);

            $module = $CI->db->select('*')
            // ->order_by('sort','asc')
            ->get('modules')
            ->result_array();
        }
        // print '<pre>';
        // print_r($module);

        if(is_array($module) && count($module)>0)
        {
            foreach($module as $val)
            {
                $moduleArrDb[$val['module_id']] = $val;
            }

            foreach($moduleArrDb as $k=>$v)
            {
                if($v['parent_module'] == 0)
                {
                    $moduleFinal[$k] = $v;
                }
                elseif($v['parent_module'] > 0)
                {
                    $parentModule = $moduleArrDb[$v['parent_module']];
                    $inner[$parentModule['module_id']][] = $v;
                    
                    $moduleFinal[$parentModule['module_id']]['inner'][] = $v;
                }
            }

            // print '<pre>';
            // print_r($moduleFinal);die;

            foreach($moduleFinal as $k=>$v)
            {
                if($v['permission'] == 'REQUIRE')
                    {
                        if(is_array($moduleFinal[$k]['inner']) && count($moduleFinal[$k]['inner'])>0)
                        {
                            $innerlink = false;
                            foreach($moduleFinal[$k]['inner'] as $kk=>$inner)
                            {
                                if(is_array($permissionArr[$v['permalink']]['inner'][$inner['permalink']]) && (
                                    $permissionArr[$v['permalink']]['inner'][$inner['permalink']]['checked'] == 'on' && 
                                    ($permissionArr[$v['permalink']]['inner'][$inner['permalink']]['add'] == 'on' ||
                                    $permissionArr[$v['permalink']]['inner'][$inner['permalink']]['edit'] == 'on' ||
                                    $permissionArr[$v['permalink']]['inner'][$inner['permalink']]['delete'] == 'on' ||
                                    $permissionArr[$v['permalink']]['inner'][$inner['permalink']]['list'] == 'on')
                                    ))
                                    {
                                        $innerlink = true;
                                    }else{
                                        unset($moduleFinal[$k]['inner'][$kk]);
                                    }
                            }
                            if($innerlink == false)
                            {
                                unset($moduleFinal[$k]);
                            }
                        }else{
                            if(is_array($permissionArr[$v['permalink']]) && (
                            $permissionArr[$v['permalink']]['checked'] == 'on' && 
                            ($permissionArr[$v['permalink']]['add'] == 'on' ||
                            $permissionArr[$v['permalink']]['edit'] == 'on' ||
                            $permissionArr[$v['permalink']]['delete'] == 'on' ||
                            $permissionArr[$v['permalink']]['list'] == 'on')
                            ))
                            {
                            }else{
                                unset($moduleFinal[$k]);
                            }
                        }
                        
                    }
                    elseif($v['permission'] == 'ADMIN')
                    {
                        if($loggedinUser[0]['user_type'] != $v['permission'])
                        {
                            unset($moduleFinal[$k]);
                        }
                    }
            }

        }
        //print '<pre>';
        //print_r($moduleFinal);
        
        
        //print_r($permissionArr);
       // die;
        return $moduleFinal;
    }
}

if ( ! function_exists('chk_user_permission'))
{

    function chk_user_permission($area,$section = [])
    {
        //echo $area; print_r($section);die;
        $userPermission = [];
        $CI =& get_instance();
        if(is_array($section) && count($section)>0)
        {
           
            foreach($section as $val)
            {
                $userPermission[$val] = module_permissions($area,$val);
            }
        }
        return $userPermission;

        /* if(!module_permissions($area, $section))
        {
            $CI->session->set_flashdata('error', BLOCK_SECTION_MSG);
            redirect(base_url().'admin/dashboard');
        }else{
            if(is_array($section) && count($section)>0)
            {
                print_r($section);
                foreach($section as $val)
                {
                    $userPermission[$val] = module_permissions($area,$val);
                }
            }
            return $userPermission;
        } */
    }
}

if(!function_exists('site_title')){
    function site_title(){
        $CI = &get_instance();
        $CI->db->select('site_title');
        $CI->db->from("site_settings");
        $getQuery = $CI->db->get();
        $row = $getQuery->row_array();

        return $row['site_title'];
    }
}
if(!function_exists('site_settings_data')){
    function site_settings_data($value){
        $CI = &get_instance();
        $CI->db->select($value);
        $CI->db->from("site_settings");
        $getQuery = $CI->db->get();
        $row = $getQuery->row_array();
        return $row[$value];
    }
}
if(!function_exists('service')){
    function service(){
        $CI = &get_instance();
        $CI->db->select('service_title,service_slug');
        $CI->db->where('show_other_Service','no');
        $CI->db->from("service");
        $getQuery = $CI->db->get();
        $row = $getQuery->result_array();
        return $row;
    }
}

if(!function_exists('suburb_datas')){
    function suburb_datas($categoryId){
        $CI = &get_instance();
        $CI->db->select('S.*,SC.suburb_title,SC.suburb_slug');
        $CI->db->from('locations AS S');
        $CI->db->join('suburb SC', 'S.suburb = SC.suburb_id', 'LEFT');
        $CI->db->where('S.suburb', $categoryId);
        $CI->db->order_by('S.suburb','desc');
        $getQuery = $CI->db->get();
        $row = $getQuery->result_array();
        return $row;
    }
}

if(!function_exists('other_service')){
    function other_service(){
        $CI = &get_instance();
        $CI->db->select('service_title,service_slug');
        $CI->db->where('show_other_Service','yes');
        $CI->db->from("service");
        $getQuery = $CI->db->get();
        $row = $getQuery->result_array();
        return $row;
    }
}
if(!function_exists('suburb_category_data')){
    function suburb_category_data(){
        $CI = &get_instance();
        // $CI->db->select('category_title,categoryId');
        $CI->db->from("suburb");
        $getQuery = $CI->db->get();
        $row = $getQuery->result_array();
        return $row;
    }
}



if( ! function_exists('adminPaginationCompress'))
{
    function adminPaginationCompress($link, $count, $perPage = 10, $segment = 4)
    {
        $CI = &get_instance();
        $CI->load->library('pagination');
        $config['base_url'] = base_url() . $link;
        $config['total_rows'] = $count;
        $config['uri_segment'] = $segment;
        $config['per_page'] = $perPage;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="arrow">';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
        $config['prev_tag_open'] = '<li class="arrow">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-arrow-right"></i>';
        $config['next_tag_open'] = '<li class="arrow">';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="arrow">';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</li>';

        $CI->pagination->initialize($config);
        $limit = $perPage;
        $segment = ($CI->uri->segment($segment)) ? ($CI->uri->segment($segment) - 1) : $CI->uri->segment($segment);
        $offset = $perPage * $segment;
        return array(
            "limit" => $limit,
            "offset" => $offset
        );
    }
}

if(!function_exists('pre')) {
    function pre($param){
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }
}

if(!function_exists('prepare_email_template_body')){
    function prepare_email_template_body($mailbody)
    {
        $CI = &get_instance();

        $CI->db->select('site_title');
        $CI->db->from("site_settings");
        // $CI->db->where('entity', 'system_title');
        $getQuery1 = $CI->db->get()->row_array();

        $CI->db->select('address');
        $CI->db->from("site_settings");
        // $CI->db->where('entity', 'site_address');
        $getQuery2 = $CI->db->get()->row_array();

        $CI->db->select('logo_image');
        $CI->db->from("site_settings");
        // $CI->db->where('entity', 'site_address');
        $getQuery3 = $CI->db->get()->row_array();

        $template_html = '<html><body style="margin: 0; padding-top: 10px; padding-bottom: 10px; padding-left: 0; padding-right: 0; -webkit-text-size-adjust: 100%;background-color: #f2f4f6; color: #ffffff"><table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600"><tbody><tr><td style="width: 596px; vertical-align: top; padding-left: 0; padding-right: 0; padding-top: 15px; padding-bottom: 15px;" width="596"><img style="width: 180px; height: 100px; max-height: 255px; text-align: center; color: #ffffff;" alt="Logo" src="'.SITE_URL.'/uploads/sitesettings_image/'.$getQuery3['logo_image'].'" align="center"></td></tr></tbody></table>'.$mailbody.'<table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600"> <tbody><tr><td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 40px;" width="596"><p style="font-size: 13px; line-height: 24px; font-weight: 400; text-decoration: none; color: #000000;">'.$getQuery2['address'].'<br />'.$getQuery1['site_title'].'</p><p style="margin-bottom: 0; font-size: 13px; line-height: 24px; font-weight: 400; text-decoration: none; color: #ffffff;"><a target="_blank" style="text-decoration: underline; color: #5d6d00;" href="'.SITE_URL.'">'.SITE_URL.'</a></p></td></tr></tbody></table></body></html>';
        return $template_html;
    }
}
