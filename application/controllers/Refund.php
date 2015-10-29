<?php
//============================================================
// File name   : Refund.php
// Version     : 1.0
// Begin       : 2015-10-01
// Last Update : 2015-10-04
// Author      : Hasantha Suneth
// -----------------------------------------------------------
// 
//
// This file is part of Lifestore Controllers
//
// 
//============================================================



/**
 * @class Refund
 * This Class contains the methods which are used to handle the refunding process of the transactions.
 * @author Hasantha Suneth
 */
class Refund extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
        }
		
		
	/**
	 * Load the View for putting a refund request and to contact with the seller.View also gives the optins to contact the
	 * admin.
	 * @return $data Array contain the acquired data of the item which need a refund,messages between seller and buyer and 	 * status of the refund request 
	 * @author Hasantha Suneth
	 */
		public function refund_req() {
		  $orderID = $_GET['id'];
		  if(isset($_GET['seller'])){
			  $data['seller']=1;
		  }
		  $this->load->model('Refund_model');
		  $data['item'] = $this->Refund_model->getOrderDetails($orderID);
		  $data['messages'] = $this->Refund_model->getRefundMessages($orderID);
		  $data['req_details'] = $this->Refund_model->get_request_details($orderID);
		  $data['title'] = 'Refund Request';
		  $this->load->view('templates/header', $data);
		  $this->load->view('templates/search_box');
		  $this->load->view('request_refund_view', $data);
		  $this->load->view('templates/footer');
		  
	   }
	   
	   
	   
	   
	 /**
	 * Load the View for reviewing a refund request and to Administrator.View also gives the optins to contact the
	 * seller and the buyer.
	 * @return $data Array contain the acquired data of the item which need a refund,messages between seller and buyer and 	     * status of the refund request 
	 * @author Hasantha Suneth
	 */
	   public function admin_req() {
		  $orderID = $_GET['id'];
		  if(isset($_GET['seller'])){
			  $data['seller']=1;
		  }
		  $this->load->model('Refund_model');
		  $data['item'] = $this->Refund_model->getOrderDetails($orderID);
		  $data['messages'] = $this->Refund_model->getRefundMessages($orderID);
		  $data['req_details'] = $this->Refund_model->get_request_details($orderID);
		  $data['title'] = 'Refund Request';
		  $this->load->view('templates/adminHeader', $data);
		  $this->load->view('admin_refund_view', $data);
		  $this->load->view('templates/footer');
		  
	   }
	   
	   
	 /**
	 * Load the View for Admin to view all the requests received for review.
	 * @return $data Array contain the acquired data of the open and closed requests
	 * @author Hasantha Suneth
	 */
	   public function admin_view_load() {
		  $this->load->model('Refund_model');
		  $data['ref_requests_open'] = $this->Refund_model->get_req_admin_open();
		  $data['ref_requests_closed'] = $this->Refund_model->get_req_admin_closed();
		  
		  $data['title'] = 'Refund Request';
		  $this->load->view('templates/adminHeader', $data);
		  $this->load->view('admin_user_support_view', $data);
		  $this->load->view('templates/footer');
		  
	   }
	   
	 /**
	 * Handle the process of setting a new refund request 
	 * @param $content(string) Message contents sent to the seller ,setting the request
	 * @param $receiver(int) user id of the seller
	 * @param $order_id(int)id of the order which needs a refund
	 * @param $sender(int)user_id of the buyer 
	 * @author Hasantha Suneth
	 */
	    public function set_request() {
		  $content = addslashes($this->input->post('content'));
		  $receiver = $this->input->post('receiver');
		  $order_id = $this->input->post('order_id');
		  $sender = $_SESSION['user_id'];
		 
		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_request($sender,$receiver,$content,$order_id);
		  $mail_sent= $this->Refund_model->send_mail($receiver);
		  $this->load->helper('url');
         
		  redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	   
	 /**
	 * Handle the process of sending a reply for a refund request 
	 * @param $content(string) Message contents sent to the seller ,setting the request
	 * @param $receiver(int) user id of the receiver of the message
	 * @param $order_id(int)id of the order which needs a refund
	 * @param $sender(int)user_id of the buyer
	 * @param $req_id(int)id of the refund request	 
	 * @author Hasantha Suneth
	 */
	   public function reply() {
		  $content = addslashes($this->input->post('content'));
		  $receiver = $this->input->post('receiver');
		  $order_id = $this->input->post('order_id');
		  $sender = $_SESSION['user_id'];
		  $req_id = $_SESSION['refund_req_id'];
		  

		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->send_reply($sender,$receiver,$content,$req_id);
		  $mail_sent= $this->Refund_model->send_mail($receiver);
		  $this->load->helper('url');
          $_SESSION['refund_req_id'];
		  redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	 
	 
	 
	 
	 
	 /**
	 * Handle the process of setting a  refund request status to close
	 * @param $order_id(int)id of the order which needs a refund
	 * @param $req_id(int)id of the refund request 
	 * @author Hasantha Suneth
	 */
	    
		public function set_request_close() {
		  $req_id = $this->input->get('id');
		  $order_id = $this->input->get('order');
		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_request_close($req_id);
		  $this->load->helper('url');
          redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	   
	 /**
	 * Handle the process of stating a refund request is reviewing by the admin or not.
	 * @param $order_id(int)id of the order which needs a refund
	 * @param $req_id(int)id of the refund request 
	 * @param $status(boolean)status of the admin
	 * @author Hasantha Suneth
	 */ 
	   public function set_admin_status() {
		  $req_id = $this->input->get('id');
		  $order_id = $this->input->get('order');
		  $status =  $this->input->get('status');
		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_admin_status($req_id,$status);
		  $this->load->helper('url');
          redirect('/Refund/refund_req?id='.$order_id, 'refresh');
	   }



}//Endof class-----------------------------------------------------------------------------------------------------


//End of File======================================================================================================
?>