<?php
//============================================================
// File name   : Report.php
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
 * @class Report
 * This Class contains the methods which are used to handle the reporrt generating process of the transactions.
 * @author Hasantha Suneth
 */
class Report extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }
		
		
	/**
	 * Load the view to users to generate report as desired.
	 * @author Hasantha Suneth
	 */
		
	   public function index() {
		 
		  $this->load->view('templates/header');
		  $this->load->view('templates/search_box');
		  $this->load->view('generate_report_view');
		  $this->load->view('templates/footer');
		  
	   }
	   
	   
	   
	 /**
	 * Handles the process of generating a report according to the users needs.
	 * @return $data(dataset) Array contain the acquired data and the sum of the Sales 
	 * @author Hasantha Suneth
	 */
	   function generate_report()
	   {
		  $this->load->helper('pdf_helper');
		  $this->load->model('Reports_model');
		  
		  
		  
		  $item_type=$this->input->post('optradio');
		  $time = $this->input->post('time');
		  $report_type=$this->input->post('optradio2');
		  $user = $_SESSION['user_id'];
		 
		  if($report_type==1){	
			$data = $this->Reports_model->get_sales_report($item_type,$time,$user);
		  	//$data['sum'] = $this->Reports_model->get_sales_sum($item_type,$time,$user);
		  }
		  else{
			$data = $this->Reports_model->get_purchase_report($item_type,$time,$user);
		  }
		  
		  $data['title'] = 'Sales Report';
		  $this->load->view('pdfreport', $data);
	   }
	   
}//End of the Class---------------------------------------------------------------------------------------

//End of the File=========================================================================================
?>