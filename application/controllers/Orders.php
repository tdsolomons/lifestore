<?php
class Orders extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
        }

        public function MyPurchases(){
                $data['title'] = 'My Purchases';
                $userId = $_SESSION['user_id'];

                $this->load->model('order_model');
                $data['orders'] = $this->order_model->getUserPurchasedOrders($userId);
                
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('my_purchases_view', $data);
                $this->load->view('templates/footer');
        }

        
}