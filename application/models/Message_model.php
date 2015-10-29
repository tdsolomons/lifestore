<?php
class Message_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function listAllMessages($userId){
    	$sql = "SELECT m.*, u2.username AS 'sender_username', u1.username , i.title
                FROM message m, user u1, user u2, item i
    			WHERE (m.sender = '$userId' OR m.receiver = '$userId') 
                AND m.sender = u1.user_id AND m.receiver = u2.user_id
                AND m.about_item = i.item_id";

    	$query = $this->db->query($sql);

    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}

    }

}
