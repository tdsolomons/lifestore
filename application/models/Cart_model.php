<?php
class Cart_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function getItemDetails($itemId){
        $query = $this->db->query("SELECT i.title, i.item_id, i.shipping_cost , u.username, u.first_name, u.last_name, 
                                            ct.*, fpi.price, img.file_name
                                    FROM item i, user u,  condition_type ct, fixed_price_item fpi, image img
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
	return $this->db->insert('order',$data);
	
	
	
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