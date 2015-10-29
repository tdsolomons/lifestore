
<?php

class MyOrders extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	}
	
	
	public function index() {

/*
        $array = $this->session->all_userdata();
        $username = $array['username'];
        echo $username;
*/
        $username = 1;
        $this->load->model('OrderModel');
        $query['result'] = $this->OrderModel->getDetails($username);

        $this->load->view('orderView', $query);
    }

    
	
	public function updateReceievedStatus() {

        $orderID = $_GET['id'];
        $this->load->model('OrderModel');
        $result = $this->OrderModel->updateReceivedSt($orderID);


        //$this->load->view('orderView');
        //if ($result == true) {
            redirect('myOrders');
        //}
//        else{
//            redirect('login');
//        }
    }
    
    
	
	public function orderDetails() {
        
        $orderID = $_GET['id'];
        $this->load->model('OrderModel');
        $record['resultRecord'] = $this->OrderModel->getRecord($orderID);
        $this->load->view('orderDetailsView', $record);
        
    }
}

?>