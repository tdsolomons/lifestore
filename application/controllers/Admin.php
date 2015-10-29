<?php

	class Admin extends CI_Controller {
			
			
    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
		session_start();
	}
	
            public function index() {

				//$username = $_SESSION[username];
                $this->load->model('Admin_model');
                $user_list['users'] = $this->Admin_model->getUserList();
                $user_list['items'] = $this->Admin_model->getItemsListLimit();
				$this->load->view('templates/adminHeader');
				$this->load->view('adminView', $user_list);
			    $this->load->view('templates/footer');
            }

            public function viewItemDetails() {

                $item_id = $_GET['id'];
                $this->load->model('Admin_model');
                $record['itemRecord'] = $this->Admin_model->getItemRecord($item_id);
				$this->load->view('templates/adminHeader');
                $this->load->view('itemDetailsView', $record);
				$this->load->view('templates/footer');
            }

            public function getUsersListFull() {

                $this->load->model('Admin_model');
                $userList['users'] = $this->Admin_model->getUserList();
				$this->load->view('templates/adminHeader');
                $this->load->view('userTableView', $userList);
				$this->load->view('templates/footer');
            }

            public function getItemsListFull() {

                $this->load->model('Admin_model');
                $itemList['items'] = $this->Admin_model->getItemsList();
				$this->load->view('templates/adminHeader');
                $this->load->view('itemTableView', $itemList);
			    $this->load->view('templates/footer');
            }

            public function changeItemStatus() {

                $itemID = $_GET['id'];
                $this->load->model('Admin_model');
                $result = $this->Admin_model->removeItemRequest($itemID);
                $itemList['items'] = $this->Admin_model->getItemsList();
				$this->load->view('templates/adminHeader');
                $this->load->view('itemTableView', $itemList);
			    $this->load->view('templates/footer');
				
            }

            public function changeUserDeactivate() {

                $uname = $_GET['uname'];
                $this->load->model('Admin_model');
                $result = $this->Admin_model->deactivateUser($uname);
                $userList['users'] = $this->Admin_model->getUserList();
				$this->load->view('templates/adminHeader');
                $this->load->view('userTableView', $userList);
			    $this->load->view('templates/footer');
				
            }
			
			public function changeUserActivate() {

                $uname = $_GET['uname'];
                $this->load->model('Admin_model');
                $result = $this->Admin_model->activateUser($uname);
                $userList['users'] = $this->Admin_model->getUserList();
				$this->load->view('templates/adminHeader');
                $this->load->view('userTableView', $userList);
			    $this->load->view('templates/footer');
				
            }

            public function viewProfile() {

                $uname = $_GET['uname'];
                $this->load->model('Order_model_s');
                $query['result'] = $this->Order_model_s->getDetails($uname);
                $query['sales'] = $this->Order_model_s->getSales($uname);
				$this->load->view('templates/adminHeader');
                $this->load->view('userProfileView', $query);
			    $this->load->view('templates/footer');
            }

            public function orderDetails() {

                $orderID = $_GET['id'];
                $this->load->model('Order_model_s');
                $record['resultRecord'] = $this->Order_model_s->getRecord($orderID);
				$this->load->view('templates/adminHeader');
                $this->load->view('orderDetailsAdminView', $record);
			    $this->load->view('templates/footer');
            }
			
	
        }
		
        ?>