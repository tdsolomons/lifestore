<?php
class Refund_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

	
/*Retreive the order details required to be displayed on request_refund_view
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:$result - result table in array
 */
//----------------------------------------------------------------------------------------------------------------
	function getOrderDetails($id){
		$query=$this->db->query("SELECT o.*,i.title,name,i.seller
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
	
	
	
	
	
/*This function retreive the refund messages required to be displayed on request_refund_view
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:$result - result table in array
 */
//----------------------------------------------------------------------------------------------------------------
	function getRefundMessages($id){
		$query=$this->db->query("SELECT req_id
								 FROM refund_request
								 WHERE order_id = $id");
		if ($query->num_rows() == 1) {
			$row=$query->row();
			$req_id = $row->req_id;	
			$_SESSION['refund_req_id'] = $req_id;				 		
		
			$query2=$this->db->query("SELECT m.*,u1.username AS 'sender',u2.username AS 'reciever'
								 FROM refund_message m,user u1,user u2
								 WHERE m.req_id='$req_id'
								 AND u1.user_id = m.sender_id
								 AND u2.user_id = m.receiver_id
								 ORDER BY sent_time ");
		
 			$result = $query2->result();
			return $result;
        
		}
		else  {
            return NULL;
        }
		
	}
	
	

	
/*This function retreive the order details required to be displayed on request_refund_view
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:$result - result table in array
 */
//----------------------------------------------------------------------------------------------------------------
	function send_reply($sender,$receiver,$content,$req_id){
		$query=$this->db->query("INSERT INTO refund_message(sender_id,receiver_id,req_id,sent_time,content)
								 VALUES($sender,$receiver,$req_id,NOW(),'$content')");
		if ($query) {
        	$query2=$this->db->query("UPDATE refund_request
								 	  SET case_status=1
								 	  WHERE req_id=$req_id");
		}
	    
		if ($query2) {
            return true;
        } else {
            return false;
        }
	}
	
	
	
	
	
/*This function sets a a given case status to close
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:boolean value 
 */
 //----------------------------------------------------------------------------------------------------------------
	function set_close($req_id){
		$query=$this->db->query("UPDATE refund_request
								 SET case_status=0
								 WHERE req_id=$req_id");
		
        if ($query) {
            return true;
        } else {
            return false;
        }
	}
	
	
	
	
	
/*This function retreive the order details required to be displayed on request_refund_view
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	function set_request($sender,$receiver,$content,$order_id){
		$query=$this->db->query("INSERT INTO refund_request(order_id)
								 VALUES($order_id)");
		
		if ($query) {
			$req_id = $this->db->insert_id();
			$query2=$this->db->query("INSERT INTO refund_message(sender_id,receiver_id,req_id,sent_time,content)
								 	  VALUES($sender,$receiver,$req_id,NOW(),'$content')");
		}
        
		if ($query) {
            return true;
        } else {
            return false;
        }
	}
	
	
	
	
	
	
/*This function retreive the refund requests received by a particular seller
 *INPUT PARAM.:$id - user_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	
	function get_requests_open($id){
		$query=$this->db->query("SELECT rr.req_id,o.*,i.title,name
								 FROM refund_request rr, EMarketingPortal.order o,item i,image
								 WHERE 	i.seller = $id
								 AND rr.order_id=o.order_id
								 AND  o.item = i.item_id
								 AND i.main_image = image.image_id
								 AND rr.case_status=1");
		if ($query->num_rows() > 0) {
			
 			$result = $query->result();
			return $result;
        
		}
		else  {
            return NULL;
        }
		
	}
	
	
	
	
/*This function retreive the refund requests received by a particular seller
 *INPUT PARAM.:$id - user_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	
	function get_requests_closed($id){
		$query=$this->db->query("SELECT rr.req_id,o.*,i.title,name
								 FROM refund_request rr, EMarketingPortal.order o,item i,image
								 WHERE 	i.seller = $id
								 AND rr.order_id=o.order_id
								 AND  o.item = i.item_id
								 AND i.main_image = image.image_id
								 AND rr.case_status=0");
		if ($query->num_rows() > 0) {
			
 			$result = $query->result();
			return $result;
        
		}
		else  {
            return NULL;
        }
		
	}
	
	
	
	
	
	
/*This function retreive the details of a specific refund request,in order to display the case status
 *INPUT PARAM.:$id - order_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	function get_request_details($id){
		$query=$this->db->query("SELECT *
								 FROM refund_request
								 WHERE order_id = $id");
		if ($query->num_rows() > 0) {
 			$result = $query->result();
			return $result;
		}
		
	}
	
	
	
	
	
/*This function sets the case status of a specific request to 'close';
 *INPUT PARAM.:$id - req_id 
 *OUTPUT PARAM.:$result - result table in array
 */
//----------------------------------------------------------------------------------------------------------------
	function set_request_close($req_id){
		$query=$this->db->query("UPDATE refund_request
								 SET case_status=0
								 WHERE req_id=$req_id");
		
        if ($query) {
            return true;
        } else {
            return false;
        }
	}






/*This function sets the Admin status of a specific request to 'true';
 *INPUT PARAM.:$req_id - req_id
 *			   $status - true or false 
 *OUTPUT PARAM.:boolean value
 */
//----------------------------------------------------------------------------------------------------------------
	function set_admin_status($req_id,$status){
		$query=$this->db->query("UPDATE refund_request
								 SET admin_status=$status
								 WHERE req_id=$req_id");
		
        if ($query) {
            return true;
        } else {
            return false;
        }
	}
	



/*This function retreive the refund requests received by a particular seller
 *INPUT PARAM.:$id - user_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	
	function get_req_admin_open(){
		$query=$this->db->query("SELECT rr.req_id,o.*,i.title,name
								 FROM refund_request rr, EMarketingPortal.order o,item i,image
								 WHERE 	rr.admin_status=1
								 AND rr.order_id=o.order_id
								 AND  o.item = i.item_id
								 AND i.main_image = image.image_id
								 AND rr.case_status=1");
		if ($query->num_rows() > 0) {
			
 			$result = $query->result();
			return $result;
        
		}
		else  {
            return NULL;
        }
		
	}
	
	
/*Retreive the refund requests received by a particular seller
 *INPUT PARAM.:$id - user_id 
 *OUTPUT PARAM.:$result - result table in array
 */
 //----------------------------------------------------------------------------------------------------------------
	
	function get_req_admin_closed(){
		$query=$this->db->query("SELECT rr.req_id,o.*,i.title,name
								 FROM refund_request rr, EMarketingPortal.order o,item i,image
								 WHERE 	rr.admin_status=1
								 AND rr.order_id=o.order_id
								 AND  o.item = i.item_id
								 AND i.main_image = image.image_id
								 AND rr.case_status=0");
		if ($query->num_rows() > 0) {
			
 			$result = $query->result();
			return $result;
        
		}
		else  {
            return NULL;
        }
		
	}
	
}
?>