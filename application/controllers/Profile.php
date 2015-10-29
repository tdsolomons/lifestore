<?php
class Profile extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                 
        }

        public function Seller(){
                $data['title'] = 'Seller Profile';
                $sellerId = $this->input->get('seller');

                $this->load->model('feedback_model');
                $data['seller_feedback'] = $this->feedback_model->getSellerRating($sellerId);
                $data['list_of_feedbacks'] = $this->feedback_model->getSellerFeedbacks($sellerId);
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('seller_profile_view', $data);
                $this->load->view('templates/footer');
        }

        public function Buyer(){
                $data['title'] = 'Buyer Profile';
                $buyerId = $this->input->get('buyer');

                $this->load->model('feedback_model');
                $data['buyer_feedback'] = $this->feedback_model->getBuyerRating($buyerId);
                $data['list_of_feedbacks'] = $this->feedback_model->getBuyerFeedbacks($buyerId);
                                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('buyer_profile_view', $data);
                $this->load->view('templates/footer');
        }
}