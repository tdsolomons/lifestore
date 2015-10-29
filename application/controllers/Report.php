<?php
class Report extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }
		
		public function index() {
		  
		  
		  //$this->load->model('Report_model');
		 
		  $this->load->view('templates/header');
		  $this->load->view('templates/search_box');
		  $this->load->view('generate_report_view');
		  $this->load->view('templates/footer');
		  
	   }
	   
	   
	   function generate_report()
	   {
		  $this->load->helper('pdf_helper');
		  $this->load->model('Reports_model');
		  
		  
		  
		  $item_type=$this->input->post('optradio');
		  $time = $this->input->post('time');
		  $report_type=$this->input->post('optradio2');
		  $seller = $_SESSION['user_id'];
		 
		  if($report_type==1){	
			$data['sales_report'] = $this->Reports_model->get_sales_report($item_type,$time,$user);
		  }
		  else{
			$data['purchase_report'] = $this->Reports_model->get_purchase_report($item_type,$time,$user);
		  }
		  
		  $data['title'] = 'Sales Report';
		  $this->load->view('pdfreport', $data);
	   }
	   
}
?>