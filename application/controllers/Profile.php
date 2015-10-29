<?php
class Profile extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                if (!isset($_SESSION)) {
                        session_start();
                }
        }

        public function Seller(){
                $data['title'] = 'Seller Profile';
                $sellerId = $this->input->get('seller');
                

                $this->load->model('feedback_model');
                $this->load->model('profile_model');

                $data['sellerId'] = $sellerId;
                if (isset($_SESSION['user_id'])) {
                        $buyerId = $_SESSION['user_id'];
                        $data['isFollowing'] = $this->profile_model->getFollowStatus($sellerId, $buyerId);
                }

                $data['followersCount'] = $this->profile_model->getFollowersCount($sellerId);
                $data['seller_feedback'] = $this->feedback_model->getSellerRating($sellerId);
                $data['list_of_feedbacks'] = $this->feedback_model->getSellerFeedbacks($sellerId);
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('seller_profile_view', $data);
                $this->load->view('templates/footer');
        }

        public function FollowSeller(){
                $sellerId = $this->input->get('seller');
                $buyerId = $_SESSION['user_id'];

                $this->load->model('profile_model');

                $this->profile_model->followSeller($sellerId, $buyerId);
                $this->load->helper('url');
                redirect('/Profile/Seller?seller=' . $sellerId, 'refresh');
        }

        public function UnfollowSeller(){
                $sellerId = $this->input->get('seller');
                $buyerId = $_SESSION['user_id'];

                $this->load->model('profile_model');

                $this->profile_model->unfollowSeller($sellerId, $buyerId);
                $this->load->helper('url');
                redirect('/Profile/Seller?seller=' . $sellerId, 'refresh');
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