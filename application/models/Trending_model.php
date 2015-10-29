<?php

	class Trending_model extends CI_Model{

		public function __construct()
    	{
            $this->load->database();
			if (!isset($_SESSION)) {
                session_start();
            }
    	}
		
		/*this function returns the details of the trending items
		recently ordered items by other users */
		public function get_trending_items(){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "SELECT DISTINCT i.item_id, i.*, img.file_name, fpi.price, ai.end_datetime, ai.starting_bid , u.username
                        FROM (item i, image img, user u)
                        LEFT JOIN fixed_price_item fpi
                        ON i.item_id = fpi.item_id
                        LEFT JOIN auction_item ai
                        ON i.item_id = ai.item_id
                        LEFT JOIN EMarketingPortal.order o
						ON i.item_id = o.item
						WHERE o.bought_by_user != ".$userId."  
                        		AND i.main_image = img.image_id
                        		AND i.item_status = '1'
                        		AND i.seller = u.user_id
                        ORDER BY o.ordered_date DESC
                        LIMIT 4";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		/*this function returns the details of the items
		recently viewed by other users */
		public function others_viewed_items(){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "SELECT DISTINCT i.item_id, i.*, img.file_name, fpi.price, ai.end_datetime, ai.starting_bid , u.username
                        FROM (item i, image img, user u)
                        LEFT JOIN fixed_price_item fpi
                        ON i.item_id = fpi.item_id
                        LEFT JOIN auction_item ai
                        ON i.item_id = ai.item_id
                        LEFT JOIN user_view_item v
						ON i.item_id = v.item
						WHERE v.user != ".$userId." 
                        		AND i.main_image = img.image_id
                        		AND i.item_status = '1'
                        		AND i.seller = u.user_id
                        ORDER BY v.viewed_time DESC
                        LIMIT 4";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		
		/*---
		public function get_trending_items(){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "----";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		--*/
	}

?>