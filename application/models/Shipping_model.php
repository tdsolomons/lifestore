 <?php
       
        class Shipping_model extends CI_Model{
            
			public function __construct()
    		{
            	$this->load->database();
    		}
            
            public function getItemData($itemID){
                
                $this->db->where('item_id', $itemID);
                $queryItem = $this->db->get('item');
                $resultItem = $queryItem->result();
                
                if ($queryItem->num_rows()== 1 ) {
                    return $resultItem;
                } else {
                    
                }
            }
            
            public function getUserData($username) {
		
		$queryUser = $this->db->query("SELECT * FROM EMarketingPortal.user u, EMarketingPortal.user_phone up WHERE u.username='$username' AND up.user_id=u.user_id");

                $resultUser = $queryUser->result();
                if ($queryUser->num_rows()== 1 ) {
                    return $resultUser;
                } else {
                    
				}
            }
			

        }
        
?>