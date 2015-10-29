<?php
class Profile_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
            if (!isset($_SESSION)) {
                session_start();
            }
    }

    public function followSeller($sellerId, $buyerId){

    	if ($sellerId == NULL || $buyerId == NULL) {	
    		return FALSE;
    	}else{
    		$sql = "CALL follow_seller('$buyerId', '$sellerId'); 
                    ";

    		$query = $this->db->query($sql);

    		if ($query) {
    		    return TRUE;
    		}else
    		    return FALSE;
    	}
    }

    public function unfollowSeller($sellerId, $buyerId){
    	if ($sellerId == NULL || $buyerId == NULL) {	
    		return FALSE;
    	}else{
    		$sql = "DELETE FROM follow WHERE seller='$sellerId' AND buyer='$buyerId';";

    		$query = $this->db->query($sql);

    		if ($query) {
    		    return TRUE;
    		}else
    		    return FALSE;
    	}
    }

    public function getFollowStatus($sellerId, $buyerId){
    	// Returns TRUE if followed by the buyer
    	if ($sellerId == NULL || $buyerId == NULL) {	
    		return FALSE;
    	}else{
    		$sql = "SELECT * FROM follow WHERE seller='$sellerId' AND buyer='$buyerId';";

    		$query = $this->db->query($sql);

			if($query->num_rows() > 0){
		        return TRUE;
			}else{
				return FALSE;
			}
    	}
    }

    public function getFollowersCount($sellerId){
    	if ($sellerId == NULL ) {	
    		return 0;
    	}else{
    		$sql = "SELECT COUNT(seller) as 'followers_count' FROM follow WHERE seller='$sellerId';";

    		$query = $this->db->query($sql);

			return $query->result();
    	}
    }

    public function getLatestItemsOfFollowingSellers(){
            if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "SELECT i.*, img.file_name, fpi.price, ai.end_datetime, ai.starting_bid , u.username
                        FROM (item i, follow f, image img, user u)
                        LEFT JOIN fixed_price_item fpi
                        ON i.item_id = fpi.item_id
                        LEFT JOIN auction_item ai
                        ON i.item_id = ai.item_id
                        WHERE f.seller = i.seller 
                        		AND f.buyer = '$userId'
                        		AND i.main_image = img.image_id
                        		AND i.item_status = '1'
                        		AND i.seller = u.user_id
                        ORDER BY i.posted_date DESC
                        LIMIT 4";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
    }

}