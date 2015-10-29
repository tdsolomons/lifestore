<?php

class UserAccount extends CI_Controller {
	
	
	
 function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		session_start();
	}
 
 
 
 public function index()
 	{
 		//load user's items table
	
		if(isset($_SESSION['buttonId']))
		unset($_SESSION['buttonId']);
		
		if(isset($_SESSION['item_id']))
		unset($_SESSION['item_id']);	
		
		$this->load->library('table');
        $this->load->model('Upload_model');
		$data['query'] = $this->Upload_model->getListings();
		$data['orderedItems'] = $this->Upload_model->getOrderedItems();
		$data['deliveredItems'] = $this->Upload_model->getDeliveredItems();
		$data['returnedItems'] = $this->Upload_model->getReturnedItems();
		$data['completedOrders'] = $this->Upload_model->getCompletedOrders();
		//load page
		$this->load->view('selling_home_view',$data);
 	
	
	}
	


	
 public function sell()
 	{
	
	$this->load->model('Search_model');
    $this->load->view('item_type_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
 
 	}
        
   
 public function fixed()
 	{
	
	$this->load->model('Search_model');
    $this->load->view('addItem_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
 
 	}
	
	public function auction()
 	{
	
	$this->load->model('Search_model');
    $this->load->view('addAuctionItem1_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
 
 	}
	
	
	 
public function dispatch(){
	$orderId=$this->input->get('order');
	$this->load->model('Upload_model');
	$this->Upload_model->dispatchOrder($orderId);
	$this->index();
	
	}
        

public function deliver(){
	$orderId=$this->input->get('order');
	$this->load->model('Upload_model');
	$this->Upload_model->deliverOrder($orderId);
	$this->index();
	
	}

public function returned(){
	$orderId=$this->input->get('order');
	$this->load->model('Upload_model');
	$this->Upload_model->returnedOrder($orderId);
	$this->index();
	
	}
	
 


 
	
     
     
     
  
 }

	
	







?>