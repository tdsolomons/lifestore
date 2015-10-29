<?php
class Order_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function getUserPurchasedOrders($userId){
    	$sql = "SELECT o.*, i.*, os.*, u.username as 'seller_username'
    			FROM `order` o, item i, order_status os, user u
    			WHERE o.bought_by_user = '$userId'
    				AND o.item = i.item_id
    				AND o.order_status = os.status_id
    				AND i.seller = u.user_id";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}	
    }
}
?>