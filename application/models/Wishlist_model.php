<?php

class Wishlist_model extends CI_Model {



    public function __construct()

    {

            $this->load->database();

    }



    public function get($userid){

        $this->db->where('userid', $userid);
		$this->db->join('item', 'item.item_id = wish_list.itemid', 'left');
		$this->db->join('image', 'image.image_id = item.main_image', 'left');
		$query = $this->db->get('wish_list');
		return $query->result();

    }
	public function add($options){

        $this->db->insert('wish_list', $options);
		return $this->db->insert_id();

    }
	public function delete($userid, $itemid){

        $this->db->where('itemid', $itemid);
		$this->db->where('userid', $userid);
		$this->db->delete('wish_list');

    }
	public function get_currentQty($uderid){
		$this->db->where('itemid', $itemid);
		$this->db->where('userid', $userid);
		$this->db->where('8' );
		
		
		
		
	}


}