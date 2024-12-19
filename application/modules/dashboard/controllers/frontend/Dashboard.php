<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    public function __construct()
	{
         $this->load->model('dashboard_model');
		
        parent::__construct();
		
    }

  public function index() {

	   if(!$this->session->userdata('user'))
		{
			redirect(VPATH."login/");
		}
		else
		{
			$user=$this->session->userdata('user');
			$head['current_page']='dashboard';
			$head['ad_page']='dashboard';
			
			$this->layout->view('dashboard','normal');
		}
	}

  
	

  
	

}

?>

