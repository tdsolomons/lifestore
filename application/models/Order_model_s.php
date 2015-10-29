<?php

class Order_model_s extends CI_Model {
	
	public function __construct()
    {
            $this->load->database();
    }
   
    function getDetails($username) {
		/*
		
		$this->db->select('user_id');
		$this->db->from('user');
		$this->db->where(' username='.$username.'');
		$result=$this->db->get();
		$row=$result->row();
		$user_id=$row->user_id;
		
		$this->db->select('*');
		$this->db->from('EMarketingPortal.order');
		$this->db->where('bought_by_user  = '.$user_id .'');
		$orders = $this->db->get();
		*/
		
		$query=$this->db->query("SELECT * FROM EMarketingPortal.order WHERE bought_by_user in (SELECT user_id FROM user where username='$username')");
		

		//$data = array('bought_by_user' => '(SELECT user_id FROM user WHERE username ='.$username.')');
      //  $this->db->select('*');
       // $userID = $this->db->get_where('order', $data);
		//$result = $userID->result();
		
       // $this->db->where('bought_by_user', (String)$userID);
      //  $query = $this->db->get('order');
      // 	$user = $query->result();
		//$this->db->trans_complete();

        	if ($query->num_rows() > 0) {
           		$orders=$query->result();
				return $orders;
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
	     function getSales($username) {
        
       // $this->db->where('seller', $username);
       // $query = $this->db->get('item');
	   
	   $query=$this->db->query("SELECT * 
	   							FROM EMarketingPortal.item 
								WHERE seller = (SELECT user_id FROM EMarketingPortal.user WHERE username ='$username')");
	   
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }
    
		function getSeller($order){
		
		$query=$this->db->query("SELECT username FROM user WHERE user_id in(SELECT seller FROM EMarketingPortal.item WHERE item_id in (SELECT item FROM EMarketingPortal.order where order_id=$order))");
		
		if ($query->num_rows() > 0) {
           		$usrRow=$query->result();
				foreach($usrRow as $row)
				 $usern=$row->username;
				return $usern;
        	} else {
            	return 0;
        	}
	}
	
		function getItem($order){
		
		$query=$this->db->query("SELECT item FROM EMarketingPortal.order where order_id=$order");
		
		if ($query->num_rows() > 0) {
           		$itemRow=$query->row();
				$item=$itemRow->item;
				return $item;
        	} else {
            	return 0;
        	}
	}
	
	function getAuctionDetails($username){
	
		$query=$this->db->query("select i.item_id, i.title, a.end_datetime, u.first_name
										from EMarketingPortal.auction_item a 
										inner join EMarketingPortal.item i 
										on i.item_id = a.item_id
										inner join EMarketingPortal.user u
										on u.user_id = i.seller
										where a.winner = (select user_id 
											from user
											where username = '".$username."');");
		
 		$result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
	}
	
	
	
	/*This function retreive the order details required to be displayed on request_refund_view
	 *INPUT PARAM.:$id - order_id 
	 *OUTPUT PARAM.:$result - result table in array
	 */
	function getOrderDetails($id){
		$query=$this->db->query("SELECT o.*,i.title,name
								 FROM EMarketingPortal.order o,item i,image
								 WHERE o.order_id='$id'
								 AND i.item_id = o.item
								 AND i.main_image = image_id");
		
 		$result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
	}

	/*
	The method below is implemented in order to get the list of buyers who follows the given seller.
	(the user currently logged into the system.)
	*/
	public function get_my_followers($user_id){
		
		$query=$this->db->query("select u.first_name, u.last_name, u.username, u.email, u.city
								 from EMarketingPortal.user u
								 inner join EMarketingPortal.follow f
 								 on u.user_id = f.buyer
								 where seller = '".$user_id."'");
 		$result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
	}
	
	/*
	The method below is implemented in order to get the list of seller who the user follows.
	(the user currently logged into the system.)
	*/	
	public function who_i_follow($user_id){
		
		$query=$this->db->query("select u.first_name, u.last_name, u.username, u.email, u.city
								 from EMarketingPortal.user u
								 inner join EMarketingPortal.follow f
								 on u.user_id = f.seller
	 							 where buyer = '".$user_id."'");
 		$result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
	}

}
?>