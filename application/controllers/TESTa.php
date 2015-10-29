<?php

class TESTa extends CI_Controller {
	
	
	
 function __construct()
	{
		parent::__construct();
		
	}
 
 
 
 public function index()
 	{
 		
		//load page
		/*
		$this->load->model('Search_model');
    $this->load->view('index',array('categories'=>$this->Search_model->getAllCategories()));
	*/
	
	$this->load->view('templates/header2');
	$this->load->view('templates/search_box');
	$this->load->view('imageBanner');
	$this->load->view('templates/footer2');
		
 	}
	


	

        
        

	
 


 
	
     
     
     
  
 }

	
	







?>