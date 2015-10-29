<?php

	class Re_order extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			session_start();
		}
		
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
		
		public function re_order_required(){
			
				//$username = $_SESSION['username'];
				$item_id = $_GET['id'];
				$this->load->model('Re_order_model');
				$re_order_required['re_order_required'] = $this->Re_order_model->re_order_generate($item_id);
				$data['title'] = 'Re Order Mail To';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('Re_order_view', $re_order_required);
				$this->load->view('templates/footer', $data);
			
			
		}
		
		        public function re_order_validate() {
			
                $this->load->library('form_validation');
                $this->form_validation->set_rules('item_id', 'Item Id', 'trim|required');
                $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|alpha');
                $this->form_validation->set_rules('category_name', 'Item Sub Category', 'trim|required|alpha');
                $this->form_validation->set_rules('requirement', 'Required amount', 'trim|required|numeric');
                $this->form_validation->set_rules('supplier_name', 'Supplier', 'trim|required|alpha');
                $this->form_validation->set_rules('supplier_email', 'Email', 'trim|required|valid_email');

                if ($this->form_validation->run() == false) {//didn't validate
                    $this->re_order_required();
                } else {
                    $this->load->model('Re_order_model');

                    if ($this->Re_order_model->send_mail($username)) {

						$this->load->helper('url');
                        redirect('Re_order/re_order_required');
						
						
                    } else {
                        $this->load->view('Re_order_view');
                    }
                }
            }
		
	
	}

?>