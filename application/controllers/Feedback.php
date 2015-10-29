<?php
class Feedback extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
        }

        public function BuyerForm(){
                $data['title'] = 'Leave feedback';
                $userId = $_SESSION['user_id'];
                $orderId = $this->input->get('order');

                $data['orderId'] = $orderId;
                $itemId = $this->input->get('item');
                $this->load->model('item_model');
                $data['items'] = $this->item_model->item($itemId);
                $data['toUserUsername'] = $this->input->get('seller_username');
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('feedback_buyer_form_view', $data);
                $this->load->view('templates/footer');
        }

        public function BuyerPost(){
                $content = addslashes($this->input->post('content'));
                $orderId = $this->input->post('order_id');
                $rating = $this->input->post('rating');
                
                $this->load->model('feedback_model');
                $this->feedback_model->buyerPostFeedback($orderId, $content, $rating);
                $this->load->helper('url');
                redirect('/MyOrders', 'refresh');
        }

        
}