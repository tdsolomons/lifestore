<?php

class Cart_model extends CI_Model {



    public function __construct()

    {

            $this->load->database();

    }



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
	public function insertItems($data)

	{
		
		$insert_id = $this->db->insert('order',$data);
		$this->load->model('winbid_model');
		
		$item_id = $data['item'];
		$item_id_array = array('item_id'=> $item_id);
		$seller = $this->winbid_model->getSeller($item_id);
		$this->sendEmail($seller,$item_id_array);
		
		$this->checkWishlist($item_id, $data['bought_by_user']);
		return $insert_id;


	}
	private function checkWishlist($item_id, $user){
		$query=$this->db->query("update item set available_quantity=available_quantity-'".$qty."'");
		
		
		
	}
	
	
	
	public function check_code($code){
		$this->db->where('gift_code', $code);
		
		$this->db->join('gift_item', 'gift_purchased.gift_item_id', 'left');
		$this->db->limit(1);
		$query = $this->db->get('gift_purchased');
		return $query->row(0);

		
		
	}
	
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