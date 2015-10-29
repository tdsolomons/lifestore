<?php
class Winbid_model extends CI_Model {
	
	public function getEndBids(){
		
		$query= $this->db->query("SELECT * FROM `auction_item` WHERE `end_datetime` < NOW() ");
		 
		if($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
	}
	
	public function getWinner($id){
		$query= $this->db->query("SELECT user.user_id,user.first_name,user.last_name,user.email,bid.amount,item.title,item.item_id
								FROM bid 
								JOIN user ON bid.bidder=user.user_id 
								JOIN item ON bid.auction_item=item.item_id
								WHERE auction_item=".$id." 
								ORDER BY amount DESC LIMIT 1");
		if($query->num_rows() > 0){
            return $query->row();
        }else{
            return NULL;
        }
		
	}
	
	public function getSeller($id){
		
		$query= $this->db->query("SELECT user.user_id,user.first_name,user.last_name,user.email
								FROM user
								JOIN item ON item.seller=user.user_id
								WHERE item_id=$id ");
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return NULL;		
		}
	}
	
}
