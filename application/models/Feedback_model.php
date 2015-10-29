<?php
class Feedback_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function getSellerRating($userId){
    	$sql = "SELECT SUM(f.buyer_rating)/COUNT(f.buyer_rating) AS 'avarage_rating', COUNT(f.buyer_rating) as 'total_ratings' , u.username
    			FROM `order` o, feedback f, item i, user u
    			WHERE f.`order` = o.order_id AND i.seller = '$userId' AND o.item = i.item_id AND i.seller = u.user_id";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}	
    }

    public function getSellerFeedbacks($userId){
    	$sql = "SELECT f.buyer_comment, f.buyer_rating, u.username, u2.username AS 'buyer_username', 
    				u2.user_id AS 'buyer_id', i.title, i.item_id, o.sold_price
    			FROM `order` o, feedback f, item i, user u, user u2
    			WHERE f.`order` = o.order_id 
	    			AND i.seller = '$userId' 
	    			AND o.item = i.item_id 
	    			AND i.seller = u.user_id
	    			AND o.bought_by_user = u2.user_id";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}	
    }

    public function getBuyerRating($userId){
    	$sql = "SELECT SUM(f.seller_rating)/COUNT(f.seller_rating) AS 'avarage_rating', COUNT(f.seller_rating) as 'total_ratings' , u.username
    			FROM `order` o, feedback f, user u
    			WHERE f.`order` = o.order_id 
    				AND o.bought_by_user = u.user_id
    				AND o.bought_by_user = '$userId'";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}	
    }

    public function getBuyerFeedbacks($userId){
    	$sql = "SELECT f.seller_comment, f.seller_rating, u.username AS 'seller_username', 
    				u.user_id AS 'seller_id', i.title, i.item_id, o.sold_price
    			FROM `order` o, feedback f, user u, item i
    			WHERE f.`order` = o.order_id 
	    			AND o.bought_by_user = '$userId' 
	    			AND o.item = i.item_id
	    			AND i.seller = u.user_id
	    			";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}	
    }

    public function buyerPostFeedback($orderId, $content, $rating){
    	$sql = "INSERT IGNORE INTO feedback (`order`) VALUES('$orderId')";

		$query = $this->db->query($sql);

		if($query){
			$sql = "UPDATE feedback 
					SET buyer_rating = '$rating', buyer_comment= '$content' 
					WHERE `order`= '$orderId'";

			$query2 = $this->db->query($sql);

			if ($query2) {

				return TRUE;
			}else{
				echo $this->db->_error_message();
				return FALSE;
			}
			
		}else{
			echo $this->db->_error_message();
			return FALSE;
		}	
    }
}

?>