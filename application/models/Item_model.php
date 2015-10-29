<?php
class Item_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function item($itemId = '1'){
    	$query = $this->db->query("SELECT i.* , u.username, u.first_name, u.last_name, ct.*, c.*, fpi.price
                                    FROM item i, user u, category c, condition_type ct, fixed_price_item fpi
                                    WHERE i.seller = u.user_id 
                                        AND i.item_id = fpi.item_id
                                        AND i.category = c.category_id 
                                        AND i.condition_type = ct.condition_id
                                        AND i.item_id = '". $itemId . "'"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }

    public function getItemImages($itemId = '1'){
    	$query = $this->db->query("SELECT i.* 
    								FROM image i 
    								WHERE i.item_id = '". $itemId . "'"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	
	public function getItemImage($itemId = '1'){
    	$query = $this->db->query("SELECT * 
    								FROM image i 
    								WHERE i.item_id = '". $itemId . "' limit 1"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	public function getAvailableQuantity($itemId = '1'){
    	$query = $this->db->query("SELECT i.available_quantity 
    								FROM item i 
    								WHERE i.item_id = '". $itemId . "'"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	public function getColors($itemId = '1'){
    	$query = $this->db->query("SELECT ihc.item_id, c.*
									FROM  color c , item_has_color ihc 
                                    WHERE ihc.color_id = c.color_id
                                    AND ihc.item_id = '". $itemId . "'"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	public function getUserInfomation(){
    	$query = $this->db->query("SELECT first_name,last_name,email,address,street,city
									FROM  user
									WHERE user_id=1"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	public function insertBuynowItem(){
		}

}