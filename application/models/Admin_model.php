<?php

class Admin_model extends CI_Model {
	
		public function __construct()
    {
            $this->load->database();
    }
  

    function getItemsListLimit() {

        //$query = $this->db->get('item', 10, 0);
		
		$query = $this->db->query("SELECT  i.item_id, i.title, i.description, i.posted_date, i.shipping_cost, c.category_name as category, u.username as seller, i.available_quantity, i.item_status
		FROM EMarketingPortal.item i  
		INNER JOIN EMarketingPortal.user u ON i.seller = u.user_id
		INNER JOIN EMarketingPortal.category c ON i.category = c.category_id
		LIMIT 0,10");
        
		$result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function getUsersListLimit() {

        $query = $this->db->get('user', 10, 0);
        $result = $query->result();
		if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }
	
	public function getUserList() {
		
		$queryUser = $this->db->query("SELECT * FROM EMarketingPortal.user u, EMarketingPortal.user_phone up WHERE u.user_id=up.user_id ");

                $resultUser = $queryUser->result();
                if ($queryUser->num_rows()>= 1 ) {
                    return $resultUser;
                } else {
                    
				}
            }
	
	//function getUserPhone($uID){
		//$data = array('user_id' => $uID);
		//$query = $this->db->get_where('user_phone', $data);
		//$userPhone = $query->result();
		
		  //if ($queryRecord->num_rows() > 0) {
            //return $userRecord;
       // } else {
        //    return 0;
     //   }
	//}

    function getUserRecord($itemID) {

        $data = array('item_id' => $itemID);
        $queryRecord = $this->db->get_where('item', $data);
        $userRecord = $queryRecord->result();

        if ($queryRecord->num_rows() == 1) {
            return $userRecord;
        } else {
            return 0;
        }
    }
    
      function getItemRecord($itemID) {

      //  $data = array('item_id' => $itemID);
      //  $queryRecord = $this->db->get_where('item', $data);
      //  $itemRecord = $queryRecord->result();
	  
	  	$queryRecord = $this->db->query("SELECT  i.item_id, i.title, i.description, i.posted_date, i.shipping_cost, c.category_name as category, u.username as seller, i.available_quantity, i.item_status, i.condition_type
		FROM EMarketingPortal.item i  
		INNER JOIN EMarketingPortal.user u ON i.seller = u.user_id
		INNER JOIN EMarketingPortal.category c ON i.category = c.category_id
		WHERE i.item_id=$itemID");

		 $itemRecord = $queryRecord->result();
        
		if ($queryRecord->num_rows() == 1) {
            return $itemRecord;
        } else {
            return 0;
        }
    }

        function getItemsList() {

        $query = $this->db->query("SELECT  i.item_id, i.title, i.description, i.posted_date, i.shipping_cost, c.category_name as category, u.username as seller, i.available_quantity, i.item_status
		FROM EMarketingPortal.item i  
		INNER JOIN EMarketingPortal.user u ON i.seller = u.user_id
		INNER JOIN EMarketingPortal.category c ON i.category = c.category_id");
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function getUsersList() {

        $query = $this->db->get('user');
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return 0;
        }
    }
    
    function removeItemRequest($itemID) {

		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_id = (SELECT seller FROM item WHERE item_id = '.$itemID .')' );
		$emailQ = $this->db->get();
		
		$emailRes = $emailQ->result();
		
		foreach($emailRes as $row){
			$email = $row->email;
		}

		
		 if ($email) {
			 
			 
			 $sql = "SELECT first_name, last_name 
                    FROM user 
                    WHERE email = '$email' 
					LIMIT 1";
            $query3 = $this->db->query($sql);
			
			 if ($query3) {
                 foreach ($query3->result() as $row)
                 {
	
				$storeName = 'LifeStore.lk';

                $this->load->library('email');
 				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
                
				$this->email->from("noreply@sep.tagfie.com", "LifeStore.lk");
                $this->email->to($email);
               
                $this->email->subject("Request to remove the item : ".$itemID);
                $this->email->message('<html><head></head>
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
                                    .  '<br><b>The item you have posted seems to be inappropriate. I would like to request you to remove it and you are welcome to make inquiries on behalf of this request. Please make the item ID '.$itemID.' the reference to your inquiry, Thank you! </br>                                                                               Best Regards,
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
                                        </html>');
                   
                $result = $this->email->send();
                echo $this->email->print_debugger();

            if ($result) {
                return TRUE;
           } else {
                return FALSE;
            }
    	}
			 }
		 }
   	   
    }
    
     function deactivateUser($uname) {
        
        $data = array('user_status'=> 0);
        $this->db->where('username',$uname);
        $this->db->update('user',$data);
		
		$data = array('username' => $uname);
        $this->db->select('email');
        $emailQ = $this->db->get_where('user', $data);
		$emailRes = $emailQ->result();
		
		foreach($emailRes as $row){
			$email = $row->email;
		}
		
		 if ($email) {
			 
			 
			 $sql = "SELECT first_name, last_name 
                    FROM user 
                    WHERE email = '$email' 
					LIMIT 1";
            $query3 = $this->db->query($sql);
			
			 if ($query3) {
                 foreach ($query3->result() as $row)
                 {
	
				$storeName = 'LifeStore.lk';

                $this->load->library('email');
 				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
                
				$this->email->from("noreply@sep.tagfie.com", "LifeStore.lk");
                $this->email->to($email);
               
                $this->email->subject("Membership Deactivated : ".$uname);
                $this->email->message( '<html><head></head>
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
                                    .  '<br>It is with great regret we inform you that your membership has currently been deactivated due to certain reasons. You are welcome to inquire the issue anytime. </br>Please make the username <strong>'.$uname.'</strong> the reference to your inquiry,Thank you! </br>".
                                   <br><p>'.
                                                                               'Best Regards,
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
                                        </html>');
				

                $result = $this->email->send();
                echo $this->email->print_debugger();

            if ($result) {
                return TRUE;
           } else {
                return FALSE;
		   }
				 }
			 }
   		 }
	 }
	
	 function activateUser($uname) {
        
        $data = array('user_status'=> 1);
        $this->db->where('username',$uname);
        $this->db->update('user',$data);
		
		$data = array('username' => $uname);
        $this->db->select('email');
        $emailQ = $this->db->get_where('user', $data);
		$emailRes = $emailQ->result();
		
		foreach($emailRes as $row){
			$email = $row->email;
		
		 if ($email) {
			 
			 
			 $sql = "SELECT first_name, last_name 
                    FROM user 
                    WHERE email = '$email' 
					LIMIT 1";
            $query3 = $this->db->query($sql);
			
			 if ($query3) {
                 foreach ($query3->result() as $row)
                 {
	
				$storeName = 'LifeStore.lk';

                $this->load->library('email');
 				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
                
				$this->email->from("noreply@sep.tagfie.com", "LifeStore.lk");
                $this->email->to($email);
               
                $this->email->subject("Membership Re-Activated : ".$uname);
                $this->email->message('<html><head></head>
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
                                    .  '<br> It is with much pleasure we announce you that your membership has been activated back!. Welcome back to our team again </br> Please make the username <strong>'.$uname.'</strong> the reference to any inquiry you wish to make, Thank you! </br>.
                                   <br><p>'.
                                                                               'Best Regards,
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
                                        </html>');
                   
                $result = $this->email->send();
                echo $this->email->print_debugger();

            if ($result) {
                return TRUE;
           } else {
                return FALSE;
		   }
				 }
			 }
   		 }
		}
    }
    
}

?>