<?php
/**
 * 
 *Handles all the operations related to wishlist
 *
 * @package     EMarketingPortal
 * @author      Dilini udeshika
 */

class Wishlist_model extends CI_Model {



    public function __construct()

    {

            $this->load->database();

    }
	/*
	*Returns all the items available on wishlist
	*@access public
	*@param userid
	*rerurns wishlist items 
	*/

    public function get($userid){

        $this->db->where('userid', $userid);
		$this->db->join('item', 'item.item_id = wish_list.itemid', 'left');
		$this->db->join('image', 'image.image_id = item.main_image', 'left');
		$query = $this->db->get('wish_list');
		return $query->result();

    }
	/*
	*insert items to wishlist
	*@param options
	*/
	public function add($options){
		//insert into ignore
		
		//$itemid = $options['itemid'];
		//$userid = $options['userid'];
		
        $this->db->insert('wish_list', $options);
		return $this->db->insert_id();
	
    }
	/**
	*Remove items from wishlist
	*@access publi
	*@param userid, itemid
	*/
	public function delete($userid, $itemid){

        $this->db->where('itemid', $itemid);
		$this->db->where('userid', $userid);
		$this->db->delete('wish_list');

    }
	/*not using
	*
	*/
	public function get_currentQty($uderid){
		$this->db->where('itemid', $itemid);
		$this->db->where('userid', $userid);
		$this->db->where('8' );
	
	}
	/*
	*return  the available quantity
	*check the items in the wishlist
	*@access public 
	*@param item_id, percentage
	*/
	
	
	public function check($item_id, $perc){
		//Check the available quantity 
		$query=$this->db->query("SELECT i.available_quantity,
										i.title, img.name 
										FROM (item i, image img) 
										WHERE i.item_id =".$item_id."
										AND i.main_image = img.image_id ");
		//get the first row
		$result = $query->row(0);
		//check the items arr availale in the wishlist
		$wishlist_item = $this->db->query("SELECT * 
											FROM EMarketingPortal.wish_list
											WHERE itemid =".$item_id);
		
		
		if($wishlist_item->num_rows() > 0){
		foreach($wishlist_item->result() as $row){
			//get the user details
			$user_email = $this->get_user($row);
			$this->sendWishlistMail($user_email,$result, $perc);
			}
		}

	
	}
	
	/*
	*returns the user details
	*
	*@access private
	*@param row
	*/
	private function get_user($row){
			$user=$this->db->query("SELECT `email` FROM EMarketingPortal.user WHERE user.user_id =".$row->userid);
			$user =  $user->row(0);
			return $user->email;
	}
	/*
	*Send the email to all each and every users items available in wishlists
	*
	*@access private
	*@param row
	*/
	private function sendWishlistMail($user_email,$item, $perc){
			$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			//$this->email->to($user_email); 
			$this->email->to("udeshikadilini@gmail.com");
			
			$this->email->subject('Deal notification');
			$emailBody ='<html>
									<body>

									<h1>'.$item->title.'</h1>
									
									<strong>Price reduced by '.$perc.'%</strong>
									<p> <img width="200" height="200" src="' . asset_url() . 'img/item_images/'.$item->name. '"/></p>
									<p>Limited-Time: Items sell out quickly.don’t miss the chance..</p>
									</body>
									</html>
									';
				
				$this->email->message($emailBody);  
				
				
	            if($this->email->send()){
					//echo "Successs";
				}else{
					echo "Email fail";
				}
		
	}


}