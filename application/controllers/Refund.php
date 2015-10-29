<?php
class Refund extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }
		
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
	   function pdf()
		{
    $this->load->helper('pdf_helper');
    /*
        ---- ---- ---- ----
        your code here
        ---- ---- ---- ----
    */
    $this->load->view('pdfreport');
	}
	   
	   
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
	   
	   public function admin_view_load() {
		  $this->load->model('Refund_model');
		  $data['ref_requests_open'] = $this->Refund_model->get_req_admin_open();
		  $data['ref_requests_closed'] = $this->Refund_model->get_req_admin_closed();
		  
		  $data['title'] = 'Refund Request';
		  $this->load->view('templates/adminHeader', $data);
		  $this->load->view('admin_user_support_view', $data);
		  $this->load->view('templates/footer');
		  
	   }
	   
	    public function set_request() {
		  $content = addslashes($this->input->post('content'));
		  $receiver = $this->input->post('receiver');
		  $order_id = $this->input->post('order_id');
		  $sender = $_SESSION['user_id'];
		  //$req_id = $_SESSION['refund_req_id'];
		  

		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_request($sender,$receiver,$content,$order_id);
		  $this->load->helper('url');
          //$_SESSION['refund_req_id'];
		  redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	   
	   
	   
	   public function reply() {
		  $content = addslashes($this->input->post('content'));
		  $receiver = $this->input->post('receiver');
		  $order_id = $this->input->post('order_id');
		  $sender = $_SESSION['user_id'];
		  $req_id = $_SESSION['refund_req_id'];
		  

		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->send_reply($sender,$receiver,$content,$req_id);
		  $this->load->helper('url');
          $_SESSION['refund_req_id'];
		  redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	   
	   
	    public function set_request_close() {
		  $req_id = $this->input->get('id');
		  $order_id = $this->input->get('order');
		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_request_close($req_id);
		  $this->load->helper('url');
          redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
	   
	   public function set_admin_status() {
		  $req_id = $this->input->get('id');
		  $order_id = $this->input->get('order');
		  $status =  $this->input->get('status');
		  $this->load->model('Refund_model');
		  $reply_sent = $this->Refund_model->set_admin_status($req_id,$status);
		  $this->load->helper('url');
          redirect('/Refund/refund_req?id='.$order_id, 'refresh');
		  
	   }
}

?>