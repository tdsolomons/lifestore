<?php
class Giftcard_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function gift_items(){
    	$query = $this->db->query("select * from gift_item");
    							
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	public function gift_item_by_id($id){
		$query = $this->db->query("select * from gift_item WHERE `id` =".$id." LIMIT 1");
		return $query->row(0);
	}
	
	public function save($data){
		$this->db->insert('gift_purchased', $data);		
		return $this->db->insert_id();
		
	}

   		
	
}
