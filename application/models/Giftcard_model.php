<?php
/**
 * Handles all the operations related to gift cards
 *
 * @package Codigniter
 * @subpackage  Emarketing portal
 * @author Dilini udeshika
 */
class Giftcard_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }
	/**
    * insert gift cards bought by user
    *
    */
	
	public function add($data){
		$this->db->insert('gift_item', $data);		
		return $this->db->insert_id();
		
	}
	
	/**
    * shows gift cards avilable
    *@access public
	*@return array of object 
    */
    public function gift_items(){
    	$query = $this->db->query("select * from gift_item");
    							
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
	
	/**
    * Returns selected giftcard
    *@access public
	*@return array of object 
    */
	public function gift_item_by_id($id){
		$query = $this->db->query("select * from gift_item WHERE `id` =".$id." LIMIT 1");
		return $query->row(0);
	}
	
	/**
    * Insert purchsed gift card by buyer
    *@access public
    */
	public function save($data){
		$this->db->insert('gift_purchased', $data);		
		return $this->db->insert_id();
		
	}
	
	/**
    *Update the random generated code as expired once it is used
    *@access public
    */
	public function update_code($code){
		$this->db->set('used', 1);
		$this->db->where('gift_code', $code);		
		$this->db->update('gift_purchased');
		
	}
	
	/**
    *delete gift card 
    *@access public
    */
	public function remove($id){
		$this->db->where('id', $id);
		$this->db->delete('gift_item'); 	
		
	}

   		
	
}
