<?php

class OrderModel extends CI_Model {
	public function __construct()
    {
            $this->load->database();
    }
   
   
   
    function getDetails($username) {

        
        $this->db->where('bought_by_user', $username);
        $query = $this->db->get('order');
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }
    
    function updateReceivedSt($orderID) {
        $data = array('order_status'=> 4);
        $this->db->where('order_id',$orderID);
        $this->db->update('order',$data);
        
    }
    
        function getRecord($orderID) {
        
        $data = array('order_id' => $orderID);
        //$this->db->where('order_id', $orderID);
        $queryRecord = $this->db->get_where('order',$data);
        $resultRecord = $queryRecord->result();

        if ($queryRecord->num_rows()== 1) {
            return $resultRecord;
        } else {
            return 0;
        }
    }

}
