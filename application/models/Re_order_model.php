<?php

	class Re_order_model extends CI_Model{

		public function __construct()
    	{
            $this->load->database();
			if (!isset($_SESSION)) {
                session_start();
            }
    	}
		
		/*-----*/
		public function re_order_list(){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
				$sql = "select i.item_id, i.title, c.category_name, i.available_quantity, sd.supplier_name, sd.supplier_email
						from item i 
						left join user u
						on u.user_id = i.seller
						left join item_has_supplier ihs
						on i.item_id = ihs.item_id
						left join supplier_details sd
						on sd.supplier_id = ihs.supplier_id
						left join category c
						on c.category_id = i.category
						where available_quantity < 5 and item_status = '1' and u.user_id = ".$userId.";";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		/*---------*/
		public function re_order_generate($item_id){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "select i.item_id, i.title, c.category_name, i.available_quantity, sd.supplier_name, sd.supplier_email
						from item i 
						left join user u
						on u.user_id = i.seller
						left join item_has_supplier ihs
						on i.item_id = ihs.item_id
						left join supplier_details sd
						on sd.supplier_id = ihs.supplier_id
						left join category c
						on c.category_id = i.category
						where available_quantity < 5 and item_status = '1' and i.item_id = ".$item_id.";";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		
	}

?>