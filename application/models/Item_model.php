<?php
class Item_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function item($itemId = '1'){
    	$query = $this->db->query("SELECT i.* , u.username, u.user_id, u.first_name, u.last_name, ct.*, c.*, fpi.price, img.file_name 
                                    FROM item i, user u, category c, condition_type ct, fixed_price_item fpi, image img
                                    WHERE i.seller = u.user_id 
                                        AND i.item_id = fpi.item_id
                                        AND i.category = c.category_id 
                                        AND i.condition_type = ct.condition_id
                                        AND i.main_image = img.image_id
                                        AND i.item_id = '". $itemId . "'"
    								);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }

    public function getAuctionItem($itemId = '1'){
        $sql = "SELECT i.* , u.username, u.user_id, u.first_name, u.last_name, ct.*, c.*, ai.* , img.file_name , ss.*
                                FROM (item i, user u, category c, condition_type ct, auction_item ai, image img)
                                LEFT JOIN (SELECT * FROM bid WHERE auction_item='$itemId' order by amount DESC LIMIT 1) as ss
                                ON ai.item_id = ss.auction_item
                                WHERE i.seller = u.user_id 
                                    AND i.item_id = ai.item_id
                                    AND i.category = c.category_id 
                                    AND i.condition_type = ct.condition_id
                                    AND i.main_image = img.image_id
                                    AND i.item_id = '$itemId';";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function getAuctionItemBids($itemId = '1'){
        $sql = "SELECT * FROM ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function bid($itemId, $amount, $userId){
        $sql = "INSERT INTO bid(auction_item, amount, bid_datetime, bidder) 
                VALUES('$itemId', '$amount', NOW(), '$userId')";
        $query = $this->db->query($sql);
        if($query){
            return TRUE;
        }else{
            return FALSE;
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