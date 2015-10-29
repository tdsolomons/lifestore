<?php

class Bidexceed_model extends CI_Model {
	
		public function __construct()
    	{
            $this->load->database();
    	}

	
	public function testAddBid(){
		
		$insert = $this->db->query("insert into bid (auction_item, amount, bid_datetime, bidder) values (1, 350, NOW(), 3)");
        return $insert;
		
	}

	public function getBidExceed($itemID) {

		$emailQ = $this->db->query('select email from EMarketingPortal.user where user_id = ( 
									select bidder from EMarketingPortal.bid where amount = (
									select max(amount) from EMarketingPortal.bid where auction_item = '.$itemID.') limit 1);');
		
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
               
                $this->email->subject("Your bid Exceeded on item : ".$itemID);
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
                                    .  '<br><b>The maximum bid amount you have posted on the item '.$itemID.' has been exceeded, a moment ago. If you are interested in bidding a higher amount for the same item please go back to our website, </br>
http://sep.tagfie.com </br>									Thank you! </br>                                                                               Best Regards,
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
                //echo $this->email->print_debugger();

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
?>