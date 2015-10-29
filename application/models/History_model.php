<?php
class History_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
            if (!isset($_SESSION)) {
                session_start();
            }
            
    }

    public function addItemToViewedHistory($itemId){

    	if ($itemId == NULL || !isset($_SESSION['user_id'])) {	
    		return FALSE;
    	}else{
            $userId = $_SESSION['user_id'];
    		$sql = "CALL add_item_to_viewed_history('$userId', '$itemId'); ";

    		$query = $this->db->query($sql);

    		if ($query) {
    		    return TRUE;
    		}else
    		    return FALSE;
    	}
    }

    public function loadRecentlyViewedItems(){
        if (!isset($_SESSION['user_id'])) {  
            return NULL;
        }else{
            $userId = $_SESSION['user_id'];
            $sql = "SELECT i.*, img.file_name, fpi.price, ai.end_datetime, ai.starting_bid 
                    FROM (item i, user_view_item uvi, image img)
                    LEFT JOIN fixed_price_item fpi
                    ON i.item_id = fpi.item_id
                    LEFT JOIN auction_item ai
                    ON i.item_id = ai.item_id
                    WHERE uvi.item = i.item_id 
                            AND uvi.user = '$userId' 
                            AND i.main_image = img.image_id
                            AND i.item_status = '1'
                    ORDER BY viewed_time DESC
                    LIMIT 4";

            $query = $this->db->query($sql);

            if ($query) {
                return $query->result();
            }else
                return NULL;
        }

    }

    public function clearHistory(){
        $userId = $_SESSION['user_id'];
        $sql = "DELETE FROM user_view_item WHERE user='$userId' ";
        $this->db->query($sql);
    }

}
?>