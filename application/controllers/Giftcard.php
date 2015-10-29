<?php
class Giftcard extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				$this->load->model('giftcard_model');
                session_start();
                 
        }

        public function gift_card(){
                $data['title'] = 'Gift Cards';                
				$data['gift_items'] = $this->giftcard_model->gift_items();

                $this->load->view('templates/header', $data);
                $this->load->view('view_gift_card', $data);
                $this->load->view('templates/footer');
        }
		public function view ($id){
			$data['object'] = $this->giftcard_model->gift_item_by_id($id);
			$this->load->view('templates/header', $data);
            $this->load->view('view_gift_card_item', $data);
            $this->load->view('templates/footer');
				
		}
		public function buy($id){
			$data['object'] = $this->giftcard_model->gift_item_by_id($id);
			$data['random'] = $this->generateRandomString();
			
			$this->load->model('item_model');
			$user = $this->item_model->getUserInfomation($_SESSION['user_id']);
			$data['user'] = $user[0];
			
			$options = array(
							'gift_item_id'=>$data['object']->id,
							'user'=>$_SESSION['user_id'],
							'gift_code'=>$data['random']
							
							);
			$this->giftcard_model->save($options);
			$this->send_mail($data['user']->email, $data['random']);
			$this->load->view('templates/header', $data);
            $this->load->view('view_gift_card_confirm', $data);
            $this->load->view('templates/footer');
			
		}
		
		function generateRandomString($length = 20) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		function send_mail($email, $random){
			$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			$this->email->subject('Gift card purchase notification');
			$this->email->to('udeshikadilini@gmail'); 
			$emailBody ='<html>
									<body>
									<h1>Your Gift Items has been purchased</h1>
									<p>Gift code is: ' . $random. '</p>
									<p></p>
									</body>
									</html>
									';
									
			$this->email->message($emailBody);  
			$this->email->send();	
				
				
			
		}

        
}