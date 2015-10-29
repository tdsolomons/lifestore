<?php
/**
 *Giftcard class
 *Controller for all the gift cards realated activities
 *@package     EMarketingPortal
 * @author     Dilini udeshika
 */
class Giftcard extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				$this->load->helper(array('form', 'url'));
				$this->load->model('giftcard_model');
                session_start();
                 
        }
	    /**
        * Shows currently available gift cards for buyers
        *
        * @access   public
        * @return   void
        */

        public function gift_card(){
                $data['title'] = 'Gift Cards';                
				$data['gift_items'] = $this->giftcard_model->gift_items();
                $this->load->view('templates/header', $data);
				$this->load->view('templates/search_box');
                $this->load->view('view_gift_card', $data);
                $this->load->view('templates/footer');
        }
		 /**
        * Shows selected gift card 
		*	
        *
        * @access   public
        * @return   void
        */
		public function view ($id){
				$data['object'] = $this->giftcard_model->gift_item_by_id($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/search_box');
				$this->load->view('view_gift_card_item', $data);
				$this->load->view('templates/footer');
					
		}
		 /**
        * Shows  the gift card bought by buyer
		* shows the Random Gift code	
        *
        * @access   public
        * @return   void
        */
		public function buy($id){
				$data['object'] = $this->giftcard_model->gift_item_by_id($id);
				//generate random string
				$data['random'] = $this->generateRandomString();
				$this->load->model('item_model');
				//get the logged user details
				$user = $this->item_model->getUserInfomation($_SESSION['user_id']);
				$data['user'] = $user[0];
				
				$options = array(
								'gift_item_id'=>$data['object']->id,
								'user'=>$_SESSION['user_id'],
								'gift_code'=>$data['random']
								
								);
				//pass the options array call function
				$this->giftcard_model->save($options);
				//call the send email function
				$this->send_mail($data['user']->email, $data['random'],$data['object']);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/search_box');
				$this->load->view('view_gift_card_confirm', $data);
				$this->load->view('templates/footer');
				
		}
		 /**
        * Returns the Random Gift code	
        *
        *
        */
		
		function generateRandomString($length = 20) {
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				//get the length
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
		}
		
		/**
        * send an email to giftcard buyer
        *send gift cards and random code to buyer
        * 
        *
        */
		
		function send_mail($email, $random,$gift_items){
				$storeName = 'LifeStore.lk';
				$this->load->library('email');
				$this->email->clear();
				$this->email->set_mailtype("html");
				$this->email->from('noreply@sep.tagfie.com', $storeName);
				$this->email->subject('Gift card purchase notification');
				$this->email->to("udeshikadilini@gmail.com");
				//buyer email 
				//$this->email->to($email); 
				$emailBody ='<html>
										<body>
										<h2>your LifeStore.lk Gift card</h2>
										<p><img src="' . asset_url() . 'img/giftcard_images/'.$gift_items->image.'"/></p>
										
										<strong><p>Gift code is: ' . $random. '</p></strong>
										<p>Almost anything listed on LifeStore.lk can be purchased with your LifeStore.lk gift 	card.Newly discounted  gift cards are showing up all the time,so check this page often to seewhats  new.
										</br>
										How you can use your gift card balance to buy items on LifeStore.lk:
										</br>
										Enter your 20-digit redemption code at checkout. Click "Apply," and your gift card balance will be applied to your purchase.
										Lost, stolen or damaged gift cards will not be replaced.
										</p>
										</body>
										</html>
										';
				//email body					
				$this->email->message($emailBody);  
				$this->email->send();	
					
					
				
		}
		 /**
        * insert gift card by admin	
        * insert gift card image with price 
        *
        */
		
		
		public function add_giftcard(){
				//load form validation library
				$this->load->library('form_validation');
				//chech the values are numeric
				$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
				$this->form_validation->set_rules('gift_name', 'Gift card name', 'trim|required');
				//run form validation and check for errors
				if ($this->form_validation->run()){				
					$image = $this->do_upload();
					$options = array('gift_name'=>$this->input->post('gift_name'),
									'price'=>$this->input->post('price'),
									'image' =>$image);
					//go to the model to insert 
					$this->giftcard_model->add($options);
				}
		
				$data = array();
				$data['gift_items'] = $this->giftcard_model->gift_items();
				$data['error'] = ' ';
				$this->load->view('templates/adminHeader');
				$this->load->view('addGiftcard_view', $data);
				$this->load->view('templates/footer');
		}
		
		/*upload a gift card image
		*insert the unique image file name
		*/
		private function do_upload(){
		
			//insert the options needs to library
				$config = array(
					'upload_path' => "./assets/img/giftcard_images/",
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => TRUE,
					'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					'max_height' => "768",
					'max_width' => "1024",
					//uploded time add to string to get unique image file name
					'file_name' => microtime(true).$_FILES['userfile']['name']
					);
					//pass the configurationsto load libraray
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload()){
					$image_data = $this->upload->data();
					$data = array('upload_data' => $this->upload->data());
					return $image_data['file_name'];
					
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());			
				}
		}
		
		/**
		*remove the giftcards by admin
		*/
		public function delete($id){
				$this->giftcard_model->remove($id);
				redirect('giftcard/add_giftcard');
			}
		

        
}