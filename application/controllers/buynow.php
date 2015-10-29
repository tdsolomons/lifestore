<?php
class Buynow extends CI_Controller {
	public function __construct()
	{
	         parent::__construct();
	         session_start();
	         $this->load->helper('url');
	        
	         
	}
	
	public function view_buynow(){
		
		$this->load->view('templates/header');
        $this->load->view('templates/search_box');
        $this->load->view('view_buynow');
        $this->load->view('templates/footer');
		}


}



