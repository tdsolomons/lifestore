<?php

class MyOrders extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
		session_start();
	}
	
	
	public function index() {

        $username = $_SESSION['username'];
		$user_id = $_SESSION['user_id'];
        $this->load->model('Order_model_s');
        $query['result'] = $this->Order_model_s->getDetails($username);
		$this->load->model('Order_model_s');
        $query['auctionRecord'] = $this->Order_model_s->getAuctionDetails($username);
		$query['my_followers'] = $this->Order_model_s->get_my_followers($user_id);
		$query['i_follow'] = $this->Order_model_s->who_i_follow($user_id);
		
  		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
		$this->load->model('search_model');
		$data['categories'] = $this->search_model->getAllCategories();
        $this->load->view('orderView', $query);
		$this->load->view('templates/footer');

	}
	
	public function updateReceievedStatus() {

        $orderID = $_GET['id'];
        $this->load->model('Order_model_s');
        $result = $this->Order_model_s->updateReceivedSt($orderID);
		$username = $_SESSION['username'];
		$query['result'] = $this->Order_model_s->getDetails($username);
		
		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
		$this->load->model('search_model');
		$data['categories'] = $this->search_model->getAllCategories();
        $this->load->view('orderView', $query);
        //if ($result == true) {
           // redirect('MyOrders');
        //}
		//        else{
		//            redirect('login');
		//        }
    }
    
	public function orderDetails() {
        
        $orderID = $_GET['id'];
        $this->load->model('Order_model_s');
        $record['resultRecord'] = $this->Order_model_s->getRecord($orderID);
		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
		$this->load->model('search_model');
		$data['categories'] = $this->search_model->getAllCategories();
        $this->load->view('orderDetailsView', $record);
        
    }
	
	    public function viewItemDetails() {

        $itemID = $_GET['id'];
		$this->load->model('Admin_model');
        $record['itemRecord'] = $this->Admin_model->getUserRecord($itemID);
		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
		$this->load->model('search_model');
		$data['categories'] = $this->search_model->getAllCategories();
        $this->load->view('sellerItemDetailsView', $record);
		
     }


		public function feedback() {
        
        $data['title'] = 'Leave feedback';
		$orderID = $this->input->get('id');
        $data['orderId'] = $orderID;
		$this->load->model('Order_model_s');
		$itemId = $this->Order_model_s->getItem($orderID);
		$this->load->model('item_model');
		$data['items'] = $this->item_model->item($itemId);
		$data['toUserUsername'] = $this->Order_model_s->getSeller($orderID);
		
		        $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('feedback_buyer_form_view', $data);
                $this->load->view('templates/footer');
		
    }
	
	 public function auctionItemWon() {

        $userID = $_GET['id'];
		$this->load->model('Order_model_s');
        $record['auctionRecord'] = $this->Order_model_s->getAuctionDetails($userID);
		$data['title'] = 'Home';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
        $this->load->view('wonAuctionView', $record);
		$this->load->view('templates/footer');
		
     }
	 
	 
	 
	 public function refund_req() {

        $orderID = $_GET['id'];
		$this->load->model('Order_model_s');
        $data['item'] = $this->Order_model_s->getOrderDetails($orderID);
		$data['messages'] = $this->Order_model_s->getRefundMessages($orderID);
		$data['title'] = 'Refund Request';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/search_box');
        $this->load->view('request_refund_view', $data);
		$this->load->view('templates/footer');
		
     }
}
?>