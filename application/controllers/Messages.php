<?php
class Messages extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }

        public function Messages(){
                $data['title'] = 'Messages';
                $this->load->model('message_model');
                //TODO::Get logged in user Id From Session
                $userId = $_SESSION['user_id'];
                
                $data['messages'] = $this->message_model->listAllMessages($userId);
                
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('messages_view', $data);
                $this->load->view('templates/footer');
        }

        public function SendForm(){
                $toUserUsername = $this->input->get('to_user');
                $toUserId = $this->input->get('to');
                $itemId = $this->input->get('item');

                $data['toUserUsername'] = $toUserUsername;
                $data['toUserId'] = $toUserId;
                
                $data['aboutItemId'] = $itemId;

                $this->load->model('message_model');
                if ($this->input->get('msg_id')) {
                        $replyThread = $this->input->get('reply_thread');
                        $data['msgs'] = $this->message_model->getAllMsgsInThread($replyThread);
                        $data['replyThread'] = $replyThread;
                }

                $this->load->model('item_model');
                $data['items'] = $this->item_model->item($itemId);

                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('send_messages_view', $data);
                $this->load->view('templates/footer');
        }

        public function Send(){
                $content = addslashes($this->input->post('content'));
                $aboutItem = $this->input->post('about_item');
                $receiver = $this->input->post('to_user_username');
                $sender = $_SESSION['user_id'];

                $this->load->model('message_model');
                $this->message_model->sendMessage($sender, $receiver, $content, $aboutItem);
                $this->load->helper('url');
                redirect('/messages/messages', 'refresh');

        }

        public function Reply(){
                $content = addslashes($this->input->post('content'));
                $aboutItem = $this->input->post('about_item');
                $receiver = $this->input->post('to_user_username');
                $replyThread = $this->input->post('reply_thread');
                $sender = $_SESSION['user_id'];

                $this->load->model('message_model');
                $this->message_model->replyToMessageThread($sender, $receiver, $content, $aboutItem, $replyThread);
                $this->load->helper('url');
                redirect('/messages/messages', 'refresh');
        }
}