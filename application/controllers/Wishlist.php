<?php
class Wishlist extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				$this->load->helper('url');
				$this->load->model('wishlist_model');
                session_start();
        }
		

        public function add($itemid){
			    
				$user_id = $_SESSION['user_id'];
				$options = array(
							'userid'=>$user_id,
							'itemid' =>$itemid
				);
				$data['item'] = $this->wishlist_model->add($options);	
	
              redirect('wishlist/mylist');
        }

		public function mylist(){
			   
				$user_id = $_SESSION['user_id'];
				$data['items'] = $this->wishlist_model->get($user_id);	
							
                $this->load->view('templates/header', $data);
                $this->load->view('wishlist_view', $data);
                $this->load->view('templates/footer');
        }
		
		public function remove($itemid){
			   
				$user_id = $_SESSION['user_id'];
				
				$data['item'] = $this->wishlist_model->delete($user_id, $itemid);	
	
              	redirect('wishlist/mylist');
        }

}

?>