<?php
/**
 * Handles all the operations related to cart
 *
 * @package Codigniter
 * @subpackage  Emarketing portal
 * @author  Dilini udeshika
 */

class Cart_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
 	/**
    * Returns all items availble in cart
    *
    * @access   public
    * @return   array of objects
    */
    public function getItemDetails($itemId){
        $query = $this->db->query("SELECT i.title, i.item_id, i.shipping_cost , u.username, u.first_name, u.last_name, 
                                      ct.*, fpi.price, img.file_name, d.off_percentage, d.end_time
                                      FROM (item i, user u,  condition_type ct, fixed_price_item fpi, image img)
                                      LEFT JOIN deal d
                                      ON d.fixed_price_item = fpi.item_id
                                      AND d.end_time > NOW()
                                   	  WHERE i.seller = u.user_id
                                      AND i.main_image = img.image_id 
                                      AND i.item_id = fpi.item_id
                                      AND i.condition_type = ct.condition_id
	                                  AND i.item_id = '". $itemId . "'"
                                    );

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }
	/**
    *insert items to the cart
    *
    * @access   public
    *
    */
	public function insertItems($data)

	{
		
		$insert_id = $this->db->insert('order',$data);
		$this->load->model('winbid_model');
		
		$item_id = $data['item'];
		$item_id_array = array('item_id'=> $item_id);
		$seller = $this->winbid_model->getSeller($item_id);
		$this->sendEmail($seller,$item_id_array);
		$this->update_qty($item_id, $data['ordered_quantity']);
		$this->checkWishlist($item_id, $data['bought_by_user']);
		return $insert_id;


	}
	
	/**
    * update the quantity
    *
    * @access   public
    * 
    */
	private function update_qty($item_id, $qty){
		$query=$this->db->query("UPDATE `item` SET `available_quantity`= `available_quantity`-".$qty."
								WHERE item_id = ".$item_id);
	}
	/**
    * check the items available in wishlist
    *
    * @access   public
    * 
    */
	
	public function checkWishlist($item_id, $user){
		//availble quantity
		$query=$this->db->query("SELECT i.available_quantity, 
								 i.title,
								 img.name 
								 FROM (item i, image img)
								 WHERE i.item_id =".$item_id."
								 AND i.main_image = img.image_id ");
		$result = $query->row(0);
		$avl_qty = $result->available_quantity;
		//check available quantity less than 0
		if($avl_qty<3)	{
			$wishlist_item = $this->db->query("SELECT * 
												FROM EMarketingPortal.wish_list
												WHERE itemid =".$item_id);
			
			
			if($wishlist_item->num_rows() > 0){
				foreach($wishlist_item->result() as $row){
					$user_email = $this->get_user($row);
					$this->sendWishlistMail($user_email,$result);
				}
			}
		
		}
		
	}
	/**
    * if available quantiyt less than 0 send email
    * @param user, item
    * @access   public
    * 
    */
	private function sendWishlistMail($user_email,$item){
		$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			//$this->email->to($user_email); 
			$this->email->to("udeshikadilini@gmail.com");
			$this->email->subject('Wish list notification');
			$emailBody ='<html>
									<body>
									<h3>Your Wishlist item is ending soon..</h3>

									<h1>'.$item->title.'</h1>
									
									<p><img Width="350" src="' . asset_url() . 'img/item_images/'.$item->name. '"/></p>
									<p>Limited quantity remaining: Do not wait until the last second!.Items sell out quickly.</p>

									</body>
									</html>
									';
				
			$this->email->message($emailBody);  
				
				
	         if($this->email->send()){
					echo "Successs";
				}else{
					echo "Email fail";
				}
		
	}
	/**
    * get user details
    *
    * @access   private
    * 
    */
	
	private function get_user($row){
			$user=$this->db->query("SELECT `email` FROM EMarketingPortal.user WHERE user.user_id =".$row->userid);
			$user =  $user->row(0);
			return $user->email;
	}
	
	/**
    * check generated code is used
    *if not used coloumn  0
    * @access   public
    * 
    */
	
	public function check_code($code){
			$this->db->where('gift_code', $code);
			$this->db->where('used', '0');//not used=0
			
			$this->db->join('gift_item', 'gift_purchased.gift_item_id', 'left');
			$this->db->limit(1);
			$query = $this->db->get('gift_purchased');
			return $query->row(0);
	
			
			
	}
	/**
    * send email
    *
    * 
    */
	
	private function sendEmail($options,$it){
		
			$storeName = 'LifeStore.lk';
			$this->load->library('email');
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->from('noreply@sep.tagfie.com', $storeName);
			
			foreach($it as $itrow){
				$item=$itrow['item_id'];
				$query=$this->db->query("Select * from item where item_id='$item';");
				$row=$query->row();

				$this->email->to($options->email); 
				//$this->email->to("udeshikadilini@gmail.com");
				
				
						 
			
				$this->email->subject('Item purchase notification');
				$emailBody ='<html>
									<body>

									<h1>Your Items has been purchased</h1>
									<p>The following item has been sold: ' . $row->title. '</p>
									<p>Please review the order in selling section and ship the item.</p>

									</body>
									</html>
									';
				
				$this->email->message($emailBody);  
				
				
	            if($this->email->send()){
					echo "Successs";
				}else{
					echo "Email fail";
				}
			}	
	}
	
	
	

	

	

	

	

	/*function ProceedToCheckOut() {

        //$username = $this->input->post('username');



        $new_Proceed_To_CheckOut = array(

            'order_id' => $this->input->post('order_id'),

            'ordered_date' => $this->input->post('ordered_date'),

            'sold_price' => $this->input->post('sold_price'),

            'item' => $this->input->post('item'),

            'bought_by_user' => $this->input->post('bought_by_user'),

            'order_status' => $this->input->post('order_status'),

            'ship_to_address' => $this->input->post('ship_to_address'),

            'ordered_quantity' => $this->input->post('ordered_quantity')

            

        );



        $insert = $this->db->insert('users', $new_Proceed_To_CheckOut);

        return $insert;

    }*/

}