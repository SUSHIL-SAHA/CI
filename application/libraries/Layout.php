<?php

class Layout {

    private $CI;
    private $layout_title = NULL;
    private $layout_description = NULL;
    private $data;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function set_title($title) {
        $this->layout_title = $title;
    }

    public function set_description($description) {
        $this->layout_description = $description;
    }

    public function set_assest($params) {
        $this->data = $params;
    }

    public function view($view_name, $layouts = array(), $params = array(), $default = true) {
        if (is_array($layouts) && count($layouts) >= 1) {
            foreach ($layouts as $layout_key => $layout) {
                $params[$layout_key] = $this->CI->load->view($layout, $params, true);
            }
        }
        if ($default) {
            
            $this->CI->load->view('admin/inc/header', $params);
            $this->CI->load->view($view_name, $params);
            $this->CI->load->view('admin/inc/footer');
			
        } else {
			//echo "run1";exit;
            //$this->data['logo'] = $this->CI->auto_model->getFeild("site_logo", "setting", "id='45'");
            //$this->CI->load->view('inc/scriptsrc');
			$this->CI->load->view($view_name, $params);

        }
    }
    
    public function show($view_name, $layouts = array(), $params = array(), $default = true) {
        if (is_array($layouts) && count($layouts) >= 1) {
            foreach ($layouts as $layout_key => $layout) {
                $params[$layout_key] = $this->CI->load->view($layout, $params, true);
            }
        }
        if ($default) {
            
            $this->CI->load->view('front/inc/header', $params);
            $this->CI->load->view($view_name, $params);
            $this->CI->load->view('front/inc/footer');
			
        } else {
			//echo "run1";exit;
            //$this->data['logo'] = $this->CI->auto_model->getFeild("site_logo", "setting", "id='45'");
            //$this->CI->load->view('inc/scriptsrc');
			$this->CI->load->view($view_name, $params);

        }
    }


    public function template($view_name, $layouts = array(), $params = array(), $default = true) {
        if (is_array($layouts) && count($layouts) >= 1) {
            foreach ($layouts as $layout_key => $layout) {
                $params[$layout_key] = $this->CI->load->view($layout, $params, true);
            }
        }
        if ($default) {
            
            $this->CI->load->view('front/inc/header', $params);
            $this->CI->load->view($view_name, $params);
            $this->CI->load->view('front/inc/footer');
			
        } else {
			//echo "run1";exit;
            //$this->data['logo'] = $this->CI->auto_model->getFeild("site_logo", "setting", "id='45'");
            //$this->CI->load->view('inc/scriptsrc');
			$this->CI->load->view($view_name, $params);

        }
    }

}

?>