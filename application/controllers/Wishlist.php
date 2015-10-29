<?php
/**
 * Wishlst class
 * Controller for all the wishlist realated activities
 *
 * @package     EMarketingPortal
 * @author      Dilini udeshika
 */
class Wishlist extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				$this->load->helper('url');
				$this->load->model('wishlist_model');
                session_start();
        }
		
		/**
        * insert items to wishlist
        * get the loged user by session
        * @access   public
		* @param itemid
        * redirects the mylist
        */
        public function add($itemid){
			    //get the logged user id
				$user_id = $_SESSION['user_id'];
				$options = array(
							'userid'=>$user_id,
							'itemid' =>$itemid
				);
				$data['item'] = $this->wishlist_model->add($options);	
	
              redirect('wishlist/mylist');
        }
		/**
        * shows the all the items in the wishlist
        * 
        * @access   public
        * Returns array of object
        */
		public function mylist(){
			   //get the logged userid
				$user_id = $_SESSION['user_id'];
				$data['items'] = $this->wishlist_model->get($user_id);
				
                $this->load->view('templates/header', $data);
                $this->load->view('wishlist_view', $data);
                $this->load->view('templates/footer');
        }
	
		/**
		*remove the items from wishlist
		"@param(itemid)
		*/
		public function remove($itemid){
			   
				$user_id = $_SESSION['user_id'];
				
				$data['item'] = $this->wishlist_model->delete($user_id, $itemid);	
	
              	redirect('wishlist/mylist');
        }

}

?>