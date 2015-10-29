<?php
class Messages extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                 
        }

        public function Messages(){
                $data['title'] = 'Messages';
                $this->load->model('message_model');
                //TODO::Get logged in user Id From Session
                $userId = '1';
                
                $data['messages'] = $this->message_model->listAllMessages($userId);
                
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('messages_view', $data);
                $this->load->view('templates/footer');
        }

        public function SendForm(){
                $toUserUsername = $this->input->get('to');
                $itemId = $this->input->get('item');
                $data['to_user_username'] = $toUserUsername;
                
                $this->load->model('item_model');
                $data['item'] = $this->item_model->item($itemId);

                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('send_messages_view', $data);
                $this->load->view('templates/footer');
        }

        public function Send(){

        }
}