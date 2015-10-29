<?php
//============================================================
// File name   : Refund_model.php
// Version     : 1.0
// Begin       : 2015-10-01
// Last Update : 2015-10-04
// Author      : Hasantha Suneth
// -----------------------------------------------------------
// 
//
// This file is part of Lifestore models
//
// 
//============================================================

/**
 * @class Refund_model
 * This Class contains the methods which are used to handle the Data related to refunding in the database.
 * @author Hasantha Suneth
 */
class Refund_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

	
	
	 /**
	 *  Retreive the order details required to be displayed on request_refund_view
	 *	@param  $id - order_id 
	 *	@return $result - result table in array
	 */
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
	
	
	
	
	
	 /**
	 *This function retreive the refund messages required to be displayed on request_refund_view
	 *@param $id - order_id 
	 *@return $result - result table in array
	 */

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
	
	
	
	 /**
	 * This function retreive the order details required to be displayed on request_refund_view
	 * @param $item_type(boolean) Parameter which indicates the type of items whether Fixed or Auction
	 * @param $time(string) Specify thye time period to generate a report.
	 * @return $array Array contain the acquired data and the sum of the Sales 
	 * @author Hasantha Suneth
	 */
	
	
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
	
	
	
	
	
   /** 
   * This function sets a a given case status to close
   * @param $id - order_id 
   * @return boolean value 
   */
 
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
	
	
	
 	/**
	 * setting a new refund request 
	 * @param $content(string) Message contents sent to the seller ,setting the request
	 * @param $receiver(int) user id of the seller
	 * @param $order_id(int)id of the order which needs a refund
	 * @param $sender(int)user_id of the buyer 
	 * @author Hasantha Suneth
	 */
	 
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
	
	
	
	
	
	
 /**
 * This function retreive the open refund requests received by a particular seller
 * @param $id - user_id 
 * @return $result - result table in array
 */
 
	
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
	
	
	
	
  /**
   * This function retreive the closed refund requests received by a particular seller
   * @param $id - user_id 
   * @return $result - result table in array
   */
	
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
	
	
	
	
	
	
  /**
   * This function retreive the details of a given refund request
   * @param $id - req_id of the request
   * @return $result - result table in array
   */
	function get_request_details($id){
		$query=$this->db->query("SELECT *
								 FROM refund_request
								 WHERE order_id = $id");
		if ($query->num_rows() > 0) {
 			$result = $query->result();
			return $result;
		}
		
	}
	
	
	
	
	
  /**
   * This function sets  refund requests status to close
   * @param $req_id - id of the request 
   */
	
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








	/**
	 * stating a refund request is reviewing by the admin or not.
	 * @param $req_id(int)id of the refund request 
	 * @param $status(boolean)status of the admin
	 * @author Hasantha Suneth
	 */

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
	

	/**
	 * Retreive the open refund requests to admin	 
	 * @return $result(dataset)open refund requests
	 * @author Hasantha Suneth
	 */


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

	/**
	 * Retreive the closed refund requests to admin	 
	 * @return $result(dataset)closed refund requests
	 * @author Hasantha Suneth
	 */	

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
	
	/**
	 * Send mails to users on messages	 
	 * @param $reciever(int) receivers user_id
	 * @author Hasantha Suneth
	 */	
	
	public function send_mail($receiver){
			 $query = $this->db->query("select u.email,u.first_name,u.last_name
									from user u
									where u.user_id=$receiver
									") ;
									
						 if ($query) {
                 foreach ($query->result() as $row){
                    $storeName = 'LifeStore.lk';
                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('noreply@sep.tagfie.com', $storeName);
                    $this->email->to($row->email); 

                    $emailSubject = 'Message Received';

                   	$content='Your have received messages related to refund request';

                    $this->email->subject($emailSubject);

                    $emailBody = '<html><head></head>
            <body>
            <table cellspacing="0" cellpadding="0" style="padding:30px 10px;background:#EEE;width:100%;font-family:arial">
            <tbody>
                    
            <tr>
                <td>
                    <table cellspacing="0" align="center" style="max-width:650px;min-width:320px">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:14px">
                                    <img align="left" src="'. asset_url() .'img/logolife.png" alt="'. $storeName .'"></img>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#FFF;border:1px solid #e4e4e4;padding:50px 30px">
                                    <table align="center">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="color:#666;padding:15px 5px;font-size:14px;line-height:20px;font-family:arial">
                                            <p style="font-weight:bold;font-size:16px">Hello ' . $row->first_name . ' ' . $row->last_name   . 
                                            ',</p>' 
                                    .  '<br> You have received following message <strong>' 
                                   
                                    . '</strong> <br><p>' 
                                    . $content . '</p><p><a href="http://sep.tagfie.com">View Message</a></p>
                                                                                Best Regards,
                                                                                <br/>
                                                                                '. $storeName .'
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="background:#F8F8F8;border:1px solid #e4e4e4;border-top:none;padding:24px 10px">
                                                            <p></p>         
                                                            
                                                            </td>               
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                                <table style="max-width:650px" align="center">
                                                    
                                                    <tbody><tr>
                                                        <td style="color:#b4b4b4;font-size:11px;padding-top:10px;line-height:15px;font-family:arial">

                                                            © '. $storeName .' 2015 
                                                            
                                                        </td>

                                                    </tr>
                                                </tbody></table>
                                            
                                        </tr>
                                        </tbody>
                                    
                                        </table>
                                        </body>
                                        </html>';

                    $this->email->message($emailBody);  

                    $this->email->send();
                 }
						 }
		
		  
			
		}
	
}//End of Class---------------------------------------------------------------------------------------

//End of File=========================================================================================
?>