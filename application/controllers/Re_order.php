<?php

/*
====================================================

File name	: Re_order.php
Version		: 1.0
Begin		: 2015-09-29
Last Update	: 2015-10-05
Authour		: Sachinika Deemansa

----------------------------------------------------

This file is part of LifeStore Controllers

====================================================
*/

	class Re_order extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			session_start();
		}
		
		/*this method is to load the re order requirement list in order to decide whtetehr to re order or not */
		  public function index() {
		
		       	//$username = $_SESSION['username'];
				$this->load->model('Re_order_model');
				$re_order['re_order'] = $this->Re_order_model->re_order_list();
				$data['title'] = 'Re Order Requiements';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('Re_order_table', $re_order);
				$this->load->view('templates/footer', $data);
            }
		
		/*this method is to view the detailed wiew of the selected item that needs to be re ordered */
		public function re_order_required(){
			
				//$username = $_SESSION['username'];
				$item_id = $_GET['id'];
				$this->load->model('Re_order_model');
				$re_order_required['re_order_required'] = $this->Re_order_model->re_order_generate($item_id);
				$re_order_required['re_order_suppliers'] = $this->Re_order_model->re_order_suppliers($item_id);
				$data['title'] = 'Re Order Mail To';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('Re_order_view', $re_order_required);
				$this->load->view('templates/footer', $data);
			
			
		}
		
		/*this method is to validate the message form details and to send the email */
		        public function re_order_validate() {
			
				$item_id = $_GET['id'];
                $this->load->library('form_validation');
                $this->form_validation->set_rules('item_id', 'Item Id', 'trim|required');
                $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
                $this->form_validation->set_rules('category_name', 'Item Sub Category', 'trim|required');
                $this->form_validation->set_rules('requirement', 'Required amount', 'trim|required|numeric');
                $this->form_validation->set_rules('supplier_name', 'Supplier', 'trim|required');
                $this->form_validation->set_rules('supplier_email', 'Email', 'trim|required|valid_email');

                if ($this->form_validation->run() == false) {//didn't validate
                    $this->re_order_required();
                } else {
                    $this->load->model('Re_order_model');

					$mail_sent = $this->Re_order_model->send_mail($item_id);
                    
					if ($mail_sent) {

						$this->load->helper('url');
                        $this->index();
					   //echo 'email sent';
						
                    } else {
                        $this->load->view('Re_order_view');
                    }
                }
            }
		
	
	}

?>