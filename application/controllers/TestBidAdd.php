<?php

class TestBidAdd extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    public function index() {

      	$this->load->view('templates/header');
	    $this->load->view('aatestBidAddButton');
		$this->load->view('templates/footer');
      
    }
    
	public function addBid(){
		
		$itemID = 1;
		$this->load->model('BidExceed_model');
		$result = $this->BidExceed_model->getBidExceed($itemID);
		$addBid = $this->BidExceed_model->testAddBid($itemID);
      	$this->load->view('templates/header');
	    $this->load->view('aatestBidAddButton');
		$this->load->view('templates/footer');
	}

}

?>