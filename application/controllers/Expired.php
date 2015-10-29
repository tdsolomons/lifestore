<?php
class Expired extends CI_Controller {

        public function __construct()
        {
                parent::__construct();               
        }

        public function expireditems(){
			$this->load->model('winbid_model');
			$items = $this->winbid_model->getEndBids();
			
			foreach($items as $item){
				$winner = $this->winbid_model->getWinner($item->item_id);
				$seller = $this->winbid_model->getSeller($item->item_id);
				
						
				if($winner != NULL){
					$this->sendEmailToWinner($winner, $item);
					$this->winbid_model->updateWinner($item->item_id, $winner->user_id);
				}
				if($seller != NULL){
					$this->sendEmailToSeller($seller, $item);
				}
							
			}
			
		}
		
		private function sendEmailToSeller($seller, $item, $options = ''){
			$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			$this->email->to($seller->email); 
			//$this->email->to("udeshikadilini@gmail.com");			 
			
			$emailBody = '';
			if($seller){
				$this->email->subject('Auction end notification');
				$emailBody = '<html>
								<body>

								<h1>Auction has ended</h1>
								<p>Auction has ended for the following item you are selling:</p>
								' . $item->title. '

								</body>
								</html>
								';
			}
			
			$this->email->message($emailBody);  
			echo $emailBody;
			
            if($this->email->send()){
				echo "Success: " . $seller->email;
			}else{
				"Email fail";
			}
						
		}

		private function sendEmailToWinner($winner, $item, $options = ''){
			$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			//$this->email->to($winner->email); 
			$this->email->to("udeshikadilini@gmail.com");			 
			
			$emailBody = '';
			if($winner){
				$this->email->subject('Wining notification');
				$emailBody = '<html>
							<body>

							<h1>Congratulations! You won the auction</h1>
							<p>Please enter your address and make the payment to receive the item.</p>
							<a href="' . base_url().'cart/buy/'. $item->item_id . '">link here </a><br>
							' . $item->title . '<br>
							
							</body>
							</html>';
			}
			
			$this->email->message($emailBody);  
			echo $emailBody;
			
            if($this->email->send()){
				echo "Success";
			}else{
				"Email fail";
			}
						
		}

		
}