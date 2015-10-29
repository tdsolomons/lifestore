<?php

class UserAccount extends CI_Controller {
	
	
	
 function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','array'));
		session_start();
	}
 
 
 
 public function index()
 	{
 		//load user's items table
		
		if(isset($_SESSION['buttonId']))
			unset($_SESSION['buttonId']);
		
		if(isset($_SESSION['item_id']))
		 	unset($_SESSION['item_id']);	
		
		$userId=$_SESSION['user_id'];
       
	   
	    $this->load->model('Upload_model');
		
		//get all items
		$data['query'] = $this->Upload_model->getListings($userId);
		
		//get selling summary
		$data['orderedItems'] = $this->Upload_model->getOrderedItems($userId);
		$data['deliveredItems'] = $this->Upload_model->getDeliveredItems($userId);
		$data['returnedItems'] = $this->Upload_model->getReturnedItems($userId);
		$data['completedOrders'] = $this->Upload_model->getCompletedOrders($userId);
		
		//get offers
		$this->load->model('Offers_model');
		$data['offers'] = $this->Offers_model->getOffers($userId);
		$data['offers_accepted'] = $this->Offers_model->getOffersAC($userId);
		$data['offers_rejected'] = $this->Offers_model->getOffersRJ($userId);
		
		//get deals
		$this->load->model('Deals_model_seller');
		$data['deals'] = $this->Deals_model_seller->getDeals($userId);
		
		//get ref requests
		$this->load->model('Refund_model');
		$data['ref_requests_open'] = $this->Refund_model->get_requests_open($userId);
		$data['ref_requests_closed'] = $this->Refund_model->get_requests_closed($userId);
		
		//load page
		$this->load->view('templates/header');
		$this->load->view('templates/search_box');
		$this->load->view('selling_home_view',$data);
 	    $this->load->view('templates/footer');
	
	}
	


	
 public function sell()
 	{
	$this->load->view('templates/header');
	$this->load->view('templates/search_box');
	$this->load->model('Search_model');
    $this->load->view('item_type_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
      $this->load->view('templates/footer');
 	}
        
   
 public function fixed()
 	{
	$this->load->view('templates/header');
	$this->load->view('templates/search_box');
	$this->load->model('Search_model');
    $this->load->view('addItem_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
 	$this->load->view('templates/footer');
 	}
	
	public function auction()
 	{
	$this->load->view('templates/header');
	$this->load->view('templates/search_box');
	$this->load->model('Search_model');
    $this->load->view('addAuctionItem1_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->	Search_model->getConditionsTypes()));
 	$this->load->view('templates/footer');
 	}
	
	
	 
public function dispatch(){
	$orderId=$this->input->get('order');
	$this->load->model('Upload_model');
	$this->Upload_model->dispatchOrder($orderId);
	$this->sendMail($orderId);
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
	
 

public function sendMail($orderId){
	$this->load->model('Upload_model');
	$array=$this->Upload_model->getOrderDetails($orderId);
	$title=element('title',$array);
	$email=element('email',$array);
	$itemId=element('itemId',$array);
  
	mail($email, "LifeStore.lk :Item(".$itemId.") Dispatched", "Your ordered item:".$title." has been dispatched by the seller", "From: iahsp4@gmail.com");
	
}
 
//load the item update page
public function updateItem(){
	$itemId=$this->input->get('item');
	$_SESSION['item_id']=$itemId;
	$this->load->model('Upload_model');
	
	$isFixed=$this->Upload_model->isFixed($itemId);
	
	if($isFixed==1){
	  $array=$this->Upload_model->getItemDetails($itemId);
	  $this->load->model('Search_model');
	  $array['categories']=$this->Search_model->getAllCategories();
	  $array['conditions']=$this->Search_model->getConditionsTypes();
	  $this->load->view('templates/header');
	  $this->load->view('templates/search_box');
	  $this->load->view('updateItem_view',$array);
	  $this->load->view('templates/footer');
	}
	
	else{
	  $array=$this->Upload_model->getAuctionItemDetails($itemId);
	  $this->load->model('Search_model');
	  $array['categories']=$this->Search_model->getAllCategories();
	  $array['conditions']=$this->Search_model->getConditionsTypes();
	  $this->load->view('templates/header');
	  $this->load->view('templates/search_box');
	  $this->load->view('updateAuctionItem_view',$array);
	  $this->load->view('templates/footer');
	}
   
}
     
	 
	 
public function buyerRatings(){
	$this->load->model('Upload_model');
	$orderId=$_POST['widget_id'];
	
	if(isset($_POST['fetch'])) 
		$array=$this->Upload_model->getOrderVotes($orderId);
    else{
		preg_match('/star_([1-5]{1})/', $_POST['clicked_on'], $match);
        $rating = $match[1];
		$success=$this->Upload_model->setOrderVotes($orderId,$rating);
		if($success)
		$array=$this->Upload_model->getOrderVotes($orderId);
	}
	
	echo json_encode($array);
}     
     

public function verifyUpload(){
if(isset($itemId)){	
	
 $itemId=$_SESSION['item_id'];
 $this->load->model('Upload_model');
 $verified=$this->Upload_model->checkImages($itemId);
 if($verified)
 	$this->index();
 else{
  $test=array('testValue'=>"");
  $this->load->view('templates/header');
  $this->load->view('templates/search_box');
  $this->load->view('addImage_view',$test);
  $this->load->view('templates/footer');  
 }
}

else 
 $this->index();

}

public function accept_offer(){
	$offer_id=$this->input->get('offer_id');
	$this->load->model('Offers_model');
	$accepted = $this->Offers_model->accept_offer($offer_id);
	if($accepted){
	 $mailsend = $this->Offers_model->email($offer_id);
	 $this->index();
	}
	else
	 $this->index();
}

public function reject_offer(){
	$offer_id=$this->input->get('offer_id');
	$this->load->model('Offers_model');
	$rejected = $this->Offers_model->reject_offer($offer_id);
	if($rejected)
	 $this->index();
	else
	 $this->index();
}


public function remove_deal(){
	$deal_id=$this->input->get('deal_id');
	$this->load->model('Deal_model_seller');
	$removed = $this->Deal_model_seller->remove_deal($deal_id);
	if($removed)
	 $this->index();
	else
	 $this->index();
}


public function manage_deal(){
	$deal_id=$this->input->get('deal_id');
	$this->load->model('Deal_model_seller');
	$data['deal'] = $this->Deal_model_seller->get_deal($deal_id);
	$this->load->view('templates/header');
	$this->load->view('templates/search_box');
	$this->load->view('manage_deal_view',$data);
	$this->load->view('templates/footer');
}




}

	
	







?>